<?php
/**
 * Livia Med Spa — Header Template
 * Performance-optimized with critical CSS inlining
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1A0E2E" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#F0EBE3" media="(prefers-color-scheme: light)">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <?php
    // Dynamic meta description
    if (is_front_page()) {
        $meta_desc = 'Livia Med Spa is Tampa\'s premier medical spa offering Botox, dermal fillers, laser treatments, RF microneedling, and medical-grade skincare. Led by Angela Spicola, APRN — serving Tampa, FL. Book today.';
    } elseif (is_singular('service')) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: get_the_title() . ' treatment in Tampa, FL at Livia Med Spa — board-certified provider, natural results.';
    } elseif (is_singular('product')) {
        $meta_desc = get_the_title() . ' — Medical-grade skincare products available at Livia Med Spa in Tampa, FL.';
    } elseif (is_page()) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: 'Livia Med Spa — Tampa\'s trusted medical spa for advanced aesthetic treatments.';
    } else {
        $meta_desc = 'Livia Med Spa — Tampa\'s premier destination for advanced aesthetics. Botox, fillers, laser treatments, and more in Tampa, FL.';
    }
    ?>
    <meta name="description" content="<?php echo esc_attr($meta_desc); ?>">
    <link rel="canonical" href="<?php echo esc_url(get_permalink() ?: home_url('/')); ?>">

    <!-- Open Graph -->
    <meta property="og:site_name" content="Livia Med Spa">
    <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta property="og:type" content="<?php echo is_front_page() ? 'website' : 'article'; ?>">
    <meta property="og:url" content="<?php echo esc_url(is_front_page() ? home_url('/') : get_permalink()); ?>">
    <meta property="og:locale" content="en_US">
    <?php if (has_post_thumbnail()) : ?>
        <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
    <?php else : ?>
        <meta property="og:image" content="https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png">
    <?php endif; ?>

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta name="twitter:site" content="@liviamedspa">

    <!-- Preconnect for Google Fonts performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php
    // Preload main stylesheet — fetched at high priority, applied non-blocking
    $theme_ver = filemtime( get_stylesheet_directory() . '/style.css' );
    echo '<link rel="preload" href="' . esc_url( get_stylesheet_uri() . '?ver=' . $theme_ver ) . '" as="style">' . "\n";
    ?>

    <?php wp_head(); ?>

    <!-- Critical CSS: inlined to prevent render-blocking for above-the-fold content -->
    <style id="livia-critical-css">
        /* Prevent layout shift for header + hero */
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
        }

        body {
            margin: 0;
            font-family: 'DM Sans', 'Helvetica Neue', Arial, sans-serif;
            background: #F0EBE3;
            overflow-x: hidden;
        }

        main.site-main {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        .client-portal {
            margin-top: 0 !important;
        }


        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            padding: 1.75rem 0;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 1px 30px rgba(0, 0, 0, 0.06);
            transition: padding .4s ease, box-shadow .4s ease;
        }

        .site-header__inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .site-logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-decoration: none;
            flex-shrink: 0;
        }

        .site-logo__name {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(1.6rem, 1.3rem + 1.2vw, 2.1rem);
            font-weight: 300;
            letter-spacing: .06em;
            background: linear-gradient(135deg, #AC13F9 0%, #F471D1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .site-logo__tagline {
            font-family: 'DM Sans', sans-serif;
            font-size: .55rem;
            font-weight: 600;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: #C955F0;
            margin-top: -3px;
        }

        .hero {
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: linear-gradient(145deg, #FFFFFF 0%, #F5EEFF 45%, #FFF0FA 100%);
            padding: clamp(2rem, 1.5rem + 3vw, 4rem);
            overflow: hidden;
        }

        .site-main {
            padding-top: 80px;
        }

        /* Preload font-display for system fonts fallback */
        @font-face {
            font-family: 'Cormorant Garamond';
            font-display: swap;
            src: local('Cormorant Garamond');
        }

        @font-face {
            font-family: 'DM Sans';
            font-display: swap;
            src: local('DM Sans');
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Skip to content (accessibility) -->
    <a class="skip-to-content" href="#main-content">Skip to content</a>


    <!-- HEADER – uses will-change for GPU compositing during scroll -->
    <header class="site-header" id="site-header" role="banner">
        <div class="site-header__inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="Livia Med Spa — Home">
                <img src="https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png" alt="Livia Med Spa" class="site-logo__img" width="160" height="40" loading="eager" decoding="async">
            </a>

            <nav class="site-header__nav" aria-label="Main navigation">
                <ul class="nav__links">
                    <li class="nav__item<?php if (is_front_page()) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link">Home</a>
                    </li>
                    <li class="nav__item nav__item--has-mega<?php if (is_post_type_archive('service') || is_singular('service')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="nav__link">Services <span
                                class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner">
                                <?php
                                // Icon color palette — rotates per service
                                $icon_colors = [
                                    ['bg' => 'rgba(196,122,122,0.12)', 'fg' => '#c47a7a'],
                                    ['bg' => 'rgba(201,169,110,0.12)', 'fg' => '#AC13F9'],
                                    ['bg' => 'rgba(143,170,143,0.12)', 'fg' => '#8faa8f'],
                                    ['bg' => 'rgba(160,142,196,0.12)', 'fg' => '#a08ec4'],
                                    ['bg' => 'rgba(111,163,214,0.12)', 'fg' => '#6fa3d6'],
                                    ['bg' => 'rgba(214,170,111,0.12)', 'fg' => '#d6aa6f'],
                                ];
                                $color_index = 0;

                                // Get all service categories
                                $service_cats = get_terms([
                                    'taxonomy' => 'service_category',
                                    'hide_empty' => true,
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                ]);

                                if (!is_wp_error($service_cats) && !empty($service_cats)):
                                    // Group services by category
                                    foreach ($service_cats as $cat):
                                        $cat_services = new WP_Query([
                                            'post_type' => 'service',
                                            'posts_per_page' => 6,
                                            'orderby' => 'menu_order',
                                            'order' => 'ASC',
                                            'no_found_rows' => true,
                                            'tax_query' => [
                                                [
                                                    'taxonomy' => 'service_category',
                                                    'field' => 'term_id',
                                                    'terms' => $cat->term_id,
                                                ]
                                            ],
                                        ]);
                                        if ($cat_services->have_posts()): ?>
                                            <div class="mega-menu__column">
                                                <span class="mega-menu__heading"><?php echo esc_html($cat->name); ?></span>
                                                <div class="mega-menu__items">
                                                    <?php while ($cat_services->have_posts()):
                                                        $cat_services->the_post();
                                                        $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                                                        $c = $icon_colors[$color_index % count($icon_colors)];
                                                        $color_index++;
                                                        ?>
                                                        <a href="<?php the_permalink(); ?>" class="mega-menu__item">
                                                            <span class="mega-menu__item-icon"
                                                                style="background:<?php echo $c['bg']; ?>;color:<?php echo $c['fg']; ?>;"><?php echo esc_html($icon); ?></span>
                                                            <span class="mega-menu__item-content">
                                                                <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                                <span
                                                                    class="mega-menu__item-desc"><?php echo wp_trim_words(get_the_excerpt(), 6); ?></span>
                                                            </span>
                                                            <span class="mega-menu__item-arrow">→</span>
                                                        </a>
                                                    <?php endwhile;
                                                    wp_reset_postdata(); ?>
                                                </div>
                                            </div>
                                        <?php endif;
                                    endforeach;

                                else:
                                    // No categories — show all services in one column
                                    $all_services = new WP_Query([
                                        'post_type' => 'service',
                                        'posts_per_page' => 12,
                                        'orderby' => 'menu_order',
                                        'order' => 'ASC',
                                        'no_found_rows' => true,
                                    ]);

                                    if ($all_services->have_posts()): ?>
                                        <div class="mega-menu__column">
                                            <span class="mega-menu__heading">Our Treatments</span>
                                            <div class="mega-menu__items">
                                                <?php while ($all_services->have_posts()):
                                                    $all_services->the_post();
                                                    $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                                                    $c = $icon_colors[$color_index % count($icon_colors)];
                                                    $color_index++;
                                                    ?>
                                                    <a href="<?php the_permalink(); ?>" class="mega-menu__item">
                                                        <span class="mega-menu__item-icon"
                                                            style="background:<?php echo $c['bg']; ?>;color:<?php echo $c['fg']; ?>;"><?php echo esc_html($icon); ?></span>
                                                        <span class="mega-menu__item-content">
                                                            <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                            <span
                                                                class="mega-menu__item-desc"><?php echo wp_trim_words(get_the_excerpt(), 6); ?></span>
                                                        </span>
                                                        <span class="mega-menu__item-arrow">→</span>
                                                    </a>
                                                <?php endwhile;
                                                wp_reset_postdata(); ?>
                                            </div>
                                        </div>
                                    <?php endif;

                                endif;
                                ?>

                                <!-- Promo Card -->
                                <div class="mega-menu__promo">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ New Client Special</span>
                                        <h3 class="mega-menu__promo-title">$50 Off Your First Visit</h3>
                                        <p class="mega-menu__promo-text">Experience Tampa's most advanced aesthetic
                                            treatments with a personalized consultation.</p>
                                    </div>
                                    <a href="#book-now"
                                        class="mega-menu__promo-cta">Book Now →</a>
                                </div>
                            </div>
                            <div class="mega-menu__bottom">
                                <div class="mega-menu__bottom-links">
                                    <a href="<?php echo esc_url(home_url('/memberships/')); ?>"
                                        class="mega-menu__bottom-link">💰 Memberships</a>
                                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                                        class="mega-menu__bottom-link">❓ FAQ</a>
                                </div>
                                <a href="<?php echo esc_url(home_url('/services/')); ?>"
                                    class="mega-menu__bottom-cta">View All Services →</a>
                            </div>
                        </div>
                    </li>

                    <!-- Products with Mega Menu -->
                    <li class="nav__item nav__item--has-mega<?php if (is_page(['products', 'our-products', 'shop']) || is_singular('product')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="nav__link">Products <span
                                class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner mega-menu__inner--compact">
                                <div class="mega-menu__column">
                                    <span class="mega-menu__heading">Our Products</span>
                                    <div class="mega-menu__items">
                                        <?php
                                        $nav_products = new WP_Query([
                                            'post_type' => 'product',
                                            'posts_per_page' => 8,
                                            'orderby' => 'menu_order',
                                            'order' => 'ASC',
                                            'no_found_rows' => true,
                                        ]);
                                        if ($nav_products->have_posts()):
                                            $p_colors = [
                                                ['bg' => 'rgba(201,169,110,0.12)', 'fg' => '#AC13F9'],
                                                ['bg' => 'rgba(196,122,122,0.12)', 'fg' => '#c47a7a'],
                                                ['bg' => 'rgba(143,170,143,0.12)', 'fg' => '#8faa8f'],
                                                ['bg' => 'rgba(160,142,196,0.12)', 'fg' => '#a08ec4'],
                                            ];
                                            $pi = 0;
                                            while ($nav_products->have_posts()):
                                                $nav_products->the_post();
                                                $p_url = get_post_meta(get_the_ID(), '_product_url', true) ?: '#';
                                                $pc = $p_colors[$pi % count($p_colors)];
                                                $pi++;
                                                ?>
                                                <a href="<?php echo esc_url($p_url); ?>" class="mega-menu__item" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <span class="mega-menu__item-icon"
                                                        style="background:<?php echo $pc['bg']; ?>;color:<?php echo $pc['fg']; ?>;">🛍️</span>
                                                    <span class="mega-menu__item-content">
                                                        <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                        <span
                                                            class="mega-menu__item-desc"><?php echo wp_trim_words(get_the_excerpt(), 6); ?></span>
                                                    </span>
                                                    <span class="mega-menu__item-arrow">→</span>
                                                </a>
                                            <?php endwhile;
                                            wp_reset_postdata();
                                        else: ?>
                                            <p style="color:#7a7a90;font-size:0.85rem;padding:1rem;">Products coming soon.
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mega-menu__promo" style="min-height:220px;">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ Curated Collection</span>
                                        <h3 class="mega-menu__promo-title">Medical-Grade Products</h3>
                                        <p class="mega-menu__promo-text">Physician-selected products to complement your
                                            treatments and elevate your daily skincare routine.</p>
                                    </div>
                                    <a href="<?php echo esc_url(home_url('/products/')); ?>"
                                        class="mega-menu__promo-cta">View All Products →</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- About with Mega Menu -->
                    <li class="nav__item nav__item--has-mega<?php if (is_page(['about', 'team', 'meet-the-team', 'our-team', 'values', 'our-values'])) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav__link">About <span
                                class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner mega-menu__inner--compact">
                                <div class="mega-menu__column">
                                    <span class="mega-menu__heading">About Livia</span>
                                    <div class="mega-menu__items">
                                        <a href="<?php echo esc_url(home_url('/team/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon"
                                                style="background:rgba(196,122,122,0.12);color:#c47a7a;">👩‍⚕️</span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">Meet the Team</span>
                                                <span class="mega-menu__item-desc">Board-certified providers</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                        <a href="<?php echo esc_url(home_url('/values/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon"
                                                style="background:rgba(143,170,143,0.12);color:#8faa8f;">🎯</span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">Our Mission</span>
                                                <span class="mega-menu__item-desc">Our purpose & core values</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="mega-menu__promo" style="min-height:220px;">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ Meet Our Experts</span>
                                        <h3 class="mega-menu__promo-title">World-Class Care</h3>
                                        <p class="mega-menu__promo-text">Our board-certified team combines artistry with
                                            science to deliver natural, stunning results every time.</p>
                                    </div>
                                    <a href="<?php echo esc_url(home_url('/team/')); ?>"
                                        class="mega-menu__promo-cta">Meet the Team →</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav__item<?php if (is_page('memberships')) echo ' nav__item--active'; ?>"><a href="<?php echo esc_url(home_url('/memberships/')); ?>"
                            class="nav__link">Memberships</a></li>
                    <li class="nav__item<?php if (is_page('parties')) echo ' nav__item--active'; ?>"><a href="<?php echo esc_url(home_url('/parties/')); ?>"
                            class="nav__link">Parties</a></li>
                    <li class="nav__item<?php if (is_page('financing')) echo ' nav__item--active'; ?>"><a href="<?php echo esc_url(home_url('/financing/')); ?>"
                            class="nav__link">Payment Plans</a></li>
                    <li class="nav__item<?php if (is_page('contact')) echo ' nav__item--active'; ?>"><a href="<?php echo esc_url(home_url('/contact/')); ?>"
                            class="nav__link">Contact</a></li>
                </ul>
            </nav>

            <div class="site-header__actions">
                <a href="tel:8132302219" class="site-header__phone" aria-label="Call us at (813) 230-2219">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                </a>
                <span class="header__divider"></span>
                <a href="#book-now"
                    class="btn btn--primary btn--sm nav__cta-desktop">Book Now</a>
            </div>

            <button class="nav__mobile-toggle" id="mobile-toggle" aria-label="Open navigation menu"
                aria-expanded="false" aria-controls="mobile-menu">
                <span class="hamburger">
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                </span>
            </button>
        </div>
    </header>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile navigation" aria-hidden="true">
        <div class="mobile-menu__overlay" id="mobile-overlay"></div>
        <div class="mobile-menu__drawer">
            <div class="mobile-menu__header">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png" alt="Livia Med Spa" class="site-logo__img" width="140" height="auto">
                </a>
                <button class="mobile-menu__close" id="mobile-close" aria-label="Close navigation menu">✕</button>
            </div>
            <nav class="mobile-menu__nav" aria-label="Mobile navigation">
                <ul class="mobile-menu__links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url(home_url('/products/')); ?>">Products</a></li>

                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/team/')); ?>">Meet the Team</a></li>
                    <li><a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a></li>
                    <li><a href="<?php echo esc_url(home_url('/parties/')); ?>">Parties</a></li>
                    <li><a href="<?php echo esc_url(home_url('/financing/')); ?>">Payment Plans</a></li>

                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                </ul>
            </nav>
            <div class="mobile-menu__footer">
                <a href="#book-now" class="btn btn--primary"
                    style="width:100%;justify-content:center;">Book a Consultation</a>
                <a href="tel:8132302219" class="mobile-menu__contact-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    (813) 230-2219
                </a>
                <a href="mailto:support@liviamedspa.com" class="mobile-menu__contact-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                    support@liviamedspa.com
                </a>
            </div>
        </div>
    </div>