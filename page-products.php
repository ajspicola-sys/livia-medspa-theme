<?php
/**
 * Template Name: Products Page
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
?>

<!-- Page Hero -->
<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Our Products</span>
        <h1 class="page-hero__title">Medical-Grade<br>Skincare</h1>
        <p class="page-hero__desc">Clinically proven products hand-selected by our team to complement your in-office treatments.</p>
    </div>
</section>

<!-- Products Intro -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about__content animate-on-scroll">
                <span class="section-label">Curated for You</span>
                <h2 class="section-title" style="text-align: left;">Products That<br>Deliver Results</h2>
                <hr class="section-divider" style="margin-left: 0;">
                <p>Anti-aging serums with hyaluronic acid deeply hydrate, keeping skin plump and smooth. Antioxidants like vitamins C and E protect against free radical damage and reduce wrinkles.</p>
                <p>Ingredients like retinol and peptides boost collagen, improving skin elasticity and reducing age spots. Our selection includes the latest and most effective treatments — we use only the best products available.</p>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="about__image animate-on-scroll from-right">
                <div class="about__image-frame">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('livia-portrait', ['class' => 'about__photo', 'loading' => 'lazy']); ?>
                    <?php else : ?>
                        <div class="about__photo-placeholder" style="background: linear-gradient(135deg, var(--color-cream) 0%, var(--color-blush) 100%);">
                            <span style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-gold);">Products</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fullscript Supplements -->
<section class="section section--cream">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Supplements</span>
            <h2 class="section-title">Practitioner-Curated<br>Supplements</h2>
            <hr class="section-divider">
            <p class="section-subtitle">Supplements as intentional as your care. Every product is hand-selected by our clinical team.</p>
        </div>

        <div class="grid grid--3 stagger-children">
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">💊</div>
                <h3 class="value-card__title">Pharmaceutical Grade</h3>
                <p class="value-card__text">Top-tier, certified brands hand-picked by our clinical team for maximum efficacy.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">🔬</div>
                <h3 class="value-card__title">Third-Party Tested</h3>
                <p class="value-card__text">Every product verified for purity and potency, so you know exactly what you're getting.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">🚚</div>
                <h3 class="value-card__title">Delivered to Your Door</h3>
                <p class="value-card__text">Fast shipping with 20% off retail — exclusive pricing for Livia patients.</p>
            </div>
        </div>

        <div class="text-center" style="margin-top: var(--space-3xl);">
            <a href="#" class="btn btn--primary btn--lg animate-on-scroll">
                Shop Our Supplement Store <?php echo livia_icon('arrow-right', 18); ?>
            </a>
            <p style="margin-top: var(--space-md); font-size: var(--text-sm); color: var(--color-gray-500);">
                Powered by Fullscript · 20% off retail for Livia patients
            </p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="cta-section__bg"></div>
    <div class="container">
        <div class="cta-section__inner animate-on-scroll">
            <span class="section-label" style="color: var(--color-gold-light);">Need Guidance?</span>
            <h2 class="cta-section__title">Not Sure What's Right<br>for Your Skin?</h2>
            <p class="cta-section__text">Book a consultation and our team will recommend the perfect products for your skincare routine.</p>
            <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary btn--lg">
                Book a Consultation <?php echo livia_icon('arrow-right', 18); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
