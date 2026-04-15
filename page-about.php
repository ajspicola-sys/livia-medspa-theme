<?php
/**
 * Template Name: About
 * Livia Med Spa — About Page
 * Performance-optimized with counter animation support
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="About Livia Med Spa">
        <div class="page-hero__inner">
            <span class="section__label">About Livia Med Spa</span>
            <h1 class="page-hero__title">Our Story</h1>
            <p class="page-hero__desc">Where advanced science meets the art of natural beauty — Tampa's most trusted name in aesthetics.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="about-story" aria-label="Our story">
        <div class="section__inner">
            <div class="about-story__grid reveal">
                <div class="about-story__content">
                    <span class="section__label">Est. 2017</span>
                    <h2 class="section__title" style="text-align:left;">A Passion for Natural Beauty</h2>
                    <p class="about-text">Livia Med Spa was founded with a singular belief: that aesthetic medicine should enhance your natural beauty, not replace it. What started as a small practice in the heart of Tampa has grown into one of the region's most sought-after destinations for advanced aesthetic treatments.</p>
                    <p class="about-text">Our approach is different. We don't believe in cookie-cutter treatments or one-size-fits-all solutions. Every face tells a story, and every treatment plan we create is as unique as the person sitting in our chair.</p>
                    <p class="about-text">Over the years, we've performed more than 10,000 treatments, earned 500+ five-star reviews, and built a family of clients who trust us to help them look and feel their absolute best.</p>
                </div>
                <div class="about-story__visual">
                    <div class="about-image-placeholder">
                        <div class="about-image-gradient" aria-hidden="true"></div>
                        <span class="about-image-text">Studio Photo</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar — numeric values for counter animation -->
    <section class="stats-bar reveal" aria-label="Statistics">
        <div class="section__inner">
            <div class="stats-bar__grid">
                <div class="stats-bar__item">
                    <span class="stats-bar__number">10000+</span>
                    <span class="stats-bar__label">Treatments Performed</span>
                </div>
                <div class="stats-bar__item">
                    <span class="stats-bar__number">500+</span>
                    <span class="stats-bar__label">Five-Star Reviews</span>
                </div>
                <div class="stats-bar__item">
                    <span class="stats-bar__number">8+</span>
                    <span class="stats-bar__label">Years of Excellence</span>
                </div>
                <div class="stats-bar__item">
                    <span class="stats-bar__number">15+</span>
                    <span class="stats-bar__label">Advanced Treatments</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Preview -->
    <section class="team-preview" aria-label="Meet our team">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Our Experts</span>
                <h2 class="section__title">Meet the Team</h2>
                <p class="section__desc">Board-certified providers dedicated to delivering exceptional results with precision and care.</p>
            </div>
            <div class="team-grid reveal">
                <article class="team-card">
                    <div class="team-card__image">
                        <div class="team-card__placeholder" aria-hidden="true">DR</div>
                    </div>
                    <h3 class="team-card__name">Dr. Rachel Torres</h3>
                    <span class="team-card__role">Medical Director</span>
                    <p class="team-card__bio">Board-certified with 12+ years in aesthetic medicine. Specializes in advanced injectables and facial rejuvenation.</p>
                </article>
                <article class="team-card">
                    <div class="team-card__image">
                        <div class="team-card__placeholder" aria-hidden="true">SM</div>
                    </div>
                    <h3 class="team-card__name">Sarah Mitchell, PA-C</h3>
                    <span class="team-card__role">Lead Injector</span>
                    <p class="team-card__bio">Physician assistant with specialized training in dermal fillers and neurotoxins. Known for her artistic eye.</p>
                </article>
                <article class="team-card">
                    <div class="team-card__image">
                        <div class="team-card__placeholder" aria-hidden="true">JC</div>
                    </div>
                    <h3 class="team-card__name">Jennifer Chen, RN</h3>
                    <span class="team-card__role">Aesthetic Nurse</span>
                    <p class="team-card__bio">Registered nurse specializing in laser treatments and skin rejuvenation. Passionate about patient education.</p>
                </article>
                <article class="team-card">
                    <div class="team-card__image">
                        <div class="team-card__placeholder" aria-hidden="true">AL</div>
                    </div>
                    <h3 class="team-card__name">Amanda Lopez</h3>
                    <span class="team-card__role">Patient Coordinator</span>
                    <p class="team-card__bio">Your first point of contact. Amanda ensures every visit is seamless from booking to aftercare follow-up.</p>
                </article>
            </div>
            <div style="text-align:center;margin-top:2.5rem;" class="reveal">
                <a href="<?php echo esc_url(home_url('/team/')); ?>" class="btn btn--primary">View Full Team →</a>
            </div>
        </div>
    </section>

    <!-- Values Preview -->
    <section class="values-section" aria-label="Our core values">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">What We Stand For</span>
                <h2 class="section__title">Our Core Values</h2>
            </div>
            <div class="values-grid reveal">
                <article class="value-card">
                    <div class="value-card__number" aria-hidden="true">01</div>
                    <h3 class="value-card__title">Natural Results</h3>
                    <p class="value-card__text">We enhance your unique beauty — never overdo. Our goal is for people to say you look refreshed, not "done."</p>
                </article>
                <article class="value-card">
                    <div class="value-card__number" aria-hidden="true">02</div>
                    <h3 class="value-card__title">Patient First</h3>
                    <p class="value-card__text">Your safety, comfort, and goals drive every decision we make. We never push treatments you don't need.</p>
                </article>
                <article class="value-card">
                    <div class="value-card__number" aria-hidden="true">03</div>
                    <h3 class="value-card__title">Continuous Innovation</h3>
                    <p class="value-card__text">We invest in the latest FDA-approved technologies and ongoing education to offer you the best options available.</p>
                </article>
                <article class="value-card">
                    <div class="value-card__number" aria-hidden="true">04</div>
                    <h3 class="value-card__title">Transparency</h3>
                    <p class="value-card__text">Honest pricing, realistic expectations, and thorough consultations. No hidden fees, no pressure — ever.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Meet Us?</h2>
            <p class="cta-section__text">Book a complimentary consultation and see why Tampa trusts Livia Med Spa.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
