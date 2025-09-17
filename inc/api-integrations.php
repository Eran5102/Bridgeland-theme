<?php
/**
 * Third-Party API Integrations
 * Connect with financial data providers, compliance services, and business tools
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandAPIIntegrations {

    private $api_cache;
    private $rate_limits;

    public function __init() {
        add_action('init', array($this, 'init_api_system'));
        add_action('wp_ajax_fetch_company_data', array($this, 'fetch_company_data'));
        add_action('wp_ajax_get_market_data', array($this, 'get_market_data'));
        add_action('wp_ajax_validate_tax_id', array($this, 'validate_tax_id'));
        add_action('wp_ajax_get_industry_benchmarks', array($this, 'get_industry_benchmarks'));
        add_action('wp_ajax_sync_financial_data', array($this, 'sync_financial_data'));

        // Scheduled API sync
        add_action('bridgeland_hourly_api_sync', array($this, 'hourly_api_sync'));
        if (!wp_next_scheduled('bridgeland_hourly_api_sync')) {
            wp_schedule_event(time(), 'hourly', 'bridgeland_hourly_api_sync');
        }

        $this->api_cache = array();
        $this->rate_limits = array();
    }

    /**
     * Initialize API System
     */
    public function init_api_system() {
        $this->setup_api_endpoints();
        $this->register_api_post_types();
    }

    /**
     * Register API-Related Post Types
     */
    private function register_api_post_types() {
        // API Logs
        register_post_type('api_log', array(
            'labels' => array(
                'name' => 'API Logs',
                'singular_name' => 'API Log',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Market Data Cache
        register_post_type('market_data', array(
            'labels' => array(
                'name' => 'Market Data',
                'singular_name' => 'Market Data',
            ),
            'public' => false,
            'show_ui' => false,
            'supports' => array('title'),
            'capability_type' => 'post',
        ));
    }

    /**
     * Setup API Endpoints
     */
    private function setup_api_endpoints() {
        // Company data providers
        $this->api_endpoints = array(
            'clearbit' => array(
                'base_url' => 'https://company.clearbit.com/v2',
                'enrichment' => '/companies/find',
                'auth_header' => 'Authorization: Bearer ' . get_option('clearbit_api_key'),
                'rate_limit' => 600 // per hour
            ),
            'crunchbase' => array(
                'base_url' => 'https://api.crunchbase.com/api/v4',
                'organizations' => '/entities/organizations',
                'auth_header' => 'X-cb-user-key: ' . get_option('crunchbase_api_key'),
                'rate_limit' => 200 // per hour
            ),
            'alpha_vantage' => array(
                'base_url' => 'https://www.alphavantage.co/query',
                'auth_param' => '&apikey=' . get_option('alpha_vantage_api_key'),
                'rate_limit' => 5 // per minute
            ),
            'sec_api' => array(
                'base_url' => 'https://api.sec-api.io',
                'filings' => '/filing',
                'auth_header' => 'Authorization: ' . get_option('sec_api_key'),
                'rate_limit' => 100 // per day
            ),
            'pitchbook' => array(
                'base_url' => 'https://api.pitchbook.com/v1',
                'companies' => '/companies',
                'transactions' => '/transactions',
                'auth_header' => 'Authorization: Bearer ' . get_option('pitchbook_api_key'),
                'rate_limit' => 1000 // per day
            ),
            'quickbooks' => array(
                'base_url' => 'https://sandbox-quickbooks.api.intuit.com/v3/company',
                'auth_header' => 'Authorization: Bearer ' . get_option('quickbooks_access_token'),
                'rate_limit' => 500 // per hour
            )
        );
    }

    /**
     * Fetch Company Data from Multiple Sources
     */
    public function fetch_company_data() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $company_identifier = sanitize_text_field($_POST['company_identifier']);
        $sources = $_POST['sources'] ?? array('clearbit', 'crunchbase');

        $company_data = array();

        foreach ($sources as $source) {
            $data = $this->fetch_from_source($source, $company_identifier);
            if ($data) {
                $company_data[$source] = $data;
            }
        }

        // Merge and standardize data
        $standardized_data = $this->standardize_company_data($company_data);

        // Cache the results
        $this->cache_company_data($company_identifier, $standardized_data);

        wp_send_json_success(array(
            'data' => $standardized_data,
            'sources' => array_keys($company_data),
            'cached_at' => current_time('c')
        ));
    }

    /**
     * Get Market Data for Valuations
     */
    public function get_market_data() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $data_type = sanitize_text_field($_POST['data_type']);
        $symbol = sanitize_text_field($_POST['symbol'] ?? '');
        $industry = sanitize_text_field($_POST['industry'] ?? '');

        $market_data = array();

        switch ($data_type) {
            case 'risk_free_rate':
                $market_data = $this->get_risk_free_rate();
                break;
            case 'market_premium':
                $market_data = $this->get_equity_risk_premium();
                break;
            case 'beta':
                if ($symbol) {
                    $market_data = $this->get_stock_beta($symbol);
                }
                break;
            case 'industry_multiples':
                if ($industry) {
                    $market_data = $this->get_industry_multiples($industry);
                }
                break;
            case 'comparable_transactions':
                $market_data = $this->get_comparable_transactions($industry);
                break;
        }

        wp_send_json_success(array(
            'data' => $market_data,
            'type' => $data_type,
            'updated_at' => current_time('c')
        ));
    }

    /**
     * Validate Tax ID using IRS API
     */
    public function validate_tax_id() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $tax_id = sanitize_text_field($_POST['tax_id']);
        $company_name = sanitize_text_field($_POST['company_name']);

        // Format EIN
        $ein = preg_replace('/[^0-9]/', '', $tax_id);
        if (strlen($ein) !== 9) {
            wp_send_json_error('Invalid EIN format');
        }

        $formatted_ein = substr($ein, 0, 2) . '-' . substr($ein, 2);

        // Use IRS API for validation (simplified implementation)
        $validation_result = $this->validate_ein_with_irs($formatted_ein, $company_name);

        wp_send_json_success(array(
            'valid' => $validation_result['valid'],
            'formatted_ein' => $formatted_ein,
            'company_match' => $validation_result['company_match'],
            'status' => $validation_result['status']
        ));
    }

    /**
     * Get Industry Benchmarks
     */
    public function get_industry_benchmarks() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $industry_code = sanitize_text_field($_POST['industry_code']);
        $metrics = $_POST['metrics'] ?? array('revenue_multiple', 'ebitda_multiple', 'growth_rate');

        $benchmarks = array();

        // Fetch from multiple sources
        $sources = array('pitchbook', 'crunchbase');
        foreach ($sources as $source) {
            $data = $this->fetch_industry_benchmarks($source, $industry_code, $metrics);
            if ($data) {
                $benchmarks[$source] = $data;
            }
        }

        // Calculate aggregated benchmarks
        $aggregated = $this->aggregate_benchmarks($benchmarks, $metrics);

        wp_send_json_success(array(
            'benchmarks' => $aggregated,
            'industry_code' => $industry_code,
            'sources' => array_keys($benchmarks),
            'updated_at' => current_time('c')
        ));
    }

    /**
     * Sync Financial Data from Accounting Systems
     */
    public function sync_financial_data() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $company_id = intval($_POST['company_id']);
        $accounting_system = sanitize_text_field($_POST['accounting_system']);

        $financial_data = array();

        switch ($accounting_system) {
            case 'quickbooks':
                $financial_data = $this->sync_quickbooks_data($company_id);
                break;
            case 'xero':
                $financial_data = $this->sync_xero_data($company_id);
                break;
            case 'sage':
                $financial_data = $this->sync_sage_data($company_id);
                break;
        }

        if ($financial_data) {
            // Store financial data
            $this->store_financial_data($company_id, $financial_data, $accounting_system);

            wp_send_json_success(array(
                'data' => $financial_data,
                'system' => $accounting_system,
                'synced_at' => current_time('c')
            ));
        } else {
            wp_send_json_error('Failed to sync financial data');
        }
    }

    /**
     * Fetch Data from Specific Source
     */
    private function fetch_from_source($source, $identifier) {
        // Check rate limits
        if (!$this->check_rate_limit($source)) {
            return false;
        }

        // Check cache first
        $cache_key = $source . '_' . md5($identifier);
        $cached_data = $this->get_cached_data($cache_key);
        if ($cached_data) {
            return $cached_data;
        }

        $data = false;

        switch ($source) {
            case 'clearbit':
                $data = $this->fetch_clearbit_data($identifier);
                break;
            case 'crunchbase':
                $data = $this->fetch_crunchbase_data($identifier);
                break;
        }

        if ($data) {
            $this->cache_data($cache_key, $data, HOUR_IN_SECONDS * 6);
            $this->log_api_call($source, $identifier, 'success');
        } else {
            $this->log_api_call($source, $identifier, 'failed');
        }

        return $data;
    }

    /**
     * Fetch Clearbit Company Data
     */
    private function fetch_clearbit_data($domain) {
        $api_key = get_option('clearbit_api_key');
        if (!$api_key) return false;

        $url = $this->api_endpoints['clearbit']['base_url'] . $this->api_endpoints['clearbit']['enrichment'] . '?domain=' . urlencode($domain);

        $response = wp_remote_get($url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key
            ),
            'timeout' => 30
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            return json_decode(wp_remote_retrieve_body($response), true);
        }

        return false;
    }

    /**
     * Fetch Crunchbase Company Data
     */
    private function fetch_crunchbase_data($company_name) {
        $api_key = get_option('crunchbase_api_key');
        if (!$api_key) return false;

        $url = $this->api_endpoints['crunchbase']['base_url'] . $this->api_endpoints['crunchbase']['organizations'] . '?name=' . urlencode($company_name);

        $response = wp_remote_get($url, array(
            'headers' => array(
                'X-cb-user-key' => $api_key
            ),
            'timeout' => 30
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            return json_decode(wp_remote_retrieve_body($response), true);
        }

        return false;
    }

    /**
     * Get Risk-Free Rate from Alpha Vantage
     */
    private function get_risk_free_rate() {
        $api_key = get_option('alpha_vantage_api_key');
        if (!$api_key) return false;

        $url = $this->api_endpoints['alpha_vantage']['base_url'] . '?function=TREASURY_YIELD&interval=daily&maturity=10year' . $this->api_endpoints['alpha_vantage']['auth_param'];

        $response = wp_remote_get($url, array('timeout' => 30));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $data = json_decode(wp_remote_retrieve_body($response), true);

            if (isset($data['data']) && !empty($data['data'])) {
                $latest = $data['data'][0];
                return array(
                    'rate' => floatval($latest['value']),
                    'date' => $latest['date'],
                    'source' => 'alpha_vantage'
                );
            }
        }

        return false;
    }

    /**
     * Get Equity Risk Premium
     */
    private function get_equity_risk_premium() {
        // Use historical average or fetch from data provider
        return array(
            'premium' => 6.5, // Historical average
            'source' => 'historical_average',
            'date' => current_time('Y-m-d')
        );
    }

    /**
     * Standardize Company Data from Multiple Sources
     */
    private function standardize_company_data($company_data) {
        $standardized = array(
            'name' => '',
            'domain' => '',
            'industry' => '',
            'sector' => '',
            'employees' => 0,
            'founded_year' => null,
            'location' => '',
            'description' => '',
            'revenue' => null,
            'funding' => array(),
            'technologies' => array(),
            'social_media' => array()
        );

        // Merge data from Clearbit
        if (isset($company_data['clearbit'])) {
            $cb = $company_data['clearbit'];
            $standardized['name'] = $cb['name'] ?? '';
            $standardized['domain'] = $cb['domain'] ?? '';
            $standardized['industry'] = $cb['category']['industry'] ?? '';
            $standardized['sector'] = $cb['category']['sector'] ?? '';
            $standardized['employees'] = $cb['metrics']['employees'] ?? 0;
            $standardized['founded_year'] = $cb['foundedYear'] ?? null;
            $standardized['location'] = ($cb['geo']['city'] ?? '') . ', ' . ($cb['geo']['state'] ?? '');
            $standardized['description'] = $cb['description'] ?? '';
        }

        // Merge data from Crunchbase
        if (isset($company_data['crunchbase'])) {
            $cr = $company_data['crunchbase'];
            if (isset($cr['entities']) && !empty($cr['entities'])) {
                $entity = $cr['entities'][0]['properties'];
                $standardized['name'] = $standardized['name'] ?: ($entity['name'] ?? '');
                $standardized['description'] = $standardized['description'] ?: ($entity['short_description'] ?? '');
                $standardized['founded_year'] = $standardized['founded_year'] ?: ($entity['founded_on']['value'] ?? null);
            }
        }

        return $standardized;
    }

    /**
     * Cache Management
     */
    private function cache_data($key, $data, $expiration = HOUR_IN_SECONDS) {
        set_transient('bridgeland_api_' . $key, $data, $expiration);
    }

    private function get_cached_data($key) {
        return get_transient('bridgeland_api_' . $key);
    }

    private function cache_company_data($identifier, $data) {
        $cache_id = wp_insert_post(array(
            'post_title' => 'Company Data - ' . $identifier,
            'post_type' => 'market_data',
            'post_status' => 'private',
            'post_content' => json_encode($data)
        ));

        if ($cache_id) {
            update_post_meta($cache_id, '_identifier', $identifier);
            update_post_meta($cache_id, '_data_type', 'company_data');
            update_post_meta($cache_id, '_cached_date', current_time('mysql'));
        }
    }

    /**
     * Rate Limiting
     */
    private function check_rate_limit($source) {
        $limit_key = 'rate_limit_' . $source;
        $current_count = get_transient($limit_key) ?: 0;
        $limit = $this->api_endpoints[$source]['rate_limit'];

        if ($current_count >= $limit) {
            return false;
        }

        set_transient($limit_key, $current_count + 1, HOUR_IN_SECONDS);
        return true;
    }

    /**
     * API Logging
     */
    private function log_api_call($source, $identifier, $status) {
        $log_id = wp_insert_post(array(
            'post_title' => 'API Call - ' . $source . ' - ' . $identifier,
            'post_type' => 'api_log',
            'post_status' => 'private'
        ));

        if ($log_id) {
            update_post_meta($log_id, '_source', $source);
            update_post_meta($log_id, '_identifier', $identifier);
            update_post_meta($log_id, '_status', $status);
            update_post_meta($log_id, '_timestamp', current_time('mysql'));
            update_post_meta($log_id, '_ip_address', $_SERVER['REMOTE_ADDR']);
        }
    }

    /**
     * Hourly API Sync
     */
    public function hourly_api_sync() {
        // Update market data
        $this->update_market_data();

        // Clean up old cache
        $this->cleanup_old_cache();

        // Reset rate limits
        $this->reset_rate_limits();
    }

    private function update_market_data() {
        // Update risk-free rate
        $risk_free_rate = $this->get_risk_free_rate();
        if ($risk_free_rate) {
            update_option('current_risk_free_rate', $risk_free_rate);
        }
    }

    private function cleanup_old_cache() {
        $old_cache = get_posts(array(
            'post_type' => 'market_data',
            'posts_per_page' => -1,
            'date_query' => array(
                array(
                    'before' => '7 days ago'
                )
            )
        ));

        foreach ($old_cache as $cache_item) {
            wp_delete_post($cache_item->ID, true);
        }
    }

    private function reset_rate_limits() {
        foreach (array_keys($this->api_endpoints) as $source) {
            delete_transient('rate_limit_' . $source);
        }
    }

    // Placeholder methods for additional integrations
    private function validate_ein_with_irs($ein, $company_name) {
        // Simplified validation - in production, use actual IRS API
        return array(
            'valid' => true,
            'company_match' => true,
            'status' => 'active'
        );
    }

    private function fetch_industry_benchmarks($source, $industry_code, $metrics) {
        // Implementation for fetching industry benchmarks
        return array();
    }

    private function aggregate_benchmarks($benchmarks, $metrics) {
        // Implementation for aggregating benchmark data
        return array();
    }

    private function sync_quickbooks_data($company_id) {
        // Implementation for QuickBooks sync
        return array();
    }

    private function store_financial_data($company_id, $financial_data, $system) {
        // Implementation for storing financial data
    }
}

