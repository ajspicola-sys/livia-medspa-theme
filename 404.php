<?php
/**
 * 404 Error Page Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
?>

<section class="error-page">
    <div class="container">
        <div class="error-page__inner">
            <span class="error-page__code">404</span>
            <h1 class="error-page__title">Page Not Found</h1>
            <p class="error-page__text">The page you're looking for doesn't exist or has been moved. Let's get you back on track.</p>
            
            <div class="error-page__search">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="form-input" placeholder="Search our site..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
                    <button type="submit" class="btn btn--primary">Search</button>
                </form>
            </div>
            
            <div class="error-page__links">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--secondary">Go Home</a>
                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn btn--ghost">View Services</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--ghost">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
