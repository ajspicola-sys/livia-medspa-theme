<?php
/**
 * Single Service Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

while (have_posts()) : the_post();
    $short_desc  = get_post_meta(get_the_ID(), '_livia_short_description', true);
    $price_range = get_post_meta(get_the_ID(), '_livia_price_range', true);
    $duration    = get_post_meta(get_the_ID(), '_livia_duration', true);
    $benefits    = get_post_meta(get_the_ID(), '_livia_benefits', true);
    $faq         = get_post_meta(get_the_ID(), '_livia_faq', true);
    $cta_link    = get_post_meta(get_the_ID(), '_livia_cta_link', true);
    $cta_text    = get_post_meta(get_the_ID(), '_livia_cta_text', true);
    $categories  = get_the_terms(get_the_ID(), 'service_category');
    $booking_url = get_theme_mod('livia_booking_url', '#book');

    if (!$benefits) $benefits = [];
    if (!$faq)      $faq = [];
    if (!$cta_text) $cta_text = 'Book This Treatment';
    if (!$cta_link) $cta_link = $booking_url;
?>

<!-- Service Hero -->
<section class="service-hero">
    <div class="service-hero__bg">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('livia-hero', ['class' => 'service-hero__image']); ?>
        <?php endif; ?>
        <div class="service-hero__overlay"></div>
    </div>
    <div class="service-hero__content container">
        <?php if ($categories && !is_wp_error($categories)) : ?>
            <span class="section-label"><?php echo esc_html($categories[0]->name); ?></span>
        <?php endif; ?>
        <h1 class="service-hero__title"><?php the_title(); ?></h1>
        <?php if ($short_desc) : ?>
            <p class="service-hero__desc"><?php echo esc_html($short_desc); ?></p>
        <?php endif; ?>
        <div class="service-hero__meta">
            <?php if ($price_range) : ?>
                <span class="service-hero__meta-item"><?php echo livia_icon('dollar', 18); ?> <?php echo esc_html($price_range); ?></span>
            <?php endif; ?>
            <?php if ($duration) : ?>
                <span class="service-hero__meta-item"><?php echo livia_icon('clock', 18); ?> <?php echo esc_html($duration); ?></span>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Service Content -->
<section class="section">
    <div class="container">
        <div class="service-layout">
            <div class="service-layout__main">
                <!-- Description -->
                <div class="entry-content animate-on-scroll">
                    <?php the_content(); ?>
                </div>

                <!-- Benefits -->
                <?php if (!empty($benefits)) : ?>
                <div class="service-benefits animate-on-scroll" style="margin-top: var(--space-3xl);">
                    <h2>Key Benefits</h2>
                    <hr class="section-divider" style="margin-left: 0; margin-bottom: var(--space-xl);">
                    <div class="service-benefits__grid">
                        <?php foreach ($benefits as $i => $benefit) : ?>
                        <div class="service-benefits__item">
                            <span class="service-benefits__number"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            <p><?php echo esc_html($benefit); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Related Before & Afters -->
                <?php
                $related_ba = new WP_Query([
                    'post_type'      => 'before_after',
                    'posts_per_page' => 3,
                    'meta_query'     => [
                        [
                            'key'   => '_livia_related_service',
                            'value' => get_the_ID(),
                        ],
                    ],
                ]);

                if ($related_ba->have_posts()) :
                ?>
                <div class="service-ba animate-on-scroll" style="margin-top: var(--space-3xl);">
                    <h2>Before & After Results</h2>
                    <hr class="section-divider" style="margin-left: 0; margin-bottom: var(--space-xl);">
                    <div class="ba-showcase" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                        <?php while ($related_ba->have_posts()) : $related_ba->the_post();
                            $before_img = get_post_meta(get_the_ID(), '_livia_before_image', true);
                            $after_img  = get_post_meta(get_the_ID(), '_livia_after_image', true);
                        ?>
                        <div class="ba-item">
                            <div class="ba-slider" data-ba-slider>
                                <div class="ba-slider__after">
                                    <?php if ($after_img) : ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url($after_img, 'livia-ba')); ?>" alt="After" loading="lazy">
                                    <?php endif; ?>
                                </div>
                                <div class="ba-slider__before">
                                    <?php if ($before_img) : ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_image_url($before_img, 'livia-ba')); ?>" alt="Before" loading="lazy">
                                    <?php endif; ?>
                                </div>
                                <div class="ba-slider__divider"></div>
                                <div class="ba-slider__handle">⇔</div>
                                <span class="ba-slider__label ba-slider__label--before">Before</span>
                                <span class="ba-slider__label ba-slider__label--after">After</span>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- FAQ -->
                <?php if (!empty($faq)) : ?>
                <div class="service-faq animate-on-scroll" style="margin-top: var(--space-3xl);">
                    <h2>Frequently Asked Questions</h2>
                    <hr class="section-divider" style="margin-left: 0; margin-bottom: var(--space-xl);">
                    <div class="accordion">
                        <?php foreach ($faq as $item) : ?>
                        <div class="accordion__item">
                            <button class="accordion__trigger" type="button">
                                <span><?php echo esc_html($item['q']); ?></span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__panel">
                                <div class="accordion__content">
                                    <?php echo wp_kses_post(nl2br($item['a'])); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="service-layout__sidebar">
                <div class="service-sidebar-card animate-on-scroll">
                    <h3 class="service-sidebar-card__title">Book This Treatment</h3>
                    <?php if ($price_range) : ?>
                        <div class="service-sidebar-card__price"><?php echo esc_html($price_range); ?></div>
                    <?php endif; ?>
                    <?php if ($duration) : ?>
                        <div class="service-sidebar-card__duration"><?php echo livia_icon('clock', 16); ?> <?php echo esc_html($duration); ?></div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($cta_link); ?>" class="btn btn--primary" style="width: 100%; margin-top: var(--space-lg);">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('livia_phone', '8132302219'))); ?>" class="btn btn--secondary" style="width: 100%; margin-top: var(--space-sm);">
                        <?php echo livia_icon('phone', 16); ?> Call to Book
                    </a>
                </div>
                
                <!-- Trust Badges -->
                <div class="service-trust animate-on-scroll">
                    <div class="service-trust__item">
                        <span>✓</span> Board Certified Professionals
                    </div>
                    <div class="service-trust__item">
                        <span>✓</span> FDA-Approved Treatments
                    </div>
                    <div class="service-trust__item">
                        <span>✓</span> Personalized Treatment Plans
                    </div>
                    <div class="service-trust__item">
                        <span>✓</span> Complimentary Consultations
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
