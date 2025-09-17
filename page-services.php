<?php get_header(); ?>

<section class="services-hero py-5" style="padding-top: 120px; background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 fw-bold mb-4">Comprehensive Financial Advisory Services</h1>
                <p class="lead mb-4">
                    Expert valuation and strategic financial advisory services designed to help your company
                    navigate complex financial decisions with confidence and precision.
                </p>
                <div class="hero-stats row g-3 mt-4">
                    <div class="col-md-4">
                        <div class="stat-item text-center">
                            <div class="h2 mb-1">500+</div>
                            <div class="small opacity-75">Valuations Completed</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item text-center">
                            <div class="h2 mb-1">$2B+</div>
                            <div class="small opacity-75">Assets Valued</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item text-center">
                            <div class="h2 mb-1">14 Days</div>
                            <div class="small opacity-75">Average Turnaround</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Services Grid -->
<section class="services-grid py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Our Core Services</h2>
            <p class="lead text-muted">
                Specialized expertise across all aspects of business valuation and financial advisory
            </p>
        </div>

        <div class="row g-4">
            <!-- 409A Valuation -->
            <div class="col-lg-6">
                <div class="service-card-detailed card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-header d-flex align-items-center mb-3">
                            <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-gavel text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-1">409A Valuation</h3>
                                <div class="service-badge badge bg-success">Most Popular</div>
                            </div>
                        </div>

                        <p class="service-description text-muted mb-3">
                            IRS-compliant equity valuations for stock option programs and financial reporting
                            with 14-day turnaround guarantee and comprehensive audit defense.
                        </p>

                        <div class="service-details mb-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Price Range</div>
                                        <div class="fw-bold text-primary">$2,500 - $7,500</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Timeline</div>
                                        <div class="fw-bold">1-2 weeks</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-features mb-3">
                            <div class="small text-muted mb-2">Includes:</div>
                            <ul class="list-unstyled small">
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>IRS-compliant valuation report</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Board resolution template</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Comprehensive audit defense</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Cap table analysis</li>
                            </ul>
                        </div>

                        <a href="<?php echo home_url('/409a-valuation/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Company Valuation -->
            <div class="col-lg-6">
                <div class="service-card-detailed card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-header d-flex align-items-center mb-3">
                            <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-building text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-1">Company Valuation</h3>
                                <div class="service-badge badge bg-info">Comprehensive</div>
                            </div>
                        </div>

                        <p class="service-description text-muted mb-3">
                            Comprehensive business valuations for M&A transactions, financial reporting,
                            and strategic planning using industry best practices and methodologies.
                        </p>

                        <div class="service-details mb-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Price Range</div>
                                        <div class="fw-bold text-primary">$5,000 - $15,000</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Timeline</div>
                                        <div class="fw-bold">2-4 weeks</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-features mb-3">
                            <div class="small text-muted mb-2">Includes:</div>
                            <ul class="list-unstyled small">
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Multiple valuation approaches</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Market analysis & benchmarking</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Financial model review</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Executive summary</li>
                            </ul>
                        </div>

                        <a href="<?php echo home_url('/company-valuation/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Waterfall Analysis -->
            <div class="col-lg-6">
                <div class="service-card-detailed card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-header d-flex align-items-center mb-3">
                            <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-water text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-1">Exit Waterfall Analysis</h3>
                                <div class="service-badge badge bg-warning">Strategic</div>
                            </div>
                        </div>

                        <p class="service-description text-muted mb-3">
                            Detailed analysis of liquidation preferences and exit distribution scenarios
                            for complex capital structures and investment decisions.
                        </p>

                        <div class="service-details mb-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Price Range</div>
                                        <div class="fw-bold text-primary">$1,500 - $5,000</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Timeline</div>
                                        <div class="fw-bold">1-2 weeks</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-features mb-3">
                            <div class="small text-muted mb-2">Includes:</div>
                            <ul class="list-unstyled small">
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Scenario modeling</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Distribution analysis</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Interactive Excel model</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Executive summary</li>
                            </ul>
                        </div>

                        <a href="<?php echo home_url('/waterfall-analysis/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Capital Raising -->
            <div class="col-lg-6">
                <div class="service-card-detailed card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-header d-flex align-items-center mb-3">
                            <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-handshake text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-1">Capital Raising Advisory</h3>
                                <div class="service-badge badge bg-primary">Expert Guidance</div>
                            </div>
                        </div>

                        <p class="service-description text-muted mb-3">
                            Strategic advisory for capital raises, investor engagement, and fundraising
                            processes with 15+ years of experience in venture capital.
                        </p>

                        <div class="service-details mb-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Price Range</div>
                                        <div class="fw-bold text-primary">$3,000 - $12,000</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="detail-item">
                                        <div class="small text-muted">Timeline</div>
                                        <div class="fw-bold">3-6 weeks</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-features mb-3">
                            <div class="small text-muted mb-2">Includes:</div>
                            <ul class="list-unstyled small">
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Fundraising strategy</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Investor outreach support</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Term sheet negotiation</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Due diligence support</li>
                            </ul>
                        </div>

                        <a href="<?php echo home_url('/capital-raising/'); ?>" class="btn btn-primary w-100">
                            Learn More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Services -->
