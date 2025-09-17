<?php
/**
 * Email Automation Workflows
 * Advanced email marketing and drip campaigns
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandEmailAutomation {

    private $email_templates;
    private $workflow_triggers;

    public function __init() {
        add_action('init', array($this, 'init_email_system'));
        add_action('wp_ajax_create_email_campaign', array($this, 'create_email_campaign'));
        add_action('wp_ajax_send_test_email', array($this, 'send_test_email'));
        add_action('wp_ajax_schedule_email', array($this, 'schedule_email'));

        // Workflow triggers
        add_action('user_register', array($this, 'trigger_welcome_sequence'), 10, 1);
        add_action('bridgeland_payment_completed', array($this, 'trigger_payment_confirmation'), 10, 1);
        add_action('bridgeland_project_completed', array($this, 'trigger_project_completion'), 10, 1);
        add_action('bridgeland_client_inactive', array($this, 'trigger_reengagement'), 10, 1);

        // Scheduled email processing
        add_action('bridgeland_process_email_queue', array($this, 'process_email_queue'));
        add_action('bridgeland_send_scheduled_emails', array($this, 'send_scheduled_emails'));

        if (!wp_next_scheduled('bridgeland_process_email_queue')) {
            wp_schedule_event(time(), 'hourly', 'bridgeland_process_email_queue');
        }

        if (!wp_next_scheduled('bridgeland_send_scheduled_emails')) {
            wp_schedule_event(time(), 'daily', 'bridgeland_send_scheduled_emails');
        }
    }

    /**
     * Initialize Email System
     */
    public function init_email_system() {
        $this->setup_email_templates();
        $this->register_email_post_types();
        $this->setup_workflow_triggers();
    }

    /**
     * Register Email-Related Post Types
     */
    private function register_email_post_types() {
        // Email Templates
        register_post_type('email_template', array(
            'labels' => array(
                'name' => 'Email Templates',
                'singular_name' => 'Email Template',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title', 'editor'),
            'capability_type' => 'post',
        ));

        // Email Campaigns
        register_post_type('email_campaign', array(
            'labels' => array(
                'name' => 'Email Campaigns',
                'singular_name' => 'Email Campaign',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Email Queue
        register_post_type('email_queue', array(
            'labels' => array(
                'name' => 'Email Queue',
                'singular_name' => 'Queued Email',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));
    }

    /**
     * Setup Email Templates
     */
    private function setup_email_templates() {
        $this->email_templates = array(
            'welcome_sequence' => array(
                'day_1' => array(
                    'subject' => 'Welcome to Bridgeland Advisors, {{first_name}}!',
                    'template' => 'welcome-day-1',
                    'delay' => 0
                ),
                'day_3' => array(
                    'subject' => 'Your 409A Valuation Questions Answered',
                    'template' => 'welcome-day-3',
                    'delay' => 3
                ),
                'day_7' => array(
                    'subject' => 'Ready to Get Started? Schedule Your Consultation',
                    'template' => 'welcome-day-7',
                    'delay' => 7
                )
            ),
            'payment_confirmation' => array(
                'immediate' => array(
                    'subject' => 'Payment Confirmed - Your 409A Valuation Project',
                    'template' => 'payment-confirmation',
                    'delay' => 0
                ),
                'day_1' => array(
                    'subject' => 'Your Valuation Project Has Begun',
                    'template' => 'project-started',
                    'delay' => 1
                )
            ),
            'project_updates' => array(
                'in_progress' => array(
                    'subject' => 'Update: Your Valuation is Progressing',
                    'template' => 'project-progress',
                    'delay' => 0
                ),
                'review' => array(
                    'subject' => 'Your Valuation is Under Final Review',
                    'template' => 'project-review',
                    'delay' => 0
                ),
                'completed' => array(
                    'subject' => 'Your 409A Valuation Report is Ready!',
                    'template' => 'project-completed',
                    'delay' => 0
                )
            ),
            'reengagement' => array(
                'day_30' => array(
                    'subject' => 'We Miss You! Special Offer Inside',
                    'template' => 'reengagement-30',
                    'delay' => 30
                ),
                'day_60' => array(
                    'subject' => 'Last Chance: Exclusive Valuation Discount',
                    'template' => 'reengagement-60',
                    'delay' => 60
                )
            ),
            'newsletter' => array(
                'monthly' => array(
                    'subject' => 'Monthly Financial Insights from Bridgeland Advisors',
                    'template' => 'newsletter-monthly',
                    'delay' => 0
                )
            )
        );
    }

    /**
     * Create Email Campaign
     */
    public function create_email_campaign() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $campaign_data = array(
            'name' => sanitize_text_field($_POST['campaign_name']),
            'subject' => sanitize_text_field($_POST['subject']),
            'template' => sanitize_text_field($_POST['template']),
            'recipients' => $_POST['recipients'], // Array of email addresses
            'send_date' => sanitize_text_field($_POST['send_date']),
            'send_time' => sanitize_text_field($_POST['send_time'])
        );

        // Create campaign
        $campaign_id = wp_insert_post(array(
            'post_title' => $campaign_data['name'],
            'post_type' => 'email_campaign',
            'post_status' => 'draft'
        ));

        if ($campaign_id) {
            update_post_meta($campaign_id, '_subject', $campaign_data['subject']);
            update_post_meta($campaign_id, '_template', $campaign_data['template']);
            update_post_meta($campaign_id, '_recipients', $campaign_data['recipients']);
            update_post_meta($campaign_id, '_send_datetime', $campaign_data['send_date'] . ' ' . $campaign_data['send_time']);
            update_post_meta($campaign_id, '_status', 'scheduled');
            update_post_meta($campaign_id, '_created_date', current_time('mysql'));

            // Queue emails for recipients
            foreach ($campaign_data['recipients'] as $recipient) {
                $this->queue_email($recipient, $campaign_data['subject'], $campaign_data['template'], array(), $campaign_data['send_date'] . ' ' . $campaign_data['send_time']);
            }

            wp_send_json_success(array(
                'message' => 'Email campaign created successfully',
                'campaign_id' => $campaign_id,
                'recipients_count' => count($campaign_data['recipients'])
            ));
        } else {
            wp_send_json_error('Failed to create email campaign');
        }
    }

    /**
     * Trigger Welcome Email Sequence
     */
    public function trigger_welcome_sequence($user_id) {
        $user = get_userdata($user_id);
        if (!$user) return;

        $user_data = array(
            'first_name' => get_user_meta($user_id, 'first_name', true) ?: $user->display_name,
            'last_name' => get_user_meta($user_id, 'last_name', true) ?: '',
            'email' => $user->user_email,
            'company' => get_user_meta($user_id, 'company_name', true) ?: ''
        );

        // Schedule welcome sequence
        foreach ($this->email_templates['welcome_sequence'] as $email_key => $email_config) {
            $send_date = date('Y-m-d H:i:s', strtotime('+' . $email_config['delay'] . ' days'));
            $this->queue_email(
                $user_data['email'],
                $email_config['subject'],
                $email_config['template'],
                $user_data,
                $send_date
            );
        }
    }

    /**
     * Trigger Payment Confirmation Sequence
     */
    public function trigger_payment_confirmation($payment_data) {
        $user_data = array(
            'first_name' => $payment_data['client_name'],
            'email' => $payment_data['client_email'],
            'service_type' => $payment_data['service_type'],
            'amount' => $payment_data['amount'],
            'order_id' => $payment_data['order_id']
        );

        // Schedule payment confirmation emails
        foreach ($this->email_templates['payment_confirmation'] as $email_key => $email_config) {
            $send_date = date('Y-m-d H:i:s', strtotime('+' . $email_config['delay'] . ' days'));
            $this->queue_email(
                $user_data['email'],
                $email_config['subject'],
                $email_config['template'],
                $user_data,
                $send_date
            );
        }
    }

    /**
     * Trigger Project Completion Sequence
     */
    public function trigger_project_completion($project_data) {
        $client_email = get_post_meta($project_data['project_id'], '_client_email', true);
        $client_name = get_post_meta($project_data['project_id'], '_client_name', true);

        $user_data = array(
            'first_name' => $client_name,
            'email' => $client_email,
            'project_id' => $project_data['project_id'],
            'service_type' => get_post_meta($project_data['project_id'], '_service_type', true)
        );

        $email_config = $this->email_templates['project_updates']['completed'];
        $this->queue_email(
            $user_data['email'],
            $email_config['subject'],
            $email_config['template'],
            $user_data,
            current_time('mysql')
        );

        // Schedule follow-up survey email
        $this->queue_email(
            $user_data['email'],
            'How was your experience? Quick feedback requested',
            'feedback-survey',
            $user_data,
            date('Y-m-d H:i:s', strtotime('+3 days'))
        );
    }

    /**
     * Queue Email for Sending
     */
    private function queue_email($recipient, $subject, $template, $data = array(), $send_date = null) {
        if (!$send_date) {
            $send_date = current_time('mysql');
        }

        $queue_id = wp_insert_post(array(
            'post_title' => 'Email to ' . $recipient . ' - ' . $subject,
            'post_type' => 'email_queue',
            'post_status' => 'pending'
        ));

        if ($queue_id) {
            update_post_meta($queue_id, '_recipient', $recipient);
            update_post_meta($queue_id, '_subject', $subject);
            update_post_meta($queue_id, '_template', $template);
            update_post_meta($queue_id, '_data', $data);
            update_post_meta($queue_id, '_send_date', $send_date);
            update_post_meta($queue_id, '_status', 'queued');
            update_post_meta($queue_id, '_attempts', 0);
            update_post_meta($queue_id, '_created_date', current_time('mysql'));
        }

        return $queue_id;
    }

    /**
     * Process Email Queue
     */
    public function process_email_queue() {
        $current_time = current_time('mysql');

        $queued_emails = get_posts(array(
            'post_type' => 'email_queue',
            'posts_per_page' => 50, // Process 50 emails at a time
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_status',
                    'value' => 'queued',
                    'compare' => '='
                ),
                array(
                    'key' => '_send_date',
                    'value' => $current_time,
                    'compare' => '<='
                )
            ),
            'orderby' => 'meta_value',
            'meta_key' => '_send_date',
            'order' => 'ASC'
        ));

        foreach ($queued_emails as $email) {
            $this->send_queued_email($email->ID);
        }

        // Clean up old processed emails (older than 30 days)
        $old_emails = get_posts(array(
            'post_type' => 'email_queue',
            'posts_per_page' => -1,
            'date_query' => array(
                array(
                    'before' => '30 days ago'
                )
            ),
            'meta_query' => array(
                array(
                    'key' => '_status',
                    'value' => array('sent', 'failed'),
                    'compare' => 'IN'
                )
            )
        ));

        foreach ($old_emails as $old_email) {
            wp_delete_post($old_email->ID, true);
        }
    }

    /**
     * Send Queued Email
     */
    private function send_queued_email($queue_id) {
        $recipient = get_post_meta($queue_id, '_recipient', true);
        $subject = get_post_meta($queue_id, '_subject', true);
        $template = get_post_meta($queue_id, '_template', true);
        $data = get_post_meta($queue_id, '_data', true);
        $attempts = intval(get_post_meta($queue_id, '_attempts', true));

        // Load email template
        $email_content = $this->load_email_template($template, $data);
        if (!$email_content) {
            update_post_meta($queue_id, '_status', 'failed');
            update_post_meta($queue_id, '_error', 'Template not found');
            return false;
        }

        // Replace variables in subject
        $subject = $this->replace_email_variables($subject, $data);

        // Send email
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Bridgeland Advisors <noreply@bridgeland-advisors.com>'
        );

        $sent = wp_mail($recipient, $subject, $email_content, $headers);

        if ($sent) {
            update_post_meta($queue_id, '_status', 'sent');
            update_post_meta($queue_id, '_sent_date', current_time('mysql'));

            // Track email analytics
            $this->track_email_sent($queue_id, $recipient, $template);
        } else {
            $attempts++;
            update_post_meta($queue_id, '_attempts', $attempts);

            if ($attempts >= 3) {
                update_post_meta($queue_id, '_status', 'failed');
                update_post_meta($queue_id, '_error', 'Max attempts reached');
            } else {
                // Retry later
                $retry_date = date('Y-m-d H:i:s', strtotime('+1 hour'));
                update_post_meta($queue_id, '_send_date', $retry_date);
            }
        }

        return $sent;
    }

    /**
     * Load Email Template
     */
    private function load_email_template($template_name, $data = array()) {
        $template_path = get_template_directory() . '/email-templates/' . $template_name . '.php';

        if (!file_exists($template_path)) {
            // Use default template structure
            return $this->get_default_email_template($template_name, $data);
        }

        ob_start();
        extract($data);
        include $template_path;
        $content = ob_get_clean();

        return $this->replace_email_variables($content, $data);
    }

    /**
     * Get Default Email Template
     */
    private function get_default_email_template($template_name, $data) {
        $templates = array(
            'welcome-day-1' => array(
                'content' => '<h2>Welcome to Bridgeland Advisors!</h2>
                <p>Hi {{first_name}},</p>
                <p>Welcome to Bridgeland Advisors! We\'re excited to help you with your valuation needs.</p>
                <p>Our team specializes in providing accurate, IRS-compliant 409A valuations for companies at all stages.</p>
                <p>Over the next few days, we\'ll be sending you valuable resources to help you understand the valuation process.</p>
                <p>Best regards,<br>The Bridgeland Advisors Team</p>'
            ),
            'welcome-day-3' => array(
                'content' => '<h2>Your 409A Valuation Questions Answered</h2>
                <p>Hi {{first_name}},</p>
                <p>Many clients ask us the same questions about 409A valuations. Here are the most important ones:</p>
                <ul>
                <li><strong>How often do I need a 409A valuation?</strong> Generally every 12 months or after a material event.</li>
                <li><strong>What information do you need?</strong> Financial statements, cap table, and recent transactions.</li>
                <li><strong>How long does it take?</strong> Our standard process takes 5-7 business days.</li>
                </ul>
                <p>Ready to get started? <a href="' . site_url('/contact/') . '">Schedule your consultation today</a>.</p>
                <p>Best regards,<br>Eran Ben-Avi, CPA</p>'
            ),
            'payment-confirmation' => array(
                'content' => '<h2>Payment Confirmed - Thank You!</h2>
                <p>Hi {{first_name}},</p>
                <p>We\'ve received your payment for {{service_type}} and your project is now officially underway!</p>
                <p><strong>Order Details:</strong></p>
                <ul>
                <li>Service: {{service_type}}</li>
                <li>Amount: ${{amount}}</li>
                <li>Order ID: {{order_id}}</li>
                </ul>
                <p>Our team will begin working on your valuation within 24 hours. You\'ll receive regular updates through your client portal.</p>
                <p>Access your client portal: <a href="' . site_url('/client-dashboard/') . '">Client Dashboard</a></p>
                <p>Best regards,<br>The Bridgeland Advisors Team</p>'
            )
        );

        return isset($templates[$template_name]) ? $templates[$template_name]['content'] : '';
    }

    /**
     * Replace Email Variables
     */
    private function replace_email_variables($content, $data) {
        if (empty($data)) return $content;

        foreach ($data as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        // Replace common variables
        $content = str_replace('{{site_url}}', site_url(), $content);
        $content = str_replace('{{company_name}}', 'Bridgeland Advisors', $content);
        $content = str_replace('{{current_year}}', date('Y'), $content);

        return $content;
    }

    /**
     * Track Email Analytics
     */
    private function track_email_sent($queue_id, $recipient, $template) {
        // Create email analytics record
        $analytics_id = wp_insert_post(array(
            'post_title' => 'Email Analytics - ' . $recipient,
            'post_type' => 'email_analytics',
            'post_status' => 'private'
        ));

        if ($analytics_id) {
            update_post_meta($analytics_id, '_recipient', $recipient);
            update_post_meta($analytics_id, '_template', $template);
            update_post_meta($analytics_id, '_sent_date', current_time('mysql'));
            update_post_meta($analytics_id, '_queue_id', $queue_id);
            update_post_meta($analytics_id, '_status', 'sent');
        }
    }

    /**
     * Send Test Email
     */
    public function send_test_email() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $template = sanitize_text_field($_POST['template']);
        $recipient = sanitize_email($_POST['recipient']);
        $test_data = array(
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company' => 'Test Company Inc.',
            'service_type' => 'Basic 409A Valuation',
            'amount' => '2500.00'
        );

        $content = $this->load_email_template($template, $test_data);
        $subject = 'Test Email: ' . ucwords(str_replace('-', ' ', $template));

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Bridgeland Advisors <noreply@bridgeland-advisors.com>'
        );

        $sent = wp_mail($recipient, $subject, $content, $headers);

        if ($sent) {
            wp_send_json_success('Test email sent successfully');
        } else {
            wp_send_json_error('Failed to send test email');
        }
    }
}

// Initialize email automation
$bridgeland_email_automation = new BridgelandEmailAutomation();
$bridgeland_email_automation->__init();

// Register email analytics post type
function bridgeland_register_email_analytics() {
    register_post_type('email_analytics', array(
        'labels' => array(
            'name' => 'Email Analytics',
            'singular_name' => 'Email Analytics',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'bridgeland-dashboard',
        'supports' => array('title'),
        'capability_type' => 'post',
    ));
}
add_action('init', 'bridgeland_register_email_analytics');
?>