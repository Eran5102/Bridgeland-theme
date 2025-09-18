<?php
/**
 * Bridgeland Advisors v2 Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add custom rewrite rules for article pages
function bridgeland_add_article_rewrites() {
    $articles = array(
        'ai-impact-startup-valuations',
        '2025-409a-valuation-changes',
        'series-a-fundraising-strategies-2025',
        'advanced-dcf-modeling-tech-startups',
        'exit-waterfall-50m-acquisition-case-study',
        '2025-sec-updates-private-markets',
        '2025-startup-valuation-outlook'
    );

    foreach ($articles as $article) {
        add_rewrite_rule(
            '^' . $article . '/?$',
            'index.php?article_page=' . $article,
            'top'
        );
    }
}
add_action('init', 'bridgeland_add_article_rewrites');

// Add query vars for article pages
function bridgeland_add_query_vars($vars) {
    $vars[] = 'article_page';
    return $vars;
}
add_filter('query_vars', 'bridgeland_add_query_vars');

// Template redirect for article pages
function bridgeland_template_redirect() {
    $article_page = get_query_var('article_page');
    if ($article_page) {
        $template_file = 'page-' . $article_page . '.php';
        if (file_exists(get_template_directory() . '/' . $template_file)) {
            include get_template_directory() . '/' . $template_file;
            exit;
        }
    }
}
add_action('template_redirect', 'bridgeland_template_redirect');

// Theme Setup
function bridgeland_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Add custom image sizes
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('service-card', 400, 300, true);
    add_image_size('team-member', 300, 300, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'bridgeland'),
        'footer' => __('Footer Menu', 'bridgeland'),
    ));
}
add_action('after_setup_theme', 'bridgeland_theme_setup');

// Enqueue Scripts and Styles
function bridgeland_scripts() {
    // Google Fonts for Professional Typography
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Bootstrap CSS first (with fallback)
    $bootstrap_path = get_template_directory() . '/bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css';
    if (file_exists($bootstrap_path)) {
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css', array(), '5.3.8');
    } else {
        // Fallback to CDN if local Bootstrap is missing
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css', array(), '5.3.8');
    }

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main stylesheet (depends on Bootstrap and Google Fonts)
    wp_enqueue_style('bridgeland-style', get_stylesheet_uri(), array('google-fonts', 'bootstrap-css', 'font-awesome'), '2.1.' . time());

    // Bootstrap JavaScript (with fallback)
    $bootstrap_js_path = get_template_directory() . '/bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js';
    if (file_exists($bootstrap_js_path)) {
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js', array(), '5.3.8', true);
    } else {
        // Fallback to CDN if local Bootstrap is missing
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', array(), '5.3.8', true);
    }

    // Custom JavaScript
    wp_enqueue_script('bridgeland-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap-js'), '2.0', true);

    // Localize script for AJAX
    wp_localize_script('bridgeland-main', 'bridgeland_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('bridgeland_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'bridgeland_scripts');

// Custom Post Types
function bridgeland_custom_post_types() {
    // Testimonials Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'edit_item' => 'Edit Testimonial',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));

    // Case Studies Post Type
    register_post_type('case_study', array(
        'labels' => array(
            'name' => 'Case Studies',
            'singular_name' => 'Case Study',
            'add_new_item' => 'Add New Case Study',
            'edit_item' => 'Edit Case Study',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
    ));
}
add_action('init', 'bridgeland_custom_post_types');

// Custom Fields for Testimonials
function bridgeland_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial-details',
        'Testimonial Details',
        'bridgeland_testimonial_meta_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bridgeland_testimonial_meta_boxes');

function bridgeland_testimonial_meta_callback($post) {
    wp_nonce_field('bridgeland_testimonial_meta', 'bridgeland_testimonial_nonce');

    $client_name = get_post_meta($post->ID, '_client_name', true);
    $client_title = get_post_meta($post->ID, '_client_title', true);
    $client_company = get_post_meta($post->ID, '_client_company', true);
    $rating = get_post_meta($post->ID, '_rating', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="client_name">Client Name</label></th>';
    echo '<td><input type="text" id="client_name" name="client_name" value="' . esc_attr($client_name) . '" /></td></tr>';
    echo '<tr><th><label for="client_title">Client Title</label></th>';
    echo '<td><input type="text" id="client_title" name="client_title" value="' . esc_attr($client_title) . '" /></td></tr>';
    echo '<tr><th><label for="client_company">Client Company</label></th>';
    echo '<td><input type="text" id="client_company" name="client_company" value="' . esc_attr($client_company) . '" /></td></tr>';
    echo '<tr><th><label for="rating">Rating (1-5)</label></th>';
    echo '<td><select id="rating" name="rating">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '"' . selected($rating, $i, false) . '>' . $i . ' Star' . ($i > 1 ? 's' : '') . '</option>';
    }
    echo '</select></td></tr>';
    echo '</table>';
}

function bridgeland_save_testimonial_meta($post_id) {
    if (!isset($_POST['bridgeland_testimonial_nonce']) || !wp_verify_nonce($_POST['bridgeland_testimonial_nonce'], 'bridgeland_testimonial_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('client_name', 'client_title', 'client_company', 'rating');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'bridgeland_save_testimonial_meta');

// Contact Form Handler
function bridgeland_handle_contact_form() {
    if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
        wp_die('Security check failed');
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $service = sanitize_text_field($_POST['service']);
    $timeline = sanitize_text_field($_POST['timeline']);
    $message = sanitize_textarea_field($_POST['message']);

    // Email to admin
    $to = 'eran@bridgeland-advisors.com';
    $subject = 'New Contact Form Submission - ' . $name;
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Company: $company\n";
    $body .= "Service Interest: $service\n";
    $body .= "Timeline: $timeline\n";
    $body .= "Message: $message\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success('Message sent successfully!');
    } else {
        wp_send_json_error('Failed to send message. Please try again.');
    }
}
add_action('wp_ajax_bridgeland_contact', 'bridgeland_handle_contact_form');
add_action('wp_ajax_nopriv_bridgeland_contact', 'bridgeland_handle_contact_form');

// Force correct company information - Override any incorrect saved values
function bridgeland_force_correct_company_info() {
    // Force correct address
    set_theme_mod('company_address', '19 Ner Halayla St.<br>Even Yehuda, Israel');
    set_theme_mod('company_phone', '+972-50-6842937');
    set_theme_mod('company_email', 'eran@bridgeland-advisors.com');
    set_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/');
}
add_action('init', 'bridgeland_force_correct_company_info');

// Force delete old contact pages and recreate clean ones
function bridgeland_force_clean_contact_page() {
    // Find and delete any existing contact pages with wrong content
    $old_pages = get_posts(array(
        'post_type' => 'page',
        'post_status' => 'any',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_wp_page_template',
                'value' => 'page-contact.php',
                'compare' => '!='
            )
        ),
        'title' => 'Contact Us',
        'numberposts' => -1
    ));

    foreach ($old_pages as $old_page) {
        // Check if this page has the wrong content (old address)
        if (strpos($old_page->post_content, 'Alon Tower') !== false ||
            strpos($old_page->post_content, 'Tel Aviv') !== false ||
            strpos($old_page->post_content, 'Yigal Alon') !== false) {

            // Delete the old page
            wp_delete_post($old_page->ID, true);
        }
    }

    // Also check for pages by slug
    $contact_by_slug = get_page_by_path('contact-us');
    if ($contact_by_slug && (
        strpos($contact_by_slug->post_content, 'Alon Tower') !== false ||
        strpos($contact_by_slug->post_content, 'Tel Aviv') !== false
    )) {
        wp_delete_post($contact_by_slug->ID, true);
    }
}

// Clean up any broken pages and force contact page recreation
function bridgeland_cleanup_and_recreate() {
    // Delete the broken Find Us page
    $find_us_page = get_page_by_path('find-us');
    if ($find_us_page) {
        wp_delete_post($find_us_page->ID, true);
    }

    // Delete any contact pages with wrong content
    bridgeland_force_clean_contact_page();

    // Force recreation of all pages
    bridgeland_create_pages();
}

// Run this on theme activation and admin init
add_action('after_switch_theme', 'bridgeland_cleanup_and_recreate');
add_action('admin_init', 'bridgeland_cleanup_and_recreate', 5);

// Also run cleanup on init to catch any issues
add_action('init', 'bridgeland_cleanup_and_recreate', 20);

// Helper function to always return correct company information
function bridgeland_get_company_info($field) {
    $correct_info = array(
        'address' => '19 Ner Halayla St.<br>Even Yehuda, Israel',
        'phone' => '+972-50-6842937',
        'email' => 'eran@bridgeland-advisors.com',
        'linkedin' => 'https://www.linkedin.com/in/eranbenavi/'
    );

    return isset($correct_info[$field]) ? $correct_info[$field] : '';
}

// Enqueue contact page specific styles
function bridgeland_contact_page_styles() {
    if (is_page('contact-us') || is_page('contact')) {
        wp_add_inline_style('bridgeland-style', '
        /* Contact Page Enhanced Styling */
        .contact-hero {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
            position: relative;
            overflow: hidden;
            padding-top: 120px !important;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,<svg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'><g fill=\'none\' fill-rule=\'evenodd\'><g fill=\'%23B91C1C\' fill-opacity=\'0.1\'><circle cx=\'7\' cy=\'7\' r=\'1\'/><circle cx=\'53\' cy=\'53\' r=\'1\'/><circle cx=\'30\' cy=\'30\' r=\'2\'/></g></svg>");
        }

        .contact-highlights .highlight {
            transition: all 0.3s ease !important;
            border: 1px solid transparent !important;
        }

        .contact-highlights .highlight:hover {
            transform: translateY(-2px) !important;
            border-color: #8B0000 !important;
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.1) !important;
        }

        .form-card {
            background: #ffffff !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #8B0000 0%, #660000 100%) !important;
            color: white !important;
            border-bottom: none !important;
        }

        .form-card .card-header h3 {
            color: white !important;
            margin-bottom: 0.5rem !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8B0000 !important;
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25) !important;
        }

        .btn-primary {
            background-color: #8B0000 !important;
            border-color: #8B0000 !important;
        }

        .btn-primary:hover {
            background-color: #660000 !important;
            border-color: #660000 !important;
        }

        .step-number {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            background-color: #EEEEEE !important;
            color: #757575 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: bold !important;
            margin-bottom: 0.5rem !important;
            transition: all 0.3s ease !important;
        }

        .step.active .step-number {
            background-color: #8B0000 !important;
            color: white !important;
        }

        .step.completed .step-number {
            background-color: #2E7D32 !important;
            color: white !important;
        }

        .step-label {
            font-size: 0.875rem !important;
            color: #757575 !important;
            font-weight: 500 !important;
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: #8B0000 !important;
        }

        .service-options .btn-check:checked + .btn {
            background-color: #8B0000 !important;
            border-color: #8B0000 !important;
            color: white !important;
        }

        .office-info .detail-item {
            transition: all 0.3s ease !important;
            padding: 1rem !important;
            border-radius: 8px !important;
        }

        .office-info .detail-item:hover {
            background-color: #f8f9fa !important;
            transform: translateX(5px) !important;
        }
        ');
    }
}
add_action('wp_enqueue_scripts', 'bridgeland_contact_page_styles');

