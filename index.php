<?php
/**
 * LIVIA Med Spa — Blog/Archive Template
 * Performance-optimized: lazy loading, semantic HTML, category filters
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="page-hero page-hero--blog" aria-label="Blog">
        <div class="page-hero__inner">
            <span class="section__label"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display: inline-block; vertical-align: middle; margin-right: 4px; position: relative; top: -1px;"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg> Our Journal</span>
            <h1 class="page-hero__title">Beauty Tips &amp;<br><em>Treatment Insights</em></h1>
            <p class="page-hero__desc">Stay informed with expert advice, skincare tips, and the latest treatments from our clinical team.</p>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="blog-filters" aria-label="Filter by category">
        <div class="section__inner">
            <div class="blog-filters__bar">
                <?php
                $current_cat = get_query_var('cat');
                $blog_url = get_permalink(get_option('page_for_posts'));
                if (!$blog_url) $blog_url = home_url('/blog/');
                ?>
                <a href="<?php echo esc_url($blog_url); ?>"
                   class="blog-filter-btn <?php echo !$current_cat ? 'is-active' : ''; ?>">All Posts</a>
                <?php
                $blog_cats = get_categories([
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'hide_empty' => true,
                    'number'     => 6,
                    'exclude'    => [1], // Exclude 'Uncategorized'
                ]);
                foreach ($blog_cats as $cat) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                       class="blog-filter-btn <?php echo ($current_cat == $cat->term_id) ? 'is-active' : ''; ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">
            <?php if (have_posts()) : ?>

                <?php
                // Featured: first post gets hero treatment
                $post_count = 0;
                ?>
                <div class="blog-grid blog-grid--featured">
                    <?php while (have_posts()) : the_post(); $post_count++; ?>
                        <a href="<?php the_permalink(); ?>"
                           class="blog-card <?php echo $post_count === 1 ? 'blog-card--hero' : ''; ?> reveal"
                           aria-label="Read: <?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-card__img">
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => $post_count === 1 ? 'eager' : 'lazy',
                                        'decoding' => 'async',
                                        'sizes'    => $post_count === 1
                                            ? '(max-width: 575px) 100vw, 66vw'
                                            : '(max-width: 575px) 100vw, (max-width: 1023px) 50vw, 33vw',
                                    ]); ?>
                                </div>
                            <?php else : ?>
                                <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--bg-cream), var(--bg-lavender));">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.45;"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <?php if (has_category()) : ?>
                                        <span class="blog-card__cat"><?php $cat = get_the_category(); echo esc_html($cat[0]->name); ?></span>
                                    <?php endif; ?>
                                    <time class="blog-card__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                                    <span class="blog-card__read-time"><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 250); ?> min read</span>
                                </div>
                                <h2 class="blog-card__title"><?php the_title(); ?></h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), $post_count === 1 ? 30 : 18); ?></p>
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
                <div class="blog-empty reveal" style="text-align: center; padding: 4rem 2rem;">
                    <div class="blog-empty__icon-wrap" style="margin-bottom: 1.5rem;">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display: inline-block;"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                    </div>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Our blog is launching soon with beauty tips, treatment guides, and expert insights from the LIVIA Med Spa team.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Blog CTA -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Have Questions?</span>
            <h2 class="cta-section__title">Ready to Start<br>Your Glow-Up?</h2>
            <p class="cta-section__text">Book a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
