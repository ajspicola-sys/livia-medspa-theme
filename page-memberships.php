<?php
/**
 * Template Name: Memberships
 * Livia Med Spa — Beauty Bank Memberships
 */
get_header(); ?>

<main class="site-main">

    <!-- Hero -->
    <section class="page-hero page-hero--memberships">
        <div class="page-hero__inner">
            <span class="section__label">💎 Beauty Bank Membership</span>
            <h1 class="page-hero__title">Bank Your Beauty,<br><em>Unlock Your Glow</em></h1>
            <p class="page-hero__desc">Livia Med Spa's exclusive membership program designed to make self-care smarter and more rewarding. Your monthly contribution is safely stored as credit, ready to use whenever you choose.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Become a Member →</a>
                <a href="#how-it-works" class="btn btn--outline btn--lg">How It Works</a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="membership-how" id="how-it-works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">The Smart Way to Glow</h2>
                <p class="section__desc">Build your beauty over time with a membership that turns every monthly deposit into real value. No gimmicks — just flexible, banked credits ready when you are.</p>
            </div>
            <div class="membership-steps reveal">
                <div class="membership-step">
                    <div class="membership-step__icon">💰</div>
                    <div class="membership-step__number">01</div>
                    <h3 class="membership-step__title">Choose Your Monthly Deposit</h3>
                    <p class="membership-step__text">Pick a monthly contribution amount that fits your budget. Every dollar goes into your personal Beauty Bank.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon">🏦</div>
                    <div class="membership-step__number">02</div>
                    <h3 class="membership-step__title">Credits Accumulate</h3>
                    <p class="membership-step__text">Your contributions are safely stored as credits, building up month after month toward treatments you love.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon">✨</div>
                    <div class="membership-step__number">03</div>
                    <h3 class="membership-step__title">Redeem Anytime</h3>
                    <p class="membership-step__text">Use your banked credits whenever you're ready — on Botox, fillers, facials, laser treatments, or skincare products.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon">🎁</div>
                    <div class="membership-step__number">04</div>
                    <h3 class="membership-step__title">Enjoy VIP Perks</h3>
                    <p class="membership-step__text">Unlock exclusive member-only pricing, early access to promotions, and flexible payment options.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Beauty Bank -->
    <section class="membership-why">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Choose Beauty Bank</span>
                <h2 class="section__title">Your Beauty, Your Terms</h2>
            </div>
            <div class="membership-benefits reveal">
                <div class="membership-benefit">
                    <div class="membership-benefit__icon-wrap">
                        <span>💎</span>
                    </div>
                    <h3 class="membership-benefit__title">Smart Savings, Stunning Results</h3>
                    <p class="membership-benefit__text">With our Beauty Bank membership, every dollar you deposit becomes a future beauty investment. Your monthly contributions turn into credits you can use on the treatments you love — when you're ready.</p>
                </div>
                <div class="membership-benefit">
                    <div class="membership-benefit__icon-wrap">
                        <span>🎯</span>
                    </div>
                    <h3 class="membership-benefit__title">More Perks, Less Pressure</h3>
                    <p class="membership-benefit__text">Enjoy exclusive member-only pricing, early access to promotions, and flexible payment that works with your schedule. No stress, just beauty on your terms.</p>
                </div>
                <div class="membership-benefit">
                    <div class="membership-benefit__icon-wrap">
                        <span>🪄</span>
                    </div>
                    <h3 class="membership-benefit__title">Tailored to You</h3>
                    <p class="membership-benefit__text">Bank your dollars now, and use them however you like — whether it's Botox, fillers, facials, or laser treatments. It's your beauty, your way.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rewards Programs -->
    <section class="membership-rewards">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Reward Programs</span>
                <h2 class="section__title">Earn Points, Save More</h2>
                <p class="section__desc">Stack your Beauty Bank credits with these manufacturer reward programs for even bigger savings.</p>
            </div>
            <div class="rewards-grid reveal">
                <!-- Allē -->
                <div class="reward-card">
                    <div class="reward-card__badge">Allergan</div>
                    <h3 class="reward-card__title">Allē Rewards</h3>
                    <p class="reward-card__text">Earn points on every Allergan product — Botox, Juvéderm, CoolSculpting, and more. Every 200 points = <strong>$20 in savings</strong>.</p>
                    <div class="reward-card__perks">
                        <span class="reward-card__perk">✓ Points on every visit</span>
                        <span class="reward-card__perk">✓ $20 per 200 points</span>
                        <span class="reward-card__perk">✓ Works on all Allergan products</span>
                    </div>
                    <div class="reward-card__downloads">
                        <a href="#" class="btn btn--primary btn--sm">Download for Apple</a>
                        <a href="#" class="btn btn--outline btn--sm">Download for Android</a>
                    </div>
                </div>

                <!-- Aspire -->
                <div class="reward-card reward-card--featured">
                    <div class="reward-card__badge">Galderma</div>
                    <h3 class="reward-card__title">Aspire Rewards</h3>
                    <p class="reward-card__text">Join free and receive a welcome savings of <strong>$20 off</strong>! After that, every 100 points = <strong>$10 in savings</strong> on treatments you love.</p>
                    <div class="reward-card__perks">
                        <span class="reward-card__perk">✓ Free to join</span>
                        <span class="reward-card__perk">✓ $20 welcome bonus</span>
                        <span class="reward-card__perk">✓ $10 per 100 points</span>
                    </div>
                    <div class="reward-card__downloads">
                        <a href="#" class="btn btn--primary btn--sm">Download for Apple</a>
                        <a href="#" class="btn btn--outline btn--sm">Download for Android</a>
                    </div>
                </div>

                <!-- Evolus -->
                <div class="reward-card">
                    <div class="reward-card__badge">Evolus</div>
                    <h3 class="reward-card__title">Evolus Rewards</h3>
                    <p class="reward-card__text">Earn rewards on Jeuveau™ treatments and save on your next visit. Join the program and start saving today.</p>
                    <div class="reward-card__perks">
                        <span class="reward-card__perk">✓ Savings on Jeuveau™</span>
                        <span class="reward-card__perk">✓ Easy enrollment</span>
                        <span class="reward-card__perk">✓ Exclusive member offers</span>
                    </div>
                    <div class="reward-card__downloads">
                        <a href="#" class="btn btn--primary btn--sm">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Banking Beauty</span>
            <h2 class="cta-section__title">Ready to Join<br>the Beauty Bank?</h2>
            <p class="cta-section__text">Become a member today and start building your beauty credits. Your future glow-ups are waiting.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Become a Member</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
