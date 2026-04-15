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
    // Auto cache-bust: uses file modification time so CSS always refreshes on deploy
    $theme_version = filemtime(get_stylesheet_directory() . '/style.css');

    // Google Fonts — single optimized request with display=swap
    wp_enqueue_style(
        'livia-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // Main stylesheet — version auto-updates when file changes
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

// ── Flush rewrite rules on theme activation ────────────────────────
function livia_rewrite_flush() {
    livia_register_services();
    livia_register_team();
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

// ════════════════════════════════════════════════════════════════════════
// BUILT-IN SEO META BOX — edit SEO title, description & OG image
// directly from the WordPress editor on every page/post/service
// ════════════════════════════════════════════════════════════════════════

// ── Register the meta box on all editable post types ───────────────
function livia_seo_meta_box() {
    $post_types = ['post', 'page', 'service'];
    foreach ($post_types as $pt) {
        add_meta_box(
            'livia_seo_meta',
            '🔍 SEO Settings',
            'livia_seo_meta_html',
            $pt,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'livia_seo_meta_box');

// ── Render the meta box HTML ───────────────────────────────────────
function livia_seo_meta_html($post) {
    wp_nonce_field('livia_seo_meta', 'livia_seo_nonce');

    $seo_title = get_post_meta($post->ID, '_livia_seo_title', true);
    $seo_desc  = get_post_meta($post->ID, '_livia_seo_desc', true);
    $og_image  = get_post_meta($post->ID, '_livia_og_image', true);
    ?>
    <style>
        .livia-seo-box { padding: 12px 0; }
        .livia-seo-field { margin-bottom: 18px; }
        .livia-seo-field label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 6px;
            color: #1d2327;
        }
        .livia-seo-field input,
        .livia-seo-field textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            transition: border-color 0.2s;
        }
        .livia-seo-field input:focus,
        .livia-seo-field textarea:focus {
            border-color: #c9a96e;
            outline: none;
            box-shadow: 0 0 0 2px rgba(201,169,110,0.15);
        }
        .livia-seo-hint {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }
        .livia-seo-counter {
            font-size: 12px;
            float: right;
            margin-top: 4px;
            font-weight: 500;
        }
        .livia-seo-counter.is-warn { color: #dba617; }
        .livia-seo-counter.is-over { color: #dc3232; }
        .livia-seo-counter.is-good { color: #46b450; }
        .livia-seo-preview {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 16px 20px;
            margin-top: 12px;
        }
        .livia-seo-preview__label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #c9a96e;
            margin-bottom: 8px;
        }
        .livia-seo-preview__title {
            font-size: 18px;
            font-weight: 400;
            color: #1a0dab;
            line-height: 1.3;
            margin-bottom: 4px;
        }
        .livia-seo-preview__url {
            font-size: 13px;
            color: #006621;
            margin-bottom: 4px;
        }
        .livia-seo-preview__desc {
            font-size: 13px;
            color: #545454;
            line-height: 1.5;
        }
    </style>

    <div class="livia-seo-box">
        <!-- SEO Title -->
        <div class="livia-seo-field">
            <label for="livia_seo_title">SEO Title</label>
            <input type="text"
                   id="livia_seo_title"
                   name="livia_seo_title"
                   value="<?php echo esc_attr($seo_title); ?>"
                   placeholder="<?php echo esc_attr($post->post_title . ' — Livia Med Spa'); ?>"
                   maxlength="120">
            <span class="livia-seo-hint">Recommended: 50–60 characters. Leave blank to use default.</span>
            <span class="livia-seo-counter" id="seo-title-counter">0/60</span>
        </div>

        <!-- Meta Description -->
        <div class="livia-seo-field">
            <label for="livia_seo_desc">Meta Description</label>
            <textarea id="livia_seo_desc"
                      name="livia_seo_desc"
                      rows="3"
                      placeholder="A brief summary for search engines..."
                      maxlength="320"><?php echo esc_textarea($seo_desc); ?></textarea>
            <span class="livia-seo-hint">Recommended: 120–160 characters.</span>
            <span class="livia-seo-counter" id="seo-desc-counter">0/160</span>
        </div>

        <!-- OG Image -->
        <div class="livia-seo-field">
            <label for="livia_og_image">Social Share Image URL</label>
            <input type="url"
                   id="livia_og_image"
                   name="livia_og_image"
                   value="<?php echo esc_attr($og_image); ?>"
                   placeholder="https://liviamedspa.com/wp-content/uploads/...">
            <span class="livia-seo-hint">Image shown when shared on Facebook, Twitter, etc. Ideal size: 1200×630px.</span>
        </div>

        <!-- Live Google Preview -->
        <div class="livia-seo-preview">
            <div class="livia-seo-preview__label">Google Search Preview</div>
            <div class="livia-seo-preview__title" id="seo-preview-title">
                <?php echo esc_html($seo_title ?: $post->post_title . ' — Livia Med Spa'); ?>
            </div>
            <div class="livia-seo-preview__url">
                <?php echo esc_url(get_permalink($post->ID)); ?>
            </div>
            <div class="livia-seo-preview__desc" id="seo-preview-desc">
                <?php echo esc_html($seo_desc ?: 'Add a meta description to control what appears here in search results.'); ?>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var titleInput = document.getElementById('livia_seo_title');
        var descInput  = document.getElementById('livia_seo_desc');
        var titleCounter = document.getElementById('seo-title-counter');
        var descCounter  = document.getElementById('seo-desc-counter');
        var previewTitle = document.getElementById('seo-preview-title');
        var previewDesc  = document.getElementById('seo-preview-desc');
        var defaultTitle = <?php echo json_encode($post->post_title . ' — Livia Med Spa'); ?>;

        function updateCounter(input, counter, ideal) {
            var len = input.value.length;
            counter.textContent = len + '/' + ideal;
            counter.className = 'livia-seo-counter ' +
                (len === 0 ? '' : len <= ideal ? 'is-good' : len <= ideal * 1.2 ? 'is-warn' : 'is-over');
        }

        function updatePreview() {
            previewTitle.textContent = titleInput.value || defaultTitle;
            previewDesc.textContent = descInput.value || 'Add a meta description to control what appears here in search results.';
        }

        titleInput.addEventListener('input', function() {
            updateCounter(titleInput, titleCounter, 60);
            updatePreview();
        });
        descInput.addEventListener('input', function() {
            updateCounter(descInput, descCounter, 160);
            updatePreview();
        });

        // Initial count
        updateCounter(titleInput, titleCounter, 60);
        updateCounter(descInput, descCounter, 160);
    })();
    </script>
    <?php
}

// ── Save the SEO meta fields ───────────────────────────────────────
function livia_save_seo_meta($post_id) {
    if (!isset($_POST['livia_seo_nonce']) || !wp_verify_nonce($_POST['livia_seo_nonce'], 'livia_seo_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['livia_seo_title', 'livia_seo_desc', 'livia_og_image'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'livia_save_seo_meta');

// ── Override the <title> tag with custom SEO title ─────────────────
function livia_custom_title($title) {
    if (is_singular()) {
        $custom = get_post_meta(get_the_ID(), '_livia_seo_title', true);
        if (!empty($custom)) {
            $title['title'] = $custom;
        }
    }
    return $title;
}
add_filter('document_title_parts', 'livia_custom_title');

// ── Output meta description & OG tags in <head> ───────────────────
function livia_seo_head_tags() {
    if (is_singular()) {
        $post_id = get_the_ID();
        $desc    = get_post_meta($post_id, '_livia_seo_desc', true);
        $og_img  = get_post_meta($post_id, '_livia_og_image', true);
        $title   = get_post_meta($post_id, '_livia_seo_title', true) ?: get_the_title();

        if (!empty($desc)) {
            echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
        }

        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink($post_id)) . '">' . "\n";
        echo '<meta property="og:site_name" content="Livia Med Spa">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";

        if (!empty($og_img)) {
            echo '<meta property="og:image" content="' . esc_url($og_img) . '">' . "\n";
            echo '<meta name="twitter:image" content="' . esc_url($og_img) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'livia_seo_head_tags', 5);
