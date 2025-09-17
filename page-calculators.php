<?php get_header(); ?>

<section class="calculators-hero py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding-top: 120px !important; position: relative;">
    <!-- Subtle background pattern -->
    <div class="hero-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23B91C1C\" fill-opacity=\"0.1\"><circle cx=\"7\" cy=\"7\" r=\"1\"/><circle cx=\"53\" cy=\"53\" r=\"1\"/><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>');\"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-3 text-dark" style="font-family: 'Source Serif Pro', serif;">Interactive Valuation Calculators</h1>
                    <p class="lead mb-4 text-secondary" style="font-family: 'Inter', sans-serif;">
                        Professional-grade financial calculators for startup valuation, investment analysis,
                        and strategic planning. Get instant estimates using industry-standard methodologies.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#calculators" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-calculator me-2"></i>Start Calculating
                        </a>
                        <a href="#contact" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-phone me-2"></i>Get Professional Analysis
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-card bg-white rounded-3 shadow-lg p-4 mt-4 mt-lg-0">
                    <h5 class="text-primary mb-3">Calculator Features</h5>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Methodologies:</span>
                        <strong>3 Approaches</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Export Options:</span>
                        <strong>PDF, Excel</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Scenarios:</span>
                        <strong>Multiple</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Real-time:</span>
                        <strong>Instant Results</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between">
                        <span>Professional:</span>
                        <strong>Industry Standard</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator Selection Section -->
<section id="calculators" class="calculators-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Choose Your Calculator</h2>
            <p class="lead text-muted">
                Select the valuation methodology that best fits your analysis needs
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="calculator-option card border-0 shadow-sm h-100" data-calculator="vc-method">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-rocket text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">VC Method Calculator</h5>
                        <p class="text-muted mb-3">
                            Calculate pre-money valuation based on target returns and exit multiples.
                            Ideal for venture capital investment analysis.
                        </p>
                        <button class="btn btn-primary w-100" onclick="showCalculator('vc-method')">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="calculator-option card border-0 shadow-sm h-100" data-calculator="scorecard">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-clipboard-list text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Scorecard Valuation</h5>
                        <p class="text-muted mb-3">
                            Compare your startup against market averages across key factors
                            to determine relative valuation.
                        </p>
                        <button class="btn btn-primary w-100" onclick="showCalculator('scorecard')">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="calculator-option card border-0 shadow-sm h-100" data-calculator="dcf">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-chart-line text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">DCF Calculator</h5>
                        <p class="text-muted mb-3">
                            Discounted cash flow analysis based on projected financials
                            and risk-adjusted discount rates.
                        </p>
                        <button class="btn btn-primary w-100" onclick="showCalculator('dcf')">
                            <i class="fas fa-calculator me-2"></i>Use Calculator
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VC Method Calculator -->
<section id="vc-method-calculator" class="calculator-container py-5 bg-light" style="display: none;" data-calculator="vc-method">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="calculator-card card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-rocket me-2"></i>VC Method Calculator
                            </h4>
                            <button class="btn btn-sm btn-outline-light" onclick="hideCalculators()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <p class="text-muted">
                                The VC Method calculates pre-money valuation by working backward from expected exit value
                                and required investor returns. Enter your assumptions below for instant analysis.
                            </p>
                        </div>

                        <form id="vc-method-form" class="row g-3">
                            <div class="col-md-6">
                                <label for="exit-value" class="form-label">Expected Exit Value ($M)</label>
                                <input type="number" class="form-control calculator-input" id="exit-value"
                                       name="exit_value" step="0.1" placeholder="50" min="0">
                                <div class="form-text">Estimated company value at exit</div>
                            </div>

                            <div class="col-md-6">
                                <label for="time-to-exit" class="form-label">Time to Exit (Years)</label>
                                <input type="number" class="form-control calculator-input" id="time-to-exit"
                                       name="time_to_exit" step="0.5" placeholder="5" min="0.5" max="15">
                                <div class="form-text">Expected years until exit event</div>
                            </div>

                            <div class="col-md-6">
                                <label for="target-return" class="form-label">Target Return Multiple</label>
                                <input type="number" class="form-control calculator-input" id="target-return"
                                       name="target_return" step="0.5" placeholder="10" min="1">
                                <div class="form-text">Required return multiple (e.g., 10x)</div>
                            </div>

                            <div class="col-md-6">
                                <label for="investment-amount" class="form-label">Investment Amount ($M)</label>
                                <input type="number" class="form-control calculator-input" id="investment-amount"
                                       name="investment_amount" step="0.1" placeholder="2" min="0">
                                <div class="form-text">Proposed investment size</div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-calculator me-2"></i>Calculate Valuation
                                </button>
                            </div>
                        </form>

                        <div id="vc-results" class="results-section mt-4" style="display: none;">
                            <!-- Results will be populated by JavaScript -->
                        </div>

                        <div class="export-section mt-4" style="display: none;">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Export & Print:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="exportToPDF('vc-method')">
                                            <i class="fas fa-file-pdf me-1"></i>PDF
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="exportToExcel('vc-method')">
                                            <i class="fas fa-file-excel me-1"></i>Excel
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="emailReport('vc-method')">
                                            <i class="fas fa-envelope me-1"></i>Email
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="printReport('vc-method')">
                                            <i class="fas fa-print me-1"></i>Print
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Share & Collaborate:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="shareResults('vc-method', 'linkedin')">
                                            <i class="fab fa-linkedin me-1"></i>LinkedIn
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="shareResults('vc-method', 'twitter')">
                                            <i class="fab fa-twitter me-1"></i>Twitter
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="shareResults('vc-method', 'whatsapp')">
                                            <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                        </button>
                                        <button class="btn btn-outline-dark btn-sm" onclick="generateShareableLink('vc-method')">
                                            <i class="fas fa-link me-1"></i>Copy Link
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="requestReview('vc-method')">
                                            <i class="fas fa-user-tie me-1"></i>Expert Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scorecard Calculator -->
