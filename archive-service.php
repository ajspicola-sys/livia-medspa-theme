<?php
/**
 * Services Archive Template
 *
 * Filterable grid of all services.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

$categories = get_terms([
    'taxonomy'   => 'service_category',
    'hide_empty' => true,
]);
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Our Services</span>
        <h1 class="page-hero__title">Expert Aesthetic<br>Treatments</h1>
        <p class="page-hero__desc">Discover our full range of medical-grade treatments designed to enhance your natural beauty with precision and care.</p>
    </div>
</section>

<!-- Category Filters -->
<?php if (!empty($categories) && !is_wp_error($categories)) : ?>
<div class="filter-bar">
    <div class="container">
        <div class="filter-bar__inner">
            <button class="filter-bar__btn is-active" data-filter="all">All Services</button>
            <?php foreach ($categories as $cat) : ?>
                <button class="filter-bar__btn" data-filter="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Services Grid -->
<section class="section section--cream">
    <div class="container">
        <div class="services-grid stagger-children" id="servicesGrid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $short_desc  = get_post_meta(get_the_ID(), '_livia_short_description', true);
                    $price_range = get_post_meta(get_the_ID(), '_livia_price_range', true);
                    $duration    = get_post_meta(get_the_ID(), '_livia_duration', true);
                    $cats        = get_the_terms(get_the_ID(), 'service_category');
                    $cat_slugs   = ($cats && !is_wp_error($cats)) ? implode(' ', wp_list_pluck($cats, 'slug')) : '';
                    $cat_name    = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
            ?>
                <a href="<?php the_permalink(); ?>" class="service-card animate-on-scroll" data-category="<?php echo esc_attr($cat_slugs); ?>">
                    <div class="service-card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('livia-card', ['loading' => 'lazy']); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, var(--color-cream) 0%, var(--color-blush-light) 100%);display:flex;align-items:center;justify-content:center;">
                                <span style="font-family:var(--font-heading);font-size:var(--text-lg);color:var(--color-gold);"><?php the_title(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($cat_name) : ?>
                            <span class="service-card__category"><?php echo esc_html($cat_name); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="service-card__content">
                        <h2 class="service-card__title"><?php the_title(); ?></h2>
                        <?php if ($short_desc) : ?>
                            <p class="service-card__desc"><?php echo esc_html($short_desc); ?></p>
                        <?php endif; ?>
                        <div class="service-card__meta">
                            <?php if ($price_range) : ?>
                                <span><?php echo livia_icon('dollar', 14); ?> <?php echo esc_html($price_range); ?></span>
                            <?php endif; ?>
                            <?php if ($duration) : ?>
                                <span><?php echo livia_icon('clock', 14); ?> <?php echo esc_html($duration); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="service-card__arrow"><?php echo livia_icon('arrow-right', 16); ?></span>
                </a>
            <?php
                endwhile;
            else :
            ?>
                <div style="grid-column: 1/-1; text-align: center; padding: var(--space-4xl);">
                    <h2>Services Coming Soon</h2>
                    <p class="text-muted">Our services are being added. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>

        <?php the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => '←',
            'next_text' => '→',
        ]); ?>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section" id="book">
    <div class="cta-section__bg"></div>
    <div class="container">
        <div class="cta-section__inner animate-on-scroll">
            <span class="section-label" style="color: var(--color-gold-light);">Not Sure Which Treatment?</span>
            <h2 class="cta-section__title">Book a Free<br>Consultation</h2>
            <p class="cta-section__text">Our expert team will help you find the perfect treatment plan for your unique goals.</p>
            <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary btn--lg">
                Book a Consultation <?php echo livia_icon('arrow-right', 18); ?>
            </a>
        </div>
    </div>
</section>

<!-- Filter JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btns = document.querySelectorAll('.filter-bar__btn');
    const cards = document.querySelectorAll('#servicesGrid .service-card');
    
    btns.forEach(btn => {
        btn.addEventListener('click', function() {
            btns.forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');
            
            const filter = this.dataset.filter;
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.category.includes(filter)) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => { card.style.display = 'none'; }, 300);
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
