<?php
/**
 * Performance Optimization Functions for Bridgeland Advisors
 * Comprehensive performance enhancements for fast loading
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Optimize database queries
 */
function bridgeland_optimize_queries() {
    // Remove unnecessary query variables
    remove_query_arg(array('ver', 'version'));

    // Disable WordPress heartbeat on frontend
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
}
add_action('init', 'bridgeland_optimize_queries');

/**
 * Enable GZIP compression
 */
function bridgeland_enable_gzip() {
    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
        ob_start('ob_gzhandler');
    } else {
        ob_start();
    }
}
add_action('init', 'bridgeland_enable_gzip');

/**
 * Add browser caching headers
 */
function bridgeland_add_cache_headers() {
    if (!is_admin()) {
        // Cache static resources for 1 year
        header('Cache-Control: public, max-age=31536000');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

        // Add ETag for better caching
        $etag = md5_file(__FILE__);
        header('ETag: "' . $etag . '"');

        // Check if client has cached version
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) &&
            $_SERVER['HTTP_IF_NONE_MATCH'] === '"' . $etag . '"') {
            header('HTTP/1.1 304 Not Modified');
            exit;
        }
    }
}
add_action('send_headers', 'bridgeland_add_cache_headers');

/**
 * Optimize WordPress image handling
 */
function bridgeland_optimize_images() {
    // Remove default image sizes to save space
    add_filter('intermediate_image_sizes', function($sizes) {
        return array_diff($sizes, array('medium_large', 'large'));
    });

    // Add custom image sizes for optimized loading
    add_image_size('hero-optimized', 1200, 600, true);
    add_image_size('card-optimized', 400, 250, true);
    add_image_size('thumbnail-optimized', 150, 150, true);
}
add_action('after_setup_theme', 'bridgeland_optimize_images');

/**
 * Defer JavaScript loading for better performance
 */
function bridgeland_defer_scripts($tag, $handle, $src) {
    // Don't defer jQuery and critical scripts
    $critical_scripts = array('jquery', 'bootstrap-js', 'bridgeland-main');

    if (in_array($handle, $critical_scripts)) {
        return $tag;
    }

    // Defer non-critical scripts
    if (strpos($tag, '/wp-includes/') !== false ||
        strpos($tag, '/wp-content/plugins/') !== false) {
        return str_replace('<script ', '<script defer ', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'bridgeland_defer_scripts', 10, 3);

/**
 * Preload critical resources
 */
function bridgeland_preload_resources() {
    // Preload critical CSS
    echo '<link rel="preload" href="' . get_stylesheet_uri() . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";

    // Preload Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Preload critical images
    if (is_front_page()) {
        echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/images/hero-bg.webp">' . "\n";
    }

    // DNS prefetch for external resources
    echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//wa.me">' . "\n";
}
add_action('wp_head', 'bridgeland_preload_resources', 1);

/**
 * Implement lazy loading for images
 */
function bridgeland_add_lazy_loading($content) {
    // Add loading="lazy" to images
    $content = str_replace('<img ', '<img loading="lazy" ', $content);

    // Add decoding="async" for better performance
    $content = str_replace('<img loading="lazy" ', '<img loading="lazy" decoding="async" ', $content);

    return $content;
}
add_filter('the_content', 'bridgeland_add_lazy_loading');
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    $attr['decoding'] = 'async';
    return $attr;
});

/**
 * Minify HTML output
 */
function bridgeland_minify_html($buffer) {
    if (!is_admin() && !is_feed()) {
        // Remove unnecessary whitespace
        $buffer = preg_replace('/\s+/', ' ', $buffer);
        $buffer = preg_replace('/>\s+</', '><', $buffer);

        // Remove HTML comments (except IE conditionals)
        $buffer = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $buffer);

        // Remove unnecessary line breaks
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);
    }

    return $buffer;
}

// Enable HTML minification (can be disabled if it causes issues)
if (!is_admin()) {
    add_action('init', function() {
        ob_start('bridgeland_minify_html');
    });
}

/**
 * Optimize CSS delivery
 */
