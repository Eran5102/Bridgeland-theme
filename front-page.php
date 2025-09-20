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
                        <a href="javascript:void(0)" onclick="return openCalendly();" class="btn btn-primary btn-lg me-3 mb-2 shadow">
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
                    <div class="advanced-dashboard bg-white rounded-4 shadow-lg p-4 border border-light position-relative overflow-hidden">
                        <!-- Dashboard Header with Live Status -->
                        <div class="dashboard-header d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-chart-line text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 text-dark fw-semibold">409A Valuation Dashboard</h5>
                                    <small class="text-muted">Live Analytics</small>
                                </div>
                            </div>
                            <div class="live-indicator d-flex align-items-center">
                                <div class="live-dot bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                <small class="text-success fw-semibold">LIVE</small>
                            </div>
                        </div>

                        <!-- Key Metrics Row -->
                        <div class="dashboard-metrics row g-2 mb-4">
                            <div class="col-4">
                                <div class="metric-card bg-gradient text-white rounded p-3 h-100" style="background: linear-gradient(135deg, #8B0000 0%, #660000 100%);">
                                    <div class="small opacity-75 mb-1">Enterprise Value</div>
                                    <div class="h5 mb-0 fw-bold animated-value" data-value="15.7">$0M</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="metric-card bg-success text-white rounded p-3 h-100">
                                    <div class="small opacity-75 mb-1">Growth Rate</div>
                                    <div class="h5 mb-0 fw-bold animated-value" data-value="34.2">+0%</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="metric-card bg-info text-white rounded p-3 h-100">
                                    <div class="small opacity-75 mb-1">Multiple</div>
                                    <div class="h5 mb-0 fw-bold animated-value" data-value="8.3">0x</div>
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Chart -->
                        <div class="dashboard-chart mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0 fw-semibold">Valuation Methodology</h6>
                                <small class="text-muted">DCF + Market Approach</small>
                            </div>
                            <div class="chart-container bg-light rounded p-3">
                                <div class="d-flex align-items-end justify-content-around" style="height: 100px;">
                                    <div class="chart-segment" style="height: 100%; width: 20%; position: relative;">
                                        <div class="chart-bar bg-primary rounded-top animated-chart-bar" style="--target-height: 60%; width: 100%; transition: height 2s ease;" data-delay="0"></div>
                                        <small class="chart-label text-center d-block mt-1">DCF</small>
                                    </div>
                                    <div class="chart-segment" style="height: 100%; width: 20%; position: relative;">
                                        <div class="chart-bar bg-success rounded-top animated-chart-bar" style="--target-height: 80%; width: 100%; transition: height 2s ease;" data-delay="300"></div>
                                        <small class="chart-label text-center d-block mt-1">Market</small>
                                    </div>
                                    <div class="chart-segment" style="height: 100%; width: 20%; position: relative;">
                                        <div class="chart-bar bg-warning rounded-top animated-chart-bar" style="--target-height: 45%; width: 100%; transition: height 2s ease;" data-delay="600"></div>
                                        <small class="chart-label text-center d-block mt-1">Asset</small>
                                    </div>
                                    <div class="chart-segment" style="height: 100%; width: 20%; position: relative;">
                                        <div class="chart-bar bg-info rounded-top animated-chart-bar" style="--target-height: 90%; width: 100%; transition: height 2s ease;" data-delay="900"></div>
                                        <small class="chart-label text-center d-block mt-1">Final</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Analysis Progress -->
                        <div class="analysis-progress mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <small class="fw-semibold">Analysis Progress</small>
                                <small class="text-primary fw-semibold animated-progress">0%</small>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary animated-progress-bar" style="width: 0%; transition: width 3s ease;"></div>
                            </div>
                        </div>

                        <!-- Status Indicators -->
                        <div class="status-indicators d-flex justify-content-between">
                            <div class="status-item text-center">
                                <div class="status-icon bg-success bg-opacity-10 rounded-circle p-2 mx-auto mb-1" style="width: 30px; height: 30px;">
                                    <i class="fas fa-check text-success small"></i>
                                </div>
                                <small class="text-muted">Data Validated</small>
                            </div>
                            <div class="status-item text-center">
                                <div class="status-icon bg-primary bg-opacity-10 rounded-circle p-2 mx-auto mb-1" style="width: 30px; height: 30px;">
                                    <i class="fas fa-sync fa-spin text-primary small"></i>
                                </div>
                                <small class="text-muted">Processing</small>
                            </div>
                            <div class="status-item text-center">
                                <div class="status-icon bg-warning bg-opacity-10 rounded-circle p-2 mx-auto mb-1" style="width: 30px; height: 30px;">
                                    <i class="fas fa-clock text-warning small"></i>
                                </div>
                                <small class="text-muted">Pending Review</small>
                            </div>
                        </div>
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
                            <span><i class="fas fa-dollar-sign me-1"></i>$1,750 - $6,750</span>
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

