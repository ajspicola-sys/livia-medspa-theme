<?php
/**
 * Livia Med Spa — Single Service Template
 * Full-page layout with sidebar + static Why Choose Us & CTA
 */
get_header();

$icon     = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
$price    = get_post_meta(get_the_ID(), '_service_price', true);
$duration = get_post_meta(get_the_ID(), '_service_duration', true);

// Get the service category
$categories = get_the_terms(get_the_ID(), 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
?>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         HERO
         ═══════════════════════════════════════════════════════ -->
    <section class="page-hero" aria-label="Service details" itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <div class="page-hero__inner">
            <span class="section__label"><span aria-hidden="true"><?php echo esc_html($icon); ?></span> <?php echo esc_html($category_name); ?></span>
            <h1 class="page-hero__title"><?php the_title(); ?> in Tampa</h1>
            <?php if (has_excerpt()) : ?>
                <p class="page-hero__desc"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT + SIDEBAR
         ═══════════════════════════════════════════════════════ -->
    <section class="single-service">
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

                    <div class="service-content__body" itemprop="description">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="single-service__sidebar reveal" aria-label="Treatment information">
                    <!-- Quick Info Card -->
                    <div class="service-info-card">
                        <h3 class="service-info-card__title">Treatment Details</h3>
                        <?php if ($price) : ?>
                            <div class="service-info-card__row">
                                <span class="service-info-card__label">Starting at</span>
                                <span class="service-info-card__value" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="USD">
                                    <span itemprop="price"><?php echo esc_html($price); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($duration) : ?>
                            <div class="service-info-card__row">
                                <span class="service-info-card__label">Duration</span>
                                <span class="service-info-card__value"><?php echo esc_html($duration); ?></span>
                            </div>
                        <?php endif; ?>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary" style="width:100%;margin-top:1.25rem;justify-content:center;">Book This Treatment</a>
                    </div>

                    <!-- Phone CTA -->
                    <div class="service-info-card" style="text-align:center;">
                        <p style="font-size:0.82rem;color:#7a7a90;margin-bottom:0.5rem;">Have questions? Call us</p>
                        <a href="tel:8132302219" style="font-size:1.1rem;font-weight:600;color:#c9a96e;text-decoration:none;">(813) 230-2219</a>
                    </div>

                    <!-- Back to Services -->
                    <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline" style="width:100%;text-align:center;justify-content:center;">← All Services</a>
                </aside>
            </div>
        </div>
    </section>

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
                    <h3 class="service-why-us__card-title">Safety & Professional Care</h3>
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
         CTA (Static)
         ═══════════════════════════════════════════════════════ -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book<br>Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline btn--lg">← All Services</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
