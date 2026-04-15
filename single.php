<?php
/**
 * Livia Med Spa — Single Post Template
 */
get_header(); ?>

<main class="site-main">

    <article class="single-post">
        <!-- Post Hero -->
        <div class="page-hero">
            <div class="page-hero__inner">
                <span class="section__label"><?php echo get_the_date('F j, Y'); ?></span>
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

                <!-- Post Footer -->
                <div class="post-content__footer">
                    <div class="post-content__tags">
                        <?php the_tags('<span class="post-tag">', '</span><span class="post-tag">', '</span>'); ?>
                    </div>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--outline">← Back to Blog</a>
                </div>
            </div>
        </div>
    </article>

</main>

<?php get_footer(); ?>
