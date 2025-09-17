<?php
/**
 * Payment Integration System
 * Secure payment processing for valuation services
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandPayments {

    public function __init() {
        add_action('wp_ajax_create_payment_session', array($this, 'create_payment_session'));
        add_action('wp_ajax_nopriv_create_payment_session', array($this, 'create_payment_session'));
        add_action('wp_ajax_process_payment', array($this, 'process_payment'));
        add_action('wp_ajax_verify_payment', array($this, 'verify_payment'));
        add_action('init', array($this, 'handle_payment_webhook'));
        add_action('init', array($this, 'register_payment_post_types'));
    }

    /**
     * Register Payment-Related Post Types
     */
    public function register_payment_post_types() {
        // Payment Orders
        register_post_type('payment_order', array(
            'labels' => array(
                'name' => 'Payment Orders',
                'singular_name' => 'Payment Order',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=client_valuation',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Service Packages
        register_post_type('service_package', array(
            'labels' => array(
                'name' => 'Service Packages',
                'singular_name' => 'Service Package',
            ),
            'public' => true,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-cart',
        ));
    }

    /**
     * Create Payment Session
     */
    public function create_payment_session() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $service_type = sanitize_text_field($_POST['service_type']);
        $amount = floatval($_POST['amount']);
        $client_email = sanitize_email($_POST['client_email']);
        $client_name = sanitize_text_field($_POST['client_name']);

        // Create payment order
        $order_id = wp_insert_post(array(
            'post_title' => 'Payment Order - ' . $client_name . ' - ' . $service_type,
            'post_status' => 'pending',
            'post_type' => 'payment_order',
            'post_author' => get_current_user_id()
        ));

        if ($order_id) {
            // Store payment details
            update_post_meta($order_id, '_service_type', $service_type);
            update_post_meta($order_id, '_amount', $amount);
            update_post_meta($order_id, '_client_email', $client_email);
            update_post_meta($order_id, '_client_name', $client_name);
            update_post_meta($order_id, '_payment_status', 'pending');
            update_post_meta($order_id, '_created_date', current_time('mysql'));

            // Generate secure payment token
            $payment_token = wp_generate_password(32, false);
            update_post_meta($order_id, '_payment_token', $payment_token);

            wp_send_json_success(array(
                'order_id' => $order_id,
                'payment_token' => $payment_token,
                'payment_url' => site_url('/payment/?token=' . $payment_token),
                'amount' => $amount
            ));
        } else {
            wp_send_json_error('Failed to create payment order');
        }
    }

    /**
     * Process Payment (Demo Implementation)
     * In production, integrate with Stripe, PayPal, or other payment processors
     */
    public function process_payment() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $payment_token = sanitize_text_field($_POST['payment_token']);
        $payment_method = sanitize_text_field($_POST['payment_method']);
        $card_details = array(
            'number' => sanitize_text_field($_POST['card_number']),
            'expiry' => sanitize_text_field($_POST['card_expiry']),
            'cvc' => sanitize_text_field($_POST['card_cvc']),
            'name' => sanitize_text_field($_POST['card_name'])
        );

        // Find order by payment token
        $orders = get_posts(array(
            'post_type' => 'payment_order',
            'meta_query' => array(
                array(
                    'key' => '_payment_token',
                    'value' => $payment_token,
                    'compare' => '='
                )
            ),
            'post_status' => 'pending'
        ));

        if (empty($orders)) {
            wp_send_json_error('Invalid payment token');
        }

        $order = $orders[0];
        $amount = get_post_meta($order->ID, '_amount', true);

        // Demo payment processing (always succeeds for amounts under $1000)
        $payment_successful = ($amount < 1000);

        if ($payment_successful) {
            // Update order status
            wp_update_post(array(
                'ID' => $order->ID,
                'post_status' => 'completed'
            ));

            update_post_meta($order->ID, '_payment_status', 'completed');
            update_post_meta($order->ID, '_payment_method', $payment_method);
            update_post_meta($order->ID, '_payment_date', current_time('mysql'));
            update_post_meta($order->ID, '_transaction_id', 'demo_' . time() . '_' . rand(1000, 9999));

            // Send confirmation email
            $this->send_payment_confirmation($order->ID);

            // Create client valuation if it's a valuation service
            $service_type = get_post_meta($order->ID, '_service_type', true);
            if (strpos($service_type, 'valuation') !== false) {
                $this->create_valuation_project($order->ID);
            }

            wp_send_json_success(array(
                'message' => 'Payment processed successfully',
                'transaction_id' => get_post_meta($order->ID, '_transaction_id', true),
                'redirect_url' => site_url('/payment-success/?order=' . $order->ID)
            ));
        } else {
            update_post_meta($order->ID, '_payment_status', 'failed');
            update_post_meta($order->ID, '_payment_error', 'Payment processing failed');

            wp_send_json_error('Payment failed. Please try again or contact support.');
        }
    }

    /**
     * Send Payment Confirmation Email
     */
    private function send_payment_confirmation($order_id) {
        $client_email = get_post_meta($order_id, '_client_email', true);
        $client_name = get_post_meta($order_id, '_client_name', true);
        $service_type = get_post_meta($order_id, '_service_type', true);
        $amount = get_post_meta($order_id, '_amount', true);
        $transaction_id = get_post_meta($order_id, '_transaction_id', true);

        $subject = 'Payment Confirmation - Bridgeland Advisors';
        $message = "Dear {$client_name},\n\n";
        $message .= "Thank you for your payment. Your transaction has been processed successfully.\n\n";
        $message .= "Payment Details:\n";
        $message .= "Service: {$service_type}\n";
        $message .= "Amount: $" . number_format($amount, 2) . "\n";
        $message .= "Transaction ID: {$transaction_id}\n";
        $message .= "Date: " . current_time('F j, Y g:i A') . "\n\n";
        $message .= "We will begin work on your project within 1-2 business days. You will receive updates via email and through your client portal.\n\n";
        $message .= "Access your client portal: " . site_url('/client-dashboard/') . "\n\n";
        $message .= "Best regards,\nBridgeland Advisors Team\n";
        $message .= "eran@bridgeland-advisors.com\n+972-50-6842937";

        wp_mail($client_email, $subject, $message);

        // Send internal notification
        wp_mail(
            'eran@bridgeland-advisors.com',
            'New Payment Received - ' . $service_type,
            "New payment received from {$client_name} ({$client_email})\n\nAmount: $" . number_format($amount, 2) . "\nService: {$service_type}\nTransaction ID: {$transaction_id}"
        );
    }

    /**
     * Create Valuation Project after Payment
     */
    private function create_valuation_project($order_id) {
        $client_email = get_post_meta($order_id, '_client_email', true);
        $client_name = get_post_meta($order_id, '_client_name', true);
        $service_type = get_post_meta($order_id, '_service_type', true);

        // Create valuation project
        $valuation_id = wp_insert_post(array(
            'post_title' => 'Valuation Project - ' . $client_name,
            'post_status' => 'draft',
            'post_type' => 'client_valuation',
            'post_author' => 1 // Admin user
        ));

        if ($valuation_id) {
            update_post_meta($valuation_id, '_client_email', $client_email);
            update_post_meta($valuation_id, '_client_name', $client_name);
            update_post_meta($valuation_id, '_service_type', $service_type);
            update_post_meta($valuation_id, '_order_id', $order_id);
            update_post_meta($valuation_id, '_status', 'initiated');
            update_post_meta($valuation_id, '_created_date', current_time('mysql'));

            // Link order to valuation
            update_post_meta($order_id, '_valuation_id', $valuation_id);
        }
    }

    /**
     * Get Service Packages
     */
    public static function get_service_packages() {
        return array(
            'basic_409a' => array(
                'name' => 'Basic 409A Valuation',
                'price' => 2500,
                'description' => 'Standard 409A valuation for early-stage companies',
                'features' => array(
                    'Market approach analysis',
                    'Income approach (if applicable)',
                    'Detailed valuation report',
                    'IRS-compliant documentation',
                    '1 round of revisions'
                ),
                'turnaround' => '5-7 business days'
            ),
            'premium_409a' => array(
                'name' => 'Premium 409A Valuation',
                'price' => 4500,
                'description' => 'Comprehensive 409A valuation with multiple methodologies',
                'features' => array(
                    'All Basic features',
                    'Asset approach analysis',
                    'Scenario analysis',
                    'Peer benchmarking',
                    'Executive summary',
                    '2 rounds of revisions',
                    'Priority support'
                ),
                'turnaround' => '3-5 business days'
            ),
            'financial_modeling' => array(
                'name' => 'Financial Modeling & Analysis',
                'price' => 3000,
                'description' => 'Custom financial models and business analysis',
                'features' => array(
                    'DCF model development',
                    'Scenario planning',
                    'Sensitivity analysis',
                    'Investment analysis',
                    'Board presentation',
                    'Model documentation'
                ),
                'turnaround' => '7-10 business days'
            ),
            'due_diligence' => array(
                'name' => 'Due Diligence Support',
                'price' => 5000,
                'description' => 'Comprehensive due diligence for transactions',
                'features' => array(
                    'Financial analysis',
                    'Business model review',
                    'Market assessment',
                    'Risk analysis',
                    'Valuation review',
                    'Executive summary',
                    'Q&A support'
                ),
                'turnaround' => '10-14 business days'
            )
        );
    }

    /**
     * Handle Payment Webhooks (for production payment processors)
     */
    public function handle_payment_webhook() {
        if (isset($_GET['bridgeland_webhook']) && $_GET['bridgeland_webhook'] === 'payment') {
            $payload = file_get_contents('php://input');
            $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

            // Verify webhook signature (implement based on payment processor)
            // if (!$this->verify_webhook_signature($payload, $signature)) {
            //     http_response_code(400);
            //     exit;
            // }

            $data = json_decode($payload, true);

            if ($data && isset($data['event_type'])) {
                switch ($data['event_type']) {
                    case 'payment.succeeded':
                        $this->handle_payment_success($data);
                        break;
                    case 'payment.failed':
                        $this->handle_payment_failure($data);
                        break;
                }
            }

            http_response_code(200);
            exit;
        }
    }

    private function handle_payment_success($data) {
        // Update payment status in database
        // Send confirmation emails
        // Trigger workflow automation
    }

    private function handle_payment_failure($data) {
        // Update payment status
        // Send failure notification
        // Log for investigation
    }
}

// Initialize payment system
$bridgeland_payments = new BridgelandPayments();
$bridgeland_payments->__init();

// Helper function to format currency
function bridgeland_format_currency($amount) {
    return '$' . number_format($amount, 2);
}

// Helper function to get payment status badge
function bridgeland_payment_status_badge($status) {
    $badges = array(
        'pending' => '<span class="badge bg-warning">Pending</span>',
        'completed' => '<span class="badge bg-success">Completed</span>',
        'failed' => '<span class="badge bg-danger">Failed</span>',
        'refunded' => '<span class="badge bg-info">Refunded</span>'
    );

    return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
}
?>