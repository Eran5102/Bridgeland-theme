<?php
/**
 * Sitemap Generation for Bridgeland Advisors
 * Generates XML sitemap for better SEO indexing
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate XML sitemap
 */
function bridgeland_generate_sitemap() {
    header('Content-Type: application/xml; charset=UTF-8');

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

    // Homepage
    echo '<url>';
    echo '<loc>' . home_url() . '</loc>';
    echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>';
    echo '<changefreq>weekly</changefreq>';
    echo '<priority>1.0</priority>';
    echo '</url>';

    // Main pages
    $main_pages = array(
        'about' => array('priority' => '0.9', 'changefreq' => 'monthly'),
        'services' => array('priority' => '0.9', 'changefreq' => 'monthly'),
        '409a-valuation' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'company-valuation' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'startup-valuation' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'waterfall-analysis' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'capital-raising' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'term-sheet-negotiation' => array('priority' => '0.8', 'changefreq' => 'monthly'),
        'calculators' => array('priority' => '0.7', 'changefreq' => 'weekly'),
        'contact' => array('priority' => '0.6', 'changefreq' => 'monthly'),
        'case-studies' => array('priority' => '0.7', 'changefreq' => 'weekly'),
        'faq' => array('priority' => '0.6', 'changefreq' => 'monthly'),
        'resources' => array('priority' => '0.6', 'changefreq' => 'weekly'),
        'blog' => array('priority' => '0.7', 'changefreq' => 'daily'),
        'privacy-policy' => array('priority' => '0.3', 'changefreq' => 'yearly'),
        'terms-of-service' => array('priority' => '0.3', 'changefreq' => 'yearly')
    );

    foreach ($main_pages as $slug => $config) {
        $page = get_page_by_path($slug);
        if ($page) {
            echo '<url>';
            echo '<loc>' . get_permalink($page->ID) . '</loc>';
            echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00', strtotime($page->post_modified)) . '</lastmod>';
            echo '<changefreq>' . $config['changefreq'] . '</changefreq>';
            echo '<priority>' . $config['priority'] . '</priority>';
            echo '</url>';
        }
    }

    // Blog posts
    $posts = get_posts(array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'post'
    ));

    foreach ($posts as $post) {
        echo '<url>';
        echo '<loc>' . get_permalink($post->ID) . '</loc>';
        echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00', strtotime($post->post_modified)) . '</lastmod>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>0.6</priority>';
        echo '</url>';
    }

    // Case studies
    $case_studies = get_posts(array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'case_study'
    ));

    foreach ($case_studies as $case_study) {
        echo '<url>';
        echo '<loc>' . get_permalink($case_study->ID) . '</loc>';
        echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00', strtotime($case_study->post_modified)) . '</lastmod>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>0.7</priority>';
        echo '</url>';
    }

    // Testimonials
    $testimonials = get_posts(array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'testimonial'
    ));

    foreach ($testimonials as $testimonial) {
        echo '<url>';
        echo '<loc>' . get_permalink($testimonial->ID) . '</loc>';
        echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00', strtotime($testimonial->post_modified)) . '</lastmod>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>0.5</priority>';
        echo '</url>';
    }

    echo '</urlset>';
    exit;
}

/**
 * Handle sitemap requests
 */
function bridgeland_sitemap_rewrite() {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?bridgeland_sitemap=1', 'top');
}
add_action('init', 'bridgeland_sitemap_rewrite');

/**
 * Add query var for sitemap
 */
function bridgeland_sitemap_query_vars($vars) {
    $vars[] = 'bridgeland_sitemap';
    return $vars;
}
add_filter('query_vars', 'bridgeland_sitemap_query_vars');

/**
 * Handle sitemap template
 */
function bridgeland_sitemap_template() {
    if (get_query_var('bridgeland_sitemap')) {
        bridgeland_generate_sitemap();
    }
}
add_action('template_redirect', 'bridgeland_sitemap_template');

/**
 * Flush rewrite rules on theme activation
 */
function bridgeland_flush_sitemap_rules() {
    bridgeland_sitemap_rewrite();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'bridgeland_flush_sitemap_rules');

/**
 * Generate sitemap index for large sites
 */
function bridgeland_generate_sitemap_index() {
    header('Content-Type: application/xml; charset=UTF-8');

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Main sitemap
    echo '<sitemap>';
    echo '<loc>' . home_url('sitemap.xml') . '</loc>';
    echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>';
    echo '</sitemap>';

    // Images sitemap (if needed)
    echo '<sitemap>';
    echo '<loc>' . home_url('sitemap-images.xml') . '</loc>';
    echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>';
    echo '</sitemap>';

    echo '</sitemapindex>';
    exit;
}

/**
 * Generate image sitemap
 */
function bridgeland_generate_image_sitemap() {
    header('Content-Type: application/xml; charset=UTF-8');

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

    // Get all images from media library
    $images = get_posts(array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1,
        'post_status' => 'inherit'
    ));

    $grouped_images = array();

    // Group images by parent post
    foreach ($images as $image) {
        $parent_id = $image->post_parent;
        if ($parent_id) {
            $parent_url = get_permalink($parent_id);
            if (!isset($grouped_images[$parent_url])) {
                $grouped_images[$parent_url] = array();
            }
            $grouped_images[$parent_url][] = $image;
        }
    }

    // Output grouped images
    foreach ($grouped_images as $page_url => $page_images) {
        echo '<url>';
        echo '<loc>' . $page_url . '</loc>';

        foreach ($page_images as $image) {
            $image_url = wp_get_attachment_url($image->ID);
            $image_title = $image->post_title;
            $image_caption = $image->post_excerpt;

            echo '<image:image>';
            echo '<image:loc>' . $image_url . '</image:loc>';
            if ($image_title) {
                echo '<image:title>' . htmlspecialchars($image_title) . '</image:title>';
            }
            if ($image_caption) {
                echo '<image:caption>' . htmlspecialchars($image_caption) . '</image:caption>';
            }
            echo '</image:image>';
        }

        echo '</url>';
    }

    echo '</urlset>';
    exit;
}

/**
 * Handle image sitemap requests
 */
function bridgeland_image_sitemap_rewrite() {
    add_rewrite_rule('^sitemap-images\.xml$', 'index.php?bridgeland_image_sitemap=1', 'top');
}
add_action('init', 'bridgeland_image_sitemap_rewrite');

/**
 * Add query var for image sitemap
 */
function bridgeland_image_sitemap_query_vars($vars) {
    $vars[] = 'bridgeland_image_sitemap';
    return $vars;
}
add_filter('query_vars', 'bridgeland_image_sitemap_query_vars');

/**
 * Handle image sitemap template
 */
function bridgeland_image_sitemap_template() {
    if (get_query_var('bridgeland_image_sitemap')) {
        bridgeland_generate_image_sitemap();
    }
}
add_action('template_redirect', 'bridgeland_image_sitemap_template');