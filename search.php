<?php
/**
 * Search Results Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
?>

<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Search Results</span>
        <h1 class="page-hero__title"><?php printf(__('Results for "%s"', 'livia-medspa'), get_search_query()); ?></h1>
    </div>
</section>

<section class="section section--cream">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="blog-grid stagger-children">
            <?php while (have_posts()) : the_post(); ?>
            <article class="blog-card animate-on-scroll">
                <a href="<?php the_permalink(); ?>" class="blog-card__image-wrap">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('livia-card', ['loading' => 'lazy']); ?>
                    <?php endif; ?>
                </a>
                <div class="blog-card__body">
                    <div class="blog-card__meta">
                        <span class="blog-card__cat"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                    </div>
                    <h2 class="blog-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => '←',
            'next_text' => '→',
        ]); ?>

        <?php else : ?>
        <div style="text-align: center; padding: var(--space-4xl);">
            <h2>No Results Found</h2>
            <p class="text-muted" style="margin-bottom: var(--space-xl);">Try searching with different keywords.</p>
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" style="max-width: 400px; margin: 0 auto; display: flex; gap: var(--space-sm);">
                <input type="search" class="form-input" placeholder="Search..." name="s">
                <button type="submit" class="btn btn--primary">Search</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