<section id="scorecard-calculator" class="calculator-container py-5 bg-light" style="display: none;" data-calculator="scorecard">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="calculator-card card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>Scorecard Valuation Calculator
                            </h4>
                            <button class="btn btn-sm btn-outline-light" onclick="hideCalculators()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <p class="text-muted">
                                The Scorecard Method compares your startup to market averages across key factors.
                                Rate your company from 1 (below average) to 5 (above average) in each category.
                            </p>
                        </div>

                        <form id="scorecard-form" class="row g-3">
                            <div class="col-12">
                                <label for="base-valuation" class="form-label">Base Pre-Money Valuation ($M)</label>
                                <input type="number" class="form-control" id="base-valuation"
                                       name="base_valuation" step="0.1" placeholder="5" min="0">
                                <div class="form-text">Regional average pre-money valuation</div>
                            </div>

                            <?php
                            $factors = [
                                ['name' => 'Management Team', 'weight' => 0.30, 'description' => 'Experience, track record, and team completeness'],
                                ['name' => 'Market Size', 'weight' => 0.25, 'description' => 'Total addressable market and growth potential'],
                                ['name' => 'Product/Technology', 'weight' => 0.15, 'description' => 'Innovation, IP, and competitive advantage'],
                                ['name' => 'Competitive Environment', 'weight' => 0.10, 'description' => 'Market position and differentiation'],
                                ['name' => 'Marketing/Sales', 'weight' => 0.10, 'description' => 'Go-to-market strategy and traction'],
                                ['name' => 'Additional Factors', 'weight' => 0.10, 'description' => 'Partnerships, funding needs, exit strategy']
                            ];

                            foreach ($factors as $index => $factor): ?>
                                <div class="col-12">
                                    <div class="factor-card card bg-light border-0 mb-3">
                                        <div class="card-body p-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="form-label mb-0 fw-bold"><?php echo $factor['name']; ?></label>
                                                    <div class="small text-muted">Weight: <?php echo $factor['weight'] * 100; ?>%</div>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="small text-muted mb-0"><?php echo $factor['description']; ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-select scorecard-factor"
                                                            data-factor="<?php echo strtolower(str_replace(['/', ' '], ['_', '_'], $factor['name'])); ?>"
                                                            data-weight="<?php echo $factor['weight']; ?>">
                                                        <option value="">Rate 1-5</option>
                                                        <option value="1">1 - Well Below Average</option>
                                                        <option value="2">2 - Below Average</option>
                                                        <option value="3">3 - Average</option>
                                                        <option value="4">4 - Above Average</option>
                                                        <option value="5">5 - Well Above Average</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-calculator me-2"></i>Calculate Valuation
                                </button>
                            </div>
                        </form>

                        <div id="scorecard-results" class="results-section mt-4" style="display: none;">
                            <!-- Results will be populated by JavaScript -->
                        </div>

                        <div class="export-section mt-4" style="display: none;">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Export & Print:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="exportToPDF('scorecard')">
                                            <i class="fas fa-file-pdf me-1"></i>PDF
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="exportToExcel('scorecard')">
                                            <i class="fas fa-file-excel me-1"></i>Excel
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="emailReport('scorecard')">
                                            <i class="fas fa-envelope me-1"></i>Email
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="printReport('scorecard')">
                                            <i class="fas fa-print me-1"></i>Print
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Share & Collaborate:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="shareResults('scorecard', 'linkedin')">
                                            <i class="fab fa-linkedin me-1"></i>LinkedIn
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="shareResults('scorecard', 'twitter')">
                                            <i class="fab fa-twitter me-1"></i>Twitter
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="shareResults('scorecard', 'whatsapp')">
                                            <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                        </button>
                                        <button class="btn btn-outline-dark btn-sm" onclick="generateShareableLink('scorecard')">
                                            <i class="fas fa-link me-1"></i>Copy Link
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="requestReview('scorecard')">
                                            <i class="fas fa-user-tie me-1"></i>Expert Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DCF Calculator -->
