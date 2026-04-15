<?php
/**
 * Livia Med Spa — Generic Page Template
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <div class="generic-page">
        <div class="section__inner">
            <div class="post-content__inner" style="padding-left:0;padding-right:0;">
                <div class="post-content__body">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
