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
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 45px; width: 18px;" data-delay="0"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 65px; width: 18px;" data-delay="200"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 35px; width: 18px;" data-delay="400"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 85px; width: 18px;" data-delay="600"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 55px; width: 18px;" data-delay="800"></div>
                                <div class="chart-bar bg-primary rounded-top shadow-sm animate-bar" style="--bar-height: 75px; width: 18px;" data-delay="1000"></div>
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
                                <i class="fas fa-balance-scale text-primary fa-lg"></i>
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
                                <i class="fas fa-chart-area text-primary fa-lg"></i>
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
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-6 fw-bold mb-3 text-white" style="font-family: 'Source Serif Pro', serif;">
                    Our Track Record
                </h2>
                <p class="lead mb-0 text-white opacity-75" style="font-family: 'Inter', sans-serif;">
                    Delivering exceptional results for companies worldwide
                </p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-item animate-on-scroll" data-delay="0">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-file-contract fa-3x text-white mb-3"></i>
                    </div>
                    <div class="stat-number display-2 fw-bold text-white mb-2">
                        <span data-count="200" class="counter">0</span>+
                    </div>
                    <h4 class="stat-label h4 mb-2 text-white">Valuations Completed</h4>
                    <p class="text-white opacity-75 mb-0">Professional 409A and business valuations delivered</p>
                </div>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-item animate-on-scroll" data-delay="200">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-chart-line fa-3x text-white mb-3"></i>
                    </div>
                    <div class="stat-number display-2 fw-bold text-white mb-2">
                        $<span data-count="2" class="counter">0</span>B+
                    </div>
                    <h4 class="stat-label h4 mb-2 text-white">Assets Valued</h4>
                    <p class="text-white opacity-75 mb-0">Total enterprise value analyzed and assessed</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-item animate-on-scroll" data-delay="400">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-award fa-3x text-white mb-3"></i>
                    </div>
                    <div class="stat-number display-2 fw-bold text-white mb-2">
                        <span data-count="15" class="counter">0</span>+
                    </div>
                    <h4 class="stat-label h4 mb-2 text-white">Years Experience</h4>
                    <p class="text-white opacity-75 mb-0">Investment banking and financial advisory expertise</p>
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
                <i class="fas fa-check-circle me-2" style="color: var(--color-secondary-dark);"></i>
                200+ successful valuations completed for companies at all stages
            </p>
        </div>
    </div>
</section>

<!-- Process Section - Visual Timeline -->
<section class="process-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Our Proven Process</h2>
            <p class="section-subtitle lead text-muted mx-auto" style="max-width: 600px;">
                A systematic 4-step approach ensuring accuracy, transparency, and 14-day turnaround guarantee.
            </p>
        </div>

        <!-- Timeline Process Flow -->
        <div class="process-timeline mb-5">
            <div class="row">
                <!-- Step 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                1
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-handshake fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h5 fw-bold mb-3">Initial Consultation</h4>
                        <p class="step-description text-muted">Understanding your business, requirements, and objectives. Formal engagement letter outlining scope and timeline.</p>
                        <div class="step-duration small text-primary fw-semibold">Day 1-2</div>
                    </div>
                </div>

                <!-- Connection Line -->
                <div class="d-none d-lg-block col-lg-1">
                    <div class="process-connector d-flex align-items-center justify-content-center h-100">
                        <div class="connector-line bg-primary" style="width: 3px; height: 60px; border-radius: 2px;"></div>
                        <i class="fas fa-arrow-right text-primary position-absolute"></i>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                2
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-search fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h5 fw-bold mb-3">Research & Setup</h4>
                        <p class="step-description text-muted">Comprehensive market analysis, industry research, and kick-off meeting to discuss methodology and data requirements.</p>
                        <div class="step-duration small text-primary fw-semibold">Day 3-5</div>
                    </div>
                </div>

                <!-- Connection Line -->
                <div class="d-none d-lg-block col-lg-1">
                    <div class="process-connector d-flex align-items-center justify-content-center h-100">
                        <div class="connector-line bg-primary" style="width: 3px; height: 60px; border-radius: 2px;"></div>
                        <i class="fas fa-arrow-right text-primary position-absolute"></i>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                3
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-calculator fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h5 fw-bold mb-3">Analysis & Modeling</h4>
                        <p class="step-description text-muted">Development of sophisticated financial models using AICPA and IPEV guidelines. Preparation of comprehensive draft report.</p>
                        <div class="step-duration small text-primary fw-semibold">Day 6-12</div>
                    </div>
                </div>

                <!-- Connection Line -->
                <div class="d-none d-lg-block col-lg-1">
                    <div class="process-connector d-flex align-items-center justify-content-center h-100">
                        <div class="connector-line bg-primary" style="width: 3px; height: 60px; border-radius: 2px;"></div>
                        <i class="fas fa-arrow-right text-primary position-absolute"></i>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                4
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-check-circle fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h5 fw-bold mb-3">Review & Delivery</h4>
                        <p class="step-description text-muted">Client review and feedback incorporation. Final report and certificate delivery with ongoing support and audit defense.</p>
                        <div class="step-duration small text-primary fw-semibold">Day 13-14</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Process Guarantees -->
        <div class="text-center">
            <div class="row g-4 justify-content-center">
                <div class="col-md-3">
                    <div class="guarantee-item bg-white rounded-4 p-4 shadow-sm h-100">
                        <i class="fas fa-clock fa-2x text-primary mb-3"></i>
                        <div class="fw-bold h5 mb-2">14 Days</div>
                        <small class="text-muted">Guaranteed Turnaround</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guarantee-item bg-white rounded-4 p-4 shadow-sm h-100">
                        <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                        <div class="fw-bold h5 mb-2">Audit Defense</div>
                        <small class="text-muted">Included Support</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guarantee-item bg-white rounded-4 p-4 shadow-sm h-100">
                        <i class="fas fa-certificate fa-2x text-primary mb-3"></i>
                        <div class="fw-bold h5 mb-2">IRS Compliant</div>
                        <small class="text-muted">Certified Methodology</small>
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
            <!-- Maya Cohen Testimonial -->
            <div class="col-lg-4 animate-on-scroll">
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
                                "Collaborating with Eran was effortless. The professionalism and streamlined process made it an outstanding experience. They really paid attention to what I needed and nailed it. Communication was clear and timely, which made the entire project run smoothly. I'd totally recommend Eran and the team for their awesome service and dedication."
                            </p>
                        </blockquote>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">Maya Cohen</div>
                                <small class="text-muted" style="font-family: 'Inter', sans-serif;">CEO, Montopay</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Josh Harro Testimonial -->
            <div class="col-lg-4 animate-on-scroll">
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
                                "Eran provided us with a 409A valuation, and I can't say enough about what a pleasure it was to work with him. He was extremely professional, and the work together was seamless. Eran exceeded our expectations and delivered the final report well within the time frame that we agree upon. I certainly expect us to continue collaborating with him going forward."
                            </p>
                        </blockquote>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">Josh Harro</div>
                                <small class="text-muted" style="font-family: 'Inter', sans-serif;">Director of Operations, Itur Intelligence</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uriel Herman Testimonial -->
            <div class="col-lg-4 animate-on-scroll">
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
                                "Half a Superman! Eran is a real expert in the field of strategic partnerships, VC, finance and investment processes. He brings years of legal & finance experience to the table, which is crucial for any company seeking accurate valuation in a cost-effective and accurate way. If you're looking for a strategic advisor, Eran is your man."
                            </p>
                        </blockquote>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">Uriel Herman</div>
                                <small class="text-muted" style="font-family: 'Inter', sans-serif;">CEO, Extreme Simulations</small>
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

