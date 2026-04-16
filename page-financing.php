<?php
/**
 * Template Name: Financing
 * Livia Med Spa — Payment Plans / Cherry Financing
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero page-hero--financing" aria-label="Payment Plans">
        <div class="page-hero__inner">
            <span class="section__label"><span aria-hidden="true">💳</span> Flexible Payment Plans</span>
            <h1 class="page-hero__title">Beauty Now,<br><em>Pay Over Time</em></h1>
            <p class="page-hero__desc">Don't let cost hold you back from looking and feeling your best. We offer flexible financing options so you can get the treatments you love — on your terms.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="#cherry-section" class="btn btn--primary btn--lg">View Payment Plans →</a>
                <a href="#book-now" class="btn btn--outline btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

    <!-- Cherry Financing Widget -->
    <section class="cherry-section" id="cherry-section" aria-label="Cherry Financing">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Powered by Cherry</span>
                <h2 class="section__title">Simple, Transparent Financing</h2>
                <p class="section__desc">Apply in seconds, get approved instantly, and choose a payment plan that works for your budget. No hidden fees, no surprises.</p>
            </div>

            <!-- Cherry Widget Container -->
            <div class="cherry-widget-wrap reveal">
                <div id="all"></div>
            </div>
        </div>
    </section>

    <!-- Why Finance With Us -->
    <section class="financing-why" aria-label="Why finance with us">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Finance?</span>
                <h2 class="section__title">Your Glow, Your Pace</h2>
            </div>
            <div class="financing-benefits reveal">
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true">⚡</div>
                    <h3 class="financing-benefit__title">Instant Approval</h3>
                    <p class="financing-benefit__text">Apply in under 30 seconds and get a decision immediately. No lengthy paperwork or waiting periods.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true">💰</div>
                    <h3 class="financing-benefit__title">0% APR Options</h3>
                    <p class="financing-benefit__text">Qualifying patients can enjoy 0% APR financing on select treatments. Pay over time with zero interest.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true">📱</div>
                    <h3 class="financing-benefit__title">Easy Payments</h3>
                    <p class="financing-benefit__text">Manage your payment plan from your phone. Set up autopay and never miss a payment.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true">🔒</div>
                    <h3 class="financing-benefit__title">No Hidden Fees</h3>
                    <p class="financing-benefit__text">What you see is what you pay. No prepayment penalties, no surprise charges, ever.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Get started">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Get Started?</span>
            <h2 class="cta-section__title">Book Your Treatment.<br>We'll Handle the Rest.</h2>
            <p class="cta-section__text">Schedule your consultation and ask about our financing options. Our team will help you find the perfect plan.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<!-- Cherry Widget Script -->
<script>
(function (w, d, s, o, f, js, fjs) {
    w[o] =
        w[o] ||
        function () {
            (w[o].q = w[o].q || []).push(arguments);
        };
    (js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
    js.id = o;
    js.src = f;
    js.async = 1;
    fjs.parentNode.insertBefore(js, fjs);
})(window, document, "script", "_hw", "https://files.withcherry.com/widgets/widget.js");
_hw(
    "init",
    {
        debug: false,
        variables: {
            slug: "livia-med-spa",
            name: "Livia Med Spa",
        },
        styles: {
            primaryColor: "#AC13F9",
            secondaryColor: "#F0EBE3",
            fontFamily: "DM Sans",
        },
    },
    ["all", "hero", "howitworks", "calculator", "testimony", "faq"]
);
</script>

<?php get_footer(); ?>
