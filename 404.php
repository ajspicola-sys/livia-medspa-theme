<?php
/**
 * Livia Med Spa — 404 Error Page
 * Lightweight: minimal DOM, no external resources
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="error-404" aria-label="Page not found">
        <div class="section__inner">
            <div class="error-404__content">
                <span class="error-404__code" aria-hidden="true">404</span>
                <h1 class="error-404__title">Page Not Found</h1>
                <p class="error-404__text">The page you're looking for doesn't exist or has been moved. Let's get you back on track to feeling beautiful.</p>
                <div class="error-404__actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">Back to Home</a>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">Browse Services</a>
                </div>
                <nav class="error-404__links" aria-label="Popular pages">
                    <span class="error-404__links-label">Popular pages:</span>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>">About</a>
                    <a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a>
                    <a href="<?php echo esc_url(home_url('/parties/')); ?>">Parties</a>
                </nav>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
