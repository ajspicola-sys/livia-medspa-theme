<?php
/**
 * Livia Med Spa — Services Archive
 * Premium redesign: category filter tabs, rich grid, CTA section.
 */
get_header();

// Gather all service_category terms for the filter tabs
$all_cats = get_terms([
    'taxonomy'   => 'service_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);
?>

<!-- Services Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Livia Med Spa Services in Tampa, FL",
    "url": "<?php echo esc_url( home_url('/services/') ); ?>",
    "description": "Advanced medical spa treatments including Botox, fillers, RF microneedling, laser hair removal, and medical-grade skincare.",
    "itemListOrder": "https://schema.org/ItemListOrderAscending"
}
</script>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         PAGE HERO
         ═══════════════════════════════════════════════════════ -->
    <section class="page-hero" aria-label="Services overview">
        <div class="page-hero__inner">
            <span class="section__label">Our Expertise</span>
            <h1 class="page-hero__title">Our Services</h1>
            <p class="page-hero__desc">Advanced aesthetic treatments tailored to enhance your natural beauty — performed by Tampa's most trusted medical professionals.</p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CATEGORY FILTER TABS (only shown when terms exist)
         ═══════════════════════════════════════════════════════ -->
    <?php if ( $all_cats && !is_wp_error($all_cats) ) : ?>
    <section class="services-filter" aria-label="Filter treatments by category">
        <div class="section__inner">
            <div class="services-filter__bar" role="tablist" aria-label="Service categories">
                <button class="services-filter__btn is-active"
                        role="tab"
                        aria-selected="true"
                        data-filter="all"
                        id="filter-all">
                    All Treatments
                </button>
                <?php foreach ( $all_cats as $cat ) : ?>
                <button class="services-filter__btn"
                        role="tab"
                        aria-selected="false"
                        data-filter="<?php echo esc_attr( $cat->slug ); ?>"
                        id="filter-<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SERVICES GRID
         ═══════════════════════════════════════════════════════ -->
    <section class="services-archive" aria-label="All services">
        <div class="section__inner">
            <?php if ( have_posts() ) : ?>
                <div class="services__grid" id="services-grid">
                    <?php while ( have_posts() ) : the_post();
                        $icon     = get_post_meta( get_the_ID(), '_service_icon', true ) ?: '✨';
                        $price    = get_post_meta( get_the_ID(), '_service_price', true );
                        $duration = get_post_meta( get_the_ID(), '_service_duration', true );

                        // Collect category slugs for filtering
                        $terms      = get_the_terms( get_the_ID(), 'service_category' );
                        $cat_slugs  = '';
                        $cat_name   = 'Treatment';
                        if ( $terms && !is_wp_error($terms) ) {
                            $slugs     = wp_list_pluck( $terms, 'slug' );
                            $cat_slugs = implode( ' ', $slugs );
                            $cat_name  = $terms[0]->name;
                        }
                    ?>
                        <a href="<?php the_permalink(); ?>"
                           class="service-card reveal"
                           aria-label="<?php the_title_attribute(); ?>"
                           data-cats="<?php echo esc_attr( $cat_slugs ); ?>"
                           itemscope
                           itemtype="https://schema.org/MedicalProcedure">
                            <meta itemprop="name" content="<?php the_title_attribute(); ?>">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="service-card__thumb">
                                    <?php the_post_thumbnail( 'medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'itemprop' => 'image',
                                    ] ); ?>
                                </div>
                            <?php else : ?>
                                <div class="service-card__icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
                            <?php endif; ?>

                            <div class="service-card__body">
                                <span class="service-card__cat"><?php echo esc_html( $cat_name ); ?></span>
                                <h3 class="service-card__title"><?php the_title(); ?></h3>
                                <p class="service-card__text"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>

                                <?php if ( $price || $duration ) : ?>
                                    <div class="service-card__meta">
                                        <?php if ( $price ) : ?>
                                            <span class="service-card__price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                                <meta itemprop="priceCurrency" content="USD">
                                                <span itemprop="price"><?php echo esc_html( $price ); ?></span>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ( $duration ) : ?>
                                            <span class="service-card__duration">
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                <?php echo esc_html( $duration ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <span class="service-card__link">Learn More →</span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div><!-- /.services__grid -->

                <!-- No results message (shown by JS filter) -->
                <div class="services-no-results" id="services-no-results" hidden aria-live="polite">
                    <span>No treatments found in this category.</span>
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

    <!-- ═══════════════════════════════════════════════════════
         WHY LIVIA (Static Trust Section)
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
                    <p class="service-why-us__card-text">Every client is unique. At Livia Med Spa, we tailor treatments to your individual goals so you receive care that fits your needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Book a treatment">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Glow?</span>
            <h2 class="cta-section__title">Find Your<br>Perfect Treatment</h2>
            <p class="cta-section__text">Not sure which service is right for you? Book a complimentary consultation and let our experts guide you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<script>
/* Services Category Filter — lightweight, no jQuery */
(function () {
    'use strict';
    var bar = document.querySelector('.services-filter__bar');
    if (!bar) return;

    var cards     = document.querySelectorAll('.service-card[data-cats]');
    var noResults = document.getElementById('services-no-results');
    var current   = 'all';

    bar.addEventListener('click', function (e) {
        var btn = e.target.closest('.services-filter__btn');
        if (!btn) return;

        var filter = btn.dataset.filter;
        if (filter === current) return;
        current = filter;

        // Update tab state
        bar.querySelectorAll('.services-filter__btn').forEach(function (b) {
            b.classList.toggle('is-active', b === btn);
            b.setAttribute('aria-selected', b === btn ? 'true' : 'false');
        });

        // Show/hide cards
        var visible = 0;
        cards.forEach(function (card) {
            var show = filter === 'all' || card.dataset.cats.split(' ').indexOf(filter) !== -1;
            card.hidden = !show;
            if (show) visible++;
        });

        if (noResults) noResults.hidden = visible > 0;
    });
}());
</script>

<?php get_footer(); ?>
