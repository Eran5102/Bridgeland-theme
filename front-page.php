<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%); padding: 120px 0 80px;">
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <div class="hero-content text-white">
                    <h1 class="display-4 fw-bold mb-4 animate-on-scroll">
                        Expert Financial Advisory for
                        <span class="text-warning">Strategic Growth</span>
                    </h1>

                    <p class="lead mb-4 animate-on-scroll">
                        Bridgeland Advisors provides comprehensive business valuation, capital advisory,
                        and financial modeling services to help companies navigate complex financial decisions
                        with confidence and precision.
                    </p>

                    <div class="hero-actions mb-5 animate-on-scroll">
                        <a href="#contact" class="btn btn-white btn-large me-3 mb-2">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Schedule Consultation
                        </a>
                        <a href="#services" class="btn btn-outline btn-large mb-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            Explore Services
                        </a>
                    </div>

                    <div class="hero-stats row g-4 animate-on-scroll">
                        <div class="col-md-4">
                            <div class="stat-item text-center">
                                <div class="stat-number h2 mb-1 counter" data-count="500">0</div>
                                <div class="stat-label small">Valuations Completed</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item text-center">
                                <div class="stat-number h2 mb-1">$2B+</div>
                                <div class="stat-label small">Assets Valued</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item text-center">
                                <div class="stat-number h2 mb-1">15+</div>
                                <div class="stat-label small">Years Experience</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual animate-on-scroll">
                    <div class="dashboard-mockup bg-white rounded-3 shadow-xl p-4">
                        <div class="dashboard-header d-flex align-items-center mb-3">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            <h5 class="mb-0 text-dark">Valuation Dashboard</h5>
                        </div>

                        <div class="dashboard-chart mb-4">
                            <div class="d-flex align-items-end justify-content-around" style="height: 120px;">
                                <div class="chart-bar bg-primary rounded-top" style="height: 40px; width: 15px;"></div>
                                <div class="chart-bar bg-primary rounded-top" style="height: 60px; width: 15px;"></div>
                                <div class="chart-bar bg-primary rounded-top" style="height: 30px; width: 15px;"></div>
                                <div class="chart-bar bg-primary rounded-top" style="height: 80px; width: 15px;"></div>
                                <div class="chart-bar bg-primary rounded-top" style="height: 50px; width: 15px;"></div>
                                <div class="chart-bar bg-primary rounded-top" style="height: 70px; width: 15px;"></div>
                            </div>
                            <p class="text-center text-muted small mb-0">Company Valuation Trend</p>
                        </div>

                        <div class="dashboard-metrics row g-3">
                            <div class="col-6">
                                <div class="metric-item">
                                    <div class="small text-muted">Current Valuation</div>
                                    <div class="h4 text-primary mb-0">$12.5M</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric-item">
                                    <div class="small text-muted">Growth Rate</div>
                                    <div class="h4 text-success mb-0">+24.3%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Comprehensive Financial Advisory Services</h2>
            <p class="section-subtitle lead text-muted mx-auto" style="max-width: 600px;">
                From business valuation to capital advisory, we provide the expertise
                and insights you need to make informed financial decisions.
            </p>
        </div>

        <div class="row g-4">
            <!-- 409A Valuation -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-gavel text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">409A Valuation</h3>
                        <p class="service-description text-muted mb-3">
                            IRS-compliant equity valuations for stock option programs and financial reporting with 14-day turnaround guarantee.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$2,500 - $7,500</span>
                            <span><i class="fas fa-clock me-1"></i>1-2 weeks</span>
                        </div>
                        <a href="<?php echo home_url('/409a-valuation/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Company Valuation -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-building text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">Company Valuation</h3>
                        <p class="service-description text-muted mb-3">
                            Comprehensive business valuations for M&A, investment, and strategic planning using industry best practices.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$5,000 - $15,000</span>
                            <span><i class="fas fa-clock me-1"></i>2-4 weeks</span>
                        </div>
                        <a href="<?php echo home_url('/company-valuation/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Exit Waterfall Analysis -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-water text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">Exit Waterfall Analysis</h3>
                        <p class="service-description text-muted mb-3">
                            Detailed analysis of liquidation preferences and exit distribution scenarios for better decision making.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$1,500 - $5,000</span>
                            <span><i class="fas fa-clock me-1"></i>1-2 weeks</span>
                        </div>
                        <a href="<?php echo home_url('/waterfall-analysis/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Financial Models -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-calculator text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">Financial Models</h3>
                        <p class="service-description text-muted mb-3">
                            Custom financial models for fundraising, planning, and investment analysis with interactive calculators.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$2,000 - $10,000</span>
                            <span><i class="fas fa-clock me-1"></i>2-3 weeks</span>
                        </div>
                        <a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fundraising Strategy -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-handshake text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">Capital Raising Advisory</h3>
                        <p class="service-description text-muted mb-3">
                            Strategic advisory for capital raises and investor engagement with 15+ years of experience.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$3,000 - $12,000</span>
                            <span><i class="fas fa-clock me-1"></i>3-6 weeks</span>
                        </div>
                        <a href="<?php echo home_url('/capital-raising/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Term Sheet Review -->
            <div class="col-lg-4 col-md-6 animate-on-scroll">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-file-contract text-primary fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="service-title h5 mb-3 text-center">Term Sheet Negotiation</h3>
                        <p class="service-description text-muted mb-3">
                            Expert analysis and negotiation support for investment terms with comprehensive market knowledge.
                        </p>
                        <div class="service-meta d-flex justify-content-between text-small text-muted mb-3">
                            <span><i class="fas fa-dollar-sign me-1"></i>$1,000 - $4,000</span>
                            <span><i class="fas fa-clock me-1"></i>1 week</span>
                        </div>
                        <a href="<?php echo home_url('/term-sheet-negotiation/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Our Proven 8-Step Process</h2>
            <p class="section-subtitle lead text-muted mx-auto" style="max-width: 600px;">
                A systematic approach that ensures accuracy, transparency, and actionable insights
                for every engagement with 14-day turnaround guarantee.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">1</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Initial Consultation</h4>
                    <p class="step-description text-muted">
                        Understanding your business, valuation requirements, and specific objectives.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">2</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Engagement Letter</h4>
                    <p class="step-description text-muted">
                        Formal agreement outlining scope, timeline, and deliverables for transparency.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">3</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Kick-off Meeting</h4>
                    <p class="step-description text-muted">
                        Detailed discussion of methodology, data requirements, and project timeline.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">4</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Background Research</h4>
                    <p class="step-description text-muted">
                        Comprehensive market analysis, industry research, and competitive landscape study.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">5</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Financial Modeling</h4>
                    <p class="step-description text-muted">
                        Development of sophisticated financial models using AICPA and IPEV guidelines.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">6</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Draft Report</h4>
                    <p class="step-description text-muted">
                        Preparation of comprehensive draft report with detailed analysis and findings.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">7</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Management Review</h4>
                    <p class="step-description text-muted">
                        Client review and feedback incorporation to ensure accuracy and completeness.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 animate-on-scroll">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fw-bold">8</span>
                    </div>
                    <h4 class="step-title h5 mb-3">Final Delivery</h4>
                    <p class="step-description text-muted">
                        Final report and certificate delivery with ongoing support and audit defense.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">What Our Clients Say</h2>
            <p class="section-subtitle lead text-muted">
                Trusted by startups and growth companies worldwide
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6 animate-on-scroll">
                <div class="testimonial-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <blockquote class="blockquote mb-3">
                            <p class="mb-0">"I highly recommend Bridgeland Advisors for their exceptional service in constructing a 409A valuation for our company. They demonstrated utmost professionalism and efficiency throughout the process."</p>
                        </blockquote>
                        <footer class="blockquote-footer">
                            <strong>Boaz Fraoman</strong>, Startup Founder
                        </footer>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 animate-on-scroll">
                <div class="testimonial-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <blockquote class="blockquote mb-3">
                            <p class="mb-0">"An absolute gem! Eran is a true expert in the field of VC finance and cap tables. He is an excellent communicator and an outstanding teacher."</p>
                        </blockquote>
                        <footer class="blockquote-footer">
                            <strong>David Cooper</strong>, Investment Professional
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="contact" class="cta-section py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);">
    <div class="container">
        <div class="text-center text-white animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Ready to Get Started?</h2>
            <p class="section-subtitle lead mb-4 mx-auto" style="max-width: 600px;">
                Schedule a consultation to discuss your valuation and financial advisory needs.
                Our team is ready to provide the expertise and insights your business requires.
            </p>

            <div class="cta-actions d-flex gap-3 justify-content-center flex-wrap">
                <a href="tel:+972-50-6842937" class="btn btn-white btn-large">
                    <i class="fas fa-phone me-2"></i>
                    Call +972-50-6842937
                </a>
                <a href="mailto:eran@bridgeland-advisors.com" class="btn btn-outline btn-large">
                    <i class="fas fa-envelope me-2"></i>
                    Send Email
                </a>
                <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-outline btn-large">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Schedule Meeting
                </a>
            </div>

            <div class="mt-4">
                <p class="small mb-0 opacity-75">
                    <i class="fas fa-clock me-2"></i>
                    Typical response time: Within 2 hours during business hours
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Front Page Specific Styles -->
<style>
/* All content should be visible immediately */
.animate-on-scroll {
    opacity: 1 !important;
    transform: translateY(0) !important;
    transition: all 0.6s ease;
}

.animate-fade-in {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* Hero section enhancements */
.hero-section .chart-bar {
    animation: growBar 2s ease-in-out;
}

@keyframes growBar {
    0% { height: 10px; }
    100% { height: var(--final-height, 60px); }
}

/* Service card hover effects */
.service-card {
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

/* Process step hover effects */
.process-step .step-number {
    transition: all 0.3s ease;
}

.process-step:hover .step-number {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(139, 26, 26, 0.3);
}

/* Navbar scroll effect */
.navbar-scrolled {
    background-color: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .hero-stats .stat-item {
        margin-bottom: 1rem;
    }

    .cta-actions {
        flex-direction: column;
        align-items: center;
    }

    .btn-large {
        width: 100%;
        max-width: 300px;
    }

    .hero-section {
        padding: 60px 0 40px !important;
    }

    .dashboard-mockup {
        margin-top: 2rem;
    }
}

/* Force visibility for all sections */
section,
.hero-content,
.service-card,
.process-step,
.testimonial-card,
.cta-section * {
    opacity: 1 !important;
    visibility: visible !important;
}
</style>

<?php get_footer(); ?>