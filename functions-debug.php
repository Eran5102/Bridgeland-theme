<?php
/**
 * DEBUG VERSION - Bridgeland Advisors Functions
 * Minimal version to troubleshoot loading issues
 */

// Theme setup
function bridgeland_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'bridgeland'),
        'footer' => __('Footer Menu', 'bridgeland'),
    ));
}
add_action('after_setup_theme', 'bridgeland_theme_setup');

// Enqueue Scripts and Styles (Simplified)
function bridgeland_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Bootstrap CSS (CDN fallback)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main stylesheet
    wp_enqueue_style('bridgeland-style', get_stylesheet_uri(), array('google-fonts', 'bootstrap-css', 'font-awesome'), '2.1.0');

    // Bootstrap JavaScript (CDN)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);

    // jQuery (WordPress default)
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'bridgeland_scripts');

// Basic customizer settings
function bridgeland_customize_register($wp_customize) {
    // Site Identity
    $wp_customize->add_setting('company_phone', array(
        'default' => '+972-50-6842937',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_phone', array(
        'label' => 'Company Phone',
        'section' => 'title_tagline',
        'type' => 'text',
    ));

    $wp_customize->add_setting('company_email', array(
        'default' => 'eran@bridgeland-advisors.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('company_email', array(
        'label' => 'Company Email',
        'section' => 'title_tagline',
        'type' => 'email',
    ));
}
add_action('customize_register', 'bridgeland_customize_register');

// Custom post types (simplified)
function bridgeland_custom_post_types() {
    // Testimonials
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));

    // Case Studies
    register_post_type('case_study', array(
        'labels' => array(
            'name' => 'Case Studies',
            'singular_name' => 'Case Study',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
    ));
}
add_action('init', 'bridgeland_custom_post_types');

// Remove unnecessary WordPress features
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Debug info
function bridgeland_debug_info() {
    if (current_user_can('administrator') && isset($_GET['debug'])) {
        echo '<!-- Bridgeland Theme Debug: Active and loading -->';
    }
}
add_action('wp_head', 'bridgeland_debug_info');
?>