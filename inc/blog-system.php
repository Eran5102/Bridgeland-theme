<?php
/**
 * Blog System for Bridgeland Advisors
 * Comprehensive content management and blog functionality
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enhanced blog post types and taxonomies
 */
function bridgeland_blog_post_types() {
    // Insights/Blog posts (enhanced default post type)

    // Add custom taxonomies for better content organization
    register_taxonomy('insight_category', 'post', array(
        'labels' => array(
            'name' => 'Insight Categories',
            'singular_name' => 'Insight Category',
            'add_new_item' => 'Add New Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'insights/category'),
    ));

    register_taxonomy('insight_topic', 'post', array(
        'labels' => array(
            'name' => 'Topics',
            'singular_name' => 'Topic',
            'add_new_item' => 'Add New Topic',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'insights/topic'),
    ));

    // Financial Resources Post Type
    register_post_type('financial_resource', array(
        'labels' => array(
            'name' => 'Financial Resources',
            'singular_name' => 'Financial Resource',
            'add_new_item' => 'Add New Resource',
            'edit_item' => 'Edit Resource',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-book-alt',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'resources'),
    ));

    // FAQ Post Type
    register_post_type('faq', array(
        'labels' => array(
            'name' => 'FAQs',
            'singular_name' => 'FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit_item' => 'Edit FAQ',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-editor-help',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'faq'),
    ));

    // White Papers Post Type
    register_post_type('whitepaper', array(
        'labels' => array(
            'name' => 'White Papers',
            'singular_name' => 'White Paper',
            'add_new_item' => 'Add New White Paper',
            'edit_item' => 'Edit White Paper',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-media-document',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'whitepapers'),
    ));
}
add_action('init', 'bridgeland_blog_post_types');

/**
 * Add custom meta fields for blog posts
 */
function bridgeland_blog_meta_boxes() {
    add_meta_box(
        'blog-post-details',
        'Post Details',
        'bridgeland_blog_meta_callback',
        'post',
        'normal',
        'high'
    );

    add_meta_box(
        'resource-details',
        'Resource Details',
        'bridgeland_resource_meta_callback',
        'financial_resource',
        'normal',
        'high'
    );

    add_meta_box(
        'whitepaper-details',
        'White Paper Details',
        'bridgeland_whitepaper_meta_callback',
        'whitepaper',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bridgeland_blog_meta_boxes');

function bridgeland_blog_meta_callback($post) {
    wp_nonce_field('bridgeland_blog_meta', 'bridgeland_blog_nonce');

    $reading_time = get_post_meta($post->ID, '_reading_time', true);
    $featured_post = get_post_meta($post->ID, '_featured_post', true);
    $author_bio = get_post_meta($post->ID, '_author_bio_override', true);
    $related_services = get_post_meta($post->ID, '_related_services', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="reading_time">Reading Time (minutes)</label></th>';
    echo '<td><input type="number" id="reading_time" name="reading_time" value="' . esc_attr($reading_time) . '" min="1" max="60" /></td></tr>';

    echo '<tr><th><label for="featured_post">Featured Post</label></th>';
    echo '<td><input type="checkbox" id="featured_post" name="featured_post" value="1" ' . checked(1, $featured_post, false) . ' /> Featured on homepage</td></tr>';

    echo '<tr><th><label for="author_bio">Custom Author Bio</label></th>';
    echo '<td><textarea id="author_bio" name="author_bio" rows="3" cols="50">' . esc_textarea($author_bio) . '</textarea></td></tr>';

    echo '<tr><th><label for="related_services">Related Services</label></th>';
    echo '<td><input type="text" id="related_services" name="related_services" value="' . esc_attr($related_services) . '" placeholder="409A Valuation, Company Valuation" style="width: 100%;" /></td></tr>';
    echo '</table>';
}

function bridgeland_resource_meta_callback($post) {
    wp_nonce_field('bridgeland_resource_meta', 'bridgeland_resource_nonce');

    $resource_type = get_post_meta($post->ID, '_resource_type', true);
    $download_url = get_post_meta($post->ID, '_download_url', true);
    $external_url = get_post_meta($post->ID, '_external_url', true);
    $difficulty_level = get_post_meta($post->ID, '_difficulty_level', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="resource_type">Resource Type</label></th>';
    echo '<td><select id="resource_type" name="resource_type">';
    echo '<option value="guide" ' . selected('guide', $resource_type, false) . '>Guide</option>';
    echo '<option value="template" ' . selected('template', $resource_type, false) . '>Template</option>';
    echo '<option value="calculator" ' . selected('calculator', $resource_type, false) . '>Calculator</option>';
    echo '<option value="checklist" ' . selected('checklist', $resource_type, false) . '>Checklist</option>';
    echo '<option value="article" ' . selected('article', $resource_type, false) . '>Article</option>';
    echo '</select></td></tr>';

    echo '<tr><th><label for="download_url">Download URL</label></th>';
    echo '<td><input type="url" id="download_url" name="download_url" value="' . esc_attr($download_url) . '" style="width: 100%;" /></td></tr>';

    echo '<tr><th><label for="external_url">External URL</label></th>';
    echo '<td><input type="url" id="external_url" name="external_url" value="' . esc_attr($external_url) . '" style="width: 100%;" /></td></tr>';

    echo '<tr><th><label for="difficulty_level">Difficulty Level</label></th>';
    echo '<td><select id="difficulty_level" name="difficulty_level">';
    echo '<option value="beginner" ' . selected('beginner', $difficulty_level, false) . '>Beginner</option>';
    echo '<option value="intermediate" ' . selected('intermediate', $difficulty_level, false) . '>Intermediate</option>';
    echo '<option value="advanced" ' . selected('advanced', $difficulty_level, false) . '>Advanced</option>';
    echo '</select></td></tr>';
    echo '</table>';
}

function bridgeland_whitepaper_meta_callback($post) {
    wp_nonce_field('bridgeland_whitepaper_meta', 'bridgeland_whitepaper_nonce');

    $file_url = get_post_meta($post->ID, '_whitepaper_file', true);
    $pages = get_post_meta($post->ID, '_whitepaper_pages', true);
    $industry = get_post_meta($post->ID, '_target_industry', true);
    $gated_content = get_post_meta($post->ID, '_gated_content', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="whitepaper_file">PDF File URL</label></th>';
    echo '<td><input type="url" id="whitepaper_file" name="whitepaper_file" value="' . esc_attr($file_url) . '" style="width: 100%;" /></td></tr>';

    echo '<tr><th><label for="whitepaper_pages">Number of Pages</label></th>';
    echo '<td><input type="number" id="whitepaper_pages" name="whitepaper_pages" value="' . esc_attr($pages) . '" min="1" /></td></tr>';

    echo '<tr><th><label for="target_industry">Target Industry</label></th>';
    echo '<td><input type="text" id="target_industry" name="target_industry" value="' . esc_attr($industry) . '" style="width: 100%;" /></td></tr>';

    echo '<tr><th><label for="gated_content">Gated Content</label></th>';
    echo '<td><input type="checkbox" id="gated_content" name="gated_content" value="1" ' . checked(1, $gated_content, false) . ' /> Require email for download</td></tr>';
    echo '</table>';
}

/**
 * Save custom meta fields
 */
function bridgeland_save_blog_meta($post_id) {
    // Verify nonce and permissions
    if (!isset($_POST['bridgeland_blog_nonce']) ||
        !wp_verify_nonce($_POST['bridgeland_blog_nonce'], 'bridgeland_blog_meta') ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save blog post meta
    if (isset($_POST['reading_time'])) {
        update_post_meta($post_id, '_reading_time', sanitize_text_field($_POST['reading_time']));
    }
    if (isset($_POST['featured_post'])) {
        update_post_meta($post_id, '_featured_post', 1);
    } else {
        delete_post_meta($post_id, '_featured_post');
    }
    if (isset($_POST['author_bio'])) {
        update_post_meta($post_id, '_author_bio_override', sanitize_textarea_field($_POST['author_bio']));
    }
    if (isset($_POST['related_services'])) {
        update_post_meta($post_id, '_related_services', sanitize_text_field($_POST['related_services']));
    }

    // Save resource meta
    if (isset($_POST['bridgeland_resource_nonce']) &&
        wp_verify_nonce($_POST['bridgeland_resource_nonce'], 'bridgeland_resource_meta')) {

        if (isset($_POST['resource_type'])) {
            update_post_meta($post_id, '_resource_type', sanitize_text_field($_POST['resource_type']));
        }
        if (isset($_POST['download_url'])) {
            update_post_meta($post_id, '_download_url', esc_url_raw($_POST['download_url']));
        }
        if (isset($_POST['external_url'])) {
            update_post_meta($post_id, '_external_url', esc_url_raw($_POST['external_url']));
        }
        if (isset($_POST['difficulty_level'])) {
            update_post_meta($post_id, '_difficulty_level', sanitize_text_field($_POST['difficulty_level']));
        }
    }

    // Save whitepaper meta
    if (isset($_POST['bridgeland_whitepaper_nonce']) &&
        wp_verify_nonce($_POST['bridgeland_whitepaper_nonce'], 'bridgeland_whitepaper_meta')) {

        if (isset($_POST['whitepaper_file'])) {
            update_post_meta($post_id, '_whitepaper_file', esc_url_raw($_POST['whitepaper_file']));
        }
        if (isset($_POST['whitepaper_pages'])) {
            update_post_meta($post_id, '_whitepaper_pages', sanitize_text_field($_POST['whitepaper_pages']));
        }
        if (isset($_POST['target_industry'])) {
            update_post_meta($post_id, '_target_industry', sanitize_text_field($_POST['target_industry']));
        }
        if (isset($_POST['gated_content'])) {
            update_post_meta($post_id, '_gated_content', 1);
        } else {
            delete_post_meta($post_id, '_gated_content');
        }
    }
}
add_action('save_post', 'bridgeland_save_blog_meta');

/**
 * Calculate reading time automatically
 */
function bridgeland_calculate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average 200 words per minute
    return max(1, $reading_time); // Minimum 1 minute
}

/**
 * Auto-calculate reading time on post save
 */
function bridgeland_auto_reading_time($post_id) {
    if (get_post_type($post_id) === 'post' && !get_post_meta($post_id, '_reading_time', true)) {
        $content = get_post_field('post_content', $post_id);
        $reading_time = bridgeland_calculate_reading_time($content);
        update_post_meta($post_id, '_reading_time', $reading_time);
    }
}
add_action('save_post', 'bridgeland_auto_reading_time');

/**
 * Get related posts based on categories and tags
 */
function bridgeland_get_related_posts($post_id, $limit = 3) {
    $post = get_post($post_id);
    $categories = wp_get_post_categories($post_id);
    $tags = wp_get_post_tags($post_id);

    $args = array(
        'posts_per_page' => $limit,
        'post__not_in' => array($post_id),
        'meta_query' => array(
            array(
                'key' => '_featured_post',
                'compare' => 'EXISTS',
            ),
        ),
        'orderby' => 'meta_value_num date',
        'order' => 'DESC'
    );

    if (!empty($categories)) {
        $args['category__in'] = $categories;
    }

    if (!empty($tags)) {
        $tag_ids = array();
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->term_id;
        }
        $args['tag__in'] = $tag_ids;
    }

    return get_posts($args);
}

/**
 * Enhanced excerpt with custom length
 */
function bridgeland_custom_excerpt($length = 25, $more = '...') {
    return wp_trim_words(get_the_content(), $length, $more);
}

/**
 * Add social sharing functionality
 */
function bridgeland_social_sharing_buttons($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $url = get_permalink($post_id);
    $title = get_the_title($post_id);
    $excerpt = bridgeland_custom_excerpt(20);

    $linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($url);
    $twitter_url = 'https://twitter.com/intent/tweet?url=' . urlencode($url) . '&text=' . urlencode($title);
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
    $email_url = 'mailto:?subject=' . urlencode($title) . '&body=' . urlencode($excerpt . ' ' . $url);

    $html = '<div class="social-sharing">';
    $html .= '<h6 class="sharing-title">Share this insight:</h6>';
    $html .= '<div class="sharing-buttons">';
    $html .= '<a href="' . $linkedin_url . '" target="_blank" class="btn btn-outline-primary btn-sm me-2" title="Share on LinkedIn"><i class="fab fa-linkedin"></i></a>';
    $html .= '<a href="' . $twitter_url . '" target="_blank" class="btn btn-outline-info btn-sm me-2" title="Share on Twitter"><i class="fab fa-twitter"></i></a>';
    $html .= '<a href="' . $facebook_url . '" target="_blank" class="btn btn-outline-primary btn-sm me-2" title="Share on Facebook"><i class="fab fa-facebook"></i></a>';
    $html .= '<a href="' . $email_url . '" class="btn btn-outline-secondary btn-sm" title="Share via Email"><i class="fas fa-envelope"></i></a>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

/**
 * Content recommendation system
 */
function bridgeland_content_recommendations($post_id = null, $limit = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Get user reading history from cookies/session
    $reading_history = isset($_COOKIE['bridgeland_reading_history']) ?
        json_decode($_COOKIE['bridgeland_reading_history'], true) : array();

    $categories = wp_get_post_categories($post_id);
    $recommendations = array();

    // Get related posts by category
    if (!empty($categories)) {
        $related_posts = get_posts(array(
            'numberposts' => $limit * 2,
            'category__in' => $categories,
            'post__not_in' => array_merge(array($post_id), $reading_history),
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        $recommendations = array_merge($recommendations, $related_posts);
    }

    // Get popular posts
    $popular_posts = get_posts(array(
        'numberposts' => $limit,
        'meta_key' => '_post_views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post__not_in' => array($post_id)
    ));

    $recommendations = array_merge($recommendations, $popular_posts);

    // Remove duplicates and limit
    $unique_recommendations = array();
    $seen_ids = array();

    foreach ($recommendations as $post) {
        if (!in_array($post->ID, $seen_ids) && count($unique_recommendations) < $limit) {
            $unique_recommendations[] = $post;
            $seen_ids[] = $post->ID;
        }
    }

    return $unique_recommendations;
}

/**
 * Track post views for popularity
 */
function bridgeland_track_post_views($post_id) {
    if (is_single() && !is_admin() && !current_user_can('edit_posts')) {
        $views = get_post_meta($post_id, '_post_views', true);
        $views = $views ? $views + 1 : 1;
        update_post_meta($post_id, '_post_views', $views);

        // Track reading history in cookie
        $history = isset($_COOKIE['bridgeland_reading_history']) ?
            json_decode($_COOKIE['bridgeland_reading_history'], true) : array();

        if (!in_array($post_id, $history)) {
            $history[] = $post_id;
            // Keep only last 10 posts
            if (count($history) > 10) {
                array_shift($history);
            }
            setcookie('bridgeland_reading_history', json_encode($history), time() + (86400 * 30), '/');
        }
    }
}
add_action('wp_head', function() {
    if (is_single()) {
        bridgeland_track_post_views(get_the_ID());
    }
});

/**
 * Advanced search functionality
 */
function bridgeland_advanced_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'financial_resource', 'whitepaper', 'case_study'));

        // Boost exact matches
        $search_term = get_search_query();
        if (!empty($search_term)) {
            $query->set('meta_query', array(
                'relation' => 'OR',
                array(
                    'key' => '_related_services',
                    'value' => $search_term,
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => '_target_industry',
                    'value' => $search_term,
                    'compare' => 'LIKE'
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'bridgeland_advanced_search');