<section id="dcf-calculator" class="calculator-container py-5 bg-light" style="display: none;" data-calculator="dcf">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="calculator-card card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-chart-line me-2"></i>DCF Calculator
                            </h4>
                            <button class="btn btn-sm btn-outline-light" onclick="hideCalculators()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <p class="text-muted">
                                Discounted Cash Flow analysis calculates enterprise value based on projected cash flows
                                and terminal value. Enter your financial projections and assumptions below.
                            </p>
                        </div>

                        <form id="dcf-form" class="row g-3">
                            <div class="col-md-6">
                                <label for="initial-cash-flow" class="form-label">Initial Cash Flow ($M)</label>
                                <input type="number" class="form-control calculator-input" id="initial-cash-flow"
                                       name="initial_cash_flow" step="0.1" placeholder="1" min="0">
                                <div class="form-text">Current year free cash flow</div>
                            </div>

                            <div class="col-md-6">
                                <label for="growth-rate" class="form-label">Growth Rate (%)</label>
                                <input type="number" class="form-control calculator-input" id="growth-rate"
                                       name="growth_rate" step="0.5" placeholder="25" min="0" max="100">
                                <div class="form-text">Annual cash flow growth rate</div>
                            </div>

                            <div class="col-md-6">
                                <label for="discount-rate" class="form-label">Discount Rate (%)</label>
                                <input type="number" class="form-control calculator-input" id="discount-rate"
                                       name="discount_rate" step="0.5" placeholder="15" min="0" max="50">
                                <div class="form-text">WACC or required rate of return</div>
                            </div>

                            <div class="col-md-6">
                                <label for="terminal-growth" class="form-label">Terminal Growth Rate (%)</label>
                                <input type="number" class="form-control calculator-input" id="terminal-growth"
                                       name="terminal_growth" step="0.5" placeholder="3" min="0" max="10">
                                <div class="form-text">Long-term growth rate</div>
                            </div>

                            <div class="col-md-6">
                                <label for="projection-years" class="form-label">Projection Period (Years)</label>
                                <select class="form-select calculator-input" id="projection-years" name="projection_years">
                                    <option value="5">5 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="10">10 Years</option>
                                </select>
                                <div class="form-text">Explicit forecast period</div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-calculator me-2"></i>Calculate Valuation
                                </button>
                            </div>
                        </form>

                        <div id="dcf-results" class="results-section mt-4" style="display: none;">
                            <!-- Results will be populated by JavaScript -->
                        </div>

                        <div class="export-section mt-4" style="display: none;">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Export & Print:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="exportToPDF('dcf')">
                                            <i class="fas fa-file-pdf me-1"></i>PDF
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="exportToExcel('dcf')">
                                            <i class="fas fa-file-excel me-1"></i>Excel
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="emailReport('dcf')">
                                            <i class="fas fa-envelope me-1"></i>Email
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="printReport('dcf')">
                                            <i class="fas fa-print me-1"></i>Print
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-bold">Share & Collaborate:</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" onclick="shareResults('dcf', 'linkedin')">
                                            <i class="fab fa-linkedin me-1"></i>LinkedIn
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" onclick="shareResults('dcf', 'twitter')">
                                            <i class="fab fa-twitter me-1"></i>Twitter
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="shareResults('dcf', 'whatsapp')">
                                            <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                        </button>
                                        <button class="btn btn-outline-dark btn-sm" onclick="generateShareableLink('dcf')">
                                            <i class="fas fa-link me-1"></i>Copy Link
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="requestReview('dcf')">
                                            <i class="fas fa-user-tie me-1"></i>Expert Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Disclaimer Section -->
