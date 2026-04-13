<?php
/**
 * Blog Archive Template (index.php)
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
?>

<!-- Page Hero -->
<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Our Blog</span>
        <h1 class="page-hero__title">Beauty & Wellness<br>Insights</h1>
        <p class="page-hero__desc">Expert advice, treatment guides, and the latest in medical aesthetics from our team.</p>
    </div>
</section>

<!-- Blog Content -->
<section class="section section--cream">
    <div class="container">
        <div class="blog-layout">
            <div class="blog-main">
                <?php if (have_posts()) : ?>
                <div class="blog-grid stagger-children">
                    <?php while (have_posts()) : the_post(); ?>
                    <article class="blog-card animate-on-scroll" id="post-<?php the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>" class="blog-card__image-wrap">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('livia-card', ['loading' => 'lazy']); ?>
                            <?php else : ?>
                                <div style="width:100%;height:100%;background:linear-gradient(135deg, var(--color-cream) 0%, var(--color-blush-light) 100%);display:flex;align-items:center;justify-content:center;">
                                    <span style="font-family:var(--font-heading);font-size:var(--text-xl);color:var(--color-gold);">Livia</span>
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                                <?php
                                $cats = get_the_category();
                                if ($cats) :
                                ?>
                                <span class="blog-card__cat"><?php echo esc_html($cats[0]->name); ?></span>
                                <?php endif; ?>
                            </div>
                            <h2 class="blog-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="blog-card__link">
                                Read More <?php echo livia_icon('arrow-right', 14); ?>
                            </a>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => '←',
                    'next_text' => '→',
                ]); ?>

                <?php else : ?>
                <div style="text-align: center; padding: var(--space-4xl);">
                    <h2>No Posts Yet</h2>
                    <p class="text-muted">Blog posts coming soon. Check back for beauty tips and treatment insights!</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <?php if (is_active_sidebar('blog-sidebar')) : ?>
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                <?php else : ?>
                    <!-- Default sidebar content -->
                    <div class="sidebar-widget">
                        <h4 class="sidebar-widget__title">About Livia Med Spa</h4>
                        <p style="font-size: var(--text-sm); color: var(--color-gray-500);">Tampa's premier med spa offering expert aesthetic treatments tailored to enhance your natural beauty.</p>
                        <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn--secondary btn--sm" style="margin-top: var(--space-md);">Learn More</a>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="sidebar-widget__title">Popular Services</h4>
                        <ul class="sidebar-services">
                            <?php
                            $sidebar_services = get_posts(['post_type' => 'service', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC']);
                            foreach ($sidebar_services as $service) :
                            ?>
                            <li><a href="<?php echo get_permalink($service->ID); ?>"><?php echo esc_html($service->post_title); ?></a></li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>

                    <div class="sidebar-cta">
                        <h4>Ready for Your Transformation?</h4>
                        <p>Book a free consultation with our expert team.</p>
                        <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary" style="width: 100%;">Book Now</a>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
