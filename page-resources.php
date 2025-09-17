<?php get_header(); ?>

<section class="resources-hero py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding-top: 120px !important; position: relative;">
    <!-- Subtle background pattern -->
    <div class="hero-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23B91C1C\" fill-opacity=\"0.1\"><circle cx=\"7\" cy=\"7\" r=\"1\"/><circle cx=\"53\" cy=\"53\" r=\"1\"/><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>');"></div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-3 text-dark" style="font-family: 'Source Serif Pro', serif;">Resources & Tools</h1>
                    <p class="lead mb-4 text-secondary" style="font-family: 'Inter', sans-serif;">
                        Access our comprehensive library of valuation resources, calculators, market insights,
                        and educational materials to support your financial decision-making.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#calculators" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-calculator me-2"></i>Free Calculators
                        </a>
                        <a href="#guides" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-book me-2"></i>Guides & Articles
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-card bg-white rounded-4 shadow-lg p-4 mt-4 mt-lg-0">
                    <h5 class="text-primary mb-3" style="font-family: 'Inter', sans-serif;">Resource Library</h5>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Calculators:</span>
                        <strong>3 Tools</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Articles:</span>
                        <strong>25+ Guides</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Templates:</span>
                        <strong>10+ Downloads</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between">
                        <span>Updated:</span>
                        <strong>Monthly</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Calculators Section -->
<section id="calculators" class="calculators-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="font-family: 'Source Serif Pro', serif;">Interactive Calculators</h2>
            <p class="lead text-muted" style="font-family: 'Inter', sans-serif;">
                Professional-grade financial calculators for instant valuation estimates
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="calculator-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-rocket text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">VC Method Calculator</h5>
                        <p class="text-muted mb-3">
                            Calculate pre-money valuation based on target returns and exit multiples.
                        </p>
                        <a href="<?php echo home_url('/calculators/'); ?>#vc-method" class="btn btn-primary w-100">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="calculator-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-clipboard-list text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Scorecard Valuation</h5>
                        <p class="text-muted mb-3">
                            Compare your startup against market averages across key factors.
                        </p>
                        <a href="<?php echo home_url('/calculators/'); ?>#scorecard" class="btn btn-primary w-100">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="calculator-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-chart-line text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">DCF Calculator</h5>
                        <p class="text-muted mb-3">
                            Discounted cash flow analysis for mature companies with predictable cash flows.
                        </p>
                        <a href="<?php echo home_url('/calculators/'); ?>#dcf" class="btn btn-primary w-100">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guides and Articles Section -->
<section id="guides" class="guides-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="font-family: 'Source Serif Pro', serif;">Guides & Articles</h2>
            <p class="lead text-muted" style="font-family: 'Inter', sans-serif;">
                Expert insights and practical guidance for valuation and financial planning
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-gavel text-primary"></i>
                            </div>
                            <h6 class="mb-0 text-primary">409A Valuation</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Complete Guide to 409A Valuations</h5>
                        <p class="text-muted mb-3">
                            Everything you need to know about IRS-compliant equity valuations for stock option programs, including timing requirements, methodologies, and compliance best practices.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-chart-bar text-success"></i>
                            </div>
                            <h6 class="mb-0 text-success">Valuation Methods</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Startup Valuation Methods Explained</h5>
                        <p class="text-muted mb-3">
                            Compare different valuation approaches including VC Method, Scorecard, DCF, and market multiples to understand when to use each methodology.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-success">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-handshake text-info"></i>
                            </div>
                            <h6 class="mb-0 text-info">Fundraising</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Capital Raising Best Practices</h5>
                        <p class="text-muted mb-3">
                            Strategic guidance for successful fundraising rounds, investor targeting, pitch preparation, and term sheet negotiation.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-info">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-water text-warning"></i>
                            </div>
                            <h6 class="mb-0 text-warning">Exit Planning</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Exit Waterfall Analysis Guide</h5>
                        <p class="text-muted mb-3">
                            Understand liquidation preferences, participation rights, and how different exit scenarios affect stakeholder distributions.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-warning">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-file-contract text-danger"></i>
                            </div>
                            <h6 class="mb-0 text-danger">Term Sheets</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">Term Sheet Negotiation Guide</h5>
                        <p class="text-muted mb-3">
                            Key terms, common pitfalls, valuation clauses, board control, and negotiation strategies for venture capital investment deals.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-danger">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="guide-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-secondary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-balance-scale text-secondary"></i>
                            </div>
                            <h6 class="mb-0 text-secondary">Compliance</h6>
                        </div>
                        <h5 class="mb-3" style="font-family: 'Inter', sans-serif;">SEC & IRS Compliance Basics</h5>
                        <p class="text-muted mb-3">
                            Essential compliance requirements for startup valuations, 83(b) elections, and financial reporting obligations.
                        </p>
                        <a href="<?php echo home_url('/insights/'); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right me-2"></i>Read Guide
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Templates and Downloads Section -->
<section class="templates-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="font-family: 'Source Serif Pro', serif;">Templates & Downloads</h2>
            <p class="lead text-muted" style="font-family: 'Inter', sans-serif;">
                Professional templates and tools to streamline your valuation and fundraising process
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="template-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 text-center">
                                    <i class="fas fa-file-excel text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="mb-1" style="font-family: 'Inter', sans-serif;">Financial Model Template</h6>
                                <p class="text-muted mb-0 small">3-statement startup financial model</p>
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="template-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3 text-center">
                                    <i class="fas fa-file-powerpoint text-success fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="mb-1" style="font-family: 'Inter', sans-serif;">Pitch Deck Template</h6>
                                <p class="text-muted mb-0 small">Investor presentation template</p>
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn-success btn-sm w-100">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="template-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3 text-center">
                                    <i class="fas fa-file-pdf text-info fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="mb-1" style="font-family: 'Inter', sans-serif;">Due Diligence Checklist</h6>
                                <p class="text-muted mb-0 small">Comprehensive document list</p>
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn-info btn-sm w-100">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="template-card card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3 text-center">
                                    <i class="fas fa-file-alt text-warning fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="mb-1" style="font-family: 'Inter', sans-serif;">Cap Table Template</h6>
                                <p class="text-muted mb-0 small">Equity tracking and modeling</p>
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn-warning btn-sm w-100">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="resources-cta py-5 bg-primary text-white">
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3" style="font-family: 'Source Serif Pro', serif;">Need Expert Guidance?</h3>
            <p class="lead mb-4" style="font-family: 'Inter', sans-serif;">
                While our resources provide valuable insights, nothing replaces personalized expert advice.
                Schedule a consultation to discuss your specific needs.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/bridgeland-advisors'}); return false;" class="btn btn-light btn-lg">
                    <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
                </a>
                <a href="tel:+972-50-6842937" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-phone me-2"></i>Call +972-50-6842937
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.calculator-card, .guide-card, .template-card {
    transition: all 0.3s ease;
}

.calculator-card:hover, .guide-card:hover, .template-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

@media (max-width: 768px) {
    .hero-content .btn-lg {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<?php get_footer(); ?>