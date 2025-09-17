<?php get_header(); ?>

<section class="insights-hero py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%); padding-top: 120px !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <div class="mb-3">
                        <span class="badge bg-white text-primary px-3 py-2">Expert Insights</span>
                        <span class="badge bg-warning text-dark px-3 py-2 ms-2">Market Analysis</span>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Insights & Analysis</h1>
                    <p class="lead mb-4">
                        Expert perspectives on valuation, venture capital, and startup finance. Stay informed with our
                        analysis of market trends, regulatory changes, and best practices in financial advisory.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#latest" class="btn btn-white btn-large">
                            <i class="fas fa-newspaper me-2"></i>Latest Articles
                        </a>
                        <a href="#subscribe" class="btn btn-outline btn-large">
                            <i class="fas fa-envelope me-2"></i>Subscribe
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-card bg-white rounded-3 shadow-lg p-4 mt-4 mt-lg-0">
                    <h5 class="text-primary mb-3">Insights Library</h5>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Published Articles:</span>
                        <strong>25+ Posts</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Categories:</span>
                        <strong>6 Topics</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Publishing:</span>
                        <strong>Weekly</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Reader Focus:</span>
                        <strong>Professionals</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between">
                        <span>Expertise:</span>
                        <strong>15+ Years</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Filter -->
<section class="categories-section py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <button class="btn btn-outline-primary category-filter active" data-category="all">All Articles</button>
            <button class="btn btn-outline-primary category-filter" data-category="409a">409A Valuations</button>
            <button class="btn btn-outline-primary category-filter" data-category="fundraising">Fundraising</button>
            <button class="btn btn-outline-primary category-filter" data-category="market-trends">Market Trends</button>
            <button class="btn btn-outline-primary category-filter" data-category="regulations">Regulations</button>
            <button class="btn btn-outline-primary category-filter" data-category="case-studies">Case Studies</button>
            <button class="btn btn-outline-primary category-filter" data-category="tools">Tools & Methods</button>
        </div>
    </div>
</section>

