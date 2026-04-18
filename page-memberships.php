<?php
/**
 * Template Name: Memberships
 * Livia Med Spa — LIVIA Luxe Membership Tiers
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero page-hero--memberships" aria-label="LIVIA Luxe Membership">
        <div class="page-hero__inner">
            <span class="section__label">Exclusive Membership Program</span>
            <h1 class="page-hero__title">LIVIA Luxe<br><em>Membership</em></h1>
            <p class="page-hero__desc">Unlock exclusive savings, priority scheduling, and VIP perks with Tampa's most luxurious med spa membership. Choose the tier that fits your lifestyle and start glowing.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="#membership-tiers" class="btn btn--primary btn--lg">View Memberships →</a>
                <a href="#how-it-works" class="btn btn--outline btn--lg">How It Works</a>
            </div>
        </div>
    </section>

    <!-- Membership Tiers -->
    <section class="membership-tiers" id="membership-tiers" aria-label="Membership plans">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Choose Your Tier</span>
                <h2 class="section__title">Three Levels of Luxury</h2>
                <p class="section__desc">Every tier includes priority scheduling and exclusive member pricing. The only question is — how much glow do you want?</p>
            </div>

            <div class="tier-cards reveal">

                <!-- Tier 1: LIVIA Luxe -->
                <article class="tier-card" id="tier-luxe">
                    <div class="tier-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/membership-luxe.png"
                             alt="LIVIA Luxe membership — spa facial treatment"
                             loading="lazy" decoding="async" width="600" height="400">
                        <div class="tier-card__image-overlay"></div>
                        <span class="tier-card__tier-label">Tier 01</span>
                    </div>
                    <div class="tier-card__body">
                        <div class="tier-card__header">
                            <h3 class="tier-card__name">LIVIA Luxe</h3>
                            <div class="tier-card__price-row">
                                <span class="tier-card__price"><span class="tier-card__currency">$</span>99<span class="tier-card__cents">.99</span></span>
                                <span class="tier-card__period">/month</span>
                            </div>
                        </div>
                        <ul class="tier-card__perks">
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>$1 off/unit</strong> of Tox</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>10%</strong> Savings on Skincare</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>10%</strong> Savings on All Services<br><small>(Excludes Weight Loss)</small></span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Priority Scheduling</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Member-Only Pricing</span>
                            </li>
                        </ul>
                        <a href="#book-now" class="btn btn--outline btn--lg tier-card__btn">Enroll Now →</a>
                    </div>
                </article>

                <!-- Tier 2: LIVIA Luxe Signature (FEATURED) -->
                <article class="tier-card tier-card--featured" id="tier-signature">
                    <div class="tier-card__popular-badge">Most Popular</div>
                    <div class="tier-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/membership-signature.png"
                             alt="LIVIA Luxe Signature — luxury spa experience"
                             loading="lazy" decoding="async" width="600" height="400">
                        <div class="tier-card__image-overlay"></div>
                        <span class="tier-card__tier-label">Tier 02</span>
                    </div>
                    <div class="tier-card__body">
                        <div class="tier-card__header">
                            <h3 class="tier-card__name">LIVIA Luxe<br><em>Signature</em></h3>
                            <div class="tier-card__price-row">
                                <span class="tier-card__price"><span class="tier-card__currency">$</span>199<span class="tier-card__cents">.99</span></span>
                                <span class="tier-card__period">/month</span>
                            </div>
                        </div>
                        <ul class="tier-card__perks">
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>$2 off/unit</strong> of Tox</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>15%</strong> Savings on Skincare</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>15%</strong> Savings on All Services<br><small>(Excludes Weight Loss)</small></span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Priority Scheduling</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Member-Only Pricing</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Early Access to Promos</span>
                            </li>
                        </ul>
                        <a href="#book-now" class="btn btn--primary btn--lg tier-card__btn">Enroll Now →</a>
                    </div>
                </article>

                <!-- Tier 3: LIVIA Luxe Prestige -->
                <article class="tier-card tier-card--prestige" id="tier-prestige">
                    <div class="tier-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/membership-prestige.png"
                             alt="LIVIA Luxe Prestige — ultra-premium aesthetic experience"
                             loading="lazy" decoding="async" width="600" height="400">
                        <div class="tier-card__image-overlay"></div>
                        <span class="tier-card__tier-label">Tier 03</span>
                    </div>
                    <div class="tier-card__body">
                        <div class="tier-card__header">
                            <h3 class="tier-card__name">LIVIA Luxe<br><em>Prestige</em></h3>
                            <div class="tier-card__price-row">
                                <span class="tier-card__price"><span class="tier-card__currency">$</span>299<span class="tier-card__cents">.99</span></span>
                                <span class="tier-card__period">/month</span>
                            </div>
                        </div>
                        <ul class="tier-card__perks">
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>$3 off/unit</strong> of Tox</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>20%</strong> Savings on Skincare</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span><strong>20%</strong> Savings on All Services<br><small>(Excludes Weight Loss)</small></span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Priority Scheduling</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Member-Only Pricing</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Early Access to Promos</span>
                            </li>
                            <li class="tier-card__perk">
                                <span class="tier-card__perk-icon">✓</span>
                                <span>Complimentary Birthday Treatment</span>
                            </li>
                        </ul>
                        <a href="#book-now" class="btn btn--outline btn--lg tier-card__btn tier-card__btn--prestige">Enroll Now →</a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="membership-compare" aria-label="Membership comparison">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Compare Plans</span>
                <h2 class="section__title">Side-by-Side</h2>
            </div>
            <div class="compare-table-wrap reveal">
                <table class="compare-table" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Feature</th>
                            <th scope="col">Luxe</th>
                            <th scope="col" class="compare-table__featured">Signature</th>
                            <th scope="col">Prestige</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monthly Price</td>
                            <td>$99.99</td>
                            <td class="compare-table__featured">$199.99</td>
                            <td>$299.99</td>
                        </tr>
                        <tr class="compare-table__highlight">
                            <td><strong>Tox Discount</strong></td>
                            <td><strong>$1<small>/unit</small></strong></td>
                            <td class="compare-table__featured"><strong>$2<small>/unit</small></strong></td>
                            <td><strong>$3<small>/unit</small></strong></td>
                        </tr>
                        <tr>
                            <td>Skincare Savings</td>
                            <td>10%</td>
                            <td class="compare-table__featured">15%</td>
                            <td>20%</td>
                        </tr>
                        <tr>
                            <td>Service Savings</td>
                            <td>10%</td>
                            <td class="compare-table__featured">15%</td>
                            <td>20%</td>
                        </tr>
                        <tr>
                            <td>Priority Scheduling</td>
                            <td><span class="compare-check">✓</span></td>
                            <td class="compare-table__featured"><span class="compare-check">✓</span></td>
                            <td><span class="compare-check">✓</span></td>
                        </tr>
                        <tr>
                            <td>Early Access to Promos</td>
                            <td><span class="compare-dash">—</span></td>
                            <td class="compare-table__featured"><span class="compare-check">✓</span></td>
                            <td><span class="compare-check">✓</span></td>
                        </tr>
                        <tr>
                            <td>Birthday Treatment</td>
                            <td><span class="compare-dash">—</span></td>
                            <td class="compare-table__featured"><span class="compare-dash">—</span></td>
                            <td><span class="compare-check">✓</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="membership-how" id="how-it-works" aria-label="How the membership works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Getting Started is Easy</h2>
                <p class="section__desc">From signup to savings — your membership starts working for you immediately.</p>
            </div>
            <div class="membership-steps reveal">
                <div class="membership-step">
                    <div class="membership-step__icon" aria-hidden="true">✦</div>
                    <div class="membership-step__number">01</div>
                    <h3 class="membership-step__title">Choose Your Tier</h3>
                    <p class="membership-step__text">Pick LIVIA Luxe, Signature, or Prestige based on your beauty goals and budget.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon" aria-hidden="true">✦</div>
                    <div class="membership-step__number">02</div>
                    <h3 class="membership-step__title">Enroll Online or In-Spa</h3>
                    <p class="membership-step__text">Sign up in minutes — our team will walk you through everything and answer any questions.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon" aria-hidden="true">✦</div>
                    <div class="membership-step__number">03</div>
                    <h3 class="membership-step__title">Start Saving Instantly</h3>
                    <p class="membership-step__text">Your member discounts apply immediately on skincare products and all eligible services.</p>
                </div>
                <div class="membership-step">
                    <div class="membership-step__icon" aria-hidden="true">✦</div>
                    <div class="membership-step__number">04</div>
                    <h3 class="membership-step__title">Enjoy VIP Perks</h3>
                    <p class="membership-step__text">Unlock priority scheduling, exclusive member pricing, and first access to promotions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rewards Programs -->
    <section class="membership-rewards" aria-label="Reward programs">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Stack Your Savings</span>
                <h2 class="section__title">Reward Programs</h2>
                <p class="section__desc">Combine your LIVIA Luxe membership with manufacturer reward programs for even bigger savings.</p>
            </div>
            <div class="rewards-grid reveal">
                <!-- Allē -->
                <article class="reward-card">
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
                </article>

                <!-- Aspire -->
                <article class="reward-card reward-card--featured">
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
                </article>

                <!-- Evolus -->
                <article class="reward-card">
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
                </article>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section" aria-label="Frequently asked questions">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Have Questions?</span>
                <h2 class="section__title">Membership FAQ</h2>
            </div>
            <div class="faq-list reveal">
                <details class="faq-item">
                    <summary class="faq-item__question">Is there a minimum commitment?</summary>
                    <div class="faq-item__answer">
                        <p>We ask for a minimum 6-month commitment to get the most out of your LIVIA Luxe membership. After that, you can continue month-to-month or cancel anytime.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Can I upgrade or downgrade my tier?</summary>
                    <div class="faq-item__answer">
                        <p>Absolutely! You can change your membership tier at any time. Simply contact us and we'll adjust your plan at the beginning of your next billing cycle.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Do my savings apply to all services?</summary>
                    <div class="faq-item__answer">
                        <p>Your member discount applies to all services and skincare products we offer — Botox, fillers, facials, laser treatments, IV therapy, and more. Weight loss services are excluded.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Can I share my membership with family?</summary>
                    <div class="faq-item__answer">
                        <p>Memberships are individual, but we offer family plans! Contact us to learn about multi-member discounts for households.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">What is Priority Scheduling?</summary>
                    <div class="faq-item__answer">
                        <p>LIVIA Luxe members get first access to appointment slots, including prime-time weekday evenings and Saturdays. You'll also get shorter wait times for last-minute bookings.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Join LIVIA Luxe">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Membership</span>
            <h2 class="cta-section__title">Ready to Unlock<br>Your VIP Glow?</h2>
            <p class="cta-section__text">Choose your tier and start saving on every treatment. Your most radiant self is waiting.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Become a Member</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
