<?php
/**
 * Livia Med Spa — Services Archive
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">Our Expertise</span>
            <h1 class="page-hero__title">Our Services</h1>
            <p class="page-hero__desc">Advanced aesthetic treatments tailored to enhance your natural beauty.</p>
        </div>
    </section>

    <section class="services-archive">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="services__grid reveal">
                    <?php while (have_posts()) : the_post();
                        $icon     = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                        $price    = get_post_meta(get_the_ID(), '_service_price', true);
                        $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                    ?>
                        <a href="<?php the_permalink(); ?>" class="service-card">
                            <div class="service-card__icon"><?php echo esc_html($icon); ?></div>
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
                <div class="section__header">
                    <h2 class="section__title">Coming Soon</h2>
                    <p class="section__desc">Our services are being added. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
