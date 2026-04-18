<?php
/**
 * Template Name: Values
 * LIVIA Med Spa — Our Mission & Values Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Our Mission">
        <div class="page-hero__inner">
            <span class="section__label"><span aria-hidden="true">🎯</span> What Drives Us</span>
            <h1 class="page-hero__title">Our Mission</h1>
            <p class="page-hero__desc">To elevate the standard of aesthetic care through artistry, science, and an unwavering commitment to your natural beauty.</p>
        </div>
    </section>

    <!-- Mission Statement -->
    <section class="mission-section" aria-label="Our mission statement">
        <div class="section__inner">
            <div class="mission-statement reveal">
                <div class="mission-statement__quote">
                    "We believe that true beauty isn't about changing who you are — it's about revealing the best version of yourself."
                </div>
                <span class="mission-statement__author">— The LIVIA Med Spa Team</span>
            </div>

            <div class="mission-pillars reveal">
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true">🔬</div>
                    <h2 class="mission-pillar__title">Science-Backed</h2>
                    <p class="mission-pillar__text">Every treatment we offer is grounded in clinical research and performed using FDA-approved products and technologies. We never compromise on safety or efficacy.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true">🎨</div>
                    <h2 class="mission-pillar__title">Artistry-Driven</h2>
                    <p class="mission-pillar__text">Aesthetic medicine is as much art as it is science. Our providers are trained to see the whole picture — balancing proportions, symmetry, and your unique features for naturally stunning results.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true">💛</div>
                    <h2 class="mission-pillar__title">Patient-Centered</h2>
                    <p class="mission-pillar__text">Your goals come first. We listen, educate, and collaborate so you feel confident and empowered in every decision — from your first consultation to your follow-up care.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="section-divider" aria-hidden="true">
        <div class="section__inner">
            <div class="section-divider__line"></div>
        </div>
    </div>

    <!-- Values Section -->
    <section class="values-full" aria-label="Our core values">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label"><span aria-hidden="true">💎</span> What We Believe</span>
                <h2 class="section__title">Our Values</h2>
                <p class="section__desc">The principles that guide every decision, every treatment, and every interaction at LIVIA Med Spa.</p>
            </div>
            <div class="values-detailed">

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">01</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Natural Results, Always</h3>
                        <p class="value-detail__text">We believe the best aesthetic work is invisible work. Our providers are trained in the art of subtlety — enhancing your features so naturally that friends and family say you look "refreshed" or "well-rested," never "done." We will always recommend the most conservative approach first and build from there.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">02</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Patient Safety Above All</h3>
                        <p class="value-detail__text">Your safety is non-negotiable. We exclusively use FDA-approved products from verified suppliers, maintain the highest sterilization standards, and every procedure is performed or supervised by licensed medical professionals. We never cut corners — because your health and trust are everything.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">03</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Radical Transparency</h3>
                        <p class="value-detail__text">We believe in honesty at every step. From upfront pricing with no hidden fees, to realistic timeline expectations, to telling you when a treatment isn't right for you — transparency is the foundation of trust. You'll always know exactly what to expect before, during, and after treatment.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">04</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Continuous Learning</h3>
                        <p class="value-detail__text">Aesthetic medicine evolves rapidly, and so do we. Our team invests hundreds of hours annually in advanced training, attends national conferences, and stays current with the latest peer-reviewed research. This commitment ensures you always receive the most effective, up-to-date treatments available.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">05</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Inclusive Beauty</h3>
                        <p class="value-detail__text">Beauty has no single definition. We celebrate and serve clients of all ages, ethnicities, skin types, and gender identities. Our providers are trained in treating diverse skin tones and facial structures because everyone deserves access to exceptional aesthetic care.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">06</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Community First</h3>
                        <p class="value-detail__text">We're proud to be part of Tampa's community. From partnering with local charities to offering educational workshops on skin health, we believe in giving back to the community that has given us so much. When you choose LIVIA, you're supporting a local, women-owned business.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Experience our mission">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Experience the Difference</span>
            <h2 class="cta-section__title">See Our Mission<br>in Action</h2>
            <p class="cta-section__text">Book a consultation and experience care that's guided by purpose and integrity.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book Consultation</a>
                <a href="<?php echo esc_url(home_url('/team/')); ?>" class="btn btn--outline btn--lg">Meet the Team</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
