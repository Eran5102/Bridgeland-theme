<?php
/**
 * CRM Integration System
 * Comprehensive client relationship management and automation
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandCRM {

    private $api_endpoints;
    private $webhook_handlers;

    public function __init() {
        add_action('init', array($this, 'init_crm_system'));
        add_action('wp_ajax_sync_crm_data', array($this, 'sync_crm_data'));
        add_action('wp_ajax_create_crm_contact', array($this, 'create_crm_contact'));
        add_action('wp_ajax_update_lead_status', array($this, 'update_lead_status'));
        add_action('user_register', array($this, 'auto_create_crm_contact'));
        add_action('bridgeland_payment_completed', array($this, 'update_crm_opportunity'));
        add_action('bridgeland_project_status_changed', array($this, 'sync_project_status'));

        // Webhook handlers
        add_action('init', array($this, 'handle_crm_webhooks'));

        // Scheduled tasks
        add_action('bridgeland_daily_crm_sync', array($this, 'daily_crm_sync'));
        if (!wp_next_scheduled('bridgeland_daily_crm_sync')) {
            wp_schedule_event(time(), 'daily', 'bridgeland_daily_crm_sync');
        }
    }

    /**
     * Initialize CRM System
     */
    public function init_crm_system() {
        $this->setup_api_endpoints();
        $this->register_crm_post_types();
        $this->setup_webhook_handlers();
    }

    /**
     * Setup Webhook Handlers
     */
    private function setup_webhook_handlers() {
        $this->webhook_handlers = array(
            'contact_updated' => array($this, 'handle_contact_update_webhook'),
            'deal_stage_changed' => array($this, 'handle_deal_stage_webhook'),
            'contact_deleted' => array($this, 'handle_contact_deletion_webhook')
        );
    }

    /**
     * Setup API Endpoints for Popular CRMs
     */
    private function setup_api_endpoints() {
        $this->api_endpoints = array(
            'hubspot' => array(
                'base_url' => 'https://api.hubapi.com',
                'contacts' => '/crm/v3/objects/contacts',
                'deals' => '/crm/v3/objects/deals',
                'companies' => '/crm/v3/objects/companies',
                'auth_header' => 'Authorization: Bearer ' . get_option('hubspot_api_key')
            ),
            'salesforce' => array(
                'base_url' => get_option('salesforce_instance_url', 'https://bridgeland.salesforce.com'),
                'contacts' => '/services/data/v57.0/sobjects/Contact',
                'opportunities' => '/services/data/v57.0/sobjects/Opportunity',
                'accounts' => '/services/data/v57.0/sobjects/Account',
                'auth_header' => 'Authorization: Bearer ' . get_option('salesforce_access_token')
            ),
            'pipedrive' => array(
                'base_url' => 'https://api.pipedrive.com/v1',
                'persons' => '/persons',
                'deals' => '/deals',
                'organizations' => '/organizations',
                'auth_param' => '?api_token=' . get_option('pipedrive_api_key')
            )
        );
    }

    /**
     * Register CRM-Related Post Types
     */
    private function register_crm_post_types() {
        // CRM Contacts
        register_post_type('crm_contact', array(
            'labels' => array(
                'name' => 'CRM Contacts',
                'singular_name' => 'CRM Contact',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // CRM Opportunities
        register_post_type('crm_opportunity', array(
            'labels' => array(
                'name' => 'CRM Opportunities',
                'singular_name' => 'CRM Opportunity',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Lead Scoring
        register_post_type('lead_score', array(
            'labels' => array(
                'name' => 'Lead Scores',
                'singular_name' => 'Lead Score',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));
    }

    /**
     * Create CRM Contact
     */
    public function create_crm_contact($user_data = null) {
        if (!$user_data && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            $user_data = array(
                'email' => sanitize_email($_POST['email']),
                'first_name' => sanitize_text_field($_POST['first_name']),
                'last_name' => sanitize_text_field($_POST['last_name']),
                'company' => sanitize_text_field($_POST['company']),
                'phone' => sanitize_text_field($_POST['phone']),
                'source' => sanitize_text_field($_POST['source'] ?? 'Website')
            );
        }

        if (!$user_data) {
            wp_send_json_error('Invalid user data');
            return;
        }

        $crm_system = get_option('active_crm_system', 'hubspot');
        $result = false;

        switch ($crm_system) {
            case 'hubspot':
                $result = $this->create_hubspot_contact($user_data);
                break;
            case 'salesforce':
                $result = $this->create_salesforce_contact($user_data);
                break;
            case 'pipedrive':
                $result = $this->create_pipedrive_contact($user_data);
                break;
        }

        if ($result) {
            // Store local CRM contact record
            $contact_id = wp_insert_post(array(
                'post_title' => $user_data['first_name'] . ' ' . $user_data['last_name'],
                'post_type' => 'crm_contact',
                'post_status' => 'publish'
            ));

            if ($contact_id) {
                update_post_meta($contact_id, '_crm_system', $crm_system);
                update_post_meta($contact_id, '_crm_id', $result['id']);
                update_post_meta($contact_id, '_email', $user_data['email']);
                update_post_meta($contact_id, '_company', $user_data['company']);
                update_post_meta($contact_id, '_phone', $user_data['phone']);
                update_post_meta($contact_id, '_source', $user_data['source']);
                update_post_meta($contact_id, '_created_date', current_time('mysql'));
                update_post_meta($contact_id, '_lead_score', $this->calculate_lead_score($user_data));
            }

            if (isset($_POST['nonce'])) {
                wp_send_json_success(array(
                    'message' => 'Contact created successfully',
                    'crm_id' => $result['id'],
                    'local_id' => $contact_id
                ));
            }
            return $result;
        } else {
            if (isset($_POST['nonce'])) {
                wp_send_json_error('Failed to create CRM contact');
            }
            return false;
        }
    }

    /**
     * HubSpot Integration
     */
    private function create_hubspot_contact($user_data) {
        $api_key = get_option('hubspot_api_key');
        if (!$api_key) return false;

        $contact_data = array(
            'properties' => array(
                'email' => $user_data['email'],
                'firstname' => $user_data['first_name'],
                'lastname' => $user_data['last_name'],
                'company' => $user_data['company'],
                'phone' => $user_data['phone'],
                'hs_lead_status' => 'NEW',
                'lifecyclestage' => 'lead',
                'lead_source' => $user_data['source']
            )
        );

        $response = wp_remote_post($this->api_endpoints['hubspot']['base_url'] . $this->api_endpoints['hubspot']['contacts'], array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key
            ),
            'body' => json_encode($contact_data),
            'timeout' => 30
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 201) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            return array('id' => $body['id'], 'system' => 'hubspot');
        }

        return false;
    }

    /**
     * Salesforce Integration
     */
    private function create_salesforce_contact($user_data) {
        $access_token = get_option('salesforce_access_token');
        $instance_url = get_option('salesforce_instance_url');

        if (!$access_token || !$instance_url) return false;

        $contact_data = array(
            'FirstName' => $user_data['first_name'],
            'LastName' => $user_data['last_name'],
            'Email' => $user_data['email'],
            'Phone' => $user_data['phone'],
            'Company' => $user_data['company'],
            'LeadSource' => $user_data['source'],
            'Status' => 'Open - Not Contacted'
        );

        $response = wp_remote_post($instance_url . $this->api_endpoints['salesforce']['contacts'], array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token
            ),
            'body' => json_encode($contact_data),
            'timeout' => 30
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 201) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            return array('id' => $body['id'], 'system' => 'salesforce');
        }

        return false;
    }

    /**
     * Pipedrive Integration
     */
    private function create_pipedrive_contact($user_data) {
        $api_key = get_option('pipedrive_api_key');
        if (!$api_key) return false;

        $person_data = array(
            'name' => $user_data['first_name'] . ' ' . $user_data['last_name'],
            'email' => array($user_data['email']),
            'phone' => array($user_data['phone']),
            'org_name' => $user_data['company']
        );

        $response = wp_remote_post($this->api_endpoints['pipedrive']['base_url'] . $this->api_endpoints['pipedrive']['persons'] . $this->api_endpoints['pipedrive']['auth_param'], array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => json_encode($person_data),
            'timeout' => 30
        ));

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 201) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            return array('id' => $body['data']['id'], 'system' => 'pipedrive');
        }

        return false;
    }

    /**
     * Calculate Lead Score
     */
    private function calculate_lead_score($user_data) {
        $score = 0;

        // Email domain scoring
        $email_domain = substr(strrchr($user_data['email'], "@"), 1);
        $business_domains = array('gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com');

        if (!in_array($email_domain, $business_domains)) {
            $score += 20; // Business email
        }

        // Company provided
        if (!empty($user_data['company'])) {
            $score += 25;
        }

        // Phone provided
        if (!empty($user_data['phone'])) {
            $score += 15;
        }

        // Source scoring
        $source_scores = array(
            'Referral' => 30,
            'LinkedIn' => 25,
            'Google Search' => 20,
            'Website' => 15,
            'Social Media' => 10
        );

        $score += $source_scores[$user_data['source']] ?? 10;

        return min($score, 100); // Cap at 100
    }

    /**
     * Auto-create CRM Contact on User Registration
     */
    public function auto_create_crm_contact($user_id) {
        $user = get_userdata($user_id);
        if (!$user) return;

        $user_data = array(
            'email' => $user->user_email,
            'first_name' => get_user_meta($user_id, 'first_name', true) ?: $user->display_name,
            'last_name' => get_user_meta($user_id, 'last_name', true) ?: '',
            'company' => get_user_meta($user_id, 'company_name', true) ?: '',
            'phone' => get_user_meta($user_id, 'phone', true) ?: '',
            'source' => 'Website Registration'
        );

        $this->create_crm_contact($user_data);
    }

    /**
     * Update CRM Opportunity on Payment
     */
    public function update_crm_opportunity($payment_data) {
        $crm_system = get_option('active_crm_system', 'hubspot');

        // Find CRM contact
        $contact = $this->find_crm_contact_by_email($payment_data['client_email']);
        if (!$contact) return;

        $opportunity_data = array(
            'contact_id' => $contact['crm_id'],
            'amount' => $payment_data['amount'],
            'service_type' => $payment_data['service_type'],
            'stage' => 'Closed Won',
            'close_date' => current_time('Y-m-d')
        );

        switch ($crm_system) {
            case 'hubspot':
                $this->create_hubspot_deal($opportunity_data);
                break;
            case 'salesforce':
                $this->create_salesforce_opportunity($opportunity_data);
                break;
            case 'pipedrive':
                $this->create_pipedrive_deal($opportunity_data);
                break;
        }
    }

    /**
     * Daily CRM Sync
     */
    public function daily_crm_sync() {
        $this->sync_contact_updates();
        $this->update_lead_scores();
        $this->cleanup_old_sync_data();

        // Log sync activity
        error_log('Bridgeland CRM: Daily sync completed at ' . current_time('c'));
    }

    /**
     * Handle CRM Webhooks
     */
    public function handle_crm_webhooks() {
        if (isset($_GET['bridgeland_crm_webhook'])) {
            $webhook_type = sanitize_text_field($_GET['bridgeland_crm_webhook']);
            $crm_system = sanitize_text_field($_GET['crm_system'] ?? '');

            if (!$this->verify_webhook_signature($crm_system)) {
                http_response_code(401);
                exit('Unauthorized');
            }

            $payload = json_decode(file_get_contents('php://input'), true);

            switch ($webhook_type) {
                case 'contact_updated':
                    $this->handle_contact_update_webhook($payload, $crm_system);
                    break;
                case 'deal_stage_changed':
                    $this->handle_deal_stage_webhook($payload, $crm_system);
                    break;
                case 'contact_deleted':
                    $this->handle_contact_deletion_webhook($payload, $crm_system);
                    break;
            }

            http_response_code(200);
            exit('OK');
        }
    }

    /**
     * Sync CRM Data
     */
    public function sync_crm_data() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $sync_type = sanitize_text_field($_POST['sync_type']);
        $results = array();

        switch ($sync_type) {
            case 'contacts':
                $results = $this->sync_all_contacts();
                break;
            case 'opportunities':
                $results = $this->sync_all_opportunities();
                break;
            case 'full':
                $results['contacts'] = $this->sync_all_contacts();
                $results['opportunities'] = $this->sync_all_opportunities();
                break;
        }

        wp_send_json_success(array(
            'message' => 'CRM sync completed successfully',
            'results' => $results,
            'timestamp' => current_time('c')
        ));
    }

    /**
     * Update Lead Status
     */
    public function update_lead_status() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $contact_id = intval($_POST['contact_id']);
        $status = sanitize_text_field($_POST['status']);
        $notes = sanitize_textarea_field($_POST['notes']);

        $contact = get_post($contact_id);
        if (!$contact || $contact->post_type !== 'crm_contact') {
            wp_send_json_error('Invalid contact');
        }

        // Update local status
        update_post_meta($contact_id, '_lead_status', $status);
        update_post_meta($contact_id, '_status_notes', $notes);
        update_post_meta($contact_id, '_last_updated', current_time('mysql'));

        // Update CRM system
        $crm_id = get_post_meta($contact_id, '_crm_id', true);
        $crm_system = get_post_meta($contact_id, '_crm_system', true);

        if ($crm_id && $crm_system) {
            $this->update_crm_contact_status($crm_id, $crm_system, $status);
        }

        wp_send_json_success('Lead status updated successfully');
    }

    /**
     * Helper Methods
     */
    private function find_crm_contact_by_email($email) {
        $contacts = get_posts(array(
            'post_type' => 'crm_contact',
            'meta_query' => array(
                array(
                    'key' => '_email',
                    'value' => $email,
                    'compare' => '='
                )
            )
        ));

        if (!empty($contacts)) {
            $contact = $contacts[0];
            return array(
                'id' => $contact->ID,
                'crm_id' => get_post_meta($contact->ID, '_crm_id', true),
                'crm_system' => get_post_meta($contact->ID, '_crm_system', true)
            );
        }

        return null;
    }

    private function verify_webhook_signature($crm_system) {
        // Implement signature verification based on CRM system
        return true; // Simplified for demo
    }

    private function sync_all_contacts() {
        // Implementation for syncing all contacts
        return array('synced' => 0, 'errors' => 0);
    }

    private function sync_all_opportunities() {
        // Implementation for syncing all opportunities
        return array('synced' => 0, 'errors' => 0);
    }

    private function update_crm_contact_status($crm_id, $crm_system, $status) {
        // Implementation for updating contact status in CRM
        return true;
    }

    /**
     * Webhook Handler Methods
     */
    private function handle_contact_update_webhook($payload, $crm_system) {
        // Handle contact update webhook
        if (!empty($payload['contact_id'])) {
            $this->sync_contact_from_crm($payload['contact_id'], $crm_system);
        }
    }

    private function handle_deal_stage_webhook($payload, $crm_system) {
        // Handle deal stage change webhook
        if (!empty($payload['deal_id'])) {
            $this->sync_deal_from_crm($payload['deal_id'], $crm_system);
        }
    }

    private function handle_contact_deletion_webhook($payload, $crm_system) {
        // Handle contact deletion webhook
        if (!empty($payload['contact_id'])) {
            $this->remove_local_contact($payload['contact_id'], $crm_system);
        }
    }

    private function sync_contact_from_crm($crm_contact_id, $crm_system) {
        // Implementation for syncing contact from CRM
        return true;
    }

    private function sync_deal_from_crm($crm_deal_id, $crm_system) {
        // Implementation for syncing deal from CRM
        return true;
    }

    private function remove_local_contact($crm_contact_id, $crm_system) {
        // Implementation for removing local contact
        return true;
    }
}

