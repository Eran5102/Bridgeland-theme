<?php
/**
 * Bridgeland Advisors v2 Theme Functions - SIMPLIFIED VERSION
 * Core functionality without complex integrations
 */

if (!defined('ABSPATH')) {
    exit;
}

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

    // Bootstrap CSS (CDN for reliability)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css', array(), '5.3.8');

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main stylesheet
    wp_enqueue_style('bridgeland-style', get_stylesheet_uri(), array('google-fonts', 'bootstrap-css', 'font-awesome'), '2.1.' . time());

    // Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', array(), '5.3.8', true);

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

    // Address
    $wp_customize->add_setting('company_address', array(
        'default' => '19 Ner Halayla St., Even Yehuda, Israel',
        'sanitize_callback' => 'sanitize_textarea_field',
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

// Custom excerpt function
function bridgeland_custom_excerpt($word_count = 25) {
    global $post;
    if ($post->post_excerpt) {
        return wp_trim_words($post->post_excerpt, $word_count);
    } else {
        return wp_trim_words($post->post_content, $word_count);
    }
}

// Security enhancements
function bridgeland_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'bridgeland_security_headers');

// Remove unnecessary WordPress features
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

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
?>