<section class="additional-services py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Additional Services</h2>
            <p class="lead text-muted">
                Comprehensive financial advisory solutions tailored to your specific needs
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-calculator text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Financial Modeling</h4>
                        <p class="text-muted mb-3">
                            Custom financial models for fundraising, planning, and investment analysis.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Starting at</div>
                            <div class="h6 text-primary">$2,000</div>
                        </div>
                        <a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-file-contract text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Term Sheet Review</h4>
                        <p class="text-muted mb-3">
                            Expert analysis and negotiation support for investment terms and agreements.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Starting at</div>
                            <div class="h6 text-primary">$1,000</div>
                        </div>
                        <a href="#contact" class="btn btn-outline-primary btn-sm">Get Quote</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-chart-pie text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Cap Table Management</h4>
                        <p class="text-muted mb-3">
                            Equity structure analysis and ongoing cap table maintenance and modeling.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Starting at</div>
                            <div class="h6 text-primary">$500</div>
                        </div>
                        <a href="#contact" class="btn btn-outline-primary btn-sm">Get Quote</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Compliance Advisory</h4>
                        <p class="text-muted mb-3">
                            Regulatory compliance support and audit defense for financial reporting.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Starting at</div>
                            <div class="h6 text-primary">$1,500</div>
                        </div>
                        <a href="#contact" class="btn btn-outline-primary btn-sm">Get Quote</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Strategic Advisory</h4>
                        <p class="text-muted mb-3">
                            Board advisory services and strategic planning for growth-stage companies.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Contact for</div>
                            <div class="h6 text-primary">Custom Quote</div>
                        </div>
                        <a href="#contact" class="btn btn-outline-primary btn-sm">Contact Us</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="additional-service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-graduation-cap text-primary"></i>
                        </div>
                        <h4 class="h5 mb-3">Training & Workshops</h4>
                        <p class="text-muted mb-3">
                            Educational sessions on valuation, cap tables, and financial modeling.
                        </p>
                        <div class="pricing mb-3">
                            <div class="small text-muted">Starting at</div>
                            <div class="h6 text-primary">$2,500</div>
                        </div>
                        <a href="#contact" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Overview -->
<section class="process-overview py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Our Proven Process</h2>
            <p class="lead text-muted">
                A systematic approach ensuring accuracy, transparency, and actionable insights
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-sm-6">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; line-height: 54px;">
                        1
                    </div>
                    <h4 class="h5 mb-3">Initial Consultation</h4>
                    <p class="text-muted small">
                        Understanding your business, requirements, and objectives through detailed discussion.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; line-height: 54px;">
                        2
                    </div>
                    <h4 class="h5 mb-3">Engagement & Planning</h4>
                    <p class="text-muted small">
                        Formal agreement outlining scope, timeline, deliverables, and project methodology.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; line-height: 54px;">
                        3
                    </div>
                    <h4 class="h5 mb-3">Analysis & Modeling</h4>
                    <p class="text-muted small">
                        Comprehensive research, financial modeling, and analysis using industry best practices.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; line-height: 54px;">
                        4
                    </div>
                    <h4 class="h5 mb-3">Delivery & Support</h4>
                    <p class="text-muted small">
                        Final report delivery with comprehensive support and ongoing audit defense.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Philosophy -->
