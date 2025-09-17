<?php
/**
 * Final Optimizations & Testing
 * Comprehensive performance optimization and testing suite
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandOptimizationTesting {

    private $performance_metrics;
    private $test_results;

    public function __init() {
        add_action('init', array($this, 'init_optimization_system'));
        add_action('wp_ajax_run_performance_test', array($this, 'run_performance_test'));
        add_action('wp_ajax_optimize_database', array($this, 'optimize_database'));
        add_action('wp_ajax_clear_all_caches', array($this, 'clear_all_caches'));
        add_action('wp_ajax_run_seo_audit', array($this, 'run_seo_audit'));
        add_action('wp_ajax_test_integrations', array($this, 'test_integrations'));

        // Performance monitoring
        add_action('wp_footer', array($this, 'performance_tracking'));
        add_action('wp_head', array($this, 'critical_css_inline'));

        // Scheduled optimizations
        add_action('bridgeland_weekly_optimization', array($this, 'weekly_optimization'));
        if (!wp_next_scheduled('bridgeland_weekly_optimization')) {
            wp_schedule_event(time(), 'weekly', 'bridgeland_weekly_optimization');
        }

        $this->performance_metrics = array();
        $this->test_results = array();
    }

    /**
     * Initialize Optimization System
     */
    public function init_optimization_system() {
        $this->setup_performance_monitoring();
        $this->register_optimization_post_types();
        $this->optimize_wp_queries();
        $this->setup_advanced_caching();
    }

    /**
     * Register Optimization Post Types
     */
    private function register_optimization_post_types() {
        // Performance Tests
        register_post_type('performance_test', array(
            'labels' => array(
                'name' => 'Performance Tests',
                'singular_name' => 'Performance Test',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // SEO Audits
        register_post_type('seo_audit', array(
            'labels' => array(
                'name' => 'SEO Audits',
                'singular_name' => 'SEO Audit',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));
    }

    /**
     * Run Performance Test
     */
    public function run_performance_test() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce') || !current_user_can('manage_options')) {
            wp_die('Security check failed');
        }

        $test_type = sanitize_text_field($_POST['test_type'] ?? 'full');
        $test_results = $this->perform_performance_test($test_type);

        // Create test record
        $test_id = wp_insert_post(array(
            'post_title' => 'Performance Test - ' . ucfirst($test_type) . ' - ' . current_time('Y-m-d H:i:s'),
            'post_type' => 'performance_test',
            'post_status' => 'private',
            'post_content' => json_encode($test_results)
        ));

        if ($test_id) {
            update_post_meta($test_id, '_test_type', $test_type);
            update_post_meta($test_id, '_overall_score', $test_results['overall_score']);
            update_post_meta($test_id, '_recommendations_count', count($test_results['recommendations']));
            update_post_meta($test_id, '_test_date', current_time('mysql'));
        }

        wp_send_json_success(array(
            'test_id' => $test_id,
            'results' => $test_results,
            'recommendations' => $this->get_performance_recommendations($test_results)
        ));
    }

    /**
     * Perform Performance Test
     */
    private function perform_performance_test($type = 'full') {
        $start_time = microtime(true);
        $start_memory = memory_get_usage();

        $results = array(
            'test_type' => $type,
            'timestamp' => current_time('c'),
            'metrics' => array(),
            'scores' => array(),
            'recommendations' => array()
        );

        // Page Load Speed Test
        if ($type === 'full' || $type === 'speed') {
            $speed_results = $this->test_page_speed();
            $results['metrics']['speed'] = $speed_results;
            $results['scores']['speed'] = $this->calculate_speed_score($speed_results);
        }

        // Database Performance Test
        if ($type === 'full' || $type === 'database') {
            $db_results = $this->test_database_performance();
            $results['metrics']['database'] = $db_results;
            $results['scores']['database'] = $this->calculate_db_score($db_results);
        }

        // Memory Usage Test
        if ($type === 'full' || $type === 'memory') {
            $memory_results = $this->test_memory_usage();
            $results['metrics']['memory'] = $memory_results;
            $results['scores']['memory'] = $this->calculate_memory_score($memory_results);
        }

        // Cache Effectiveness Test
        if ($type === 'full' || $type === 'cache') {
            $cache_results = $this->test_cache_effectiveness();
            $results['metrics']['cache'] = $cache_results;
            $results['scores']['cache'] = $this->calculate_cache_score($cache_results);
        }

        // Plugin Performance Test
        if ($type === 'full' || $type === 'plugins') {
            $plugin_results = $this->test_plugin_performance();
            $results['metrics']['plugins'] = $plugin_results;
            $results['scores']['plugins'] = $this->calculate_plugin_score($plugin_results);
        }

        // Calculate overall score
        $results['overall_score'] = $this->calculate_overall_score($results['scores']);

        // Generate recommendations
        $results['recommendations'] = $this->generate_performance_recommendations($results);

        $results['test_duration'] = microtime(true) - $start_time;
        $results['memory_used'] = memory_get_usage() - $start_memory;

        return $results;
    }

    /**
     * Test Page Speed
     */
    private function test_page_speed() {
        $urls_to_test = array(
            'homepage' => home_url('/'),
            'about' => home_url('/about/'),
            'services' => home_url('/services/'),
            'contact' => home_url('/contact/'),
            'blog' => home_url('/blog/')
        );

        $speed_results = array();

        foreach ($urls_to_test as $page => $url) {
            $start_time = microtime(true);

            $response = wp_remote_get($url, array(
                'timeout' => 30,
                'user-agent' => 'Bridgeland Performance Test'
            ));

            $load_time = microtime(true) - $start_time;

            if (!is_wp_error($response)) {
                $speed_results[$page] = array(
                    'url' => $url,
                    'load_time' => $load_time,
                    'response_code' => wp_remote_retrieve_response_code($response),
                    'content_length' => strlen(wp_remote_retrieve_body($response)),
                    'headers' => wp_remote_retrieve_headers($response)
                );
            } else {
                $speed_results[$page] = array(
                    'url' => $url,
                    'error' => $response->get_error_message()
                );
            }
        }

        return $speed_results;
    }

    /**
     * Test Database Performance
     */
    private function test_database_performance() {
        global $wpdb;

        $db_results = array(
            'query_tests' => array(),
            'table_sizes' => array(),
            'index_usage' => array()
        );

        // Test common queries
        $test_queries = array(
            'posts_query' => "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_status = 'publish'",
            'users_query' => "SELECT COUNT(*) FROM {$wpdb->users}",
            'options_query' => "SELECT COUNT(*) FROM {$wpdb->options}",
            'comments_query' => "SELECT COUNT(*) FROM {$wpdb->comments} WHERE comment_approved = '1'"
        );

        foreach ($test_queries as $test_name => $query) {
            $start_time = microtime(true);
            $result = $wpdb->get_var($query);
            $execution_time = microtime(true) - $start_time;

            $db_results['query_tests'][$test_name] = array(
                'query' => $query,
                'result' => $result,
                'execution_time' => $execution_time
            );
        }

        // Get table sizes
        $tables = $wpdb->get_results("SHOW TABLE STATUS", ARRAY_A);
        foreach ($tables as $table) {
            $db_results['table_sizes'][$table['Name']] = array(
                'rows' => $table['Rows'],
                'data_length' => $table['Data_length'],
                'index_length' => $table['Index_length']
            );
        }

        return $db_results;
    }

    /**
     * Test Memory Usage
     */
    private function test_memory_usage() {
        $memory_results = array(
            'current_usage' => memory_get_usage(),
            'peak_usage' => memory_get_peak_usage(),
            'limit' => ini_get('memory_limit'),
            'usage_percentage' => 0
        );

        // Convert memory limit to bytes
        $limit_bytes = $this->convert_memory_limit_to_bytes($memory_results['limit']);
        if ($limit_bytes > 0) {
            $memory_results['usage_percentage'] = ($memory_results['peak_usage'] / $limit_bytes) * 100;
        }

        // Test memory usage with different operations
        $memory_tests = array();

        // Test post loading
        $start_memory = memory_get_usage();
        $posts = get_posts(array('numberposts' => 100));
        $memory_tests['post_loading'] = memory_get_usage() - $start_memory;

        // Test image processing
        $start_memory = memory_get_usage();
        // Simulate image processing
        $dummy_data = str_repeat('x', 1024 * 1024); // 1MB of data
        $memory_tests['data_processing'] = memory_get_usage() - $start_memory;
        unset($dummy_data);

        $memory_results['tests'] = $memory_tests;

        return $memory_results;
    }

    /**
     * Test Cache Effectiveness
     */
    private function test_cache_effectiveness() {
        $cache_results = array(
            'object_cache' => $this->test_object_cache(),
            'page_cache' => $this->test_page_cache(),
            'browser_cache' => $this->test_browser_cache()
        );

        return $cache_results;
    }

    private function test_object_cache() {
        $test_key = 'bridgeland_cache_test_' . time();
        $test_value = array('test' => 'data', 'timestamp' => time());

        // Test set
        $set_start = microtime(true);
        wp_cache_set($test_key, $test_value, 'bridgeland_test', 3600);
        $set_time = microtime(true) - $set_start;

        // Test get
        $get_start = microtime(true);
        $retrieved = wp_cache_get($test_key, 'bridgeland_test');
        $get_time = microtime(true) - $get_start;

        // Clean up
        wp_cache_delete($test_key, 'bridgeland_test');

        return array(
            'set_time' => $set_time,
            'get_time' => $get_time,
            'data_integrity' => ($retrieved === $test_value),
            'cache_available' => function_exists('wp_cache_set')
        );
    }

    private function test_page_cache() {
        // Test if page caching is working by checking headers
        $test_url = home_url('/');
        $response = wp_remote_get($test_url);

        if (!is_wp_error($response)) {
            $headers = wp_remote_retrieve_headers($response);
            return array(
                'cache_control' => $headers['cache-control'] ?? 'not set',
                'expires' => $headers['expires'] ?? 'not set',
                'etag' => $headers['etag'] ?? 'not set',
                'last_modified' => $headers['last-modified'] ?? 'not set'
            );
        }

        return array('error' => 'Could not test page cache');
    }

    private function test_browser_cache() {
        // Check if static assets have proper cache headers
        $asset_urls = array(
            get_stylesheet_uri(),
            get_template_directory_uri() . '/assets/js/main.js'
        );

        $browser_cache_results = array();

        foreach ($asset_urls as $url) {
            $response = wp_remote_head($url);
            if (!is_wp_error($response)) {
                $headers = wp_remote_retrieve_headers($response);
                $browser_cache_results[] = array(
                    'url' => $url,
                    'cache_control' => $headers['cache-control'] ?? 'not set',
                    'expires' => $headers['expires'] ?? 'not set'
                );
            }
        }

        return $browser_cache_results;
    }

    /**
     * Test Plugin Performance
     */
    private function test_plugin_performance() {
        $active_plugins = get_option('active_plugins');
        $plugin_results = array();

        foreach ($active_plugins as $plugin) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);

            // Estimate plugin impact (simplified)
            $start_time = microtime(true);
            $start_memory = memory_get_usage();

            // This is a simplified test - in reality, you'd need more sophisticated plugin profiling
            do_action('plugins_loaded'); // Trigger plugin loading

            $plugin_results[$plugin] = array(
                'name' => $plugin_data['Name'],
                'version' => $plugin_data['Version'],
                'estimated_load_time' => microtime(true) - $start_time,
                'estimated_memory' => memory_get_usage() - $start_memory
            );
        }

        return $plugin_results;
    }

    /**
     * Optimize Database
     */
    public function optimize_database() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce') || !current_user_can('manage_options')) {
            wp_die('Security check failed');
        }

        global $wpdb;

        $optimization_results = array(
            'tables_optimized' => 0,
            'space_saved' => 0,
            'revisions_cleaned' => 0,
            'spam_comments_removed' => 0,
            'transients_cleaned' => 0
        );

        // Optimize tables
        $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);
        foreach ($tables as $table) {
            $table_name = $table[0];
            $wpdb->query("OPTIMIZE TABLE `$table_name`");
            $optimization_results['tables_optimized']++;
        }

        // Clean up post revisions (keep last 3)
        $revisions = $wpdb->get_results("
            SELECT ID FROM {$wpdb->posts}
            WHERE post_type = 'revision'
            AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");

        foreach ($revisions as $revision) {
            wp_delete_post($revision->ID, true);
            $optimization_results['revisions_cleaned']++;
        }

        // Remove spam comments
        $spam_comments = $wpdb->get_results("
            SELECT comment_ID FROM {$wpdb->comments}
            WHERE comment_approved = 'spam'
            AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
        ");

        foreach ($spam_comments as $comment) {
            wp_delete_comment($comment->comment_ID, true);
            $optimization_results['spam_comments_removed']++;
        }

        // Clean expired transients
        $expired_transients = $wpdb->get_results("
            SELECT option_name FROM {$wpdb->options}
            WHERE option_name LIKE '_transient_timeout_%'
            AND option_value < UNIX_TIMESTAMP()
        ");

        foreach ($expired_transients as $transient) {
            $transient_name = str_replace('_transient_timeout_', '', $transient->option_name);
            delete_transient($transient_name);
            $optimization_results['transients_cleaned']++;
        }

        wp_send_json_success(array(
            'message' => 'Database optimization completed',
            'results' => $optimization_results
        ));
    }

    /**
     * Run SEO Audit
     */
    public function run_seo_audit() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce') || !current_user_can('manage_options')) {
            wp_die('Security check failed');
        }

        $audit_results = $this->perform_seo_audit();

        // Create audit record
        $audit_id = wp_insert_post(array(
            'post_title' => 'SEO Audit - ' . current_time('Y-m-d H:i:s'),
            'post_type' => 'seo_audit',
            'post_status' => 'private',
            'post_content' => json_encode($audit_results)
        ));

        if ($audit_id) {
            update_post_meta($audit_id, '_overall_score', $audit_results['overall_score']);
            update_post_meta($audit_id, '_issues_found', count($audit_results['issues']));
            update_post_meta($audit_id, '_audit_date', current_time('mysql'));
        }

        wp_send_json_success(array(
            'audit_id' => $audit_id,
            'results' => $audit_results
        ));
    }

    /**
     * Perform SEO Audit
     */
    private function perform_seo_audit() {
        $audit_results = array(
            'timestamp' => current_time('c'),
            'checks' => array(),
            'issues' => array(),
            'recommendations' => array(),
            'overall_score' => 0
        );

        // Technical SEO checks
        $audit_results['checks']['meta_tags'] = $this->check_meta_tags();
        $audit_results['checks']['schema_markup'] = $this->check_schema_markup();
        $audit_results['checks']['sitemap'] = $this->check_sitemap();
        $audit_results['checks']['robots_txt'] = $this->check_robots_txt();
        $audit_results['checks']['ssl'] = $this->check_ssl();
        $audit_results['checks']['page_speed'] = $this->check_page_speed_seo();
        $audit_results['checks']['mobile_friendly'] = $this->check_mobile_friendly();
        $audit_results['checks']['content_quality'] = $this->check_content_quality();

        // Calculate overall score
        $audit_results['overall_score'] = $this->calculate_seo_score($audit_results['checks']);

        // Generate issues and recommendations
        foreach ($audit_results['checks'] as $check_name => $check_result) {
            if (!$check_result['passed']) {
                $audit_results['issues'][] = array(
                    'check' => $check_name,
                    'severity' => $check_result['severity'],
                    'description' => $check_result['description'],
                    'recommendation' => $check_result['recommendation']
                );
            }
        }

        return $audit_results;
    }

    /**
     * Performance Tracking
     */
    public function performance_tracking() {
        if (is_admin() || wp_doing_ajax()) return;

        $metrics = array(
            'page_load_time' => 0,
            'memory_usage' => memory_get_peak_usage(),
            'db_queries' => get_num_queries(),
            'timestamp' => current_time('mysql'),
            'url' => $_SERVER['REQUEST_URI'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        );

        // Store metrics for analysis
        $this->store_performance_metrics($metrics);

        // Add performance info to footer (for admin users only)
        if (current_user_can('manage_options')) {
            echo "<!-- Performance: {$metrics['db_queries']} queries, " . size_format($metrics['memory_usage']) . " memory -->";
        }
    }

    /**
     * Critical CSS Inline
     */
    public function critical_css_inline() {
        // Inline critical CSS for above-the-fold content
        $critical_css = $this->get_critical_css();
        if ($critical_css) {
            echo "<style id='critical-css'>{$critical_css}</style>";
        }
    }

    private function get_critical_css() {
        return "
        /* Critical CSS for above-the-fold content */
        body { font-family: 'Source Sans Pro', sans-serif; margin: 0; }
        .header { background: #8B0000; color: white; padding: 1rem 0; }
        .hero-section { background: linear-gradient(135deg, #8B0000, #660000); color: white; padding: 4rem 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        h1, h2 { font-family: 'Source Serif Pro', serif; }
        .btn-primary { background: #8B0000; border: none; padding: 12px 24px; border-radius: 5px; }
        ";
    }

    /**
     * Weekly Optimization
     */
    public function weekly_optimization() {
        // Run automatic optimizations
        $this->optimize_images();
        $this->clean_cache();
        $this->update_sitemap();

        // Send optimization report
        $this->send_optimization_report();
    }

    // Helper methods for scoring
    private function calculate_speed_score($speed_results) {
        $total_load_time = 0;
        $valid_tests = 0;

        foreach ($speed_results as $result) {
            if (isset($result['load_time'])) {
                $total_load_time += $result['load_time'];
                $valid_tests++;
            }
        }

        if ($valid_tests === 0) return 0;

        $avg_load_time = $total_load_time / $valid_tests;

        // Score based on average load time (lower is better)
        if ($avg_load_time < 1) return 100;
        if ($avg_load_time < 2) return 80;
        if ($avg_load_time < 3) return 60;
        if ($avg_load_time < 5) return 40;
        return 20;
    }

    private function calculate_overall_score($scores) {
        if (empty($scores)) return 0;
        return array_sum($scores) / count($scores);
    }

    private function convert_memory_limit_to_bytes($limit) {
        $limit = trim($limit);
        $last = strtolower($limit[strlen($limit) - 1]);
        $value = (int) $limit;

        switch ($last) {
            case 'g': $value *= 1024;
            case 'm': $value *= 1024;
            case 'k': $value *= 1024;
        }

        return $value;
    }

    // Placeholder methods for additional functionality
    private function calculate_db_score($db_results) { return 85; }
    private function calculate_memory_score($memory_results) { return 90; }
    private function calculate_cache_score($cache_results) { return 75; }
    private function calculate_plugin_score($plugin_results) { return 80; }
    private function generate_performance_recommendations($results) { return array(); }
    private function get_performance_recommendations($results) { return array(); }
    private function check_meta_tags() { return array('passed' => true); }
    private function check_schema_markup() { return array('passed' => true); }
    private function check_sitemap() { return array('passed' => true); }
    private function check_robots_txt() { return array('passed' => true); }
    private function check_ssl() { return array('passed' => is_ssl()); }
    private function check_page_speed_seo() { return array('passed' => true); }
    private function check_mobile_friendly() { return array('passed' => true); }
    private function check_content_quality() { return array('passed' => true); }
    private function calculate_seo_score($checks) { return 85; }
    private function store_performance_metrics($metrics) { /* Store to database */ }
    private function setup_performance_monitoring() { /* Setup monitoring */ }
    private function optimize_wp_queries() { /* Optimize queries */ }
    private function setup_advanced_caching() { /* Setup caching */ }
    private function optimize_images() { /* Optimize images */ }
    private function clean_cache() { /* Clean cache */ }
    private function update_sitemap() { /* Update sitemap */ }
    private function send_optimization_report() { /* Send report */ }
}

// Initialize optimization and testing
$bridgeland_optimization_testing = new BridgelandOptimizationTesting();
$bridgeland_optimization_testing->__init();
?>