<?php
/**
 * LIVIA Med Spa — Header Template
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
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <?php
    // ── SEO Meta Tags — Smart Plugin Detection ─────────────────────────────
    // Yoast SEO and Rank Math both output <meta name="description">, og:*, and
    // twitter:* tags via wp_head(). If either plugin is active, we skip the
    // theme's own output entirely to prevent duplicates.
    // The theme tags only fire as a safety fallback when NO SEO plugin is installed.
    $livia_seo_plugin_active = defined('WPSEO_VERSION')        // Yoast SEO
                            || defined('RANK_MATH_VERSION')    // Rank Math
                            || defined('AIOSEOP_VERSION');     // All in One SEO

    // ── Build meta description (used by fallback AND OG block below) ────────
    if (is_front_page()) {
        $meta_desc = 'Tampa med spa for Botox, fillers, Helix CO2 laser, RF microneedling, GLP-1 weight loss & hormone therapy by Angela Spicola, APRN. New clients save $50 — book free.';
    } elseif (is_singular('post')) {
        // Blog posts: use post excerpt for unique, content-specific descriptions
        $post_excerpt = wp_strip_all_tags(get_the_excerpt());
        $meta_desc = $post_excerpt
            ? wp_trim_words($post_excerpt, 25)
            : get_the_title() . ' — Expert insights from LIVIA Med Spa, Tampa\'s premier medical spa. Read more on our blog.';
    } elseif (is_singular('service')) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: get_the_title() . ' in Tampa, FL at LIVIA Med Spa — board-certified provider, natural results.';
    } elseif (is_singular('product')) {
        $meta_desc = get_the_title() . ' — Medical-grade skincare available at LIVIA Med Spa in Tampa, FL.';
    } elseif (is_page('carecredit')) {
        $meta_desc = 'Finance your med spa treatments in Tampa with CareCredit. Prequalify in seconds with no impact to your credit score, then pay over time at LIVIA Med Spa.';
    } elseif (is_page('financing')) {
        $meta_desc = 'Flexible med spa payment plans in Tampa via Cherry — instant approval, 0% APR options, no hidden fees. Split any LIVIA Med Spa treatment into monthly payments.';
    } elseif (is_page()) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: 'LIVIA Med Spa — Tampa\'s trusted medical spa for advanced aesthetic treatments.';
    } elseif (is_home() || is_category() || is_tag() || is_archive()) {
        $meta_desc = 'Expert skincare tips, treatment guides, and aesthetic medicine insights from LIVIA Med Spa in Tampa, FL.';
    } else {
        $meta_desc = 'LIVIA Med Spa — Tampa\'s premier destination for advanced aesthetics. Botox, fillers, laser treatments, and more in Tampa, FL.';
    }

    // Cap at ~160 chars (on a word boundary) so search engines don't truncate it
    // and to satisfy SEO audits. Also feeds og:description below.
    if ( mb_strlen( $meta_desc ) > 160 ) {
        $meta_desc = mb_substr( $meta_desc, 0, 157 );
        $last_space = mb_strrpos( $meta_desc, ' ' );
        if ( $last_space ) {
            $meta_desc = mb_substr( $meta_desc, 0, $last_space );
        }
        $meta_desc = rtrim( $meta_desc, " ,.;:—-" ) . '…';
    }

    // ── Output meta description ONLY when no SEO plugin is handling it ──────
    if ( ! $livia_seo_plugin_active ) : ?>
    <meta name="description" content="<?php echo esc_attr($meta_desc); ?>">
    <?php endif; ?>

    <?php
    // NOTE: Canonical tag is owned by the SEO plugin. Do NOT add it back here.

    // ── Open Graph & Twitter — fallback only when no SEO plugin active ──────
    // Yoast/Rank Math output og:* and twitter:* via wp_head() when enabled.
    $og_default_img    = 'https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png';
    $og_default_width  = 600;
    $og_default_height = 932;
    $og_default_alt    = 'LIVIA Med Spa - Tampa Aesthetic Studio';

    if ( has_post_thumbnail() ) {
        $thumb_id   = get_post_thumbnail_id();
        $thumb_data = wp_get_attachment_image_src( $thumb_id, 'full' );
        $og_img     = $thumb_data ? esc_url( $thumb_data[0] ) : $og_default_img;
        $og_img_w   = $thumb_data ? (int) $thumb_data[1]     : $og_default_width;
        $og_img_h   = $thumb_data ? (int) $thumb_data[2]     : $og_default_height;
        $og_img_alt = esc_attr( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?: $og_default_alt );
    } else {
        $og_img     = $og_default_img;
        $og_img_w   = $og_default_width;
        $og_img_h   = $og_default_height;
        $og_img_alt = esc_attr( $og_default_alt );
    }

    // Derive the real mime type from the image URL (post thumbnails are often JPEG)
    $og_img_filetype = wp_check_filetype( $og_img );
    $og_img_mime     = ! empty( $og_img_filetype['type'] ) ? $og_img_filetype['type'] : 'image/png';

    $og_title = is_front_page() ? 'LIVIA Med Spa | Botox, Fillers & Laser in Tampa, FL' : wp_get_document_title();
    $og_desc  = $meta_desc ?: 'Tampa\'s premier boutique medical spa — Botox, fillers, laser, RF microneedling & skincare. Led by Angela Spicola, APRN.';
    $og_url   = is_front_page() ? home_url('/') : (get_permalink() ?: home_url('/'));
    $og_type  = (is_front_page() || is_page()) ? 'website' : 'article';

    if ( ! $livia_seo_plugin_active ) : ?>
    <meta property="og:site_name"        content="LIVIA Med Spa">
    <meta property="og:type"             content="<?php echo esc_attr( $og_type ); ?>">
    <meta property="og:url"              content="<?php echo esc_url( $og_url ); ?>">
    <meta property="og:title"            content="<?php echo esc_attr( $og_title ); ?>">
    <meta property="og:description"      content="<?php echo esc_attr( $og_desc ); ?>">
    <meta property="og:locale"           content="en_US">
    <meta property="og:image"            content="<?php echo esc_url( $og_img ); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url( $og_img ); ?>">
    <meta property="og:image:width"      content="<?php echo (int) $og_img_w; ?>">
    <meta property="og:image:height"     content="<?php echo (int) $og_img_h; ?>">
    <meta property="og:image:alt"        content="<?php echo esc_attr( $og_img_alt ); ?>">
    <meta property="og:image:type"       content="<?php echo esc_attr( $og_img_mime ); ?>">

    <!-- Twitter / X Card (mirrors OG for press wires) -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:site"        content="@liviamedspa">
    <meta name="twitter:title"       content="<?php echo esc_attr( $og_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $og_desc ); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url( $og_img ); ?>">
    <meta name="twitter:image:alt"   content="<?php echo esc_attr( $og_img_alt ); ?>">
    <?php endif; // end: ! $livia_seo_plugin_active — Yoast/RankMath handles OG+Twitter ?>

    <!-- Preconnect for Google Fonts performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php
    // Preload main stylesheet — fetched at high priority, applied non-blocking.
    // The ?ver= must match livia_enqueue_styles() exactly or the preload is wasted.
    // Skipped when LiteSpeed Cache is active: its CSS optimizer rewrites the
    // stylesheet URL to a minified bundle, so preloading the raw file would
    // download ~200KB that the page never uses.
    if ( ! defined( 'LSCWP_V' ) ) {
        $theme_ver = filemtime( get_stylesheet_directory() . '/style.css' );
        echo '<link rel="preload" href="' . esc_url( get_stylesheet_uri() . '?ver=' . $theme_ver ) . '" as="style">' . "\n";
    }
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
            background: #FAF7F4;
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
            background: #F5EFE8;
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

        /* ── JS-toggled state classes (cache-optimizer insurance) ──────────
           These classes only appear via JavaScript, so LiteSpeed UCSS purges
           them from the optimized stylesheet (the root cause of the blank-
           page bug). Inlined here they survive any CSS optimizer. Values
           mirror style.css exactly — keep both in sync. */
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0) translateZ(0);
            will-change: auto;
        }

        img[loading="lazy"].is-loaded {
            opacity: 1;
        }

        .site-header.is-scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 2px 40px rgba(0, 0, 0, 0.08);
        }

        .site-header.is-scrolled::after {
            opacity: 1;
        }

        html.has-scroll-lock,
        body.has-scroll-lock {
            overflow: hidden !important;
            overflow-y: hidden !important;
        }

        .mobile-menu.is-open {
            pointer-events: auto;
            visibility: visible;
        }

        .mobile-menu.is-open .mobile-menu__overlay {
            opacity: 1;
        }

        .mobile-menu.is-open .mobile-menu__drawer {
            transform: translateX(0);
        }

        .scroll-top.is-visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .deal-popup.is-open {
            opacity: 1;
            visibility: visible;
        }

        .carousel__slide.is-active {
            opacity: 1;
            transform: translateX(-50%) scale(1) rotateY(0deg);
            filter: blur(0);
            z-index: 5;
            pointer-events: auto;
        }

        .carousel__slide.is-prev {
            opacity: 0.7;
            transform: translateX(calc(-50% - 105%)) scale(0.88) rotateY(-8deg);
            filter: blur(0);
            z-index: 3;
            pointer-events: auto;
        }

        .carousel__slide.is-next {
            opacity: 0.7;
            transform: translateX(calc(-50% + 105%)) scale(0.88) rotateY(8deg);
            filter: blur(0);
            z-index: 3;
            pointer-events: auto;
        }

        .carousel__slide.is-far-prev {
            opacity: 0.25;
            transform: translateX(calc(-50% - 200%)) scale(0.75) rotateY(-15deg);
            filter: blur(2px);
            z-index: 1;
        }

        .carousel__slide.is-far-next {
            opacity: 0.25;
            transform: translateX(calc(-50% + 200%)) scale(0.75) rotateY(15deg);
            filter: blur(2px);
            z-index: 1;
        }

        .carousel__dot.is-active {
            width: 32px;
            background: linear-gradient(135deg, var(--brand), var(--brand-mid));
            box-shadow: 0 2px 8px rgba(var(--brand-rgb), 0.3);
        }

        .cookie-banner {
            display: none !important;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            padding: 1rem;
            background: rgba(var(--ink-rgb), 0.95);
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .cookie-banner.is-visible {
            display: flex !important;
            transform: translateY(0);
        }
    </style>

    <!-- ═══ Tier A: Head Guard (Instant Document Sanitization) ═══════════════
         Prevents cached scroll-locks from freezing the page during HTML parse.
         ═══════════════════════════════════════════════════════════════════ -->
    <script data-no-optimize="1" data-no-defer="1" data-cfasync="false" class="no-defer">
    (function(){
        var doc = document.documentElement;
        if (doc) {
            doc.style.overflow = '';
            doc.style.overflowY = '';
            doc.classList.remove('fouc-guard');
            doc.classList.remove('has-scroll-lock');
        }
        // BFCache / back-forward navigation recovery
        window.addEventListener('pageshow', function(e) {
            var body = document.body;
            if (body) {
                body.classList.remove('is-leaving');
                body.classList.remove('has-scroll-lock');
                body.style.overflow = '';
                body.style.overflowY = '';
            }
            if (doc) {
                doc.classList.remove('has-scroll-lock');
                doc.style.overflow = '';
                doc.style.overflowY = '';
            }
        });
    }());
    </script>

</head>

<body <?php body_class(); ?>>
    <!-- ═══ Tier B: Body Open Guard (Instant Viewport Sanitization) ══════════ -->
    <script data-no-optimize="1" data-no-defer="1" data-cfasync="false" class="no-defer">
    (function(){
        var body = document.body;
        if (body) {
            body.classList.remove('has-scroll-lock');
            body.classList.remove('modal-open');
            body.classList.remove('is-leaving');
            body.style.overflow = '';
            body.style.overflowY = '';
        }
    }());
    </script>

    <?php wp_body_open(); ?>

    <!-- Skip to content (accessibility) -->
    <a class="skip-to-content" href="#main-content">Skip to content</a>

    <!-- HEADER -->
    <header class="site-header" id="site-header" role="banner">
        <div class="site-header__inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="LIVIA Med Spa — Home"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>
                <img src="https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png" alt="LIVIA Med Spa" class="site-logo__img" width="160" height="40" loading="eager" decoding="async">
            </a>

            <nav class="site-header__nav" aria-label="Main navigation">
                <ul class="nav__links">
                    <li class="nav__item<?php if (is_front_page()) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>Home</a>
                    </li>

                    <!-- Services with Mega Menu -->
                    <li class="nav__item nav__item--has-mega<?php if (is_post_type_archive('service') || is_singular('service')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="nav__link">Services <span class="nav__arrow">▾</span></a>
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

                                // One query for ALL services, grouped into category
                                // columns below. (Previously each category ran its own
                                // WP_Query — N+1 queries on every page load.)
                                $menu_services_query = new WP_Query([
                                    'post_type'      => 'service',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'menu_order',
                                    'order'          => 'ASC',
                                    'no_found_rows'  => true,
                                ]);
                                $menu_services = $menu_services_query->posts;

                                // Show ALL services in one flat, un-categorized list,
                                // split into balanced columns to fit the mega-menu grid
                                // (no category grouping or headings).
                                $menu_columns = [];
                                if ($menu_services) {
                                    $per_col = (int) ceil(count($menu_services) / 3);
                                    $menu_columns = array_chunk($menu_services, max(1, $per_col));
                                }

                                foreach ($menu_columns as $column_services) : ?>
                                    <div class="mega-menu__column">
                                        <div class="mega-menu__items">
                                            <?php
                                            // Uniform SVG sparkle icon — replaces the old per-service
                                            // emoji (_service_icon). Emojis added no keyword signal and
                                            // polluted crawlable nav anchor text.
                                            $mega_icon_svg = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>';
                                            foreach ($column_services as $svc) :
                                                $c        = $icon_colors[$color_index % count($icon_colors)];
                                                $color_index++;
                                                $svc_exc  = wp_strip_all_tags(get_the_excerpt($svc));
                                                $svc_dur  = get_post_meta($svc->ID, '_service_duration', true);
                                                $svc_desc = $svc_exc ? wp_trim_words($svc_exc, 6) : ($svc_dur ?: 'Aesthetic treatment');
                                                // If an External Link is set on the service, link out in a
                                                // new tab; otherwise link to the internal service page.
                                                $svc_ext  = get_post_meta($svc->ID, '_service_external_url', true);
                                                $svc_href = $svc_ext ?: get_permalink($svc);
                                                $svc_tgt  = $svc_ext ? ' target="_blank" rel="noopener noreferrer"' : '';
                                            ?>
                                                <a href="<?php echo esc_url($svc_href); ?>" class="mega-menu__item"<?php echo $svc_tgt; ?>>
                                                    <span class="mega-menu__item-icon" style="background:<?php echo esc_attr($c['bg']); ?>;color:<?php echo esc_attr($c['fg']); ?>;"><?php echo $mega_icon_svg; ?></span>
                                                    <span class="mega-menu__item-content">
                                                        <span class="mega-menu__item-title"><?php echo esc_html(get_the_title($svc)); ?></span>
                                                        <span class="mega-menu__item-desc"><?php echo esc_html($svc_desc); ?></span>
                                                    </span>
                                                    <span class="mega-menu__item-arrow">→</span>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Promo Card -->
                                <div class="mega-menu__promo">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ New Client Special</span>
                                        <h3 class="mega-menu__promo-title">$50 Off Your First Visit</h3>
                                        <p class="mega-menu__promo-text">Experience Tampa's most advanced aesthetic treatments with a personalized consultation.</p>
                                    </div>
                                    <a href="#book-now" class="mega-menu__promo-cta">Book Now →</a>
                                </div>
                            </div>
                            <div class="mega-menu__bottom">
                                <div class="mega-menu__bottom-links">
                                    <a href="<?php echo esc_url(home_url('/memberships/')); ?>" class="mega-menu__bottom-link">✦ Memberships</a>
                                    <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="mega-menu__bottom-link">✦ Financing</a>
                                </div>
                                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="mega-menu__bottom-cta">View All Services →</a>
                            </div>
                        </div>
                    </li>

                    <!-- Products with Mega Menu -->
                    <li class="nav__item nav__item--has-mega<?php if (is_page(['products', 'our-products', 'shop']) || is_singular('product')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="nav__link">Products <span class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner mega-menu__inner--compact">
                                <div class="mega-menu__column">
                                    <span class="mega-menu__heading">Our Products</span>
                                    <div class="mega-menu__items">
                                        <?php
                                        $nav_products = new WP_Query([
                                            'post_type'      => 'product',
                                            'posts_per_page' => 8,
                                            'orderby'        => 'menu_order',
                                            'order'          => 'ASC',
                                            'no_found_rows'  => true,
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
                                                $p_url     = get_post_meta(get_the_ID(), '_product_url', true) ?: '#';
                                                $pc        = $p_colors[$pi % count($p_colors)];
                                                $pi++;
                                                $prod_exc  = wp_strip_all_tags(get_the_excerpt());
                                                $prod_desc = $prod_exc ? wp_trim_words($prod_exc, 6) : 'Medical-grade skincare';
                                                ?>
                                                <a href="<?php echo esc_url($p_url); ?>" class="mega-menu__item" target="_blank" rel="noopener noreferrer">
                                                    <span class="mega-menu__item-icon" style="background:<?php echo esc_attr($pc['bg']); ?>;color:<?php echo esc_attr($pc['fg']); ?>;"><svg width="14" height="16" viewBox="0 0 20 32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="7" y="1" width="6" height="4" rx="1"/><path d="M7 5C4.5 7 4 9 4 11"/><path d="M13 5C15.5 7 16 9 16 11"/><rect x="4" y="11" width="12" height="18" rx="3"/><line x1="7" y1="17" x2="13" y2="17"/><line x1="7" y1="21" x2="11" y2="21"/></svg></span>
                                                    <span class="mega-menu__item-content">
                                                        <span class="mega-menu__item-title"><?php the_title(); ?></span>
                                                        <span class="mega-menu__item-desc"><?php echo esc_html($prod_desc); ?></span>
                                                    </span>
                                                    <span class="mega-menu__item-arrow">→</span>
                                                </a>
                                            <?php endwhile;
                                            wp_reset_postdata();
                                        else: ?>
                                            <p class="mega-menu__empty">Products coming soon.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mega-menu__promo mega-menu__promo--compact">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ Curated Collection</span>
                                        <h3 class="mega-menu__promo-title">Medical-Grade Products</h3>
                                        <p class="mega-menu__promo-text">Physician-selected products to complement your treatments and elevate your daily skincare routine.</p>
                                    </div>
                                    <a href="<?php echo esc_url(home_url('/products/')); ?>" class="mega-menu__promo-cta">View All Products →</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- About with Mega Menu -->
                    <li class="nav__item nav__item--has-mega<?php if (is_page(['about', 'team', 'meet-the-team', 'our-team', 'values', 'our-values'])) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav__link">About <span class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner mega-menu__inner--compact">
                                <div class="mega-menu__column">
                                    <span class="mega-menu__heading">About LIVIA</span>
                                    <div class="mega-menu__items">
                                        <a href="<?php echo esc_url(home_url('/team/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon" style="background:rgba(196,122,122,0.12);color:#c47a7a;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">Meet the Team</span>
                                                <span class="mega-menu__item-desc">Board-certified providers</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                        <a href="<?php echo esc_url(home_url('/values/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon" style="background:rgba(143,170,143,0.12);color:#8faa8f;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="2" fill="currentColor" stroke="none"/></svg></span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">Our Mission</span>
                                                <span class="mega-menu__item-desc">Our purpose &amp; core values</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="mega-menu__promo mega-menu__promo--compact">
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

                    <li class="nav__item<?php if (is_page('memberships')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/memberships/')); ?>" class="nav__link">Memberships</a>
                    </li>
                    <li class="nav__item<?php if (is_page('parties')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/parties/')); ?>" class="nav__link">Parties</a>
                    </li>
                    <!-- Payment Plans with Mega Menu (Cherry + CareCredit) -->
                    <li class="nav__item nav__item--has-mega<?php if (is_page(['financing', 'carecredit'])) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="nav__link">Payment Plans <span class="nav__arrow">▾</span></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner mega-menu__inner--compact">
                                <div class="mega-menu__column">
                                    <span class="mega-menu__heading">Financing Options</span>
                                    <div class="mega-menu__items">
                                        <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon" style="background:rgba(172,19,249,0.12);color:#AC13F9;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 6v2m0 8v2"/></svg></span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">Cherry Payment Plans</span>
                                                <span class="mega-menu__item-desc">Instant approval, 0% APR options</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                        <a href="<?php echo esc_url(home_url('/carecredit/')); ?>" class="mega-menu__item">
                                            <span class="mega-menu__item-icon" style="background:rgba(111,163,214,0.12);color:#6fa3d6;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg></span>
                                            <span class="mega-menu__item-content">
                                                <span class="mega-menu__item-title">CareCredit</span>
                                                <span class="mega-menu__item-desc">Prequalify with no credit impact</span>
                                            </span>
                                            <span class="mega-menu__item-arrow">→</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="mega-menu__promo mega-menu__promo--compact">
                                    <div>
                                        <span class="mega-menu__promo-label">✦ Financing Available</span>
                                        <h3 class="mega-menu__promo-title">Beauty Now, Pay Over Time</h3>
                                        <p class="mega-menu__promo-text">Two flexible ways to split any treatment into manageable monthly payments — apply online in minutes.</p>
                                    </div>
                                    <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="mega-menu__promo-cta">Compare Options →</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav__item<?php if (is_page('contact')) echo ' nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav__link">Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="site-header__actions">
                <a href="tel:8132302219" class="site-header__phone" aria-label="Call us at (813) 230-2219">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <span class="site-header__phone-num">(813) 230-2219</span>
                </a>
                <span class="header__divider"></span>
                <a href="#book-now" class="btn btn--primary btn--sm nav__cta-desktop">Book Now</a>
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
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile menu" aria-hidden="true">
        <div class="mobile-menu__overlay" id="mobile-overlay"></div>
        <div class="mobile-menu__drawer">
            <div class="mobile-menu__header">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png" alt="LIVIA Med Spa" class="site-logo__img" width="140" height="75">
                </a>
                <button class="mobile-menu__close" id="mobile-close" aria-label="Close navigation menu">×</button>
            </div>
            <nav class="mobile-menu__nav" aria-label="Mobile navigation">
                <ul class="mobile-menu__links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url(home_url('/products/')); ?>">Products</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/team/')); ?>">Meet the Team</a></li>
                    <li><a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a></li>
                    <li><a href="<?php echo esc_url(home_url('/parties/')); ?>">Parties</a></li>
                    <li><a href="<?php echo esc_url(home_url('/financing/')); ?>">Payment Plans (Cherry)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/carecredit/')); ?>">CareCredit Financing</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                </ul>
            </nav>
            <div class="mobile-menu__footer">
                <a href="#book-now" class="btn btn--primary mobile-menu__book">Book a Consultation</a>
                <a href="tel:8132302219" class="mobile-menu__contact-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    (813) 230-2219
                </a>
                <a href="mailto:<?php echo antispambot('support@liviamedspa.com'); ?>" class="mobile-menu__contact-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                    <?php echo antispambot('support@liviamedspa.com'); ?>
                </a>
            </div>
        </div>
    </div>