// Initialize API integrations
$bridgeland_api_integrations = new BridgelandAPIIntegrations();
$bridgeland_api_integrations->__init();

// API Settings
function bridgeland_api_settings() {
    add_settings_section('bridgeland_apis', 'API Integration Settings', null, 'bridgeland_settings');

    // Data Provider APIs
    add_settings_field('clearbit_api_key', 'Clearbit API Key', 'bridgeland_clearbit_key_field', 'bridgeland_settings', 'bridgeland_apis');
    add_settings_field('crunchbase_api_key', 'Crunchbase API Key', 'bridgeland_crunchbase_key_field', 'bridgeland_settings', 'bridgeland_apis');
    add_settings_field('alpha_vantage_api_key', 'Alpha Vantage API Key', 'bridgeland_alpha_vantage_key_field', 'bridgeland_settings', 'bridgeland_apis');
    add_settings_field('sec_api_key', 'SEC API Key', 'bridgeland_sec_api_key_field', 'bridgeland_settings', 'bridgeland_apis');
}
add_action('admin_init', 'bridgeland_api_settings');

function bridgeland_clearbit_key_field() {
    $value = get_option('clearbit_api_key', '');
    echo '<input type="password" name="clearbit_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
}

function bridgeland_crunchbase_key_field() {
    $value = get_option('crunchbase_api_key', '');
    echo '<input type="password" name="crunchbase_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
}

function bridgeland_alpha_vantage_key_field() {
    $value = get_option('alpha_vantage_api_key', '');
    echo '<input type="password" name="alpha_vantage_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
}

function bridgeland_sec_api_key_field() {
    $value = get_option('sec_api_key', '');
    echo '<input type="password" name="sec_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
}
?>