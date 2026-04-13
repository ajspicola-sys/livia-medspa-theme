<?php
/**
 * Header Template
 *
 * Premium sticky navigation with mega-menu, mobile drawer, and booking CTA.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- ═══════════════════════════════════════════════════════════════════════
     SITE HEADER
     ═══════════════════════════════════════════════════════════════════════ -->
<header class="site-header" id="siteHeader">
    <div class="site-header__inner container">

        <!-- Logo -->
        <div class="site-header__logo">
            <?php echo livia_get_logo(); ?>
        </div>

        <!-- Desktop Navigation -->
        <nav class="site-header__nav" id="primaryNav" aria-label="<?php esc_attr_e('Primary Navigation', 'livia-medspa'); ?>">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav__links',
                    'walker'         => new Livia_Nav_Walker(),
                    'depth'          => 2,
                ]);
            } else {
                // Fallback navigation
                ?>
                <ul class="nav__links">
                    <li class="nav__item"><a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link">Home</a></li>
                    <li class="nav__item nav__item--has-dropdown">
                        <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="nav__link">
                            Services
                            <svg class="nav__arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <ul class="nav__dropdown">
                            <?php
                            $services = get_posts(['post_type' => 'service', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC']);
                            foreach ($services as $service) :
                            ?>
                                <li class="nav__item">
                                    <a href="<?php echo get_permalink($service->ID); ?>" class="nav__link"><?php echo esc_html($service->post_title); ?></a>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </li>
                    <li class="nav__item"><a href="<?php echo esc_url(get_post_type_archive_link('before_after')); ?>" class="nav__link">Before & After</a></li>
                    <li class="nav__item"><a href="<?php echo esc_url(home_url('/about')); ?>" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="<?php echo esc_url(home_url('/blog')); ?>" class="nav__link">Blog</a></li>
                    <li class="nav__item"><a href="<?php echo esc_url(home_url('/contact')); ?>" class="nav__link">Contact</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>

        <!-- Desktop CTA -->
        <div class="site-header__actions">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('livia_phone', '8132302219'))); ?>" class="site-header__phone" aria-label="Call us">
                <?php echo livia_icon('phone', 18); ?>
            </a>
            <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary btn--sm nav__cta-desktop" id="navBookBtn">Book Now</a>
        </div>

        <!-- Mobile Toggle -->
        <button class="nav__mobile-toggle" id="mobileMenuToggle" aria-label="<?php esc_attr_e('Open menu', 'livia-medspa'); ?>" aria-expanded="false">
            <span class="hamburger">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </span>
        </button>
    </div>
</header>

<!-- ═══════════════════════════════════════════════════════════════════════
     MOBILE MENU DRAWER
     ═══════════════════════════════════════════════════════════════════════ -->
<div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu__drawer">
        <div class="mobile-menu__header">
            <div class="site-header__logo">
                <?php echo livia_get_logo(); ?>
            </div>
            <button class="mobile-menu__close" id="mobileMenuClose" aria-label="<?php esc_attr_e('Close menu', 'livia-medspa'); ?>">
                <?php echo livia_icon('close', 24); ?>
            </button>
        </div>

        <nav class="mobile-menu__nav" aria-label="<?php esc_attr_e('Mobile Navigation', 'livia-medspa'); ?>">
            <?php
            if (has_nav_menu('mobile')) {
                wp_nav_menu([
                    'theme_location' => 'mobile',
                    'container'      => false,
                    'menu_class'     => 'mobile-menu__links',
                    'depth'          => 2,
                ]);
            } elseif (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'mobile-menu__links',
                    'depth'          => 2,
                ]);
            } else {
                ?>
                <ul class="mobile-menu__links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('before_after')); ?>">Before & After</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>

        <div class="mobile-menu__footer">
            <a href="<?php echo esc_url(get_theme_mod('livia_booking_url', '#book')); ?>" class="btn btn--primary btn--lg" style="width: 100%;">Book a Consultation</a>
            <div class="mobile-menu__contact">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('livia_phone', '8132302219'))); ?>" class="mobile-menu__contact-item">
                    <?php echo livia_icon('phone', 16); ?>
                    <span><?php echo esc_html(get_theme_mod('livia_phone', '(813) 230-2219')); ?></span>
                </a>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('livia_email', 'support@liviamedspa.com')); ?>" class="mobile-menu__contact-item">
                    <?php echo livia_icon('mail', 16); ?>
                    <span><?php echo esc_html(get_theme_mod('livia_email', 'support@liviamedspa.com')); ?></span>
                </a>
            </div>
            <?php
            $social = livia_get_social_links();
            if (!empty($social)) :
            ?>
            <div class="mobile-menu__social">
                <?php foreach ($social as $platform => $url) : ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="mobile-menu__social-link" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                        <?php echo livia_icon($platform, 20); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content Wrapper -->
<main class="site-main" id="main">
