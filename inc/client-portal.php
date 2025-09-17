<?php
/**
 * Client Portal System for Bridgeland Advisors
 * Secure client area with valuation history and document management
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize client portal
 */
function bridgeland_init_client_portal() {
    // Add rewrite rules for client portal
    add_rewrite_rule('^client-portal/?$', 'index.php?client_portal=1', 'top');
    add_rewrite_rule('^client-portal/([^/]*)/?$', 'index.php?client_portal=1&portal_page=$matches[1]', 'top');
}
add_action('init', 'bridgeland_init_client_portal');

/**
 * Add query vars for client portal
 */
function bridgeland_client_portal_query_vars($vars) {
    $vars[] = 'client_portal';
    $vars[] = 'portal_page';
    return $vars;
}
add_filter('query_vars', 'bridgeland_client_portal_query_vars');

/**
 * Create client user role
 */
function bridgeland_add_client_role() {
    add_role('bridgeland_client', 'Bridgeland Client', array(
        'read' => true,
        'view_client_portal' => true,
        'download_reports' => true,
        'submit_documents' => true,
        'view_valuations' => true,
    ));

    // Add capabilities to administrators
    $admin = get_role('administrator');
    if ($admin) {
        $admin->add_cap('view_client_portal');
        $admin->add_cap('manage_client_portal');
        $admin->add_cap('manage_client_valuations');
        $admin->add_cap('manage_client_documents');
    }
}
add_action('init', 'bridgeland_add_client_role');

/**
 * Client Valuation custom post type
 */
