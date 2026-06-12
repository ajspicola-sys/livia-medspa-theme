<?php
/**
 * LIVIA Med Spa — Performance
 * Asset loading and cache tuning: emoji/oEmbed removal, script and
 * style optimization, LiteSpeed UCSS whitelist, and auto cache purge.
 *
 * Split out of functions.php; load order is defined there.
 */

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


// ── Performance: Reduce heartbeat interval ─────────────────────────
function livia_heartbeat_settings($settings) {
    $settings['interval'] = 60;
    return $settings;
}
add_filter('heartbeat_settings', 'livia_heartbeat_settings');




// =============================================================================
// LITESPEED UCSS WHITELIST — protects JavaScript-toggled state classes
// ROOT CAUSE of the recurring "blank page" bug: LiteSpeed's Unused-CSS
// generator scans the static HTML and purges every rule whose class only
// appears via JavaScript after load (.is-visible, .is-open, .is-loaded, the
// carousel position classes, the JS-injected cookie banner, etc.). With
// .reveal{opacity:0} kept but .reveal.is-visible{opacity:1} purged, every
// reveal section below the hero rendered permanently invisible — no amount
// of JS class-juggling could fix it because the CSS rules no longer existed.
// This whitelist tells LiteSpeed/QUIC.cloud to always keep these selectors.
// =============================================================================
add_filter( 'litespeed_ucss_whitelist', function ( $list ) {
    return array_merge( (array) $list, [
        // Generic JS state toggles
        '.is-visible',
        '.is-open',
        '.is-active',
        '.is-scrolled',
        '.is-loaded',
        '.is-leaving',
        '.has-scroll-lock',
        '.modal-open',
        '.reveal-active',
        // Carousel position states (set by the services carousel JS)
        '.is-prev',
        '.is-next',
        '.is-far-prev',
        '.is-far-next',
        // Elements created entirely by JavaScript (absent from static HTML)
        '.cookie-banner',
        '.ba-modal',
        '.gallery-card__expand',
    ] );
} );


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
    $watch = array_merge(
        [
            $theme_dir . '/functions.php',
            $theme_dir . '/style.css',
            $theme_dir . '/front-page.php',
            $theme_dir . '/footer.php',
            $theme_dir . '/header.php',
        ],
        glob( $theme_dir . '/inc/*.php' ) ?: []
    );

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

    // 2b. Force UCSS regeneration so stale purged-CSS files are rebuilt
    //     with the litespeed_ucss_whitelist applied (no-op if hook absent)
    do_action( 'litespeed_purge_ucss' );

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


