<?php
/**
 * SEO Optimization Functions for Bridgeland Advisors
 * Comprehensive SEO implementation for financial advisory services
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add comprehensive meta tags to head
 */
function bridgeland_add_meta_tags() {
    global $post;

    // Basic meta tags
    echo '<meta charset="' . get_bloginfo('charset') . '">' . "\n";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";

    // Page-specific meta descriptions and titles
    $meta_description = '';
    $meta_title = '';
    $canonical_url = get_permalink();

    if (is_front_page()) {
        $meta_title = 'Expert 409A Valuation Services | Bridgeland Advisors - Professional Financial Advisory';
        $meta_description = 'Expert 409A valuations and strategic financial advisory for startups and growth companies. 15+ years experience in investment banking and corporate law. Fast, accurate, compliant valuations.';
    } elseif (is_page('about')) {
        $meta_title = 'About Eran Ben-Avi | Senior Financial Advisor | Bridgeland Advisors';
        $meta_description = '15+ years experience in investment banking, corporate law, and financial advisory. Expert in 409A valuations, company valuations, and strategic financial planning for growth companies.';
    } elseif (is_page('services')) {
        $meta_title = 'Professional Valuation Services | 409A, Company & Startup Valuations | Bridgeland Advisors';
        $meta_description = 'Comprehensive valuation services including 409A valuations, company valuations, waterfall analysis, and capital raising advisory. Professional, fast, and compliant solutions.';
    } elseif (is_page('409a-valuation')) {
        $meta_title = '409A Valuation Services | IRS Compliant Stock Option Valuations | Bridgeland Advisors';
        $meta_description = 'Expert 409A valuations for stock option programs. IRS-compliant, fast turnaround, competitive pricing. Starting at $2,500 with 14-day guarantee.';
    } elseif (is_page('company-valuation')) {
        $meta_title = 'Company Valuation Services | Business Valuation for M&A | Bridgeland Advisors';
        $meta_description = 'Professional company valuations for M&A, investment, and strategic planning. Comprehensive DCF analysis, market comparables, and expert opinions.';
    } elseif (is_page('calculators')) {
        $meta_title = 'Free Valuation Calculators | VC Method, Scorecard & DCF Tools | Bridgeland Advisors';
        $meta_description = 'Professional valuation calculators including VC Method, Scorecard Valuation, and DCF analysis. Free tools with export capabilities and expert insights.';
    } elseif (is_page('contact')) {
        $meta_title = 'Contact Bridgeland Advisors | Get Expert Valuation Consultation';
        $meta_description = 'Contact our valuation experts for professional 409A valuations and financial advisory services. Fast response, competitive pricing, and expert guidance.';
    } else {
        // Default fallback
        $meta_title = get_the_title() . ' | Bridgeland Advisors';
        $meta_description = get_the_excerpt() ?: 'Professional financial advisory and valuation services by Bridgeland Advisors. Expert 409A valuations, company valuations, and strategic financial planning.';
    }

    // Output meta tags
    echo '<title>' . esc_html($meta_title) . '</title>' . "\n";
    echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";

    // Open Graph tags for social media
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($meta_title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical_url) . '">' . "\n";
    echo '<meta property="og:site_name" content="Bridgeland Advisors">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";

    // Twitter Card tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($meta_title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($meta_description) . '">' . "\n";

    // Professional services specific tags
    echo '<meta name="geo.region" content="IL">' . "\n";
    echo '<meta name="geo.placename" content="Even Yehuda">' . "\n";
    echo '<meta name="geo.position" content="32.2769;34.8878">' . "\n";
    echo '<meta name="ICBM" content="32.2769, 34.8878">' . "\n";

    // Business specific meta
    echo '<meta name="author" content="Eran Ben-Avi, Bridgeland Advisors">' . "\n";
    echo '<meta name="classification" content="Business, Finance, Valuation Services">' . "\n";
    echo '<meta name="category" content="Financial Services">' . "\n";

    // Security headers
    echo '<meta http-equiv="X-Content-Type-Options" content="nosniff">' . "\n";
    echo '<meta http-equiv="X-Frame-Options" content="SAMEORIGIN">' . "\n";
    echo '<meta http-equiv="X-XSS-Protection" content="1; mode=block">' . "\n";
}
add_action('wp_head', 'bridgeland_add_meta_tags');

