<?php
/**
 * Template Name: Mission
 * Livia Med Spa — Our Mission Page
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">🎯 Our Purpose</span>
            <h1 class="page-hero__title">Our Mission</h1>
            <p class="page-hero__desc">To empower every individual to feel confident in their own skin through safe, innovative, and personalized aesthetic care.</p>
        </div>
    </section>

    <section class="mission-content">
        <div class="section__inner">
            <div class="mission-statement reveal">
                <blockquote class="mission-quote">
                    "We believe that true beauty isn't about changing who you are — it's about revealing the best version of yourself."
                </blockquote>
                <span class="mission-quote__author">— Dr. Rachel Torres, Founder</span>
            </div>

            <div class="mission-pillars reveal">
                <div class="mission-pillar">
                    <div class="mission-pillar__icon">🔬</div>
                    <h3 class="mission-pillar__title">Science-Driven Care</h3>
                    <p class="mission-pillar__text">Every treatment we offer is backed by clinical research and FDA approval. We stay at the forefront of aesthetic medicine through continuous education and investment in the latest technology.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon">🎨</div>
                    <h3 class="mission-pillar__title">Artistry in Practice</h3>
                    <p class="mission-pillar__text">Aesthetics is as much an art as it is a science. Our providers are trained to see facial harmony, understand proportions, and deliver results that look natural and beautiful from every angle.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon">🤝</div>
                    <h3 class="mission-pillar__title">Personal Connection</h3>
                    <p class="mission-pillar__text">You're not a number here. We take time to listen to your goals, understand your concerns, and build a treatment plan that fits your life, your budget, and your comfort level.</p>
                </div>
            </div>

            <div class="mission-vision reveal">
                <div class="mission-vision__content">
                    <span class="section__label">Looking Forward</span>
                    <h2 class="section__title" style="text-align:left;">Our Vision for the Future</h2>
                    <p class="about-text">As aesthetics continues to evolve, so do we. Our vision is to expand access to premium aesthetic care while maintaining the intimate, boutique experience that our clients love.</p>
                    <p class="about-text">We're investing in regenerative medicine, AI-assisted treatment planning, and expanded training programs to ensure that every patient receives the most advanced care available — delivered with the personal touch that makes Livia special.</p>
                    <p class="about-text">Our ultimate goal? To be the name synonymous with natural, beautiful results in Tampa and beyond.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Experience the Difference</span>
            <h2 class="cta-section__title">See Our Mission<br>in Action</h2>
            <p class="cta-section__text">Book your consultation and experience the Livia difference firsthand.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Consultation</a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--outline btn--lg">Our Story</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
