<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 120px 0 80px; position: relative;">
    <!-- Subtle background pattern -->
    <div class="hero-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23B91C1C" fill-opacity="0.1"><circle cx="7" cy="7" r="1"/><circle cx="53" cy="53" r="1"/><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-4 animate-on-scroll text-dark">
                        Expert Financial Advisory for
                        <span class="text-primary">Strategic Growth</span>
                    </h1>

                    <p class="lead mb-4 animate-on-scroll text-secondary">
                        Bridgeland Advisors provides comprehensive business valuation, capital advisory,
                        and financial modeling services to help companies navigate complex financial decisions
                        with confidence and precision.
                    </p>

                    <div class="hero-actions mb-5 animate-on-scroll">
                        <a href="#contact" class="btn btn-primary btn-lg me-3 mb-2 shadow">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Schedule Consultation
                        </a>
                        <a href="#services" class="btn btn-outline-primary btn-lg mb-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            Explore Services
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual animate-on-scroll">
                    <div class="dashboard-mockup bg-white rounded-4 shadow-lg p-4 border border-light">
                        <div class="dashboard-header d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-chart-line text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-dark fw-semibold">Valuation Dashboard</h5>
                                <small class="text-muted">Real-time analysis</small>
                            </div>
                        </div>

                        <div class="dashboard-chart mb-4">
                            <div class="d-flex align-items-end justify-content-around" style="height: 120px; padding: 0 10px;">
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 45px; width: 18px;"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 65px; width: 18px;"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 35px; width: 18px;"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 85px; width: 18px;"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 55px; width: 18px;"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm" style="height: 75px; width: 18px;"></div>
                            </div>
                            <p class="text-center text-muted small mb-0 mt-2">Company Valuation Trend</p>
                        </div>

                        <div class="dashboard-metrics row g-3">
                            <div class="col-6">
                                <div class="metric-item bg-light rounded p-3">
                                    <div class="small text-muted mb-1">Current Valuation</div>
                                    <div class="h4 text-primary mb-0 fw-bold">$12.5M</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="metric-item bg-light rounded p-3">
                                    <div class="small text-muted mb-1">Growth Rate</div>
                                    <div class="h4 text-success mb-0 fw-bold">+24.3%</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            <small class="text-muted">Interactive financial modeling & analysis</small>
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

<!-- Stats Counter Section -->
<section class="stats-counter-section py-5" style="background: linear-gradient(135deg, #8B0000 0%, #660000 100%);">
    <div class="container">
        <div class="row text-center text-white mb-4">
            <div class="col-12">
                <h2 class="display-6 fw-bold mb-3" style="font-family: 'Source Serif Pro', serif;">
                    Our Track Record
                </h2>
                <p class="lead mb-0" style="font-family: 'Inter', sans-serif;">
                    Delivering exceptional results for companies worldwide
                </p>
            </div>
        </div>

        <div class="row text-center text-white">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-box p-4 rounded-4 bg-white bg-opacity-10 h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-file-contract fa-2x text-white opacity-75"></i>
                    </div>
                    <div class="stat-number display-3 fw-bold mb-2">
                        <span data-count="500" class="counter">500</span>+
                    </div>
                    <h4 class="stat-label h5 mb-2">Valuations Completed</h4>
                    <p class="small opacity-75 mb-0">Professional 409A and business valuations delivered</p>
                </div>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-box p-4 rounded-4 bg-white bg-opacity-10 h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-line fa-2x text-white opacity-75"></i>
                    </div>
                    <div class="stat-number display-3 fw-bold mb-2">
                        $<span data-count="2" class="counter">2</span>B+
                    </div>
                    <h4 class="stat-label h5 mb-2">Assets Valued</h4>
                    <p class="small opacity-75 mb-0">Total enterprise value analyzed and assessed</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-box p-4 rounded-4 bg-white bg-opacity-10 h-100">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-award fa-2x text-white opacity-75"></i>
                    </div>
                    <div class="stat-number display-3 fw-bold mb-2">
                        <span data-count="15" class="counter">15</span>+
                    </div>
                    <h4 class="stat-label h5 mb-2">Years Experience</h4>
                    <p class="small opacity-75 mb-0">Investment banking and financial advisory expertise</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="trusted-by-section py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="h5 text-muted fw-semibold mb-4" style="font-family: 'Inter', sans-serif; letter-spacing: 0.5px;">TRUSTED BY LEADING COMPANIES</h3>
        </div>

        <div class="logos-carousel">
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">TechCorp</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">StartupX</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">InnovateLab</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">GrowthCo</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">VentureStudio</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="logo-item text-center p-3">
                        <div class="bg-light rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                            <div class="text-muted fw-bold" style="font-size: 14px;">NextGen</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="small text-muted mb-0">
                <i class="fas fa-check-circle text-success me-2"></i>
                500+ successful valuations completed for companies at all stages
            </p>
        </div>
    </div>