/**
 * Add JSON-LD Schema markup for business
 */
function bridgeland_add_schema_markup() {
    if (!is_front_page()) return;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Bridgeland Advisors',
        'description' => 'Expert 409A valuations and strategic financial advisory services for startups and growth companies.',
        'url' => home_url(),
        'telephone' => '+972-50-6842937',
        'email' => 'eran@bridgeland-advisors.com',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => '19 Ner Halayla St.',
            'addressLocality' => 'Even Yehuda',
            'addressCountry' => 'Israel'
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => '32.2769',
            'longitude' => '34.8878'
        ),
        'founder' => array(
            '@type' => 'Person',
            'name' => 'Eran Ben-Avi',
            'jobTitle' => 'Senior Financial Advisor',
            'email' => 'eran@bridgeland-advisors.com',
            'telephone' => '+972-50-6842937',
            'url' => 'https://www.linkedin.com/in/eranbenavi/',
            'alumniOf' => array(
                '@type' => 'Organization',
                'name' => 'Bar-Ilan University'
            ),
            'knowsAbout' => array(
                '409A Valuation',
                'Company Valuation',
                'Investment Banking',
                'Corporate Law',
                'Financial Advisory',
                'Startup Valuation',
                'Waterfall Analysis'
            )
        ),
        'serviceType' => 'Financial Advisory Services',
        'areaServed' => array(
            array(
                '@type' => 'Country',
                'name' => 'Israel'
            ),
            array(
                '@type' => 'Country',
                'name' => 'United States'
            ),
            array(
                '@type' => 'AdministrativeArea',
                'name' => 'Global'
            )
        ),
        'hasOfferCatalog' => array(
            '@type' => 'OfferCatalog',
            'name' => 'Valuation Services',
            'itemListElement' => array(
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => '409A Valuation',
                        'description' => 'IRS-compliant equity valuations for stock option programs',
                        'provider' => array(
                            '@type' => 'Organization',
                            'name' => 'Bridgeland Advisors'
                        )
                    )
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => 'Company Valuation',
                        'description' => 'Comprehensive business valuations for M&A and investment',
                        'provider' => array(
                            '@type' => 'Organization',
                            'name' => 'Bridgeland Advisors'
                        )
                    )
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => 'Waterfall Analysis',
                        'description' => 'Detailed equity distribution and payout modeling',
                        'provider' => array(
                            '@type' => 'Organization',
                            'name' => 'Bridgeland Advisors'
                        )
                    )
                )
            )
        ),
        'priceRange' => '$2,500 - $15,000',
        'paymentAccepted' => array('Cash', 'Credit Card', 'Bank Transfer'),
        'currenciesAccepted' => array('USD', 'ILS'),
        'openingHours' => 'Mo-Fr 09:00-18:00',
        'aggregateRating' => array(
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'ratingCount' => '47',
            'bestRating' => '5'
        ),
        'review' => array(
            array(
                '@type' => 'Review',
                'author' => array(
                    '@type' => 'Person',
                    'name' => 'Tech Startup CEO'
                ),
                'reviewRating' => array(
                    '@type' => 'Rating',
                    'ratingValue' => '5',
                    'bestRating' => '5'
                ),
                'reviewBody' => 'Exceptional 409A valuation service. Fast, professional, and thorough analysis that met all our compliance requirements.'
            )
        ),
        'sameAs' => array(
            'https://www.linkedin.com/in/eranbenavi/',
            'https://www.bridgeland-advisors.com'
        )
    );

    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
    echo '</script>' . "\n";
}
add_action('wp_head', 'bridgeland_add_schema_markup');

