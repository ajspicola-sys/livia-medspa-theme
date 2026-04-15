<?php
/**
 * Livia Med Spa — Generic Page Template
 * Auto-routes to custom templates based on page slug
 */

// Auto-route to custom templates by slug
$slug = get_post_field('post_name', get_post());
$custom_templates = [
    'team'        => 'page-team.php',
    'about'       => 'page-about.php',
    'contact'     => 'page-contact.php',
    'memberships' => 'page-memberships.php',
    'parties'     => 'page-parties.php',
    'values'      => 'page-values.php',
    'before-after'=> 'page-before-after.php',
];

if (isset($custom_templates[$slug]) && file_exists(get_template_directory() . '/' . $custom_templates[$slug])) {
    include(get_template_directory() . '/' . $custom_templates[$slug]);
    return;
}

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
