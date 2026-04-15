<?php
/**
 * Livia Med Spa — Generic Page Template
 * Performance-optimized
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Page header">
        <div class="page-hero__inner">
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="page-hero__desc"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <div class="page-content">
        <div class="page-content__inner">
            <?php if (has_post_thumbnail()) : ?>
                <div class="page-content__thumbnail">
                    <?php the_post_thumbnail('large', [
                        'loading'  => 'eager',
                        'decoding' => 'async',
                        'fetchpriority' => 'high',
                    ]); ?>
                </div>
            <?php endif; ?>

            <div class="page-content__body">
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
