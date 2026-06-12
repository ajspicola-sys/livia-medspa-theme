<?php
/**
 * LIVIA Med Spa — Theme Functions
 * Performance-optimized build
 */

// ── Theme Setup ────────────────────────────────────────────────────
function livia_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // Register nav menus
    register_nav_menus([
        'primary' => 'Primary Navigation',
        'footer'  => 'Footer Navigation',
    ]);
}
add_action('after_setup_theme', 'livia_setup');

// ── SEO: Keyword-rich title tags (fixes "Home - liviamedspa.com" issue) ─────
function livia_seo_title( $title_parts ) {
    if ( is_front_page() ) {
        $title_parts['title']   = 'Med Spa Tampa | LIVIA Medical Spa & Aesthetics';
        unset( $title_parts['tagline'] );
        unset( $title_parts['site'] );
    } elseif ( is_singular('service') ) {
        $title_parts['title'] = get_the_title() . ' in Tampa, FL | LIVIA Med Spa';
        unset( $title_parts['site'] );
    } elseif ( is_singular('product') ) {
        $title_parts['title'] = get_the_title() . ' | Medical-Grade Skincare | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_post_type_archive('service') ) {
        $title_parts['title'] = 'All Treatments | Tampa Med Spa Services | LIVIA';
        unset( $title_parts['site'] );
    } elseif ( is_page('about') ) {
        $title_parts['title'] = 'About LIVIA Med Spa | Angela Spicola, APRN — Tampa, FL';
        unset( $title_parts['site'] );
    } elseif ( is_page('contact') ) {
        $title_parts['title'] = 'Book a Consultation | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page('memberships') ) {
        $title_parts['title'] = 'Beauty Bank Memberships | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page('before-after') ) {
        $title_parts['title'] = 'Before & After Results | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page() ) {
        $title_parts['site'] = 'LIVIA Med Spa Tampa';
    } elseif ( is_home() || is_archive() ) {
        $title_parts['site'] = 'LIVIA Med Spa Tampa';
    } elseif ( is_404() ) {
        $title_parts['title'] = 'Page Not Found | LIVIA Med Spa';
        unset( $title_parts['site'] );
    }
    return $title_parts;
}
add_filter( 'document_title_parts', 'livia_seo_title', 20 );

// ── SEO: Favicon fallback (if no WP site icon is set) ───────────────────────
function livia_favicon_fallback() {
    // wp_site_icon() handles favicon if set via WP Customizer.
    // This adds a PNG fallback pointing to the brand logo for browsers
    // that don't receive a site icon from WordPress.
    if ( ! has_site_icon() ) {
        $logo_url = 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png';
        echo '<link rel="icon" type="image/png" href="' . esc_url( $logo_url ) . '">' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url( $logo_url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'livia_favicon_fallback', 2 );

// NOTE: A separate "voice search" LocalBusiness + FAQPage schema used to be
// output here. It duplicated livia_schema_markup() with conflicting geo
// coordinates and added a second FAQPage (Google allows only one per page),
// so it was removed. All business data lives in livia_schema_markup() below.

// ── Article Schema — blog posts only ─────────────────────────────────────────
// Signals authorship + publish date to Google. Uses only safe WP functions.
// No content parsing — zero risk of errors.
function livia_article_schema() {
    if ( ! is_singular( 'post' ) ) return;

    $id       = get_the_ID();
    if ( ! $id ) return;

    $thumb = get_the_post_thumbnail_url( $id, 'large' );
    if ( ! $thumb ) {
        $thumb = 'https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png';
    }

    $data = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        'headline'         => get_the_title( $id ),
        'image'            => $thumb,
        'datePublished'    => get_the_date( 'c', $id ),
        'dateModified'     => get_the_modified_date( 'c', $id ),
        'url'              => get_permalink( $id ),
        'inLanguage'       => 'en-US',
        'author'           => array(
            '@type'    => 'Person',
            'name'     => 'Angela Spicola',
            'jobTitle' => 'APRN, Founder & Lead Aesthetic Provider',
            'url'      => 'https://liviamedspa.com/about/',
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => 'LIVIA Med Spa',
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            ),
        ),
        'mainEntityOfPage' => get_permalink( $id ),
    );

    echo '<script type="application/ld+json">'
        . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}
add_action( 'wp_head', 'livia_article_schema', 6 );

// ── BreadcrumbList Schema — pages, posts, and services ───────────────────────
// Enables "Home > Services > Botox" path display in Google search results.
// Uses only safe WP conditional functions — no content access.
function livia_breadcrumb_schema() {
    if ( is_front_page() || is_home() ) return;
    if ( ! is_singular() && ! is_post_type_archive( 'service' ) ) return;

    $home = array(
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Home',
        'item'     => home_url( '/' ),
    );

    $items = array( $home );

    if ( is_singular( 'service' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Services',
            'item'     => home_url( '/services/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_singular( 'post' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Blog',
            'item'     => home_url( '/blog/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_page() ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_post_type_archive( 'service' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Services',
            'item'     => home_url( '/services/' ),
        );
    }

    if ( count( $items ) < 2 ) return;

    $data = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">'
        . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}
add_action( 'wp_head', 'livia_breadcrumb_schema', 7 );

// ── Analytics: Google Analytics 4 ───────────────────────────────────────────
// TODO: Replace YOUR_GA4_ID with your actual Measurement ID (format: G-XXXXXXXXXX)
// Get it from: analytics.google.com → Admin → Data Streams → your stream → Measurement ID
function livia_ga4_tracking() {
    $ga4_id = get_option( 'livia_ga4_id', '' ); // Set via WP Admin or replace '' with 'G-XXXXXXXXXX'
    if ( empty( $ga4_id ) || is_admin() ) return;
    ?>
    <!-- Google Analytics 4 | LIVIA Med Spa -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4_id ); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo esc_js( $ga4_id ); ?>', {
        page_path: window.location.pathname,
      });
    </script>
    <?php
}
add_action( 'wp_head', 'livia_ga4_tracking', 99 );

// ── Analytics: GA4 ID setting in WP Admin (Settings > General) ──────────────
function livia_register_ga4_setting() {
    register_setting( 'general', 'livia_ga4_id', [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ]);
    add_settings_field(
        'livia_ga4_id',
        'Google Analytics 4 ID',
        function() {
            $val = get_option( 'livia_ga4_id', '' );
            echo '<input type="text" name="livia_ga4_id" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="G-XXXXXXXXXX">';
            echo '<p class="description">Enter your GA4 Measurement ID. Find it in Google Analytics → Admin → Data Streams.</p>';
        },
        'general',
        'default',
        [ 'label_for' => 'livia_ga4_id' ]
    );
}
add_action( 'admin_init', 'livia_register_ga4_setting' );

