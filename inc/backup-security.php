<?php
/**
 * Backup and Security Systems
 * Comprehensive security monitoring and automated backup solutions
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandBackupSecurity {

    private $security_logs;
    private $backup_schedules;

    public function __init() {
        add_action('init', array($this, 'init_security_system'));
        add_action('wp_ajax_create_backup', array($this, 'create_backup'));
        add_action('wp_ajax_restore_backup', array($this, 'restore_backup'));
        add_action('wp_ajax_run_security_scan', array($this, 'run_security_scan'));
        add_action('wp_ajax_update_security_settings', array($this, 'update_security_settings'));

        // Security monitoring hooks
        add_action('wp_login_failed', array($this, 'log_failed_login'), 10, 2);
        add_action('wp_login', array($this, 'log_successful_login'), 10, 2);
        add_action('wp_logout', array($this, 'log_logout'));
        add_filter('authenticate', array($this, 'check_brute_force'), 30, 3);

        // File monitoring
        add_action('activated_plugin', array($this, 'log_plugin_activation'));
        add_action('deactivated_plugin', array($this, 'log_plugin_deactivation'));

        // Scheduled tasks
        add_action('bridgeland_daily_backup', array($this, 'daily_backup'));
        add_action('bridgeland_weekly_security_scan', array($this, 'weekly_security_scan'));

        if (!wp_next_scheduled('bridgeland_daily_backup')) {
            wp_schedule_event(time(), 'daily', 'bridgeland_daily_backup');
        }

        if (!wp_next_scheduled('bridgeland_weekly_security_scan')) {
            wp_schedule_event(time(), 'weekly', 'bridgeland_weekly_security_scan');
        }

        // Initialize arrays
        $this->security_logs = array();
        $this->backup_schedules = array();
    }

    /**
     * Initialize Security System
     */
    public function init_security_system() {
        $this->setup_security_headers();
        $this->register_security_post_types();
        $this->setup_file_monitoring();
        $this->init_firewall_rules();
    }

    /**
     * Setup Security Headers
     */
    private function setup_security_headers() {
        if (!is_admin()) {
            // Content Security Policy
            header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self';");

            // Additional security headers
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
            header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        }
    }

    /**
     * Register Security-Related Post Types
     */
    private function register_security_post_types() {
        // Security Logs
        register_post_type('security_log', array(
            'labels' => array(
                'name' => 'Security Logs',
                'singular_name' => 'Security Log',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Backup Records
        register_post_type('backup_record', array(
            'labels' => array(
                'name' => 'Backup Records',
                'singular_name' => 'Backup Record',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));

        // Security Scans
        register_post_type('security_scan', array(
            'labels' => array(
                'name' => 'Security Scans',
                'singular_name' => 'Security Scan',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => 'bridgeland-dashboard',
            'supports' => array('title'),
            'capability_type' => 'post',
        ));
    }

    /**
     * Create Backup
     */
    public function create_backup() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce') || !current_user_can('manage_options')) {
            wp_die('Security check failed');
        }

        $backup_type = sanitize_text_field($_POST['backup_type'] ?? 'full');
        $backup_description = sanitize_text_field($_POST['description'] ?? '');

        $backup_result = $this->perform_backup($backup_type, $backup_description);

        if ($backup_result['success']) {
            wp_send_json_success(array(
                'message' => 'Backup created successfully',
                'backup_id' => $backup_result['backup_id'],
                'file_size' => $backup_result['file_size'],
                'file_path' => $backup_result['file_path']
            ));
        } else {
            wp_send_json_error($backup_result['error']);
        }
    }

    /**
     * Perform Backup
     */
    private function perform_backup($type = 'full', $description = '') {
        $backup_dir = WP_CONTENT_DIR . '/backups/';
        if (!file_exists($backup_dir)) {
            wp_mkdir_p($backup_dir);
        }

        $timestamp = current_time('Y-m-d_H-i-s');
        $backup_filename = "bridgeland_backup_{$type}_{$timestamp}.zip";
        $backup_path = $backup_dir . $backup_filename;

        try {
            $zip = new ZipArchive();
            if ($zip->open($backup_path, ZipArchive::CREATE) !== TRUE) {
                return array('success' => false, 'error' => 'Could not create backup file');
            }

            // Database backup
            $db_backup = $this->backup_database();
            if ($db_backup) {
                $zip->addFromString('database.sql', $db_backup);
            }

            // Files backup
            switch ($type) {
                case 'full':
                    $this->add_directory_to_zip($zip, ABSPATH, '');
                    break;
                case 'theme':
                    $this->add_directory_to_zip($zip, get_template_directory(), 'theme/');
                    break;
                case 'uploads':
                    $this->add_directory_to_zip($zip, WP_CONTENT_DIR . '/uploads/', 'uploads/');
                    break;
                case 'database':
                    // Database already added above
                    break;
            }

            $zip->close();

            // Create backup record
            $backup_id = wp_insert_post(array(
                'post_title' => 'Backup - ' . ucfirst($type) . ' - ' . $timestamp,
                'post_type' => 'backup_record',
                'post_status' => 'private'
            ));

            if ($backup_id) {
                update_post_meta($backup_id, '_backup_type', $type);
                update_post_meta($backup_id, '_backup_file', $backup_filename);
                update_post_meta($backup_id, '_backup_path', $backup_path);
                update_post_meta($backup_id, '_file_size', filesize($backup_path));
                update_post_meta($backup_id, '_description', $description);
                update_post_meta($backup_id, '_created_date', current_time('mysql'));
                update_post_meta($backup_id, '_created_by', get_current_user_id());
            }

            return array(
                'success' => true,
                'backup_id' => $backup_id,
                'file_size' => filesize($backup_path),
                'file_path' => $backup_path
            );

        } catch (Exception $e) {
            return array('success' => false, 'error' => $e->getMessage());
        }
    }

    /**
     * Backup Database
     */
    private function backup_database() {
        global $wpdb;

        $sql_dump = "-- Bridgeland Advisors Database Backup\n";
        $sql_dump .= "-- Generated on: " . current_time('c') . "\n\n";

        // Get all tables
        $tables = $wpdb->get_results('SHOW TABLES', ARRAY_N);

        foreach ($tables as $table) {
            $table_name = $table[0];

            // Skip cache and temp tables
            if (strpos($table_name, '_cache') !== false || strpos($table_name, '_temp') !== false) {
                continue;
            }

            $sql_dump .= "\n-- Table: $table_name\n";
            $sql_dump .= "DROP TABLE IF EXISTS `$table_name`;\n";

            // Table structure
            $create_table = $wpdb->get_row("SHOW CREATE TABLE `$table_name`", ARRAY_N);
            $sql_dump .= $create_table[1] . ";\n\n";

            // Table data
            $rows = $wpdb->get_results("SELECT * FROM `$table_name`", ARRAY_N);

            if (!empty($rows)) {
                $sql_dump .= "INSERT INTO `$table_name` VALUES\n";
                $row_strings = array();

                foreach ($rows as $row) {
                    $escaped_row = array_map(array($wpdb, '_real_escape'), $row);
                    $row_strings[] = "('" . implode("','", $escaped_row) . "')";
                }

                $sql_dump .= implode(",\n", $row_strings) . ";\n\n";
            }
        }

        return $sql_dump;
    }

    /**
     * Add Directory to Zip
     */
    private function add_directory_to_zip($zip, $dir, $zip_dir) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $file_path = $file->getRealPath();
                $relative_path = $zip_dir . substr($file_path, strlen($dir) + 1);

                // Skip certain files
                $exclude_patterns = array(
                    '/\.git/',
                    '/node_modules/',
                    '/\.DS_Store',
                    '/Thumbs.db',
                    '/backups/',
                    '/cache/'
                );

                $skip = false;
                foreach ($exclude_patterns as $pattern) {
                    if (preg_match($pattern, $relative_path)) {
                        $skip = true;
                        break;
                    }
                }

                if (!$skip) {
                    $zip->addFile($file_path, $relative_path);
                }
            }
        }
    }

    /**
     * Run Security Scan
     */
    public function run_security_scan() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce') || !current_user_can('manage_options')) {
            wp_die('Security check failed');
        }

        $scan_type = sanitize_text_field($_POST['scan_type'] ?? 'full');
        $scan_results = $this->perform_security_scan($scan_type);

        // Create scan record
        $scan_id = wp_insert_post(array(
            'post_title' => 'Security Scan - ' . ucfirst($scan_type) . ' - ' . current_time('Y-m-d H:i:s'),
            'post_type' => 'security_scan',
            'post_status' => 'private',
            'post_content' => json_encode($scan_results)
        ));

        if ($scan_id) {
            update_post_meta($scan_id, '_scan_type', $scan_type);
            update_post_meta($scan_id, '_issues_found', count($scan_results['issues']));
            update_post_meta($scan_id, '_risk_level', $scan_results['risk_level']);
            update_post_meta($scan_id, '_scan_date', current_time('mysql'));
        }

        wp_send_json_success(array(
            'scan_id' => $scan_id,
            'results' => $scan_results,
            'recommendations' => $this->get_security_recommendations($scan_results)
        ));
    }

    /**
     * Perform Security Scan
     */
    private function perform_security_scan($type = 'full') {
        $issues = array();
        $checks_performed = array();

        // File permission checks
        if ($type === 'full' || $type === 'files') {
            $file_issues = $this->check_file_permissions();
            $issues = array_merge($issues, $file_issues);
            $checks_performed[] = 'file_permissions';
        }

        // Plugin security checks
        if ($type === 'full' || $type === 'plugins') {
            $plugin_issues = $this->check_plugin_security();
            $issues = array_merge($issues, $plugin_issues);
            $checks_performed[] = 'plugin_security';
        }

        // User account checks
        if ($type === 'full' || $type === 'users') {
            $user_issues = $this->check_user_security();
            $issues = array_merge($issues, $user_issues);
            $checks_performed[] = 'user_security';
        }

        // Configuration checks
        if ($type === 'full' || $type === 'config') {
            $config_issues = $this->check_configuration_security();
            $issues = array_merge($issues, $config_issues);
            $checks_performed[] = 'configuration';
        }

        // Database security
        if ($type === 'full' || $type === 'database') {
            $db_issues = $this->check_database_security();
            $issues = array_merge($issues, $db_issues);
            $checks_performed[] = 'database';
        }

        // Determine risk level
        $risk_level = $this->calculate_risk_level($issues);

        return array(
            'issues' => $issues,
            'checks_performed' => $checks_performed,
            'risk_level' => $risk_level,
            'scan_date' => current_time('c'),
            'total_issues' => count($issues)
        );
    }

    /**
     * Check File Permissions
     */
    private function check_file_permissions() {
        $issues = array();

        // Check wp-config.php
        if (file_exists(ABSPATH . 'wp-config.php')) {
            $perms = fileperms(ABSPATH . 'wp-config.php') & 0777;
            if ($perms !== 0644) {
                $issues[] = array(
                    'type' => 'file_permissions',
                    'severity' => 'high',
                    'description' => 'wp-config.php has incorrect permissions',
                    'current_value' => decoct($perms),
                    'recommended_value' => '644'
                );
            }
        }

        // Check .htaccess
        if (file_exists(ABSPATH . '.htaccess')) {
            $perms = fileperms(ABSPATH . '.htaccess') & 0777;
            if ($perms !== 0644) {
                $issues[] = array(
                    'type' => 'file_permissions',
                    'severity' => 'medium',
                    'description' => '.htaccess has incorrect permissions',
                    'current_value' => decoct($perms),
                    'recommended_value' => '644'
                );
            }
        }

        // Check uploads directory
        $uploads_dir = wp_upload_dir();
        if (is_dir($uploads_dir['basedir'])) {
            $perms = fileperms($uploads_dir['basedir']) & 0777;
            if ($perms > 0755) {
                $issues[] = array(
                    'type' => 'file_permissions',
                    'severity' => 'medium',
                    'description' => 'Uploads directory has overly permissive permissions',
                    'current_value' => decoct($perms),
                    'recommended_value' => '755'
                );
            }
        }

        return $issues;
    }

    /**
     * Check Plugin Security
     */
    private function check_plugin_security() {
        $issues = array();

        // Get all plugins
        $all_plugins = get_plugins();
        $active_plugins = get_option('active_plugins');

        foreach ($all_plugins as $plugin_file => $plugin_data) {
            // Check for outdated plugins
            if (in_array($plugin_file, $active_plugins)) {
                $update_plugins = get_site_transient('update_plugins');
                if (isset($update_plugins->response[$plugin_file])) {
                    $issues[] = array(
                        'type' => 'plugin_security',
                        'severity' => 'medium',
                        'description' => 'Plugin needs update: ' . $plugin_data['Name'],
                        'current_value' => $plugin_data['Version'],
                        'recommended_value' => $update_plugins->response[$plugin_file]->new_version
                    );
                }
            }
        }

        // Check for inactive plugins
        foreach ($all_plugins as $plugin_file => $plugin_data) {
            if (!in_array($plugin_file, $active_plugins)) {
                $issues[] = array(
                    'type' => 'plugin_security',
                    'severity' => 'low',
                    'description' => 'Inactive plugin should be removed: ' . $plugin_data['Name'],
                    'current_value' => 'inactive',
                    'recommended_value' => 'remove'
                );
            }
        }

        return $issues;
    }

    /**
     * Check User Security
     */
    private function check_user_security() {
        $issues = array();

        // Check for admin user with username 'admin'
        $admin_user = get_user_by('login', 'admin');
        if ($admin_user) {
            $issues[] = array(
                'type' => 'user_security',
                'severity' => 'high',
                'description' => 'Default admin username detected',
                'current_value' => 'admin',
                'recommended_value' => 'change to unique username'
            );
        }

        // Check for users with weak passwords (simplified check)
        $users = get_users(array('role' => 'administrator'));
        foreach ($users as $user) {
            // This is a simplified check - in production, you'd want more sophisticated password analysis
            if (strlen($user->user_pass) < 60) { // WordPress hashes are typically 60+ chars
                $issues[] = array(
                    'type' => 'user_security',
                    'severity' => 'medium',
                    'description' => 'Potentially weak password for user: ' . $user->user_login,
                    'current_value' => 'weak',
                    'recommended_value' => 'strong password'
                );
            }
        }

        return $issues;
    }

    /**
     * Check Configuration Security
     */
    private function check_configuration_security() {
        $issues = array();

        // Check if debug mode is enabled
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $issues[] = array(
                'type' => 'configuration',
                'severity' => 'medium',
                'description' => 'Debug mode is enabled',
                'current_value' => 'true',
                'recommended_value' => 'false'
            );
        }

        // Check if file editing is allowed
        if (!defined('DISALLOW_FILE_EDIT') || !DISALLOW_FILE_EDIT) {
            $issues[] = array(
                'type' => 'configuration',
                'severity' => 'high',
                'description' => 'File editing is not disabled',
                'current_value' => 'enabled',
                'recommended_value' => 'disabled'
            );
        }

        // Check SSL
        if (!is_ssl()) {
            $issues[] = array(
                'type' => 'configuration',
                'severity' => 'high',
                'description' => 'SSL is not enabled',
                'current_value' => 'http',
                'recommended_value' => 'https'
            );
        }

        return $issues;
    }

    /**
     * Check Database Security
     */
    private function check_database_security() {
        global $wpdb;
        $issues = array();

        // Check table prefix
        if ($wpdb->prefix === 'wp_') {
            $issues[] = array(
                'type' => 'database',
                'severity' => 'medium',
                'description' => 'Default database table prefix is being used',
                'current_value' => 'wp_',
                'recommended_value' => 'unique prefix'
            );
        }

        // Check for SQL injection vulnerabilities (basic check)
        $suspicious_patterns = array(
            'UNION SELECT',
            'DROP TABLE',
            '1=1',
            'OR 1=1'
        );

        // This is a very basic check - in production, use more sophisticated detection
        foreach ($suspicious_patterns as $pattern) {
            // Check recent post content for suspicious patterns
            $posts = get_posts(array(
                'post_type' => 'any',
                'posts_per_page' => 100,
                'date_query' => array(
                    array(
                        'after' => '1 week ago'
                    )
                )
            ));

            foreach ($posts as $post) {
                if (stripos($post->post_content, $pattern) !== false) {
                    $issues[] = array(
                        'type' => 'database',
                        'severity' => 'critical',
                        'description' => 'Suspicious SQL pattern found in post content',
                        'current_value' => $pattern,
                        'recommended_value' => 'investigate immediately'
                    );
                    break 2; // Break out of both loops
                }
            }
        }

        return $issues;
    }

    /**
     * Calculate Risk Level
     */
    private function calculate_risk_level($issues) {
        $critical = 0;
        $high = 0;
        $medium = 0;
        $low = 0;

        foreach ($issues as $issue) {
            switch ($issue['severity']) {
                case 'critical':
                    $critical++;
                    break;
                case 'high':
                    $high++;
                    break;
                case 'medium':
                    $medium++;
                    break;
                case 'low':
                    $low++;
                    break;
            }
        }

        if ($critical > 0) return 'critical';
        if ($high > 2) return 'high';
        if ($high > 0 || $medium > 3) return 'medium';
        if ($medium > 0 || $low > 5) return 'low';

        return 'minimal';
    }

    /**
     * Get Security Recommendations
     */
    private function get_security_recommendations($scan_results) {
        $recommendations = array();

        foreach ($scan_results['issues'] as $issue) {
            switch ($issue['type']) {
                case 'file_permissions':
                    $recommendations[] = "Fix file permissions: Set {$issue['description']} to {$issue['recommended_value']}";
                    break;
                case 'plugin_security':
                    $recommendations[] = "Update plugins: {$issue['description']}";
                    break;
                case 'user_security':
                    $recommendations[] = "Strengthen user security: {$issue['description']}";
                    break;
                case 'configuration':
                    $recommendations[] = "Update configuration: {$issue['description']}";
                    break;
                case 'database':
                    $recommendations[] = "Database security: {$issue['description']}";
                    break;
            }
        }

        return $recommendations;
    }

    /**
     * Security Monitoring
     */
    public function log_failed_login($username, $error) {
        $this->log_security_event('failed_login', array(
            'username' => $username,
            'error' => $error->get_error_message(),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ));
    }

    public function log_successful_login($user_login, $user) {
        $this->log_security_event('successful_login', array(
            'user_id' => $user->ID,
            'username' => $user_login,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ));
    }

    public function check_brute_force($user, $username, $password) {
        if (empty($username)) return $user;

        $ip = $_SERVER['REMOTE_ADDR'];
        $failed_attempts = get_transient('failed_login_' . $ip) ?: 0;

        if ($failed_attempts >= 5) {
            $this->log_security_event('brute_force_blocked', array(
                'ip_address' => $ip,
                'username' => $username,
                'attempts' => $failed_attempts
            ));

            return new WP_Error('too_many_attempts', 'Too many failed login attempts. Please try again later.');
        }

        return $user;
    }

    private function log_security_event($event_type, $data) {
        $log_id = wp_insert_post(array(
            'post_title' => 'Security Event - ' . ucfirst(str_replace('_', ' ', $event_type)),
            'post_type' => 'security_log',
            'post_status' => 'private',
            'post_content' => json_encode($data)
        ));

        if ($log_id) {
            update_post_meta($log_id, '_event_type', $event_type);
            update_post_meta($log_id, '_ip_address', $data['ip_address'] ?? '');
            update_post_meta($log_id, '_user_agent', $data['user_agent'] ?? '');
            update_post_meta($log_id, '_timestamp', current_time('mysql'));
        }

        // Update failed login counter
        if ($event_type === 'failed_login') {
            $ip = $data['ip_address'];
            $attempts = get_transient('failed_login_' . $ip) ?: 0;
            set_transient('failed_login_' . $ip, $attempts + 1, HOUR_IN_SECONDS);
        }
    }

    /**
     * Daily Backup
     */
    public function daily_backup() {
        $backup_result = $this->perform_backup('database', 'Automated daily backup');

        if ($backup_result['success']) {
            // Send notification email
            wp_mail(
                get_option('admin_email'),
                'Daily Backup Completed - Bridgeland Advisors',
                "Daily backup completed successfully.\n\nBackup ID: {$backup_result['backup_id']}\nFile Size: " . size_format($backup_result['file_size'])
            );
        } else {
            // Send error notification
            wp_mail(
                get_option('admin_email'),
                'Daily Backup Failed - Bridgeland Advisors',
                "Daily backup failed.\n\nError: {$backup_result['error']}"
            );
        }
    }

    /**
     * Weekly Security Scan
     */
    public function weekly_security_scan() {
        $scan_results = $this->perform_security_scan('full');

        // Send security report
        $message = "Weekly security scan completed.\n\n";
        $message .= "Risk Level: " . strtoupper($scan_results['risk_level']) . "\n";
        $message .= "Issues Found: " . count($scan_results['issues']) . "\n\n";

        if (!empty($scan_results['issues'])) {
            $message .= "Issues:\n";
            foreach ($scan_results['issues'] as $issue) {
                $message .= "- [{$issue['severity']}] {$issue['description']}\n";
            }
        }

        wp_mail(
            get_option('admin_email'),
            'Weekly Security Report - Bridgeland Advisors',
            $message
        );
    }

    /**
     * Setup File Monitoring
     */
    private function setup_file_monitoring() {
        // Monitor critical files for changes
        $critical_files = array(
            ABSPATH . 'wp-config.php',
            ABSPATH . '.htaccess',
            get_template_directory() . '/functions.php'
        );

        foreach ($critical_files as $file) {
            if (file_exists($file)) {
                $current_hash = md5_file($file);
                $stored_hash = get_option('file_hash_' . md5($file));

                if ($stored_hash && $stored_hash !== $current_hash) {
                    $this->log_security_event('file_modified', array(
                        'file' => $file,
                        'old_hash' => $stored_hash,
                        'new_hash' => $current_hash
                    ));
                }

                update_option('file_hash_' . md5($file), $current_hash);
            }
        }
    }

    /**
     * Initialize Firewall Rules
     */
    private function init_firewall_rules() {
        // Block suspicious requests
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        $query_string = $_SERVER['QUERY_STRING'] ?? '';

        $suspicious_patterns = array(
            '/\.\./i', // Directory traversal
            '/union.*select/i', // SQL injection
            '/<script/i', // XSS
            '/eval\(/i', // Code injection
            '/base64_decode/i' // Encoded attacks
        );

        foreach ($suspicious_patterns as $pattern) {
            if (preg_match($pattern, $request_uri . $query_string)) {
                $this->log_security_event('suspicious_request_blocked', array(
                    'pattern' => $pattern,
                    'request_uri' => $request_uri,
                    'query_string' => $query_string,
                    'ip_address' => $_SERVER['REMOTE_ADDR']
                ));

                wp_die('Suspicious request blocked', 'Security Alert', array('response' => 403));
            }
        }
    }
}

