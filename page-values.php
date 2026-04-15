<?php
/**
 * Template Name: Values
 * Livia Med Spa — Our Values Page
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">💎 What We Believe</span>
            <h1 class="page-hero__title">Our Values</h1>
            <p class="page-hero__desc">The principles that guide every decision, every treatment, and every interaction at Livia Med Spa.</p>
        </div>
    </section>

    <section class="values-full">
        <div class="section__inner">
            <div class="values-detailed">

                <div class="value-detail reveal">
                    <div class="value-detail__number">01</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Natural Results, Always</h2>
                        <p class="value-detail__text">We believe the best aesthetic work is invisible work. Our providers are trained in the art of subtlety — enhancing your features so naturally that friends and family say you look "refreshed" or "well-rested," never "done." We will always recommend the most conservative approach first and build from there.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number">02</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Patient Safety Above All</h2>
                        <p class="value-detail__text">Your safety is non-negotiable. We exclusively use FDA-approved products from verified suppliers, maintain the highest sterilization standards, and every procedure is performed or supervised by licensed medical professionals. We never cut corners — because your health and trust are everything.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number">03</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Radical Transparency</h2>
                        <p class="value-detail__text">We believe in honesty at every step. From upfront pricing with no hidden fees, to realistic timeline expectations, to telling you when a treatment isn't right for you — transparency is the foundation of trust. You'll always know exactly what to expect before, during, and after treatment.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number">04</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Continuous Learning</h2>
                        <p class="value-detail__text">Aesthetic medicine evolves rapidly, and so do we. Our team invests hundreds of hours annually in advanced training, attends national conferences, and stays current with the latest peer-reviewed research. This commitment ensures you always receive the most effective, up-to-date treatments available.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number">05</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Inclusive Beauty</h2>
                        <p class="value-detail__text">Beauty has no single definition. We celebrate and serve clients of all ages, ethnicities, skin types, and gender identities. Our providers are trained in treating diverse skin tones and facial structures because everyone deserves access to exceptional aesthetic care.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number">06</div>
                    <div class="value-detail__content">
                        <h2 class="value-detail__title">Community First</h2>
                        <p class="value-detail__text">We're proud to be part of Tampa's community. From partnering with local charities to offering educational workshops on skin health, we believe in giving back to the community that has given us so much. When you choose Livia, you're supporting a local, women-owned business.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Experience Our Values</span>
            <h2 class="cta-section__title">See the Difference<br>Values Make</h2>
            <p class="cta-section__text">Book a consultation and experience care that's guided by integrity.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Consultation</a>
                <a href="<?php echo esc_url(home_url('/team/')); ?>" class="btn btn--outline btn--lg">Meet the Team</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
