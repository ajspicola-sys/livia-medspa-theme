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

// ── Performance: Make only Google Fonts non-render-blocking ───────────
// The main stylesheet MUST be render-blocking to prevent FOUC.
// Google Fonts can safely load async since system fonts render as fallback.
function livia_async_styles($html, $handle) {
    // Only defer Google Fonts — NOT the main theme stylesheet
    if ( $handle === 'livia-google-fonts' && !is_admin() ) {
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

    // Preload the most critical font files (the weights used above the fold)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/cormorantgaramond/v16/co3YmX5slCNuHLi8bLeY9MK7whWMhyjYqXtK.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmsans/v15/rP2tp2ywxg089UriI5-g4vlH9VoD8CmcqZG40F9JadbnoET0.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action('wp_head', 'livia_resource_hints', 1);

// ── Performance: External image proxy & WebP cache ─────────────────
// Fetches third-party images (e.g. Ageless AI before/after), resizes to
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
        'headers'   => [ 'User-Agent' => 'Mozilla/5.0 (compatible; LiviaMedSpa/1.0)' ],
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

// ── SEO: LocalBusiness schema on every page ─────────────────────────
// Outputs on ALL pages (not just homepage) so Google gets business signals
// site-wide. Service pages additionally get a Service schema block.
function livia_schema_markup() {
    // ── LocalBusiness / MedicalBusiness — every page ─────────────
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'MedicalBusiness',
        'name'        => 'Livia Med Spa',
        'description' => "Tampa's premier destination for advanced aesthetics — expert Botox, fillers, laser treatments, and medical-grade skincare.",
        'url'         => esc_url(home_url('/')),
        'telephone'   => '+18132302219',
        'address'     => [
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
        'openingHours' => ['Mo-We 09:00-19:00', 'Th-Sa 09:00-16:00'],
        'priceRange'   => '$$-$$$',
        'image'        => 'https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png',
        'sameAs'       => [
            'https://www.facebook.com/p/Livia-Med-Spa-61561610168278/',
            'https://www.instagram.com/liviamedspa/',
        ],
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5',
            'reviewCount' => '70',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // ── Service schema — service CPT pages only ───────────────────
    if (is_singular('service')) {
        $post_id = get_the_ID();
        $service_schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' treatment at Livia Med Spa in Tampa, FL.'),
            'provider'    => [
                '@type' => 'MedicalBusiness',
                'name'  => 'Livia Med Spa',
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
    if ( get_option('livia_privacy_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('privacy-policy') ) {
        wp_insert_post([
            'post_title'   => 'Privacy Policy',
            'post_name'    => 'privacy-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_privacy_page_created_v1', true);
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
<p>One of the most common questions we hear at Livia Med Spa is: "Should I get Botox or fillers?" While both are injectable treatments that can help you look younger, they work in fundamentally different ways.</p>

<h3>Botox: The Wrinkle Relaxer</h3>
<p>Botox (and similar neuromodulators like Dysport and Jeuveau) works by temporarily relaxing the muscles that cause dynamic wrinkles — think forehead lines, crow\'s feet, and frown lines between the brows. It\'s ideal for wrinkles that appear when you make facial expressions.</p>

<h3>Dermal Fillers: The Volume Restorer</h3>
<p>Fillers, on the other hand, work by adding volume beneath the skin\'s surface. They\'re perfect for plumping lips, restoring lost cheek volume, smoothing nasolabial folds, and enhancing facial contours. Popular brands include Juvéderm and Restylane.</p>

<h3>Which Should You Choose?</h3>
<p>The answer depends on your specific concerns. Many of our clients at Livia Med Spa benefit from a combination of both treatments — what we call a "liquid facelift." During your complimentary consultation, our expert injectors will create a customized treatment plan tailored to your unique facial anatomy and goals.</p>

<p><strong>Ready to find out which treatment is right for you?</strong> Book a free consultation at Livia Med Spa today.</p>',
        ],
        [
            'title'    => 'The Ultimate Guide to Medical-Grade Skincare',
            'category' => 'Skincare',
            'excerpt'  => 'Why medical-grade products outperform drugstore brands and how to build a results-driven skincare routine.',
            'content'  => '<h2>Why Medical-Grade Matters</h2>
<p>Not all skincare is created equal. While drugstore products can provide basic hydration and sun protection, medical-grade skincare is formulated with higher concentrations of active ingredients that penetrate deeper into the skin for visible, lasting results.</p>

<h3>Key Differences</h3>
<p>Medical-grade products, like those from ZO Skin Health (which we carry at Livia Med Spa), are backed by clinical research and contain pharmaceutical-grade ingredients. They\'re designed to target specific skin concerns at the cellular level — something over-the-counter products simply can\'t match.</p>

<h3>Building Your Routine</h3>
<p>A solid medical-grade skincare routine includes four essential steps:</p>
<ul>
<li><strong>Cleanser</strong> — Remove impurities without stripping your skin</li>
<li><strong>Active Treatment</strong> — Target specific concerns (retinol, vitamin C, etc.)</li>
<li><strong>Moisturizer</strong> — Lock in hydration and protect the skin barrier</li>
<li><strong>Sunscreen</strong> — The single most important anti-aging product you can use</li>
</ul>

<p>Our providers at Livia Med Spa can analyze your skin and recommend the exact products you need. No guesswork, no wasted money on products that don\'t work.</p>',
        ],
        [
            'title'    => 'What to Expect at Your First Med Spa Visit',
            'category' => 'Treatments',
            'excerpt'  => 'A complete walkthrough of your consultation, treatment, and aftercare at Livia Med Spa — so you know exactly what to expect.',
            'content'  => '<h2>Your First Visit, Demystified</h2>
<p>If you\'ve never been to a med spa before, it\'s completely normal to feel a mix of excitement and nervousness. At Livia Med Spa, we\'ve designed every step of the experience to make you feel comfortable, informed, and cared for.</p>

<h3>Step 1: The Consultation</h3>
<p>Every journey starts with a free, no-pressure consultation. You\'ll meet with one of our expert providers to discuss your goals, concerns, and medical history. We\'ll examine your skin and recommend treatments that align with your budget and expectations.</p>

<h3>Step 2: Your Treatment</h3>
<p>On treatment day, you\'ll be welcomed into our luxury treatment suite. Depending on the procedure, the process can take anywhere from 15 minutes (for Botox) to 60 minutes (for a Glo2Facial or microneedling). Most treatments are minimally invasive with little to no downtime.</p>

<h3>Step 3: Aftercare</h3>
<p>We\'ll provide clear aftercare instructions and schedule any follow-up appointments. Our team is always available by phone or text if you have questions during your recovery.</p>

<p><strong>Ready to take the first step?</strong> Book your complimentary consultation at Livia Med Spa today.</p>',
        ],
        [
            'title'    => '5 Anti-Aging Treatments That Actually Work',
            'category' => 'Beauty Tips',
            'excerpt'  => 'Cut through the noise — these are the five proven anti-aging treatments our providers recommend most.',
            'content'  => '<h2>Evidence-Based Anti-Aging</h2>
<p>The beauty industry is full of promises, but only a handful of treatments deliver scientifically proven results. Here are the five anti-aging treatments we recommend most at Livia Med Spa.</p>

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
<p>Our custom IV drips at Livia Med Spa are formulated with skin-boosting nutrients including:</p>
<ul>
<li><strong>Vitamin C</strong> — A powerful antioxidant that brightens skin and supports collagen production</li>
<li><strong>Glutathione</strong> — The "master antioxidant" that detoxifies and promotes an even, luminous complexion</li>
<li><strong>B-Complex Vitamins</strong> — Essential for cellular repair and energy production</li>
<li><strong>Zinc</strong> — Supports skin healing and reduces inflammation</li>
</ul>

<h3>Beyond Skin Benefits</h3>
<p>IV therapy also boosts energy, strengthens immunity, and helps with recovery after intense workouts or travel. Many of our clients schedule regular drips as part of their overall wellness routine.</p>

<p><strong>Try it yourself.</strong> Book an IV therapy session at Livia Med Spa and feel the difference within hours.</p>',
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

<p><strong>Want that Tampa glow?</strong> Book your Glo2Facial at Livia Med Spa — or host a Glo2Facial Party with your friends!</p>',
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
            border-color: #AC13F9;
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
            color: #AC13F9;
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
    // Homepage
    if (is_front_page()) {
        $title['title'] = 'Medical Spa in Tampa, FL';
        $title['site']  = 'Livia Med Spa';
        return $title;
    }
    // Service pages: "Botox in Tampa, FL | Livia Med Spa"
    if (is_singular('service')) {
        $custom = get_post_meta(get_the_ID(), '_livia_seo_title', true);
        $title['title'] = !empty($custom) ? $custom : get_the_title() . ' in Tampa, FL';
        $title['site']  = 'Livia Med Spa';
        return $title;
    }
    // Product pages
    if (is_singular('product')) {
        $title['title'] = get_the_title() . ' | Medical-Grade Skincare';
        $title['site']  = 'Livia Med Spa';
        return $title;
    }
    // All other singular pages — use custom SEO title if set
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

// ── Disable XML-RPC for security ──────────────────────────────────
add_filter('xmlrpc_enabled', '__return_false');

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

    $subject = '✨ New Message — Livia Med Spa Website';

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
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,169,110,0.9);">Livia Med Spa</p>
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
            <p style="margin:0;font-size:11px;color:rgba(240,235,227,0.4);letter-spacing:1px;">Livia Med Spa &middot; Tampa, FL &middot; <a href="https://liviamedspa.com" style="color:rgba(172,19,249,0.7);text-decoration:none;">liviamedspa.com</a></p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';
}

// ── Livia Settings Page (Admin Dashboard) ──────────────────────────
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
            <span style="font-size:1.4rem;">✨</span> Livia Med Spa — Settings
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
        'Livia Med Spa Settings',
        '✨ Livia Settings',
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
}


// -- Service Page Extras � Video & Benefits Meta Box ----------------
add_action('add_meta_boxes', 'livia_service_extras_meta_box');
function livia_service_extras_meta_box() {
    add_meta_box('livia_service_extras','?? Video & Key Benefits','livia_service_extras_html','service','normal','high');
}
function livia_service_extras_html($post) {
    wp_nonce_field('livia_service_extras', 'livia_service_extras_nonce');
    $video    = get_post_meta($post->ID, '_service_video', true);
    $benefits = get_post_meta($post->ID, '_service_benefits', true);
    echo '<table class="form-table" style="width:100%">';
    echo '<tr><th style="width:160px;padding:12px 0;vertical-align:top"><label for="_service_video"><strong>?? Video URL</strong></label></th>';
    echo '<td><input type="url" id="_service_video" name="_service_video" value="' . esc_attr($video) . '" style="width:100%;padding:6px 10px;border:1px solid #ddd;border-radius:4px" placeholder="https://youtube.com/watch?v=...">';
    echo '<p style="color:#666;font-size:12px;margin:4px 0 0">Paste a YouTube or Vimeo URL. Leave blank to hide the video section.</p></td></tr>';
    echo '<tr><th style="padding:12px 0;vertical-align:top"><label for="_service_benefits"><strong>? Key Benefits</strong></label></th>';
    echo '<td><textarea id="_service_benefits" name="_service_benefits" rows="6" style="width:100%;padding:6px 10px;border:1px solid #ddd;border-radius:4px;font-family:inherit" placeholder="No pain, no downtime&#10;Results visible after 1 session">' . esc_textarea($benefits) . '</textarea>';
    echo '<p style="color:#666;font-size:12px;margin:4px 0 0">One benefit per line. Leave blank to hide the benefits section.</p></td></tr>';
    echo '</table>';
}
add_action('save_post_service', 'livia_save_service_extras');
function livia_save_service_extras($post_id) {
    if (!isset($_POST['livia_service_extras_nonce']) || !wp_verify_nonce($_POST['livia_service_extras_nonce'], 'livia_service_extras')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['_service_video'])) update_post_meta($post_id, '_service_video', esc_url_raw($_POST['_service_video']));
    if (isset($_POST['_service_benefits'])) update_post_meta($post_id, '_service_benefits', sanitize_textarea_field($_POST['_service_benefits']));
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
    echo '<strong>?? Livia Med Spa Theme</strong> � ';
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
            echo '<div class="notice notice-error"><p><strong>Livia Importer:</strong> demo-content/content.xml not found.</p></div>';
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
    echo '? <strong>Livia Demo Content imported successfully!</strong> ';
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
    echo '<h1>?? Livia Demo Content Importer</h1>';
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
// livia_cached_image_url()
// Sideloads a remote image into WP media library and caches the local URL.
// Falls back to the original URL gracefully so the page never goes blank.
// =============================================================================
if ( ! function_exists( 'livia_cached_image_url' ) ) {
    function livia_cached_image_url( string $url ): string {
        if ( empty( $url ) ) { return ''; }
        $cache_key = 'livia_img_' . md5( $url );
        $cached = get_transient( $cache_key );
        if ( false !== $cached ) { return $cached; }
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $tmp = download_url( $url );
        if ( is_wp_error( $tmp ) ) {
            set_transient( $cache_key, $url, HOUR_IN_SECONDS );
            return $url;
        }
        $file_array = [ 'name' => wp_basename( $url ), 'tmp_name' => $tmp ];
        $attachment_id = media_handle_sideload( $file_array, 0 );
        if ( is_wp_error( $attachment_id ) ) {
            @unlink( $tmp );
            set_transient( $cache_key, $url, HOUR_IN_SECONDS );
            return $url;
        }
        $local_url = wp_get_attachment_url( $attachment_id ) ?: $url;
        set_transient( $cache_key, $local_url, 30 * DAY_IN_SECONDS );
        return $local_url;
    }
}
