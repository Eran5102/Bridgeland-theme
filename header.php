<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Enhanced SEO Meta Tags -->
    <meta name="description" content="Expert 409A valuations and strategic financial advisory by Eran Ben Avi. Fast, compliant, audit-ready valuations for startups and growth companies. 14-day turnaround guaranteed.">
    <meta name="keywords" content="409A valuation, startup valuation, capital raising, financial advisory, venture capital, cap table, equity valuation, IRS compliant, audit defense, Eran Ben Avi">
    <meta name="author" content="Eran Ben Avi, Bridgeland Advisors">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>Bridgeland Advisors - Expert 409A Valuations">
    <meta property="og:description" content="Expert 409A valuations and strategic financial advisory by Eran Ben Avi. Fast, compliant, audit-ready valuations for startups and growth companies.">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    <meta property="og:site_name" content="Bridgeland Advisors">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo home_url(); ?>">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?>Bridgeland Advisors - Expert 409A Valuations">
    <meta name="twitter:description" content="Expert 409A valuations and strategic financial advisory by Eran Ben Avi. Fast, compliant, audit-ready valuations for startups and growth companies.">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-image.jpg">

    <!-- Additional SEO -->
    <meta name="geo.region" content="IL-CD">
    <meta name="geo.placename" content="Even Yehuda">
    <meta name="geo.position" content="32.2667;34.8833">
    <meta name="ICBM" content="32.2667, 34.8833">

    <!-- Business Schema -->
    <link rel="canonical" href="<?php echo home_url(add_query_arg(array(), $_SERVER['REQUEST_URI'])); ?>">

    <!-- Enhanced Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": ["ProfessionalService", "FinancialService"],
        "name": "Bridgeland Advisors",
        "alternateName": "Bridgeland Advisory Services",
        "description": "Expert 409A valuations and strategic financial advisory services for startups and growth companies. Founded by Eran Ben Avi, providing fast, compliant, audit-ready valuations.",
        "url": "<?php echo home_url(); ?>",
        "telephone": "<?php echo get_theme_mod('company_phone', '+972-50-6842937'); ?>",
        "email": "<?php echo get_theme_mod('company_email', 'eran@bridgeland-advisors.com'); ?>",
        "founder": {
            "@type": "Person",
            "name": "Eran Ben Avi",
            "jobTitle": "Managing Partner",
            "description": "Expert in 409A valuations, venture capital finance, and strategic corporate advisory with 15+ years experience",
            "knowsAbout": ["409A Valuation", "Venture Capital", "Startup Valuation", "Cap Table Management", "Financial Advisory", "Exit Waterfall Analysis"],
            "sameAs": ["<?php echo get_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/'); ?>"]
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "19 Ner Halayla St.",
            "addressLocality": "Even Yehuda",
            "addressRegion": "Center District",
            "addressCountry": "IL",
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "32.2667",
                "longitude": "34.8833"
            }
        },
        "serviceType": ["409A Valuation", "Startup Valuation", "Company Valuation", "Capital Raising Advisory", "Exit Waterfall Analysis", "Term Sheet Negotiation"],
        "areaServed": ["Worldwide", "United States", "Israel", "Europe"],
        "priceRange": "$$",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "6",
            "bestRating": "5"
        },
        "review": [
            {
                "@type": "Review",
                "author": {
                    "@type": "Person",
                    "name": "Boaz Fraoman"
                },
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "5"
                },
                "reviewBody": "I highly recommend Bridgeland Advisors for their exceptional service in constructing a 409A valuation for our company. They demonstrated utmost professionalism and efficiency throughout the process."
            },
            {
                "@type": "Review",
                "author": {
                    "@type": "Person",
                    "name": "David Cooper"
                },
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "5"
                },
                "reviewBody": "An absolute gem! Eran is a true expert in the field of VC finance and cap tables. He is an excellent communicator and an outstanding teacher."
            }
        ],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Valuation Services",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "409A Valuation",
                        "description": "IRS-compliant common stock valuations with audit defense included"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Capital Raising Advisory",
                        "description": "Strategic guidance for fundraising and investor relations"
                    }
                }
            ]
        },
        "sameAs": [
            "<?php echo get_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/'); ?>"
        ]
    }
    </script>

    <!-- Calendly Popup Widget -->
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript"></script>

    <!-- Calendly Helper Functions -->
    <script>
    // Helper function to ensure Calendly is loaded
    function openCalendly() {
        try {
            if (typeof Calendly !== 'undefined' && Calendly.initPopupWidget) {
                console.log('Opening Calendly popup widget');
                Calendly.initPopupWidget({url: 'https://calendly.com/bridgeland-advisors'});
                return false;
            } else {
                console.log('Calendly widget not available, opening in new tab');
                // Fallback: open Calendly in new tab if widget fails
                window.open('https://calendly.com/bridgeland-advisors', '_blank');
                return false;
            }
        } catch (error) {
            console.error('Error opening Calendly:', error);
            // Fallback on error
            window.open('https://calendly.com/bridgeland-advisors', '_blank');
            return false;
        }
    }

    // Enhanced Calendly loading check
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Checking for Calendly widget...');

        // Check if Calendly is loaded every 200ms for up to 10 seconds
        let attempts = 0;
        const maxAttempts = 50;

        const checkCalendly = setInterval(function() {
            attempts++;
            if (typeof Calendly !== 'undefined' && Calendly.initPopupWidget) {
                clearInterval(checkCalendly);
                console.log('✅ Calendly loaded successfully after', attempts * 200, 'ms');

                // Add visual indicator that Calendly is ready
                document.querySelectorAll('[onclick*="openCalendly"]').forEach(function(btn) {
                    btn.style.cursor = 'pointer';
                    btn.title = 'Schedule consultation with Calendly';
                });

            } else if (attempts >= maxAttempts) {
                clearInterval(checkCalendly);
                console.warn('⚠️ Calendly failed to load after', maxAttempts * 200, 'ms. Fallback will be used.');

                // Update button titles to indicate fallback
                document.querySelectorAll('[onclick*="openCalendly"]').forEach(function(btn) {
                    btn.title = 'Schedule consultation (opens in new tab)';
                });
            }
        }, 200);
    });
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to main content for accessibility -->
<a class="visually-hidden-focusable" href="#main">Skip to main content</a>

