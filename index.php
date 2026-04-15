<?php
/**
 * Livia Med Spa — Blog/Fallback Template
 * Performance-optimized: lazy loading, semantic HTML
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="page-hero page-hero--blog" aria-label="Blog">
        <div class="page-hero__inner">
            <span class="section__label">Our Journal</span>
            <h1 class="page-hero__title">Beauty Tips &amp;<br><em>Treatment Insights</em></h1>
            <p class="page-hero__desc">Stay informed with expert advice, skincare tips, and the latest treatments from our clinical team.</p>
        </div>
    </section>

    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="blog-card reveal" aria-label="Read: <?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-card__img">
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'sizes'    => '(max-width: 575px) 100vw, (max-width: 1023px) 50vw, 33vw',
                                    ]); ?>
                                </div>
                            <?php else : ?>
                                <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                                    <span>📝</span>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <time class="blog-card__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                                    <?php if (has_category()) : ?>
                                        <span class="blog-card__cat"><?php $cat = get_the_category(); echo esc_html($cat[0]->name); ?></span>
                                    <?php endif; ?>
                                    <span class="blog-card__read-time"><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 250); ?> min read</span>
                                </div>
                                <h2 class="blog-card__title"><?php the_title(); ?></h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                <span class="blog-card__read">Read Article →</span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="blog-pagination" aria-label="Blog pagination">
                    <?php
                    echo paginate_links([
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                        'type'      => 'list',
                    ]);
                    ?>
                </nav>
            <?php else : ?>
                <div class="blog-empty">
                    <span class="blog-empty__icon" aria-hidden="true">📝</span>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Our blog is launching soon. Check back for beauty tips, treatment guides, and the latest from Livia Med Spa.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
