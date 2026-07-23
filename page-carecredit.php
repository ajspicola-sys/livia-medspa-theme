<?php
/**
 * Template Name: CareCredit
 * LIVIA Med Spa — CareCredit Financing
 * Sister page to page-financing.php (Cherry). Uses the CareCredit
 * merchant apply link with LIVIA's tracking codes — do not alter the URL.
 */
$carecredit_url = 'https://www.carecredit.com/go/255GBX/?dtc=DS1X&sitecode=h2mdo9bg10';
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero page-hero--financing" aria-label="CareCredit Financing">
        <div class="page-hero__inner">
            <span class="section__label">Flexible Payment Plans</span>
            <h1 class="page-hero__title">Financing with<br><em>CareCredit</em></h1>
            <p class="page-hero__desc">Get the treatments you want today and pay over time with the CareCredit health and wellness credit card. See if you prequalify with no impact to your credit score.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="<?php echo esc_url($carecredit_url); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Apply &amp; See If You Prequalify →</a>
                <a href="#book-now" class="btn btn--outline btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

    <!-- Official CareCredit banner -->
    <section class="carecredit-banner" aria-label="CareCredit">
        <div class="section__inner">
            <a href="<?php echo esc_url($carecredit_url); ?>" target="_blank" rel="noopener noreferrer" class="carecredit-banner__link reveal">
                <img src="https://www.carecredit.com/sites/pc/image/flexible-financing-prequal-apply-pay-420x150.png"
                     alt="CareCredit flexible financing — prequalify, apply, and pay"
                     width="420" height="150" loading="lazy" decoding="async">
            </a>
        </div>
    </section>

    <!-- How it works -->
    <section class="financing-why" aria-label="How CareCredit works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Three Simple Steps</h2>
            </div>
            <div class="financing-benefits financing-benefits--three reveal">
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></div>
                    <h3 class="financing-benefit__title">1. Prequalify</h3>
                    <p class="financing-benefit__text">Check if you prequalify in seconds — with no impact to your credit score.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg></div>
                    <h3 class="financing-benefit__title">2. Apply</h3>
                    <p class="financing-benefit__text">Complete a quick application to see your credit line.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg></div>
                    <h3 class="financing-benefit__title">3. Pay</h3>
                    <p class="financing-benefit__text">Use your CareCredit card for treatments at LIVIA Med Spa and pay over time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cherry cross-link -->
    <section class="financing-alt" aria-label="Other financing options">
        <div class="section__inner">
            <div class="financing-alt__card reveal">
                <div>
                    <h2 class="financing-alt__title">Prefer a different option?</h2>
                    <p class="financing-alt__text">We also offer payment plans through Cherry — instant approval, 0% APR options, and no hard credit check to apply.</p>
                </div>
                <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="btn btn--outline">Explore Cherry Payment Plans →</a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Get started">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Get Started?</span>
            <h2 class="cta-section__title">Apply Today.<br>Start Your Treatment.</h2>
            <p class="cta-section__text">Apply for CareCredit today and start your treatment at LIVIA Med Spa. Questions? Our team is happy to walk you through your options.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url($carecredit_url); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Apply Now</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
            <p class="carecredit-disclaimer">Subject to credit approval. See <a href="https://www.carecredit.com" target="_blank" rel="noopener noreferrer">carecredit.com</a> for details.</p>
        </div>
    </section>

</main>

<?php get_footer(); ?>
