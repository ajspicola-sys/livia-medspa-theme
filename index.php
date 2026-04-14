<?php
/**
 * Livia Med Spa — Test Theme
 * Starting with just the header to verify everything works.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- HEADER -->
<header class="site-header">
    <div class="site-header__inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="Home">
            <span class="site-logo__name"><?php bloginfo('name'); ?></span>
            <span class="site-logo__tagline">MED SPA</span>
        </a>

        <nav>
            <ul class="nav__links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link">Home</a></li>
                <li><a href="#" class="nav__link">Services</a></li>
                <li><a href="#" class="nav__link">Before &amp; After</a></li>
                <li><a href="#" class="nav__link">About</a></li>
                <li><a href="#" class="nav__link">Blog</a></li>
                <li><a href="#" class="nav__link">Contact</a></li>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a href="tel:8132302219" class="site-header__phone" aria-label="Call us">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </a>
            <a href="#book" class="btn btn--primary nav__cta-desktop">Book Now</a>
        </div>

        <button class="nav__mobile-toggle" aria-label="Open menu">
            <span class="hamburger">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </span>
        </button>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="site-main">
    <div class="test-section">
        <div class="test-badge">
            <span class="test-badge__dot"></span>
            Theme Test
        </div>
        <h1>Header is working!</h1>
        <p>If you can see the styled header above with the gold "Livia" logo, navigation links, and "Book Now" button — the theme is loading correctly. Next step: add the hero section.</p>
    </div>
</main>

<?php wp_footer(); ?>
</body>
</html>