<section class="pricing-philosophy py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold text-primary mb-4">Transparent Pricing</h2>
                <p class="lead text-muted mb-4">
                    Our pricing is straightforward, competitive, and designed to deliver exceptional
                    value without hidden fees or surprise costs.
                </p>

                <div class="pricing-principles">
                    <div class="principle-item d-flex align-items-start mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <div>
                            <h5 class="mb-1">No Hidden Fees</h5>
                            <p class="text-muted mb-0 small">All costs are clearly outlined upfront with no surprise charges.</p>
                        </div>
                    </div>

                    <div class="principle-item d-flex align-items-start mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <div>
                            <h5 class="mb-1">Competitive Rates</h5>
                            <p class="text-muted mb-0 small">Fair pricing that reflects our expertise and service quality.</p>
                        </div>
                    </div>

                    <div class="principle-item d-flex align-items-start mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <div>
                            <h5 class="mb-1">Value-Based Pricing</h5>
                            <p class="text-muted mb-0 small">Pricing based on project complexity and value delivered.</p>
                        </div>
                    </div>

                    <div class="principle-item d-flex align-items-start">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <div>
                            <h5 class="mb-1">Flexible Payment Terms</h5>
                            <p class="text-muted mb-0 small">Accommodating payment schedules for your business needs.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="pricing-comparison bg-white p-4 rounded shadow">
                    <h4 class="text-primary mb-4">Service Comparison</h4>

                    <div class="comparison-table">
                        <div class="comparison-row d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="service-name">
                                <strong>409A Valuation</strong>
                                <div class="small text-muted">1-2 weeks turnaround</div>
                            </div>
                            <div class="service-price text-primary fw-bold">$2,500 - $7,500</div>
                        </div>

                        <div class="comparison-row d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="service-name">
                                <strong>Company Valuation</strong>
                                <div class="small text-muted">2-4 weeks turnaround</div>
                            </div>
                            <div class="service-price text-primary fw-bold">$5,000 - $15,000</div>
                        </div>

                        <div class="comparison-row d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="service-name">
                                <strong>Waterfall Analysis</strong>
                                <div class="small text-muted">1-2 weeks turnaround</div>
                            </div>
                            <div class="service-price text-primary fw-bold">$1,500 - $5,000</div>
                        </div>

                        <div class="comparison-row d-flex justify-content-between align-items-center py-2">
                            <div class="service-name">
                                <strong>Capital Advisory</strong>
                                <div class="small text-muted">3-6 weeks engagement</div>
                            </div>
                            <div class="service-price text-primary fw-bold">$3,000 - $12,000</div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="#contact" class="btn btn-primary">Get Custom Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="contact" class="cta-section py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="display-5 fw-bold mb-3">Ready to Get Started?</h2>
                <p class="lead mb-4">
                    Schedule a consultation to discuss your specific valuation and financial advisory needs.
                </p>

                <div class="cta-actions d-flex gap-3 justify-content-center flex-wrap mb-4">
                    <a href="tel:+972-50-6842937" class="btn btn-white btn-large">
                        <i class="fas fa-phone me-2"></i>Call +972-50-6842937
                    </a>
                    <a href="mailto:eran@bridgeland-advisors.com?subject=Services Inquiry" class="btn btn-outline btn-large">
                        <i class="fas fa-envelope me-2"></i>Email Consultation
                    </a>
                    <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-outline btn-large">
                        <i class="fas fa-calendar-alt me-2"></i>Schedule Meeting
                    </a>
                </div>

                <div class="trust-indicators">
                    <p class="small mb-0 opacity-75">
                        <i class="fas fa-shield-alt me-2"></i>
                        Trusted by 500+ companies • 14-day turnaround guarantee • Audit defense included
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.service-card-detailed {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.service-card-detailed:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    border-color: var(--color-primary);
}

.service-badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.additional-service-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    transition: all 0.3s ease;
}

.process-step .step-number {
    font-size: 1.5rem;
    font-weight: bold;
    transition: all 0.3s ease;
}

.process-step:hover .step-number {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(139, 26, 26, 0.3);
}

.comparison-row:hover {
    background-color: var(--color-gray-50);
    border-radius: 0.25rem;
}

.hero-stats .stat-item {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .service-header {
        flex-direction: column;
        text-align: center;
    }

    .service-header .service-icon {
        margin-bottom: 1rem;
        margin-right: 0;
    }

    .cta-actions {
        flex-direction: column;
        align-items: center;
    }

    .btn-large {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<?php get_footer(); ?>