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
                            <span class="error-404__link-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
                            </span>
                            Services
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <span class="error-404__link-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            Contact
                        </a>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>">
                            <span class="error-404__link-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            About
                        </a>
                        <a href="<?php echo esc_url(home_url('/memberships/')); ?>">
                            <span class="error-404__link-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h12l4 6-10 13L2 9z"/></svg>
                            </span>
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
