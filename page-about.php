<?php get_header(); ?>

<section class="about-hero py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding-top: 120px !important; position: relative;">
    <!-- Subtle background pattern -->
    <div class="hero-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23B91C1C\" fill-opacity=\"0.1\"><circle cx=\"7\" cy=\"7\" r=\"1\"/><circle cx=\"53\" cy=\"53\" r=\"1\"/><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>');\"></div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-3 text-dark" style="font-family: 'Source Serif Pro', serif;">About Bridgeland Advisors</h1>
                    <p class="lead mb-4 text-secondary" style="font-family: 'Inter', sans-serif;">
                        Founded to help early-stage companies navigate capital raising and company valuation,
                        we bring 15+ years of investment banking, corporate law, and strategic advisory experience
                        to every engagement.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#eran" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-user me-2"></i>Meet Eran
                        </a>
                        <a href="#contact" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-phone me-2"></i>Get in Touch
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-card bg-white rounded-3 shadow-lg p-4 mt-4 mt-lg-0">
                    <h5 class="text-primary mb-3">Company Overview</h5>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Founded:</span>
                        <strong>2018</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Headquarters:</span>
                        <strong>Even Yehuda, Israel</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Valuations:</span>
                        <strong>500+ Completed</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Assets Valued:</span>
                        <strong>$2B+</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between">
                        <span>Industries:</span>
                        <strong>Tech, Healthcare, Bio</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mission-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-bullseye text-primary"></i>
                            </div>
                            <h3 class="mb-0">Our Mission</h3>
                        </div>
                        <p class="text-muted mb-0">
                            To provide expert financial advisory services that empower early-stage companies
                            to make informed decisions, raise capital successfully, and achieve their strategic
                            growth objectives with confidence and precision.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="vision-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-eye text-primary"></i>
                            </div>
                            <h3 class="mb-0">Our Vision</h3>
                        </div>
                        <p class="text-muted mb-0">
                            To be widely respected and recognized as a leading independent valuation and
                            financial advisory firm, known for exceptional service, technical expertise,
                            and unwavering commitment to client success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Eran Ben-Avi Section -->
