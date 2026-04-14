<?php
/**
 * Livia Med Spa — Blog/Fallback Template
 */
get_header(); ?>

<main class="site-main">
    <div class="page-content">
        <div class="section__inner">
            <?php if (have_posts()) : ?>
                <div class="section__header">
                    <h1 class="section__title">Journal</h1>
                    <p class="section__desc">Beauty tips, treatment insights, and the latest from Livia Med Spa.</p>
                </div>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post-card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(); ?></p>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="section__header">
                    <h1 class="section__title">Nothing here yet</h1>
                    <p class="section__desc">Check back soon for updates.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
