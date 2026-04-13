<?php
/**
 * Before & After Archive Template
 *
 * Filterable gallery of all before/after transformations.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

$areas = get_terms([
    'taxonomy'   => 'treatment_area',
    'hide_empty' => true,
]);
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Real Results</span>
        <h1 class="page-hero__title">Before & After<br>Gallery</h1>
        <p class="page-hero__desc">See the real transformations our clients have experienced. Every result speaks to our commitment to natural, beautiful outcomes.</p>
    </div>
</section>

<!-- Filters -->
<?php if (!empty($areas) && !is_wp_error($areas)) : ?>
<div class="filter-bar">
    <div class="container">
        <div class="filter-bar__inner">
            <button class="filter-bar__btn is-active" data-filter="all">All Results</button>
            <?php foreach ($areas as $area) : ?>
                <button class="filter-bar__btn" data-filter="<?php echo esc_attr($area->slug); ?>"><?php echo esc_html($area->name); ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Gallery Grid -->
<section class="section">
    <div class="container">
        <div class="ba-gallery-grid stagger-children" id="baGallery">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $before_img   = get_post_meta(get_the_ID(), '_livia_before_image', true);
                    $after_img    = get_post_meta(get_the_ID(), '_livia_after_image', true);
                    $description  = get_post_meta(get_the_ID(), '_livia_ba_description', true);
                    $service_id   = get_post_meta(get_the_ID(), '_livia_related_service', true);
                    $service_name = $service_id ? get_the_title($service_id) : '';
                    $areas_terms  = get_the_terms(get_the_ID(), 'treatment_area');
                    $area_slugs   = ($areas_terms && !is_wp_error($areas_terms)) ? implode(' ', wp_list_pluck($areas_terms, 'slug')) : '';
            ?>
            <div class="ba-gallery-item animate-on-scroll" data-category="<?php echo esc_attr($area_slugs); ?>">
                <div class="ba-slider" data-ba-slider>
                    <div class="ba-slider__after">
                        <?php if ($after_img) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($after_img, 'livia-ba')); ?>" alt="After - <?php the_title(); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="ba-slider__before">
                        <?php if ($before_img) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($before_img, 'livia-ba')); ?>" alt="Before - <?php the_title(); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="ba-slider__divider"></div>
                    <div class="ba-slider__handle">⇔</div>
                    <span class="ba-slider__label ba-slider__label--before">Before</span>
                    <span class="ba-slider__label ba-slider__label--after">After</span>
                </div>
                <div class="ba-gallery-item__info">
                    <?php if ($service_name) : ?>
                        <span class="ba-gallery-item__service"><?php echo esc_html($service_name); ?></span>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <p class="ba-gallery-item__desc"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
            else :
            ?>
            <div style="grid-column: 1/-1; text-align: center; padding: var(--space-4xl);">
                <h2>Results Gallery Coming Soon</h2>
                <p class="text-muted">Our before & after gallery is being populated with real client results.</p>
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

<!-- Filter JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btns = document.querySelectorAll('.filter-bar__btn');
    const items = document.querySelectorAll('#baGallery .ba-gallery-item');
    
    btns.forEach(btn => {
        btn.addEventListener('click', function() {
            btns.forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');
            const filter = this.dataset.filter;
            items.forEach(item => {
                if (filter === 'all' || item.dataset.category.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