// Force Calendly integration to work
function bridgeland_force_calendly_scripts() {
    wp_add_inline_script('jquery', '
    jQuery(document).ready(function($) {
        // Override any existing openCalendly functions
        window.openCalendly = function() {
            console.log("Attempting to open Calendly...");
            try {
                if (typeof Calendly !== "undefined" && Calendly.initPopupWidget) {
                    console.log("Opening Calendly popup widget");
                    Calendly.initPopupWidget({url: "https://calendly.com/bridgeland-advisors"});
                } else {
                    console.log("Calendly widget not available, opening in new tab");
                    window.open("https://calendly.com/bridgeland-advisors", "_blank");
                }
            } catch (error) {
                console.error("Error opening Calendly:", error);
                window.open("https://calendly.com/bridgeland-advisors", "_blank");
            }
            return false;
        };

        // Fix all consultation buttons
        $(document).on("click", "[onclick*=\"openCalendly\"], [href*=\"calendly\"], .consultation-btn", function(e) {
            e.preventDefault();
            e.stopPropagation();
            window.openCalendly();
            return false;
        });

        // Add consultation-btn class to all schedule buttons
        $("a:contains(\"Schedule\"), a:contains(\"Consultation\")").addClass("consultation-btn");
    });
    ');
}
add_action('wp_enqueue_scripts', 'bridgeland_force_calendly_scripts');

// Cache busting and force refresh
function bridgeland_force_refresh() {
    // Clear any caching plugins
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }

    // Force theme mod refresh
    remove_theme_mods();
    bridgeland_force_correct_company_info();

    // Add cache busting to scripts
    add_filter('style_loader_src', 'bridgeland_add_version_to_assets', 9999);
    add_filter('script_loader_src', 'bridgeland_add_version_to_assets', 9999);
}

