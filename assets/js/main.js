/**
 * Bridgeland Advisors v2 - Main JavaScript
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        initNavbar();
        initContactForm();
        initCalculators();
        initAnimations();
        initServiceCards();
        initTestimonialCarousel();
    });

    // Navbar functionality
    function initNavbar() {
        // Navbar scroll effect
        $(window).scroll(function() {
            const navbar = $('.navbar');
            if ($(window).scrollTop() > 50) {
                navbar.addClass('navbar-scrolled');
            } else {
                navbar.removeClass('navbar-scrolled');
            }
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'easeInOutQuart');
            }
        });

        // Close mobile menu when clicking on a link
        $('.navbar-nav .nav-link').on('click', function() {
            $('.navbar-collapse').collapse('hide');
        });
    }

    // Contact form handling
    function initContactForm() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const formData = new FormData(this);
            const submitBtn = form.find('button[type="submit"]');
            const messagesDiv = $('#form-messages');

            // Add nonce for security
            formData.append('action', 'bridgeland_contact');
            formData.append('nonce', bridgeland_ajax.nonce);

            // Show loading state
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...').prop('disabled', true);
            messagesDiv.empty();

            // Submit via AJAX
            $.ajax({
                url: bridgeland_ajax.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        messagesDiv.html('<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>' + response.data + '</div>');
                        form[0].reset();

                        // Track conversion
                        if (typeof gtag !== 'undefined') {
                            gtag('event', 'form_submit', {
                                'form_name': 'contact_form'
                            });
                        }
                    } else {
                        messagesDiv.html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>' + response.data + '</div>');
                    }
                },
                error: function() {
                    messagesDiv.html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>An error occurred. Please try again.</div>');
                },
                complete: function() {
                    submitBtn.html('<i class="fas fa-paper-plane me-2"></i>Send Message').prop('disabled', false);
                }
            });
        });

        // Form field validation
        $('.form-control').on('blur', function() {
            validateField($(this));
        });

        // Real-time character count for textarea
        $('#message').on('input', function() {
            const maxLength = 1000;
            const currentLength = $(this).val().length;
            const remaining = maxLength - currentLength;

            let countDisplay = $(this).siblings('.char-count');
            if (countDisplay.length === 0) {
                countDisplay = $('<div class="char-count small text-muted mt-1"></div>');
                $(this).after(countDisplay);
            }

            countDisplay.text(remaining + ' characters remaining');

            if (remaining < 50) {
                countDisplay.removeClass('text-muted').addClass('text-warning');
            } else {
                countDisplay.removeClass('text-warning').addClass('text-muted');
            }
        });
    }

    // Field validation
    function validateField(field) {
        const value = field.val().trim();
        const fieldName = field.attr('name');
        let isValid = true;
        let message = '';

        // Remove existing validation feedback
        field.removeClass('is-valid is-invalid');
        field.siblings('.invalid-feedback, .valid-feedback').remove();

        if (field.prop('required') && !value) {
            isValid = false;
            message = 'This field is required.';
        } else if (fieldName === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address.';
            }
        } else if (fieldName === 'name' && value && value.length < 2) {
            isValid = false;
            message = 'Name must be at least 2 characters long.';
        }

        // Apply validation styling
        if (value) {
            if (isValid) {
                field.addClass('is-valid');
                field.after('<div class="valid-feedback">Looks good!</div>');
            } else {
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">' + message + '</div>');
            }
        }

        return isValid;
    }

    // Calculator functionality
    function initCalculators() {
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
        $('.calculator-input').on('input', function() {
            const calculator = $(this).closest('.calculator-container').data('calculator');
            if (calculator === 'vc-method') {
                calculateVCMethod();
            } else if (calculator === 'scorecard') {
                calculateScorecard();
            } else if (calculator === 'dcf') {
                calculateDCF();
            }
        });
    }

    // VC Method calculation
    function calculateVCMethod() {
        const exitValue = parseFloat($('#exit-value').val()) || 0;
        const timeToExit = parseFloat($('#time-to-exit').val()) || 5;
        const targetReturn = parseFloat($('#target-return').val()) || 10;
        const investment = parseFloat($('#investment-amount').val()) || 0;

        if (exitValue > 0 && investment > 0) {
            const requiredMultiple = Math.pow(targetReturn, timeToExit / 5);
            const requiredExitValue = investment * requiredMultiple;
            const ownershipRequired = (requiredExitValue / exitValue) * 100;
            const currentMultiple = exitValue / investment;

            $('#vc-results').html(`
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="card-title">Required Ownership</h6>
                                <h3 class="text-primary">${ownershipRequired.toFixed(2)}%</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h6 class="card-title">Current Multiple</h6>
                                <h3 class="text-success">${currentMultiple.toFixed(2)}x</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 p-3 bg-light rounded">
                    <p class="mb-1"><strong>Analysis:</strong></p>
                    <p class="mb-0">Based on a ${targetReturn}x target return over ${timeToExit} years,
                    the investor would need ${ownershipRequired.toFixed(2)}% ownership to achieve their target return.</p>
                </div>
            `).show();
        }
    }

    // Scorecard calculation
    function calculateScorecard() {
        const baseValuation = parseFloat($('#base-valuation').val()) || 0;
        const factors = {};
        let totalAdjustment = 0;

        $('.scorecard-factor').each(function() {
            const factor = $(this).data('factor');
            const rating = parseInt($(this).val()) || 0;
            const weight = parseFloat($(this).data('weight')) || 0;

            factors[factor] = rating;

            // Calculate adjustment (-50% to +50% based on rating 1-5)
            const adjustment = ((rating - 3) / 2) * weight;
            totalAdjustment += adjustment;
        });

        if (baseValuation > 0) {
            const adjustedValuation = baseValuation * (1 + totalAdjustment);
            const adjustmentPercent = totalAdjustment * 100;

            $('#scorecard-results').html(`
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <h6 class="card-title">Base Valuation</h6>
                                <h4 class="text-info">$${formatNumber(baseValuation)}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card ${adjustmentPercent >= 0 ? 'border-success' : 'border-warning'}">
                            <div class="card-body text-center">
                                <h6 class="card-title">Adjustment</h6>
                                <h4 class="${adjustmentPercent >= 0 ? 'text-success' : 'text-warning'}">
                                    ${adjustmentPercent >= 0 ? '+' : ''}${adjustmentPercent.toFixed(1)}%
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="card-title">Final Valuation</h6>
                                <h4 class="text-primary">$${formatNumber(adjustedValuation)}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            `).show();
        }
    }

    // DCF calculation
    function calculateDCF() {
        const initialCashFlow = parseFloat($('#initial-cash-flow').val()) || 0;
        const growthRate = parseFloat($('#growth-rate').val()) || 0;
        const discountRate = parseFloat($('#discount-rate').val()) || 0;
        const terminalGrowth = parseFloat($('#terminal-growth').val()) || 0;
        const years = parseInt($('#projection-years').val()) || 5;

        if (initialCashFlow > 0 && discountRate > 0) {
            let presentValue = 0;
            let cashFlows = [];

            // Calculate projected cash flows and present values
            for (let year = 1; year <= years; year++) {
                const cashFlow = initialCashFlow * Math.pow(1 + growthRate / 100, year);
                const pv = cashFlow / Math.pow(1 + discountRate / 100, year);
                presentValue += pv;
                cashFlows.push({ year, cashFlow, pv });
            }

            // Terminal value
            const terminalCashFlow = cashFlows[years - 1].cashFlow * (1 + terminalGrowth / 100);
            const terminalValue = terminalCashFlow / (discountRate / 100 - terminalGrowth / 100);
            const terminalPV = terminalValue / Math.pow(1 + discountRate / 100, years);

            const totalValue = presentValue + terminalPV;

            $('#dcf-results').html(`
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h6 class="card-title">PV of Cash Flows</h6>
                                <h4 class="text-success">$${formatNumber(presentValue)}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <h6 class="card-title">Terminal Value PV</h6>
                                <h4 class="text-info">$${formatNumber(terminalPV)}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="card-title">Total Enterprise Value</h6>
                                <h4 class="text-primary">$${formatNumber(totalValue)}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Cash Flow</th>
                                <th>Present Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${cashFlows.map(cf => `
                                <tr>
                                    <td>${cf.year}</td>
                                    <td>$${formatNumber(cf.cashFlow)}</td>
                                    <td>$${formatNumber(cf.pv)}</td>
                                </tr>
                            `).join('')}
                            <tr class="table-primary">
                                <td><strong>Terminal</strong></td>
                                <td>$${formatNumber(terminalValue)}</td>
                                <td>$${formatNumber(terminalPV)}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `).show();
        }
    }

    // Service cards hover effects
    function initServiceCards() {
        $('.service-card').hover(
            function() {
                $(this).addClass('shadow-lg').css('transform', 'translateY(-5px)');
            },
            function() {
                $(this).removeClass('shadow-lg').css('transform', 'translateY(0)');
            }
        );
    }

    // Testimonial carousel
    function initTestimonialCarousel() {
        if ($('.testimonial-carousel').length) {
            $('.testimonial-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                arrows: false,
                fade: true,
                adaptiveHeight: true
            });
        }
    }

    // Scroll animations
    function initAnimations() {
        // Intersection Observer for scroll animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe elements to animate
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        }

        // Number counter animation
        $('.counter').each(function() {
            const $this = $(this);
            const countTo = $this.attr('data-count');

            $({ countNum: $this.text() }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });
    }

    // Utility functions
    function formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'M';
        } else if (num >= 1000) {
            return (num / 1000).toFixed(1) + 'K';
        }
        return num.toLocaleString();
    }

    // Export to PDF functionality
    window.exportToPDF = function(elementId, filename) {
        const element = document.getElementById(elementId);
        const opt = {
            margin: 1,
            filename: filename + '.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    };

})(jQuery);