function bridgeland_client_valuation_post_type() {
    register_post_type('client_valuation', array(
        'labels' => array(
            'name' => 'Client Valuations',
            'singular_name' => 'Client Valuation',
            'add_new_item' => 'Add New Valuation',
            'edit_item' => 'Edit Valuation',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-chart-area',
        'capability_type' => 'post',
        'capabilities' => array(
            'publish_posts' => 'manage_client_valuations',
            'edit_posts' => 'manage_client_valuations',
            'edit_others_posts' => 'manage_client_valuations',
            'delete_posts' => 'manage_client_valuations',
            'read_private_posts' => 'view_valuations',
        ),
    ));

    // Client Document post type
    register_post_type('client_document', array(
        'labels' => array(
            'name' => 'Client Documents',
            'singular_name' => 'Client Document',
            'add_new_item' => 'Upload New Document',
            'edit_item' => 'Edit Document',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-media-document',
        'capability_type' => 'post',
    ));

    // Support Ticket post type
    register_post_type('support_ticket', array(
        'labels' => array(
            'name' => 'Support Tickets',
            'singular_name' => 'Support Ticket',
            'add_new_item' => 'Create New Ticket',
            'edit_item' => 'Edit Ticket',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'comments', 'custom-fields'),
        'menu_icon' => 'dashicons-sos',
        'capability_type' => 'post',
    ));
}
add_action('init', 'bridgeland_client_valuation_post_type');

/**
 * Client portal meta boxes
 */
function bridgeland_client_portal_meta_boxes() {
    // Valuation meta box
    add_meta_box(
        'valuation_details',
        'Valuation Details',
        'bridgeland_valuation_meta_callback',
        'client_valuation',
        'normal',
        'high'
    );

    // Document meta box
    add_meta_box(
        'document_details',
        'Document Details',
        'bridgeland_document_meta_callback',
        'client_document',
        'normal',
        'high'
    );

    // Ticket meta box
    add_meta_box(
        'ticket_details',
        'Ticket Details',
        'bridgeland_ticket_meta_callback',
        'support_ticket',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bridgeland_client_portal_meta_boxes');

function bridgeland_valuation_meta_callback($post) {
    wp_nonce_field('valuation_meta', 'valuation_nonce');

    $client_id = get_post_meta($post->ID, '_client_id', true);
    $company_name = get_post_meta($post->ID, '_company_name', true);
    $valuation_type = get_post_meta($post->ID, '_valuation_type', true);
    $valuation_amount = get_post_meta($post->ID, '_valuation_amount', true);
    $valuation_date = get_post_meta($post->ID, '_valuation_date', true);
    $report_url = get_post_meta($post->ID, '_report_url', true);
    $status = get_post_meta($post->ID, '_valuation_status', true);
    $next_update = get_post_meta($post->ID, '_next_update_date', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="client_id">Client User</label></th>
            <td>
                <?php
                $clients = get_users(array('role' => 'bridgeland_client'));
                ?>
                <select name="client_id" id="client_id">
                    <option value="">Select Client</option>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?php echo $client->ID; ?>" <?php selected($client_id, $client->ID); ?>>
                            <?php echo $client->display_name; ?> (<?php echo $client->user_email; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="company_name">Company Name</label></th>
            <td><input type="text" id="company_name" name="company_name" value="<?php echo esc_attr($company_name); ?>" class="large-text" /></td>
        </tr>
        <tr>
            <th><label for="valuation_type">Valuation Type</label></th>
            <td>
                <select name="valuation_type" id="valuation_type">
                    <option value="409a" <?php selected($valuation_type, '409a'); ?>>409A Valuation</option>
                    <option value="company" <?php selected($valuation_type, 'company'); ?>>Company Valuation</option>
                    <option value="startup" <?php selected($valuation_type, 'startup'); ?>>Startup Valuation</option>
                    <option value="waterfall" <?php selected($valuation_type, 'waterfall'); ?>>Waterfall Analysis</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="valuation_amount">Valuation Amount ($)</label></th>
            <td><input type="number" id="valuation_amount" name="valuation_amount" value="<?php echo esc_attr($valuation_amount); ?>" step="0.01" /></td>
        </tr>
        <tr>
            <th><label for="valuation_date">Valuation Date</label></th>
            <td><input type="date" id="valuation_date" name="valuation_date" value="<?php echo esc_attr($valuation_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="report_url">Report File URL</label></th>
            <td>
                <input type="url" id="report_url" name="report_url" value="<?php echo esc_attr($report_url); ?>" class="large-text" />
                <button type="button" class="button" onclick="uploadReport()">Upload Report</button>
            </td>
        </tr>
        <tr>
            <th><label for="valuation_status">Status</label></th>
            <td>
                <select name="valuation_status" id="valuation_status">
                    <option value="pending" <?php selected($status, 'pending'); ?>>Pending</option>
                    <option value="in_progress" <?php selected($status, 'in_progress'); ?>>In Progress</option>
                    <option value="completed" <?php selected($status, 'completed'); ?>>Completed</option>
                    <option value="delivered" <?php selected($status, 'delivered'); ?>>Delivered</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="next_update_date">Next Update Due</label></th>
            <td><input type="date" id="next_update_date" name="next_update_date" value="<?php echo esc_attr($next_update); ?>" /></td>
        </tr>
    </table>
    <?php
}

function bridgeland_document_meta_callback($post) {
    wp_nonce_field('document_meta', 'document_nonce');

    $client_id = get_post_meta($post->ID, '_client_id', true);
    $document_type = get_post_meta($post->ID, '_document_type', true);
    $file_url = get_post_meta($post->ID, '_file_url', true);
    $upload_date = get_post_meta($post->ID, '_upload_date', true);
    $expiry_date = get_post_meta($post->ID, '_expiry_date', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="doc_client_id">Client User</label></th>
            <td>
                <?php
                $clients = get_users(array('role' => 'bridgeland_client'));
                ?>
                <select name="doc_client_id" id="doc_client_id">
                    <option value="">Select Client</option>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?php echo $client->ID; ?>" <?php selected($client_id, $client->ID); ?>>
                            <?php echo $client->display_name; ?> (<?php echo $client->user_email; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="document_type">Document Type</label></th>
            <td>
                <select name="document_type" id="document_type">
                    <option value="report" <?php selected($document_type, 'report'); ?>>Valuation Report</option>
                    <option value="financial" <?php selected($document_type, 'financial'); ?>>Financial Statement</option>
                    <option value="legal" <?php selected($document_type, 'legal'); ?>>Legal Document</option>
                    <option value="certificate" <?php selected($document_type, 'certificate'); ?>>Certificate</option>
                    <option value="other" <?php selected($document_type, 'other'); ?>>Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="file_url">File URL</label></th>
            <td>
                <input type="url" id="file_url" name="file_url" value="<?php echo esc_attr($file_url); ?>" class="large-text" />
                <button type="button" class="button">Upload File</button>
            </td>
        </tr>
        <tr>
            <th><label for="upload_date">Upload Date</label></th>
            <td><input type="date" id="upload_date" name="upload_date" value="<?php echo esc_attr($upload_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="expiry_date">Expiry Date</label></th>
            <td><input type="date" id="expiry_date" name="expiry_date" value="<?php echo esc_attr($expiry_date); ?>" /></td>
        </tr>
    </table>
    <?php
}

function bridgeland_ticket_meta_callback($post) {
    wp_nonce_field('ticket_meta', 'ticket_nonce');

    $client_id = get_post_meta($post->ID, '_client_id', true);
    $priority = get_post_meta($post->ID, '_ticket_priority', true);
    $status = get_post_meta($post->ID, '_ticket_status', true);
    $category = get_post_meta($post->ID, '_ticket_category', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="ticket_client_id">Client User</label></th>
            <td>
                <?php
                $clients = get_users(array('role' => 'bridgeland_client'));
                ?>
                <select name="ticket_client_id" id="ticket_client_id">
                    <option value="">Select Client</option>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?php echo $client->ID; ?>" <?php selected($client_id, $client->ID); ?>>
                            <?php echo $client->display_name; ?> (<?php echo $client->user_email; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ticket_priority">Priority</label></th>
            <td>
                <select name="ticket_priority" id="ticket_priority">
                    <option value="low" <?php selected($priority, 'low'); ?>>Low</option>
                    <option value="medium" <?php selected($priority, 'medium'); ?>>Medium</option>
                    <option value="high" <?php selected($priority, 'high'); ?>>High</option>
                    <option value="urgent" <?php selected($priority, 'urgent'); ?>>Urgent</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ticket_status">Status</label></th>
            <td>
                <select name="ticket_status" id="ticket_status">
                    <option value="open" <?php selected($status, 'open'); ?>>Open</option>
                    <option value="in_progress" <?php selected($status, 'in_progress'); ?>>In Progress</option>
                    <option value="pending_client" <?php selected($status, 'pending_client'); ?>>Pending Client</option>
                    <option value="resolved" <?php selected($status, 'resolved'); ?>>Resolved</option>
                    <option value="closed" <?php selected($status, 'closed'); ?>>Closed</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ticket_category">Category</label></th>
            <td>
                <select name="ticket_category" id="ticket_category">
                    <option value="valuation" <?php selected($category, 'valuation'); ?>>Valuation Question</option>
                    <option value="technical" <?php selected($category, 'technical'); ?>>Technical Issue</option>
                    <option value="billing" <?php selected($category, 'billing'); ?>>Billing</option>
                    <option value="general" <?php selected($category, 'general'); ?>>General Inquiry</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save client portal meta
 */
function bridgeland_save_client_portal_meta($post_id) {
    // Check nonces and permissions
    if ((!isset($_POST['valuation_nonce']) || !wp_verify_nonce($_POST['valuation_nonce'], 'valuation_meta')) &&
        (!isset($_POST['document_nonce']) || !wp_verify_nonce($_POST['document_nonce'], 'document_meta')) &&
        (!isset($_POST['ticket_nonce']) || !wp_verify_nonce($_POST['ticket_nonce'], 'ticket_meta'))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save valuation meta
    if (get_post_type($post_id) === 'client_valuation') {
        if (isset($_POST['client_id'])) {
            update_post_meta($post_id, '_client_id', sanitize_text_field($_POST['client_id']));
        }
        if (isset($_POST['company_name'])) {
            update_post_meta($post_id, '_company_name', sanitize_text_field($_POST['company_name']));
        }
        if (isset($_POST['valuation_type'])) {
            update_post_meta($post_id, '_valuation_type', sanitize_text_field($_POST['valuation_type']));
        }
        if (isset($_POST['valuation_amount'])) {
            update_post_meta($post_id, '_valuation_amount', sanitize_text_field($_POST['valuation_amount']));
        }
        if (isset($_POST['valuation_date'])) {
            update_post_meta($post_id, '_valuation_date', sanitize_text_field($_POST['valuation_date']));
        }
        if (isset($_POST['report_url'])) {
            update_post_meta($post_id, '_report_url', esc_url_raw($_POST['report_url']));
        }
        if (isset($_POST['valuation_status'])) {
            update_post_meta($post_id, '_valuation_status', sanitize_text_field($_POST['valuation_status']));
        }
        if (isset($_POST['next_update_date'])) {
            update_post_meta($post_id, '_next_update_date', sanitize_text_field($_POST['next_update_date']));
        }
    }

    // Save document meta
    if (get_post_type($post_id) === 'client_document') {
        if (isset($_POST['doc_client_id'])) {
            update_post_meta($post_id, '_client_id', sanitize_text_field($_POST['doc_client_id']));
        }
        if (isset($_POST['document_type'])) {
            update_post_meta($post_id, '_document_type', sanitize_text_field($_POST['document_type']));
        }
        if (isset($_POST['file_url'])) {
            update_post_meta($post_id, '_file_url', esc_url_raw($_POST['file_url']));
        }
        if (isset($_POST['upload_date'])) {
            update_post_meta($post_id, '_upload_date', sanitize_text_field($_POST['upload_date']));
        }
        if (isset($_POST['expiry_date'])) {
            update_post_meta($post_id, '_expiry_date', sanitize_text_field($_POST['expiry_date']));
        }
    }

    // Save ticket meta
    if (get_post_type($post_id) === 'support_ticket') {
        if (isset($_POST['ticket_client_id'])) {
            update_post_meta($post_id, '_client_id', sanitize_text_field($_POST['ticket_client_id']));
        }
        if (isset($_POST['ticket_priority'])) {
            update_post_meta($post_id, '_ticket_priority', sanitize_text_field($_POST['ticket_priority']));
        }
        if (isset($_POST['ticket_status'])) {
            update_post_meta($post_id, '_ticket_status', sanitize_text_field($_POST['ticket_status']));
        }
        if (isset($_POST['ticket_category'])) {
            update_post_meta($post_id, '_ticket_category', sanitize_text_field($_POST['ticket_category']));
        }
    }
}
add_action('save_post', 'bridgeland_save_client_portal_meta');

/**
 * Client portal shortcodes
 */
function bridgeland_client_dashboard_shortcode() {
    if (!is_user_logged_in()) {
        return bridgeland_login_form();
    }

    $current_user = wp_get_current_user();
    if (!in_array('bridgeland_client', $current_user->roles) && !current_user_can('administrator')) {
        return '<div class="alert alert-warning">You do not have permission to access this area.</div>';
    }

    ob_start();
    include get_template_directory() . '/templates/client-dashboard.php';
    return ob_get_clean();
}
add_shortcode('client_dashboard', 'bridgeland_client_dashboard_shortcode');

/**
 * Client login form
 */
function bridgeland_login_form() {
    if (is_user_logged_in()) {
        return '<p>You are already logged in. <a href="' . home_url('/client-portal/') . '">Go to dashboard</a></p>';
    }

    $form = '<div class="client-login-form">';
    $form .= '<h3>Client Portal Login</h3>';
    $form .= wp_login_form(array(
        'echo' => false,
        'redirect' => home_url('/client-portal/'),
        'form_id' => 'client-login-form',
        'label_username' => 'Email Address',
        'label_password' => 'Password',
        'label_remember' => 'Remember Me',
        'label_log_in' => 'Login to Portal',
        'remember' => true
    ));
    $form .= '<p class="mt-3"><a href="' . wp_lostpassword_url() . '">Forgot Password?</a></p>';
    $form .= '<p>Don\'t have an account? <a href="' . home_url('/contact/') . '">Contact us</a> to get started.</p>';
    $form .= '</div>';

    return $form;
}

/**
 * Restrict client portal access
 */
function bridgeland_restrict_client_portal() {
    if (get_query_var('client_portal')) {
        if (!is_user_logged_in()) {
            wp_redirect(home_url('/login/'));
            exit;
        }

        $current_user = wp_get_current_user();
        if (!in_array('bridgeland_client', $current_user->roles) && !current_user_can('administrator')) {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('template_redirect', 'bridgeland_restrict_client_portal');

/**
 * Get client valuations
 */
function bridgeland_get_client_valuations($client_id = null) {
    if (!$client_id) {
        $client_id = get_current_user_id();
    }

    $args = array(
        'post_type' => 'client_valuation',
        'meta_key' => '_client_id',
        'meta_value' => $client_id,
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'meta_key' => '_valuation_date',
        'order' => 'DESC'
    );

    return get_posts($args);
}

/**
 * Get client documents
 */
function bridgeland_get_client_documents($client_id = null) {
    if (!$client_id) {
        $client_id = get_current_user_id();
    }

    $args = array(
        'post_type' => 'client_document',
        'meta_key' => '_client_id',
        'meta_value' => $client_id,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    return get_posts($args);
}

/**
 * Get client support tickets
 */
function bridgeland_get_client_tickets($client_id = null) {
    if (!$client_id) {
        $client_id = get_current_user_id();
    }

    $args = array(
        'post_type' => 'support_ticket',
        'meta_key' => '_client_id',
        'meta_value' => $client_id,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    return get_posts($args);
}

/**
 * Email notifications for client portal
 */
function bridgeland_notify_client_valuation_update($post_id) {
    if (get_post_type($post_id) !== 'client_valuation') {
        return;
    }

    $client_id = get_post_meta($post_id, '_client_id', true);
    if (!$client_id) {
        return;
    }

    $client = get_userdata($client_id);
    $status = get_post_meta($post_id, '_valuation_status', true);

    if ($status === 'completed' || $status === 'delivered') {
        $subject = 'Your valuation is ready - Bridgeland Advisors';
        $message = sprintf(
            'Dear %s,\n\nYour %s valuation has been completed and is now available in your client portal.\n\nLog in to view: %s\n\nBest regards,\nBridgeland Advisors Team',
            $client->display_name,
            get_post_meta($post_id, '_valuation_type', true),
            home_url('/client-portal/')
        );

        wp_mail($client->user_email, $subject, $message);
    }
}
add_action('save_post', 'bridgeland_notify_client_valuation_update');

/**
 * AJAX handlers for client portal
 */
function bridgeland_ajax_submit_ticket() {
    check_ajax_referer('client_portal_nonce', 'nonce');

    $client_id = get_current_user_id();
    $title = sanitize_text_field($_POST['title']);
    $message = sanitize_textarea_field($_POST['message']);
    $category = sanitize_text_field($_POST['category']);

    $ticket_id = wp_insert_post(array(
        'post_type' => 'support_ticket',
        'post_title' => $title,
        'post_content' => $message,
        'post_status' => 'publish'
    ));

    if ($ticket_id) {
        update_post_meta($ticket_id, '_client_id', $client_id);
        update_post_meta($ticket_id, '_ticket_category', $category);
        update_post_meta($ticket_id, '_ticket_status', 'open');
        update_post_meta($ticket_id, '_ticket_priority', 'medium');

        wp_send_json_success('Ticket submitted successfully');
    } else {
        wp_send_json_error('Failed to submit ticket');
    }
}
add_action('wp_ajax_submit_ticket', 'bridgeland_ajax_submit_ticket');

/**
 * Dashboard widgets for admin
 */
function bridgeland_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'bridgeland_client_stats',
        'Client Portal Statistics',
        'bridgeland_client_stats_widget'
    );
}
add_action('wp_dashboard_setup', 'bridgeland_add_dashboard_widgets');

function bridgeland_client_stats_widget() {
    $total_clients = count(get_users(array('role' => 'bridgeland_client')));
    $total_valuations = wp_count_posts('client_valuation')->publish;
    $pending_valuations = get_posts(array(
        'post_type' => 'client_valuation',
        'meta_key' => '_valuation_status',
        'meta_value' => 'in_progress',
        'posts_per_page' => -1
    ));
    $open_tickets = get_posts(array(
        'post_type' => 'support_ticket',
        'meta_key' => '_ticket_status',
        'meta_value' => 'open',
        'posts_per_page' => -1
    ));

    echo '<div class="client-stats">';
    echo '<p><strong>Total Clients:</strong> ' . $total_clients . '</p>';
    echo '<p><strong>Total Valuations:</strong> ' . $total_valuations . '</p>';
    echo '<p><strong>In Progress:</strong> ' . count($pending_valuations) . '</p>';
    echo '<p><strong>Open Tickets:</strong> ' . count($open_tickets) . '</p>';
    echo '<hr>';
    echo '<p><a href="' . admin_url('edit.php?post_type=client_valuation') . '" class="button">Manage Valuations</a> ';
    echo '<a href="' . admin_url('edit.php?post_type=support_ticket') . '" class="button">View Tickets</a></p>';
    echo '</div>';
}