<!-- Featured Article -->
<section id="latest" class="featured-article py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="featured-card card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">Featured</span>
                            <span class="badge bg-secondary">409A Valuations</span>
                        </div>
                        <h2 class="h3 mb-3">Understanding 409A Safe Harbor: Why Timing Matters for Your Valuation</h2>
                        <p class="lead text-muted mb-4">
                            The IRS safe harbor provision provides crucial protection for companies issuing stock options,
                            but understanding the timing requirements is essential for maintaining compliance and avoiding penalties.
                        </p>
                        <div class="article-meta d-flex align-items-center mb-4">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiNFRjQ0NDQiLz4KPHN2ZyB4PSI4IiB5PSI4IiB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik0yMCAyMUMyMCAxNi45IDEyIDEzIDEyIDEzUzQgMTYuOSA0IDIxVjIySDIwVjIxWiIgZmlsbD0id2hpdGUiLz4KPGNpcmNsZSBjeD0iMTIiIGN5PSI3IiByPSI0IiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4KPC9zdmc+Cg=="
                                 alt="Eran Ben-Avi" class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <div class="fw-semibold">Eran Ben-Avi</div>
                                <div class="small text-muted">December 15, 2024 • 8 min read</div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Read Full Article</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="articles-grid py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Recent Insights</h2>
            <p class="lead text-muted">
                Expert analysis and practical guidance for startup founders and investors
            </p>
        </div>

        <div class="row g-4" id="articles-container">
            <!-- 409A Valuation Articles -->
            <div class="col-lg-4 article-item" data-category="409a">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">409A</span>
                            <span class="small text-muted">Dec 10, 2024</span>
                        </div>
                        <h5 class="mb-3">The Complete Guide to 409A Valuation Frequency</h5>
                        <p class="text-muted mb-3">
                            Understanding when and why you need to update your 409A valuation, including material events
                            that trigger new requirements and best practices for timing.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">5 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 article-item" data-category="409a">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">409A</span>
                            <span class="small text-muted">Dec 5, 2024</span>
                        </div>
                        <h5 class="mb-3">Avoiding Common 409A Valuation Mistakes</h5>
                        <p class="text-muted mb-3">
                            Critical errors that can invalidate your 409A safe harbor protection and how to ensure
                            your valuation meets all IRS requirements.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">7 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fundraising Articles -->
            <div class="col-lg-4 article-item" data-category="fundraising">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success me-2">Fundraising</span>
                            <span class="small text-muted">Nov 28, 2024</span>
                        </div>
                        <h5 class="mb-3">Series A Fundraising in 2024: Market Reality Check</h5>
                        <p class="text-muted mb-3">
                            Current market conditions for Series A rounds, including median valuations, deal terms,
                            and what investors are looking for in today's environment.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">10 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 article-item" data-category="fundraising">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success me-2">Fundraising</span>
                            <span class="small text-muted">Nov 20, 2024</span>
                        </div>
                        <h5 class="mb-3">Due Diligence Preparation: A Founder's Checklist</h5>
                        <p class="text-muted mb-3">
                            Essential documents and data room preparation for successful fundraising. What investors
                            expect to see and how to present your company professionally.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">8 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Market Trends -->
            <div class="col-lg-4 article-item" data-category="market-trends">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">Market Trends</span>
                            <span class="small text-muted">Nov 15, 2024</span>
                        </div>
                        <h5 class="mb-3">Q4 2024 Startup Valuation Trends</h5>
                        <p class="text-muted mb-3">
                            Analysis of recent valuation trends across different stages and sectors, with insights
                            into how market conditions are affecting startup pricing.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">12 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 article-item" data-category="market-trends">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info me-2">Market Trends</span>
                            <span class="small text-muted">Nov 8, 2024</span>
                        </div>
                        <h5 class="mb-3">AI Startup Valuations: Hype vs. Reality</h5>
                        <p class="text-muted mb-3">
                            Examining AI startup valuations and whether current pricing reflects fundamental value
                            or market speculation. Key metrics that matter.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">9 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regulations -->
            <div class="col-lg-4 article-item" data-category="regulations">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning me-2">Regulations</span>
                            <span class="small text-muted">Oct 30, 2024</span>
                        </div>
                        <h5 class="mb-3">New SEC Rules Impact on Private Company Reporting</h5>
                        <p class="text-muted mb-3">
                            Recent regulatory changes affecting private companies and their reporting requirements.
                            What founders need to know about compliance.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">6 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 article-item" data-category="regulations">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning me-2">Regulations</span>
                            <span class="small text-muted">Oct 22, 2024</span>
                        </div>
                        <h5 class="mb-3">International Tax Implications for Cross-Border Investments</h5>
                        <p class="text-muted mb-3">
                            Understanding tax considerations for international investors and companies with
                            cross-border operations. Key compliance requirements.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">11 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Studies -->
            <div class="col-lg-4 article-item" data-category="case-studies">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-danger me-2">Case Study</span>
                            <span class="small text-muted">Oct 15, 2024</span>
                        </div>
                        <h5 class="mb-3">Case Study: Complex Cap Table Waterfall Analysis</h5>
                        <p class="text-muted mb-3">
                            Real-world example of exit waterfall modeling for a company with multiple preferred
                            series and complex liquidation preferences.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">15 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tools & Methods -->
            <div class="col-lg-4 article-item" data-category="tools">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-secondary me-2">Tools</span>
                            <span class="small text-muted">Oct 8, 2024</span>
                        </div>
                        <h5 class="mb-3">Financial Modeling Best Practices for Startups</h5>
                        <p class="text-muted mb-3">
                            Building robust financial models that investors trust. Key assumptions, scenarios,
                            and presentation techniques for effective fundraising.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">13 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 article-item" data-category="tools">
                <div class="article-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-secondary me-2">Tools</span>
                            <span class="small text-muted">Sep 28, 2024</span>
                        </div>
                        <h5 class="mb-3">Choosing the Right Valuation Method for Your Company</h5>
                        <p class="text-muted mb-3">
                            Comprehensive guide to different valuation approaches and when to use each method.
                            DCF vs. market multiples vs. VC method analysis.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="small text-muted">10 min read</div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription -->
