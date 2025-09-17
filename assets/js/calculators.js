/**
 * Advanced Calculator Functions for Bridgeland Advisors
 */

(function($) {
    'use strict';

    // Calculator state management
    const calculatorState = {
        currentCalculator: null,
        results: {},
        history: []
    };

    // Initialize calculators when document is ready
    $(document).ready(function() {
        initializeCalculators();
        setupExportFunctions();
        setupInputValidation();
        setupKeyboardShortcuts();
        setupCalculationHistory();
        setupInputPersistence();
        setupAdvancedFeatures();
        loadSavedInputs();
    });

    function initializeCalculators() {
        // VC Method Calculator
        $('#vc-method-form').on('submit', function(e) {
            e.preventDefault();
            calculateVCMethod();
        });

        // Scorecard Calculator
        $('#scorecard-form').on('submit', function(e) {
            e.preventDefault();
            calculateScorecard();
        });

        // DCF Calculator
        $('#dcf-form').on('submit', function(e) {
            e.preventDefault();
            calculateDCF();
        });

        // Real-time calculation updates
        $('.calculator-input').on('input', debounce(function() {
            const calculator = $(this).closest('.calculator-container').data('calculator');
            if (calculator && isFormValid(calculator)) {
                if (calculator === 'vc-method') {
                    calculateVCMethod();
                } else if (calculator === 'scorecard') {
                    calculateScorecard();
                } else if (calculator === 'dcf') {
                    calculateDCF();
                }
            }
        }, 500));

        // Scorecard factor changes
        $('.scorecard-factor').on('change', function() {
            if (isFormValid('scorecard')) {
                calculateScorecard();
            }
        });
    }

    // VC Method Calculation with Enhanced Features
    function calculateVCMethod() {
        const exitValue = parseFloat($('#exit-value').val()) || 0;
        const timeToExit = parseFloat($('#time-to-exit').val()) || 5;
        const targetReturn = parseFloat($('#target-return').val()) || 10;
        const investment = parseFloat($('#investment-amount').val()) || 0;

        if (exitValue <= 0 || investment <= 0 || targetReturn <= 0) {
            return;
        }

        // Enhanced calculations
        const annualizedReturn = Math.pow(targetReturn, 1/timeToExit) - 1;
        const requiredMultiple = Math.pow(1 + annualizedReturn, timeToExit);
        const requiredExitValue = investment * requiredMultiple;
        const ownershipRequired = (requiredExitValue / exitValue) * 100;
        const currentMultiple = exitValue / investment;
        const impliedValuation = investment / (ownershipRequired / 100) - investment;
        const preMoney = impliedValuation;

        // Sensitivity analysis
        const sensitivityData = generateSensitivityAnalysis('vc-method', {
            exitValue, timeToExit, targetReturn, investment
        });

        const results = {
            ownershipRequired: ownershipRequired,
            currentMultiple: currentMultiple,
            preMoney: preMoney,
            impliedValuation: impliedValuation,
            annualizedReturn: annualizedReturn * 100,
            requiredMultiple: requiredMultiple,
            sensitivity: sensitivityData
        };

        // Store results
        calculatorState.results['vc-method'] = results;
        calculatorState.currentCalculator = 'vc-method';

        // Display results
        displayVCResults(results);

        // Show export options
        $('.export-section').show();

        // Track analytics
        trackCalculation('vc-method', results);
    }

    function displayVCResults(results) {
        const resultsHtml = `
            <div class="results-header mb-4">
                <h5 class="text-primary">
                    <i class="fas fa-chart-bar me-2"></i>VC Method Analysis Results
                </h5>
                <p class="text-muted">Based on your inputs, here's the valuation analysis:</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="result-card card border-primary">
                        <div class="card-body text-center">
                            <h6 class="card-title text-primary">Required Ownership</h6>
                            <h3 class="text-primary">${results.ownershipRequired.toFixed(2)}%</h3>
                            <small class="text-muted">To achieve target return</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="result-card card border-success">
                        <div class="card-body text-center">
                            <h6 class="card-title text-success">Pre-Money Valuation</h6>
                            <h3 class="text-success">$${formatNumber(results.preMoney)}</h3>
                            <small class="text-muted">Implied company value</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="result-card card border-info">
                        <div class="card-body text-center">
                            <h6 class="card-title text-info">Current Multiple</h6>
                            <h3 class="text-info">${results.currentMultiple.toFixed(2)}x</h3>
                            <small class="text-muted">Exit value / Investment</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="result-card card border-warning">
                        <div class="card-body text-center">
                            <h6 class="card-title text-warning">Annualized Return</h6>
                            <h3 class="text-warning">${results.annualizedReturn.toFixed(1)}%</h3>
                            <small class="text-muted">IRR equivalent</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="analysis-box bg-light p-4 rounded mb-4">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-lightbulb me-2"></i>Analysis Summary
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <strong>Investment Impact:</strong> ${results.ownershipRequired > 50 ? 'High dilution required' : results.ownershipRequired > 25 ? 'Moderate dilution' : 'Low dilution required'}
                            </li>
                            <li class="mb-2">
                                <strong>Return Feasibility:</strong> ${results.currentMultiple >= results.requiredMultiple ? 'Target return achievable' : 'Target return challenging'}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <strong>Valuation Level:</strong> ${results.preMoney > 10 ? 'High valuation' : results.preMoney > 5 ? 'Moderate valuation' : 'Conservative valuation'}
                            </li>
                            <li class="mb-2">
                                <strong>Risk Assessment:</strong> ${results.annualizedReturn > 30 ? 'High risk/return' : results.annualizedReturn > 20 ? 'Moderate risk' : 'Conservative target'}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            ${generateSensitivityTable(results.sensitivity)}
        `;

        $('#vc-results').html(resultsHtml).show();
    }

    // Enhanced Scorecard Calculation
    function calculateScorecard() {
        const baseValuation = parseFloat($('#base-valuation').val()) || 0;
        const factors = {};
        let totalAdjustment = 0;
        let factorCount = 0;

        $('.scorecard-factor').each(function() {
            const factor = $(this).data('factor');
            const rating = parseInt($(this).val()) || 0;
            const weight = parseFloat($(this).data('weight')) || 0;

            if (rating > 0) {
                factors[factor] = { rating, weight };
                factorCount++;

                // Calculate adjustment (-50% to +50% based on rating 1-5)
                const adjustment = ((rating - 3) / 2) * weight;
                totalAdjustment += adjustment;
            }
        });

        if (baseValuation <= 0 || factorCount < 3) {
            return;
        }

        const adjustedValuation = baseValuation * (1 + totalAdjustment);
        const adjustmentPercent = totalAdjustment * 100;

        // Confidence score based on factor completion
        const completionRate = factorCount / 6;
        const confidenceScore = Math.min(completionRate * 100, 100);

        const results = {
            baseValuation: baseValuation,
            adjustedValuation: adjustedValuation,
            adjustmentPercent: adjustmentPercent,
            factors: factors,
            confidenceScore: confidenceScore,
            totalAdjustment: totalAdjustment
        };

        // Store results
        calculatorState.results['scorecard'] = results;
        calculatorState.currentCalculator = 'scorecard';

        // Display results
        displayScorecardResults(results);

        // Show export options
        $('.export-section').show();

        // Track analytics
        trackCalculation('scorecard', results);
    }

    function displayScorecardResults(results) {
        const resultsHtml = `
            <div class="results-header mb-4">
                <h5 class="text-primary">
                    <i class="fas fa-clipboard-check me-2"></i>Scorecard Valuation Results
                </h5>
                <p class="text-muted">Valuation based on comparative analysis across key factors:</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="result-card card border-info">
                        <div class="card-body text-center">
                            <h6 class="card-title text-info">Base Valuation</h6>
                            <h4 class="text-info">$${formatNumber(results.baseValuation)}</h4>
                            <small class="text-muted">Market average</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-card card ${results.adjustmentPercent >= 0 ? 'border-success' : 'border-warning'}">
                        <div class="card-body text-center">
                            <h6 class="card-title ${results.adjustmentPercent >= 0 ? 'text-success' : 'text-warning'}">Adjustment</h6>
                            <h4 class="${results.adjustmentPercent >= 0 ? 'text-success' : 'text-warning'}">
                                ${results.adjustmentPercent >= 0 ? '+' : ''}${results.adjustmentPercent.toFixed(1)}%
                            </h4>
                            <small class="text-muted">Factor-based</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-card card border-primary">
                        <div class="card-body text-center">
                            <h6 class="card-title text-primary">Final Valuation</h6>
                            <h4 class="text-primary">$${formatNumber(results.adjustedValuation)}</h4>
                            <small class="text-muted">Adjusted value</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="confidence-meter mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold">Confidence Score</span>
                    <span class="badge bg-primary">${results.confidenceScore.toFixed(0)}%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: ${results.confidenceScore}%"></div>
                </div>
                <small class="text-muted">Based on factor completion and rating consistency</small>
            </div>

            <div class="factors-breakdown mb-4">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-chart-pie me-2"></i>Factor Breakdown
                </h6>
                <div class="row g-2">
                    ${Object.entries(results.factors).map(([factor, data]) => `
                        <div class="col-md-6">
                            <div class="factor-result d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                <span class="small">${factor.replace(/_/g, ' ')}</span>
                                <div>
                                    <span class="badge bg-secondary">${data.rating}/5</span>
                                    <span class="small text-muted">(${(data.weight * 100).toFixed(0)}%)</span>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;

        $('#scorecard-results').html(resultsHtml).show();
    }

    // Enhanced DCF Calculation
    function calculateDCF() {
        const initialCashFlow = parseFloat($('#initial-cash-flow').val()) || 0;
        const growthRate = parseFloat($('#growth-rate').val()) || 0;
        const discountRate = parseFloat($('#discount-rate').val()) || 0;
        const terminalGrowth = parseFloat($('#terminal-growth').val()) || 0;
        const years = parseInt($('#projection-years').val()) || 5;

        if (initialCashFlow <= 0 || discountRate <= 0 || discountRate <= terminalGrowth) {
            return;
        }

        let presentValue = 0;
        let cashFlows = [];

        // Calculate projected cash flows and present values
        for (let year = 1; year <= years; year++) {
            const cashFlow = initialCashFlow * Math.pow(1 + growthRate / 100, year);
            const pv = cashFlow / Math.pow(1 + discountRate / 100, year);
            presentValue += pv;
            cashFlows.push({ year, cashFlow, pv });
        }

        // Terminal value calculation
        const terminalCashFlow = cashFlows[years - 1].cashFlow * (1 + terminalGrowth / 100);
        const terminalValue = terminalCashFlow / (discountRate / 100 - terminalGrowth / 100);
        const terminalPV = terminalValue / Math.pow(1 + discountRate / 100, years);

        const totalValue = presentValue + terminalPV;

        // Sensitivity analysis
        const sensitivityData = generateDCFSensitivity({
            initialCashFlow, growthRate, discountRate, terminalGrowth, years
        });

        const results = {
            presentValue: presentValue,
            terminalValue: terminalValue,
            terminalPV: terminalPV,
            totalValue: totalValue,
            cashFlows: cashFlows,
            terminalCashFlow: terminalCashFlow,
            sensitivity: sensitivityData,
            years: years
        };

        // Store results
        calculatorState.results['dcf'] = results;
        calculatorState.currentCalculator = 'dcf';

        // Display results
        displayDCFResults(results);

        // Show export options
        $('.export-section').show();

        // Track analytics
        trackCalculation('dcf', results);
    }

    function displayDCFResults(results) {
        const resultsHtml = `
            <div class="results-header mb-4">
                <h5 class="text-primary">
                    <i class="fas fa-chart-line me-2"></i>DCF Valuation Results
                </h5>
                <p class="text-muted">Enterprise value based on discounted cash flow analysis:</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="result-card card border-success">
                        <div class="card-body text-center">
                            <h6 class="card-title text-success">PV of Cash Flows</h6>
                            <h4 class="text-success">$${formatNumber(results.presentValue)}</h4>
                            <small class="text-muted">${results.years}-year projection</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-card card border-info">
                        <div class="card-body text-center">
                            <h6 class="card-title text-info">Terminal Value PV</h6>
                            <h4 class="text-info">$${formatNumber(results.terminalPV)}</h4>
                            <small class="text-muted">Residual value</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="result-card card border-primary">
                        <div class="card-body text-center">
                            <h6 class="card-title text-primary">Enterprise Value</h6>
                            <h4 class="text-primary">$${formatNumber(results.totalValue)}</h4>
                            <small class="text-muted">Total valuation</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="value-composition mb-4">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-pie-chart me-2"></i>Value Composition
                </h6>
                <div class="composition-chart">
                    <div class="d-flex align-items-center mb-2">
                        <div class="composition-bar bg-success" style="width: ${(results.presentValue / results.totalValue * 100)}%; height: 20px;"></div>
                        <div class="composition-bar bg-info" style="width: ${(results.terminalPV / results.totalValue * 100)}%; height: 20px;"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-muted">
                        <span>PV of Cash Flows: ${(results.presentValue / results.totalValue * 100).toFixed(1)}%</span>
                        <span>Terminal Value: ${(results.terminalPV / results.totalValue * 100).toFixed(1)}%</span>
                    </div>
                </div>
            </div>

            <div class="cash-flow-table mb-4">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-table me-2"></i>Cash Flow Projection
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>Year</th>
                                <th>Cash Flow</th>
                                <th>Present Value</th>
                                <th>Cumulative PV</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${results.cashFlows.map((cf, index) => {
                                const cumulativePV = results.cashFlows.slice(0, index + 1).reduce((sum, flow) => sum + flow.pv, 0);
                                return `
                                    <tr>
                                        <td>${cf.year}</td>
                                        <td>$${formatNumber(cf.cashFlow)}</td>
                                        <td>$${formatNumber(cf.pv)}</td>
                                        <td>$${formatNumber(cumulativePV)}</td>
                                    </tr>
                                `;
                            }).join('')}
                            <tr class="table-warning">
                                <td><strong>Terminal</strong></td>
                                <td>$${formatNumber(results.terminalValue)}</td>
                                <td>$${formatNumber(results.terminalPV)}</td>
                                <td>$${formatNumber(results.totalValue)}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            ${generateDCFSensitivityTable(results.sensitivity)}
        `;

        $('#dcf-results').html(resultsHtml).show();
    }

    // Utility Functions
    function formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'M';
        } else if (num >= 1000) {
            return (num / 1000).toFixed(1) + 'K';
        }
        return num.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }

    function generateSensitivityAnalysis(type, params) {
        // Generate sensitivity analysis data
        const scenarios = ['Conservative', 'Base Case', 'Optimistic'];
        const adjustments = [-0.2, 0, 0.2]; // -20%, 0%, +20%

        return scenarios.map((scenario, index) => {
            const adj = adjustments[index];
            if (type === 'vc-method') {
                const adjustedExit = params.exitValue * (1 + adj);
                const ownership = (params.investment * params.targetReturn / adjustedExit) * 100;
                return {
                    scenario,
                    exitValue: adjustedExit,
                    ownership: ownership,
                    preMoney: params.investment / (ownership / 100) - params.investment
                };
            }
            return { scenario };
        });
    }

    function generateSensitivityTable(data) {
        if (!data || data.length === 0) return '';

        return `
            <div class="sensitivity-analysis mb-4">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-chart-area me-2"></i>Sensitivity Analysis
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Scenario</th>
                                <th>Exit Value</th>
                                <th>Ownership Required</th>
                                <th>Pre-Money</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.map(item => `
                                <tr>
                                    <td>${item.scenario}</td>
                                    <td>$${formatNumber(item.exitValue)}</td>
                                    <td>${item.ownership.toFixed(1)}%</td>
                                    <td>$${formatNumber(item.preMoney)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    }

    function generateDCFSensitivity(params) {
        const discountRates = [params.discountRate - 2, params.discountRate, params.discountRate + 2];
        const growthRates = [params.growthRate - 5, params.growthRate, params.growthRate + 5];

        return {
            discountRates,
            growthRates,
            // Matrix would be calculated here for a full sensitivity table
        };
    }

    function generateDCFSensitivityTable(data) {
        return `
            <div class="sensitivity-analysis">
                <h6 class="text-primary mb-3">
                    <i class="fas fa-chart-area me-2"></i>Sensitivity Ranges
                </h6>
                <p class="small text-muted">
                    Valuation ranges based on ±2% discount rate and ±5% growth rate variations.
                    Professional analysis would include complete sensitivity matrices.
                </p>
            </div>
        `;
    }

    function isFormValid(calculator) {
        let isValid = true;
        const form = $(`#${calculator}-form`);

        form.find('input[required], select[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                return false;
            }
        });

        return isValid;
    }

    function setupInputValidation() {
        $('.calculator-input').on('blur', function() {
            const value = parseFloat($(this).val());
            const min = parseFloat($(this).attr('min'));
            const max = parseFloat($(this).attr('max'));

            $(this).removeClass('is-invalid is-valid');

            if ($(this).val() && !isNaN(value)) {
                if ((min !== undefined && value < min) || (max !== undefined && value > max)) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).addClass('is-valid');
                }
            }
        });
    }

    function setupExportFunctions() {
        // Enhanced PDF Export with Fallback
        window.exportToPDF = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to export. Please run a calculation first.');
                return;
            }

            // Check for html2pdf library
            if (typeof html2pdf !== 'undefined') {
                const elementId = `${calculatorType}-results`;
                const element = document.getElementById(elementId);

                if (!element) {
                    alert('Results not found. Please ensure calculations are complete.');
                    return;
                }

                const opt = {
                    margin: [0.5, 0.5, 0.5, 0.5],
                    filename: `bridgeland-${calculatorType}-analysis-${getDateString()}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        backgroundColor: '#ffffff'
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait',
                        compress: true
                    }
                };

                // Add header with company branding
                const headerElement = createPDFHeader(calculatorType);
                element.insertBefore(headerElement, element.firstChild);

                html2pdf().set(opt).from(element).save().then(() => {
                    element.removeChild(headerElement);
                });
            } else {
                // Fallback: Generate detailed text report
                generateTextReport(calculatorType);
            }
        };

        // Excel Export Functionality
        window.exportToExcel = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to export. Please run a calculation first.');
                return;
            }

            if (typeof XLSX !== 'undefined') {
                const workbook = createExcelWorkbook(calculatorType, results);
                const filename = `bridgeland-${calculatorType}-analysis-${getDateString()}.xlsx`;
                XLSX.writeFile(workbook, filename);
            } else {
                // Fallback: Generate CSV
                generateCSVExport(calculatorType, results);
            }
        };

        // Email Report Functionality
        window.emailReport = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to email. Please run a calculation first.');
                return;
            }

            const emailBody = generateEmailReport(calculatorType, results);
            const subject = `Bridgeland Advisors - ${getCalculatorDisplayName(calculatorType)} Analysis`;
            const mailtoLink = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(emailBody)}`;

            window.open(mailtoLink);
        };

        // Print Functionality
        window.printReport = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to print. Please run a calculation first.');
                return;
            }

            const printWindow = window.open('', '_blank');
            const printContent = generatePrintableReport(calculatorType, results);

            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };

        // Sharing System Implementation
        window.shareResults = function(calculatorType, platform) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to share. Please run a calculation first.');
                return;
            }

            const shareData = generateShareData(calculatorType, results);

            if (platform === 'linkedin') {
                shareToLinkedIn(shareData);
            } else if (platform === 'twitter') {
                shareToTwitter(shareData);
            } else if (platform === 'email') {
                shareViaEmail(shareData);
            } else if (platform === 'link') {
                copyShareableLink(calculatorType, results);
            } else if (platform === 'whatsapp') {
                shareToWhatsApp(shareData);
            }
        };

        // Collaboration Features
        window.requestReview = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to review. Please run a calculation first.');
                return;
            }

            showCollaborationModal(calculatorType, results);
        };

        // Generate shareable link
        window.generateShareableLink = function(calculatorType) {
            const results = calculatorState.results[calculatorType];
            if (!results) {
                alert('No calculation results to share. Please run a calculation first.');
                return;
            }

            // In production, this would create a unique link with calculation data
            const shareableData = {
                type: calculatorType,
                timestamp: new Date().toISOString(),
                results: results,
                id: generateUniqueId()
            };

            // Simulate creating a shareable link
            const shareUrl = `https://www.bridgeland-advisors.com/shared-calculation/${shareableData.id}`;

            copyToClipboard(shareUrl);
            showToast('Shareable link copied to clipboard!', 'success');

            return shareUrl;
        };
    }

    function createPDFHeader(calculatorType) {
        const header = document.createElement('div');
        header.className = 'pdf-header';
        header.style.cssText = `
            background: #8B1A1A;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 8px;
        `;

        header.innerHTML = `
            <h2 style="margin: 0; font-size: 24px;">Bridgeland Advisors</h2>
            <p style="margin: 5px 0 0 0; font-size: 16px;">${getCalculatorDisplayName(calculatorType)} Analysis Report</p>
            <p style="margin: 5px 0 0 0; font-size: 14px; opacity: 0.9;">Generated on ${new Date().toLocaleDateString()}</p>
        `;

        return header;
    }

    function createExcelWorkbook(calculatorType, results) {
        const wb = XLSX.utils.book_new();

        // Summary Sheet
        const summaryData = generateExcelSummaryData(calculatorType, results);
        const summaryWS = XLSX.utils.aoa_to_sheet(summaryData);
        XLSX.utils.book_append_sheet(wb, summaryWS, 'Summary');

        // Detailed Data Sheet
        if (calculatorType === 'dcf' && results.cashFlows) {
            const detailData = generateDCFDetailData(results);
            const detailWS = XLSX.utils.aoa_to_sheet(detailData);
            XLSX.utils.book_append_sheet(wb, detailWS, 'Cash Flow Projections');
        }

        // Sensitivity Analysis Sheet
        if (results.sensitivity) {
            const sensitivityData = generateSensitivityExcelData(calculatorType, results);
            const sensitivityWS = XLSX.utils.aoa_to_sheet(sensitivityData);
            XLSX.utils.book_append_sheet(wb, sensitivityWS, 'Sensitivity Analysis');
        }

        return wb;
    }

    function generateExcelSummaryData(calculatorType, results) {
        const data = [
            ['Bridgeland Advisors - ' + getCalculatorDisplayName(calculatorType) + ' Analysis'],
            ['Generated:', new Date().toLocaleString()],
            [''],
            ['Key Results:']
        ];

        if (calculatorType === 'vc-method') {
            data.push(
                ['Required Ownership:', results.ownershipRequired.toFixed(2) + '%'],
                ['Pre-Money Valuation:', '$' + formatNumber(results.preMoney)],
                ['Current Multiple:', results.currentMultiple.toFixed(2) + 'x'],
                ['Annualized Return:', results.annualizedReturn.toFixed(1) + '%']
            );
        } else if (calculatorType === 'scorecard') {
            data.push(
                ['Base Valuation:', '$' + formatNumber(results.baseValuation)],
                ['Adjustment:', (results.adjustmentPercent >= 0 ? '+' : '') + results.adjustmentPercent.toFixed(1) + '%'],
                ['Final Valuation:', '$' + formatNumber(results.adjustedValuation)],
                ['Confidence Score:', results.confidenceScore.toFixed(0) + '%']
            );
        } else if (calculatorType === 'dcf') {
            data.push(
                ['PV of Cash Flows:', '$' + formatNumber(results.presentValue)],
                ['Terminal Value PV:', '$' + formatNumber(results.terminalPV)],
                ['Enterprise Value:', '$' + formatNumber(results.totalValue)],
                ['Terminal % of Value:', (results.terminalPV / results.totalValue * 100).toFixed(1) + '%']
            );
        }

        return data;
    }

    function generateDCFDetailData(results) {
        const data = [
            ['Cash Flow Projections'],
            [''],
            ['Year', 'Cash Flow', 'Present Value', 'Cumulative PV']
        ];

        results.cashFlows.forEach((cf, index) => {
            const cumulativePV = results.cashFlows.slice(0, index + 1).reduce((sum, flow) => sum + flow.pv, 0);
            data.push([
                cf.year,
                cf.cashFlow,
                cf.pv,
                cumulativePV
            ]);
        });

        data.push(
            ['Terminal Value', results.terminalValue, results.terminalPV, results.totalValue]
        );

        return data;
    }

    function generateSensitivityExcelData(calculatorType, results) {
        const data = [
            ['Sensitivity Analysis'],
            ['']
        ];

        if (calculatorType === 'vc-method' && results.sensitivity) {
            data.push(['Scenario', 'Exit Value', 'Ownership Required', 'Pre-Money']);
            results.sensitivity.forEach(item => {
                data.push([
                    item.scenario,
                    item.exitValue,
                    item.ownership.toFixed(1) + '%',
                    item.preMoney
                ]);
            });
        }

        return data;
    }

    function generateCSVExport(calculatorType, results) {
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Bridgeland Advisors - " + getCalculatorDisplayName(calculatorType) + " Analysis\n";
        csvContent += "Generated: " + new Date().toLocaleString() + "\n\n";

        if (calculatorType === 'vc-method') {
            csvContent += "Metric,Value\n";
            csvContent += "Required Ownership," + results.ownershipRequired.toFixed(2) + "%\n";
            csvContent += "Pre-Money Valuation,$" + formatNumber(results.preMoney) + "\n";
            csvContent += "Current Multiple," + results.currentMultiple.toFixed(2) + "x\n";
            csvContent += "Annualized Return," + results.annualizedReturn.toFixed(1) + "%\n";
        }

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `bridgeland-${calculatorType}-analysis-${getDateString()}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function generateTextReport(calculatorType) {
        const results = calculatorState.results[calculatorType];
        let report = generateDetailedTextReport(calculatorType, results);

        // Create downloadable text file
        const blob = new Blob([report], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `bridgeland-${calculatorType}-report-${getDateString()}.txt`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
    }

    function generateDetailedTextReport(calculatorType, results) {
        let report = `BRIDGELAND ADVISORS
${getCalculatorDisplayName(calculatorType).toUpperCase()} ANALYSIS REPORT
Generated: ${new Date().toLocaleString()}

${'='.repeat(60)}

`;

        if (calculatorType === 'vc-method') {
            report += `VENTURE CAPITAL METHOD ANALYSIS

Key Results:
• Required Ownership: ${results.ownershipRequired.toFixed(2)}%
• Pre-Money Valuation: $${formatNumber(results.preMoney)}
• Current Multiple: ${results.currentMultiple.toFixed(2)}x
• Annualized Return: ${results.annualizedReturn.toFixed(1)}%

Analysis:
• Investment Impact: ${results.ownershipRequired > 50 ? 'High dilution required' : results.ownershipRequired > 25 ? 'Moderate dilution' : 'Low dilution required'}
• Return Feasibility: ${results.currentMultiple >= results.requiredMultiple ? 'Target return achievable' : 'Target return challenging'}
• Valuation Level: ${results.preMoney > 10 ? 'High valuation' : results.preMoney > 5 ? 'Moderate valuation' : 'Conservative valuation'}
• Risk Assessment: ${results.annualizedReturn > 30 ? 'High risk/return' : results.annualizedReturn > 20 ? 'Moderate risk' : 'Conservative target'}
`;
        }

        report += `

${'='.repeat(60)}

This analysis was prepared by Bridgeland Advisors using industry-standard
valuation methodologies. Results are based on the inputs provided and
should be considered preliminary estimates. For comprehensive valuation
and investment advisory services, please contact Bridgeland Advisors.

Contact: info@bridgeland-advisors.com
Website: www.bridgeland-advisors.com
`;

        return report;
    }

    function generateEmailReport(calculatorType, results) {
        return `Dear Colleague,

Please find attached the ${getCalculatorDisplayName(calculatorType)} analysis results generated using Bridgeland Advisors' professional valuation calculators.

Key Highlights:
${getEmailSummary(calculatorType, results)}

This preliminary analysis was generated on ${new Date().toLocaleDateString()} using our interactive valuation tools. For comprehensive valuation services and detailed analysis, please contact Bridgeland Advisors.

Best regards,
Bridgeland Advisors Team

---
Contact Information:
Email: info@bridgeland-advisors.com
Website: www.bridgeland-advisors.com
Phone: (555) 123-4567

Disclaimer: This analysis is for informational purposes only and should not be considered as investment advice. Professional valuation services are recommended for formal valuations.`;
    }

    function generatePrintableReport(calculatorType, results) {
        return `<!DOCTYPE html>
<html>
<head>
    <title>Bridgeland Advisors - ${getCalculatorDisplayName(calculatorType)} Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        .header { background: #8B1A1A; color: white; padding: 20px; text-align: center; margin-bottom: 30px; }
        .results { margin: 20px 0; }
        .metric { display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #eee; }
        .metric strong { color: #8B1A1A; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bridgeland Advisors</h1>
        <h2>${getCalculatorDisplayName(calculatorType)} Analysis</h2>
        <p>Generated: ${new Date().toLocaleString()}</p>
    </div>
    <div class="results">
        ${getPrintableResults(calculatorType, results)}
    </div>
    <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #8B1A1A; font-size: 12px; color: #666;">
        <p><strong>Bridgeland Advisors</strong> | Professional Valuation Services</p>
        <p>Contact: info@bridgeland-advisors.com | www.bridgeland-advisors.com</p>
        <p><em>This analysis is preliminary and for informational purposes only.</em></p>
    </div>
</body>
</html>`;
    }

    function getEmailSummary(calculatorType, results) {
        if (calculatorType === 'vc-method') {
            return `• Required Ownership: ${results.ownershipRequired.toFixed(2)}%
• Pre-Money Valuation: $${formatNumber(results.preMoney)}
• Investment Multiple: ${results.currentMultiple.toFixed(2)}x`;
        }
        // Add other calculator summaries as needed
        return 'Analysis complete - see full report for details.';
    }

    function getPrintableResults(calculatorType, results) {
        if (calculatorType === 'vc-method') {
            return `
                <div class="metric"><span><strong>Required Ownership</strong></span><span>${results.ownershipRequired.toFixed(2)}%</span></div>
                <div class="metric"><span><strong>Pre-Money Valuation</strong></span><span>$${formatNumber(results.preMoney)}</span></div>
                <div class="metric"><span><strong>Current Multiple</strong></span><span>${results.currentMultiple.toFixed(2)}x</span></div>
                <div class="metric"><span><strong>Annualized Return</strong></span><span>${results.annualizedReturn.toFixed(1)}%</span></div>
            `;
        }
        return '<p>Results not available for printing.</p>';
    }

    function getCalculatorDisplayName(calculatorType) {
        const names = {
            'vc-method': 'VC Method Valuation',
            'scorecard': 'Scorecard Valuation',
            'dcf': 'DCF Valuation'
        };
        return names[calculatorType] || 'Valuation';
    }

    function getDateString() {
        return new Date().toISOString().split('T')[0];
    }

    function setupKeyboardShortcuts() {
        $(document).on('keydown', function(e) {
            // Ctrl/Cmd + Enter to calculate
            if ((e.ctrlKey || e.metaKey) && e.which === 13) {
                const activeCalculator = $('.calculator-container:visible');
                if (activeCalculator.length) {
                    activeCalculator.find('form').submit();
                }
            }

            // Escape to close calculator
            if (e.which === 27) {
                if ($('.calculator-container:visible').length) {
                    hideCalculators();
                }
            }
        });
    }

    function trackCalculation(type, results) {
        // Analytics tracking would be implemented here
        if (typeof gtag !== 'undefined') {
            gtag('event', 'calculator_use', {
                'calculator_type': type,
                'result_value': results.totalValue || results.adjustedValuation || results.preMoney || 0
            });
        }

        // Store in calculation history
        calculatorState.history.push({
            type: type,
            timestamp: new Date(),
            results: results
        });

        // Limit history to last 10 calculations
        if (calculatorState.history.length > 10) {
            calculatorState.history = calculatorState.history.slice(-10);
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Advanced Features Implementation
    function setupCalculationHistory() {
        // Create history panel if it doesn't exist
        if (!$('#calculation-history').length) {
            const historyPanel = `
                <div id="calculation-history" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">
                                    <i class="fas fa-history me-2"></i>Calculation History
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div id="history-content">
                                    <p class="text-muted text-center">No calculations yet.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" onclick="clearCalculationHistory()">
                                    <i class="fas fa-trash me-2"></i>Clear History
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(historyPanel);
        }

        // Add history button to each calculator
        $('.calculator-card .card-header').each(function() {
            if (!$(this).find('.history-btn').length) {
                $(this).find('.d-flex').append(`
                    <button type="button" class="btn btn-outline-light btn-sm history-btn" onclick="showCalculationHistory()">
                        <i class="fas fa-history"></i>
                    </button>
                `);
            }
        });
    }

    function setupInputPersistence() {
        // Save inputs to localStorage as user types
        $('.calculator-input').on('input change', function() {
            const calculatorType = $(this).closest('.calculator-container').data('calculator');
            const inputId = $(this).attr('id');
            const value = $(this).val();

            if (calculatorType && inputId) {
                localStorage.setItem(`bridgeland_${calculatorType}_${inputId}`, value);
            }
        });

        // Auto-save feature notification
        let saveTimeout;
        $('.calculator-input').on('input', function() {
            clearTimeout(saveTimeout);
            showAutoSaveIndicator();
            saveTimeout = setTimeout(hideAutoSaveIndicator, 2000);
        });
    }

    function setupAdvancedFeatures() {
        // Add tooltips for better UX
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Add input formatting
        $('.currency-input').on('blur', function() {
            let value = parseFloat($(this).val().replace(/[^0-9.-]+/g, ''));
            if (!isNaN(value)) {
                $(this).val(value.toLocaleString());
            }
        });

        $('.currency-input').on('focus', function() {
            let value = $(this).val().replace(/[^0-9.-]+/g, '');
            $(this).val(value);
        });

        // Add percentage input formatting
        $('.percentage-input').on('blur', function() {
            let value = parseFloat($(this).val());
            if (!isNaN(value) && value <= 1 && value > 0) {
                $(this).val((value * 100).toFixed(1));
            }
        });

        // Add comparison feature
        addComparisonFeature();

        // Add quick calculation presets
        addCalculationPresets();

        // Add scenario builder
        addScenarioBuilder();
    }

    function loadSavedInputs() {
        // Restore saved inputs from localStorage
        $('.calculator-input').each(function() {
            const calculatorType = $(this).closest('.calculator-container').data('calculator');
            const inputId = $(this).attr('id');

            if (calculatorType && inputId) {
                const savedValue = localStorage.getItem(`bridgeland_${calculatorType}_${inputId}`);
                if (savedValue) {
                    $(this).val(savedValue);
                }
            }
        });
    }

    function showCalculationHistory() {
        updateHistoryDisplay();
        $('#calculation-history').modal('show');
    }

    function updateHistoryDisplay() {
        const historyContent = $('#history-content');

        if (calculatorState.history.length === 0) {
            historyContent.html('<p class="text-muted text-center">No calculations yet.</p>');
            return;
        }

        let historyHtml = '<div class="list-group">';
        calculatorState.history.slice().reverse().forEach((item, index) => {
            const displayName = getCalculatorDisplayName(item.type);
            const timestamp = new Date(item.timestamp).toLocaleString();
            let summary = '';

            if (item.type === 'vc-method') {
                summary = `Ownership: ${item.results.ownershipRequired.toFixed(1)}%, Pre-Money: $${formatNumber(item.results.preMoney)}`;
            } else if (item.type === 'scorecard') {
                summary = `Final Valuation: $${formatNumber(item.results.adjustedValuation)}, Confidence: ${item.results.confidenceScore.toFixed(0)}%`;
            } else if (item.type === 'dcf') {
                summary = `Enterprise Value: $${formatNumber(item.results.totalValue)}`;
            }

            historyHtml += `
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">${displayName}</h6>
                            <p class="mb-1 small">${summary}</p>
                            <small class="text-muted">${timestamp}</small>
                        </div>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" onclick="loadHistoryItem(${calculatorState.history.length - 1 - index})">
                                <i class="fas fa-redo"></i> Load
                            </button>
                            <button class="btn btn-outline-success" onclick="exportHistoryItem(${calculatorState.history.length - 1 - index})">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        historyHtml += '</div>';

        historyContent.html(historyHtml);
    }

    function clearCalculationHistory() {
        if (confirm('Are you sure you want to clear all calculation history?')) {
            calculatorState.history = [];
            localStorage.removeItem('bridgeland_calculation_history');
            updateHistoryDisplay();
        }
    }

    function loadHistoryItem(index) {
        const item = calculatorState.history[index];
        if (!item) return;

        // Load the calculator
        showCalculator(item.type);

        // Note: In a production environment, you would restore all input values here
        // This would require storing input values in the history item
        setTimeout(() => {
            alert(`Loading ${getCalculatorDisplayName(item.type)} calculation from ${new Date(item.timestamp).toLocaleString()}`);
        }, 500);
    }

    function exportHistoryItem(index) {
        const item = calculatorState.history[index];
        if (!item) return;

        calculatorState.results[item.type] = item.results;
        exportToPDF(item.type);
    }

    function addComparisonFeature() {
        // Add comparison capability between different calculations
        if (!$('#comparison-tool').length) {
            const comparisonTool = `
                <div id="comparison-tool" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">
                                    <i class="fas fa-balance-scale me-2"></i>Valuation Comparison
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div id="comparison-content">
                                    <p class="text-muted text-center">Run multiple calculations to compare results.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(comparisonTool);
        }
    }

    function addCalculationPresets() {
        // Add common preset scenarios for quick calculations
        $('.calculator-container').each(function() {
            const calculatorType = $(this).data('calculator');
            if (!$(this).find('.presets-section').length) {
                let presets = '';

                if (calculatorType === 'vc-method') {
                    presets = `
                        <div class="presets-section mb-3">
                            <label class="form-label small text-muted">Quick Presets:</label>
                            <div class="btn-group btn-group-sm w-100" role="group">
                                <button type="button" class="btn btn-outline-secondary" onclick="loadPreset('vc-method', 'startup')">Early Startup</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="loadPreset('vc-method', 'growth')">Growth Stage</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="loadPreset('vc-method', 'late')">Late Stage</button>
                            </div>
                        </div>
                    `;
                }

                $(this).find('form').prepend(presets);
            }
        });
    }

    function addScenarioBuilder() {
        // Add scenario planning capabilities
        $('.export-section').each(function() {
            if (!$(this).find('.scenario-btn').length) {
                $(this).find('.d-flex').append(`
                    <button class="btn btn-outline-warning scenario-btn" onclick="openScenarioBuilder()">
                        <i class="fas fa-chart-line me-2"></i>Scenarios
                    </button>
                `);
            }
        });
    }

    function loadPreset(calculatorType, presetType) {
        const presets = {
            'vc-method': {
                'startup': { exitValue: 50000000, timeToExit: 7, targetReturn: 10, investment: 2000000 },
                'growth': { exitValue: 200000000, timeToExit: 5, targetReturn: 5, investment: 10000000 },
                'late': { exitValue: 1000000000, timeToExit: 3, targetReturn: 3, investment: 50000000 }
            }
        };

        const preset = presets[calculatorType]?.[presetType];
        if (preset) {
            Object.entries(preset).forEach(([key, value]) => {
                const inputId = key === 'exitValue' ? 'exit-value' :
                               key === 'timeToExit' ? 'time-to-exit' :
                               key === 'targetReturn' ? 'target-return' :
                               key === 'investment' ? 'investment-amount' : key;
                $(`#${inputId}`).val(value);
            });

            showToast(`Loaded ${presetType} preset values`, 'success');
        }
    }

    function openScenarioBuilder() {
        showToast('Scenario builder would open here - advanced feature for sensitivity analysis', 'info');
    }

    function showAutoSaveIndicator() {
        if (!$('#auto-save-indicator').length) {
            $('body').append(`
                <div id="auto-save-indicator" class="position-fixed bottom-0 end-0 m-3 alert alert-success alert-dismissible fade show" style="z-index: 9999;">
                    <i class="fas fa-save me-2"></i>Inputs auto-saved
                </div>
            `);
        }
    }

    function hideAutoSaveIndicator() {
        $('#auto-save-indicator').fadeOut(function() {
            $(this).remove();
        });
    }

    function showToast(message, type = 'info') {
        const toastId = 'toast-' + Date.now();
        const toast = `
            <div id="${toastId}" class="toast position-fixed top-0 end-0 m-3" style="z-index: 9999;" role="alert">
                <div class="toast-header bg-${type} text-white">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong class="me-auto">Bridgeland Calculators</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">${message}</div>
            </div>
        `;

        $('body').append(toast);
        const toastElement = new bootstrap.Toast(document.getElementById(toastId));
        toastElement.show();

        // Remove toast element after it's hidden
        setTimeout(() => {
            $(`#${toastId}`).remove();
        }, 5000);
    }

    // Enhanced calculation persistence
    function saveCalculationHistory() {
        localStorage.setItem('bridgeland_calculation_history', JSON.stringify(calculatorState.history));
    }

    function loadCalculationHistory() {
        const saved = localStorage.getItem('bridgeland_calculation_history');
        if (saved) {
            try {
                calculatorState.history = JSON.parse(saved);
            } catch (e) {
                console.warn('Could not load calculation history:', e);
            }
        }
    }

    // Override the original trackCalculation function to include persistence
    const originalTrackCalculation = trackCalculation;
    trackCalculation = function(type, results) {
        originalTrackCalculation(type, results);
        saveCalculationHistory();
    };

    // Sharing System Supporting Functions
    function generateShareData(calculatorType, results) {
        const displayName = getCalculatorDisplayName(calculatorType);
        let summary = '';
        let hashtags = '#valuation #finance #bridgelandadvisors';

        if (calculatorType === 'vc-method') {
            summary = `VC Method Analysis: ${results.ownershipRequired.toFixed(1)}% ownership required, $${formatNumber(results.preMoney)} pre-money valuation`;
            hashtags += ' #venturecapital #startups';
        } else if (calculatorType === 'scorecard') {
            summary = `Scorecard Valuation: $${formatNumber(results.adjustedValuation)} final valuation with ${results.confidenceScore.toFixed(0)}% confidence`;
            hashtags += ' #scorecardmethod #businessvaluation';
        } else if (calculatorType === 'dcf') {
            summary = `DCF Analysis: $${formatNumber(results.totalValue)} enterprise value`;
            hashtags += ' #dcf #cashflow #enterprisevalue';
        }

        return {
            title: `${displayName} Results`,
            summary: summary,
            hashtags: hashtags,
            url: window.location.href,
            calculatorType: calculatorType
        };
    }

    function shareToLinkedIn(shareData) {
        const text = `Just completed a ${shareData.title} using Bridgeland Advisors' professional calculators.\\n\\n${shareData.summary}\\n\\nCheck out their valuation tools: ${shareData.url} ${shareData.hashtags}`;
        const linkedInUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareData.url)}&title=${encodeURIComponent(shareData.title)}&summary=${encodeURIComponent(text)}`;

        window.open(linkedInUrl, '_blank', 'width=600,height=400');
    }

    function shareToTwitter(shareData) {
        const text = `${shareData.summary}\\n\\nGenerated using @BridgelandAdvisors professional valuation calculators ${shareData.hashtags}`;
        const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(shareData.url)}`;

        window.open(twitterUrl, '_blank', 'width=600,height=400');
    }

    function shareViaEmail(shareData) {
        const subject = `${shareData.title} - Bridgeland Advisors`;
        const body = `Hi,\\n\\nI wanted to share some valuation analysis results with you:\\n\\n${shareData.summary}\\n\\nThis analysis was generated using Bridgeland Advisors' professional valuation calculators. You can view the tools here: ${shareData.url}\\n\\nBest regards`;

        const mailtoUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.open(mailtoUrl);
    }

    function shareToWhatsApp(shareData) {
        const text = `${shareData.title}\\n\\n${shareData.summary}\\n\\nGenerated using Bridgeland Advisors: ${shareData.url}`;
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;

        window.open(whatsappUrl, '_blank');
    }

    function copyShareableLink(calculatorType, results) {
        const shareUrl = generateShareableLink(calculatorType);
        return shareUrl;
    }

    function showCollaborationModal(calculatorType, results) {
        const modalId = 'collaboration-modal';

        if (!$(`#${modalId}`).length) {
            const modal = `
                <div id="${modalId}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-dark">
                                <h5 class="modal-title">
                                    <i class="fas fa-users me-2"></i>Request Professional Review
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Get professional review and validation of your valuation analysis from Bridgeland Advisors' experts.</p>
                                <form id="collaboration-form">
                                    <div class="mb-3">
                                        <label class="form-label">Your Name</label>
                                        <input type="text" class="form-control" id="collab-name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="collab-email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company/Organization</label>
                                        <input type="text" class="form-control" id="collab-company">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Additional Notes</label>
                                        <textarea class="form-control" id="collab-notes" rows="3" placeholder="Any specific questions or areas you'd like us to focus on..."></textarea>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="collab-consent" required>
                                        <label class="form-check-label" for="collab-consent">
                                            I consent to sharing my calculation data with Bridgeland Advisors for professional review
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-warning" onclick="submitCollaborationRequest('${calculatorType}')">
                                    <i class="fas fa-paper-plane me-2"></i>Request Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(modal);
        }

        $(`#${modalId}`).modal('show');
    }

    function submitCollaborationRequest(calculatorType) {
        const form = $('#collaboration-form');
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        const requestData = {
            calculatorType: calculatorType,
            results: calculatorState.results[calculatorType],
            contact: {
                name: $('#collab-name').val(),
                email: $('#collab-email').val(),
                company: $('#collab-company').val(),
                notes: $('#collab-notes').val()
            },
            timestamp: new Date().toISOString()
        };

        // In production, this would send data to server
        console.log('Collaboration request:', requestData);

        $('#collaboration-modal').modal('hide');
        showToast('Review request submitted! We\\'ll contact you within 24 hours.', 'success');

        // Create follow-up email
        const subject = `Professional Review Request - ${getCalculatorDisplayName(calculatorType)}`;
        const body = `Dear Bridgeland Advisors Team,\\n\\nI would like to request a professional review of my ${getCalculatorDisplayName(calculatorType)} analysis.\\n\\nContact Details:\\nName: ${requestData.contact.name}\\nEmail: ${requestData.contact.email}\\nCompany: ${requestData.contact.company}\\n\\nAdditional Notes:\\n${requestData.contact.notes}\\n\\nPlease contact me to schedule a consultation.\\n\\nBest regards,\\n${requestData.contact.name}`;

        const mailtoUrl = `mailto:info@bridgeland-advisors.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.open(mailtoUrl);
    }

    function generateUniqueId() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    function copyToClipboard(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text);
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            document.execCommand('copy');
            textArea.remove();
        }
    }

    // Load history on initialization
    loadCalculationHistory();

    // Make functions globally available
    window.calculatorState = calculatorState;
    window.hideCalculators = hideCalculators;
    window.showCalculator = showCalculator;
    window.showCalculationHistory = showCalculationHistory;
    window.clearCalculationHistory = clearCalculationHistory;
    window.loadHistoryItem = loadHistoryItem;
    window.exportHistoryItem = exportHistoryItem;
    window.loadPreset = loadPreset;
    window.openScenarioBuilder = openScenarioBuilder;
    window.shareResults = shareResults;
    window.requestReview = requestReview;
    window.generateShareableLink = generateShareableLink;
    window.submitCollaborationRequest = submitCollaborationRequest;

})(jQuery);