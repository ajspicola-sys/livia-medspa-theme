<?php
/**
 * Livia Med Spa — Theme Functions
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
    // Stable version hash for cache busting (change on deploy, not every page load)
    $theme_version = '2.1.0';

    // Google Fonts — single optimized request with display=swap
    wp_enqueue_style(
        'livia-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // Main stylesheet with stable version for caching
    wp_enqueue_style('livia-style', get_stylesheet_uri(), ['livia-google-fonts'], $theme_version);
}
add_action('wp_enqueue_scripts', 'livia_enqueue_styles');

// ── Performance: Make CSS non-render-blocking ──────────────────────
// Critical CSS is already inlined in header.php, so we can safely
// async-load both Google Fonts and the main stylesheet.
function livia_async_styles($html, $handle) {
    $async_handles = ['livia-google-fonts', 'livia-style'];
    if (in_array($handle, $async_handles) && !is_admin()) {
        // media="print" prevents render-blocking, onload swaps to "all"
        // noscript fallback ensures CSS loads without JS
        $html = str_replace(
            "media='all'",
            "media='print' onload=\"this.media='all'\"",
            $html
        );
        // Also handle double-quote variant
        $html = str_replace(
            'media="all"',
            'media="print" onload="this.media=\'all\'"',
            $html
        );
        // Add noscript fallback
        $noscript = '<noscript>' . str_replace(
            ["media='print'", 'media="print"', " onload=\"this.media='all'\"", " onload=\"this.media='all'\""],
            ["media='all'", 'media="all"', '', ''],
            $html
        ) . '</noscript>';
        $html .= $noscript;
    }
    return $html;
}
add_filter('style_loader_tag', 'livia_async_styles', 10, 2);

// ── Performance: Preload critical fonts & add resource hints ───────
function livia_resource_hints() {
    // DNS prefetch + preconnect for Google Fonts
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // DNS prefetch for external image CDN
    echo '<link rel="dns-prefetch" href="//liviamedspa.com">' . "\n";

    // Preload the most critical font files (the weights used above the fold)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/cormorantgaramond/v16/co3YmX5slCNuHLi8bLeY9MK7whWMhyjYqXtK.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmsans/v15/rP2tp2ywxg089UriI5-g4vlH9VoD8CmcqZG40F9JadbnoET0.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action('wp_head', 'livia_resource_hints', 1);

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

// ── Performance: Remove query strings from static resources ────────
function livia_remove_script_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'livia_remove_script_version', 9999);
add_filter('script_loader_src', 'livia_remove_script_version', 9999);

// ── Performance: Limit post revisions ──────────────────────────────
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

// ── SEO: Add Schema.org structured data ────────────────────────────
function livia_schema_markup() {
    if (is_front_page()) : ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MedicalBusiness",
    "name": "Livia Med Spa",
    "description": "Tampa's premier destination for advanced aesthetics — expert Botox, fillers, laser treatments, and medical-grade skincare.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+1-813-230-2219",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Tampa",
        "addressRegion": "FL",
        "postalCode": "33606",
        "addressCountry": "US"
    },
    "openingHours": "Mo-Sa 09:00-18:00",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "500"
    },
    "priceRange": "$$-$$$"
}
</script>
    <?php endif;
}
add_action('wp_head', 'livia_schema_markup', 99);

// ── Auto-create All Pages ──────────────────────────────────────────
function livia_create_pages() {
    if (get_option('livia_pages_created_v4')) return;

    $pages = [
        'Home'           => '',
        'About'          => '',
        'Team'           => '',
        'Mission'        => '',
        'Values'         => '',
        'Contact'        => '',
        'Before After'   => '',
        'Careers'        => '',
        'Parties'        => '',
        'Memberships'    => '',
        'Blog'           => '',
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

    update_option('livia_pages_created_v4', true);
}
add_action('after_switch_theme', 'livia_create_pages');

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

// ── Service custom fields (meta box) ───────────────────────────────
function livia_service_meta_boxes() {
    add_meta_box(
        'livia_service_details',
        'Service Details',
        'livia_service_meta_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_service_meta_boxes');

function livia_service_meta_html($post) {
    wp_nonce_field('livia_service_meta', 'livia_service_nonce');
    $icon     = get_post_meta($post->ID, '_service_icon', true);
    $price    = get_post_meta($post->ID, '_service_price', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    ?>
    <style>
        .livia-meta-row { display:flex; gap:1.5rem; margin-bottom:1rem; }
        .livia-meta-field { flex:1; }
        .livia-meta-field label { display:block; font-weight:600; margin-bottom:4px; }
        .livia-meta-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="livia-meta-row">
        <div class="livia-meta-field">
            <label for="service_icon">Icon (emoji)</label>
            <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="💉">
            <p class="description">Paste an emoji like 💉 ✨ 🔬 🧴 ⚡ 💎</p>
        </div>
        <div class="livia-meta-field">
            <label for="service_price">Starting Price</label>
            <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" placeholder="$250+">
        </div>
        <div class="livia-meta-field">
            <label for="service_duration">Duration</label>
            <input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" placeholder="30 min">
        </div>
    </div>
    <?php
}

function livia_save_service_meta($post_id) {
    if (!isset($_POST['livia_service_nonce']) || !wp_verify_nonce($_POST['livia_service_nonce'], 'livia_service_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['service_icon', 'service_price', 'service_duration'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_service', 'livia_save_service_meta');

// ── Flush rewrite rules on theme activation ────────────────────────
function livia_rewrite_flush() {
    livia_register_services();
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
