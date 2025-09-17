<?php
/**
 * Analytics and Tracking for Bridgeland Advisors
 * Comprehensive analytics implementation with privacy compliance
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Google Analytics 4
 */
function bridgeland_add_ga4() {
    $ga4_id = get_theme_mod('ga4_tracking_id', '');

    if (!empty($ga4_id) && !is_admin()) {
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga4_id); ?>"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?php echo esc_attr($ga4_id); ?>', {
            'anonymize_ip': true,
            'allow_google_signals': false,
            'allow_ad_personalization_signals': false
        });

        // Enhanced ecommerce tracking for calculator usage
        gtag('config', '<?php echo esc_attr($ga4_id); ?>', {
            'custom_map': {
                'custom_parameter_1': 'calculator_type',
                'custom_parameter_2': 'calculation_value'
            }
        });
        </script>
        <?php
    }
}
add_action('wp_head', 'bridgeland_add_ga4');

/**
 * Add Facebook Pixel (optional)
 */
function bridgeland_add_facebook_pixel() {
    $fb_pixel_id = get_theme_mod('facebook_pixel_id', '');

    if (!empty($fb_pixel_id) && !is_admin()) {
        ?>
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo esc_attr($fb_pixel_id); ?>');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?php echo esc_attr($fb_pixel_id); ?>&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
        <?php
    }
}
add_action('wp_head', 'bridgeland_add_facebook_pixel');

/**
 * Add LinkedIn Insight Tag
 */
function bridgeland_add_linkedin_insight() {
    $linkedin_partner_id = get_theme_mod('linkedin_partner_id', '');

    if (!empty($linkedin_partner_id) && !is_admin()) {
        ?>
        <!-- LinkedIn Insight Tag -->
        <script type="text/javascript">
        _linkedin_partner_id = "<?php echo esc_attr($linkedin_partner_id); ?>";
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);
        </script><script type="text/javascript">
        (function(l) {
        if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
        window.lintrk.q=[]}
        var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript";b.async = true;
        b.src = "https://snap.licdn.com/li.js";
        s.parentNode.insertBefore(b, s);})(window.lintrk);
        </script>
        <noscript>
        <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=<?php echo esc_attr($linkedin_partner_id); ?>&fmt=gif" />
        </noscript>
        <!-- End LinkedIn Insight Tag -->
        <?php
    }
}
add_action('wp_head', 'bridgeland_add_linkedin_insight');

/**
 * Custom event tracking for calculators
 */
function bridgeland_calculator_tracking() {
    if (is_page('calculators')) {
        ?>
        <script>
        // Track calculator usage
        function trackCalculatorEvent(calculatorType, action, value = null) {
            if (typeof gtag !== 'undefined') {
                gtag('event', action, {
                    'event_category': 'Calculator',
                    'event_label': calculatorType,
                    'value': value,
                    'calculator_type': calculatorType,
                    'calculation_value': value
                });
            }

            // Facebook Pixel tracking
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Lead', {
                    content_name: calculatorType + ' Calculator',
                    content_category: 'Financial Tools'
                });
            }

            // LinkedIn tracking
            if (typeof lintrk !== 'undefined') {
                lintrk('track', { conversion_id: 'calculator_usage' });
            }
        }

        // Track calculator selections
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.calculator-option').forEach(function(option) {
                option.addEventListener('click', function() {
                    const calculatorType = this.getAttribute('data-calculator');
                    trackCalculatorEvent(calculatorType, 'calculator_selected');
                });
            });

            // Track calculation completions
            document.querySelectorAll('.calculator-container form').forEach(function(form) {
                form.addEventListener('submit', function() {
                    const calculatorType = this.closest('.calculator-container').getAttribute('data-calculator');
                    trackCalculatorEvent(calculatorType, 'calculation_completed');
                });
            });

            // Track exports
            window.originalExportToPDF = window.exportToPDF;
            window.exportToPDF = function(calculatorType) {
                trackCalculatorEvent(calculatorType, 'export_pdf');
                return window.originalExportToPDF(calculatorType);
            };

            window.originalExportToExcel = window.exportToExcel;
            window.exportToExcel = function(calculatorType) {
                trackCalculatorEvent(calculatorType, 'export_excel');
                return window.originalExportToExcel(calculatorType);
            };
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'bridgeland_calculator_tracking');

