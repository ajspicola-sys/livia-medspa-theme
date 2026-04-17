<?php
/**
 * Livia Med Spa — Single Service Template
 * Premium redesign: 2-col hero with image, content + sidebar,
 * conditional benefits grid, conditional video section.
 */
get_header();

$post_id      = get_the_ID();
$icon         = get_post_meta($post_id, '_service_icon', true)     ?: '✨';
$price        = get_post_meta($post_id, '_service_price', true);
$duration     = get_post_meta($post_id, '_service_duration', true);
$video        = get_post_meta($post_id, '_service_video', true);
$benefits_raw = get_post_meta($post_id, '_service_benefits', true);
$benefits     = $benefits_raw ? array_filter(array_map('trim', explode("\n", $benefits_raw))) : [];

// Convert YouTube / Vimeo URL → embed URL
$video_embed = '';
if ($video) {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video, $m)) {
        $video_embed = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1';
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video, $m)) {
        $video_embed = 'https://player.vimeo.com/video/' . $m[1] . '?title=0&byline=0';
    }
}

$categories    = get_the_terms($post_id, 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
$has_image     = has_post_thumbnail();
?>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         HERO — 2-column when featured image exists, centered when not
         ═══════════════════════════════════════════════════════ -->
    <section class="service-hero<?php echo !$has_image ? ' service-hero--no-image' : ''; ?>"
             aria-label="Service details"
             itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <span class="service-hero__glow" aria-hidden="true"></span>

        <div class="service-hero__inner">

            <!-- Left: text content -->
            <div class="service-hero__content reveal">

                <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb"
                     itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="breadcrumbs__list">
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                            <span itemprop="name"><?php the_title(); ?></span>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </nav>

                <span class="section__label service-hero__cat">
                    <span aria-hidden="true"><?php echo esc_html($icon); ?></span>
                    <?php echo esc_html($category_name); ?>
                </span>

                <h1 class="service-hero__title">
                    <?php the_title(); ?><br>
                    <em class="service-hero__location">in Tampa, FL</em>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="service-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <?php if ($price || $duration): ?>
                <div class="service-hero__meta">
                    <?php if ($price): ?>
                    <div class="service-hero__meta-item" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="USD">
                        <span class="service-hero__meta-label">Starting at</span>
                        <span class="service-hero__meta-value" itemprop="price"><?php echo esc_html($price); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($duration): ?>
                    <div class="service-hero__meta-item">
                        <span class="service-hero__meta-label">Duration</span>
                        <span class="service-hero__meta-value"><?php echo esc_html($duration); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="service-hero__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">Book This Treatment</a>
                    <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                </div>
            </div>

            <!-- Right: featured image (only renders when thumbnail exists) -->
            <?php if ($has_image): ?>
            <div class="service-hero__image reveal" aria-hidden="true">
                <?php the_post_thumbnail('large', [
                    'loading'       => 'eager',
                    'decoding'      => 'async',
                    'fetchpriority' => 'high',
                    'itemprop'      => 'image',
                    'class'         => 'service-hero__img',
                ]); ?>
                <span class="service-hero__img-glow"></span>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT + STICKY SIDEBAR
         ═══════════════════════════════════════════════════════ -->
    <section class="service-body" aria-label="Treatment information">
        <div class="section__inner">
            <div class="service-body__layout">

                <!-- Main WP editor content -->
                <div class="service-body__main service-content__body reveal" itemprop="description">
                    <?php the_content(); ?>
                </div>

                <!-- Sticky quick-info & booking sidebar -->
                <aside class="service-body__sidebar reveal" aria-label="Quick booking">
                    <div class="service-sidebar">
                        <div class="service-sidebar__icon" aria-hidden="true"><?php echo esc_html($icon); ?></div>
                        <h2 class="service-sidebar__title"><?php the_title(); ?></h2>

                        <?php if ($price): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Starting At</span>
                            <span class="service-sidebar__value"><?php echo esc_html($price); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Duration</span>
                            <span class="service-sidebar__value"><?php echo esc_html($duration); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Category</span>
                            <span class="service-sidebar__value"><?php echo esc_html($category_name); ?></span>
                        </div>

                        <div class="service-sidebar__divider"></div>

                        <a href="#book-now" class="btn btn--primary service-sidebar__book">Book Now</a>
                        <a href="tel:8132302219" class="service-sidebar__call">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            (813) 230-2219
                        </a>
                        <p class="service-sidebar__fine">Free consultation · No commitment required</p>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         BENEFITS GRID — only renders when meta field has content
         ═══════════════════════════════════════════════════════ -->
    <?php if (!empty($benefits)): ?>
    <section class="service-benefits" aria-label="Treatment benefits">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">What You'll Gain</span>
                <h2 class="section__title">Key Benefits of <?php the_title(); ?></h2>
            </div>
            <ul class="service-benefits__grid reveal" role="list">
                <?php foreach ($benefits as $benefit): ?>
                <li class="service-benefits__item">
                    <span class="service-benefits__check" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <?php echo esc_html($benefit); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         VIDEO SECTION — only renders when _service_video meta set
         ═══════════════════════════════════════════════════════ -->
    <?php if ($video_embed): ?>
    <section class="service-video" aria-label="Treatment video">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">See It In Action</span>
                <h2 class="section__title"><?php the_title(); ?> at Livia Med Spa</h2>
            </div>
            <div class="service-video__wrap reveal">
                <iframe
                    src="<?php echo esc_url($video_embed); ?>"
                    title="<?php the_title_attribute(); ?> treatment video at Livia Med Spa Tampa"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         WHY PEOPLE CHOOSE LIVIA (Static)
         ═══════════════════════════════════════════════════════ -->
    <section class="service-why-us" aria-label="Why choose Livia Med Spa">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Livia</span>
                <h2 class="section__title">Why People Choose Livia</h2>
            </div>
            <div class="service-why-us__grid reveal">
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">⚡</div>
                    <h3 class="service-why-us__card-title">Advanced, High-Quality Treatments</h3>
                    <p class="service-why-us__card-text">Livia Med Spa specializes in modern, results-driven treatments designed to enhance natural beauty while maintaining a refreshed, natural look.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">🛡️</div>
                    <h3 class="service-why-us__card-title">Safety &amp; Professional Care</h3>
                    <p class="service-why-us__card-text">Our services are performed with a focus on safety, precision, and professionalism, using trusted products and techniques to deliver reliable results.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">✨</div>
                    <h3 class="service-why-us__card-title">Personalized Experience</h3>
                    <p class="service-why-us__card-text">Every client is unique. At Livia Med Spa, we tailor treatments to your individual goals so you receive care that fits your needs and helps you feel your absolute best.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         RELATED SERVICES (Dynamic)
         ═══════════════════════════════════════════════════════ -->
    <?php
    $related = new WP_Query([
        'post_type'      => 'service',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id],
        'orderby'        => 'rand',
        'no_found_rows'  => true,
    ]);
    if ($related->have_posts()): ?>
    <section class="related-services" aria-label="Related treatments">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Explore More</span>
                <h2 class="section__title">Related Treatments</h2>
            </div>
            <div class="related-services__grid reveal">
                <?php while ($related->have_posts()): $related->the_post();
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                ?>
                <a href="<?php the_permalink(); ?>" class="service-card">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="service-card__thumb">
                        <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                    </div>
                    <?php else: ?>
                    <div class="service-card__icon" aria-hidden="true"><?php echo esc_html($r_icon); ?></div>
                    <?php endif; ?>
                    <h3 class="service-card__title"><?php the_title(); ?></h3>
                    <p class="service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         CTA (Static)
         ═══════════════════════════════════════════════════════ -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book<br>Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline btn--lg">← All Services</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>