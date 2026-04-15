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
    <meta name="theme-color" content="#1a1a2e" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#faf8f5" media="(prefers-color-scheme: light)">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <?php wp_head(); ?>

    <!-- Critical CSS: inlined to prevent render-blocking for above-the-fold content -->
    <style id="livia-critical-css">
        /* Prevent layout shift for header + hero */
        html{scroll-behavior:smooth;-webkit-font-smoothing:antialiased;}
        body{margin:0;font-family:'DM Sans','Helvetica Neue',Arial,sans-serif;background:#faf8f5;overflow-x:hidden;}
        .site-header{position:fixed;top:0;left:0;right:0;z-index:200;padding:0.85rem 0;transition:background .4s ease,padding .4s ease,box-shadow .4s ease,top .4s ease;}
        .site-header__inner{max-width:1280px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);display:flex;align-items:center;justify-content:space-between;gap:2rem;}
        .site-logo{display:flex;flex-direction:column;align-items:flex-start;text-decoration:none;flex-shrink:0;}
        .site-logo__name{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(1.6rem,1.3rem + 1.2vw,2.1rem);font-weight:300;letter-spacing:.06em;background:linear-gradient(135deg,#c9a96e 0%,#dbb978 40%,#a88b4a 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
        .site-logo__tagline{font-family:'DM Sans',sans-serif;font-size:.55rem;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:#b89960;margin-top:-3px;}
        .announcement-bar{background:linear-gradient(135deg,#1a1a2e 0%,#252540 100%);padding:.5rem 0;text-align:center;position:relative;z-index:201;}
        .hero{min-height:600px;display:flex;align-items:center;justify-content:center;text-align:center;position:relative;background:linear-gradient(135deg,#1a1a2e 0%,#16213e 40%,#252540 100%);padding:clamp(2rem,1.5rem + 3vw,4rem);overflow:hidden;}
        .site-main{padding-top:120px;}
        .has-announcement .site-main{padding-top:152px;}
        /* Preload font-display for system fonts fallback */
        @font-face{font-family:'Cormorant Garamond';font-display:swap;src:local('Cormorant Garamond');}
        @font-face{font-family:'DM Sans';font-display:swap;src:local('DM Sans');}
    </style>
</head>
<body <?php body_class('has-announcement'); ?>>
<?php wp_body_open(); ?>

<!-- ANNOUNCEMENT BAR -->
<div class="announcement-bar" id="announcement-bar">
    <div class="announcement-bar__inner">
        <span class="announcement-bar__text"><strong>✦ New Client Special</strong> — 20% off your first treatment</span>
        <a href="#book" class="announcement-bar__cta">Book Now</a>
    </div>
    <button class="announcement-bar__close" id="announcement-close" aria-label="Dismiss announcement">✕</button>
</div>

<!-- HEADER – uses will-change for GPU compositing during scroll -->
<header class="site-header" id="site-header" role="banner">
    <div class="site-header__inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="Livia Med Spa — Home">
            <span class="site-logo__name">Livia</span>
            <span class="site-logo__tagline">MED SPA</span>
        </a>

        <nav class="site-header__nav" aria-label="Main navigation">
            <ul class="nav__links">
                <li class="nav__item nav__item--active">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link">Home</a>
                </li>
                <li class="nav__item nav__item--has-mega">
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="nav__link">Services <span class="nav__arrow">▾</span></a>
                    <div class="mega-menu">
                        <div class="mega-menu__inner">
                            <?php
                            // Icon color palette — rotates per service
                            $icon_colors = [
                                ['bg' => 'rgba(196,122,122,0.12)', 'fg' => '#c47a7a'],
                                ['bg' => 'rgba(201,169,110,0.12)', 'fg' => '#c9a96e'],
                                ['bg' => 'rgba(143,170,143,0.12)', 'fg' => '#8faa8f'],
                                ['bg' => 'rgba(160,142,196,0.12)', 'fg' => '#a08ec4'],
                                ['bg' => 'rgba(111,163,214,0.12)', 'fg' => '#6fa3d6'],
                                ['bg' => 'rgba(214,170,111,0.12)', 'fg' => '#d6aa6f'],
                            ];
                            $color_index = 0;

                            // Get all service categories
                            $service_cats = get_terms([
                                'taxonomy'   => 'service_category',
                                'hide_empty' => true,
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                            ]);

                            if (!is_wp_error($service_cats) && !empty($service_cats)) :
                                // Group services by category
                                foreach ($service_cats as $cat) :
                                    $cat_services = new WP_Query([
                                        'post_type'      => 'service',
                                        'posts_per_page' => 6,
                                        'orderby'        => 'menu_order',
                                        'order'          => 'ASC',
                                        'no_found_rows'  => true,
                                        'tax_query'      => [[
                                            'taxonomy' => 'service_category',
                                            'field'    => 'term_id',
                                            'terms'    => $cat->term_id,
                                        ]],
                                    ]);
                                    if ($cat_services->have_posts()) : ?>
                                        <div class="mega-menu__column">
                                            <span class="mega-menu__heading"><?php echo esc_html($cat->name); ?></span>
                                            <div class="mega-menu__items">
                                                <?php while ($cat_services->have_posts()) : $cat_services->the_post();
                                                    $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                                                    $c = $icon_colors[$color_index % count($icon_colors)];
                                                    $color_index++;
                                                ?>
                                                    <a href="<?php the_permalink(); ?>" class="mega-menu__item">
                                                        <span class="mega-menu__item-icon" style="background:<?php echo $c['bg']; ?>;color:<?php echo $c['fg']; ?>;"><?php echo esc_html($icon); ?></span>
                                                        <span class="mega-menu__item-content">
                                                            <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                            <span class="mega-menu__item-desc"><?php echo wp_trim_words(get_the_excerpt(), 6); ?></span>
                                                        </span>
                                                        <span class="mega-menu__item-arrow">→</span>
                                                    </a>
                                                <?php endwhile; wp_reset_postdata(); ?>
                                            </div>
                                        </div>
                                    <?php endif;
                                endforeach;

                            else :
                                // No categories — show all services in one column
                                $all_services = new WP_Query([
                                    'post_type'      => 'service',
                                    'posts_per_page' => 12,
                                    'orderby'        => 'menu_order',
                                    'order'          => 'ASC',
                                    'no_found_rows'  => true,
                                ]);

                                if ($all_services->have_posts()) : ?>
                                    <div class="mega-menu__column">
                                        <span class="mega-menu__heading">Our Treatments</span>
                                        <div class="mega-menu__items">
                                            <?php while ($all_services->have_posts()) : $all_services->the_post();
                                                $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                                                $c = $icon_colors[$color_index % count($icon_colors)];
                                                $color_index++;
                                            ?>
                                                <a href="<?php the_permalink(); ?>" class="mega-menu__item">
                                                    <span class="mega-menu__item-icon" style="background:<?php echo $c['bg']; ?>;color:<?php echo $c['fg']; ?>;"><?php echo esc_html($icon); ?></span>
                                                    <span class="mega-menu__item-content">
                                                        <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                        <span class="mega-menu__item-desc"><?php echo wp_trim_words(get_the_excerpt(), 6); ?></span>
                                                    </span>
                                                    <span class="mega-menu__item-arrow">→</span>
                                                </a>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                <?php endif;

                            endif;
                            ?>

                            <!-- Promo Card -->
                            <div class="mega-menu__promo">
                                <div>
                                    <span class="mega-menu__promo-label">✦ New Client Special</span>
                                    <h3 class="mega-menu__promo-title">Your First Visit is 20% Off</h3>
                                    <p class="mega-menu__promo-text">Experience Tampa's most advanced aesthetic treatments with a personalized consultation.</p>
                                </div>
                                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mega-menu__promo-cta">Book Now →</a>
                            </div>
                        </div>
                        <div class="mega-menu__bottom">
                            <div class="mega-menu__bottom-links">
                                <a href="<?php echo esc_url(home_url('/before-after/')); ?>" class="mega-menu__bottom-link">📋 Before & After</a>
                                <a href="<?php echo esc_url(home_url('/memberships/')); ?>" class="mega-menu__bottom-link">💰 Memberships</a>
                                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mega-menu__bottom-link">❓ FAQ</a>
                            </div>
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="mega-menu__bottom-cta">View All Services →</a>
                        </div>
                    </div>
                </li>
                <li class="nav__item"><a href="<?php echo esc_url(home_url('/before-after/')); ?>" class="nav__link">Before &amp; After</a></li>

                <!-- About with Mega Menu -->
                <li class="nav__item nav__item--has-mega">
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav__link">About <span class="nav__arrow">▾</span></a>
                    <div class="mega-menu">
                        <div class="mega-menu__inner mega-menu__inner--compact">
                            <div class="mega-menu__column">
                                <span class="mega-menu__heading">About Livia</span>
                                <div class="mega-menu__items">
                                    <a href="<?php echo esc_url(home_url('/team/')); ?>" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(196,122,122,0.12);color:#c47a7a;">👩‍⚕️</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Meet the Team</span>
                                            <span class="mega-menu__item-desc">Board-certified providers</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/values/')); ?>" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(143,170,143,0.12);color:#8faa8f;">🎯</span>
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
                                    <p class="mega-menu__promo-text">Our board-certified team combines artistry with science to deliver natural, stunning results every time.</p>
                                </div>
                                <a href="<?php echo esc_url(home_url('/team/')); ?>" class="mega-menu__promo-cta">Meet the Team →</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav__item"><a href="<?php echo esc_url(home_url('/memberships/')); ?>" class="nav__link">Memberships</a></li>
                <li class="nav__item"><a href="<?php echo esc_url(home_url('/parties/')); ?>" class="nav__link">Parties</a></li>
                <li class="nav__item"><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav__link">Blog</a></li>
                <li class="nav__item"><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav__link">Contact</a></li>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a href="tel:8132302219" class="site-header__phone" aria-label="Call us at (813) 230-2219">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </a>
            <span class="header__divider"></span>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--sm nav__cta-desktop">Book Now</a>
        </div>

        <button class="nav__mobile-toggle" id="mobile-toggle" aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-menu">
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
                <span class="site-logo__name">Livia</span>
                <span class="site-logo__tagline">MED SPA</span>
            </a>
            <button class="mobile-menu__close" id="mobile-close" aria-label="Close navigation menu">✕</button>
        </div>
        <nav class="mobile-menu__nav" aria-label="Mobile navigation">
            <ul class="mobile-menu__links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                <li><a href="<?php echo esc_url(home_url('/before-after/')); ?>">Before & After</a></li>
                <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a></li>
                <li><a href="<?php echo esc_url(home_url('/parties/')); ?>">Parties</a></li>
                <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
            </ul>
        </nav>
        <div class="mobile-menu__footer">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary" style="width:100%;justify-content:center;">Book a Consultation</a>
            <a href="tel:8132302219" class="mobile-menu__contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                (813) 230-2219
            </a>
            <a href="mailto:support@liviamedspa.com" class="mobile-menu__contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                support@liviamedspa.com
            </a>
        </div>
    </div>
</div>
