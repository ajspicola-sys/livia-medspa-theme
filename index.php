<?php
/**
 * Livia Med Spa — Blog/Fallback Template
 */
get_header(); ?>

<main class="site-main">

    <!-- Blog Hero -->
    <section class="page-hero page-hero--blog">
        <div class="page-hero__inner">
            <span class="section__label">Our Journal</span>
            <h1 class="page-hero__title">Beauty Tips &<br><em>Treatment Insights</em></h1>
            <p class="page-hero__desc">Stay informed with expert advice, skincare tips, and the latest treatments from our clinical team.</p>
        </div>
    </section>

    <section class="blog-archive">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="blog-card reveal">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-card__img">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="blog-card__img blog-card__img--placeholder">
                                    <span>📝</span>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <span class="blog-card__date"><?php echo get_the_date('M j, Y'); ?></span>
                                    <?php if (has_category()) : ?>
                                        <span class="blog-card__cat"><?php $cat = get_the_category(); echo $cat[0]->name; ?></span>
                                    <?php endif; ?>
                                </div>
                                <h2 class="blog-card__title"><?php the_title(); ?></h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                <span class="blog-card__read">Read More →</span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="blog-pagination">
                    <?php
                    echo paginate_links([
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                        'type'      => 'list',
                    ]);
                    ?>
                </div>
            <?php else : ?>
                <div class="blog-empty">
                    <span class="blog-empty__icon">📝</span>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Our blog is launching soon. Check back for beauty tips, treatment guides, and the latest from Livia Med Spa.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