<section class="disclaimer-section py-5">
    <div class="container">
        <div class="alert alert-warning" role="alert">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-triangle me-2"></i>Important Disclaimer
            </h5>
            <p class="mb-2">
                These calculators provide estimates for educational and planning purposes only. Results should not be
                considered as professional valuation opinions or investment advice.
            </p>
            <ul class="mb-0">
                <li>Calculations are based on simplified methodologies and assumptions</li>
                <li>Professional valuations require comprehensive analysis of multiple factors</li>
                <li>Always consult with qualified financial advisors for investment decisions</li>
                <li>For formal valuations, please <a href="<?php echo home_url('/contact/'); ?>" class="alert-link">contact our team</a></li>
            </ul>
        </div>
    </div>
</section>

<!-- Professional Services CTA -->
<section class="professional-cta py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3">Need a Professional Valuation?</h3>
            <p class="lead text-muted mb-4">
                While our calculators provide useful estimates, professional valuations require comprehensive analysis.
                Get expert guidance from our experienced team.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="<?php echo home_url('/409a-valuation/'); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-gavel me-2"></i>409A Valuation
                </a>
                <a href="<?php echo home_url('/company-valuation/'); ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-building me-2"></i>Company Valuation
                </a>
                <a href="javascript:void(0)" onclick="return openCalendly();" class="btn btn-success btn-lg">
                    <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript for Calculators -->
<script>
function showCalculator(type) {
    // Hide all calculators
    document.querySelectorAll('.calculator-container').forEach(calc => {
        calc.style.display = 'none';
    });

    // Show selected calculator
    document.getElementById(type + '-calculator').style.display = 'block';

    // Scroll to calculator
    document.getElementById(type + '-calculator').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

function hideCalculators() {
    document.querySelectorAll('.calculator-container').forEach(calc => {
        calc.style.display = 'none';
    });

    // Scroll back to calculator selection
    document.getElementById('calculators').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Enhanced export functions are now implemented in calculators.js

// Add hover effects to calculator options
document.querySelectorAll('.calculator-option').forEach(option => {
    option.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.15)';
    });

    option.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '';
    });
});
</script>

<style>
.calculator-option {
    transition: all 0.3s ease;
    cursor: pointer;
}

.calculator-card {
    max-width: none;
}

.factor-card {
    transition: all 0.3s ease;
}

.factor-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.results-section {
    border-top: 2px solid var(--color-primary);
    padding-top: 1.5rem;
    margin-top: 2rem;
}

.export-section {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
}

@media (max-width: 768px) {
    .hero-content .btn-large {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .calculator-card {
        margin: 0 -15px;
    }
}
</style>

<?php get_footer(); ?>