function bridgeland_add_version_to_assets($src) {
    if (strpos($src, 'bridgeland') !== false) {
        $src = add_query_arg('v', time(), $src);
    }
    return $src;
}

// Run refresh on admin and theme activation
add_action('after_switch_theme', 'bridgeland_force_refresh');
add_action('customize_save_after', 'bridgeland_force_refresh');

// Customizer Settings
function bridgeland_customize_register($wp_customize) {
    // Company Information Section
    $wp_customize->add_section('bridgeland_company_info', array(
        'title' => 'Company Information',
        'priority' => 30,
    ));

    // Phone Number
    $wp_customize->add_setting('company_phone', array(
        'default' => '+972-50-6842937',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('company_phone', array(
        'label' => 'Phone Number',
        'section' => 'bridgeland_company_info',
        'type' => 'text',
    ));

    // Email Address
    $wp_customize->add_setting('company_email', array(
        'default' => 'eran@bridgeland-advisors.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('company_email', array(
        'label' => 'Email Address',
        'section' => 'bridgeland_company_info',
        'type' => 'email',
    ));

    // Address - Force correct default
    $wp_customize->add_setting('company_address', array(
        'default' => '19 Ner Halayla St.<br>Even Yehuda, Israel',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('company_address', array(
        'label' => 'Address',
        'section' => 'bridgeland_company_info',
        'type' => 'textarea',
    ));

    // LinkedIn URL
    $wp_customize->add_setting('company_linkedin', array(
        'default' => 'https://www.linkedin.com/in/eranbenavi/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('company_linkedin', array(
        'label' => 'LinkedIn URL',
        'section' => 'bridgeland_company_info',
        'type' => 'url',
    ));
}
add_action('customize_register', 'bridgeland_customize_register');

// Helper Functions
function bridgeland_get_testimonials($limit = -1) {
    return new WP_Query(array(
        'post_type' => 'testimonial',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}

function bridgeland_get_case_studies($limit = -1) {
    return new WP_Query(array(
        'post_type' => 'case_study',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}

// Security enhancements
function bridgeland_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'bridgeland_security_headers');

// Remove unnecessary WordPress features
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Calculator Functions
function bridgeland_calculate_vc_method() {
    if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
        wp_die('Security check failed');
    }

    $revenue = floatval($_POST['revenue']);
    $growth_rate = floatval($_POST['growth_rate']);
    $exit_multiple = floatval($_POST['exit_multiple']);
    $discount_rate = floatval($_POST['discount_rate']);
    $years_to_exit = intval($_POST['years_to_exit']);

    // Calculate projected revenue at exit
    $exit_revenue = $revenue * pow(1 + ($growth_rate / 100), $years_to_exit);

    // Calculate exit valuation
    $exit_valuation = $exit_revenue * $exit_multiple;

    // Discount back to present value
    $present_value = $exit_valuation / pow(1 + ($discount_rate / 100), $years_to_exit);

    $results = array(
        'exit_revenue' => $exit_revenue,
        'exit_valuation' => $exit_valuation,
        'present_value' => $present_value,
        'formatted' => array(
            'exit_revenue' => number_format($exit_revenue, 0),
            'exit_valuation' => number_format($exit_valuation, 0),
            'present_value' => number_format($present_value, 0)
        )
    );

    wp_send_json_success($results);
}
add_action('wp_ajax_calculate_vc_method', 'bridgeland_calculate_vc_method');
add_action('wp_ajax_nopriv_calculate_vc_method', 'bridgeland_calculate_vc_method');

function bridgeland_calculate_scorecard() {
    if (!wp_verify_nonce($_POST['nonce'], 'bridgeland_nonce')) {
        wp_die('Security check failed');
    }

    $management = floatval($_POST['management']);
    $market = floatval($_POST['market']);
    $product = floatval($_POST['product']);
    $competition = floatval($_POST['competition']);
    $marketing = floatval($_POST['marketing']);
    $technology = floatval($_POST['technology']);
    $funding = floatval($_POST['funding']);

    // Calculate weighted score
    $weights = array(
        'management' => 0.25,
        'market' => 0.20,
        'product' => 0.20,
        'competition' => 0.10,
        'marketing' => 0.10,
        'technology' => 0.10,
        'funding' => 0.05
    );

    $total_score =
        ($management * $weights['management']) +
        ($market * $weights['market']) +
        ($product * $weights['product']) +
        ($competition * $weights['competition']) +
        ($marketing * $weights['marketing']) +
        ($technology * $weights['technology']) +
        ($funding * $weights['funding']);

    // Base valuation (can be customized)
    $base_valuation = 2000000;
    $adjusted_valuation = $base_valuation * ($total_score / 100);

    $results = array(
        'total_score' => $total_score,
        'adjusted_valuation' => $adjusted_valuation,
        'formatted' => array(
            'total_score' => number_format($total_score, 1),
            'adjusted_valuation' => number_format($adjusted_valuation, 0)
        )
    );

    wp_send_json_success($results);
}
add_action('wp_ajax_calculate_scorecard', 'bridgeland_calculate_scorecard');
add_action('wp_ajax_nopriv_calculate_scorecard', 'bridgeland_calculate_scorecard');

// Custom excerpt function
function bridgeland_custom_excerpt($word_count = 25) {
    global $post;
    if ($post->post_excerpt) {
        return wp_trim_words($post->post_excerpt, $word_count);
    } else {
        return wp_trim_words($post->post_content, $word_count);
    }
}

// Basic SEO
function bridgeland_seo_meta() {
    if (is_singular()) {
        global $post;
        $description = bridgeland_custom_excerpt(20);
        echo '<meta name="description" content="' . esc_attr($description) . '">';
    } elseif (is_home()) {
        echo '<meta name="description" content="Professional 409A valuations and financial advisory services from Bridgeland Advisors.">';
    }
}
add_action('wp_head', 'bridgeland_seo_meta');

// Auto-create pages when theme is activated
function bridgeland_create_pages() {
    $pages = array(
        array(
            'title' => 'About Us',
            'slug' => 'about',
            'template' => 'page-about.php',
            'content' => ''
        ),
        array(
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'template' => 'page-contact.php',
            'content' => ''
        ),
        array(
            'title' => 'Capital Raising',
            'slug' => 'capital-raising',
            'template' => 'page-capital-raising.php',
            'content' => ''
        ),
        array(
            'title' => 'Calculators',
            'slug' => 'calculators',
            'template' => 'page-calculators.php',
            'content' => ''
        ),
        array(
            'title' => 'Resources',
            'slug' => 'resources',
            'template' => 'page-resources.php',
            'content' => ''
        ),
        array(
            'title' => 'Term Sheet Negotiation',
            'slug' => 'term-sheet-negotiation',
            'template' => 'page-term-sheet-negotiation.php',
            'content' => ''
        ),
        array(
            'title' => 'Waterfall Analysis',
            'slug' => 'waterfall-analysis',
            'template' => 'page-waterfall-analysis.php',
            'content' => ''
        ),
        array(
            'title' => 'FAQ',
            'slug' => 'faq',
            'template' => 'page-faq.php',
            'content' => ''
        ),
        array(
            'title' => 'Sitemap',
            'slug' => 'sitemap',
            'template' => 'page-sitemap.php',
            'content' => ''
        ),
        array(
            'title' => 'Terms of Service',
            'slug' => 'terms-of-service',
            'template' => 'page-terms-of-service.php',
            'content' => ''
        ),
        array(
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'template' => 'page-privacy-policy.php',
            'content' => ''
        ),
        array(
            'title' => 'Insights',
            'slug' => 'insights',
            'template' => 'page-insights.php',
            'content' => ''
        )
    );

    foreach ($pages as $page) {
        // Check if page already exists
        $existing_page = get_page_by_path($page['slug']);

        // Special handling for contact page - force recreation if it has wrong content
        if ($page['slug'] === 'contact-us' && $existing_page) {
            if (strpos($existing_page->post_content, 'Alon Tower') !== false ||
                strpos($existing_page->post_content, 'Tel Aviv') !== false ||
                get_post_meta($existing_page->ID, '_wp_page_template', true) !== 'page-contact.php') {

                // Delete the bad page
                wp_delete_post($existing_page->ID, true);
                $existing_page = null;
            }
        }

        if (!$existing_page) {
            // Create the page
            $page_data = array(
                'post_title' => $page['title'],
                'post_name' => $page['slug'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1
            );

            $page_id = wp_insert_post($page_data);

            // Set the page template
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        }
    }
}

// Run when theme is activated
add_action('after_switch_theme', 'bridgeland_create_pages');
add_action('after_switch_theme', 'bridgeland_flush_rewrite_rules');

// Flush rewrite rules when theme is activated to make article URLs work
function bridgeland_flush_rewrite_rules() {
    bridgeland_add_article_rewrites();
    flush_rewrite_rules();
}

// Also provide a manual trigger function for immediate execution
function bridgeland_manual_create_pages() {
    if (current_user_can('manage_options') && isset($_GET['create_pages']) && $_GET['create_pages'] === 'true') {
        bridgeland_create_pages();
        wp_redirect(admin_url('admin.php?page=bridgeland-setup&created=true'));
        exit;
    }
}
add_action('admin_init', 'bridgeland_manual_create_pages');

// Add admin menu for manual page creation
function bridgeland_admin_menu() {
    add_theme_page(
        'Bridgeland Setup',
        'Theme Setup',
        'manage_options',
        'bridgeland-setup',
        'bridgeland_setup_page'
    );
}
add_action('admin_menu', 'bridgeland_admin_menu');

function bridgeland_setup_page() {
    ?>
    <div class="wrap">
        <h1>Bridgeland Advisors Theme Setup</h1>

        <?php if (isset($_GET['created'])) : ?>
            <div class="notice notice-success">
                <p>All pages have been created successfully!</p>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2>Create Theme Pages</h2>
            <p>Click the button below to automatically create all necessary pages for the Bridgeland Advisors theme.</p>
            <p><strong>Pages that will be created:</strong></p>
            <ul>
                <li>About Us (/about)</li>
                <li>Contact Us (/contact-us)</li>
                <li>Capital Raising (/capital-raising)</li>
                <li>Calculators (/calculators)</li>
                <li>Resources (/resources)</li>
                <li>Term Sheet Negotiation (/term-sheet-negotiation)</li>
                <li>Waterfall Analysis (/waterfall-analysis)</li>
                <li>FAQ (/faq)</li>
                <li>Sitemap (/sitemap)</li>
                <li>Terms of Service (/terms-of-service)</li>
                <li>Privacy Policy (/privacy-policy)</li>
                <li>Insights (/insights)</li>
            </ul>

            <a href="<?php echo admin_url('admin.php?page=bridgeland-setup&create_pages=true'); ?>"
               class="button button-primary button-large">
                Create All Pages Now
            </a>
        </div>
    </div>
    <?php
}
?>