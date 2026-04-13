<?php
/**
 * Template Name: About Page
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">About Us</span>
        <h1 class="page-hero__title">The Livia<br>Difference</h1>
        <p class="page-hero__desc">Where science meets artistry. Tampa's boutique med spa delivering expert medical care with a luxury experience.</p>
    </div>
</section>

<!-- Our Story -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about__image animate-on-scroll from-left">
                <div class="about__image-frame">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('livia-portrait', ['class' => 'about__photo', 'loading' => 'lazy']); ?>
                    <?php else : ?>
                        <div class="about__photo-placeholder">
                            <span style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-gold);">L</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="about__content animate-on-scroll from-right">
                <span class="section-label">Our Story</span>
                <h2 class="section-title" style="text-align: left;">Beauty, Backed<br>by Science</h2>
                <hr class="section-divider" style="margin-left: 0;">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="section section--cream">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Our Values</span>
            <h2 class="section-title">What Sets Us Apart</h2>
            <hr class="section-divider">
        </div>
        <div class="grid grid--3 stagger-children">
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">🎯</div>
                <h3 class="value-card__title">Personalized Care</h3>
                <p class="value-card__text">Every treatment plan is tailored to your unique skin, goals, and lifestyle. We Never take a one-size-fits-all approach.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">🏥</div>
                <h3 class="value-card__title">Medical Excellence</h3>
                <p class="value-card__text">Board-certified professionals using only FDA-approved, medical-grade treatments and products.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-card__icon">✨</div>
                <h3 class="value-card__title">Natural Results</h3>
                <p class="value-card__text">We enhance your natural beauty — not change it. Our goal is refreshed, balanced, and natural-looking results.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<?php
$team = new WP_Query([
    'post_type'      => 'team_member',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ($team->have_posts()) :
?>
<section class="section" id="team">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Our Team</span>
            <h2 class="section-title">Meet the Experts</h2>
            <hr class="section-divider">
        </div>
        <div class="team-grid stagger-children">
            <?php while ($team->have_posts()) : $team->the_post();
                $role  = get_post_meta(get_the_ID(), '_livia_role', true);
                $certs = get_post_meta(get_the_ID(), '_livia_certifications', true);
            ?>
            <div class="team-card animate-on-scroll">
                <div class="team-card__image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('livia-square', ['loading' => 'lazy']); ?>
                    <?php else : ?>
                        <div style="width:100%;height:100%;background:var(--color-cream);display:flex;align-items:center;justify-content:center;">
                            <span style="font-family:var(--font-heading);font-size:var(--text-3xl);color:var(--color-gold);"><?php echo mb_substr(get_the_title(), 0, 1); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="team-card__body">
                    <h3 class="team-card__name"><?php the_title(); ?></h3>
                    <?php if ($role) : ?>
                        <p class="team-card__role"><?php echo esc_html($role); ?></p>
                    <?php endif; ?>
                    <?php if ($certs && is_array($certs)) : ?>
                        <div class="team-card__certs">
                            <?php foreach (array_slice($certs, 0, 3) as $cert) : ?>
                                <span class="badge badge--gold"><?php echo esc_html($cert); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="section cta-section">
    <div class="cta-section__bg"></div>
    <div class="container">
        <div class="cta-section__inner animate-on-scroll">
            <span class="section-label" style="color: var(--color-gold-light);">Join Our Family</span>
            <h2 class="cta-section__title">Start Your<br>Journey Today</h2>
            <p class="cta-section__text">Experience the Livia difference. Book a consultation and discover what's possible.</p>
            <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary btn--lg">
                Book a Consultation <?php echo livia_icon('arrow-right', 18); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
