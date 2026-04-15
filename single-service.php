<?php
/**
 * Livia Med Spa — Single Service Template
 * Full-page layout matching old service page structure
 * Dynamic: Hero, Featured Image, Content, Aftercare, Pricing
 * Static: Why Choose Livia, CTA
 */
get_header();

$icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
$price = get_post_meta(get_the_ID(), '_service_price', true);
$duration = get_post_meta(get_the_ID(), '_service_duration', true);

// Get the service category
$categories = get_the_terms(get_the_ID(), 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
?>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         SECTION 1: HERO (Dynamic)
         ═══════════════════════════════════════════════════════ -->
    <section class="service-hero" aria-label="Service details" itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <div class="service-hero__inner">
            <div class="service-hero__content reveal">
                <span class="section__label"><span aria-hidden="true"><?php echo esc_html($icon); ?></span>
                    <?php echo esc_html($category_name); ?></span>
                <h1 class="service-hero__title"><?php the_title(); ?> in Tampa</h1>
                <?php if (has_excerpt()): ?>
                    <p class="service-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <?php if ($price || $duration): ?>
                    <div class="service-hero__meta">
                        <?php if ($price): ?>
                            <div class="service-hero__meta-item">
                                <span class="service-hero__meta-label">Starting at</span>
                                <span class="service-hero__meta-value" itemprop="offers" itemscope
                                    itemtype="https://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="USD">
                                    <span itemprop="price"><?php echo esc_html($price); ?></span>
                                </span>
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
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book This
                        Treatment</a>
                    <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 2: FEATURED IMAGE (Dynamic)
         ═══════════════════════════════════════════════════════ -->
    <?php if (has_post_thumbnail()): ?>
        <section class="service-featured-img" aria-label="Treatment photo">
            <div class="section__inner">
                <div class="service-featured-img__wrap reveal">
                    <?php the_post_thumbnail('large', [
                        'loading' => 'eager',
                        'decoding' => 'async',
                        'fetchpriority' => 'high',
                        'itemprop' => 'image',
                        'class' => 'service-featured-img__image',
                    ]); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTIONS 3-6: MAIN CONTENT (Dynamic — from WP editor)
         Includes: What Is It, What Does It Treat,
         Featured Product, Aftercare, Pricing
         ═══════════════════════════════════════════════════════ -->
    <section class="service-content" aria-label="Treatment information">
        <div class="section__inner">
            <div class="service-content__body reveal" itemprop="description">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 7: WHY PEOPLE CHOOSE LIVIA (Static)
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
                    <p class="service-why-us__card-text">Livia Med Spa specializes in modern, results-driven treatments
                        designed to enhance natural beauty while maintaining a refreshed, natural look.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">🛡️</div>
                    <h3 class="service-why-us__card-title">Safety & Professional Care</h3>
                    <p class="service-why-us__card-text">Our services are performed with a focus on safety, precision,
                        and professionalism, using trusted products and techniques to deliver reliable results.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">✨</div>
                    <h3 class="service-why-us__card-title">Personalized Experience</h3>
                    <p class="service-why-us__card-text">Every client is unique. At Livia Med Spa, we tailor treatments
                        to your individual goals so you receive care that fits your needs and helps you feel your
                        absolute best.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 8: CTA (Static)
         ═══════════════════════════════════════════════════════ -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book<br>Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized
                treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Free
                    Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline btn--lg">← All
                    Services</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>