</section>

<!-- Process Section - Compact Accordion -->
<section class="process-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Our Proven Process</h2>
            <p class="section-subtitle lead text-muted mx-auto" style="max-width: 600px;">
                A systematic 8-step approach ensuring accuracy, transparency, and 14-day turnaround guarantee.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="processAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#process1" aria-expanded="false">
                                <span class="badge bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 14px;">1</span>
                                <strong>Initial Consultation & Engagement</strong>
                            </button>
                        </h2>
                        <div id="process1" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Initial Consultation</h6>
                                        <p class="text-muted mb-3">Understanding your business, valuation requirements, and specific objectives.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Engagement Letter</h6>
                                        <p class="text-muted mb-0">Formal agreement outlining scope, timeline, and deliverables for transparency.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#process2" aria-expanded="false">
                                <span class="badge bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 14px;">2</span>
                                <strong>Project Setup & Research</strong>
                            </button>
                        </h2>
                        <div id="process2" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Kick-off Meeting</h6>
                                        <p class="text-muted mb-3">Detailed discussion of methodology, data requirements, and project timeline.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Background Research</h6>
                                        <p class="text-muted mb-0">Comprehensive market analysis, industry research, and competitive landscape study.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#process3" aria-expanded="false">
                                <span class="badge bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 14px;">3</span>
                                <strong>Analysis & Modeling</strong>
                            </button>
                        </h2>
                        <div id="process3" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Financial Modeling</h6>
                                        <p class="text-muted mb-3">Development of sophisticated financial models using AICPA and IPEV guidelines.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Draft Report</h6>
                                        <p class="text-muted mb-0">Preparation of comprehensive draft report with detailed analysis and findings.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#process4" aria-expanded="false">
                                <span class="badge bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 14px;">4</span>
                                <strong>Review & Final Delivery</strong>
                            </button>
                        </h2>
                        <div id="process4" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Management Review</h6>
                                        <p class="text-muted mb-3">Client review and feedback incorporation to ensure accuracy and completeness.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Final Delivery</h6>
                                        <p class="text-muted mb-0">Final report and certificate delivery with ongoing support and audit defense.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="bg-white rounded p-3 shadow-sm">
                                <i class="fas fa-clock text-primary mb-2"></i>
                                <div class="fw-semibold">14 Days</div>
                                <small class="text-muted">Turnaround Time</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-white rounded p-3 shadow-sm">
                                <i class="fas fa-shield-alt text-primary mb-2"></i>
                                <div class="fw-semibold">Audit Defense</div>
                                <small class="text-muted">Included</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-white rounded p-3 shadow-sm">
                                <i class="fas fa-certificate text-primary mb-2"></i>
                                <div class="fw-semibold">IRS Compliant</div>
                                <small class="text-muted">Certified</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5 bg-gradient" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3" style="font-family: 'Source Serif Pro', serif;">Client Success Stories</h2>
            <p class="section-subtitle lead text-muted" style="font-family: 'Inter', sans-serif;">
                Trusted by startups and growth companies worldwide
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-5 animate-on-scroll">
                <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 h-100 position-relative overflow-hidden">
                    <!-- Quote decoration -->
                    <div class="position-absolute top-0 start-0 p-4 opacity-10">
                        <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>

                    <div class="card-body p-5 position-relative">
                        <div class="mb-4">
                            <div class="text-warning mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>

                        <blockquote class="mb-4">
                            <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.1rem; line-height: 1.6; font-style: italic;">
                                "I highly recommend Bridgeland Advisors for their exceptional service in constructing a 409A valuation for our company. They demonstrated utmost professionalism and efficiency throughout the process."
                            </p>
                        </blockquote>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">Boaz Fraoman</div>
                                <small class="text-muted" style="font-family: 'Inter', sans-serif;">Startup Founder</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 animate-on-scroll">
                <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 h-100 position-relative overflow-hidden">
                    <!-- Quote decoration -->
                    <div class="position-absolute top-0 start-0 p-4 opacity-10">
                        <i class="fas fa-quote-left fa-3x text-primary"></i>
                    </div>

                    <div class="card-body p-5 position-relative">
                        <div class="mb-4">
                            <div class="text-warning mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>

                        <blockquote class="mb-4">
                            <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.1rem; line-height: 1.6; font-style: italic;">
                                "An absolute gem! Eran is a true expert in the field of VC finance and cap tables. He is an excellent communicator and an outstanding teacher."
                            </p>
                        </blockquote>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">David Cooper</div>
                                <small class="text-muted" style="font-family: 'Inter', sans-serif;">Investment Professional</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust indicators -->
        <div class="row mt-5 justify-content-center text-center">
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-sm p-4">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-award fa-2x"></i>
                            </div>
                            <div class="fw-semibold" style="font-family: 'Inter', sans-serif;">4.9/5 Rating</div>
                            <small class="text-muted">Client Satisfaction</small>
                        </div>
                        <div class="col-md-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-shield-check fa-2x"></i>
                            </div>
                            <div class="fw-semibold" style="font-family: 'Inter', sans-serif;">100% Compliant</div>
                            <small class="text-muted">IRS Standards</small>
                        </div>
                        <div class="col-md-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div class="fw-semibold" style="font-family: 'Inter', sans-serif;">14 Days</div>
                            <small class="text-muted">Average Delivery</small>
                        </div>
                        <div class="col-md-3">
                            <div class="text-primary mb-2">
                                <i class="fas fa-handshake fa-2x"></i>
                            </div>
                            <div class="fw-semibold" style="font-family: 'Inter', sans-serif;">Audit Defense</div>
                            <small class="text-muted">Included</small>
                        </div>
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