// Initialize CRM system
$bridgeland_crm = new BridgelandCRM();
$bridgeland_crm->__init();

// CRM Configuration Options
function bridgeland_crm_settings() {
    add_settings_section('bridgeland_crm', 'CRM Integration Settings', null, 'bridgeland_settings');

    add_settings_field('active_crm_system', 'Active CRM System', 'bridgeland_crm_system_field', 'bridgeland_settings', 'bridgeland_crm');
    add_settings_field('hubspot_api_key', 'HubSpot API Key', 'bridgeland_hubspot_key_field', 'bridgeland_settings', 'bridgeland_crm');
    add_settings_field('salesforce_config', 'Salesforce Configuration', 'bridgeland_salesforce_config_field', 'bridgeland_settings', 'bridgeland_crm');
    add_settings_field('pipedrive_api_key', 'Pipedrive API Key', 'bridgeland_pipedrive_key_field', 'bridgeland_settings', 'bridgeland_crm');
}
add_action('admin_init', 'bridgeland_crm_settings');

function bridgeland_crm_system_field() {
    $value = get_option('active_crm_system', 'hubspot');
    echo '<select name="active_crm_system">';
    echo '<option value="hubspot"' . selected($value, 'hubspot', false) . '>HubSpot</option>';
    echo '<option value="salesforce"' . selected($value, 'salesforce', false) . '>Salesforce</option>';
    echo '<option value="pipedrive"' . selected($value, 'pipedrive', false) . '>Pipedrive</option>';
    echo '</select>';
}

function bridgeland_hubspot_key_field() {
    $value = get_option('hubspot_api_key', '');
    echo '<input type="password" name="hubspot_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
    echo '<p class="description">Get your API key from HubSpot Settings > Integrations > API key</p>';
}

function bridgeland_salesforce_config_field() {
    $instance_url = get_option('salesforce_instance_url', '');
    $client_id = get_option('salesforce_client_id', '');
    echo '<p><label>Instance URL:</label><br>';
    echo '<input type="url" name="salesforce_instance_url" value="' . esc_attr($instance_url) . '" class="regular-text" /></p>';
    echo '<p><label>Client ID:</label><br>';
    echo '<input type="text" name="salesforce_client_id" value="' . esc_attr($client_id) . '" class="regular-text" /></p>';
}

function bridgeland_pipedrive_key_field() {
    $value = get_option('pipedrive_api_key', '');
    echo '<input type="password" name="pipedrive_api_key" value="' . esc_attr($value) . '" class="regular-text" />';
    echo '<p class="description">Get your API key from Pipedrive Settings > Personal > API</p>';
}
?>