<section id="eran" class="founder-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="founder-image text-center mb-4 mb-lg-0">
                    <div class="image-placeholder bg-primary bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                        <i class="fas fa-user fa-4x text-primary"></i>
                    </div>
                    <div class="mt-3">
                        <h4 class="mb-1">Eran Ben-Avi</h4>
                        <p class="text-muted">Managing Partner & Founder</p>
                        <div class="social-links">
                            <a href="<?php echo get_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/'); ?>"
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-linkedin me-2"></i>LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="founder-content">
                    <h3 class="mb-4">Leading Financial Advisory with 15+ Years Experience</h3>

                    <p class="lead text-muted mb-4">
                        Eran Ben-Avi brings over 15 years of comprehensive experience in investment banking,
                        corporate law, corporate finance, strategy, M&A, and private placements to help companies
                        navigate complex financial decisions with precision and expertise.
                    </p>

                    <!-- Professional Background -->
                    <div class="professional-background mb-4">
                        <h5 class="mb-3">Professional Background</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="text-primary mb-2">
                                        <i class="fas fa-briefcase me-2"></i>
                                        Investment Banking & Corporate Finance
                                    </h6>
                                    <p class="mb-0 small text-muted">
                                        Extensive experience in investment banking with major firms, specializing in
                                        middle-market transactions, capital structure optimization, and strategic advisory
                                        for growth-stage companies across technology, healthcare, and life sciences sectors.
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="text-primary mb-2">
                                        <i class="fas fa-balance-scale me-2"></i>
                                        Corporate Law & Securities
                                    </h6>
                                    <p class="mb-0 small text-muted">
                                        Corporate law background focusing on securities regulations, venture capital
                                        financings, M&A transactions, and compliance matters. Deep understanding of
                                        regulatory frameworks governing startup equity structures and valuations.
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="text-primary mb-2">
                                        <i class="fas fa-chart-bar me-2"></i>
                                        Strategic Advisory & Valuation
                                    </h6>
                                    <p class="mb-0 small text-muted">
                                        Specialized expertise in business valuation, 409A compliance, and strategic
                                        advisory services. Proven track record of helping companies achieve successful
                                        capital raises, strategic exits, and compliance objectives.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Education & Credentials -->
                    <div class="education-credentials mb-4">
                        <h5 class="mb-3">Education & Professional Credentials</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="credential-item d-flex align-items-start">
                                    <i class="fas fa-graduation-cap text-primary me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Advanced Finance & Law Education</h6>
                                        <p class="text-muted small mb-0">Comprehensive academic background in corporate finance, securities law, and business valuation methodologies</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="credential-item d-flex align-items-start">
                                    <i class="fas fa-certificate text-primary me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Professional Certifications</h6>
                                        <p class="text-muted small mb-0">Certified in business valuation standards, 409A compliance, and financial modeling best practices</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="credential-item d-flex align-items-start">
                                    <i class="fas fa-award text-primary me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Industry Recognition</h6>
                                        <p class="text-muted small mb-0">Recognized expert in venture capital finance and startup valuation methodologies</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="credential-item d-flex align-items-start">
                                    <i class="fas fa-globe text-primary me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">International Expertise</h6>
                                        <p class="text-muted small mb-0">Cross-border transaction experience with understanding of global market dynamics</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="experience-areas mb-4">
                        <h5 class="mb-3">Core Areas of Expertise</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-gavel text-primary me-2"></i>
                                    <span>409A Valuation & Compliance</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-handshake text-primary me-2"></i>
                                    <span>M&A Transactions & Due Diligence</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-chart-line text-primary me-2"></i>
                                    <span>Venture Capital Finance</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-table text-primary me-2"></i>
                                    <span>Cap Table Design & Management</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-balance-scale text-primary me-2"></i>
                                    <span>Corporate Law & Securities</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-rocket text-primary me-2"></i>
                                    <span>Strategic Planning & Growth</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-coins text-primary me-2"></i>
                                    <span>Private Placements & Capital Raising</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-item d-flex align-items-center">
                                    <i class="fas fa-chart-pie text-primary me-2"></i>
                                    <span>Financial Modeling & Analysis</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-info-founder mb-4">
                        <h5 class="mb-3">Direct Contact Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="contact-item d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <a href="mailto:eran@bridgeland-advisors.com" class="text-decoration-none">eran@bridgeland-advisors.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-item d-flex align-items-center">
                                    <i class="fas fa-phone text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Direct Line</small>
                                        <a href="tel:+972-50-6842937" class="text-decoration-none">+972-50-6842937</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-item d-flex align-items-center">
                                    <i class="fab fa-whatsapp text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">WhatsApp</small>
                                        <a href="https://wa.me/972506842937" target="_blank" class="text-decoration-none">Business Chat</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-item d-flex align-items-center">
                                    <i class="fab fa-linkedin text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">LinkedIn</small>
                                        <a href="https://www.linkedin.com/in/eranbenavi/" target="_blank" class="text-decoration-none">Professional Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="philosophy-box bg-white p-4 rounded shadow-sm">
                        <h6 class="text-primary mb-2">
                            <i class="fas fa-quote-left me-2"></i>
                            Professional Philosophy
                        </h6>
                        <p class="mb-0 fst-italic">
                            "Consulting is more than just giving advice, it is about giving the right advice at the right time.
                            We believe in providing strategic guidance that combines deep technical expertise with practical
                            business insight, helping our clients navigate complex financial decisions with confidence and
                            achieve sustainable growth. Every engagement is an opportunity to deliver exceptional value and
                            build lasting partnerships based on trust, integrity, and results."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Why Choose Bridgeland Advisors</h2>
            <p class="lead text-muted">
                What sets us apart in the financial advisory landscape
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-graduation-cap text-success fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Deep Expertise</h5>
                        <p class="text-muted">
                            Cross-disciplinary background combining investment banking, corporate law,
                            and strategic advisory with 15+ years of hands-on experience.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-clock text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Fast Turnaround</h5>
                        <p class="text-muted">
                            Guaranteed 14-day turnaround for 409A valuations with most deliveries
                            completed ahead of schedule without compromising quality.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-dollar-sign text-warning fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Fair Pricing</h5>
                        <p class="text-muted">
                            Transparent, competitive pricing without hidden fees. We price ourselves
                            fairly and reasonably to deliver exceptional value.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt text-info fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Audit Defense</h5>
                        <p class="text-muted">
                            Comprehensive audit defense included with all valuations at no additional cost.
                            We stand behind our work with full support.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users text-success fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Client Focused</h5>
                        <p class="text-muted">
                            Personalized service with direct access to senior expertise. We prioritize
                            high customer satisfaction and long-term relationships.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="advantage-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-certificate text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Standards Compliance</h5>
                        <p class="text-muted">
                            All work performed following AICPA and IPEV guidelines ensuring
                            professional standards and regulatory compliance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industries Served Section -->
