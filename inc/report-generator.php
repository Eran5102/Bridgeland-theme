<?php
/**
 * Valuation Report Generator
 * Professional PDF report generation for client valuations
 */

if (!defined('ABSPATH')) {
    exit;
}

class BridgelandReportGenerator {

    public function __init() {
        add_action('wp_ajax_generate_valuation_report', array($this, 'generate_valuation_report'));
        add_action('wp_ajax_nopriv_generate_valuation_report', array($this, 'generate_valuation_report'));
        add_action('wp_ajax_download_report', array($this, 'download_report'));
        add_action('wp_ajax_email_report', array($this, 'email_report'));
    }

    /**
     * Generate 409A Valuation Report
     */
    public function generate_valuation_report() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $valuation_id = intval($_POST['valuation_id']);
        $valuation = get_post($valuation_id);

        if (!$valuation || $valuation->post_type !== 'client_valuation') {
            wp_send_json_error('Invalid valuation');
        }

        // Get valuation data
        $company_data = json_decode(get_post_meta($valuation_id, '_company_data', true), true);
        $valuation_data = json_decode(get_post_meta($valuation_id, '_valuation_data', true), true);
        $calculation_results = json_decode(get_post_meta($valuation_id, '_calculation_results', true), true);

        // Generate report HTML
        $report_html = $this->generate_report_html($company_data, $valuation_data, $calculation_results);

        // Save report as PDF (using browser's print functionality for now)
        $report_id = wp_insert_post(array(
            'post_title' => $company_data['company_name'] . ' - 409A Valuation Report',
            'post_content' => $report_html,
            'post_status' => 'private',
            'post_type' => 'valuation_report',
            'post_author' => get_current_user_id()
        ));

