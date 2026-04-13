<?php
/**
 * Generic Page Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

while (have_posts()) : the_post();
?>

<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<section class="section">
    <div class="container container--narrow">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