<section class="industries-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Industries We Serve</h2>
            <p class="lead text-muted">
                Specialized expertise across technology, healthcare, and innovation sectors
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="industry-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-laptop-code text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Technology</h5>
                        <p class="text-muted mb-3">
                            SaaS platforms, fintech, cybersecurity, AI/ML, and enterprise software companies.
                        </p>
                        <ul class="list-unstyled small text-start">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>B2B Software Platforms</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Fintech & Payments</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Cybersecurity Solutions</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>AI & Machine Learning</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="industry-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-heartbeat text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Healthcare</h5>
                        <p class="text-muted mb-3">
                            Digital health, telemedicine, healthcare IT, and medical device companies.
                        </p>
                        <ul class="list-unstyled small text-start">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Digital Health Platforms</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Telemedicine Solutions</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Healthcare IT Systems</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Medical Devices</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="industry-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-dna text-primary fa-lg"></i>
                        </div>
                        <h5 class="mb-3">Life Sciences</h5>
                        <p class="text-muted mb-3">
                            Biotech, pharmaceuticals, diagnostics, and research & development companies.
                        </p>
                        <ul class="list-unstyled small text-start">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Biotechnology Companies</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Pharmaceutical Development</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Diagnostic Solutions</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Research Platforms</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">What Our Clients Say</h2>
            <p class="lead text-muted">
                Trusted by founders and executives worldwide
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="testimonial-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <blockquote class="blockquote mb-3">
                            <p class="mb-0">"I highly recommend Bridgeland Advisors for their exceptional service in constructing a 409A valuation for our company. They demonstrated utmost professionalism and efficiency throughout the process."</p>
                        </blockquote>
                        <footer class="blockquote-footer">
                            <strong>Boaz Fraoman</strong>, Startup Founder
                        </footer>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="testimonial-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <blockquote class="blockquote mb-3">
                            <p class="mb-0">"An absolute gem! Eran is a true expert in the field of VC finance and cap tables. He is an excellent communicator and an outstanding teacher."</p>
                        </blockquote>
                        <footer class="blockquote-footer">
                            <strong>David Cooper</strong>, Investment Professional
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Office Information Section -->
<section class="office-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="mb-4">Our Office</h3>
                <div class="office-info">
                    <div class="info-item d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                        <div>
                            <h6 class="mb-1">Address</h6>
                            <p class="text-muted mb-0">19 Ner Halayla St.<br>Even Yehuda, Israel</p>
                        </div>
                    </div>

                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-phone text-primary me-3"></i>
                        <div>
                            <h6 class="mb-1">Phone</h6>
                            <a href="tel:+972-50-6842937" class="text-muted text-decoration-none">+972-50-6842937</a>
                        </div>
                    </div>

                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-envelope text-primary me-3"></i>
                        <div>
                            <h6 class="mb-1">Email</h6>
                            <a href="mailto:eran@bridgeland-advisors.com" class="text-muted text-decoration-none">eran@bridgeland-advisors.com</a>
                        </div>
                    </div>

                    <div class="info-item d-flex align-items-start">
                        <i class="fas fa-clock text-primary me-3 mt-1"></i>
                        <div>
                            <h6 class="mb-1">Business Hours</h6>
                            <div class="text-muted small">
                                <div>Sunday - Thursday: 9:00 AM - 6:00 PM (GMT+3)</div>
                                <div>Friday: 9:00 AM - 2:00 PM (GMT+3)</div>
                                <div>Saturday: Closed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-methods">
                    <h4 class="mb-4">Get in Touch</h4>
                    <div class="d-grid gap-3">
                        <a href="javascript:void(0)" onclick="return openCalendly();" class="btn btn-primary btn-lg">
                            <i class="fas fa-calendar-alt me-2"></i>Schedule Consultation
                        </a>
                        <a href="tel:+972-50-6842937" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-phone me-2"></i>Call Now
                        </a>
                        <a href="https://wa.me/972506842937?text=Hi%20Eran,%20I'm%20interested%20in%20learning%20more%20about%20your%20services."
                           target="_blank" class="btn btn-success btn-lg">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp Chat
                        </a>
                        <a href="<?php echo get_theme_mod('company_linkedin', 'https://www.linkedin.com/in/eranbenavi/'); ?>"
                           target="_blank" class="btn btn-outline-secondary btn-lg">
                            <i class="fab fa-linkedin me-2"></i>Connect on LinkedIn
                        </a>
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
                <h2 class="display-5 fw-bold mb-3">Ready to Work Together?</h2>
                <p class="lead mb-4">
                    Let's discuss how we can help your company achieve its financial and strategic objectives.
                </p>

                <div class="d-flex gap-3 justify-content-center flex-wrap mb-4">
                    <a href="tel:+972-50-6842937" class="btn btn-white btn-large">
                        <i class="fas fa-phone me-2"></i>Call +972-50-6842937
                    </a>
                    <a href="mailto:eran@bridgeland-advisors.com?subject=About Inquiry" class="btn btn-outline btn-large">
                        <i class="fas fa-envelope me-2"></i>Email Eran
                    </a>
                </div>

                <div class="trust-indicators d-flex justify-content-center gap-4 flex-wrap">
                    <div class="indicator text-center">
                        <i class="fas fa-handshake fa-lg mb-2"></i>
                        <div class="small">Trusted Partner</div>
                    </div>
                    <div class="indicator text-center">
                        <i class="fas fa-award fa-lg mb-2"></i>
                        <div class="small">Expert Service</div>
                    </div>
                    <div class="indicator text-center">
                        <i class="fas fa-clock fa-lg mb-2"></i>
                        <div class="small">Fast Response</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.mission-card,
.vision-card,
.advantage-card,
.industry-card,
.testimonial-card {
    transition: all 0.3s ease;
}

.mission-card:hover,
.vision-card:hover,
.advantage-card:hover,
.industry-card:hover,
.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.expertise-item {
    transition: all 0.3s ease;
}

.expertise-item:hover {
    transform: translateX(5px);
}

.philosophy-box {
    border-left: 4px solid var(--color-primary);
}

.image-placeholder {
    border: 3px solid var(--color-primary);
}

.trust-indicators .indicator {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .hero-content .btn-large {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .contact-methods .btn {
        width: 100%;
    }

    .trust-indicators {
        gap: 1rem !important;
    }
}
</style>

<?php get_footer(); ?>