/* Stats Counter Section */
.stats-counter-section .stat-box {
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.stats-counter-section .stat-box:hover {
    transform: translateY(-5px);
    background-color: rgba(255, 255, 255, 0.15) !important;
    border-color: rgba(255, 255, 255, 0.3);
}

.stats-counter-section .counter {
    display: inline-block;
    min-width: 60px;
}

@media (max-width: 768px) {
    .stats-counter-section .stat-number {
        font-size: 2.5rem !important;
    }
}

</style>

<script>
// Counter Animation Script
document.addEventListener('DOMContentLoaded', function() {
    const counterElements = document.querySelectorAll('.counter[data-count]');
    let hasAnimated = false;

    // Animation function
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const start = performance.now();

        function updateCounter(currentTime) {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);

            const currentValue = Math.floor(progress * target);
            element.textContent = currentValue;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        }

        requestAnimationFrame(updateCounter);
    }

    // Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;

                // Reset all counters to 0 first
                counterElements.forEach(counter => {
                    counter.textContent = '0';
                });

                // Start animations with staggered delay
                counterElements.forEach((counter, index) => {
                    setTimeout(() => {
                        animateCounter(counter);
                    }, index * 200); // 200ms delay between each counter
                });
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe the stats section
    const statsSection = document.querySelector('.stats-counter-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
});
</script>

<?php get_footer(); ?>