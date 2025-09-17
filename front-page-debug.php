<?php get_header(); ?>

<style>
/* Emergency CSS Debug Styles */
* {
    opacity: 1 !important;
    visibility: visible !important;
}
section {
    display: block !important;
    background: #f0f0f0 !important;
    margin: 10px 0 !important;
    padding: 20px !important;
    border: 2px solid #8B1A1A !important;
}
</style>

<div class="debug-notice" style="background: yellow; padding: 20px; text-align: center; font-weight: bold;">
    DEBUG MODE: If you can see this, the template is loading. Content should appear below.
</div>

<!-- Hero Section - Simplified -->
<section class="hero-section" style="background: var(--color-maroon); padding: 60px 0; color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1>Expert Financial Advisory for Strategic Growth</h1>
                <p>This is a test to see if content displays properly.</p>
                <a href="#" class="btn" style="background: white; color: var(--color-maroon); padding: 10px 20px; text-decoration: none; border-radius: 5px;">Test Button</a>
            </div>
            <div class="col-lg-6">
                <p>Second column content - if you see this, the grid system is working.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - Simplified -->
<section class="services-section" style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <h2 style="text-align: center; color: var(--color-maroon);">Our Services</h2>
        <div class="row">
            <div class="col-lg-4">
                <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h3>409A Valuation</h3>
                    <p>IRS-compliant equity valuations for stock option programs.</p>
                    <a href="#" style="color: var(--color-maroon);">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h3>Company Valuation</h3>
                    <p>Comprehensive business valuations for M&A and investment.</p>
                    <a href="#" style="color: var(--color-maroon);">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background: white; padding: 20px; margin: 10px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h3>Waterfall Analysis</h3>
                    <p>Detailed equity distribution and payout modeling.</p>
                    <a href="#" style="color: var(--color-maroon);">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Simple CTA Section -->
<section class="cta-section" style="background: var(--color-maroon); padding: 60px 0; color: white; text-align: center;">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Contact us today for a consultation.</p>
        <a href="#" style="background: white; color: var(--color-maroon); padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">Contact Us</a>
    </div>
</section>

<script>
// Simple JavaScript test
console.log('Front page debug script loaded');
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - content should be visible');

    // Add a visible indicator that JavaScript is working
    const indicator = document.createElement('div');
    indicator.innerHTML = 'JavaScript is working - ' + new Date().toLocaleTimeString();
    indicator.style.cssText = 'background: green; color: white; padding: 10px; text-align: center; font-weight: bold;';
    document.body.insertBefore(indicator, document.body.firstChild);
});
</script>

<?php get_footer(); ?>