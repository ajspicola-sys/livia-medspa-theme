<?php
/**
 * Livia Med Spa — Services Archive
 * Performance-optimized
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Services overview">
        <div class="page-hero__inner">
            <span class="section__label">Our Expertise</span>
            <h1 class="page-hero__title">Our Services</h1>
            <p class="page-hero__desc">Advanced aesthetic treatments tailored to enhance your natural beauty.</p>
        </div>
    </section>

    <section class="services-archive" aria-label="All services">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="services__grid reveal">
                    <?php while (have_posts()) : the_post();
                        $icon     = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                        $price    = get_post_meta(get_the_ID(), '_service_price', true);
                        $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                    ?>
                        <a href="<?php the_permalink(); ?>" class="service-card" aria-label="<?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="service-card__thumb">
                                    <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                </div>
                            <?php else : ?>
                                <div class="service-card__icon" aria-hidden="true"><?php echo esc_html($icon); ?></div>
                            <?php endif; ?>
                            <h3 class="service-card__title"><?php the_title(); ?></h3>
                            <p class="service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <?php if ($price || $duration) : ?>
                                <div class="service-card__meta">
                                    <?php if ($price) : ?>
                                        <span class="service-card__price"><?php echo esc_html($price); ?></span>
                                    <?php endif; ?>
                                    <?php if ($duration) : ?>
                                        <span class="service-card__duration">⏱ <?php echo esc_html($duration); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <span class="service-card__link">Learn More →</span>
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="section__header" style="text-align:center;padding:4rem 0;">
                    <span class="section__label">Coming Soon</span>
                    <h2 class="section__title">Our Services</h2>
                    <p class="section__desc">We're preparing our treatment menu. In the meantime, contact us for a consultation.</p>
                    <div style="margin-top:1.5rem;">
                        <a href="#book-now" class="btn btn--primary">Book Consultation</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Book a treatment">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Glow?</span>
            <h2 class="cta-section__title">Find Your<br>Perfect Treatment</h2>
            <p class="cta-section__text">Not sure which service is right for you? Book a complimentary consultation and let our experts guide you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