/**
 * Track contact form submissions
 */
function bridgeland_contact_tracking() {
    if (is_page('contact')) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track contact form submissions
            const contactForms = document.querySelectorAll('form[action*="contact"]');
            contactForms.forEach(function(form) {
                form.addEventListener('submit', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'contact_form_submit', {
                            'event_category': 'Contact',
                            'event_label': 'Main Contact Form'
                        });
                    }

                    if (typeof fbq !== 'undefined') {
                        fbq('track', 'Contact');
                    }

                    if (typeof lintrk !== 'undefined') {
                        lintrk('track', { conversion_id: 'contact_form' });
                    }
                });
            });

            // Track phone clicks
            document.querySelectorAll('a[href^="tel:"]').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'phone_click', {
                            'event_category': 'Contact',
                            'event_label': this.getAttribute('href')
                        });
                    }
                });
            });

            // Track email clicks
            document.querySelectorAll('a[href^="mailto:"]').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'email_click', {
                            'event_category': 'Contact',
                            'event_label': this.getAttribute('href')
                        });
                    }
                });
            });

            // Track WhatsApp clicks
            document.querySelectorAll('a[href*="wa.me"]').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'whatsapp_click', {
                            'event_category': 'Contact',
                            'event_label': 'WhatsApp Button'
                        });
                    }
                });
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'bridgeland_contact_tracking');

/**
 * Track service page engagement
 */
function bridgeland_service_tracking() {
    if (is_page(array('409a-valuation', 'company-valuation', 'startup-valuation', 'waterfall-analysis', 'capital-raising', 'term-sheet-negotiation'))) {
        $service_name = get_post_field('post_name');
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track service page views
            if (typeof gtag !== 'undefined') {
                gtag('event', 'service_page_view', {
                    'event_category': 'Services',
                    'event_label': '<?php echo esc_js($service_name); ?>'
                });
            }

            // Track CTA button clicks
            document.querySelectorAll('.btn, .cta-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'service_cta_click', {
                            'event_category': 'Services',
                            'event_label': '<?php echo esc_js($service_name); ?>',
                            'button_text': this.textContent.trim()
                        });
                    }
                });
            });

            // Track scroll depth
            let maxScroll = 0;
            window.addEventListener('scroll', function() {
                const scrollPercent = Math.round((window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100);
                if (scrollPercent > maxScroll && scrollPercent % 25 === 0) {
                    maxScroll = scrollPercent;
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'scroll_depth', {
                            'event_category': 'Engagement',
                            'event_label': '<?php echo esc_js($service_name); ?>',
                            'value': scrollPercent
                        });
                    }
                }
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'bridgeland_service_tracking');

/**
 * Add customizer settings for analytics
 */
