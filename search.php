<?php
/**
 * Livia Med Spa — Search Results Template
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Search results">
        <div class="page-hero__inner">
            <span class="section__label">Search Results</span>
            <h1 class="page-hero__title">Results for "<?php echo esc_html(get_search_query()); ?>"</h1>
            <p class="page-hero__desc"><?php
                global $wp_query;
                $count = $wp_query->found_posts;
                printf(_n('%d result found', '%d results found', $count, 'livia'), $count);
            ?></p>
        </div>
    </section>

    <div class="search-results">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="search-results__grid reveal">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="search-result-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="search-result-card__img">
                                    <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="search-result-card__body">
                                <span class="search-result-card__type"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                                <h2 class="search-result-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="search-result-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                                <a href="<?php the_permalink(); ?>" class="search-result-card__link">View →</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="blog-pagination">
                    <?php the_posts_pagination([
                        'mid_size' => 2,
                        'prev_text' => '← Prev',
                        'next_text' => 'Next →',
                    ]); ?>
                </div>
            <?php else : ?>
                <div class="search-results__empty reveal" style="text-align:center;padding:4rem 0;">
                    <div style="font-size:3rem;margin-bottom:1rem;">🔍</div>
                    <h2 class="section__title">No Results Found</h2>
                    <p class="section__desc">We couldn't find what you're looking for. Try a different search term or browse our popular pages.</p>
                    <div style="display:flex;gap:1rem;justify-content:center;margin-top:2rem;flex-wrap:wrap;">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--primary">Browse Services</a>
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="btn btn--outline">Shop Products</a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline">Contact Us</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</main>

<?php get_footer(); ?>
