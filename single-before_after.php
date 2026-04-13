<?php
/**
 * Single Before & After Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

while (have_posts()) : the_post();
    $before_img   = get_post_meta(get_the_ID(), '_livia_before_image', true);
    $after_img    = get_post_meta(get_the_ID(), '_livia_after_image', true);
    $description  = get_post_meta(get_the_ID(), '_livia_ba_description', true);
    $service_id   = get_post_meta(get_the_ID(), '_livia_related_service', true);
    $service_name = $service_id ? get_the_title($service_id) : '';
    $areas        = get_the_terms(get_the_ID(), 'treatment_area');
?>

<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Before & After</span>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
        <?php if ($service_name) : ?>
            <p class="page-hero__desc">Treatment: <a href="<?php echo get_permalink($service_id); ?>" style="color: var(--color-gold-light);"><?php echo esc_html($service_name); ?></a></p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container container--narrow">
        <!-- Slider -->
        <div class="ba-slider animate-on-scroll" data-ba-slider style="aspect-ratio: 16/10; max-width: 800px; margin: 0 auto;">
            <div class="ba-slider__after">
                <?php if ($after_img) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($after_img, 'large')); ?>" alt="After - <?php the_title(); ?>">
                <?php endif; ?>
            </div>
            <div class="ba-slider__before">
                <?php if ($before_img) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($before_img, 'large')); ?>" alt="Before - <?php the_title(); ?>">
                <?php endif; ?>
            </div>
            <div class="ba-slider__divider"></div>
            <div class="ba-slider__handle">⇔</div>
            <span class="ba-slider__label ba-slider__label--before">Before</span>
            <span class="ba-slider__label ba-slider__label--after">After</span>
        </div>

        <!-- Details -->
        <div class="ba-details animate-on-scroll" style="margin-top: var(--space-3xl); max-width: 700px; margin-left: auto; margin-right: auto;">
            <?php if ($areas && !is_wp_error($areas)) : ?>
                <div style="margin-bottom: var(--space-md);">
                    <?php foreach ($areas as $area) : ?>
                        <span class="badge badge--gold"><?php echo esc_html($area->name); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($description) : ?>
                <h3 style="margin-bottom: var(--space-md);">About This Transformation</h3>
                <p style="color: var(--color-gray-600); line-height: var(--leading-relaxed);"><?php echo wp_kses_post(nl2br($description)); ?></p>
            <?php endif; ?>

            <div class="entry-content" style="margin-top: var(--space-xl);">
                <?php the_content(); ?>
            </div>

            <?php if ($service_id) : ?>
            <div style="margin-top: var(--space-2xl); padding: var(--space-xl); background: var(--color-cream); border-radius: var(--radius-lg); text-align: center;">
                <h4>Interested in <?php echo esc_html($service_name); ?>?</h4>
                <p style="color: var(--color-gray-500); margin-bottom: var(--space-md);">Learn more about this treatment or book your consultation.</p>
                <div style="display: flex; gap: var(--space-md); justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo get_permalink($service_id); ?>" class="btn btn--secondary">Learn More</a>
                    <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary">Book Now</a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <div style="display: flex; justify-content: space-between; margin-top: var(--space-3xl); padding-top: var(--space-xl); border-top: 1px solid var(--color-gray-200);">
            <div><?php previous_post_link('%link', '← Previous Result'); ?></div>
            <a href="<?php echo esc_url(get_post_type_archive_link('before_after')); ?>" style="color: var(--color-gold);">View All Results</a>
            <div><?php next_post_link('%link', 'Next Result →'); ?></div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