        if ($report_id) {
            update_post_meta($report_id, '_valuation_id', $valuation_id);
            update_post_meta($report_id, '_company_data', wp_json_encode($company_data));
            update_post_meta($report_id, '_generated_date', current_time('mysql'));

            wp_send_json_success(array(
                'report_id' => $report_id,
                'download_url' => admin_url('admin-ajax.php?action=download_report&report_id=' . $report_id . '&nonce=' . wp_create_nonce('download_report')),
                'preview_url' => site_url('/report-preview/?report_id=' . $report_id)
            ));
        } else {
            wp_send_json_error('Failed to generate report');
        }
    }

    /**
     * Generate Professional Report HTML
     */
    private function generate_report_html($company_data, $valuation_data, $calculation_results) {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>409A Valuation Report - <?php echo esc_html($company_data['company_name']); ?></title>
            <style>
                body { font-family: 'Source Sans Pro', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; }
                .header { text-align: center; border-bottom: 3px solid #8B0000; padding-bottom: 20px; margin-bottom: 30px; }
                .company-logo { max-height: 80px; margin-bottom: 15px; }
                .report-title { color: #8B0000; font-size: 28px; font-weight: 700; margin: 0; }
                .report-subtitle { color: #666; font-size: 16px; margin: 5px 0; }
                .section { margin: 30px 0; page-break-inside: avoid; }
                .section-title { color: #8B0000; font-size: 20px; font-weight: 600; border-bottom: 2px solid #8B0000; padding-bottom: 5px; margin-bottom: 15px; }
                .data-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
                .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
                .data-table th { background-color: #f8f9fa; font-weight: 600; color: #8B0000; }
                .highlight-box { background: #f8f9fa; border-left: 4px solid #8B0000; padding: 20px; margin: 20px 0; }
                .valuation-summary { text-align: center; background: #8B0000; color: white; padding: 25px; border-radius: 8px; margin: 30px 0; }
                .valuation-amount { font-size: 36px; font-weight: 700; margin: 10px 0; }
                .methodology-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0; }
                .method-card { border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
                .footer { margin-top: 50px; padding-top: 20px; border-top: 2px solid #8B0000; text-align: center; color: #666; }
                @media print { body { margin: 0; } .section { page-break-inside: avoid; } }
            </style>
        </head>
        <body>
            <!-- Header -->
            <div class="header">
                <h1 class="report-title">409A Valuation Report</h1>
                <h2 class="report-subtitle"><?php echo esc_html($company_data['company_name']); ?></h2>
                <p>Valuation Date: <?php echo date('F j, Y'); ?></p>
                <p>Prepared by: Bridgeland Advisors</p>
            </div>

            <!-- Executive Summary -->
            <div class="section">
                <h2 class="section-title">Executive Summary</h2>
                <div class="valuation-summary">
                    <h3>Fair Market Value per Share</h3>
                    <div class="valuation-amount">$<?php echo number_format($calculation_results['fair_market_value'] ?? 0, 2); ?></div>
                    <p>Common Stock Valuation as of <?php echo date('F j, Y'); ?></p>
                </div>

                <div class="highlight-box">
                    <p><strong>Valuation Conclusion:</strong> Based on our comprehensive analysis using multiple valuation methodologies, the fair market value of the common stock of <?php echo esc_html($company_data['company_name']); ?> is $<?php echo number_format($calculation_results['fair_market_value'] ?? 0, 2); ?> per share.</p>
                </div>
            </div>

            <!-- Company Overview -->
            <div class="section">
                <h2 class="section-title">Company Overview</h2>
                <table class="data-table">
                    <tr><th>Company Name</th><td><?php echo esc_html($company_data['company_name']); ?></td></tr>
                    <tr><th>Industry</th><td><?php echo esc_html($company_data['industry'] ?? 'Technology'); ?></td></tr>
                    <tr><th>Stage</th><td><?php echo esc_html($company_data['stage'] ?? 'Growth'); ?></td></tr>
                    <tr><th>Founded</th><td><?php echo esc_html($company_data['founded_year'] ?? date('Y')); ?></td></tr>
                    <tr><th>Employees</th><td><?php echo number_format($company_data['employees'] ?? 0); ?></td></tr>
                    <tr><th>Revenue (TTM)</th><td>$<?php echo number_format($valuation_data['revenue'] ?? 0); ?></td></tr>
                </table>
            </div>

            <!-- Valuation Methodologies -->
            <div class="section">
                <h2 class="section-title">Valuation Methodologies</h2>
                <p>We employed multiple valuation approaches to determine the fair market value:</p>

                <div class="methodology-grid">
                    <div class="method-card">
                        <h4>Venture Capital Method</h4>
                        <p><strong>Result:</strong> $<?php echo number_format($calculation_results['vc_method_value'] ?? 0, 2); ?></p>
                        <p>Exit multiple: <?php echo $calculation_results['exit_multiple'] ?? 'N/A'; ?>x</p>
                        <p>Time to exit: <?php echo $calculation_results['time_to_exit'] ?? 'N/A'; ?> years</p>
                    </div>

                    <div class="method-card">
                        <h4>Scorecard Method</h4>
                        <p><strong>Result:</strong> $<?php echo number_format($calculation_results['scorecard_value'] ?? 0, 2); ?></p>
                        <p>Overall score: <?php echo $calculation_results['scorecard_score'] ?? 'N/A'; ?>%</p>
                        <p>Comparable median: $<?php echo number_format($calculation_results['comparable_median'] ?? 0); ?></p>
                    </div>
                </div>

                <?php if (isset($calculation_results['dcf_value'])) : ?>
                <div class="method-card">
                    <h4>Discounted Cash Flow (DCF)</h4>
                    <p><strong>Result:</strong> $<?php echo number_format($calculation_results['dcf_value'], 2); ?></p>
                    <p>Discount rate: <?php echo $calculation_results['discount_rate'] ?? 'N/A'; ?>%</p>
                    <p>Terminal growth: <?php echo $calculation_results['terminal_growth'] ?? 'N/A'; ?>%</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Key Assumptions -->
            <div class="section">
                <h2 class="section-title">Key Assumptions & Risk Factors</h2>
                <div class="highlight-box">
                    <h4>Key Assumptions:</h4>
                    <ul>
                        <li>Revenue growth rate: <?php echo ($valuation_data['growth_rate'] ?? 0); ?>% annually</li>
                        <li>Market conditions remain stable</li>
                        <li>No material changes to business model</li>
                        <li>Continued access to capital markets</li>
                    </ul>

                    <h4>Risk Factors:</h4>
                    <ul>
                        <li>Market competition and disruption</li>
                        <li>Regulatory changes</li>
                        <li>Key personnel retention</li>
                        <li>Technology obsolescence</li>
                    </ul>
                </div>
            </div>

            <!-- Disclaimers -->
            <div class="section">
                <h2 class="section-title">Disclaimers</h2>
                <p>This valuation report has been prepared for internal use and compliance with Section 409A of the Internal Revenue Code. The valuation reflects our professional judgment based on information available as of the valuation date.</p>

                <p><strong>Important:</strong> This report should not be used for any purpose other than 409A compliance. The fair market value determined herein may not be appropriate for other purposes such as financial reporting, tax planning, or transaction pricing.</p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p><strong>Bridgeland Advisors</strong></p>
                <p>Professional Valuation & Financial Advisory Services</p>
                <p>eran@bridgeland-advisors.com | +972-50-6842937</p>
                <p>This report contains confidential and proprietary information</p>
            </div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }

    /**
     * Download Report as PDF
     */
    public function download_report() {
        if (!wp_verify_nonce($_GET['nonce'], 'download_report')) {
            wp_die('Security check failed');
        }

        $report_id = intval($_GET['report_id']);
        $report = get_post($report_id);

        if (!$report || $report->post_type !== 'valuation_report') {
            wp_die('Invalid report');
        }

        // Set headers for PDF download
        header('Content-Type: text/html; charset=UTF-8');
        header('Content-Disposition: inline; filename="409A_Valuation_Report_' . $report_id . '.html"');

        echo $report->post_content;
        exit;
    }

    /**
     * Email Report to Client
     */
    public function email_report() {
        if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
            wp_die('Security check failed');
        }

        $report_id = intval($_POST['report_id']);
        $client_email = sanitize_email($_POST['client_email']);
        $message = sanitize_textarea_field($_POST['message']);

        $report = get_post($report_id);
        if (!$report) {
            wp_send_json_error('Invalid report');
        }

        $company_data = json_decode(get_post_meta($report_id, '_company_data', true), true);

        $subject = '409A Valuation Report - ' . $company_data['company_name'];
        $body = "Dear Client,\n\n";
        $body .= "Please find attached your 409A valuation report for " . $company_data['company_name'] . ".\n\n";
        $body .= $message . "\n\n";
        $body .= "Best regards,\nBridgeland Advisors Team\n\n";
        $body .= "Report can be viewed at: " . site_url('/report-preview/?report_id=' . $report_id);

        $sent = wp_mail($client_email, $subject, $body);

        if ($sent) {
            wp_send_json_success('Report sent successfully');
        } else {
            wp_send_json_error('Failed to send report');
        }
    }
}

// Initialize the report generator
$bridgeland_report_generator = new BridgelandReportGenerator();
$bridgeland_report_generator->__init();

// Register valuation_report post type
function register_valuation_report_post_type() {
    register_post_type('valuation_report', array(
        'labels' => array(
            'name' => 'Valuation Reports',
            'singular_name' => 'Valuation Report',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=client_valuation',
        'supports' => array('title', 'editor'),
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => 'manage_options',
        )
    ));
}
add_action('init', 'register_valuation_report_post_type');
?>