<section id="subscribe" class="newsletter-section py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="display-5 fw-bold mb-3">Stay Informed</h2>
                <p class="lead mb-4">
                    Get our latest insights, market analysis, and expert guidance delivered to your inbox.
                    Join 500+ startup founders and investors who rely on our expertise.
                </p>

                <div class="newsletter-form bg-white rounded-3 p-4 d-inline-block">
                    <form class="row g-3 align-items-center justify-content-center">
                        <div class="col-auto">
                            <input type="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-envelope me-2"></i>Subscribe
                            </button>
                        </div>
                    </form>
                    <div class="small text-muted mt-2">
                        Weekly insights • No spam • Unsubscribe anytime
                    </div>
                </div>

                <div class="benefits-list d-flex justify-content-center gap-4 flex-wrap mt-4">
                    <div class="benefit-item text-center">
                        <i class="fas fa-chart-line fa-lg mb-2"></i>
                        <div class="small">Market Analysis</div>
                    </div>
                    <div class="benefit-item text-center">
                        <i class="fas fa-lightbulb fa-lg mb-2"></i>
                        <div class="small">Expert Insights</div>
                    </div>
                    <div class="benefit-item text-center">
                        <i class="fas fa-tools fa-lg mb-2"></i>
                        <div class="small">Practical Tools</div>
                    </div>
                    <div class="benefit-item text-center">
                        <i class="fas fa-gavel fa-lg mb-2"></i>
                        <div class="small">Regulatory Updates</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="insights-cta py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="mb-3">Need Expert Guidance?</h3>
                <p class="lead text-muted mb-4">
                    While our insights provide valuable perspectives, personalized advice can make the difference
                    in your specific situation. Let's discuss your needs.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/bridgeland-advisors'}); return false;" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
                    </a>
                    <a href="tel:+972-50-6842937" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone me-2"></i>Call +972-50-6842937
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Category filtering functionality
document.querySelectorAll('.category-filter').forEach(button => {
    button.addEventListener('click', function() {
        const category = this.dataset.category;

        // Update active button
        document.querySelectorAll('.category-filter').forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');

        // Filter articles
        document.querySelectorAll('.article-item').forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Track category selection
        if (typeof gtag !== 'undefined') {
            gtag('event', 'insights_category_filter', {
                'category': category
            });
        }
    });
});

// Newsletter form submission
document.querySelector('.newsletter-form form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;

    // Here you would implement actual newsletter subscription logic
    alert('Thank you for subscribing! You\'ll receive our latest insights in your inbox.');

    // Track subscription
    if (typeof gtag !== 'undefined') {
        gtag('event', 'newsletter_subscription', {
            'email': email
        });
    }
});

// Track article clicks
document.querySelectorAll('.article-card a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault(); // Remove this when you have actual article pages

        const articleTitle = this.closest('.article-card').querySelector('h5').textContent;

        if (typeof gtag !== 'undefined') {
            gtag('event', 'article_click', {
                'article_title': articleTitle
            });
        }

        // For now, show a message since articles aren't implemented
        alert('Article content would be displayed here. This is a template demonstration.');
    });
});
</script>

<style>
.category-filter.active {
    background-color: var(--color-maroon);
    border-color: var(--color-maroon);
    color: white;
}

.article-card {
    transition: all 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.featured-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.newsletter-form {
    max-width: 500px;
}

.benefit-item {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .hero-content .btn-large {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .category-filter {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }

    .newsletter-form {
        width: 100% !important;
    }

    .newsletter-form .row {
        --bs-gutter-x: 0.5rem;
    }

    .benefits-list {
        gap: 1rem !important;
    }
}
</style>

<?php get_footer(); ?>