// ── Performance: Disable WP Emoji Scripts ──────────────────────────
function livia_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', function($plugins) {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
    });
    add_filter('wp_resource_hints', function($urls, $relation_type) {
        if ('dns-prefetch' === $relation_type) {
            $urls = array_filter($urls, function($url) {
                return false === strpos($url, 'https://s.w.org/images/core/emoji/');
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'livia_disable_emojis');

// ── Performance: Remove unnecessary head clutter ───────────────────
function livia_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('after_setup_theme', 'livia_cleanup_head');

// ── Performance: Disable oEmbed ────────────────────────────────────
function livia_disable_oembed() {
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'livia_disable_oembed', 9999);

// ── Legacy 301 Redirects — fixes Ahrefs-flagged 404s ──────────────────────
// Maps old/broken URLs (from previous site version or backlinks) to the
// closest relevant live page. Uses 301 (permanent) so link equity transfers.
function livia_legacy_redirects() {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );

    // Old service-type URLs → Services archive
    $to_services = [
        'iv-therapy-2',
        'service/micorneedling',        // typo slug from old site
        'service/microneedling',
        'service/prp-facial-2',
        'service/neurotoxins',
        'service/botox-2',
        'service/dermal-fillers-2',
        'cellenis-derma-prp',
        'face-prp-near-me-tampa',
    ];

    // Old blog/content URLs → Blog index (or closest service)
    $to_blog = [
        'med-spa-tampa-treatments-that-work',
        'microneedling-recovery-time-guide',
        'benefits-of-botox-treatments-in-tampa',
    ];

    if ( in_array( $path, $to_services, true ) ) {
        wp_redirect( home_url( '/services/' ), 301 );
        exit;
    }

    if ( in_array( $path, $to_blog, true ) ) {
        wp_redirect( home_url( '/blog/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'livia_legacy_redirects', 1 );

// ── Performance: Dequeue block library CSS on frontend ─────────────
function livia_dequeue_block_styles() {
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
}
add_action('wp_enqueue_scripts', 'livia_dequeue_block_styles', 100);

// ── Performance: Remove jQuery from frontend ───────────────────────
function livia_deregister_jquery() {
    if (!is_admin() && !is_customize_preview()) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_deregister_script('jquery-migrate');
    }
}
add_action('wp_enqueue_scripts', 'livia_deregister_jquery', 100);

// ── Force correct page template by slug ────────────────────────────
function livia_force_page_templates($template) {
    if (is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
        $map = [
            'team'         => 'page-team.php',
            'about'        => 'page-about.php',
            'contact'      => 'page-contact.php',
            'memberships'  => 'page-memberships.php',
            'parties'      => 'page-parties.php',
            'products'     => 'page-products.php',
            'shop'         => 'page-products.php',
            'values'       => 'page-values.php',
            'before-after' => 'page-before-after.php',
            'financing'    => 'page-financing.php',
            'privacy-policy'      => 'page-privacy-policy.php',
            'cancellation-policy' => 'page-cancellation-policy.php',
            'refund-policy'       => 'page-refund-policy.php',
            'beauty-bank'         => 'page-beauty-bank.php',
        ];
        if (isset($map[$slug])) {
            $custom = get_template_directory() . '/' . $map[$slug];
            if (file_exists($custom)) {
                return $custom;
            }
        }
    }
    return $template;
}
add_filter('template_include', 'livia_force_page_templates');

// ── Enqueue Assets ─────────────────────────────────────────────────
function livia_enqueue_styles() {
    // Use file modification time so browser caches CSS between visits
    // but auto-busts cache when the file actually changes
    $theme_version = filemtime(get_stylesheet_directory() . '/style.css');

    // Google Fonts — single optimized request with display=swap
    wp_enqueue_style(
        'livia-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // Main stylesheet — cacheable, busts only when file changes
    wp_enqueue_style('livia-style', get_stylesheet_uri(), ['livia-google-fonts'], $theme_version);
}
add_action('wp_enqueue_scripts', 'livia_enqueue_styles');

// ── Performance: Stylesheet loading — FOUC reveal + async Google Fonts ──
// Main stylesheet: render-blocking (prevents FOUC) + fires __liviaReveal
//   onload so the FOUC guard class is removed the instant CSS is applied,
//   regardless of how caching plugins rewrote the URL.
// Google Fonts: deferred (media=print swap) — safe because system fonts
//   render as fallback while the web fonts load.
function livia_async_styles($html, $handle) {
    if ( is_admin() ) return $html;

    // ── Google Fonts: non-render-blocking (media swap) ────────────────────
    if ( $handle === 'livia-google-fonts' ) {
        $html = str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $html);
        $html = str_replace('media="all"', "media=\"print\" onload=\"this.media='all'\"", $html);
        $noscript = '<noscript>' . str_replace(
            ["media='print'", 'media="print"', " onload=\"this.media='all'\""],
            ["media='all'",  'media="all"',  ''],
            $html
        ) . '</noscript>';
        $html .= $noscript;
    }

    return $html;
}
add_filter('style_loader_tag', 'livia_async_styles', 10, 2);


// ── Performance: Preload critical fonts only (preconnects live in header.php) ──
function livia_resource_hints() {
    // DNS prefetch for external image CDN
    echo '<link rel="dns-prefetch" href="//liviamedspa.com">' . "\n";
}
add_action('wp_head', 'livia_resource_hints', 1);

// ── Performance: External image proxy & WebP cache ─────────────────
// Fetches third-party images, resizes to
// max 800px wide, converts to WebP, and caches in wp-uploads.
// Subsequent requests serve the local WebP — eliminates 9+ MB of PNG downloads.
function livia_cached_image_url( $src_url, $max_w = 800 ) {
    $upload   = wp_upload_dir();
    $cache_dir = $upload['basedir'] . '/livia-img-cache';
    $cache_url = $upload['baseurl'] . '/livia-img-cache';
    $filename  = md5( $src_url ) . '.webp';
    $file_path = $cache_dir . '/' . $filename;
    $file_url  = $cache_url . '/' . $filename;

    // Serve from cache if already downloaded
    if ( file_exists( $file_path ) ) {
        return $file_url;
    }

    // Create cache directory if needed
    if ( ! file_exists( $cache_dir ) ) {
        wp_mkdir_p( $cache_dir );
        // Prevent direct browsing
        file_put_contents( $cache_dir . '/.htaccess', "Options -Indexes\n" );
    }

    // Fetch the remote image
    $response = wp_remote_get( $src_url, [
        'timeout'   => 30,
        'sslverify' => false,
        'headers'   => [ 'User-Agent' => 'Mozilla/5.0 (compatible; LIVIAMedSpa/1.0)' ],
    ] );

    if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
        return $src_url; // Fallback to original
    }

    $body = wp_remote_retrieve_body( $response );
    if ( empty( $body ) ) {
        return $src_url;
    }

    // Decode image with GD
    $img = @imagecreatefromstring( $body );
    if ( ! $img ) {
        return $src_url; // GD can't read it, fall back
    }

    // Resize if wider than $max_w
    $orig_w = imagesx( $img );
    $orig_h = imagesy( $img );
    if ( $orig_w > $max_w ) {
        $new_h   = (int) round( ( $max_w / $orig_w ) * $orig_h );
        $resized = imagecreatetruecolor( $max_w, $new_h );
        // Preserve transparency (PNGs)
        imagealphablending( $resized, false );
        imagesavealpha( $resized, true );
        imagecopyresampled( $resized, $img, 0, 0, 0, 0, $max_w, $new_h, $orig_w, $orig_h );
        imagedestroy( $img );
        $img = $resized;
    }

    // Save as WebP (quality 82 — good balance of size vs. quality)
    if ( function_exists( 'imagewebp' ) ) {
        imagewebp( $img, $file_path, 82 );
    } else {
        // Fallback: save as JPEG if WebP not available
        $file_path = str_replace( '.webp', '.jpg', $file_path );
        $file_url  = str_replace( '.webp', '.jpg', $file_url );
        imagejpeg( $img, $file_path, 82 );
    }
    imagedestroy( $img );

    return file_exists( $file_path ) ? $file_url : $src_url;
}

// ── Performance: Add async/defer to non-critical scripts ───────────
function livia_script_loader_tag($tag, $handle) {
    // Defer non-critical scripts
    $defer_scripts = ['wp-embed'];
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'livia_script_loader_tag', 10, 2);

// NOTE: Version query strings (ver=) are kept intentionally for cache busting.
// They ensure the browser loads the latest CSS when the theme is updated.

// ── Performance: Limit post revisions ──────────────────────────────
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

// ============================================================
// AI SEARCH VISIBILITY & STRUCTURED DATA — LIVIA MED SPA
// Comprehensive JSON-LD schema for Google AI Overviews,
// ChatGPT, Perplexity, Bing Copilot, and all AEO signals.
// ============================================================

// ── 1. MedicalBusiness + WebSite + Person (Angela) ── every page ─────────────
function livia_schema_markup() {

    // Named provider: Angela Spicola APRN
    $provider = [
        '@type'       => 'Person',
        '@id'         => esc_url(home_url('/')) . '#angela-spicola',
        'name'        => 'Angela Spicola',
        'jobTitle'    => 'Founder & Lead Aesthetic Provider',
        'honorificPrefix' => 'APRN',
        'description' => 'Board-certified Advanced Practice Registered Nurse and founder of LIVIA Med Spa in Tampa, FL. Specializes in Botox, dermal fillers, laser treatments, and medical aesthetics.',
        'worksFor'    => [ '@type' => 'MedicalBusiness', 'name' => 'LIVIA Med Spa' ],
        'sameAs'      => [ 'https://www.instagram.com/liviamedspa/' ],
    ];

    // Full MedicalBusiness entity
    $business = [
        '@context'         => 'https://schema.org',
        '@type'            => ['MedicalBusiness', 'MedSpa', 'LocalBusiness'],
        '@id'              => esc_url(home_url('/')) . '#livia-med-spa',
        'name'             => 'LIVIA Med Spa',
        'legalName'        => 'Livia Med Spa LLC',
        'alternateName'    => 'Livia Medical Spa',
        'description'      => "Tampa's premier medical spa offering Botox, dermal fillers, RF microneedling, laser treatments, facials, IV therapy, and medical-grade skincare. Led by Angela Spicola, APRN — board-certified aesthetic provider.",
        'url'              => esc_url(home_url('/')),
        'telephone'        => '+18132302219',
        'email'            => 'support@liviamedspa.com',
        'foundingDate'     => '2024',
        'address'          => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '10043 N Dale Mabry Hwy',
            'addressLocality' => 'Tampa',
            'addressRegion'   => 'FL',
            'postalCode'      => '33618',
            'addressCountry'  => 'US',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 28.0678,
            'longitude' => -82.5054,
        ],
        'hasMap'           => 'https://maps.google.com/?q=10043+N+Dale+Mabry+Hwy+Tampa+FL+33618',
        'openingHoursSpecification' => [
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday'], 'opens' => '09:00', 'closes' => '19:00' ],
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Thursday','Friday','Saturday'],  'opens' => '09:00', 'closes' => '16:00' ],
        ],
        'priceRange'       => '$$-$$$',
        'currenciesAccepted' => 'USD',
        'paymentAccepted'  => 'Cash, Credit Card, Financing via Cherry',
        'image'            => [
            'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            'https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png',
        ],
        'logo'             => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
        'sameAs'           => [
            'https://www.facebook.com/p/Livia-Med-Spa-61561610168278/',
            'https://www.instagram.com/liviamedspa/',
            'https://www.google.com/maps/place/LIVIA+Med+Spa',
        ],
        'aggregateRating'  => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'bestRating'  => '5',
            'worstRating' => '1',
            'reviewCount' => '75', // Keep in sync with the "75+ reviews" claims in page content
        ],
        'employee'         => [ $provider ],
        'founder'          => $provider,
        'medicalSpecialty' => 'Dermatology',
        'availableService' => [
            [ '@type' => 'MedicalTherapy', 'name' => 'Botox & Neuromodulators', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Dermal Fillers',         'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'RF Microneedling',       'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Laser Skin Resurfacing', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Medical-Grade Facials',  'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'IV Therapy',             'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Kybella',                'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Helix CO2 Laser',       'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'MedicalTherapy', 'name' => 'Weight Loss Programs',   'url' => esc_url(home_url('/services/')) ],
        ],
        'areaServed'       => [
            [ '@type' => 'City', 'name' => 'Tampa',       'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Carrollwood', 'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Westchase',   'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Lutz',        'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Odessa',      'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Land O Lakes', 'containedIn' => 'Florida' ],
        ],
        'hasOfferCatalog'  => [
            '@type' => 'OfferCatalog',
            'name'  => 'LIVIA Med Spa Services',
            'url'   => esc_url(home_url('/services/')),
        ],
        'makesOffer' => [
            [
                '@type'       => 'Offer',
                'name'        => 'Free Consultation',
                'description' => 'Complimentary aesthetic consultation with our board-certified provider.',
                'price'       => '0',
                'priceCurrency' => 'USD',
                'url'         => esc_url(home_url('/contact/')),
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($business, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";

    // WebSite schema with SiteLinksSearchBox signal
    $website = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => esc_url(home_url('/')) . '#website',
        'name'            => 'LIVIA Med Spa',
        'url'             => esc_url(home_url('/')),
        'description'     => "Tampa's premier medical spa — Botox, fillers, laser treatments, RF microneedling, and medical-grade skincare.",
        'inLanguage'      => 'en-US',
        'publisher'       => [ '@id' => esc_url(home_url('/')) . '#livia-med-spa' ],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => esc_url(home_url('/')) . '?s={search_term_string}' ],
            'query-input' => 'required name=search_term_string',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // ── Enhanced Service schema — singular service pages only ─────────────────
    if (is_singular('service')) {
        $post_id   = get_the_ID();
        $price     = get_post_meta($post_id, '_service_price', true);
        $duration  = get_post_meta($post_id, '_service_duration', true);
        $cats      = get_the_terms($post_id, 'service_category');
        $cat_name  = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Aesthetic Treatment';
        $excerpt   = wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' treatment at LIVIA Med Spa in Tampa, FL.');

        $service_schema = [
            '@context'    => 'https://schema.org',
            '@type'       => ['Service', 'MedicalProcedure'],
            '@id'         => get_permalink($post_id) . '#service',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' treatment at LIVIA Med Spa in Tampa, FL.'),
            'provider'    => [
                '@type' => 'MedicalBusiness',
                'name'  => 'LIVIA Med Spa',
            ],
            'areaServed'  => 'Tampa, FL',
            'url'         => get_permalink($post_id),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'livia_schema_markup', 5);

// ── Auto-create All Pages ──────────────────────────────────────────
function livia_create_pages() {
    if (get_option('livia_pages_created_v5')) return;

    $pages = [
        'Home'           => '',
        'About'          => '',
        'Team'           => '',
        'Values'         => '',
        'Contact'        => '',
        'Before After'   => '',
        'Careers'        => '',
        'Parties'        => '',
        'Memberships'    => '',
        'Blog'           => '',
        'Financing'      => '',
    ];

    foreach ($pages as $title => $content) {
        // Skip if page already exists
        $existing = get_page_by_title($title, OBJECT, 'page');
        if ($existing) continue;

        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);

        // Set Home as static front page
        if ($title === 'Home' && $page_id && !is_wp_error($page_id)) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $page_id);
        }

        // Set Blog as posts page
        if ($title === 'Blog' && $page_id && !is_wp_error($page_id)) {
            update_option('page_for_posts', $page_id);
        }
    }

    update_option('livia_pages_created_v5', true);
}
add_action('after_switch_theme', 'livia_create_pages');

// ── Fix Reading Settings (one-time) ───────────────────────────────
function livia_fix_reading_settings() {
    if (get_option('livia_reading_fixed_v2')) return;

    // Find the Blog page and set it as posts page
    $blog_page = get_page_by_title('Blog', OBJECT, 'page');
    if ($blog_page) {
        update_option('show_on_front', 'page');
        update_option('page_for_posts', $blog_page->ID);
    }

    // Find the Home page and set it as front page
    $home_page = get_page_by_title('Home', OBJECT, 'page');
    if ($home_page) {
        update_option('page_on_front', $home_page->ID);
    }

    // Auto-create Financing page if it doesn't exist
    $financing = get_page_by_title('Financing', OBJECT, 'page');
    if (!$financing) {
        wp_insert_post([
            'post_title'  => 'Financing',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]);
    }

    update_option('livia_reading_fixed_v2', true);
}
add_action('init', 'livia_fix_reading_settings');

// ── Shared helper: check if a page with a given slug exists (any status) ──
function livia_page_slug_exists( $slug ) {
    $q = new WP_Query([
        'post_type'              => 'page',
        'name'                   => $slug,
        'post_status'            => 'any',
        'posts_per_page'         => 1,
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ]);
    return $q->have_posts();
}

// ── Auto-create Privacy Policy page ───────────────────────────────────
function livia_create_privacy_page() {
    if ( get_option('livia_privacy_page_created_v2') ) return; // v2: force re-check for missing page
    if ( ! livia_page_slug_exists('privacy-policy') ) {
        wp_insert_post([
            'post_title'   => 'Privacy Policy',
            'post_name'    => 'privacy-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_privacy_page_created_v2', true);
}
add_action('init', 'livia_create_privacy_page');

// ── Auto-create Cancellation Policy page ──────────────────────────────
function livia_create_cancellation_page() {
    if ( get_option('livia_cancellation_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('cancellation-policy') ) {
        wp_insert_post([
            'post_title'   => 'Cancellation Policy',
            'post_name'    => 'cancellation-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_cancellation_page_created_v1', true);
}
add_action('init', 'livia_create_cancellation_page');

// ── Auto-create Refund Policy page ────────────────────────────────────
function livia_create_refund_page() {
    if ( get_option('livia_refund_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('refund-policy') ) {
        wp_insert_post([
            'post_title'   => 'Refund Policy',
            'post_name'    => 'refund-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_refund_page_created_v1', true);
}
add_action('init', 'livia_create_refund_page');

// ── Auto-create Beauty Bank page ──────────────────────────────────────
function livia_create_beauty_bank_page() {
    if ( get_option('livia_beauty_bank_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('beauty-bank') ) {
        wp_insert_post([
            'post_title'   => 'Beauty Bank Membership',
            'post_name'    => 'beauty-bank',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_beauty_bank_page_created_v1', true);
}
add_action('init', 'livia_create_beauty_bank_page');

// ── Auto-create Starter Blog Posts ─────────────────────────────────
function livia_create_blog_posts() {
    if (get_option('livia_blog_created_v1')) return;

    // Create blog categories
    $categories = ['Skincare', 'Injectables', 'Wellness', 'Treatments', 'Beauty Tips'];
    $cat_ids = [];
    foreach ($categories as $cat) {
        $existing = term_exists($cat, 'category');
        if ($existing) {
            $cat_ids[$cat] = $existing['term_id'];
        } else {
            $term = wp_insert_term($cat, 'category');
            if (!is_wp_error($term)) {
                $cat_ids[$cat] = $term['term_id'];
            }
        }
    }

    $posts = [
        [
            'title'    => 'Botox vs. Fillers: Which Is Right for You?',
            'category' => 'Injectables',
            'excerpt'  => 'Understanding the difference between neuromodulators and dermal fillers is key to choosing the right treatment for your aesthetic goals.',
            'content'  => '<h2>Understanding the Difference</h2>
<p>One of the most common questions we hear at LIVIA Med Spa is: "Should I get Botox or fillers?" While both are injectable treatments that can help you look younger, they work in fundamentally different ways.</p>

<h3>Botox: The Wrinkle Relaxer</h3>
<p>Botox (and similar neuromodulators like Dysport and Jeuveau) works by temporarily relaxing the muscles that cause dynamic wrinkles — think forehead lines, crow\'s feet, and frown lines between the brows. It\'s ideal for wrinkles that appear when you make facial expressions.</p>

<h3>Dermal Fillers: The Volume Restorer</h3>
<p>Fillers, on the other hand, work by adding volume beneath the skin\'s surface. They\'re perfect for plumping lips, restoring lost cheek volume, smoothing nasolabial folds, and enhancing facial contours. Popular brands include Juvéderm and Restylane.</p>

<h3>Which Should You Choose?</h3>
<p>The answer depends on your specific concerns. Many of our clients at LIVIA Med Spa benefit from a combination of both treatments — what we call a "liquid facelift." During your complimentary consultation, our expert injectors will create a customized treatment plan tailored to your unique facial anatomy and goals.</p>

<p><strong>Ready to find out which treatment is right for you?</strong> Book a free consultation at LIVIA Med Spa today.</p>',
        ],
        [
            'title'    => 'The Ultimate Guide to Medical-Grade Skincare',
            'category' => 'Skincare',
            'excerpt'  => 'Why medical-grade products outperform drugstore brands and how to build a results-driven skincare routine.',
            'content'  => '<h2>Why Medical-Grade Matters</h2>
<p>Not all skincare is created equal. While drugstore products can provide basic hydration and sun protection, medical-grade skincare is formulated with higher concentrations of active ingredients that penetrate deeper into the skin for visible, lasting results.</p>

<h3>Key Differences</h3>
<p>Medical-grade products, like those from ZO Skin Health (which we carry at LIVIA Med Spa), are backed by clinical research and contain pharmaceutical-grade ingredients. They\'re designed to target specific skin concerns at the cellular level — something over-the-counter products simply can\'t match.</p>

<h3>Building Your Routine</h3>
<p>A solid medical-grade skincare routine includes four essential steps:</p>
<ul>
<li><strong>Cleanser</strong> — Remove impurities without stripping your skin</li>
<li><strong>Active Treatment</strong> — Target specific concerns (retinol, vitamin C, etc.)</li>
<li><strong>Moisturizer</strong> — Lock in hydration and protect the skin barrier</li>
<li><strong>Sunscreen</strong> — The single most important anti-aging product you can use</li>
</ul>

<p>Our providers at LIVIA Med Spa can analyze your skin and recommend the exact products you need. No guesswork, no wasted money on products that don\'t work.</p>',
        ],
        [
            'title'    => 'What to Expect at Your First Med Spa Visit',
            'category' => 'Treatments',
            'excerpt'  => 'A complete walkthrough of your consultation, treatment, and aftercare at LIVIA Med Spa — so you know exactly what to expect.',
            'content'  => '<h2>Your First Visit, Demystified</h2>
<p>If you\'ve never been to a med spa before, it\'s completely normal to feel a mix of excitement and nervousness. At LIVIA Med Spa, we\'ve designed every step of the experience to make you feel comfortable, informed, and cared for.</p>

<h3>Step 1: The Consultation</h3>
<p>Every journey starts with a free, no-pressure consultation. You\'ll meet with one of our expert providers to discuss your goals, concerns, and medical history. We\'ll examine your skin and recommend treatments that align with your budget and expectations.</p>

<h3>Step 2: Your Treatment</h3>
<p>On treatment day, you\'ll be welcomed into our luxury treatment suite. Depending on the procedure, the process can take anywhere from 15 minutes (for Botox) to 60 minutes (for a Glo2Facial or microneedling). Most treatments are minimally invasive with little to no downtime.</p>

<h3>Step 3: Aftercare</h3>
<p>We\'ll provide clear aftercare instructions and schedule any follow-up appointments. Our team is always available by phone or text if you have questions during your recovery.</p>

<p><strong>Ready to take the first step?</strong> Book your complimentary consultation at LIVIA Med Spa today.</p>',
        ],
        [
            'title'    => '5 Anti-Aging Treatments That Actually Work',
            'category' => 'Beauty Tips',
            'excerpt'  => 'Cut through the noise — these are the five proven anti-aging treatments our providers recommend most.',
            'content'  => '<h2>Evidence-Based Anti-Aging</h2>
<p>The beauty industry is full of promises, but only a handful of treatments deliver scientifically proven results. Here are the five anti-aging treatments we recommend most at LIVIA Med Spa.</p>

<h3>1. Botox & Neuromodulators</h3>
<p>The gold standard for preventing and treating dynamic wrinkles. Regular treatments can actually slow the formation of new lines over time.</p>

<h3>2. Microneedling with PRP</h3>
<p>By creating micro-injuries in the skin and applying platelet-rich plasma, this treatment stimulates your body\'s natural collagen production for firmer, more youthful skin.</p>

<h3>3. Chemical Peels</h3>
<p>Medical-grade peels remove damaged outer layers to reveal fresh, even-toned skin underneath. They\'re excellent for hyperpigmentation, fine lines, and overall texture improvement.</p>

<h3>4. Laser Skin Resurfacing</h3>
<p>Our Helix CO2 laser delivers dramatic results for deep wrinkles, scars, and sun damage by stimulating new collagen growth at the deepest layers of skin.</p>

<h3>5. Medical-Grade Retinol</h3>
<p>Prescription-strength retinol is the most well-researched anti-aging ingredient in skincare. It accelerates cell turnover, boosts collagen, and fades discoloration.</p>

<p><strong>Want a personalized anti-aging plan?</strong> Our experts will create a custom treatment roadmap during your free consultation.</p>',
        ],
        [
            'title'    => 'The Benefits of IV Therapy for Skin Health',
            'category' => 'Wellness',
            'excerpt'  => 'Discover how IV vitamin infusions can transform your skin from the inside out — boosting hydration, glow, and cellular repair.',
            'content'  => '<h2>Beauty From the Inside Out</h2>
<p>While topical treatments and procedures work on the surface, true skin health starts from within. That\'s where IV therapy comes in — delivering essential vitamins, minerals, and antioxidants directly to your bloodstream for maximum absorption.</p>

<h3>How IV Therapy Helps Your Skin</h3>
<p>Our custom IV drips at LIVIA Med Spa are formulated with skin-boosting nutrients including:</p>
<ul>
<li><strong>Vitamin C</strong> — A powerful antioxidant that brightens skin and supports collagen production</li>
<li><strong>Glutathione</strong> — The "master antioxidant" that detoxifies and promotes an even, luminous complexion</li>
<li><strong>B-Complex Vitamins</strong> — Essential for cellular repair and energy production</li>
<li><strong>Zinc</strong> — Supports skin healing and reduces inflammation</li>
</ul>

<h3>Beyond Skin Benefits</h3>
<p>IV therapy also boosts energy, strengthens immunity, and helps with recovery after intense workouts or travel. Many of our clients schedule regular drips as part of their overall wellness routine.</p>

<p><strong>Try it yourself.</strong> Book an IV therapy session at LIVIA Med Spa and feel the difference within hours.</p>',
        ],
        [
            'title'    => 'Glo2Facial: Why Tampa\'s It-Girls Are Obsessed',
            'category' => 'Treatments',
            'excerpt'  => 'The Glo2Facial is the hottest facial treatment in Tampa right now — here\'s why everyone is booking one.',
            'content'  => '<h2>The Facial That Changed Everything</h2>
<p>If you\'ve been on Instagram lately, you\'ve probably seen the Glo2Facial everywhere. This innovative three-in-one treatment has taken Tampa by storm — and for good reason.</p>

<h3>What Makes It Special?</h3>
<p>Unlike traditional facials, the Glo2Facial uses a proprietary OxyPods technology that triggers a natural oxygenation process from within your skin. This means nutrients are absorbed more effectively, leading to better, longer-lasting results.</p>

<h3>The Three-Step Process</h3>
<ol>
<li><strong>Exfoliate</strong> — Gentle resurfacing removes dead skin cells and prepares the skin</li>
<li><strong>Oxygenate</strong> — The OxyPods reaction floods skin with oxygen from within</li>
<li><strong>Infuse</strong> — Nutrient-rich serums are pushed deeper into the skin for maximum absorption</li>
</ol>

<h3>Why We Love It</h3>
<p>The Glo2Facial delivers instant, visible results with absolutely zero downtime. You can literally get one on your lunch break and return to work glowing. It\'s safe for all skin types and can be customized for specific concerns like hydration, brightening, or anti-aging.</p>

<p><strong>Want that Tampa glow?</strong> Book your Glo2Facial at LIVIA Med Spa — or host a Glo2Facial Party with your friends!</p>',
        ],
    ];

    foreach ($posts as $post_data) {
        $existing = get_page_by_title($post_data['title'], OBJECT, 'post');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_title'   => $post_data['title'],
            'post_excerpt' => $post_data['excerpt'],
            'post_content' => $post_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days')),
        ]);

        if ($post_id && !is_wp_error($post_id) && isset($cat_ids[$post_data['category']])) {
            wp_set_post_categories($post_id, [$cat_ids[$post_data['category']]]);
        }
    }

    update_option('livia_blog_created_v1', true);
}
add_action('after_switch_theme', 'livia_create_blog_posts');
add_action('init', 'livia_create_blog_posts');

// ── Auto-create All Services ───────────────────────────────────────
function livia_create_services() {
    if (get_option('livia_services_created_v2')) return;

    // 3 broad categories that fit the mega menu grid perfectly
    $categories = [
        'Injectables'       => 'Premium injectable treatments including Botox, fillers, and neuromodulators for facial rejuvenation.',
        'Skin & Facials'    => 'Advanced skin treatments from chemical peels and microneedling to laser resurfacing and facials.',
        'Body & Wellness'   => 'Body contouring, hair restoration, IV therapy, and wellness treatments for total transformation.',
    ];

    $cat_ids = [];
    foreach ($categories as $name => $desc) {
        $existing = term_exists($name, 'service_category');
        if ($existing) {
            $cat_ids[$name] = $existing['term_id'];
        } else {
            $term = wp_insert_term($name, 'service_category', ['description' => $desc]);
            if (!is_wp_error($term)) {
                $cat_ids[$name] = $term['term_id'];
            }
        }
    }

    // Define all 18 services across 3 categories
    $services = [
        // ── Injectables (3 services) ──────────────────────────────
        [
            'title'    => 'Botox',
            'icon'     => '💉',
            'category' => 'Injectables',
            'excerpt'  => 'Smooth away fine lines and wrinkles with the world\'s most trusted neuromodulator, expertly administered for natural-looking results.',
        ],
        [
            'title'    => 'Jeuveau',
            'icon'     => '✨',
            'category' => 'Injectables',
            'excerpt'  => 'The modern alternative to Botox — Jeuveau delivers smooth, wrinkle-free results with a formula designed specifically for aesthetics.',
        ],
        [
            'title'    => 'Dermal Fillers',
            'icon'     => '💎',
            'category' => 'Injectables',
            'excerpt'  => 'Restore volume, enhance contours, and achieve a refreshed, youthful appearance with premium hyaluronic acid fillers.',
        ],

        // ── Skin & Facials (6 services) ───────────────────────────
        [
            'title'    => 'Chemical Peels',
            'icon'     => '🧴',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Reveal fresh, radiant skin by removing damaged outer layers with customized chemical peel treatments.',
        ],
        [
            'title'    => 'Microneedling',
            'icon'     => '🔬',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Stimulate your skin\'s natural collagen production to improve texture, tone, and firmness with precision microneedling.',
        ],
        [
            'title'    => 'Secret RF Microneedling',
            'icon'     => '⚡',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Combine radiofrequency energy with microneedling for deeper skin tightening and dramatic rejuvenation results.',
        ],
        [
            'title'    => 'PRP Facial',
            'icon'     => '🌟',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Harness your body\'s own growth factors for natural skin renewal, improved texture, and a radiant glow.',
        ],
        [
            'title'    => 'Glo2Facial',
            'icon'     => '✦',
            'category' => 'Skin & Facials',
            'excerpt'  => 'A next-generation facial that combines exfoliation, oxygenation, and infusion for an instant, healthy glow.',
        ],
        [
            'title'    => 'Cellis Derma PRP',
            'icon'     => '🧬',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Advanced PRP therapy combined with cutting-edge Cellis technology for superior skin rejuvenation and healing.',
        ],

        // ── Body & Wellness (9 services) ──────────────────────────
        [
            'title'    => 'Helix CO2 Laser',
            'icon'     => '🔆',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Fractional CO2 laser resurfacing to dramatically reduce scars, wrinkles, and sun damage with precision technology.',
        ],
        [
            'title'    => 'Laser Treatments',
            'icon'     => '💡',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A range of advanced laser therapies for hair removal, skin tightening, pigmentation correction, and more.',
        ],
        [
            'title'    => 'Butt Lift',
            'icon'     => '🍑',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Non-surgical butt enhancement to lift, firm, and sculpt for a naturally contoured silhouette.',
        ],
        [
            'title'    => 'Sclerotherapy',
            'icon'     => '🩺',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Eliminate spider veins and varicose veins with this safe, proven injection-based treatment.',
        ],
        [
            'title'    => 'Weight Loss',
            'icon'     => '⚖️',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Medically supervised weight loss programs tailored to your goals with proven treatments and ongoing support.',
        ],
        [
            'title'    => 'Hair Restoration',
            'icon'     => '💆',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Advanced hair restoration treatments to combat thinning and stimulate natural hair growth for fuller, healthier hair.',
        ],
        [
            'title'    => 'IV Therapy',
            'icon'     => '💧',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Boost hydration, energy, and immunity with custom IV vitamin infusions delivered directly to your bloodstream.',
        ],
        [
            'title'    => 'Vaginal PRP',
            'icon'     => '🌸',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A confidential, non-surgical treatment using platelet-rich plasma to enhance intimate wellness and rejuvenation.',
        ],
        [
            'title'    => 'Penile PRP',
            'icon'     => '🔬',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A discreet, non-surgical PRP treatment designed to improve intimate health, sensitivity, and confidence.',
        ],
    ];

    foreach ($services as $service) {
        // Check if service already exists
        $existing = get_page_by_title($service['title'], OBJECT, 'service');
        if ($existing) {
            // Update category on existing services
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($existing->ID, (int) $cat_ids[$service['category']], 'service_category');
            }
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'   => $service['title'],
            'post_excerpt' => $service['excerpt'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_service_icon', $service['icon']);
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($post_id, (int) $cat_ids[$service['category']], 'service_category');
            }
        }
    }

    update_option('livia_services_created_v2', true);
}
add_action('after_switch_theme', 'livia_create_services');

// ── Services Custom Post Type ──────────────────────────────────────
function livia_register_services() {
    register_post_type('service', [
        'labels' => [
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'add_new'            => 'Add Service',
            'add_new_item'       => 'Add New Service',
            'edit_item'          => 'Edit Service',
            'new_item'           => 'New Service',
            'view_item'          => 'View Service',
            'search_items'       => 'Search Services',
            'not_found'          => 'No services found',
            'menu_name'          => '💆 Services',
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'services'],
        'menu_icon'          => 'dashicons-heart',
        'menu_position'      => 5,
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true,
    ]);

    // Service Categories
    register_taxonomy('service_category', 'service', [
        'labels' => [
            'name'          => 'Service Categories',
            'singular_name' => 'Category',
            'add_new_item'  => 'Add Category',
            'menu_name'     => 'Categories',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'service-category'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'livia_register_services');

// ── Show ALL services on the services archive page ─────────────────
function livia_services_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('service')) {
        $query->set('posts_per_page', 100);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'livia_services_per_page');



// ── Team Member Custom Post Type ───────────────────────────────────
function livia_register_team() {
    register_post_type('team_member', [
        'labels' => [
            'name'               => 'Team Members',
            'singular_name'      => 'Team Member',
            'add_new'            => 'Add Team Member',
            'add_new_item'       => 'Add New Team Member',
            'edit_item'          => 'Edit Team Member',
            'new_item'           => 'New Team Member',
            'view_item'          => 'View Team Member',
            'search_items'       => 'Search Team Members',
            'not_found'          => 'No team members found',
            'menu_name'          => '👩‍⚕️ Team',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-groups',
        'menu_position'      => 6,
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'livia_register_team');

// ── Team Member custom fields (meta box) ───────────────────────────
function livia_team_meta_boxes() {
    add_meta_box(
        'livia_team_details',
        'Team Member Details',
        'livia_team_meta_html',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_team_meta_boxes');

function livia_team_meta_html($post) {
    wp_nonce_field('livia_team_meta', 'livia_team_nonce');
    $role         = get_post_meta($post->ID, '_team_role', true);
    $credentials  = get_post_meta($post->ID, '_team_credentials', true);
    $specialties  = get_post_meta($post->ID, '_team_specialties', true);
    ?>
    <style>
        .livia-team-row { display:flex; gap:1.5rem; margin-bottom:1rem; flex-wrap:wrap; }
        .livia-team-field { flex:1; min-width:250px; }
        .livia-team-field label { display:block; font-weight:600; margin-bottom:4px; }
        .livia-team-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="livia-team-row">
        <div class="livia-team-field">
            <label for="team_role">Role / Title</label>
            <input type="text" id="team_role" name="team_role" value="<?php echo esc_attr($role); ?>" placeholder="Medical Director, MD">
            <p class="description">e.g. "Medical Director, MD" or "Lead Injector, PA-C"</p>
        </div>
    </div>
    <div class="livia-team-row">
        <div class="livia-team-field">
            <label for="team_credentials">Credential Badges</label>
            <input type="text" id="team_credentials" name="team_credentials" value="<?php echo esc_attr($credentials); ?>" placeholder="Board Certified, 12+ Years, AAAM Member">
            <p class="description">Comma-separated badges shown under the name, e.g. "Board Certified, 12+ Years"</p>
        </div>
    </div>
    <div class="livia-team-row">
        <div class="livia-team-field">
            <label for="team_specialties">Specialties</label>
            <input type="text" id="team_specialties" name="team_specialties" value="<?php echo esc_attr($specialties); ?>" placeholder="Botox, Dermal Fillers, PRP Therapy">
            <p class="description">Comma-separated specialties shown as tags, e.g. "Botox, Fillers, PRP"</p>
        </div>
    </div>
    <?php
}

function livia_save_team_meta($post_id) {
    if (!isset($_POST['livia_team_nonce']) || !wp_verify_nonce($_POST['livia_team_nonce'], 'livia_team_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['team_role', 'team_credentials', 'team_specialties'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_team_member', 'livia_save_team_meta');

// ── Product Custom Post Type ───────────────────────────────────────
function livia_register_products() {
    register_post_type('product', [
        'labels' => [
            'name'               => 'Products',
            'singular_name'      => 'Product',
            'add_new'            => 'Add Product',
            'add_new_item'       => 'Add New Product',
            'edit_item'          => 'Edit Product',
            'new_item'           => 'New Product',
            'view_item'          => 'View Product',
            'search_items'       => 'Search Products',
            'not_found'          => 'No products found',
            'menu_name'          => '🛍️ Products',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-cart',
        'menu_position'      => 7,
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'livia_register_products');

// ── Product custom fields (meta box) ───────────────────────────────
function livia_product_meta_boxes() {
    add_meta_box(
        'livia_product_details',
        'Product Details',
        'livia_product_meta_html',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_product_meta_boxes');

function livia_product_meta_html($post) {
    wp_nonce_field('livia_product_meta', 'livia_product_nonce');
    $url      = get_post_meta($post->ID, '_product_url', true);
    $video    = get_post_meta($post->ID, '_product_video_bg', true);
    $price    = get_post_meta($post->ID, '_product_price', true);
    $btn_text = get_post_meta($post->ID, '_product_btn_text', true) ?: 'Shop Now';
    ?>
    <style>
        .livia-product-row { display:flex; gap:1.5rem; margin-bottom:1rem; flex-wrap:wrap; }
        .livia-product-field { flex:1; min-width:250px; }
        .livia-product-field label { display:block; font-weight:600; margin-bottom:4px; }
        .livia-product-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="livia-product-row">
        <div class="livia-product-field">
            <label for="product_url">Product Website URL</label>
            <input type="url" id="product_url" name="product_url" value="<?php echo esc_attr($url); ?>" placeholder="https://www.example.com/product">
            <p class="description">External link where users can buy this product</p>
        </div>
        <div class="livia-product-field">
            <label for="product_btn_text">Button Text</label>
            <input type="text" id="product_btn_text" name="product_btn_text" value="<?php echo esc_attr($btn_text); ?>" placeholder="Shop Now">
            <p class="description">Custom button label (default: "Shop Now")</p>
        </div>
    </div>
    <div class="livia-product-row">
        <div class="livia-product-field">
            <label for="product_price">Price (optional)</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo esc_attr($price); ?>" placeholder="$89">
            <p class="description">Display price or "From $89"</p>
        </div>
        <div class="livia-product-field">
            <label for="product_video_bg">Video Background URL (optional)</label>
            <input type="url" id="product_video_bg" name="product_video_bg" value="<?php echo esc_attr($video); ?>" placeholder="https://example.com/video.mp4">
            <p class="description">MP4 video URL — plays faintly behind the product card. Leave blank for no video.</p>
        </div>
    </div>
    <?php
}

function livia_save_product_meta($post_id) {
    if (!isset($_POST['livia_product_nonce']) || !wp_verify_nonce($_POST['livia_product_nonce'], 'livia_product_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['product_url', 'product_video_bg', 'product_price', 'product_btn_text'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_product', 'livia_save_product_meta');

// ── Flush rewrite rules on theme activation ────────────────────────
function livia_rewrite_flush() {
    livia_register_services();
    livia_register_team();
    livia_register_products();
    livia_register_before_after();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'livia_rewrite_flush');

// ── Performance: Add image optimization defaults ───────────────────
function livia_image_size_defaults() {
    update_option('thumbnail_size_w', 150);
    update_option('thumbnail_size_h', 150);
    update_option('medium_size_w', 480);
    update_option('medium_size_h', 480);
    update_option('large_size_w', 1024);
    update_option('large_size_h', 1024);
}
add_action('after_switch_theme', 'livia_image_size_defaults');

// ── Performance: Add WebP support ──────────────────────────────────
function livia_allow_webp($mimes) {
    $mimes['webp'] = 'image/webp';
    $mimes['avif'] = 'image/avif';
    return $mimes;
}
add_filter('upload_mimes', 'livia_allow_webp');

// ── Security: Disable XML-RPC ──────────────────────────────────────
add_filter('xmlrpc_enabled', '__return_false');

// ── Performance: Reduce heartbeat interval ─────────────────────────
function livia_heartbeat_settings($settings) {
    $settings['interval'] = 60;
    return $settings;
}
add_filter('heartbeat_settings', 'livia_heartbeat_settings');



// ── FAQ Schema for Memberships Page ────────────────────────────────
function livia_faq_schema() {
    if (!is_page('memberships')) return;

    $faqs = [
        ['q' => 'Is there a minimum commitment?', 'a' => 'We ask for a minimum 6-month commitment to get the most out of your Beauty Bank membership. After that, you can continue month-to-month or cancel anytime.'],
        ['q' => 'Do my credits expire?', 'a' => 'No! Your banked credits never expire as long as your membership is active. If you cancel, unused credits remain available for 90 days.'],
        ['q' => 'What can I use my credits on?', 'a' => 'Your Beauty Bank credits can be used on any service or product we offer — Botox, fillers, facials, laser treatments, IV therapy, skincare products, and more.'],
        ['q' => 'Can I share my credits with friends or family?', 'a' => 'Absolutely! You can gift your credits to friends and family members.'],
        ['q' => 'How much should I set as my monthly deposit?', 'a' => 'Most of our members choose between $100-$300/month. During your complimentary consultation, we\'ll help you find the perfect amount.'],
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [],
    ];

    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'livia_faq_schema', 6);

// ── Add security headers ──────────────────────────────────────────
function livia_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'livia_security_headers');

// ── Contact Form: AJAX email handler ───────────────────────────────
function livia_handle_contact_form() {
    // Verify nonce
    if ( ! isset($_POST['livia_contact_nonce']) || ! wp_verify_nonce($_POST['livia_contact_nonce'], 'livia_contact_form') ) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh and try again.']);
    }

    // Sanitize inputs
    $first   = sanitize_text_field($_POST['first_name'] ?? '');
    $last    = sanitize_text_field($_POST['last_name']  ?? '');
    $email   = sanitize_email($_POST['email']           ?? '');
    $phone   = sanitize_text_field($_POST['phone']      ?? '');
    $service = sanitize_text_field($_POST['service']    ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if ( empty($first) || empty($email) || ! is_email($email) ) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // ── Build recipients list (supports multiple, comma-separated) ──
    $recipients_raw = get_option('livia_notification_emails', 'support@liviamedspa.com');
    $recipients = array_filter(array_map('trim', explode(',', $recipients_raw)), 'is_email');
    if ( empty($recipients) ) $recipients = ['support@liviamedspa.com'];
    $to = $recipients;

    $subject = '✨ New Message — LIVIA Med Spa Website';

    // ── Prepare substitution values ─────────────────────────────────
    $service_display = $service ? ucwords(str_replace('-', ' ', $service)) : 'Not specified';
    $phone_display   = $phone ?: 'Not provided';

    // ── Get custom or default template ─────────────────────────────
    $default_template = livia_default_email_template();
    $template = get_option('livia_email_template', '') ?: $default_template;

    // Replace {{placeholders}} with actual values
    $body = str_replace(
        ['{{name}}', '{{first_name}}', '{{last_name}}', '{{email}}', '{{phone}}', '{{service}}', '{{message}}'],
        [
            esc_html($first . ' ' . $last),
            esc_html($first),
            esc_html($last),
            esc_html($email),
            esc_html($phone_display),
            esc_html($service_display),
            nl2br(esc_html($message)),
        ],
        $template
    );


    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: {$first} {$last} <{$email}>",
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Message sent! We\'ll get back to you within 24 hours.']);
    } else {
        wp_send_json_error(['message' => 'Something went wrong. Please call us at (813) 230-2219.']);
    }
}
add_action('wp_ajax_livia_contact_submit',        'livia_handle_contact_form');
add_action('wp_ajax_nopriv_livia_contact_submit', 'livia_handle_contact_form');

// ── Default email template (used when no custom template is saved) ──
function livia_default_email_template() {
    return '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>New Message</title></head>
<body style="margin:0;padding:0;background:#f4f0f8;font-family:\'Helvetica Neue\',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f0f8;padding:40px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;border-radius:16px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,0.12);">
        <tr>
          <td style="background:linear-gradient(135deg,#0f0720 0%,#1a0a35 60%,#2d0d5e 100%);padding:40px 40px 32px;text-align:center;">
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,169,110,0.9);">LIVIA Med Spa</p>
            <h1 style="margin:0;font-size:26px;font-weight:300;color:#f0ebe3;letter-spacing:1px;">New Website Message</h1>
            <div style="width:40px;height:2px;background:linear-gradient(90deg,#AC13F9,#C9A96E);margin:16px auto 0;border-radius:2px;"></div>
          </td>
        </tr>
        <tr>
          <td style="background:#ffffff;padding:40px;">
            <p style="margin:0 0 28px;font-size:15px;color:#555;line-height:1.6;">You have a new inquiry from your website contact form. Reply directly to this email to respond to {{first_name}}.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:0 8px 16px 0;width:50%;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #AC13F9;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Name</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{name}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;width:50%;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #AC13F9;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Email</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;"><a href="mailto:{{email}}" style="color:#AC13F9;text-decoration:none;">{{email}}</a></p>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding:0 8px 16px 0;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Phone</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{phone}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Service Interest</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{service}}</p>
                  </div>
                </td>
              </tr>
            </table>
            <div style="background:#f9f6ff;border-radius:10px;padding:20px 22px;margin-top:4px;border-left:3px solid #AC13F9;">
              <p style="margin:0 0 8px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Message</p>
              <p style="margin:0;font-size:15px;color:#333;line-height:1.7;">{{message}}</p>
            </div>
            <div style="text-align:center;margin-top:32px;">
              <a href="mailto:{{email}}" style="display:inline-block;background:linear-gradient(135deg,#AC13F9,#8a0fd4);color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:50px;font-size:14px;font-weight:600;letter-spacing:0.5px;">Reply to {{first_name}} →</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="background:#0f0720;padding:24px 40px;text-align:center;">
            <p style="margin:0;font-size:11px;color:rgba(240,235,227,0.4);letter-spacing:1px;">LIVIA Med Spa &middot; Tampa, FL &middot; <a href="https://liviamedspa.com" style="color:rgba(172,19,249,0.7);text-decoration:none;">liviamedspa.com</a></p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';
}

// ── LIVIA Settings Page (Admin Dashboard) ──────────────────────────
function livia_settings_page_html() {
    if ( ! current_user_can('manage_options') ) return;

    if ( isset($_POST['livia_settings_nonce']) && wp_verify_nonce($_POST['livia_settings_nonce'], 'livia_save_settings') ) {
        // Multiple emails — stored as comma-separated string
        $emails_raw = sanitize_text_field($_POST['livia_notification_emails'] ?? 'support@liviamedspa.com');
        $emails_clean = implode(', ', array_filter(array_map('sanitize_email', array_map('trim', explode(',', $emails_raw))), 'is_email'));
        update_option('livia_notification_emails', $emails_clean ?: 'support@liviamedspa.com');

        // Email template — allow HTML
        $template = wp_unslash($_POST['livia_email_template'] ?? '');
        update_option('livia_email_template', $template);

        echo '<div class="notice notice-success is-dismissible"><p><strong>✅ Settings saved!</strong></p></div>';
    }

    $current_emails  = get_option('livia_notification_emails', 'support@liviamedspa.com');
    $current_template = get_option('livia_email_template', '') ?: livia_default_email_template();
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
            <span style="font-size:1.4rem;">✨</span> LIVIA Med Spa — Settings
        </h1>

        <form method="post">
            <?php wp_nonce_field('livia_save_settings', 'livia_settings_nonce'); ?>

            <!-- Section: Recipients -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">📬 Notification Recipients</h2>
                <p style="margin:0 0 20px;color:#666;font-size:13px;">Separate multiple email addresses with commas. All recipients receive every submission.</p>
                <label for="livia_notification_emails" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">Email Address(es)</label>
                <input type="text" id="livia_notification_emails" name="livia_notification_emails"
                       value="<?php echo esc_attr($current_emails); ?>"
                       style="width:100%;max-width:600px;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;"
                       placeholder="support@liviamedspa.com, manager@liviamedspa.com">
                <p style="margin:8px 0 0;font-size:12px;color:#888;">Example: <code>support@liviamedspa.com, angie@liviamedspa.com</code></p>
            </div>

            <!-- Section: Email Template -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">🎨 Email Template (HTML)</h2>
                <p style="margin:0 0 16px;color:#666;font-size:13px;">Customize the HTML email that gets sent to your inbox. Use the tags below to insert form data — they'll be replaced automatically.</p>

                <!-- Placeholder Tags Reference -->
                <div style="background:#f9f6ff;border:1px solid #e8d8ff;border-radius:8px;padding:16px 20px;margin-bottom:16px;">
                    <p style="margin:0 0 10px;font-size:12px;font-weight:700;color:#AC13F9;letter-spacing:1px;text-transform:uppercase;">Available Placeholder Tags</p>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        <?php
                        $tags = [
                            '{{name}}'       => 'Full name',
                            '{{first_name}}' => 'First name only',
                            '{{last_name}}'  => 'Last name only',
                            '{{email}}'      => 'Email address',
                            '{{phone}}'      => 'Phone number',
                            '{{service}}'    => 'Service of interest',
                            '{{message}}'    => 'Their message',
                        ];
                        foreach ($tags as $tag => $desc) : ?>
                            <span style="background:#fff;border:1px solid #d8b4ff;border-radius:5px;padding:4px 10px;font-size:12px;cursor:pointer;"
                                  title="<?php echo esc_attr($desc); ?>"
                                  onclick="insertTag('<?php echo esc_js($tag); ?>')"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <p style="margin:10px 0 0;font-size:11px;color:#888;">💡 Click a tag to insert it at your cursor position in the editor below.</p>
                </div>

                <label for="livia_email_template" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">HTML Template</label>
                <textarea id="livia_email_template" name="livia_email_template"
                          rows="24"
                          style="width:100%;font-family:'Courier New',monospace;font-size:12px;line-height:1.6;padding:14px;border:1px solid #ddd;border-radius:6px;resize:vertical;background:#1a1a2e;color:#e8e8f0;"><?php echo esc_textarea($current_template); ?></textarea>
                <p style="margin:8px 0 0;font-size:12px;color:#888;">⚠️ Click "Reset to Default" to restore the original branded template.</p>
            </div>

            <div style="max-width:800px;display:flex;gap:12px;align-items:center;">
                <?php submit_button('Save Settings', 'primary', 'submit', false, ['style' => 'margin:0;']); ?>
                <button type="submit" name="livia_reset_template" value="1"
                        style="background:none;border:1px solid #ddd;border-radius:6px;padding:8px 18px;font-size:13px;cursor:pointer;color:#555;"
                        onclick="if(!confirm('Reset template to default? This cannot be undone.')) return false;">
                    Reset to Default
                </button>
            </div>
        </form>
    </div>

    <script>
    function insertTag(tag) {
        var ta = document.getElementById('livia_email_template');
        if (!ta) return;
        var start = ta.selectionStart, end = ta.selectionEnd;
        ta.value = ta.value.substring(0, start) + tag + ta.value.substring(end);
        ta.selectionStart = ta.selectionEnd = start + tag.length;
        ta.focus();
    }
    </script>
    <?php

    // Handle reset separately
    if ( isset($_POST['livia_reset_template']) && isset($_POST['livia_settings_nonce']) && wp_verify_nonce($_POST['livia_settings_nonce'], 'livia_save_settings') ) {
        update_option('livia_email_template', '');
    }
}

function livia_add_settings_menu() {
    add_options_page(
        'LIVIA Med Spa Settings',
        '✨ LIVIA Settings',
        'manage_options',
        'livia-settings',
        'livia_settings_page_html'
    );
}
add_action('admin_menu', 'livia_add_settings_menu');

// ── Deal Popup — Customizer Controls ───────────────────────────────
// Client manages all popup content from Appearance → Customize → 🎯 Deal Popup
// Zero code required. Changes go live on Save & Publish.
add_action('customize_register', 'livia_popup_customizer');
function livia_popup_customizer($wp_customize) {

    $wp_customize->add_section('livia_popup', [
        'title'       => '🎯 Deal Popup',
        'priority'    => 30,
        'description' => 'Control the promotional popup. Turn it on/off, set the offer text, button, and when it expires. Visitors only see it once every 7 days.',
    ]);

    // Enable toggle
    $wp_customize->add_setting('livia_popup_enabled', ['default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_enabled', [
        'type'        => 'checkbox',
        'section'     => 'livia_popup',
        'label'       => 'Show Popup on Site',
    ]);

    // Badge
    $wp_customize->add_setting('livia_popup_badge', ['default' => '✦ Limited Time Offer', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_badge', [
        'type'        => 'text',
        'section'     => 'livia_popup',
        'label'       => 'Badge Label',
        'description' => 'Small tag above the title. e.g. "✦ New Client Special"',
    ]);

    // Title
    $wp_customize->add_setting('livia_popup_title', ['default' => '$50 Off Your First Visit', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_title', [
        'type'        => 'text',
        'section'     => 'livia_popup',
        'label'       => 'Popup Headline',
    ]);

    // Body text
    $wp_customize->add_setting('livia_popup_text', ['default' => 'Book your complimentary consultation today and receive $50 off any treatment on your first visit.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_text', [
        'type'        => 'textarea',
        'section'     => 'livia_popup',
        'label'       => 'Popup Message',
    ]);

    // Discount code (optional)
    $wp_customize->add_setting('livia_popup_code', ['default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_code', [
        'type'        => 'text',
        'section'     => 'livia_popup',
        'label'       => 'Discount Code (optional)',
        'description' => 'Leave blank if no promo code — the code box won\'t appear.',
    ]);

    // Button text
    $wp_customize->add_setting('livia_popup_btn_text', ['default' => 'Book Now & Save $50', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_btn_text', [
        'type'        => 'text',
        'section'     => 'livia_popup',
        'label'       => 'Button Text',
    ]);

    // Button URL
    $wp_customize->add_setting('livia_popup_btn_url', ['default' => '#book-now', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_btn_url', [
        'type'        => 'url',
        'section'     => 'livia_popup',
        'label'       => 'Button Link',
        'description' => 'Use #book-now to open booking, or paste any URL.',
    ]);

    // Delay
    $wp_customize->add_setting('livia_popup_delay', ['default' => 5, 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_delay', [
        'type'        => 'number',
        'section'     => 'livia_popup',
        'label'       => 'Delay Before Popup (seconds)',
        'description' => '5 seconds is recommended. 0 = immediate.',
        'input_attrs' => ['min' => 0, 'max' => 60, 'step' => 1],
    ]);

    // Expiry date
    $wp_customize->add_setting('livia_popup_expiry', ['default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_expiry', [
        'type'        => 'date',
        'section'     => 'livia_popup',
        'label'       => 'Offer Expiry Date (optional)',
        'description' => 'Popup automatically stops showing after this date. Leave blank = no expiry.',
    ]);

    // Frequency
    $wp_customize->add_setting('livia_popup_frequency', ['default' => 7, 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control('livia_popup_frequency', [
        'type'        => 'number',
        'section'     => 'livia_popup',
        'label'       => 'Show Again After (days)',
        'description' => 'How many days before the same visitor sees it again.',
        'input_attrs' => ['min' => 1, 'max' => 90, 'step' => 1],
    ]);

    // Popup Image (optional — shown above the badge/title)
    $wp_customize->add_setting('livia_popup_image', [
        'default'           => '',
        'sanitize_callback' => 'absint', // stores attachment ID
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'livia_popup_image', [
        'section'     => 'livia_popup',
        'label'       => 'Popup Image (optional)',
        'description' => 'Shows above the headline. Pick from the Media Library or upload a new image. Leave blank to hide.',
        'mime_type'   => 'image',
    ]));
}

// =============================================================================
// LIVIA DEMO CONTENT IMPORTER
// Bundles /demo-content/content.xml and provides a one-click admin importer.
// Fires automatically on theme activation; can also be re-run any time from
// the WP admin notice or directly via: ?livia_run_import=1 (admin only).
// =============================================================================

// -- Flag theme activation so we can show the notice on next page load --------
add_action( 'after_switch_theme', 'livia_importer_set_activation_flag' );
function livia_importer_set_activation_flag() {
    set_transient( 'livia_just_activated', true, 300 );
}

// -- Admin notice with Import button ------------------------------------------
add_action( 'admin_notices', 'livia_importer_admin_notice' );
function livia_importer_admin_notice() {
    // Only show to admins
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Already imported? Never show again.
    if ( get_option( 'livia_demo_imported' ) ) return;

    // Only show right after activation OR when the user revisits the notice
    if ( ! get_transient( 'livia_just_activated' ) && ! isset( $_GET['livia_import_notice'] ) ) return;

    $import_url = wp_nonce_url(
        add_query_arg( 'livia_run_import', '1', admin_url() ),
        'livia_import_nonce'
    );
    $dismiss_url = add_query_arg( 'livia_dismiss_import', '1', admin_url() );

    echo '<div class="notice notice-info" style="padding:1rem 1.25rem;display:flex;align-items:center;gap:1.5rem;">';
    echo '<div>';
    echo '<strong>?? LIVIA Med Spa Theme</strong> � ';
    echo 'Import all services, posts, categories, and custom fields from the bundled demo content?';
    echo '</div>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary" style="white-space:nowrap;">Import Content Now</a>';
    echo '<a href="' . esc_url( add_query_arg( [ 'livia_dismiss_import' => '1', '_wpnonce' => wp_create_nonce('livia_dismiss') ], admin_url() ) ) . '" class="button" style="white-space:nowrap;">Dismiss</a>';
    echo '</div>';
}

// -- Dismiss handler ----------------------------------------------------------
add_action( 'admin_init', 'livia_importer_handle_dismiss' );
function livia_importer_handle_dismiss() {
    if ( ! isset( $_GET['livia_dismiss_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'livia_dismiss' );
    update_option( 'livia_demo_imported', 'dismissed' );
    delete_transient( 'livia_just_activated' );
    wp_safe_redirect( admin_url() );
    exit;
}

// -- Main importer ------------------------------------------------------------
add_action( 'admin_init', 'livia_run_demo_import' );
function livia_run_demo_import() {
    if ( ! isset( $_GET['livia_run_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'livia_import_nonce' );

    $xml_file = get_stylesheet_directory() . '/demo-content/content.xml';
    if ( ! file_exists( $xml_file ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>LIVIA Importer:</strong> demo-content/content.xml not found.</p></div>';
        });
        return;
    }

    // Make sure the WordPress importer is available
    if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
        define( 'WP_LOAD_IMPORTERS', true );
    }

    $importer_file = ABSPATH . 'wp-admin/includes/import.php';
    if ( file_exists( $importer_file ) ) {
        require_once $importer_file;
    }

    // Try to use the WordPress Importer plugin if active
    $wp_importer = WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
    if ( ! class_exists( 'WP_Import' ) && file_exists( $wp_importer ) ) {
        require_once $wp_importer;
    }

    if ( class_exists( 'WP_Import' ) ) {
        // Full import via WordPress Importer plugin
        $importer = new WP_Import();
        $importer->fetch_attachments = true; // pull remote images
        ob_start();
        $importer->import( $xml_file );
        ob_end_clean();

        update_option( 'livia_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'livia_just_activated' );

        wp_safe_redirect( add_query_arg( 'livia_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;

    } else {
        // WordPress Importer plugin not active � fall back to lightweight WXR parser
        livia_lightweight_wxr_import( $xml_file );
        update_option( 'livia_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'livia_just_activated' );
        wp_safe_redirect( add_query_arg( 'livia_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;
    }
}

// -- Lightweight WXR parser (fallback when WordPress Importer plugin is absent)
// Handles: posts, pages, custom post types, taxonomies, postmeta.
// Does NOT handle authors or media re-attachment (use the plugin for that).
function livia_lightweight_wxr_import( $xml_file ) {
    $xml = simplexml_load_file( $xml_file, 'SimpleXMLElement', LIBXML_NOCDATA );
    if ( ! $xml ) return;

    $namespaces = $xml->getNamespaces( true );
    $wp_ns  = isset( $namespaces['wp'] )      ? $namespaces['wp']      : 'http://wordpress.org/export/1.2/';
    $dc_ns  = isset( $namespaces['dc'] )      ? $namespaces['dc']      : 'http://purl.org/dc/elements/1.1/';
    $ex_ns  = isset( $namespaces['excerpt'] ) ? $namespaces['excerpt'] : 'http://wordpress.org/export/1.2/excerpt/';
    $con_ns = isset( $namespaces['content'] ) ? $namespaces['content'] : 'http://purl.org/rss/1.0/modules/content/';

    // First pass: register all terms / taxonomies
    foreach ( $xml->channel->children( $wp_ns )->term as $term ) {
        $taxonomy    = (string) $term->children( $wp_ns )->term_taxonomy;
        $slug        = (string) $term->children( $wp_ns )->term_slug;
        $name        = (string) $term->children( $wp_ns )->term_name;
        $description = (string) $term->children( $wp_ns )->term_description;
        if ( $taxonomy && $slug && $name ) {
            if ( ! term_exists( $slug, $taxonomy ) ) {
                wp_insert_term( $name, $taxonomy, [
                    'slug'        => $slug,
                    'description' => $description,
                ] );
            }
        }
    }

    // Second pass: import items (posts, pages, CPTs)
    $post_mapping = []; // old ID ? new ID

    foreach ( $xml->channel->item as $item ) {
        $wp = $item->children( $wp_ns );

        $post_type   = (string) $wp->post_type;
        $post_status = (string) $wp->post_status;
        $post_date   = (string) $wp->post_date;
        $post_name   = (string) $wp->post_name;
        $old_id      = (int)    $wp->post_id;
        $menu_order  = (int)    $wp->menu_order;

        // Skip attachments and nav menu items for now
        if ( in_array( $post_type, [ 'attachment', 'nav_menu_item' ], true ) ) continue;

        // Skip if already exists (by slug + post type)
        $existing = get_page_by_path( $post_name, OBJECT, $post_type );
        if ( $existing ) {
            $post_mapping[ $old_id ] = $existing->ID;
            continue;
        }

        $content = '';
        foreach ( $item->children( $con_ns ) as $c ) {
            $content = (string) $c;
        }
        $excerpt = '';
        foreach ( $item->children( $ex_ns ) as $e ) {
            $excerpt = (string) $e;
        }
        $author = '';
        foreach ( $item->children( $dc_ns ) as $d ) {
            $author = (string) $d;
        }
        $author_obj = get_user_by( 'login', $author );
        $author_id  = $author_obj ? $author_obj->ID : get_current_user_id();

        $new_id = wp_insert_post( [
            'post_title'    => (string) $item->title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_status'   => in_array( $post_status, [ 'publish', 'draft', 'private' ], true ) ? $post_status : 'publish',
            'post_type'     => $post_type,
            'post_name'     => $post_name,
            'post_date'     => $post_date,
            'post_author'   => $author_id,
            'menu_order'    => $menu_order,
        ], true );

        if ( is_wp_error( $new_id ) || ! $new_id ) continue;

        $post_mapping[ $old_id ] = $new_id;

        // Postmeta
        foreach ( $wp->postmeta as $meta ) {
            $key   = (string) $meta->meta_key;
            $value = (string) $meta->meta_value;
            if ( substr( $key, 0, 1 ) !== '_' || in_array( $key, [
                '_service_icon', '_service_price', '_service_duration',
                '_service_video', '_service_benefits', '_product_url',
            ], true ) ) {
                update_post_meta( $new_id, $key, $value );
            }
        }

        // Taxonomy terms
        foreach ( $item->children( $wp_ns )->category as $cat ) {
            $domain = (string) $cat->attributes()->domain;
            $slug   = (string) $cat->attributes()->nicename;
            if ( $domain && $slug ) {
                $term = get_term_by( 'slug', $slug, $domain );
                if ( $term ) {
                    wp_set_object_terms( $new_id, $term->term_id, $domain, true );
                }
            }
        }
    }
}

// -- Success notice after import ----------------------------------------------
add_action( 'admin_notices', 'livia_import_success_notice' );
function livia_import_success_notice() {
    if ( ! isset( $_GET['livia_imported'] ) ) return;
    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '? <strong>LIVIA Demo Content imported successfully!</strong> ';
    echo 'Your services, posts, and categories have been restored. ';
    echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=service' ) ) . '">View Services ?</a>';
    echo '</p></div>';
}

// -- Helper: re-run importer at any time from the importer page ---------------
// Visit: WP Admin ? Appearance ? Import Demo Content
add_action( 'admin_menu', 'livia_importer_menu' );
function livia_importer_menu() {
    add_theme_page(
        'Import Demo Content',
        'Import Demo Content',
        'manage_options',
        'livia-importer',
        'livia_importer_page'
    );
}
function livia_importer_page() {
    $already   = get_option( 'livia_demo_imported' );
    $import_url = wp_nonce_url(
        add_query_arg( 'livia_run_import', '1', admin_url() ),
        'livia_import_nonce'
    );
    echo '<div class="wrap">';
    echo '<h1>?? LIVIA Demo Content Importer</h1>';
    if ( $already && $already !== 'dismissed' ) {
        echo '<p>Content was last imported on <strong>' . esc_html( $already ) . '</strong>.</p>';
        echo '<p>You can re-import at any time � existing posts with the same slug will be skipped.</p>';
    }
    echo '<p>This will import all services, pages, blog posts, categories, and custom field data from the bundled <code>demo-content/content.xml</code> file.</p>';
    echo '<p><strong>Note:</strong> Images won\'t be re-uploaded automatically unless the WordPress Importer plugin is active and the original URLs are reachable.</p>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary button-large">Run Import Now</a>';
    // Allow re-import
    echo '<script>document.querySelector(".button-primary").addEventListener("click",function(){';
    echo 'if(!confirm("This will import all demo content. Continue?"))event.preventDefault();';
    echo '});</script>';
    // Reset flag so importer can run again
    delete_option( 'livia_demo_imported' );
    echo '</div>';
}


// =============================================================================
// AUTO-PURGE LITESPEED CACHE ON THEME UPDATE
// Fires automatically after every git pull / theme file change.
// Compares the combined modified-time of key theme files against a stored
// value. If anything changed, it purges LiteSpeed, Cloudflare (via LSC), and
// the WP object cache — zero manual effort required.
// =============================================================================
add_action( 'init', function () {
    $theme_dir = get_template_directory();

    // Hash the mtime of the files most likely to change after a deploy
    $watch = [
        $theme_dir . '/functions.php',
        $theme_dir . '/style.css',
        $theme_dir . '/front-page.php',
        $theme_dir . '/footer.php',
        $theme_dir . '/header.php',
    ];

    $current_sig = '';
    foreach ( $watch as $f ) {
        if ( file_exists( $f ) ) {
            $current_sig .= filemtime( $f );
        }
    }
    $current_sig = md5( $current_sig );

    $stored_sig = get_option( 'livia_theme_sig', '' );

    if ( $current_sig === $stored_sig ) {
        return; // Nothing changed — skip
    }

    // Files changed: update stored signature
    update_option( 'livia_theme_sig', $current_sig, false );

    // 1. LiteSpeed Cache full purge
    do_action( 'litespeed_purge_all' );

    // 2. LiteSpeed ESI purge (covers edge-cached fragments)
    do_action( 'litespeed_purge_all_esi' );

    // 3. WP Object Cache flush (Redis / Memcached if active)
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }

    // 4. WP Rocket compatibility (in case both are active)
    if ( function_exists( 'rocket_clean_domain' ) ) {
        rocket_clean_domain();
    }

    // 5. W3 Total Cache compatibility
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }

}, 1 ); // Priority 1 — run early


// =============================================================================
// AI SEARCH VISIBILITY — HOMEPAGE FAQ SCHEMA
// These Q&As directly feed Google AI Overviews, ChatGPT, and Perplexity
// when users ask questions about med spas in Tampa.
// =============================================================================
function livia_homepage_faq_schema() {
    if ( ! is_front_page() ) return;

    $faqs = [
        [
            'q' => 'What services does LIVIA Med Spa offer in Tampa?',
            'a' => 'LIVIA Med Spa in Tampa, FL offers Botox and neuromodulators, dermal fillers (Juvederm, Restylane), RF microneedling, Helix CO2 laser skin resurfacing, medical-grade facials, chemical peels, Kybella, IV therapy, weight loss programs, and a curated selection of medical-grade skincare products.',
        ],
        [
            'q' => 'Who is the provider at LIVIA Med Spa?',
            'a' => 'LIVIA Med Spa is founded and led by Angela Spicola, APRN — a board-certified Advanced Practice Registered Nurse specializing in aesthetic medicine. Angela brings years of clinical experience delivering natural, results-driven outcomes for clients throughout Tampa and the surrounding areas.',
        ],
        [
            'q' => 'Where is LIVIA Med Spa located?',
            'a' => 'LIVIA Med Spa is located at 10043 N Dale Mabry Hwy, Tampa, FL 33618 — conveniently serving Carrollwood, Westchase, Lutz, Land O Lakes, and the greater Tampa Bay area. Call (813) 230-2219 to book.',
        ],
        [
            'q' => 'How much does Botox cost at LIVIA Med Spa?',
            'a' => 'Botox pricing at LIVIA Med Spa varies based on the number of units and treatment areas. We offer complimentary consultations so you can get an accurate, personalized quote. Beauty Bank memberships also provide monthly credit savings on all treatments including Botox.',
        ],
        [
            'q' => 'Does LIVIA Med Spa offer free consultations?',
            'a' => 'Yes! LIVIA Med Spa offers complimentary consultations with Angela Spicola, APRN. During your consultation, she will assess your aesthetic goals and create a personalized treatment plan tailored to your needs. Book online or call (813) 230-2219.',
        ],
        [
            'q' => 'What are LIVIA Med Spa\'s hours?',
            'a' => 'LIVIA Med Spa is open Monday through Wednesday from 9:00 AM to 7:00 PM, and Thursday through Saturday from 9:00 AM to 4:00 PM. They are closed on Sundays.',
        ],
        [
            'q' => 'What is the Beauty Bank membership at LIVIA Med Spa?',
            'a' => 'The Beauty Bank is LIVIA Med Spa\'s monthly savings membership. Members set a custom monthly deposit (starting at $50/month) that accumulates as credits redeemable for any service or product. Credits never expire while your membership is active, and members receive exclusive pricing and priority booking.',
        ],
        [
            'q' => 'Is LIVIA Med Spa good for first-time med spa clients?',
            'a' => 'Absolutely. LIVIA Med Spa specializes in natural-looking results and welcomes first-time clients. Angela Spicola, APRN, takes a thorough, educational approach to every consultation, ensuring you understand every treatment option before making any decisions. They offer a $50 off first-visit special for new clients.',
        ],
        [
            'q' => 'Does LIVIA Med Spa offer financing?',
            'a' => 'Yes, LIVIA Med Spa offers payment plan financing through Cherry — a healthcare financing platform that lets you split your treatment costs into manageable monthly payments with easy online approval.',
        ],
        [
            'q' => 'What makes LIVIA Med Spa different from other Tampa med spas?',
            'a' => 'LIVIA Med Spa stands out for its board-certified APRN provider Angela Spicola, its commitment to natural, personalized results, transparent pricing, and its unique Beauty Bank membership program. They use only FDA-approved products and advanced techniques to deliver safe, effective outcomes.',
        ],
    ];

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'livia_homepage_faq_schema', 6);


// =============================================================================
// AI SEARCH VISIBILITY — SERVICE PAGE FAQ SCHEMA
// Auto-generates a FAQPage schema on every service page from common
// treatment-specific questions. Helps AI tools cite specific services.
// =============================================================================
function livia_service_faq_schema() {
    if ( ! is_singular('service') ) return;

    $service_name = get_the_title();
    $price        = get_post_meta(get_the_ID(), '_service_price', true);
    $duration     = get_post_meta(get_the_ID(), '_service_duration', true);

    $faqs = [
        [
            'q' => 'How much does ' . $service_name . ' cost at LIVIA Med Spa?',
            'a' => $price
                ? $service_name . ' at LIVIA Med Spa starts at ' . esc_html($price) . '. We offer complimentary consultations for a personalized quote. Beauty Bank members receive exclusive savings.'
                : $service_name . ' pricing at LIVIA Med Spa is customized to your treatment goals. Book a complimentary consultation with Angela Spicola, APRN to get an accurate quote.',
        ],
        [
            'q' => 'How long does ' . $service_name . ' take at LIVIA Med Spa?',
            'a' => $duration
                ? $service_name . ' appointments at LIVIA Med Spa typically take ' . esc_html($duration) . '. Times may vary based on your individual treatment plan.'
                : $service_name . ' treatment times vary by client. Contact LIVIA Med Spa at (813) 230-2219 for details.',
        ],
        [
            'q' => 'Is ' . $service_name . ' safe?',
            'a' => $service_name . ' at LIVIA Med Spa is performed by Angela Spicola, a board-certified APRN with extensive aesthetic medicine experience. All treatments use FDA-approved products and protocols for your safety.',
        ],
        [
            'q' => 'Where can I get ' . $service_name . ' in Tampa, FL?',
            'a' => 'LIVIA Med Spa offers ' . $service_name . ' in Tampa, FL at 10043 N Dale Mabry Hwy, Tampa, FL 33618. Call (813) 230-2219 or book online to schedule your complimentary consultation.',
        ],
    ];

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'livia_service_faq_schema', 7);


// =============================================================================
// AI SEARCH VISIBILITY — ALLOW AI CRAWLERS IN ROBOTS.TXT
// Explicitly permits GPTBot (ChatGPT), PerplexityBot, ClaudeBot (Anthropic),
// Applebot-Extended (Apple Intelligence), and Google-Extended (Bard/Gemini).
// Without this, AI tools may not index the site for their training data.
// =============================================================================
add_filter('robots_txt', 'livia_allow_ai_crawlers', 10, 2);
function livia_allow_ai_crawlers($output, $public) {
    $ai_rules  = "\n# ── AI Search Crawlers — explicitly allowed for AI search visibility ──\n";
    $ai_rules .= "User-agent: GPTBot\nAllow: /\n\n";          // ChatGPT / OpenAI
    $ai_rules .= "User-agent: ChatGPT-User\nAllow: /\n\n";    // ChatGPT browsing
    $ai_rules .= "User-agent: OAI-SearchBot\nAllow: /\n\n";   // OpenAI SearchGPT
    $ai_rules .= "User-agent: PerplexityBot\nAllow: /\n\n";   // Perplexity AI
    $ai_rules .= "User-agent: ClaudeBot\nAllow: /\n\n";        // Anthropic Claude
    $ai_rules .= "User-agent: Claude-Web\nAllow: /\n\n";       // Claude browsing
    $ai_rules .= "User-agent: Google-Extended\nAllow: /\n\n";  // Google Gemini/Bard
    $ai_rules .= "User-agent: Applebot-Extended\nAllow: /\n\n"; // Apple Intelligence
    $ai_rules .= "User-agent: Bytespider\nAllow: /\n\n";       // ByteDance AI
    $ai_rules .= "User-agent: Meta-ExternalAgent\nAllow: /\n\n"; // Meta AI
    $ai_rules .= "User-agent: YouBot\nAllow: /\n\n";           // You.com AI search
    $ai_rules .= "User-agent: cohere-ai\nAllow: /\n\n";        // Cohere AI
    return $output . $ai_rules;
}


// =============================================================================
// HOMEPAGE REVIEW SCHEMA
// Mirrors the three real Google reviews displayed in the testimonials section
// of front-page.php. Structured data must reflect visible page content —
// keep these in sync if the testimonials section changes.
// =============================================================================
function livia_review_schema() {
    if ( ! is_front_page() ) return;

    $reviews = [
        [
            'author' => 'Lindsay S.',
            'rating' => 5,
            'body'   => 'I have been getting Botox for about 5 years now and I can say hands-down this has been the best treatment I have ever had! Angie was extremely professional. Her equipment was top notch and like nothing I\'ve ever seen before.',
        ],
        [
            'author' => 'Luna',
            'rating' => 5,
            'body'   => 'Angie is the best! I\'ve been coming to her for over a year now. I do my Botox and my microneedling and she never fails me. She\'s also really nice, makes you feel comfortable and so welcoming.',
        ],
        [
            'author' => 'Sydney M.',
            'rating' => 5,
            'body'   => 'I can\'t say enough great things about Angie. She has been so helpful and kind as I start my journey. She has been there every step of the way if I have questions or concerns. I would 1000/10 recommend Angie!',
        ],
    ];

    $schema_reviews = [];
    foreach ($reviews as $r) {
        $schema_reviews[] = [
            '@type'        => 'Review',
            'author'       => [ '@type' => 'Person', 'name' => $r['author'] ],
            'reviewRating' => [ '@type' => 'Rating', 'ratingValue' => $r['rating'], 'bestRating' => 5 ],
            'reviewBody'   => $r['body'],
            'itemReviewed' => [
                '@type' => 'MedicalBusiness',
                'name'  => 'LIVIA Med Spa',
                'image' => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema_reviews, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'livia_review_schema', 8);

// ── Service Bottom Photo Meta Box ──────────────────────────────────
function livia_service_bottom_photo_meta_box() {
    add_meta_box(
        'livia_service_bottom_photo',
        'Service Bottom Photo',
        'livia_service_bottom_photo_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_service_bottom_photo_meta_box');

function livia_service_bottom_photo_html($post) {
    wp_nonce_field('livia_service_bottom_photo_nonce_action', 'livia_service_bottom_photo_nonce');
    $photo_id = get_post_meta($post->ID, '_service_bottom_photo_id', true);
    $photo_url = '';
    if ($photo_id) {
        $photo_url = wp_get_attachment_url($photo_id);
    }
    ?>
    <div style="padding: 10px 0; text-align: center;">
        <input type="hidden" id="service_bottom_photo_id" name="service_bottom_photo_id" value="<?php echo esc_attr($photo_id); ?>">
        
        <div id="livia_bottom_photo_preview_container" style="margin-bottom: 15px; <?php echo empty($photo_url) ? 'display:none;' : ''; ?>">
            <img id="livia_bottom_photo_preview" src="<?php echo esc_url($photo_url); ?>" style="max-width:300px; max-height:200px; border:1px solid #ddd; border-radius:8px; padding:4px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
        </div>
        
        <div style="display:flex; justify-content:center; gap:10px;">
            <button type="button" class="button button-primary" id="livia_bottom_photo_upload_btn">
                <?php echo empty($photo_url) ? 'Upload / Choose Image' : 'Change Image'; ?>
            </button>
            <button type="button" class="button button-link-delete" id="livia_bottom_photo_remove_btn" style="<?php echo empty($photo_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                Remove Image
            </button>
        </div>
        <p class="description" style="margin-top:8px; text-align:center;">Choose a photo from your Media Library or upload a new one. It will be centered at the bottom of the service page in its natural dimensions.</p>
    </div>
    <?php
}

function livia_save_service_bottom_photo($post_id) {
    if (!isset($_POST['livia_service_bottom_photo_nonce']) || !wp_verify_nonce($_POST['livia_service_bottom_photo_nonce'], 'livia_service_bottom_photo_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['service_bottom_photo_id'])) {
        update_post_meta($post_id, '_service_bottom_photo_id', sanitize_text_field($_POST['service_bottom_photo_id']));
    }
}
add_action('save_post_service', 'livia_save_service_bottom_photo');

function livia_service_bottom_photo_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frame;
            $('#livia_bottom_photo_upload_btn').on('click', function(e) {
                e.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media({
                    title: 'Select Bottom Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });
                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#service_bottom_photo_id').val(attachment.id);
                    $('#livia_bottom_photo_preview').attr('src', attachment.url);
                    $('#livia_bottom_photo_preview_container').show();
                    $('#livia_bottom_photo_upload_btn').text('Change Image');
                    $('#livia_bottom_photo_remove_btn').show();
                });
                file_frame.open();
            });
            
            $('#livia_bottom_photo_remove_btn').on('click', function(e) {
                e.preventDefault();
                $('#service_bottom_photo_id').val('');
                $('#livia_bottom_photo_preview_container').hide();
                $('#livia_bottom_photo_preview').attr('src', '');
                $('#livia_bottom_photo_upload_btn').text('Upload / Choose Image');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_service_bottom_photo_admin_scripts');


// ── Before & After Custom Post Type ──────────────────────────────────
function livia_register_before_after() {
    register_post_type('before_after', [
        'labels' => [
            'name'               => 'Before & Afters',
            'singular_name'      => 'Before & After',
            'add_new'            => 'Add New Item',
            'add_new_item'       => 'Add New Gallery Item',
            'edit_item'          => 'Edit Gallery Item',
            'new_item'           => 'New Gallery Item',
            'view_item'          => 'View Gallery Item',
            'search_items'       => 'Search Gallery Items',
            'not_found'          => 'No gallery items found',
            'menu_name'          => '✨ Before & After',
        ],
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'before-after-entry'],
        'menu_icon'          => 'dashicons-images-alt2',
        'menu_position'      => 8,
        'supports'           => ['title', 'editor', 'excerpt'],
        'show_in_rest'       => true,
    ]);

    // Register Taxonomy
    register_taxonomy('before_after_category', 'before_after', [
        'labels' => [
            'name'          => 'Categories',
            'singular_name' => 'Category',
            'add_new_item'  => 'Add Category',
            'menu_name'     => 'Categories',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'before-after-category'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'livia_register_before_after');

// ── Before & After Image Meta Box ──────────────────────────────────
function livia_before_after_meta_box() {
    add_meta_box(
        'livia_before_after_images',
        'Before & After Images',
        'livia_before_after_meta_html',
        'before_after',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_before_after_meta_box');

function livia_before_after_meta_html($post) {
    wp_nonce_field('livia_before_after_nonce_action', 'livia_before_after_nonce');
    $before_id = get_post_meta($post->ID, '_before_image_id', true);
    $after_id  = get_post_meta($post->ID, '_after_image_id', true);
    
    $before_url = $before_id ? wp_get_attachment_url($before_id) : '';
    $after_url  = $after_id ? wp_get_attachment_url($after_id) : '';
    ?>
    <style>
        .livia-ba-row { display: flex; gap: 2rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .livia-ba-col { flex: 1; min-width: 280px; background: #fafafa; border: 1px solid #e5e5e5; border-radius: 8px; padding: 1.5rem; text-align: center; }
        .livia-ba-title { font-weight: 600; font-size: 1.1em; margin-top: 0; margin-bottom: 1rem; color: #23282d; }
        .livia-ba-preview-container { margin-bottom: 15px; min-height: 150px; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px dashed #ccc; border-radius: 6px; padding: 8px; }
        .livia-ba-preview { max-width: 100%; max-height: 180px; border-radius: 4px; object-fit: contain; }
        .livia-ba-placeholder { color: #aaa; font-style: italic; }
        .livia-ba-buttons { display: flex; justify-content: center; gap: 8px; }
    </style>
    <div class="livia-ba-row">
        <!-- Before Image Column -->
        <div class="livia-ba-col">
            <h3 class="livia-ba-title">Before Photo</h3>
            <input type="hidden" id="before_image_id" name="before_image_id" value="<?php echo esc_attr($before_id); ?>">
            <div class="livia-ba-preview-container">
                <img id="before_preview" src="<?php echo esc_url($before_url); ?>" style="<?php echo empty($before_url) ? 'display:none;' : ''; ?>" class="livia-ba-preview">
                <span id="before_placeholder" style="<?php echo !empty($before_url) ? 'display:none;' : ''; ?>" class="livia-ba-placeholder">No image selected (uses default placeholder)</span>
            </div>
            <div class="livia-ba-buttons">
                <button type="button" class="button button-primary ba-upload-btn" data-target="before">
                    <?php echo empty($before_url) ? 'Select Before Photo' : 'Change Photo'; ?>
                </button>
                <button type="button" class="button button-link-delete ba-remove-btn" data-target="before" style="<?php echo empty($before_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                    Remove
                </button>
            </div>
        </div>

        <!-- After Image Column -->
        <div class="livia-ba-col">
            <h3 class="livia-ba-title">After Photo</h3>
            <input type="hidden" id="after_image_id" name="after_image_id" value="<?php echo esc_attr($after_id); ?>">
            <div class="livia-ba-preview-container">
                <img id="after_preview" src="<?php echo esc_url($after_url); ?>" style="<?php echo empty($after_url) ? 'display:none;' : ''; ?>" class="livia-ba-preview">
                <span id="after_placeholder" style="<?php echo !empty($after_url) ? 'display:none;' : ''; ?>" class="livia-ba-placeholder">No image selected (uses default placeholder)</span>
            </div>
            <div class="livia-ba-buttons">
                <button type="button" class="button button-primary ba-upload-btn" data-target="after">
                    <?php echo empty($after_url) ? 'Select After Photo' : 'Change Photo'; ?>
                </button>
                <button type="button" class="button button-link-delete ba-remove-btn" data-target="after" style="<?php echo empty($after_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                    Remove
                </button>
            </div>
        </div>
    </div>

    <!-- Photo Credits Input Field -->
    <?php $credits = get_post_meta($post->ID, '_photo_credits', true); ?>
    <div style="margin-top: 1.5rem; background: #fafafa; border: 1px solid #e5e5e5; border-radius: 8px; padding: 1.5rem;">
        <label for="photo_credits" style="display: block; font-weight: 600; font-size: 1.1em; margin-bottom: 0.5rem; color: #23282d;">Photo / Case Credits (Optional)</label>
        <input type="text" id="photo_credits" name="photo_credits" value="<?php echo esc_attr($credits); ?>" class="regular-text" style="width: 100%; max-width: 500px;" placeholder="e.g. Dr. Jane Smith, MD or Courtesy of Partner Clinic">
        <p class="description">If you acquired these comparison photos from somewhere else, enter the credits here to display them on the gallery card.</p>
    </div>
    <?php
}

function livia_save_before_after_meta($post_id) {
    if (!isset($_POST['livia_before_after_nonce']) || !wp_verify_nonce($_POST['livia_before_after_nonce'], 'livia_before_after_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['before_image_id'])) {
        update_post_meta($post_id, '_before_image_id', sanitize_text_field($_POST['before_image_id']));
    }
    if (isset($_POST['after_image_id'])) {
        update_post_meta($post_id, '_after_image_id', sanitize_text_field($_POST['after_image_id']));
    }
    if (isset($_POST['photo_credits'])) {
        update_post_meta($post_id, '_photo_credits', sanitize_text_field($_POST['photo_credits']));
    }
}
add_action('save_post_before_after', 'livia_save_before_after_meta');

function livia_before_after_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'before_after') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frames = {};
            
            $('.ba-upload-btn').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                
                if (file_frames[target]) {
                    file_frames[target].open();
                    return;
                }
                
                file_frames[target] = wp.media({
                    title: 'Select ' + (target === 'before' ? 'Before' : 'After') + ' Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });
                
                file_frames[target].on('select', function() {
                    var attachment = file_frames[target].state().get('selection').first().toJSON();
                    $('#' + target + '_image_id').val(attachment.id);
                    $('#' + target + '_preview').attr('src', attachment.url).show();
                    $('#' + target + '_placeholder').hide();
                    $('button.ba-upload-btn[data-target="' + target + '"]').text('Change Photo');
                    $('button.ba-remove-btn[data-target="' + target + '"]').show();
                });
                
                file_frames[target].open();
            });
            
            $('.ba-remove-btn').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('#' + target + '_image_id').val('');
                $('#' + target + '_preview').hide().attr('src', '');
                $('#' + target + '_placeholder').show();
                $('button.ba-upload-btn[data-target="' + target + '"]').text('Select ' + (target === 'before' ? 'Before' : 'After') + ' Photo');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_before_after_admin_scripts');

// ── Before & After Auto Seeder ──────────────────────────────────────
function livia_create_before_after_items() {
    if (get_option('livia_before_after_created_v2')) return;

    $categories = [
        'Botox'         => 'botox',
        'Fillers'       => 'fillers',
        'Laser'         => 'laser',
        'Peels'         => 'peels',
        'Microneedling' => 'microneedling',
    ];

    $cat_ids = [];
    foreach ($categories as $name => $slug) {
        $existing = term_exists($name, 'before_after_category');
        if ($existing) {
            $cat_ids[$slug] = $existing['term_id'];
        } else {
            $term = wp_insert_term($name, 'before_after_category', ['slug' => $slug]);
            if (!is_wp_error($term)) {
                $cat_ids[$slug] = $term['term_id'];
            }
        }
    }

    $gallery_items = [
        [
            'title'       => 'Botox — Forehead & Crow\'s Feet',
            'category'    => 'botox',
            'description' => '40 units of Botox to smooth forehead lines and crow\'s feet. Results shown at 2 weeks post-treatment.',
        ],
        [
            'title'       => 'Lip Filler — Natural Enhancement',
            'category'    => 'fillers',
            'description' => '1 syringe of Juvederm Ultra for subtle volume and definition. Results shown at 2 weeks.',
        ],
        [
            'title'       => 'Laser Skin Rejuvenation',
            'category'    => 'laser',
            'description' => '3 sessions of laser resurfacing for sun damage and hyperpigmentation. Results at 6 weeks.',
        ],
        [
            'title'       => 'Cheek & Jawline Fillers',
            'category'    => 'fillers',
            'description' => '2 syringes of Voluma for cheek augmentation and jawline contour. Results at 2 weeks.',
        ],
        [
            'title'       => 'Microneedling — Acne Scarring',
            'category'    => 'microneedling',
            'description' => '4 sessions of microneedling with PRP for acne scar improvement. Results at 3 months.',
        ],
        [
            'title'       => 'Chemical Peel — Melasma',
            'category'    => 'peels',
            'description' => 'Series of 3 VI Peels for melasma and uneven skin tone. Results at 8 weeks.',
        ],
    ];

    foreach ($gallery_items as $item) {
        $existing = get_page_by_title($item['title'], OBJECT, 'before_after');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_title'   => $item['title'],
            'post_content' => $item['description'],
            'post_status'  => 'publish',
            'post_type'    => 'before_after',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            if (isset($cat_ids[$item['category']])) {
                wp_set_object_terms($post_id, (int) $cat_ids[$item['category']], 'before_after_category');
            }
        }
    }

    update_option('livia_before_after_created_v2', true);
}
add_action('after_switch_theme', 'livia_create_before_after_items');
add_action('init', 'livia_create_before_after_items', 15);

// ── Service Page Custom Fields & UI Editor ──────────────────────────
function livia_register_service_meta_boxes() {
    add_meta_box(
        'livia_service_sections_layout',
        'Service Sections Layout (Custom Fields)',
        'livia_service_sections_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_register_service_meta_boxes');

function livia_service_sections_html($post) {
    wp_nonce_field('livia_service_sections_nonce_action', 'livia_service_sections_nonce');

    // Retrieve current values
    $icon = get_post_meta($post->ID, '_service_icon', true) ?: '✨';
    $price = get_post_meta($post->ID, '_service_price', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $video = get_post_meta($post->ID, '_service_video', true);

    $sec_a_title = get_post_meta($post->ID, '_service_sec_a_title', true);
    $sec_a_desc = get_post_meta($post->ID, '_service_sec_a_desc', true);
    $sec_a_checklist = get_post_meta($post->ID, '_service_sec_a_checklist', true);
    $sec_a_image_id = get_post_meta($post->ID, '_service_sec_a_image_id', true);

    $sec_b_title = get_post_meta($post->ID, '_service_sec_b_title', true);
    $sec_b_desc = get_post_meta($post->ID, '_service_sec_b_desc', true);
    $sec_b_image_id = get_post_meta($post->ID, '_service_sec_b_image_id', true);

    $sec_c_title = get_post_meta($post->ID, '_service_sec_c_title', true);
    $sec_c_desc = get_post_meta($post->ID, '_service_sec_c_desc', true);
    $sec_c_bg_image_id = get_post_meta($post->ID, '_service_sec_c_bg_image_id', true);

    $sec_d_prep = get_post_meta($post->ID, '_service_sec_d_prep', true);
    $sec_d_after = get_post_meta($post->ID, '_service_sec_d_after', true);

    $sec_e_title = get_post_meta($post->ID, '_service_sec_e_title', true);
    $sec_e_desc = get_post_meta($post->ID, '_service_sec_e_desc', true);
    $sec_e_image_id = get_post_meta($post->ID, '_service_sec_e_image_id', true);
    ?>
    <div class="livia-meta-container">
        <p class="description" style="margin-bottom:20px; font-size:13px; color:#50575e;">
            Fill in the sections below to build the alternating premium layout. <strong>Any section left completely blank (empty title/description) will not pop up on the page.</strong> If all fields are left empty, the page defaults back to using the standard post editor content.
        </p>

        <!-- General Info Section -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>General Metadata</span>
                <span class="livia-meta-badge">Badge & Header</span>
            </div>
            <div class="livia-meta-section-body" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_icon">Service Icon</label>
                    <input type="text" class="livia-meta-input-text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="e.g. ✨">
                    <div class="livia-meta-help">Emoji icon shown in badges/cards.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_price">Price Tag</label>
                    <input type="text" class="livia-meta-input-text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g. $250 or $12/unit">
                    <div class="livia-meta-help">Displayed in the page hero and badges.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_duration">Treatment Duration</label>
                    <input type="text" class="livia-meta-input-text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" placeholder="e.g. 30 mins or 1 hour">
                    <div class="livia-meta-help">Displayed in the page hero.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_video">Video URL (Vimeo/YouTube)</label>
                    <input type="text" class="livia-meta-input-text" id="service_video" name="service_video" value="<?php echo esc_attr($video); ?>" placeholder="e.g. https://www.youtube.com/watch?v=...">
                    <div class="livia-meta-help">Will render a looping autoplay video in the hero area.</div>
                </div>
            </div>
        </div>

        <!-- Section A: Areas Treated -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section A: Areas Treated</span>
                <span class="livia-meta-badge">Section 1 (Left Text, Right Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_a_title" name="service_sec_a_title" value="<?php echo esc_attr($sec_a_title); ?>" placeholder="e.g. Areas Treated with Dermal Fillers">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_a_desc" name="service_sec_a_desc" placeholder="Describe the treatment areas..."><?php echo esc_textarea($sec_a_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_checklist">Checklist (One item per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_a_checklist" name="service_sec_a_checklist" style="height:80px;" placeholder="Cheeks&#10;Lips&#10;Jawline"><?php echo esc_textarea($sec_a_checklist); ?></textarea>
                    <div class="livia-meta-help">These will show with purple checkmarks below the paragraph.</div>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $a_img_url = $sec_a_image_id ? wp_get_attachment_url($sec_a_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_a_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_a_image_id" value="<?php echo esc_attr($sec_a_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($a_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($a_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($a_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($a_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section B: How It Works -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section B: How It Works</span>
                <span class="livia-meta-badge">Section 2 (Right Text, Left Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_b_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_b_title" name="service_sec_b_title" value="<?php echo esc_attr($sec_b_title); ?>" placeholder="e.g. How It Works">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_b_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_b_desc" name="service_sec_b_desc" placeholder="Explain the scientific mechanism or procedure..."><?php echo esc_textarea($sec_b_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $b_img_url = $sec_b_image_id ? wp_get_attachment_url($sec_b_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_b_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_b_image_id" value="<?php echo esc_attr($sec_b_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($b_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($b_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($b_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($b_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section C: Expectations -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section C: What to Expect</span>
                <span class="livia-meta-badge">Section 3 (Overlay Card with Background Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_c_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_c_title" name="service_sec_c_title" value="<?php echo esc_attr($sec_c_title); ?>" placeholder="e.g. What to Expect During Your Treatment">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_c_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_c_desc" name="service_sec_c_desc" placeholder="What does the patient experience during the treatment?"><?php echo esc_textarea($sec_c_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $c_img_url = $sec_c_bg_image_id ? wp_get_attachment_url($sec_c_bg_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_c_bg_image_id">
                        <label class="livia-meta-label">Background Image</label>
                        <input type="hidden" name="service_sec_c_bg_image_id" value="<?php echo esc_attr($sec_c_bg_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($c_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($c_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($c_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($c_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section D: Prep & Aftercare -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section D: Prep & Aftercare Guidelines</span>
                <span class="livia-meta-badge">Section 4 (Side-by-side Lists)</span>
            </div>
            <div class="livia-meta-section-body" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_d_prep">Pre-Treatment Instructions (One per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_d_prep" name="service_sec_d_prep" style="height:150px;" placeholder="Avoid alcohol 24h prior&#10;Arrive with clean skin"><?php echo esc_textarea($sec_d_prep); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_d_after">Aftercare Instructions (One per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_d_after" name="service_sec_d_after" style="height:150px;" placeholder="Keep head elevated for 4h&#10;Avoid heavy exercise for 24h"><?php echo esc_textarea($sec_d_after); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Section E: Treatment Plan & Results -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section E: Treatment Plan & Results</span>
                <span class="livia-meta-badge">Section 5 (Left Text, Right Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_e_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_e_title" name="service_sec_e_title" value="<?php echo esc_attr($sec_e_title); ?>" placeholder="e.g. Treatment Plan and Results">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_e_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_e_desc" name="service_sec_e_desc" placeholder="Detail the results timeline and ongoing maintenance sessions..."><?php echo esc_textarea($sec_e_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $e_img_url = $sec_e_image_id ? wp_get_attachment_url($sec_e_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_e_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_e_image_id" value="<?php echo esc_attr($sec_e_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($e_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($e_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($e_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($e_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section F: FAQs -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section F: Frequently Asked Questions</span>
                <span class="livia-meta-badge">Section 6 (Interactive Accordions)</span>
            </div>
            <div class="livia-meta-section-body">
                <p class="description" style="margin-bottom: 10px; font-size:12px;">Fill out up to 6 custom FAQs. Empty questions will not be displayed.</p>
                <?php for ($i = 1; $i <= 6; $i++): 
                    $q_val = get_post_meta($post->ID, '_service_faq_q' . $i, true);
                    $a_val = get_post_meta($post->ID, '_service_faq_a' . $i, true);
                ?>
                <div class="faq-grid-row">
                    <div class="faq-grid-col">
                        <label class="livia-meta-label" for="service_faq_q<?php echo $i; ?>">Question <?php echo $i; ?></label>
                        <input type="text" class="livia-meta-input-text" id="service_faq_q<?php echo $i; ?>" name="service_faq_q<?php echo $i; ?>" value="<?php echo esc_attr($q_val); ?>" placeholder="e.g. Is treatment painful?">
                    </div>
                    <div class="faq-grid-col">
                        <label class="livia-meta-label" for="service_faq_a<?php echo $i; ?>">Answer <?php echo $i; ?> (HTML allowed)</label>
                        <textarea class="livia-meta-input-textarea" id="service_faq_a<?php echo $i; ?>" name="service_faq_a<?php echo $i; ?>" style="height:60px;" placeholder="Provide answer here..."><?php echo esc_textarea($a_val); ?></textarea>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php
}

function livia_save_service_sections($post_id) {
    if (!isset($_POST['livia_service_sections_nonce']) || !wp_verify_nonce($_POST['livia_service_sections_nonce'], 'livia_service_sections_nonce_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        '_service_icon'              => 'text',
        '_service_price'             => 'text',
        '_service_duration'          => 'text',
        '_service_video'             => 'text',
        '_service_sec_a_title'       => 'text',
        '_service_sec_a_desc'        => 'html',
        '_service_sec_a_checklist'   => 'textarea',
        '_service_sec_a_image_id'    => 'int',
        '_service_sec_b_title'       => 'text',
        '_service_sec_b_desc'        => 'html',
        '_service_sec_b_image_id'    => 'int',
        '_service_sec_c_title'       => 'text',
        '_service_sec_c_desc'        => 'html',
        '_service_sec_c_bg_image_id' => 'int',
        '_service_sec_d_prep'        => 'textarea',
        '_service_sec_d_after'       => 'textarea',
        '_service_sec_e_title'       => 'text',
        '_service_sec_e_desc'        => 'html',
        '_service_sec_e_image_id'    => 'int',
    ];

    for ($i = 1; $i <= 6; $i++) {
        $fields['_service_faq_q' . $i] = 'text';
        $fields['_service_faq_a' . $i] = 'html';
    }

    foreach ($fields as $key => $type) {
        $post_key = ltrim($key, '_');
        if (isset($_POST[$post_key])) {
            $value = $_POST[$post_key];
            if ($type === 'int') {
                update_post_meta($post_id, $key, absint($value));
            } elseif ($type === 'html') {
                update_post_meta($post_id, $key, wp_kses_post($value));
            } elseif ($type === 'textarea') {
                update_post_meta($post_id, $key, sanitize_textarea_field($value));
            } else {
                update_post_meta($post_id, $key, sanitize_text_field($value));
            }
        } else {
            update_post_meta($post_id, $key, '');
        }
    }
}
add_action('save_post_service', 'livia_save_service_sections');

function livia_service_sections_admin_styles() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        ?>
        <style>
        .livia-meta-container {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            max-width: 100%;
        }
        .livia-meta-section {
            border: 1px solid #ccd0d4;
            border-radius: 6px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        .livia-meta-section-header {
            background: #f6f7f7;
            padding: 12px 16px;
            border-bottom: 1px solid #ccd0d4;
            font-weight: 600;
            font-size: 14px;
            color: #1d2327;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 6px 6px 0 0;
        }
        .livia-meta-section-body {
            padding: 16px;
        }
        .livia-meta-row {
            margin-bottom: 15px;
        }
        .livia-meta-row:last-child {
            margin-bottom: 0;
        }
        .livia-meta-label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1d2327;
            font-size: 13px;
        }
        .livia-meta-input-text {
            width: 100%;
            padding: 8px 10px;
            font-size: 13px;
            line-height: 1.5;
            border-radius: 4px;
            border: 1px solid #8c8f94;
            background-color: #fff;
            color: #2c3338;
        }
        .livia-meta-input-text:focus, .livia-meta-input-textarea:focus {
            border-color: #AC13F9;
            box-shadow: 0 0 0 1px #AC13F9;
            outline: 2px solid transparent;
        }
        .livia-meta-input-textarea {
            width: 100%;
            height: 120px;
            padding: 8px 10px;
            font-size: 13px;
            line-height: 1.5;
            border-radius: 4px;
            border: 1px solid #8c8f94;
            background-color: #fff;
            color: #2c3338;
            font-family: inherit;
        }
        .livia-meta-badge {
            background: #AC13F9;
            color: #fff;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .livia-media-preview img {
            max-width: 180px;
            height: auto;
            border: 1px solid #c3c4c7;
            border-radius: 4px;
            padding: 4px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .faq-grid-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px dashed #ccd0d4;
        }
        .faq-grid-row:last-child {
            border-bottom: none;
        }
        .faq-grid-col {
            display: flex;
            flex-direction: column;
        }
        .livia-meta-help {
            font-size: 12px;
            color: #646970;
            margin-top: 4px;
            font-style: italic;
        }
        </style>
        <?php
    }
}
add_action('admin_head', 'livia_service_sections_admin_styles');

function livia_service_sections_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frame;
            var active_uploader;

            $(document).on('click', '.livia-media-upload-btn', function(e) {
                e.preventDefault();
                active_uploader = $(this).closest('.livia-media-uploader');

                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media({
                    title: 'Select Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });

                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    if (active_uploader) {
                        var fieldId = active_uploader.data('field-id');
                        active_uploader.find('input[type="hidden"]').val(attachment.id);
                        active_uploader.find('.livia-media-preview img').attr('src', attachment.url);
                        active_uploader.find('.livia-media-preview').show();
                        active_uploader.find('.livia-media-upload-btn').text('Change Image');
                        active_uploader.find('.livia-media-remove-btn').show();
                    }
                });

                file_frame.open();
            });

            $(document).on('click', '.livia-media-remove-btn', function(e) {
                e.preventDefault();
                var uploader = $(this).closest('.livia-media-uploader');
                uploader.find('input[type="hidden"]').val('');
                uploader.find('.livia-media-preview img').attr('src', '');
                uploader.find('.livia-media-preview').hide();
                uploader.find('.livia-media-upload-btn').text('Upload / Choose Image');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_service_sections_admin_scripts');

// ── One-Time Content Migrator to Custom Fields ──────────────────────
function livia_migrate_service_data() {
    if (get_option('livia_services_migrated_v3')) {
        return;
    }

    $services = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    ]);

    foreach ($services as $service) {
        $post_id = $service->ID;
        $slug = $service->post_name;
        $raw_content = $service->post_content;

        if (empty($raw_content)) {
            continue;
        }

        // 1. Resolve stock image attachment IDs
        $img_mapping = [
            'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
            'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
            'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
            'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
        ];

        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_538904225-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_446213685-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_374628525-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_260345614-1-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_474297401-1-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        }

        if (has_post_thumbnail($post_id)) {
            $thumb_id = get_post_thumbnail_id($post_id);
        } else {
            $thumb_id = attachment_url_to_postid($img_mapping['areas_treated']);
        }
        $how_works_id = attachment_url_to_postid($img_mapping['how_works']);
        $expect_bg_id = attachment_url_to_postid($img_mapping['expect_bg']);
        
        $bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
        $plan_image_id = $bottom_photo_id ? $bottom_photo_id : attachment_url_to_postid($img_mapping['plan']);

        // 2. Parse the content
        $parts = preg_split('/<h2[^>]*>(.*?)<\/h2>/is', $raw_content, -1, PREG_SPLIT_DELIM_CAPTURE);
        $sections = [];
        for ($i = 1; $i < count($parts); $i += 2) {
            if (empty($parts[$i])) continue;
            $sections[] = [
                'heading' => trim(strip_tags($parts[$i])),
                'content' => isset($parts[$i+1]) ? trim($parts[$i+1]) : '',
            ];
        }

        $what_is_sec = null;
        $treat_sec = null;
        $expect_sec = null;
        $aftercare_sec = null;
        $plan_sec = null;
        $faq_sec = null;

        foreach ($sections as $sec) {
            $h = strtolower($sec['heading']);
            if (strpos($h, 'what is') !== false) {
                $what_is_sec = $sec;
            } elseif (strpos($h, 'treat') !== false || strpos($h, 'areas') !== false) {
                $treat_sec = $sec;
            } elseif (strpos($h, 'process') !== false || strpos($h, 'expect') !== false || strpos($h, 'works') !== false) {
                $expect_sec = $sec;
            } elseif (strpos($h, 'aftercare') !== false || strpos($h, 'preparation') !== false) {
                $aftercare_sec = $sec;
            } elseif (strpos($h, 'cost') !== false || strpos($h, 'price') !== false || strpos($h, 'choose') !== false || strpos($h, 'plan') !== false) {
                $plan_sec = $sec;
            } elseif (strpos($h, 'faq') !== false || strpos($h, 'frequently') !== false || strpos($h, 'question') !== false) {
                $faq_sec = $sec;
            }
        }

        $get_list_text = function($html) {
            if (preg_match('/<ul[^>]*>(.*?)<\/ul>/is', $html, $m)) {
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $m[1], $matches);
                if (!empty($matches[1])) {
                    return implode("\n", array_map('trim', array_map('strip_tags', $matches[1])));
                }
            }
            return '';
        };

        $strip_list = function($html) {
            return trim(preg_replace('/<ul[^>]*>.*?<\/ul>/is', '', $html));
        };

        // Section A
        if ($treat_sec) {
            update_post_meta($post_id, '_service_sec_a_title', esc_html($treat_sec['heading']));
            update_post_meta($post_id, '_service_sec_a_desc', $strip_list($treat_sec['content']));
            update_post_meta($post_id, '_service_sec_a_checklist', $get_list_text($treat_sec['content']));
            if ($thumb_id) {
                update_post_meta($post_id, '_service_sec_a_image_id', $thumb_id);
            }
        }

        // Section B
        if ($what_is_sec) {
            update_post_meta($post_id, '_service_sec_b_title', esc_html($what_is_sec['heading']));
            update_post_meta($post_id, '_service_sec_b_desc', $what_is_sec['content']);
            if ($how_works_id) {
                update_post_meta($post_id, '_service_sec_b_image_id', $how_works_id);
            }
        }

        // Section C
        if ($expect_sec) {
            update_post_meta($post_id, '_service_sec_c_title', esc_html($expect_sec['heading']));
            update_post_meta($post_id, '_service_sec_c_desc', $expect_sec['content']);
            if ($expect_bg_id) {
                update_post_meta($post_id, '_service_sec_c_bg_image_id', $expect_bg_id);
            }
        }

        // Section D
        $prep_items = [];
        $after_items = [];
        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false || strpos($slug, 'candela') !== false || strpos($slug, 'lhr') !== false) {
            $prep_items = [
                'Shave the treatment area completely 24 hours prior to your session.',
                'Avoid plucking, waxing, or tweezing hair in the target area for 4 weeks.',
                'Avoid direct sun exposure and tanning beds for at least 2 weeks.',
                'Ensure skin is completely free of self-tanner, lotions, oils, and makeup on the day of treatment.'
            ];
            $after_items = [
                'Avoid direct sun exposure on the treated areas and apply broad-spectrum SPF 30+ daily.',
                'Avoid hot tubs, saunas, steam rooms, and hot showers for 24–48 hours.',
                'Postpone strenuous exercise and excessive sweating for 24 hours.',
                'Do not pluck, wax, or tweeze between sessions; shaving is the only permitted hair removal method.'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $prep_items = [
                'Avoid alcohol and blood-thinning supplements for 24-48 hours before treatment.',
                'Arrive with a clean, makeup-free face if possible.',
                'Reschedule if you have an active skin rash, cold sore, or infection in the treatment area.'
            ];
            $after_items = [
                'Keep your head elevated and avoid lying down for 4 hours after treatment.',
                'Avoid rubbing, massaging, or placing pressure on the treated areas for 24 hours.',
                'Postpone strenuous exercise and heavy sweating for 24 hours.',
                'Avoid facials, chemical peels, and microdermabrasion for 2 weeks.'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $prep_items = [
                'Avoid blood-thinning medications and supplements (like aspirin, fish oil) for 1 week prior.',
                'Avoid alcohol intake for 24-48 hours prior to your appointment to minimize bruising.',
                'Plan your treatment at least 2 weeks before any major social events.'
            ];
            $after_items = [
                'Apply cold packs gently to the treated areas for 15-20 minutes at a time to reduce swelling.',
                'Avoid touching, rubbing, or massaging the injection sites (except Sculptra 5-5-5 rule).',
                'Avoid sleeping face-down; sleep on your back with head elevated on pillows for 2-3 nights.',
                'Avoid strenuous exercise, saunas, and hot tubs for 24-48 hours.'
            ];
        } else {
            $prep_items = [
                'Avoid facial treatments, chemical peels, or laser procedures for 2 weeks prior.',
                'Arrive with clean skin, free of heavy makeup, lotions, or perfumes.',
                'Stay well-hydrated and follow any specific pre-treatment advice.'
            ];
            $after_list = '';
            if ($aftercare_sec) {
                $after_list = $get_list_text($aftercare_sec['content']);
            }
            if (!empty($after_list)) {
                $after_items = explode("\n", $after_list);
            } else {
                $after_items = [
                    'Follow all specific post-treatment instructions provided by your practitioner.',
                    'Keep the treated area clean and hydrated with recommended skincare products.',
                    'Apply broad-spectrum sunscreen daily and avoid direct sun exposure.'
                ];
            }
        }
        update_post_meta($post_id, '_service_sec_d_prep', implode("\n", $prep_items));
        update_post_meta($post_id, '_service_sec_d_after', implode("\n", $after_items));

        // Section E
        if ($plan_sec) {
            update_post_meta($post_id, '_service_sec_e_title', esc_html($plan_sec['heading']));
            update_post_meta($post_id, '_service_sec_e_desc', $plan_sec['content']);
            if ($plan_image_id) {
                update_post_meta($post_id, '_service_sec_e_image_id', $plan_image_id);
            }
        }

        // Section F
        if ($faq_sec) {
            $faq_parts = preg_split('/<h3[^>]*>(.*?)<\/h3>/is', $faq_sec['content'], -1, PREG_SPLIT_DELIM_CAPTURE);
            $q_idx = 1;
            for ($j = 1; $j < count($faq_parts); $j += 2) {
                if ($q_idx > 6) break;
                $q = trim(strip_tags($faq_parts[$j]));
                $a = isset($faq_parts[$j+1]) ? trim($faq_parts[$j+1]) : '';
                if (empty($q)) continue;
                
                update_post_meta($post_id, '_service_faq_q' . $q_idx, $q);
                update_post_meta($post_id, '_service_faq_a' . $q_idx, $a);
                $q_idx++;
            }
        }
    }

    update_option('livia_services_migrated_v3', true);
}
add_action('admin_init', 'livia_migrate_service_data');


