<?php
/**
 * LIVIA Med Spa — 404 Error Page
 * Premium design with animated elements
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="error-404" aria-label="Page not found">
        <div class="error-404__particles" aria-hidden="true">
            <span style="--x:15%;--y:25%;--delay:0s;--size:3px;"></span>
            <span style="--x:80%;--y:10%;--delay:1.2s;--size:2px;"></span>
            <span style="--x:60%;--y:70%;--delay:2.4s;--size:4px;"></span>
            <span style="--x:30%;--y:85%;--delay:0.6s;--size:2px;"></span>
            <span style="--x:90%;--y:50%;--delay:1.8s;--size:3px;"></span>
        </div>
        <div class="section__inner">
            <div class="error-404__content">
                <span class="error-404__code" aria-hidden="true">
                    <span class="error-404__digit">4</span>
                    <span class="error-404__glow">✦</span>
                    <span class="error-404__digit">4</span>
                </span>
                <h1 class="error-404__title">This Page Has Vanished</h1>
                <p class="error-404__text">Like the perfect skincare routine, some things are worth searching for. Let us help you find what you're looking for.</p>
                <div class="error-404__actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">
                        Back to Home
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">Browse Services</a>
                </div>
                <nav class="error-404__links" aria-label="Popular pages">
                    <span class="error-404__links-label">Popular pages</span>
                    <div class="error-404__links-grid">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>">
                            <span class="error-404__link-icon">✨</span>
                            Services
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <span class="error-404__link-icon">📞</span>
                            Contact
                        </a>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>">
                            <span class="error-404__link-icon">🏢</span>
                            About
                        </a>
                        <a href="<?php echo esc_url(home_url('/memberships/')); ?>">
                            <span class="error-404__link-icon">💎</span>
                            Memberships
                        </a>
                    </div>
                </nav>

                <!-- Search -->
                <div class="error-404__search">
                    <p class="error-404__search-text">Or try searching:</p>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="error-404__search-form">
                        <input type="search" name="s" class="error-404__search-input" placeholder="Search treatments, products..." aria-label="Search">
                        <button type="submit" class="error-404__search-btn btn btn--primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