<!-- Enhanced Trusted By Section -->
<section class="trusted-by-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.03; background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23B91C1C" fill-opacity="0.1"><circle cx="7" cy="7" r="1"/><circle cx="53" cy="53" r="1"/><circle cx="30" cy="30" r="2"/></g></svg>');"></div>

    <div class="container position-relative">
        <div class="text-center mb-5">
            <div class="d-inline-block position-relative mb-3">
                <h2 class="display-6 fw-bold text-dark mb-2" style="font-family: 'Source Serif Pro', serif;">
                    Trusted by <span class="text-primary">Leading Companies</span>
                </h2>
                <div class="mx-auto" style="width: 100px; height: 3px; background: linear-gradient(90deg, var(--color-maroon) 0%, var(--color-gold) 100%); border-radius: 2px;"></div>
            </div>
            <p class="lead text-muted mb-4" style="max-width: 600px; margin: 0 auto; font-family: 'Inter', sans-serif;">
                Join 200+ successful companies who trust our expertise for their critical financial decisions
            </p>
        </div>

        <!-- Enhanced Two-Row Client Logos Carousel -->
        <div class="logos-carousel-container overflow-hidden position-relative">
            <!-- Top Row - 13 logos -->
            <div class="logos-row mb-3 overflow-hidden">
                <div class="logos-track d-flex align-items-center" style="animation: logoScrollTop 60s linear infinite; width: 200%;">
                    <!-- First set of 13 logos -->
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/extreme simulations.jpeg" alt="Extreme Simulations" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/monto.jpeg" alt="Montopay" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/itur_intelligence_logo.jpg" alt="Itur Intelligence" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/detectx_logo.jpg" alt="DetectX" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/datumate_logo.jpg" alt="Datumate" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/corbelpay_logo.jpg" alt="CorbelPay" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/genetika_logo.jpeg" alt="Genetika" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/getpackage_logo.jpg" alt="GetPackage" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/keyport.png" alt="Keyport" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lawflex_logo.jpeg" alt="LawFlex" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lightyx_logo.jpeg" alt="LightyX" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/omnistruct_logo.jpeg" alt="Omnistruct" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/canotera_logo.jpeg" alt="Canotera" class="client-logo">
                    </div>

                    <!-- Duplicate set for seamless loop -->
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/extreme simulations.jpeg" alt="Extreme Simulations" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/monto.jpeg" alt="Montopay" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/itur_intelligence_logo.jpg" alt="Itur Intelligence" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/detectx_logo.jpg" alt="DetectX" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/datumate_logo.jpg" alt="Datumate" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/corbelpay_logo.jpg" alt="CorbelPay" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/genetika_logo.jpeg" alt="Genetika" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/getpackage_logo.jpg" alt="GetPackage" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/keyport.png" alt="Keyport" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lawflex_logo.jpeg" alt="LawFlex" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lightyx_logo.jpeg" alt="LightyX" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/omnistruct_logo.jpeg" alt="Omnistruct" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/canotera_logo.jpeg" alt="Canotera" class="client-logo">
                    </div>
                </div>
            </div>

            <!-- Bottom Row - 12 logos (reverse direction for dynamic effect) -->
            <div class="logos-row overflow-hidden">
                <div class="logos-track d-flex align-items-center" style="animation: logoScrollBottom 55s linear infinite reverse; width: 200%;">
                    <!-- Remaining 12 logos -->
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/carevature_medical_ltd__logo.jpeg" alt="Carevature Medical" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/dolphinecare logo.jpeg" alt="Dolphine Care" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/globein_logo.jpeg" alt="GlobeIn" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/indieflow_logo.jpeg" alt="IndieFlow" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/libba_logo.jpeg" alt="Libba" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lotoo sheli.png" alt="Lotoo Sheli" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/moon_shot_ai_logo.jpeg" alt="Moon Shot AI" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/p3_media_inc_logo.jpeg" alt="P3 Media Inc" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/p3_media_nyc_logo.jpeg" alt="P3 Media NYC" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/reininsurtech_logo.jpeg" alt="Rein InsurTech" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/verticalfield_logo.jpeg" alt="VerticalField" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/Zoog.jpg" alt="Zoog" class="client-logo">
                    </div>

                    <!-- Duplicate set for seamless loop -->
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/carevature_medical_ltd__logo.jpeg" alt="Carevature Medical" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/dolphinecare logo.jpeg" alt="Dolphine Care" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/globein_logo.jpeg" alt="GlobeIn" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/indieflow_logo.jpeg" alt="IndieFlow" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/libba_logo.jpeg" alt="Libba" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/lotoo sheli.png" alt="Lotoo Sheli" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/moon_shot_ai_logo.jpeg" alt="Moon Shot AI" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/p3_media_inc_logo.jpeg" alt="P3 Media Inc" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/p3_media_nyc_logo.jpeg" alt="P3 Media NYC" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/reininsurtech_logo.jpeg" alt="Rein InsurTech" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/verticalfield_logo.jpeg" alt="VerticalField" class="client-logo">
                    </div>
                    <div class="logo-item flex-shrink-0 mx-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/logos/Zoog.jpg" alt="Zoog" class="client-logo">
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Statistics Section -->
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-lg p-4 border">
                    <div class="row g-4 text-center">
                        <div class="col-md-4">
                            <div class="stat-highlight p-3 rounded-3 h-100" style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.1) 0%, rgba(139, 0, 0, 0.05) 100%); border: 1px solid rgba(139, 0, 0, 0.1);">
                                <div class="mb-2">
                                    <i class="fas fa-chart-line fa-2x text-primary"></i>
                                </div>
                                <div class="fw-bold h4 text-primary mb-1">200+</div>
                                <div class="small text-muted fw-medium">Successful Valuations</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-highlight p-3 rounded-3 h-100" style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.05) 100%); border: 1px solid rgba(212, 175, 55, 0.2);">
                                <div class="mb-2">
                                    <i class="fas fa-award fa-2x" style="color: var(--color-gold);"></i>
                                </div>
                                <div class="fw-bold h4 mb-1" style="color: var(--color-gold);">15+ Years</div>
                                <div class="small text-muted fw-medium">Industry Experience</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-highlight p-3 rounded-3 h-100" style="background: linear-gradient(135deg, rgba(46, 125, 50, 0.1) 0%, rgba(46, 125, 50, 0.05) 100%); border: 1px solid rgba(46, 125, 50, 0.2);">
                                <div class="mb-2">
                                    <i class="fas fa-shield-alt fa-2x text-success"></i>
                                </div>
                                <div class="fw-bold h4 text-success mb-1">100%</div>
                                <div class="small text-muted fw-medium">IRS Compliant</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3 pt-3 border-top">
                        <p class="small text-muted mb-0">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            Trusted by startups to Fortune 500 companies across all industries
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section - Visual Timeline -->
<section class="process-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5 animate-on-scroll">
            <h2 class="section-title display-5 fw-bold mb-3">Our Proven Process</h2>
            <p class="section-subtitle lead text-muted mx-auto" style="max-width: 600px;">
                A comprehensive 8-step approach ensuring accuracy, transparency, and 14-day turnaround guarantee.
            </p>
        </div>

        <!-- 8-Step Process Flow -->
        <div class="process-timeline mb-5">
            <!-- First Row - Steps 1-4 -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                1
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-handshake fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Initial Consultation</h4>
                        <p class="step-description text-muted small">Understanding business objectives and valuation requirements</p>
                        <div class="step-duration small text-primary fw-semibold">Day 1</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                2
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-file-signature fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Engagement Letter</h4>
                        <p class="step-description text-muted small">Formal agreement outlining scope, timeline, and deliverables</p>
                        <div class="step-duration small text-primary fw-semibold">Day 1-2</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                3
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-database fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Data Collection</h4>
                        <p class="step-description text-muted small">Gathering financial statements, cap tables, and business documents</p>
                        <div class="step-duration small text-primary fw-semibold">Day 2-3</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                4
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-search fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Market Research</h4>
                        <p class="step-description text-muted small">Industry analysis and comparable company research</p>
                        <div class="step-duration small text-primary fw-semibold">Day 3-5</div>
                    </div>
                </div>
            </div>

            <!-- Second Row - Steps 5-8 -->
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                5
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-calculator fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Financial Modeling</h4>
                        <p class="step-description text-muted small">DCF analysis and valuation model development using AICPA guidelines</p>
                        <div class="step-duration small text-primary fw-semibold">Day 6-9</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                6
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-chart-bar fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Valuation Analysis</h4>
                        <p class="step-description text-muted small">Multiple methodology analysis and discount calculations</p>
                        <div class="step-duration small text-primary fw-semibold">Day 10-11</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                7
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-file-alt fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Draft Report</h4>
                        <p class="step-description text-muted small">Comprehensive draft report preparation and internal review</p>
                        <div class="step-duration small text-primary fw-semibold">Day 12-13</div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="process-step text-center animate-on-scroll">
                        <div class="step-number mb-3">
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px;">
                                8
                            </div>
                        </div>
                        <div class="step-icon mb-3">
                            <i class="fas fa-award fa-2x text-primary"></i>
                        </div>
                        <h4 class="step-title h6 fw-bold mb-2">Final Delivery</h4>
                        <p class="step-description text-muted small">Client review, final report, and certificate delivery</p>
                        <div class="step-duration small text-primary fw-semibold">Day 14</div>
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

        <!-- Testimonials Carousel -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators mb-4">
                        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>

                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <!-- Slide 1: Maya Cohen -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 p-4 opacity-10">
                                            <i class="fas fa-quote-left fa-3x text-primary"></i>
                                        </div>

                                        <div class="card-body p-5 position-relative text-center">
                                            <div class="mb-4">
                                                <div class="text-warning mb-3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>

                                            <blockquote class="mb-4">
                                                <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.2rem; line-height: 1.6; font-style: italic;">
                                                    "Collaborating with Eran was effortless. The professionalism and streamlined process made it an outstanding experience. They really paid attention to what I needed and nailed it. Communication was clear and timely, which made the entire project run smoothly. I'd totally recommend Eran and the team for their awesome service and dedication."
                                                </p>
                                            </blockquote>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark h5 mb-0" style="font-family: 'Inter', sans-serif;">Maya Cohen</div>
                                                    <small class="text-muted" style="font-family: 'Inter', sans-serif;">CEO, Montopay</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2: Josh Harro -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 p-4 opacity-10">
                                            <i class="fas fa-quote-left fa-3x text-primary"></i>
                                        </div>

                                        <div class="card-body p-5 position-relative text-center">
                                            <div class="mb-4">
                                                <div class="text-warning mb-3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>

                                            <blockquote class="mb-4">
                                                <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.2rem; line-height: 1.6; font-style: italic;">
                                                    "Eran supported us with our 409A valuation. He was prompt, professional, and the process was seamless. They met our timeline and delivered a report we submitted to our investors and other stakeholders with confidence. Thanks!"
                                                </p>
                                            </blockquote>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark h5 mb-0" style="font-family: 'Inter', sans-serif;">Josh Harro</div>
                                                    <small class="text-muted" style="font-family: 'Inter', sans-serif;">Director of Operations, Itur Intelligence</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3: Uriel Herman -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 p-4 opacity-10">
                                            <i class="fas fa-quote-left fa-3x text-primary"></i>
                                        </div>

                                        <div class="card-body p-5 position-relative text-center">
                                            <div class="mb-4">
                                                <div class="text-warning mb-3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>

                                            <blockquote class="mb-4">
                                                <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.2rem; line-height: 1.6; font-style: italic;">
                                                    "Working with Eran was a pleasure. Our timeline was tight and he met every deadline. I received a comprehensive, professional package that helped us in our fundraising and internal processes. I'd definitely recommend him to other founders."
                                                </p>
                                            </blockquote>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark h5 mb-0" style="font-family: 'Inter', sans-serif;">Uriel Herman</div>
                                                    <small class="text-muted" style="font-family: 'Inter', sans-serif;">CEO, Extreme Simulations</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4: Boaz Fraoman (Original) -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 p-4 opacity-10">
                                            <i class="fas fa-quote-left fa-3x text-primary"></i>
                                        </div>

                                        <div class="card-body p-5 position-relative text-center">
                                            <div class="mb-4">
                                                <div class="text-warning mb-3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>

                                            <blockquote class="mb-4">
                                                <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.2rem; line-height: 1.6; font-style: italic;">
                                                    "I highly recommend Bridgeland Advisors for their exceptional service in constructing a 409A valuation for our company. They demonstrated utmost professionalism and efficiency throughout the process."
                                                </p>
                                            </blockquote>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark h5 mb-0" style="font-family: 'Inter', sans-serif;">Boaz Fraiman</div>
                                                    <small class="text-muted" style="font-family: 'Inter', sans-serif;">Startup Founder</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 5: David Cooper (Original) -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="testimonial-card bg-white rounded-4 shadow-lg border-0 position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 p-4 opacity-10">
                                            <i class="fas fa-quote-left fa-3x text-primary"></i>
                                        </div>

                                        <div class="card-body p-5 position-relative text-center">
                                            <div class="mb-4">
                                                <div class="text-warning mb-3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>

                                            <blockquote class="mb-4">
                                                <p class="mb-0 text-dark" style="font-family: 'Source Serif Pro', serif; font-size: 1.2rem; line-height: 1.6; font-style: italic;">
                                                    "An absolute gem! Eran is a true expert in the field of VC finance and cap tables. He is an excellent communicator and an outstanding teacher."
                                                </p>
                                            </blockquote>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark h5 mb-0" style="font-family: 'Inter', sans-serif;">David Cooper</div>
                                                    <small class="text-muted" style="font-family: 'Inter', sans-serif;">Investment Professional</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                        <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-chevron-left text-white"></i>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                        <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-chevron-right text-white"></i>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
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
                                <i class="fas fa-shield-alt fa-2x"></i>
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
                <a href="javascript:void(0)" onclick="return openCalendly();" class="btn btn-outline btn-large">
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

