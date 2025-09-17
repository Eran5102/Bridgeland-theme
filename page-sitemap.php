<?php get_header(); ?>

<section class="sitemap-hero py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding-top: 120px !important; position: relative;">
    <!-- Subtle background pattern -->
    <div class="hero-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23B91C1C\" fill-opacity=\"0.1\"><circle cx=\"7\" cy=\"7\" r=\"1\"/><circle cx=\"53\" cy=\"53\" r=\"1\"/><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>');"></div>

    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3 text-dark" style="font-family: 'Source Serif Pro', serif;">Site Map</h1>
                <p class="lead mb-4 text-secondary" style="font-family: 'Inter', sans-serif;">
                    Find everything on our website quickly and easily. Browse our complete directory of pages,
                    services, and resources to locate exactly what you need.
                </p>
                <div class="search-box bg-white rounded-3 p-3 d-inline-block shadow">
                    <div class="input-group">
                        <input type="text" id="sitemap-search" class="form-control border-0" placeholder="Search pages...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sitemap-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Main Navigation -->
                <div class="sitemap-section mb-5">
                    <h2 class="h4 text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-home me-3"></i>Main Navigation
                    </h2>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-house-user text-primary me-2"></i>
                                        <a href="<?php echo home_url('/'); ?>" class="text-decoration-none">Home Page</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Welcome page with company overview, services highlights, and client testimonials.
                                    </p>
                                    <div class="small text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Main landing page with key information
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                        <a href="<?php echo home_url('/about/'); ?>" class="text-decoration-none">About Us</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Learn about Eran Ben-Avi's background, company history, and our approach to financial advisory.
                                    </p>
                                    <div class="small text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Comprehensive company and founder information
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="sitemap-section mb-5">
                    <h2 class="h4 text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-briefcase me-3"></i>Our Services
                    </h2>
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-gavel text-primary me-2"></i>
                                        <a href="<?php echo home_url('/409a-valuation/'); ?>" class="text-decoration-none">409A Valuations</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        IRS-compliant equity valuations for stock option programs and tax compliance.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> 14-day turnaround</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Audit defense included</div>
                                        <div><i class="fas fa-check text-success me-1"></i> AICPA compliant</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-chart-bar text-primary me-2"></i>
                                        <a href="<?php echo home_url('/company-valuation/'); ?>" class="text-decoration-none">Company Valuation</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Comprehensive business valuations for M&A, strategic planning, and investment purposes.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> Multiple methodologies</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Market analysis</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Detailed reports</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-handshake text-primary me-2"></i>
                                        <a href="<?php echo home_url('/capital-raising/'); ?>" class="text-decoration-none">Capital Raising</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Strategic fundraising advisory from pre-seed to growth stage financing rounds.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> Investor targeting</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Pitch preparation</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Term negotiation</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-water text-primary me-2"></i>
                                        <a href="<?php echo home_url('/waterfall-analysis/'); ?>" class="text-decoration-none">Waterfall Analysis</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Exit scenario modeling to understand liquidation preferences and stakeholder distributions.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> Multiple scenarios</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Interactive models</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Strategic insights</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-file-contract text-primary me-2"></i>
                                        <a href="<?php echo home_url('/term-sheet-negotiation/'); ?>" class="text-decoration-none">Term Sheet Negotiation</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Expert guidance on investment terms, valuation clauses, and deal structure optimization.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> Term analysis</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Negotiation strategy</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Deal optimization</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-list text-primary me-2"></i>
                                        <a href="<?php echo home_url('/services/'); ?>" class="text-decoration-none">All Services</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Complete overview of all our financial advisory and valuation services.
                                    </p>
                                    <div class="features small">
                                        <div><i class="fas fa-check text-success me-1"></i> Service comparisons</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Pricing information</div>
                                        <div><i class="fas fa-check text-success me-1"></i> Process details</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources & Tools -->
                <div class="sitemap-section mb-5">
                    <h2 class="h4 text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-tools me-3"></i>Resources & Tools
                    </h2>
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-calculator text-primary me-2"></i>
                                        <a href="<?php echo home_url('/calculators/'); ?>" class="text-decoration-none">Interactive Calculators</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Free online calculators for VC method, scorecard, and DCF valuations.
                                    </p>
                                    <div class="tools small">
                                        <div><i class="fas fa-rocket me-1"></i> VC Method Calculator</div>
                                        <div><i class="fas fa-clipboard-list me-1"></i> Scorecard Valuation</div>
                                        <div><i class="fas fa-chart-line me-1"></i> DCF Calculator</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        <a href="<?php echo home_url('/resources/'); ?>" class="text-decoration-none">Resource Library</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Comprehensive guides, templates, and educational materials for valuation and finance.
                                    </p>
                                    <div class="resources small">
                                        <div><i class="fas fa-file-pdf me-1"></i> Valuation guides</div>
                                        <div><i class="fas fa-file-excel me-1"></i> Financial templates</div>
                                        <div><i class="fas fa-graduation-cap me-1"></i> Educational content</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-lightbulb text-primary me-2"></i>
                                        <a href="<?php echo home_url('/insights/'); ?>" class="text-decoration-none">Insights & Articles</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Expert insights, market trends, and practical advice for startups and investors.
                                    </p>
                                    <div class="content small">
                                        <div><i class="fas fa-newspaper me-1"></i> Market insights</div>
                                        <div><i class="fas fa-chart-trending-up me-1"></i> Industry trends</div>
                                        <div><i class="fas fa-comments me-1"></i> Expert opinions</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support & Information -->
                <div class="sitemap-section mb-5">
                    <h2 class="h4 text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-support me-3"></i>Support & Information
                    </h2>
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-question-circle text-primary me-2"></i>
                                        <a href="<?php echo home_url('/faq/'); ?>" class="text-decoration-none">FAQ</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Frequently asked questions about our services, processes, and pricing.
                                    </p>
                                    <div class="topics small">
                                        <div><i class="fas fa-gavel me-1"></i> 409A Valuations</div>
                                        <div><i class="fas fa-clock me-1"></i> Process & Timeline</div>
                                        <div><i class="fas fa-dollar-sign me-1"></i> Pricing & Billing</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <a href="<?php echo home_url('/contact/'); ?>" class="text-decoration-none">Contact Us</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Get in touch with our team for consultations, quotes, or general inquiries.
                                    </p>
                                    <div class="contact-methods small">
                                        <div><i class="fas fa-phone me-1"></i> Phone: +972-50-6842937</div>
                                        <div><i class="fas fa-envelope me-1"></i> Email contact form</div>
                                        <div><i class="fab fa-whatsapp me-1"></i> WhatsApp chat</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-sitemap text-primary me-2"></i>
                                        <a href="<?php echo home_url('/sitemap/'); ?>" class="text-decoration-none">Site Map</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Complete directory of all pages and sections on our website.
                                    </p>
                                    <div class="navigation small">
                                        <div><i class="fas fa-list me-1"></i> All pages listed</div>
                                        <div><i class="fas fa-search me-1"></i> Search functionality</div>
                                        <div><i class="fas fa-map me-1"></i> Site navigation</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legal & Compliance -->
                <div class="sitemap-section mb-5">
                    <h2 class="h4 text-primary mb-4 d-flex align-items-center">
                        <i class="fas fa-balance-scale me-3"></i>Legal & Compliance
                    </h2>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-shield-alt text-primary me-2"></i>
                                        <a href="<?php echo home_url('/privacy-policy/'); ?>" class="text-decoration-none">Privacy Policy</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        How we collect, use, and protect your personal and business information.
                                    </p>
                                    <div class="details small">
                                        <div><i class="fas fa-lock me-1"></i> Data protection</div>
                                        <div><i class="fas fa-user-shield me-1"></i> Privacy rights</div>
                                        <div><i class="fas fa-cookie-bite me-1"></i> Cookie policy</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="sitemap-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-file-contract text-primary me-2"></i>
                                        <a href="<?php echo home_url('/terms-of-service/'); ?>" class="text-decoration-none">Terms of Service</a>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        Legal terms governing the use of our website and professional services.
                                    </p>
                                    <div class="details small">
                                        <div><i class="fas fa-gavel me-1"></i> Service terms</div>
                                        <div><i class="fas fa-handshake me-1"></i> Client obligations</div>
                                        <div><i class="fas fa-exclamation-triangle me-1"></i> Liability limits</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions bg-primary bg-opacity-10 p-4 rounded">
                    <h5 class="text-primary mb-3">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="javascript:void(0)" onclick="return openCalendly();" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="tel:+972-50-6842937" class="btn btn-outline-primary w-100">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-calculator me-2"></i>Use Calculators
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?php echo home_url('/faq/'); ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-question-circle me-2"></i>View FAQ
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
// Sitemap search functionality
document.getElementById('sitemap-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.sitemap-card');

    cards.forEach(card => {
        const title = card.querySelector('h5 a').textContent.toLowerCase();
        const description = card.querySelector('p').textContent.toLowerCase();
        const features = card.querySelector('.features, .tools, .resources, .content, .topics, .contact-methods, .navigation, .details');
        const featuresText = features ? features.textContent.toLowerCase() : '';

        if (title.includes(searchTerm) || description.includes(searchTerm) || featuresText.includes(searchTerm)) {
            card.closest('.col-lg-4, .col-lg-6').style.display = 'block';
        } else {
            card.closest('.col-lg-4, .col-lg-6').style.display = searchTerm === '' ? 'block' : 'none';
        }
    });
});

// Track sitemap interactions
document.querySelectorAll('.sitemap-card a').forEach(link => {
    link.addEventListener('click', function() {
        const pageName = this.textContent.trim();

        if (typeof gtag !== 'undefined') {
            gtag('event', 'sitemap_navigation', {
                'page_name': pageName,
                'link_url': this.href
            });
        }
    });
});

// Track search usage
document.getElementById('sitemap-search').addEventListener('input', function() {
    if (this.value.length >= 3) {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'sitemap_search', {
                'search_term': this.value
            });
        }
    }
});
</script>

<style>
.search-box {
    max-width: 400px;
}

.sitemap-card {
    transition: all 0.3s ease;
}

.sitemap-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.sitemap-section h2 {
    border-bottom: 2px solid var(--color-maroon);
    padding-bottom: 0.5rem;
}

.features div,
.tools div,
.resources div,
.content div,
.topics div,
.contact-methods div,
.navigation div,
.details div {
    margin-bottom: 0.25rem;
}

@media (max-width: 768px) {
    .quick-actions .row {
        --bs-gutter-x: 0.5rem;
    }

    .quick-actions .btn {
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }
}
</style>

<?php get_footer(); ?>