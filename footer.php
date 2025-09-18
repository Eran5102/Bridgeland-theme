</main>

<!-- Footer -->
<footer class="bg-dark text-light py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Company Information -->
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <svg width="32" height="24" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                        <path d="M5 25 Q 15 10, 20 25 Q 25 5, 35 25" stroke="var(--color-maroon)" stroke-width="2" fill="none"/>
                        <path d="M2 25 Q 20 0, 38 25" stroke="var(--color-maroon)" stroke-width="3" fill="none"/>
                        <line x1="8" y1="20" x2="8" y2="25" stroke="var(--color-maroon)" stroke-width="1.5"/>
                        <line x1="13" y1="15" x2="13" y2="25" stroke="var(--color-maroon)" stroke-width="1.5"/>
                        <line x1="20" y1="8" x2="20" y2="25" stroke="var(--color-maroon)" stroke-width="1.5"/>
                        <line x1="27" y1="15" x2="27" y2="25" stroke="var(--color-maroon)" stroke-width="1.5"/>
                        <line x1="32" y1="20" x2="32" y2="25" stroke="var(--color-maroon)" stroke-width="1.5"/>
                    </svg>
                    <h5 class="text-white mb-0">Bridgeland Advisors</h5>
                </div>
                <p class="text-light mb-3">
                    Expert 409A valuations and strategic financial advisory services for startups and growth companies.
                    15+ years of experience in investment banking, corporate law, and financial advisory.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?php echo get_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/'); ?>" class="text-light" target="_blank" rel="noopener">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                    <a href="mailto:<?php echo get_theme_mod('company_email', 'eran@bridgeland-advisors.com'); ?>" class="text-light">
                        <i class="fas fa-envelope fa-lg"></i>
                    </a>
                    <a href="tel:<?php echo get_theme_mod('company_phone', '+972-50-6842937'); ?>" class="text-light">
                        <i class="fas fa-phone fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Services</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo home_url('/409a-valuation/'); ?>" class="text-light text-decoration-none">409A Valuation</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/company-valuation/'); ?>" class="text-light text-decoration-none">Company Valuation</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/startup-valuation/'); ?>" class="text-light text-decoration-none">Startup Valuation</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/waterfall-analysis/'); ?>" class="text-light text-decoration-none">Waterfall Analysis</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/capital-raising/'); ?>" class="text-light text-decoration-none">Capital Raising</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/term-sheet-negotiation/'); ?>" class="text-light text-decoration-none">Term Sheet Negotiation</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Resources</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo home_url('/about/'); ?>" class="text-light text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/case-studies/'); ?>" class="text-light text-decoration-none">Case Studies</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/faq/'); ?>" class="text-light text-decoration-none">FAQ</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/resources/'); ?>" class="text-light text-decoration-none">Resource Library</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/calculators/'); ?>" class="text-light text-decoration-none">Calculators</a></li>
                    <li class="mb-2"><a href="<?php echo home_url('/blog/'); ?>" class="text-light text-decoration-none">Insights</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <h6 class="text-white mb-3">Contact Information</h6>
                <div class="mb-3">
                    <div class="d-flex align-items-start mb-2">
                        <i class="fas fa-envelope text-brand me-2 mt-1"></i>
                        <div>
                            <div><a href="mailto:eran@bridgeland-advisors.com" class="text-light text-decoration-none">eran@bridgeland-advisors.com</a></div>
                            <div><a href="mailto:info@bridgeland-advisors.com" class="text-light text-decoration-none">info@bridgeland-advisors.com</a></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-2">
                        <i class="fas fa-phone text-brand me-2 mt-1"></i>
                        <div class="text-light">
                            <div><a href="tel:+12153133224" class="text-light text-decoration-none">+1 (215) 313-3224</a> <small>(US Clients)</small></div>
                            <div><a href="tel:+972-50-6842937" class="text-light text-decoration-none">+972-50-6842937</a> <small>(International)</small></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-brand me-2 mt-1"></i>
                        <div class="text-light">
                            19 Ner Halayla St.<br>Even Yehuda, Israel
                        </div>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="d-grid gap-2 d-md-flex">
                    <a href="mailto:eran@bridgeland-advisors.com?subject=409A Valuation Inquiry" class="btn btn-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i>Quick Email
                    </a>
                    <a href="tel:+12153133224" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-phone me-1"></i>Call US
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary">

        <!-- Bottom Footer -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <p class="mb-2 mb-md-0 text-light">&copy; <?php echo date('Y'); ?> Bridgeland Advisors. All rights reserved.</p>
                <div class="ms-md-3 mb-2 mb-md-0">
                    <a href="<?php echo home_url('/privacy-policy/'); ?>" class="text-light text-decoration-none ms-md-3">Privacy Policy</a>
                    <a href="<?php echo home_url('/terms-of-service/'); ?>" class="text-light text-decoration-none ms-3">Terms of Service</a>
                    <a href="<?php echo home_url('/sitemap/'); ?>" class="text-light text-decoration-none ms-3">Sitemap</a>
                </div>
            </div>
            <div>
                <span class="text-muted small">Powered by expertise, driven by results</span>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Float Button -->