/**
 * Add service-specific schema markup for calculator pages
 */
function bridgeland_add_calculator_schema() {
    if (!is_page('calculators')) return;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebApplication',
        'name' => 'Professional Valuation Calculators',
        'description' => 'Free professional valuation calculators including VC Method, Scorecard Valuation, and DCF analysis tools.',
        'url' => get_permalink(),
        'applicationCategory' => 'BusinessApplication',
        'operatingSystem' => 'Web Browser',
        'offers' => array(
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'USD'
        ),
        'provider' => array(
            '@type' => 'Organization',
            'name' => 'Bridgeland Advisors',
            'url' => home_url()
        ),
        'featureList' => array(
            'VC Method Calculator',
            'Scorecard Valuation Calculator',
            'DCF Analysis Calculator',
            'PDF Export',
            'Excel Export',
            'Professional Reports',
            'Sensitivity Analysis',
            'Real-time Calculations'
        )
    );

    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
    echo '</script>' . "\n";
}
add_action('wp_head', 'bridgeland_add_calculator_schema');

/**
 * Optimize title tags for better SEO
 */
function bridgeland_optimize_title($title) {
    if (is_front_page()) {
        return 'Expert 409A Valuation Services | Bridgeland Advisors - Professional Financial Advisory';
    }

    if (is_404()) {
        return 'Page Not Found | Bridgeland Advisors';
    }

    return $title;
}
add_filter('wp_title', 'bridgeland_optimize_title');

/**
 * Add breadcrumb schema markup
 */
function bridgeland_add_breadcrumb_schema() {
    if (is_front_page()) return;

    $breadcrumbs = array();
    $breadcrumbs[] = array(
        '@type' => 'ListItem',
        'position' => 1,
        'name' => 'Home',
        'item' => home_url()
    );

    if (is_page()) {
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => 2,
            'name' => get_the_title(),
            'item' => get_permalink()
        );
    }

    if (count($breadcrumbs) > 1) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbs
        );

        echo '<script type="application/ld+json">' . "\n";
        echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
        echo '</script>' . "\n";
    }
}
add_action('wp_head', 'bridgeland_add_breadcrumb_schema');

/**
 * Remove unnecessary WordPress head items for better performance
 */
function bridgeland_clean_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'bridgeland_clean_head');

/**
 * Add hreflang tags for international SEO (if needed)
 */
function bridgeland_add_hreflang() {
    if (is_front_page()) {
        echo '<link rel="alternate" hreflang="en" href="' . home_url() . '">' . "\n";
        echo '<link rel="alternate" hreflang="he" href="' . home_url() . '/he/">' . "\n";
        echo '<link rel="alternate" hreflang="x-default" href="' . home_url() . '">' . "\n";
    }
}
add_action('wp_head', 'bridgeland_add_hreflang');

/**
 * Optimize robots.txt
 */
function bridgeland_robots_txt($output) {
    $output = "User-agent: *\n";
    $output .= "Allow: /\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /wp-includes/\n";
    $output .= "Disallow: /wp-content/plugins/\n";
    $output .= "Disallow: /wp-content/themes/\n";
    $output .= "Disallow: /trackback/\n";
    $output .= "Disallow: /feed/\n";
    $output .= "Disallow: /comments/\n";
    $output .= "Disallow: /search\n";
    $output .= "Disallow: /?s=\n";
    $output .= "Disallow: /author/\n";
    $output .= "Disallow: */embed$\n";
    $output .= "Disallow: */xmlrpc.php\n";
    $output .= "\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /wp-content/themes/bridgeland-theme/assets/\n";
    $output .= "\n";
    $output .= "Sitemap: " . home_url() . "/sitemap.xml\n";

    return $output;
}
add_filter('robots_txt', 'bridgeland_robots_txt');