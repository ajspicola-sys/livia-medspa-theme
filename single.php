<?php
/**
 * Livia Med Spa — Single Post Template
 */
get_header(); ?>

<main class="site-main">

    <article class="single-post">
        <!-- Post Hero -->
        <div class="page-hero page-hero--blog">
            <div class="page-hero__inner">
                <div class="post-meta-line">
                    <span class="post-meta-line__date"><?php echo get_the_date('F j, Y'); ?></span>
                    <?php if (has_category()) : ?>
                        <span class="post-meta-line__sep">·</span>
                        <span class="post-meta-line__cat"><?php the_category(', '); ?></span>
                    <?php endif; ?>
                    <span class="post-meta-line__sep">·</span>
                    <span class="post-meta-line__read"><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 250); ?> min read</span>
                </div>
                <h1 class="page-hero__title"><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Post Content -->
        <div class="post-content">
            <div class="post-content__inner">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-content__thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="post-content__body">
                    <?php the_content(); ?>
                </div>

                <!-- Author Bar -->
                <div class="post-author-bar">
                    <div class="post-author-bar__avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 56); ?>
                    </div>
                    <div class="post-author-bar__info">
                        <span class="post-author-bar__label">Written by</span>
                        <span class="post-author-bar__name"><?php the_author(); ?></span>
                    </div>
                    <div class="post-author-bar__share">
                        <span class="post-author-bar__share-label">Share</span>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="post-share-link" aria-label="Share on Twitter">𝕏</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="post-share-link" aria-label="Share on Facebook">f</a>
                    </div>
                </div>

                <!-- Post Footer -->
                <div class="post-content__footer">
                    <div class="post-content__tags">
                        <?php the_tags('<span class="post-tag">', '</span><span class="post-tag">', '</span>'); ?>
                    </div>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--outline">← Back to Blog</a>
                </div>

                <!-- Related Posts -->
                <?php
                $categories = get_the_category();
                if ($categories) {
                    $related = new WP_Query([
                        'category__in'   => wp_list_pluck($categories, 'term_id'),
                        'post__not_in'   => [get_the_ID()],
                        'posts_per_page' => 3,
                        'orderby'        => 'rand',
                    ]);

                    if ($related->have_posts()) : ?>
                        <div class="related-posts">
                            <h3 class="related-posts__title">Related Articles</h3>
                            <div class="related-posts__grid">
                                <?php while ($related->have_posts()) : $related->the_post(); ?>
                                    <a href="<?php the_permalink(); ?>" class="related-post-card">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="related-post-card__img">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="related-post-card__body">
                                            <span class="related-post-card__date"><?php echo get_the_date('M j, Y'); ?></span>
                                            <h4 class="related-post-card__title"><?php the_title(); ?></h4>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </article>

</main>

<?php get_footer(); ?>
