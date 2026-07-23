<?php
/**
 * Template Name: CareCredit
 * LIVIA Med Spa — CareCredit Financing
 * Sister page to page-financing.php (Cherry). Uses the CareCredit
 * merchant apply link with LIVIA's tracking codes — do not alter the URL.
 */
$carecredit_url = 'https://www.carecredit.com/go/255GBX/?dtc=DS1X&sitecode=h2mdo9bg10';

// Resolve a service page URL from candidate slugs (falls back to /services/)
$cc_service_url = function ($candidates) {
    foreach ((array) $candidates as $slug) {
        $p = get_page_by_path($slug, OBJECT, 'service');
        if ($p && 'publish' === $p->post_status) {
            return get_permalink($p);
        }
    }
    return home_url('/services/');
};

get_header(); ?>

<main class="site-main cc-theme" id="main-content">

    <!-- ═══════════════════════════════════════════════════════════════
         HERO — split layout with official CareCredit artwork
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cc-hero" aria-label="CareCredit financing at LIVIA Med Spa">
        <div class="section__inner">
            <div class="cc-hero__layout">
                <div class="cc-hero__content reveal">
                    <span class="section__label">Flexible Payment Plans</span>
                    <h1 class="cc-hero__title">Financing with <em>CareCredit</em></h1>
                    <p class="cc-hero__desc">Get the treatments you want today and pay over time with the CareCredit health and wellness credit card — accepted for every treatment at LIVIA Med Spa in Tampa.</p>
                    <ul class="cc-hero__points">
                        <li class="cc-hero__point">See if you prequalify in seconds — no impact to your credit score</li>
                        <li class="cc-hero__point">Promotional financing options on qualifying purchases</li>
                        <li class="cc-hero__point">Reusable card — use it again for every future visit</li>
                    </ul>
                    <div class="hero__actions">
                        <a href="<?php echo esc_url($carecredit_url); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Apply &amp; See If You Prequalify →</a>
                        <a href="#book-now" class="btn btn--outline btn--lg">Book Consultation</a>
                    </div>
                    <p class="cc-hero__note">Prequalifying is quick, secure, and does not affect your credit score.</p>
                </div>
                <div class="cc-hero__visual reveal">
                    <div class="cc-hero__card">
                        <div class="cc-hero__ring" aria-hidden="true"></div>
                        <a href="<?php echo esc_url($carecredit_url); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://www.carecredit.com/sites/pc/image/flexible-financing-prequal-apply-pay-375x320.png"
                                 alt="CareCredit flexible financing — prequalify, apply, and pay"
                                 width="375" height="320" loading="eager" decoding="async">
                        </a>
                        <div class="cc-hero__badge">
                            <span class="cc-hero__badge-icon" aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></span>
                            <span>No Credit Score Impact<br>to Prequalify</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         HOW IT WORKS — 4 numbered steps (homepage journey style)
         ═══════════════════════════════════════════════════════════════ -->
    <section class="journey-section" aria-label="How CareCredit works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Four Simple Steps to Yes</h2>
                <p class="section__desc">From prequalification to your first treatment, CareCredit takes minutes — and works for every visit after.</p>
            </div>
            <div class="journey-steps reveal">
                <div class="journey-step">
                    <div class="journey-step__number">01</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    </div>
                    <h3 class="journey-step__title">Prequalify</h3>
                    <p class="journey-step__text">Check if you prequalify in seconds with no impact to your credit score.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">02</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    </div>
                    <h3 class="journey-step__title">Apply</h3>
                    <p class="journey-step__text">Complete a quick application to see your credit line and financing options.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">03</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <h3 class="journey-step__title">Pay Over Time</h3>
                    <p class="journey-step__text">Use your CareCredit card at LIVIA Med Spa and split your treatment into monthly payments.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">04</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M3 21v-5h5"/></svg>
                    </div>
                    <h3 class="journey-step__title">Reuse Anytime</h3>
                    <p class="journey-step__text">Your card works for every future visit — touch-ups, new treatments, and skincare.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHAT YOU CAN FINANCE — service chips
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cc-uses" aria-label="Treatments you can finance">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Use It on Anything</span>
                <h2 class="section__title">Every LIVIA Treatment Qualifies</h2>
                <p class="section__desc">CareCredit works for every treatment and product we offer — from a single syringe of filler to a full Helix CO2 resurfacing package.</p>
            </div>
            <div class="cc-uses__chips reveal">
                <a href="<?php echo esc_url($cc_service_url(['botox'])); ?>" class="cc-chip">Botox &amp; Injectables</a>
                <a href="<?php echo esc_url($cc_service_url(['dermal-fillers'])); ?>" class="cc-chip">Dermal Fillers</a>
                <a href="<?php echo esc_url($cc_service_url(['helix-co2-laser', 'helix-co2'])); ?>" class="cc-chip">Helix CO2 Laser</a>
                <a href="<?php echo esc_url($cc_service_url(['secret-rf-microneedling', 'rf-microneedling', 'microneedling'])); ?>" class="cc-chip">RF Microneedling</a>
                <a href="<?php echo esc_url($cc_service_url(['glp-1-weight-loss', 'glp1-weight-loss', 'weight-loss'])); ?>" class="cc-chip">GLP-1 Weight Loss</a>
                <a href="<?php echo esc_url($cc_service_url(['menopause-hormone-therapy', 'hormone-therapy'])); ?>" class="cc-chip">Hormone Therapy</a>
                <a href="<?php echo esc_url($cc_service_url(['laser-treatments'])); ?>" class="cc-chip">Laser Treatments</a>
                <a href="<?php echo esc_url($cc_service_url(['iv-therapy'])); ?>" class="cc-chip">IV Therapy</a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cc-chip cc-chip--all">View All Treatments →</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHY PATIENTS LOVE IT — benefit cards
         ═══════════════════════════════════════════════════════════════ -->
    <section class="financing-why" aria-label="Why patients choose CareCredit">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why CareCredit?</span>
                <h2 class="section__title">A Card Built for Health &amp; Beauty</h2>
            </div>
            <div class="financing-benefits reveal">
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></div>
                    <h3 class="financing-benefit__title">Soft Check to Prequalify</h3>
                    <p class="financing-benefit__text">Seeing if you prequalify never affects your credit score — apply with confidence.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
                    <h3 class="financing-benefit__title">Promotional Financing</h3>
                    <p class="financing-benefit__text">Special financing options are available on qualifying purchases — ask us for details at your visit.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M3 21v-5h5"/></svg></div>
                    <h3 class="financing-benefit__title">Reusable Credit Line</h3>
                    <p class="financing-benefit__text">Unlike one-time loans, CareCredit stays in your wallet for touch-ups and future treatments.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg></div>
                    <h3 class="financing-benefit__title">Manage It Online</h3>
                    <p class="financing-benefit__text">Track your balance, make payments, and manage your account from the CareCredit app.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         FAQ — visible content backing the CareCredit FAQPage schema
         ═══════════════════════════════════════════════════════════════ -->
    <?php if (function_exists('livia_carecredit_faqs')) : ?>
    <section class="home-faq" aria-label="CareCredit questions">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Good to Know</span>
                <h2 class="section__title">CareCredit Questions, Answered</h2>
            </div>
            <div class="home-faq__list reveal">
                <?php foreach (livia_carecredit_faqs() as $faq) : ?>
                    <details class="home-faq__item">
                        <summary class="home-faq__question"><?php echo esc_html($faq['q']); ?></summary>
                        <p class="home-faq__answer"><?php echo esc_html($faq['a']); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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

    <!-- ═══════════════════════════════════════════════════════════════
         FINAL CTA — official banner + apply
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-section" aria-label="Apply for CareCredit">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Get Started?</span>
            <h2 class="cta-section__title">Apply Today.<br>Start Your Treatment.</h2>
            <p class="cta-section__text">Apply for CareCredit in minutes and put it to work at your next LIVIA Med Spa visit. Questions? Our team is happy to walk you through your options.</p>
            <a href="<?php echo esc_url($carecredit_url); ?>" target="_blank" rel="noopener noreferrer" class="cc-cta-banner">
                <img src="https://www.carecredit.com/sites/pc/image/flexible-financing-prequal-apply-pay-420x150.png"
                     alt="CareCredit flexible financing — prequalify, apply, and pay"
                     width="420" height="150" loading="lazy" decoding="async">
            </a>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url($carecredit_url); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Apply Now</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
            <p class="carecredit-disclaimer">Subject to credit approval. See <a href="https://www.carecredit.com" target="_blank" rel="noopener noreferrer">carecredit.com</a> for details.</p>
        </div>
    </section>

</main>

<?php get_footer(); ?>