function bridgeland_optimize_css() {
    // Critical CSS inline
    $critical_css = '
        /* Critical CSS - Above the fold styles */
        body { font-family: "Source Sans Pro", sans-serif; margin: 0; }
        .navbar { background: #8B0000; }
        .btn-primary { background: #8B0000; border-color: #8B0000; }
        .hero-section { background: #8B0000; color: white; padding: 60px 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; }
        .btn { padding: 0.6rem 1.25rem; border-radius: 0.375rem; text-decoration: none; }
    ';

    echo '<style id="critical-css">' . $critical_css . '</style>' . "\n";
}
add_action('wp_head', 'bridgeland_optimize_css', 5);

/**
 * Remove unused CSS and JS
 */
function bridgeland_remove_unused_assets() {
    // Remove WordPress block styles if not using Gutenberg
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');

    // Remove WordPress default styles
    wp_dequeue_style('dashicons');

    // Remove emoji scripts and styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('wp_enqueue_scripts', 'bridgeland_remove_unused_assets', 100);

/**
 * Database optimization
 */
function bridgeland_optimize_database() {
    // Remove unnecessary revisions (keep only 3)
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }

    // Increase autosave interval
    if (!defined('AUTOSAVE_INTERVAL')) {
        define('AUTOSAVE_INTERVAL', 300); // 5 minutes
    }

    // Clean up transients
    delete_expired_transients();
}
add_action('wp_loaded', 'bridgeland_optimize_database');

/**
 * Implement resource hints
 */
function bridgeland_resource_hints($urls, $relation_type) {
    switch ($relation_type) {
        case 'dns-prefetch':
            $urls[] = '//fonts.googleapis.com';
            $urls[] = '//fonts.gstatic.com';
            $urls[] = '//cdnjs.cloudflare.com';
            break;

        case 'preconnect':
            $urls[] = 'https://fonts.gstatic.com';
            break;

        case 'prefetch':
            if (is_front_page()) {
                $urls[] = home_url('/about/');
                $urls[] = home_url('/services/');
                $urls[] = home_url('/calculators/');
            }
            break;
    }

    return $urls;
}
add_filter('wp_resource_hints', 'bridgeland_resource_hints', 10, 2);

/**
 * Service Worker registration for offline caching
 */
function bridgeland_register_service_worker() {
    if (!is_admin()) {
        echo "<script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('" . get_template_directory_uri() . "/assets/js/sw.js')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                })
                .catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
            });
        }
        </script>\n";
    }
}
add_action('wp_footer', 'bridgeland_register_service_worker');

/**
 * Optimize font loading
 */
function bridgeland_optimize_fonts() {
    // Use font-display: swap for better loading performance
    echo '<style>
        @font-face {
            font-family: "Source Sans Pro";
            font-display: swap;
        }
        @font-face {
            font-family: "Source Serif Pro";
            font-display: swap;
        }
        @font-face {
            font-family: "Inter";
            font-display: swap;
        }
    </style>' . "\n";
}
add_action('wp_head', 'bridgeland_optimize_fonts', 2);

/**
 * Implement critical resource prioritization
 */
function bridgeland_prioritize_resources() {
    // High priority resources
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css" as="style">' . "\n";
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/js/calculators.js" as="script">' . "\n";

    // Low priority resources
    echo '<link rel="prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . "\n";
}
add_action('wp_head', 'bridgeland_prioritize_resources', 3);

/**
 * Monitor Core Web Vitals
 */
function bridgeland_web_vitals_monitoring() {
    if (!is_admin()) {
        echo "<script>
        // Monitor Core Web Vitals
        function sendToAnalytics(metric) {
            if (typeof gtag !== 'undefined') {
                gtag('event', metric.name, {
                    event_category: 'Web Vitals',
                    event_label: metric.id,
                    value: Math.round(metric.name === 'CLS' ? metric.value * 1000 : metric.value),
                    non_interaction: true,
                });
            }
        }

        // Import web-vitals library
        import('https://unpkg.com/web-vitals').then(({getLCP, getFID, getCLS}) => {
            getLCP(sendToAnalytics);
            getFID(sendToAnalytics);
            getCLS(sendToAnalytics);
        });
        </script>\n";
    }
}
add_action('wp_footer', 'bridgeland_web_vitals_monitoring');