/* Enhanced Dashboard Animation */
.chart-bar.animate-bar {
    height: 0;
    animation: growBar 1s ease-out forwards;
    transform-origin: bottom;
}

@keyframes growBar {
    from {
        height: 0;
        opacity: 0.5;
    }
    to {
        height: var(--bar-height);
        opacity: 1;
    }
}

.dashboard-mockup {
    animation: dashboardFloat 6s ease-in-out infinite;
    transform-origin: center;
}

@keyframes dashboardFloat {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-10px) scale(1.02);
    }
}

.dashboard-mockup:hover .chart-bar {
    transform: scaleY(1.1);
    transition: transform 0.3s ease;
}

.metric-item {
    transition: all 0.3s ease;
}

.metric-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
// Enhanced Counter Animation Script
document.addEventListener('DOMContentLoaded', function() {
    const counterElements = document.querySelectorAll('.counter[data-count]');
    let hasAnimated = false;

    // Dashboard Chart Animation
    const chartBars = document.querySelectorAll('.chart-bar.animate-bar');
    chartBars.forEach(bar => {
        const delay = parseInt(bar.getAttribute('data-delay')) || 0;
        setTimeout(() => {
            bar.style.animationDelay = delay + 'ms';
            bar.classList.add('animate');
        }, 500); // Start after page load
    });

    function animateCounter(element, delay = 0) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds for smooth animation

        setTimeout(() => {
            let start = null;

            function updateCounter(timestamp) {
                if (!start) start = timestamp;
                const elapsed = timestamp - start;
                const progress = Math.min(elapsed / duration, 1);

                // Smooth easing function
                const easeProgress = 1 - Math.pow(1 - progress, 2);
                const currentValue = Math.floor(easeProgress * target);

                element.textContent = currentValue;

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            }

            requestAnimationFrame(updateCounter);
        }, delay);
    }

    // Intersection Observer for scroll trigger
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;

                // Start all counters with staggered delays
                counterElements.forEach((counter, index) => {
                    animateCounter(counter, index * 200);
                });
            }
        });
    }, {
        threshold: 0.5, // Trigger when 50% visible
        rootMargin: '0px 0px 0px 0px' // No early triggering
    });

    // Observe the stats section
    const statsSection = document.querySelector('.stats-counter-section');
    if (statsSection) {
        console.log('Observing stats section'); // Debug log
        observer.observe(statsSection);
    } else {
        console.log('Stats section not found'); // Debug log
    }

    // Fallback: Start animation after 3 seconds if not triggered by scroll
    setTimeout(() => {
        if (!hasAnimated) {
            console.log('Fallback: Starting counter animations'); // Debug log
            counterElements.forEach((counter, index) => {
                setTimeout(() => {
                    animateCounter(counter);
                }, index * 300);
            });
            hasAnimated = true;
        }
    }, 3000);
});
</script>

<?php get_footer(); ?>