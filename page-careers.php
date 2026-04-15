<?php
/**
 * Template Name: Careers
 * Livia Med Spa — Careers Page
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">💼 Join Our Team</span>
            <h1 class="page-hero__title">Careers at Livia</h1>
            <p class="page-hero__desc">Join Tampa's premier aesthetics practice and help our clients look and feel their best.</p>
        </div>
    </section>

    <!-- Why Work Here -->
    <section class="careers-why">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Livia?</span>
                <h2 class="section__title">More Than Just a Job</h2>
                <p class="section__desc">We're building Tampa's most trusted aesthetics brand — and we want you to be part of it.</p>
            </div>
            <div class="careers-perks reveal">
                <div class="careers-perk">
                    <div class="careers-perk__icon">💰</div>
                    <h3 class="careers-perk__title">Competitive Pay</h3>
                    <p class="careers-perk__text">Above-market compensation with performance bonuses and commission opportunities.</p>
                </div>
                <div class="careers-perk">
                    <div class="careers-perk__icon">📚</div>
                    <h3 class="careers-perk__title">Continuing Education</h3>
                    <p class="careers-perk__text">We invest in your growth with paid training, conferences, and advanced certification programs.</p>
                </div>
                <div class="careers-perk">
                    <div class="careers-perk__icon">🎁</div>
                    <h3 class="careers-perk__title">Amazing Perks</h3>
                    <p class="careers-perk__text">Complimentary treatments, product discounts, flexible scheduling, and a supportive team culture.</p>
                </div>
                <div class="careers-perk">
                    <div class="careers-perk__icon">📈</div>
                    <h3 class="careers-perk__title">Growth Path</h3>
                    <p class="careers-perk__text">Clear advancement opportunities as our practice grows. We promote from within whenever possible.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Positions -->
    <section class="careers-positions">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Open Roles</span>
                <h2 class="section__title">Current Openings</h2>
            </div>
            <div class="positions-list reveal">
                <div class="position-card">
                    <div class="position-card__info">
                        <h3 class="position-card__title">Aesthetic Nurse Injector</h3>
                        <div class="position-card__tags">
                            <span class="position-card__tag">Full-Time</span>
                            <span class="position-card__tag">Tampa, FL</span>
                            <span class="position-card__tag">RN Required</span>
                        </div>
                        <p class="position-card__desc">Join our injection team and help clients achieve natural, beautiful results. Requires RN license and injectable training.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--sm">Apply Now →</a>
                </div>
                <div class="position-card">
                    <div class="position-card__info">
                        <h3 class="position-card__title">Laser Technician</h3>
                        <div class="position-card__tags">
                            <span class="position-card__tag">Full-Time</span>
                            <span class="position-card__tag">Tampa, FL</span>
                            <span class="position-card__tag">Certified</span>
                        </div>
                        <p class="position-card__desc">Operate our advanced laser systems for skin rejuvenation, hair removal, and pigment correction treatments.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--sm">Apply Now →</a>
                </div>
                <div class="position-card">
                    <div class="position-card__info">
                        <h3 class="position-card__title">Front Desk Coordinator</h3>
                        <div class="position-card__tags">
                            <span class="position-card__tag">Full-Time</span>
                            <span class="position-card__tag">Tampa, FL</span>
                        </div>
                        <p class="position-card__desc">Be the first point of contact for our clients. Manage scheduling, patient flow, and create a warm, welcoming environment.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--sm">Apply Now →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Don't See Your Role?</span>
            <h2 class="cta-section__title">We're Always Looking<br>for Great People</h2>
            <p class="cta-section__text">Send us your resume and tell us why you'd be a great fit for the Livia team.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Contact Us</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
