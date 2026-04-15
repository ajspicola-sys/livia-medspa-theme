<?php
/**
 * Livia Med Spa — Single Service Template
 * Performance-optimized with Schema.org markup
 */
get_header();

$icon     = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
$price    = get_post_meta(get_the_ID(), '_service_price', true);
$duration = get_post_meta(get_the_ID(), '_service_duration', true);
?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Service details">
        <div class="page-hero__inner">
            <span class="section__label"><span aria-hidden="true"><?php echo esc_html($icon); ?></span> Treatment</span>
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="page-hero__desc"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="single-service" itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <div class="section__inner">
            <div class="single-service__grid">

                <!-- Main Content -->
                <div class="single-service__content reveal">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="single-service__image">
                            <?php the_post_thumbnail('large', [
                                'loading'       => 'eager',
                                'decoding'      => 'async',
                                'fetchpriority' => 'high',
                                'itemprop'      => 'image',
                            ]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content__body" itemprop="description">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="single-service__sidebar reveal" aria-label="Treatment information">
                    <!-- Quick Info -->
                    <div class="service-info-card">
                        <h3 class="service-info-card__title">Treatment Details</h3>
                        <?php if ($price) : ?>
                            <div class="service-info-card__row">
                                <span class="service-info-card__label">Starting at</span>
                                <span class="service-info-card__value"><?php echo esc_html($price); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($duration) : ?>
                            <div class="service-info-card__row">
                                <span class="service-info-card__label">Duration</span>
                                <span class="service-info-card__value"><?php echo esc_html($duration); ?></span>
                            </div>
                        <?php endif; ?>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary" style="width:100%;margin-top:1.25rem;">Book This Treatment</a>
                    </div>

                    <!-- Back to Services -->
                    <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline" style="width:100%;text-align:center;">← All Services</a>
                </aside>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
