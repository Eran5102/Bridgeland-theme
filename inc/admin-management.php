<?php
/**
 * Admin Management Interface
 * Advanced admin dashboard and management features
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandAdmin {

    public function __init() {
        add_action('admin_menu', array($this, 'add_admin_menus'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_action('wp_ajax_admin_stats', array($this, 'get_admin_stats'));
        add_action('wp_ajax_update_client_status', array($this, 'update_client_status'));
        add_action('wp_ajax_send_client_notification', array($this, 'send_client_notification'));
        add_action('admin_init', array($this, 'admin_init'));
    }

    /**
     * Add Admin Menus
     */
    public function add_admin_menus() {
        // Main Dashboard
        add_menu_page(
            'Bridgeland Dashboard',
            'Bridgeland',
            'manage_options',
            'bridgeland-dashboard',
            array($this, 'admin_dashboard'),
            'dashicons-chart-line',
            2
        );

        // Client Management
        add_submenu_page(
            'bridgeland-dashboard',
            'Client Management',
            'Clients',
            'manage_options',
            'bridgeland-clients',
            array($this, 'client_management')
        );

        // Project Management
        add_submenu_page(
            'bridgeland-dashboard',
            'Project Management',
            'Projects',
            'manage_options',
            'bridgeland-projects',
            array($this, 'project_management')
        );

        // Payment Management
        add_submenu_page(
            'bridgeland-dashboard',
            'Payment Management',
            'Payments',
            'manage_options',
            'bridgeland-payments',
            array($this, 'payment_management')
        );

        // Settings
        add_submenu_page(
            'bridgeland-dashboard',
            'Settings',
            'Settings',
            'manage_options',
            'bridgeland-settings',
            array($this, 'admin_settings')
        );
    }

    /**
     * Enqueue Admin Scripts
     */
    public function admin_scripts($hook) {
        if (strpos($hook, 'bridgeland') !== false) {
            wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.9.1', true);
            wp_enqueue_script('bridgeland-admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery', 'chart-js'), '1.0', true);
            wp_enqueue_style('bridgeland-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0');

            wp_localize_script('bridgeland-admin', 'bridgeland_admin', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('bridgeland_admin_nonce')
            ));
        }
    }

    /**
     * Admin Dashboard
     */
    public function admin_dashboard() {
        ?>
        <div class="wrap bridgeland-admin">
            <h1>Bridgeland Advisors Dashboard</h1>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="dashicons dashicons-groups"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="total-clients"><?php echo $this->get_total_clients(); ?></h3>
                        <p>Total Clients</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="dashicons dashicons-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="active-projects"><?php echo $this->get_active_projects(); ?></h3>
                        <p>Active Projects</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="dashicons dashicons-money-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="monthly-revenue">$<?php echo number_format($this->get_monthly_revenue(), 0); ?></h3>
                        <p>Monthly Revenue</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="dashicons dashicons-tickets-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 id="pending-tickets"><?php echo $this->get_pending_tickets(); ?></h3>
                        <p>Pending Tickets</p>
                    </div>
                </div>
            </div>

            <div class="admin-grid">
                <!-- Revenue Chart -->
                <div class="admin-widget">
                    <h2>Revenue Trends</h2>
                    <canvas id="revenue-chart" width="400" height="200"></canvas>
                </div>

                <!-- Recent Activity -->
                <div class="admin-widget">
                    <h2>Recent Activity</h2>
                    <div class="activity-list">
                        <?php $this->display_recent_activity(); ?>
                    </div>
                </div>

                <!-- Project Status -->
                <div class="admin-widget">
                    <h2>Project Status</h2>
                    <canvas id="project-status-chart" width="400" height="200"></canvas>
                </div>

                <!-- Quick Actions -->
                <div class="admin-widget">
                    <h2>Quick Actions</h2>
                    <div class="quick-actions">
                        <a href="<?php echo admin_url('edit.php?post_type=client_valuation'); ?>" class="quick-action">
                            <i class="dashicons dashicons-plus"></i>
                            New Valuation
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=bridgeland-clients'); ?>" class="quick-action">
                            <i class="dashicons dashicons-groups"></i>
                            Manage Clients
                        </a>
                        <a href="<?php echo admin_url('edit.php?post_type=support_ticket'); ?>" class="quick-action">
                            <i class="dashicons dashicons-sos"></i>
                            Support Tickets
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=bridgeland-payments'); ?>" class="quick-action">
                            <i class="dashicons dashicons-money-alt"></i>
                            Payment History
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Client Management Page
     */
    public function client_management() {
        $clients = get_users(array(
            'role' => 'bridgeland_client',
            'meta_key' => 'registration_date',
            'orderby' => 'meta_value',
            'order' => 'DESC'
        ));
        ?>
        <div class="wrap bridgeland-admin">
            <h1>Client Management</h1>

            <div class="tablenav top">
                <div class="alignleft actions">
                    <button type="button" class="button" id="export-clients">Export Clients</button>
                    <button type="button" class="button button-primary" id="send-newsletter">Send Newsletter</button>
                </div>
                <div class="alignright">
                    <input type="search" id="client-search" placeholder="Search clients..." class="search-box">
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Projects</th>
                        <th>Status</th>
                        <th>Total Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) :
                        $client_projects = $this->get_client_projects($client->ID);
                        $total_paid = $this->get_client_total_paid($client->ID);
                        $status = get_user_meta($client->ID, 'client_status', true) ?: 'active';
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($client->display_name); ?></strong>
                            <div class="client-meta">
                                <?php echo get_user_meta($client->ID, 'company_name', true); ?>
                            </div>
                        </td>
                        <td><?php echo esc_html($client->user_email); ?></td>
                        <td><?php echo date('M j, Y', strtotime(get_user_meta($client->ID, 'registration_date', true))); ?></td>
                        <td>
                            <span class="project-count"><?php echo count($client_projects); ?></span>
                            <?php if ($client_projects) : ?>
                                <div class="project-list">
                                    <?php foreach (array_slice($client_projects, 0, 3) as $project) : ?>
                                        <div class="project-item">
                                            <a href="<?php echo get_edit_post_link($project->ID); ?>"><?php echo esc_html($project->post_title); ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <select class="client-status" data-client-id="<?php echo $client->ID; ?>">
                                <option value="active" <?php selected($status, 'active'); ?>>Active</option>
                                <option value="inactive" <?php selected($status, 'inactive'); ?>>Inactive</option>
                                <option value="suspended" <?php selected($status, 'suspended'); ?>>Suspended</option>
                            </select>
                        </td>
                        <td>$<?php echo number_format($total_paid, 2); ?></td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="button button-small" onclick="viewClient(<?php echo $client->ID; ?>)">View</button>
                                <button type="button" class="button button-small" onclick="emailClient(<?php echo $client->ID; ?>)">Email</button>
                                <button type="button" class="button button-small" onclick="loginAsClient(<?php echo $client->ID; ?>)">Login As</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * Project Management Page
     */
    public function project_management() {
        $projects = get_posts(array(
            'post_type' => 'client_valuation',
            'posts_per_page' => -1,
            'post_status' => array('draft', 'pending', 'published')
        ));
        ?>
        <div class="wrap bridgeland-admin">
            <h1>Project Management</h1>

            <div class="project-filters">
                <select id="filter-status">
                    <option value="">All Statuses</option>
                    <option value="initiated">Initiated</option>
                    <option value="in_progress">In Progress</option>
                    <option value="review">Under Review</option>
                    <option value="completed">Completed</option>
                </select>

                <select id="filter-service">
                    <option value="">All Services</option>
                    <option value="basic_409a">Basic 409A</option>
                    <option value="premium_409a">Premium 409A</option>
                    <option value="financial_modeling">Financial Modeling</option>
                    <option value="due_diligence">Due Diligence</option>
                </select>

                <input type="date" id="filter-date-from" placeholder="From Date">
                <input type="date" id="filter-date-to" placeholder="To Date">
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Service Type</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project) :
                        $client_email = get_post_meta($project->ID, '_client_email', true);
                        $service_type = get_post_meta($project->ID, '_service_type', true);
                        $status = get_post_meta($project->ID, '_status', true) ?: 'initiated';
                        $due_date = get_post_meta($project->ID, '_due_date', true);
                        $progress = get_post_meta($project->ID, '_progress', true) ?: 0;
                    ?>
                    <tr>
                        <td>
                            <strong>
                                <a href="<?php echo get_edit_post_link($project->ID); ?>"><?php echo esc_html($project->post_title); ?></a>
                            </strong>
                            <div class="project-meta">
                                Created: <?php echo get_the_date('M j, Y', $project->ID); ?>
                            </div>
                        </td>
                        <td><?php echo esc_html($client_email); ?></td>
                        <td><?php echo esc_html($service_type); ?></td>
                        <td>
                            <select class="project-status" data-project-id="<?php echo $project->ID; ?>">
                                <option value="initiated" <?php selected($status, 'initiated'); ?>>Initiated</option>
                                <option value="in_progress" <?php selected($status, 'in_progress'); ?>>In Progress</option>
                                <option value="review" <?php selected($status, 'review'); ?>>Under Review</option>
                                <option value="completed" <?php selected($status, 'completed'); ?>>Completed</option>
                            </select>
                        </td>
                        <td>
                            <?php if ($due_date) : ?>
                                <?php echo date('M j, Y', strtotime($due_date)); ?>
                            <?php else : ?>
                                <span class="text-muted">Not set</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div>
                                <span class="progress-text"><?php echo $progress; ?>%</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="button button-small" onclick="editProject(<?php echo $project->ID; ?>)">Edit</button>
                                <button type="button" class="button button-small" onclick="generateReport(<?php echo $project->ID; ?>)">Report</button>
                                <button type="button" class="button button-small" onclick="notifyClient(<?php echo $project->ID; ?>)">Notify</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * Payment Management Page
     */
    public function payment_management() {
        $payments = get_posts(array(
            'post_type' => 'payment_order',
            'posts_per_page' => -1,
            'post_status' => array('pending', 'completed', 'failed')
        ));
        ?>
        <div class="wrap bridgeland-admin">
            <h1>Payment Management</h1>

            <div class="payment-summary">
                <div class="summary-card">
                    <h3>Total Revenue</h3>
                    <p class="amount">$<?php echo number_format($this->get_total_revenue(), 2); ?></p>
                </div>
                <div class="summary-card">
                    <h3>This Month</h3>
                    <p class="amount">$<?php echo number_format($this->get_monthly_revenue(), 2); ?></p>
                </div>
                <div class="summary-card">
                    <h3>Pending</h3>
                    <p class="amount">$<?php echo number_format($this->get_pending_payments(), 2); ?></p>
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment) :
                        $client_name = get_post_meta($payment->ID, '_client_name', true);
                        $service_type = get_post_meta($payment->ID, '_service_type', true);
                        $amount = get_post_meta($payment->ID, '_amount', true);
                        $payment_status = get_post_meta($payment->ID, '_payment_status', true);
                        $transaction_id = get_post_meta($payment->ID, '_transaction_id', true);
                    ?>
                    <tr>
                        <td>
                            <strong>#<?php echo $payment->ID; ?></strong>
                            <?php if ($transaction_id) : ?>
                                <div class="transaction-id">TXN: <?php echo esc_html($transaction_id); ?></div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($client_name); ?></td>
                        <td><?php echo esc_html($service_type); ?></td>
                        <td>$<?php echo number_format($amount, 2); ?></td>
                        <td><?php echo bridgeland_payment_status_badge($payment_status); ?></td>
                        <td><?php echo get_the_date('M j, Y g:i A', $payment->ID); ?></td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="button button-small" onclick="viewPayment(<?php echo $payment->ID; ?>)">View</button>
                                <?php if ($payment_status === 'completed') : ?>
                                    <button type="button" class="button button-small" onclick="refundPayment(<?php echo $payment->ID; ?>)">Refund</button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * Admin Settings Page
     */
    public function admin_settings() {
        ?>
        <div class="wrap bridgeland-admin">
            <h1>Bridgeland Settings</h1>

            <form method="post" action="options.php">
                <?php settings_fields('bridgeland_settings'); ?>

                <div class="settings-grid">
                    <div class="settings-section">
                        <h2>Business Settings</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Default Service Rate</th>
                                <td>
                                    <input type="number" name="default_service_rate" value="<?php echo get_option('default_service_rate', 2500); ?>" class="regular-text" />
                                    <p class="description">Default hourly rate for services</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Project Turnaround</th>
                                <td>
                                    <input type="number" name="default_turnaround" value="<?php echo get_option('default_turnaround', 7); ?>" class="small-text" />
                                    <span>business days</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="settings-section">
                        <h2>Notification Settings</h2>
                        <table class="form-table">
                            <tr>
                                <th scope="row">Email Notifications</th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="notify_new_client" value="1" <?php checked(get_option('notify_new_client'), 1); ?> />
                                        New client registration
                                    </label><br>
                                    <label>
                                        <input type="checkbox" name="notify_new_payment" value="1" <?php checked(get_option('notify_new_payment'), 1); ?> />
                                        New payment received
                                    </label><br>
                                    <label>
                                        <input type="checkbox" name="notify_support_ticket" value="1" <?php checked(get_option('notify_support_ticket'), 1); ?> />
                                        New support ticket
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    // Helper Methods
    private function get_total_clients() {
        return count(get_users(array('role' => 'bridgeland_client')));
    }

    private function get_active_projects() {
        $projects = get_posts(array(
            'post_type' => 'client_valuation',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_status',
                    'value' => array('initiated', 'in_progress'),
                    'compare' => 'IN'
                )
            )
        ));
        return count($projects);
    }

    private function get_monthly_revenue() {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');

        $payments = get_posts(array(
            'post_type' => 'payment_order',
            'posts_per_page' => -1,
            'date_query' => array(
                array(
                    'after' => $start_date,
                    'before' => $end_date,
                    'inclusive' => true
                )
            ),
            'meta_query' => array(
                array(
                    'key' => '_payment_status',
                    'value' => 'completed'
                )
            )
        ));

        $total = 0;
        foreach ($payments as $payment) {
            $total += floatval(get_post_meta($payment->ID, '_amount', true));
        }
        return $total;
    }

    private function get_pending_tickets() {
        $tickets = get_posts(array(
            'post_type' => 'support_ticket',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_status',
                    'value' => 'open'
                )
            )
        ));
        return count($tickets);
    }

    private function display_recent_activity() {
        // Implementation for recent activity display
        echo '<div class="activity-item">New client registration - John Doe</div>';
        echo '<div class="activity-item">Payment completed - $2,500</div>';
        echo '<div class="activity-item">Valuation report generated</div>';
    }

    public function admin_init() {
        register_setting('bridgeland_settings', 'default_service_rate');
        register_setting('bridgeland_settings', 'default_turnaround');
        register_setting('bridgeland_settings', 'notify_new_client');
        register_setting('bridgeland_settings', 'notify_new_payment');
        register_setting('bridgeland_settings', 'notify_support_ticket');
    }
}

// Initialize admin interface
$bridgeland_admin = new BridgelandAdmin();
$bridgeland_admin->__init();
?>