// Initialize backup and security system
$bridgeland_backup_security = new BridgelandBackupSecurity();
$bridgeland_backup_security->__init();

// Security Settings
function bridgeland_security_settings() {
    add_settings_section('bridgeland_security', 'Security Settings', null, 'bridgeland_settings');

    add_settings_field('auto_backup_enabled', 'Enable Automatic Backups', 'bridgeland_auto_backup_field', 'bridgeland_settings', 'bridgeland_security');
    add_settings_field('security_scan_frequency', 'Security Scan Frequency', 'bridgeland_scan_frequency_field', 'bridgeland_settings', 'bridgeland_security');
    add_settings_field('failed_login_limit', 'Failed Login Limit', 'bridgeland_login_limit_field', 'bridgeland_settings', 'bridgeland_security');
}
add_action('admin_init', 'bridgeland_security_settings');

function bridgeland_auto_backup_field() {
    $value = get_option('auto_backup_enabled', 1);
    echo '<input type="checkbox" name="auto_backup_enabled" value="1"' . checked($value, 1, false) . ' /> Enable daily automatic backups';
}

function bridgeland_scan_frequency_field() {
    $value = get_option('security_scan_frequency', 'weekly');
    echo '<select name="security_scan_frequency">';
    echo '<option value="daily"' . selected($value, 'daily', false) . '>Daily</option>';
    echo '<option value="weekly"' . selected($value, 'weekly', false) . '>Weekly</option>';
    echo '<option value="monthly"' . selected($value, 'monthly', false) . '>Monthly</option>';
    echo '</select>';
}

function bridgeland_login_limit_field() {
    $value = get_option('failed_login_limit', 5);
    echo '<input type="number" name="failed_login_limit" value="' . esc_attr($value) . '" min="1" max="20" /> failed attempts before blocking IP';
}
?>