<div class="position-fixed" style="bottom: 90px; right: 20px; z-index: 1000;">
    <a href="https://wa.me/12153133224?text=Hi%20Eran,%20I'm%20interested%20in%20learning%20more%20about%20your%20valuation%20services."
       target="_blank"
       class="btn btn-success rounded-circle p-3 shadow-lg"
       title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp fa-lg"></i>
    </a>
</div>

<!-- Back to Top Button -->
<div class="position-fixed" style="bottom: 20px; right: 20px; z-index: 1050;">
    <button id="backToTop" class="btn btn-primary rounded-circle p-3 shadow-lg"
            style="opacity: 1; pointer-events: auto; transform: translateY(0); transition: all 0.3s ease; display: block;"
            title="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<?php wp_footer(); ?>

<!-- Custom JavaScript -->
<script>
// Enhanced Back to top functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.getElementById('backToTop');

    if (backToTopBtn) {
        console.log('Back to top button found:', backToTopBtn);

        // Show/hide based on scroll position
        function toggleBackToTop() {
            const scrolled = window.pageYOffset || document.documentElement.scrollTop;

            if (scrolled > 300) {
                backToTopBtn.style.opacity = '1';
                backToTopBtn.style.pointerEvents = 'auto';
                backToTopBtn.style.transform = 'translateY(0)';
                console.log('Showing back to top button');
            } else {
                backToTopBtn.style.opacity = '0';
                backToTopBtn.style.pointerEvents = 'none';
                backToTopBtn.style.transform = 'translateY(20px)';
                console.log('Hiding back to top button');
            }
        }

        // Scroll event listener
        window.addEventListener('scroll', toggleBackToTop);

        // Click event listener
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Back to top clicked - scrolling to top');

            // Try multiple scroll methods for better compatibility
            try {
                // Method 1: Modern smooth scroll
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.log('Smooth scroll failed, trying fallback');
                // Method 2: Fallback scroll
                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;
            }
        });

        // Initial check
        toggleBackToTop();

        // Force visibility for testing (remove after testing)
        console.log('Button current styles:', {
            display: backToTopBtn.style.display,
            opacity: backToTopBtn.style.opacity,
            position: window.getComputedStyle(backToTopBtn).position
        });
    } else {
        console.error('Back to top button NOT found!');
    }

    // Enhanced Mobile Menu Fix
    function initMobileMenu() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('#navbarNav');

        if (!navbarToggler || !navbarCollapse) {
            console.log('Mobile menu elements not found');
            return;
        }

        console.log('Initializing mobile menu...');

        // First try Bootstrap's collapse if available
        if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
            console.log('Using Bootstrap collapse');
            try {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });

                navbarToggler.addEventListener('click', function(e) {
                    e.preventDefault();
                    bsCollapse.toggle();
                });
            } catch (error) {
                console.log('Bootstrap collapse failed, using manual implementation');
                setupManualMobileMenu();
            }
        } else {
            console.log('Bootstrap not available, using manual mobile menu');
            setupManualMobileMenu();
        }

        function setupManualMobileMenu() {
            navbarToggler.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isExpanded = navbarToggler.getAttribute('aria-expanded') === 'true';
                console.log('Mobile menu toggle clicked, currently expanded:', isExpanded);

                if (isExpanded) {
                    navbarCollapse.classList.remove('show');
                    navbarToggler.setAttribute('aria-expanded', 'false');
                    console.log('Hiding mobile menu');
                } else {
                    navbarCollapse.classList.add('show');
                    navbarToggler.setAttribute('aria-expanded', 'true');
                    console.log('Showing mobile menu');
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
                    navbarCollapse.classList.remove('show');
                    navbarToggler.setAttribute('aria-expanded', 'false');
                }
            });

            // Close menu when clicking on a link
            const navLinks = navbarCollapse.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navbarCollapse.classList.remove('show');
                    navbarToggler.setAttribute('aria-expanded', 'false');
                });
            });
        }
    }

    // Initialize mobile menu
    initMobileMenu();
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.pageYOffset > 50) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }
});
</script>

</body>
</html><?php // This closing PHP tag is optional but included for completeness ?>