<header class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <!-- Use actual logo file -->
                <img src="<?php echo get_template_directory_uri(); ?>/logo.png" alt="Bridgeland Advisors" height="45" class="me-3">
                <div>
                    <h1 class="h5 mb-0 text-primary fw-bold">Bridgeland Advisors</h1>
                    <small class="text-muted">Strategic Valuation & Advisory</small>
                </div>
            <?php endif; ?>
        </a>

        <!-- Mobile menu toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-4">
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="<?php echo home_url(); ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-medium" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a class="dropdown-item" href="<?php echo home_url('/409a-valuation/'); ?>"><i class="fas fa-gavel me-2 text-primary"></i>409A Valuation</a></li>
                        <li><a class="dropdown-item" href="<?php echo home_url('/company-valuation/'); ?>"><i class="fas fa-building me-2 text-primary"></i>Company Valuation</a></li>
                        <li><a class="dropdown-item" href="<?php echo home_url('/waterfall-analysis/'); ?>"><i class="fas fa-water me-2 text-primary"></i>Exit Waterfall Analysis</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo home_url('/capital-raising/'); ?>"><i class="fas fa-handshake me-2 text-primary"></i>Capital Raising</a></li>
                        <li><a class="dropdown-item" href="<?php echo home_url('/calculators/'); ?>"><i class="fas fa-calculator me-2 text-primary"></i>Calculators</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="<?php echo home_url('/about/'); ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="<?php echo home_url('/resources/'); ?>">Resources</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="<?php echo home_url('/contact/'); ?>">Contact</a>
                </li>
            </ul>

            <!-- CTA Button -->
            <a href="" onclick="return openCalendly();" class="btn btn-primary shadow-sm">
                <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
            </a>
        </div>
    </div>
</header>

<main id="main" class="main-content"><?php // Main content starts here, closed in footer.php ?>