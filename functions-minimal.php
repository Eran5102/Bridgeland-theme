<?php
/**
 * ULTRA-MINIMAL VERSION - Bridgeland Theme
 * Just enough to make WordPress recognize this as a theme
 */

// Basic theme setup
function bridgeland_minimal_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'bridgeland_minimal_setup');

// Basic styles
function bridgeland_minimal_scripts() {
    // Just Bootstrap from CDN
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');

    // Basic theme styles
    wp_enqueue_style('bridgeland-minimal', get_stylesheet_uri());

    // jQuery (WordPress default)
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'bridgeland_minimal_scripts');

// Test if this loads
function bridgeland_test_loaded() {
    if (current_user_can('administrator')) {
        add_action('wp_footer', function() {
            echo '<!-- BRIDGELAND MINIMAL THEME LOADED SUCCESSFULLY -->';
        });
    }
}
add_action('init', 'bridgeland_test_loaded');
?>