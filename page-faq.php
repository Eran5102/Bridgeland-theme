<?php get_header(); ?>

<section class="faq-hero py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%); padding-top: 120px !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 fw-bold mb-3">Frequently Asked Questions</h1>
                <p class="lead mb-4">
                    Find answers to common questions about our valuation services, processes, and expertise.
                    Can't find what you're looking for? We're here to help.
                </p>
                <div class="search-box bg-white rounded-3 p-3 d-inline-block">
                    <div class="input-group">
                        <input type="text" id="faq-search" class="form-control border-0" placeholder="Search FAQs...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- FAQ Categories -->
                <div class="faq-categories mb-5">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button class="btn btn-outline-primary category-filter active" data-category="all">All Questions</button>
                        <button class="btn btn-outline-primary category-filter" data-category="409a">409A Valuations</button>
                        <button class="btn btn-outline-primary category-filter" data-category="process">Process & Timeline</button>
                        <button class="btn btn-outline-primary category-filter" data-category="pricing">Pricing & Billing</button>
                        <button class="btn btn-outline-primary category-filter" data-category="general">General</button>
                    </div>
                </div>

                <!-- FAQ Accordion -->
                <div class="accordion" id="faqAccordion">
                    <!-- 409A Valuation Questions -->
                    <div class="accordion-item faq-item" data-category="409a">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                What is a 409A valuation and when do I need one?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>A 409A valuation is an independent appraisal of your company's common stock required by the IRS when issuing stock options to employees. You need one:</p>
                                <ul>
                                    <li><strong>First time issuing stock options</strong> - Before granting any employee equity</li>
                                    <li><strong>Annual refresh</strong> - 409A valuations are valid for 12 months</li>
                                    <li><strong>After material events</strong> - New funding rounds, significant business changes</li>
                                    <li><strong>Safe harbor protection</strong> - Ensures IRS compliance and protects against penalties</li>
                                </ul>
                                <p>Without a proper 409A valuation, your company and employees could face significant tax penalties.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="409a">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                How long does a 409A valuation take?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>We guarantee delivery within 14 business days</strong> from receiving all required information. Our typical timeline:</p>
                                <ul>
                                    <li><strong>Days 1-2:</strong> Information collection and initial review</li>
                                    <li><strong>Days 3-10:</strong> Market research, financial modeling, and analysis</li>
                                    <li><strong>Days 11-12:</strong> Draft report preparation</li>
                                    <li><strong>Days 13-14:</strong> Client review and final report delivery</li>
                                </ul>
                                <p>Most valuations are actually completed ahead of schedule. For urgent requests, we can often accommodate faster turnaround times.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="409a">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                What information do you need for a 409A valuation?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>We'll provide a detailed checklist, but typically need:</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Financial Information:</h6>
                                        <ul>
                                            <li>Financial statements (last 2-3 years)</li>
                                            <li>Management projections</li>
                                            <li>Monthly financials (current year)</li>
                                            <li>Revenue breakdown and metrics</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Corporate Documents:</h6>
                                        <ul>
                                            <li>Cap table and equity structure</li>
                                            <li>Articles of incorporation</li>
                                            <li>Recent funding documents</li>
                                            <li>Board resolutions</li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="mt-3">Don't worry if you don't have everything - we'll work with you to gather the necessary information.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Process & Timeline Questions -->
                    <div class="accordion-item faq-item" data-category="process">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                What is your valuation process?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Our proven 8-step process ensures accuracy and compliance:</p>
                                <ol>
                                    <li><strong>Initial Consultation</strong> - Free discussion about your needs</li>
                                    <li><strong>Engagement Letter</strong> - Formal agreement with clear scope</li>
                                    <li><strong>Kick-off Meeting</strong> - Detailed methodology discussion</li>
                                    <li><strong>Background Research</strong> - Market and industry analysis</li>
                                    <li><strong>Financial Modeling</strong> - Using multiple valuation approaches</li>
                                    <li><strong>Draft Report</strong> - Comprehensive analysis and findings</li>
                                    <li><strong>Management Review</strong> - Your feedback and final adjustments</li>
                                    <li><strong>Final Delivery</strong> - Report and certificate with ongoing support</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="process">
                        <h2 class="accordion-header" id="faq5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                Do you provide audit defense?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>Yes, comprehensive audit defense is included</strong> with all our valuations at no additional cost.</p>
                                <p>This means:</p>
                                <ul>
                                    <li>We'll respond to any IRS or auditor inquiries about our valuation</li>
                                    <li>Provide additional documentation or analysis if needed</li>
                                    <li>Stand behind our methodology and conclusions</li>
                                    <li>Support you through the entire audit process</li>
                                </ul>
                                <p>Our valuations follow AICPA guidelines and we're confident in defending our work before any regulatory body.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Questions -->
                    <div class="accordion-item faq-item" data-category="pricing">
                        <h2 class="accordion-header" id="faq6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
                                How much does a 409A valuation cost?
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Our 409A valuation pricing depends on company complexity:</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pricing-tier p-3 border rounded">
                                            <h6>Early Stage</h6>
                                            <div class="h5 text-primary">$2,500 - $3,500</div>
                                            <small>Pre-revenue to $2M ARR</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pricing-tier p-3 border rounded">
                                            <h6>Growth Stage</h6>
                                            <div class="h5 text-primary">$4,000 - $5,500</div>
                                            <small>$2M - $10M ARR</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pricing-tier p-3 border rounded">
                                            <h6>Enterprise</h6>
                                            <div class="h5 text-primary">$6,000 - $7,500</div>
                                            <small>$10M+ ARR</small>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3"><strong>Refresh valuations</strong> (within 12 months) receive a 25% discount. All pricing includes audit defense.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="pricing">
                        <h2 class="accordion-header" id="faq7">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7">
                                Are there any hidden fees?
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>No hidden fees.</strong> Our pricing is completely transparent and includes:</p>
                                <ul>
                                    <li>Complete valuation analysis using multiple methodologies</li>
                                    <li>Comprehensive written report with executive summary</li>
                                    <li>Certificate of valuation for your records</li>
                                    <li>Unlimited audit defense support</li>
                                    <li>Follow-up questions and clarifications</li>
                                </ul>
                                <p>The only additional costs might be:</p>
                                <ul>
                                    <li>Expedited delivery (if requested)</li>
                                    <li>Additional entities or complex structures not discussed upfront</li>
                                    <li>Significant scope changes during the process</li>
                                </ul>
                                <p>We'll always discuss any potential additional costs before proceeding.</p>
                            </div>
                        </div>
                    </div>

                    <!-- General Questions -->
                    <div class="accordion-item faq-item" data-category="general">
                        <h2 class="accordion-header" id="faq8">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8">
                                What makes Bridgeland Advisors different?
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Several factors set us apart:</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Experience & Expertise:</h6>
                                        <ul>
                                            <li>15+ years in investment banking and corporate law</li>
                                            <li>Cross-disciplinary background</li>
                                            <li>Deep understanding of VC finance</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Service Excellence:</h6>
                                        <ul>
                                            <li>Guaranteed 14-day turnaround</li>
                                            <li>Direct access to senior expertise</li>
                                            <li>Personalized service and attention</li>
                                        </ul>
                                    </div>
                                </div>
                                <p>We're not the cheapest option, but we provide exceptional value through quality, speed, and service.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="general">
                        <h2 class="accordion-header" id="faq9">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9">
                                Do you work with international companies?
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>Yes, we serve clients worldwide.</strong> Our experience includes:</p>
                                <ul>
                                    <li>US companies with international operations</li>
                                    <li>Israeli startups expanding to the US</li>
                                    <li>European companies seeking US investment</li>
                                    <li>Cross-border M&A transactions</li>
                                </ul>
                                <p>We understand the complexities of international business structures and can handle multi-jurisdiction valuations. All work is conducted in English, and we're experienced with various international accounting standards.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item" data-category="general">
                        <h2 class="accordion-header" id="faq10">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10">
                                How do I get started?
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Getting started is simple:</p>
                                <ol>
                                    <li><strong>Contact us</strong> - Email, call, or use our contact form</li>
                                    <li><strong>Free consultation</strong> - We'll discuss your needs and timeline</li>
                                    <li><strong>Proposal</strong> - Receive detailed scope and pricing</li>
                                    <li><strong>Engagement</strong> - Sign agreement and begin the process</li>
                                </ol>
                                <div class="contact-options mt-4 p-3 bg-light rounded">
                                    <div class="row text-center">
                                        <div class="col-md-4 mb-2">
                                            <a href="tel:+972-50-6842937" class="btn btn-primary btn-sm w-100">
                                                <i class="fas fa-phone me-2"></i>Call Now
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="mailto:eran@bridgeland-advisors.com" class="btn btn-outline-primary btn-sm w-100">
                                                <i class="fas fa-envelope me-2"></i>Email Eran
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-success btn-sm w-100">
                                                <i class="fas fa-calendar me-2"></i>Schedule Call
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Still Have Questions? -->
                <div class="text-center mt-5 pt-5 border-top">
                    <h3 class="mb-3">Still Have Questions?</h3>
                    <p class="lead text-muted mb-4">
                        Can't find the answer you're looking for? We're here to help with any questions about our services.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="tel:+972-50-6842937" class="btn btn-primary btn-lg">
                            <i class="fas fa-phone me-2"></i>Call +972-50-6842937
                        </a>
                        <a href="mailto:eran@bridgeland-advisors.com?subject=FAQ Question" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>Email Your Question
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// FAQ Search Functionality
document.getElementById('faq-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.accordion-button').textContent.toLowerCase();
        const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = searchTerm === '' ? 'block' : 'none';
        }
    });

    // Update category filter
    if (searchTerm) {
        document.querySelectorAll('.category-filter').forEach(btn => {
            btn.classList.remove('active');
        });
    }
});

// Category Filtering
document.querySelectorAll('.category-filter').forEach(button => {
    button.addEventListener('click', function() {
        const category = this.dataset.category;

        // Update active button
        document.querySelectorAll('.category-filter').forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');

        // Filter FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Clear search
        document.getElementById('faq-search').value = '';
    });
});

// Track FAQ interactions
document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', function() {
        const question = this.textContent.trim();

        if (typeof gtag !== 'undefined') {
            gtag('event', 'faq_interaction', {
                'question': question
            });
        }
    });
});
</script>

<style>
.search-box {
    max-width: 400px;
}

.category-filter.active {
    background-color: var(--color-maroon);
    border-color: var(--color-maroon);
    color: white;
}

.faq-item {
    transition: all 0.3s ease;
}

.accordion-button:not(.collapsed) {
    background-color: var(--color-maroon-subtle);
    color: var(--color-maroon);
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(139, 26, 26, 0.25);
}

.pricing-tier {
    transition: all 0.3s ease;
}

.pricing-tier:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .faq-categories .d-flex {
        justify-content: flex-start !important;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .category-filter {
        white-space: nowrap;
        flex-shrink: 0;
    }
}
</style>

<?php get_footer(); ?>