/* Advanced Dashboard Animations */
.advanced-dashboard {
    animation: dashboardFloat 8s ease-in-out infinite;
    transform-origin: center;
}

@keyframes dashboardFloat {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-8px) scale(1.01);
    }
}

.live-dot {
    animation: livePulse 2s ease-in-out infinite;
}

@keyframes livePulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.6;
        transform: scale(1.2);
    }
}

.metric-card {
    transition: all 0.3s ease;
    animation: slideInUp 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

.metric-card:nth-child(1) { animation-delay: 0.2s; }
.metric-card:nth-child(2) { animation-delay: 0.4s; }
.metric-card:nth-child(3) { animation-delay: 0.6s; }

@keyframes slideInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.metric-card:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.animated-chart-bar {
    height: 0%;
    animation: chartGrow 2s ease-out forwards;
}

@keyframes chartGrow {
    to {
        height: var(--target-height);
    }
}

.status-icon {
    transition: all 0.3s ease;
}

.status-icon:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Enhanced Two-Row Client Logo Carousel */
@keyframes logoScrollTop {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

@keyframes logoScrollBottom {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.logos-carousel-container:hover .logos-track {
    animation-play-state: paused;
}

.logos-row {
    position: relative;
}

.logos-carousel-container {
    padding: 20px 0;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.client-logo {
    height: 60px;
    width: auto;
    max-width: 120px;
    object-fit: contain;
    filter: grayscale(100%) opacity(0.7);
    transition: all 0.3s ease;
}

.client-logo:hover {
    filter: grayscale(0%) opacity(1);
    transform: scale(1.1);
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

    // Advanced Dashboard Animations
    setTimeout(() => {
        // Animate dashboard values
        const animatedValues = document.querySelectorAll('.animated-value');
        animatedValues.forEach((element, index) => {
            setTimeout(() => {
                const targetValue = parseFloat(element.getAttribute('data-value'));
                const suffix = element.textContent.includes('M') ? 'M' :
                              element.textContent.includes('%') ? '%' :
                              element.textContent.includes('x') ? 'x' : '';
                const prefix = element.textContent.includes('$') ? '$' :
                              element.textContent.includes('+') ? '+' : '';

                animateValue(element, 0, targetValue, 2000, prefix, suffix);
            }, index * 300);
        });

        // Animate chart bars
        const chartBars = document.querySelectorAll('.animated-chart-bar');
        chartBars.forEach(bar => {
            const delay = parseInt(bar.getAttribute('data-delay')) || 0;
            setTimeout(() => {
                bar.style.height = bar.style.getPropertyValue('--target-height');
            }, delay);
        });

        // Animate progress bar
        setTimeout(() => {
            const progressBar = document.querySelector('.animated-progress-bar');
            const progressText = document.querySelector('.animated-progress');
            if (progressBar && progressText) {
                progressBar.style.width = '87%';
                animateValue(progressText, 0, 87, 3000, '', '%');
            }
        }, 1000);
    }, 1000);

    function animateValue(element, start, end, duration, prefix = '', suffix = '') {
        let startTime = null;

        function updateValue(timestamp) {
            if (!startTime) startTime = timestamp;
            const elapsed = timestamp - startTime;
            const progress = Math.min(elapsed / duration, 1);

            const easeProgress = 1 - Math.pow(1 - progress, 2);
            const currentValue = start + (end - start) * easeProgress;

            let displayValue = currentValue.toFixed(1);
            if (suffix === '%' || suffix === 'x') {
                displayValue = currentValue.toFixed(1);
            }

            element.textContent = prefix + displayValue + suffix;

            if (progress < 1) {
                requestAnimationFrame(updateValue);
            } else {
                element.textContent = prefix + end.toFixed(1) + suffix;
            }
        }

        requestAnimationFrame(updateValue);
    }

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

    // Lazy loading counter animation with Intersection Observer
    function initCounterAnimation() {
        // Only initialize if counters exist and haven't animated yet
        if (counterElements.length === 0 || hasAnimated) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !hasAnimated) {
                    console.log('Stats section is visible - starting animation');
                    hasAnimated = true;

                    // Start all counters with staggered delays
                    counterElements.forEach((counter, index) => {
                        animateCounter(counter, index * 200);
                    });

                    // Unobserve after animation starts
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.3, // Trigger when 30% visible
            rootMargin: '0px 0px -50px 0px' // Trigger slightly before element is fully in view
        });

        // Observe the stats section
        const statsSection = document.querySelector('.stats-counter-section');
        if (statsSection) {
            console.log('Setting up lazy loading for stats section');
            observer.observe(statsSection);
        } else {
            console.log('Stats section not found');
        }
    }

    // Initialize counter animation after a small delay to ensure DOM is ready
    setTimeout(initCounterAnimation, 100);

    // Also try to initialize on scroll (in case section is already visible)
    let scrollInitialized = false;
    window.addEventListener('scroll', function() {
        if (!scrollInitialized) {
            scrollInitialized = true;
            initCounterAnimation();
        }
    }, { once: true });

    // Enhanced Bootstrap Carousel Initialization
    function initTestimonialsCarousel() {
        console.log('Initializing testimonials carousel...');

        // Check if Bootstrap is available
        if (typeof bootstrap === 'undefined') {
            console.warn('Bootstrap not loaded, trying fallback carousel initialization');

            // Fallback manual carousel functionality
            let currentSlide = 0;
            const slides = document.querySelectorAll('#testimonialsCarousel .carousel-item');
            const indicators = document.querySelectorAll('#testimonialsCarousel .carousel-indicators button');
            const totalSlides = slides.length;

            if (totalSlides === 0) {
                console.error('No carousel slides found');
                return;
            }

            console.log('Found', totalSlides, 'testimonial slides');

            function showSlide(index) {
                // Remove active from all slides and indicators with sliding animation
                slides.forEach((slide, i) => {
                    slide.classList.remove('active', 'carousel-item-next', 'carousel-item-prev', 'carousel-item-start', 'carousel-item-end');

                    if (i === index) {
                        // Current slide - make active and center
                        slide.classList.add('active');
                        slide.style.transform = 'translateX(0)';
                    } else if (i < index) {
                        // Previous slides - slide left
                        slide.style.transform = 'translateX(-100%)';
                    } else {
                        // Next slides - slide right
                        slide.style.transform = 'translateX(100%)';
                    }
                });

                // Update indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                    indicator.removeAttribute('aria-current');
                });

                if (indicators[index]) {
                    indicators[index].classList.add('active');
                    indicators[index].setAttribute('aria-current', 'true');
                }

                console.log('Showing slide', index + 1, 'with sliding animation');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }

            // Add click handlers to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });

            // Add click handlers to control buttons
            const prevBtn = document.querySelector('#testimonialsCarousel .carousel-control-prev');
            const nextBtn = document.querySelector('#testimonialsCarousel .carousel-control-next');

            if (prevBtn) prevBtn.addEventListener('click', prevSlide);
            if (nextBtn) nextBtn.addEventListener('click', nextSlide);

            // Auto-advance every 5 seconds
            setInterval(nextSlide, 5000);

            // Ensure first slide is active
            showSlide(0);

        } else {
            // Use Bootstrap's carousel
            console.log('Bootstrap available, initializing carousel');
            const carouselElement = document.getElementById('testimonialsCarousel');
            if (carouselElement) {
                const carousel = new bootstrap.Carousel(carouselElement, {
                    interval: 5000,
                    ride: 'carousel'
                });
                console.log('✅ Bootstrap carousel initialized');
            }
        }
    }

    // Initialize carousel after a delay to ensure DOM is ready
    setTimeout(initTestimonialsCarousel, 500);
});
</script>

<?php get_footer(); ?>