<?php
/**
 * Livia Med Spa — Beauty Bank Membership Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero beauty-bank-hero" aria-label="Beauty Bank Membership">
        <div class="page-hero__inner">
            <span class="section__label">Exclusive Membership</span>
            <h1 class="page-hero__title">Beauty Bank<br><em>Membership</em></h1>
            <p class="page-hero__desc">The easiest way to invest in yourself — consistent treatments, exclusive savings, and total flexibility.</p>
            <div style="margin-top:2rem;">
                <a href="#book-now" class="btn btn--primary btn--lg">Join Today</a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="beauty-bank-section beauty-bank-how" aria-label="How Beauty Bank works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Simple &amp; Seamless</span>
                <h2 class="section__title">How It Works</h2>
            </div>
            <div class="beauty-bank-steps reveal">
                <div class="beauty-bank-step">
                    <div class="beauty-bank-step__num">01</div>
                    <h3>Monthly Deposit</h3>
                    <p>Your monthly membership payment is automatically deposited into your Beauty Bank balance.</p>
                </div>
                <div class="beauty-bank-step">
                    <div class="beauty-bank-step__num">02</div>
                    <h3>Spend Your Way</h3>
                    <p>Those funds can be applied toward most treatments and services at Livia Med Spa.</p>
                </div>
                <div class="beauty-bank-step">
                    <div class="beauty-bank-step__num">03</div>
                    <h3>Balance Rolls Over</h3>
                    <p>Balances roll over month-to-month as long as your membership stays active — no wasted funds.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="beauty-bank-section beauty-bank-benefits" aria-label="Membership benefits">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Member Perks</span>
                <h2 class="section__title">Membership Benefits</h2>
            </div>
            <div class="beauty-bank-benefit-grid reveal">
                <div class="beauty-bank-benefit">
                    <span class="beauty-bank-benefit__icon">💎</span>
                    <h3>Exclusive Discounts</h3>
                    <p>Exclusive discounts on select treatments and services, available only to Beauty Bank members.</p>
                </div>
                <div class="beauty-bank-benefit">
                    <span class="beauty-bank-benefit__icon">⭐</span>
                    <h3>VIP Access</h3>
                    <p>Access to special promotions, VIP offers, and early access to new treatments.</p>
                </div>
                <div class="beauty-bank-benefit">
                    <span class="beauty-bank-benefit__icon">✨</span>
                    <h3>Total Flexibility</h3>
                    <p>Apply your Beauty Bank funds to the treatments you love most — your balance, your choice.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Policy Details -->
    <section class="beauty-bank-section beauty-bank-policy" aria-label="Membership policy details">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Membership Terms</span>
                <h2 class="section__title">What You Need to Know</h2>
            </div>
            <div class="beauty-bank-policy-grid reveal">

                <div class="beauty-bank-policy-card">
                    <div class="beauty-bank-policy-card__icon">📅</div>
                    <h3>Minimum Commitment</h3>
                    <ul>
                        <li>All memberships require a <strong>6-month minimum commitment.</strong></li>
                        <li>This ensures members can fully benefit from consistent treatments and exclusive savings.</li>
                    </ul>
                </div>

                <div class="beauty-bank-policy-card">
                    <div class="beauty-bank-policy-card__icon">⚠️</div>
                    <h3>Early Cancellation</h3>
                    <ul>
                        <li>If canceled before the 6-month minimum, any <strong>discounts, promotions, or savings received must be repaid.</strong></li>
                        <li>All services used will be adjusted back to regular retail pricing.</li>
                    </ul>
                </div>

                <div class="beauty-bank-policy-card">
                    <div class="beauty-bank-policy-card__icon">⏸️</div>
                    <h3>Freezes &amp; Holds</h3>
                    <ul>
                        <li>Memberships can be placed on hold for <strong>up to 2 months</strong> due to medical reasons or extended travel.</li>
                        <li>Management approval required.</li>
                    </ul>
                </div>

                <div class="beauty-bank-policy-card">
                    <div class="beauty-bank-policy-card__icon">🔄</div>
                    <h3>After Your Commitment</h3>
                    <ul>
                        <li>After 6 months, your membership continues <strong>month-to-month.</strong></li>
                        <li>Cancel anytime with <strong>30 days' written notice.</strong></li>
                        <li>Any remaining balance stays in your Beauty Bank until fully used.</li>
                    </ul>
                </div>

                <div class="beauty-bank-policy-card">
                    <div class="beauty-bank-policy-card__icon">🚫</div>
                    <h3>Refunds</h3>
                    <ul>
                        <li>All Beauty Bank deposits are <strong>non-refundable.</strong></li>
                        <li>Balances cannot be transferred or redeemed for cash.</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Join Beauty Bank">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Invest in Yourself</span>
            <h2 class="cta-section__title">Ready to Join<br>Beauty Bank?</h2>
            <p class="cta-section__text">Our Beauty Bank is the easiest way to stay consistent with your treatments while enjoying flexibility and exclusive savings.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