function bridgeland_analytics_customizer($wp_customize) {
    // Analytics Section
    $wp_customize->add_section('bridgeland_analytics', array(
        'title' => 'Analytics & Tracking',
        'priority' => 120,
    ));

    // Google Analytics 4
    $wp_customize->add_setting('ga4_tracking_id', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ga4_tracking_id', array(
        'label' => 'Google Analytics 4 Tracking ID',
        'section' => 'bridgeland_analytics',
        'type' => 'text',
        'description' => 'Enter your GA4 Measurement ID (e.g., G-XXXXXXXXXX)',
    ));

    // Facebook Pixel
    $wp_customize->add_setting('facebook_pixel_id', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('facebook_pixel_id', array(
        'label' => 'Facebook Pixel ID',
        'section' => 'bridgeland_analytics',
        'type' => 'text',
        'description' => 'Enter your Facebook Pixel ID',
    ));

    // LinkedIn Partner ID
    $wp_customize->add_setting('linkedin_partner_id', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('linkedin_partner_id', array(
        'label' => 'LinkedIn Partner ID',
        'section' => 'bridgeland_analytics',
        'type' => 'text',
        'description' => 'Enter your LinkedIn Insight Tag Partner ID',
    ));
}
add_action('customize_register', 'bridgeland_analytics_customizer');

/**
 * Heat mapping and user behavior tracking
 */
function bridgeland_heatmap_tracking() {
    $hotjar_id = get_theme_mod('hotjar_site_id', '');

    if (!empty($hotjar_id) && !is_admin()) {
        ?>
        <!-- Hotjar Tracking Code -->
        <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:<?php echo intval($hotjar_id); ?>,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
        <?php
    }
}
add_action('wp_head', 'bridgeland_heatmap_tracking');

/**
 * Cookie consent for GDPR compliance
 */
function bridgeland_cookie_consent() {
    if (!is_admin()) {
        ?>
        <div id="cookie-consent" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background: #333; color: white; padding: 20px; z-index: 10000; text-align: center;">
            <p style="margin: 0 0 10px 0;">This website uses cookies to enhance your experience and provide analytics. By continuing to browse, you consent to our use of cookies.
            <a href="<?php echo home_url('/privacy-policy/'); ?>" style="color: #8B0000;">Learn more</a></p>
            <button onclick="acceptCookies()" style="background: #8B0000; color: white; border: none; padding: 10px 20px; margin: 0 10px; border-radius: 5px; cursor: pointer;">Accept</button>
            <button onclick="declineCookies()" style="background: transparent; color: white; border: 1px solid white; padding: 10px 20px; margin: 0 10px; border-radius: 5px; cursor: pointer;">Decline</button>
        </div>

        <script>
        // Cookie consent management
        function showCookieConsent() {
            if (!localStorage.getItem('cookieConsent')) {
                document.getElementById('cookie-consent').style.display = 'block';
            }
        }

        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');
            document.getElementById('cookie-consent').style.display = 'none';
            // Initialize tracking after consent
            if (typeof gtag !== 'undefined') {
                gtag('consent', 'update', {
                    'analytics_storage': 'granted',
                    'ad_storage': 'granted'
                });
            }
        }

        function declineCookies() {
            localStorage.setItem('cookieConsent', 'declined');
            document.getElementById('cookie-consent').style.display = 'none';
            // Disable tracking
            if (typeof gtag !== 'undefined') {
                gtag('consent', 'update', {
                    'analytics_storage': 'denied',
                    'ad_storage': 'denied'
                });
            }
        }

        // Check consent on page load
        document.addEventListener('DOMContentLoaded', function() {
            const consent = localStorage.getItem('cookieConsent');
            if (!consent) {
                setTimeout(showCookieConsent, 2000); // Show after 2 seconds
            } else if (consent === 'accepted') {
                // Initialize tracking
                if (typeof gtag !== 'undefined') {
                    gtag('consent', 'update', {
                        'analytics_storage': 'granted',
                        'ad_storage': 'granted'
                    });
                }
            }
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'bridgeland_cookie_consent');

/**
 * Performance monitoring
 */
function bridgeland_performance_monitoring() {
    if (!is_admin()) {
        ?>
        <script>
        // Monitor page load performance
        window.addEventListener('load', function() {
            if ('performance' in window) {
                const perfData = performance.getEntriesByType('navigation')[0];
                const loadTime = Math.round(perfData.loadEventEnd - perfData.fetchStart);

                if (typeof gtag !== 'undefined') {
                    gtag('event', 'page_load_time', {
                        'event_category': 'Performance',
                        'value': loadTime,
                        'metric_id': 'page_load'
                    });
                }
            }
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'bridgeland_performance_monitoring');