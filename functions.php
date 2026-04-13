<?php
/**
 * Livia Med Spa — Theme Functions
 * 
 * Theme setup, menu registration, enqueues, and helpers.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

defined('ABSPATH') || exit;

/* ──────────────────────────────────────────────────────────────────────────
   1. CONSTANTS
   ────────────────────────────────────────────────────────────────────────── */

define('LIVIA_VERSION', '1.0.0');
define('LIVIA_DIR', get_template_directory());
define('LIVIA_URI', get_template_directory_uri());

/* ──────────────────────────────────────────────────────────────────────────
   2. THEME SETUP
   ────────────────────────────────────────────────────────────────────────── */

function livia_theme_setup() {
    // Enable featured images
    add_theme_support('post-thumbnails');

    // Add custom image sizes
    add_image_size('livia-hero', 1920, 1080, true);
    add_image_size('livia-card', 600, 400, true);
    add_image_size('livia-square', 600, 600, true);
    add_image_size('livia-portrait', 600, 800, true);
    add_image_size('livia-ba', 800, 600, true);

    // Title tag support
    add_theme_support('title-tag');

    // HTML5 markup
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Custom logo
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Wide & full alignment for Gutenberg
    add_theme_support('align-wide');

    // Editor styles
    add_theme_support('editor-styles');
    add_editor_style('style.css');

    // Responsive embeds
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Navigation', 'livia-medspa'),
        'footer'  => __('Footer Navigation', 'livia-medspa'),
        'mobile'  => __('Mobile Navigation', 'livia-medspa'),
    ]);
}
add_action('after_setup_theme', 'livia_theme_setup');

/* ──────────────────────────────────────────────────────────────────────────
   3. ENQUEUE STYLES & SCRIPTS
   ────────────────────────────────────────────────────────────────────────── */

function livia_enqueue_assets() {
    // --- CSS ---
    wp_enqueue_style(
        'livia-variables',
        LIVIA_URI . '/assets/css/variables.css',
        [],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-components',
        LIVIA_URI . '/assets/css/components.css',
        ['livia-variables'],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-animations',
        LIVIA_URI . '/assets/css/animations.css',
        ['livia-variables'],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-layout',
        LIVIA_URI . '/assets/css/layout.css',
        ['livia-components'],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-pages',
        LIVIA_URI . '/assets/css/pages.css',
        ['livia-layout'],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-inner-pages',
        LIVIA_URI . '/assets/css/inner-pages.css',
        ['livia-pages'],
        LIVIA_VERSION
    );

    wp_enqueue_style(
        'livia-responsive',
        LIVIA_URI . '/assets/css/responsive.css',
        ['livia-inner-pages'],
        LIVIA_VERSION
    );

    // Main theme stylesheet (must load last)
    wp_enqueue_style(
        'livia-style',
        get_stylesheet_uri(),
        ['livia-variables', 'livia-components', 'livia-animations', 'livia-responsive'],
        LIVIA_VERSION
    );

    // --- JS ---
    wp_enqueue_script(
        'livia-main',
        LIVIA_URI . '/assets/js/main.js',
        [],
        LIVIA_VERSION,
        true
    );

    wp_enqueue_script(
        'livia-animations',
        LIVIA_URI . '/assets/js/animations.js',
        [],
        LIVIA_VERSION,
        true
    );

    wp_enqueue_script(
        'livia-mobile-menu',
        LIVIA_URI . '/assets/js/mobile-menu.js',
        [],
        LIVIA_VERSION,
        true
    );

    // Only load slider JS where needed
    if (is_front_page() || is_singular('before_after') || is_post_type_archive('before_after')) {
        wp_enqueue_script(
            'livia-slider',
            LIVIA_URI . '/assets/js/slider.js',
            [],
            LIVIA_VERSION,
            true
        );
    }

    // Pass data to JS
    wp_localize_script('livia-main', 'liviaData', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'themeUrl' => LIVIA_URI,
        'nonce'    => wp_create_nonce('livia_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'livia_enqueue_assets');

/* ──────────────────────────────────────────────────────────────────────────
   4. WIDGET AREAS
   ────────────────────────────────────────────────────────────────────────── */

function livia_register_sidebars() {
    register_sidebar([
        'name'          => __('Blog Sidebar', 'livia-medspa'),
        'id'            => 'blog-sidebar',
        'description'   => __('Widgets for the blog sidebar.', 'livia-medspa'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="sidebar-widget__title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Footer Widgets', 'livia-medspa'),
        'id'            => 'footer-widgets',
        'description'   => __('Widgets for the footer area.', 'livia-medspa'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget__title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'livia_register_sidebars');

/* ──────────────────────────────────────────────────────────────────────────
   5. EXCERPT CUSTOMIZATION
   ────────────────────────────────────────────────────────────────────────── */

function livia_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'livia_excerpt_length');

function livia_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'livia_excerpt_more');

/* ──────────────────────────────────────────────────────────────────────────
   6. CUSTOM NAV WALKER (for mega menu support)
   ────────────────────────────────────────────────────────────────────────── */

class Livia_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $classes = ($depth === 0) ? 'nav__dropdown' : 'nav__dropdown-sub';
        $output .= "\n{$indent}<ul class=\"{$classes}\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes   = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'nav__item';
        
        // Check if item has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'nav__item--has-dropdown';
        }
        
        if ($item->current) {
            $classes[] = 'nav__item--active';
        }
        
        $class_names = implode(' ', array_filter($classes));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= $indent . '<li' . $class_names . '>';
        
        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'nav__link';
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= " {$attr}=\"{$value}\"";
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // Add dropdown arrow for parent items
        if (in_array('menu-item-has-children', (array) $item->classes) && $depth === 0) {
            $item_output .= ' <svg class="nav__arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/* ──────────────────────────────────────────────────────────────────────────
   7. HELPER FUNCTIONS
   ────────────────────────────────────────────────────────────────────────── */

/**
 * Get custom logo URL (or fallback text)
 */
function livia_get_logo() {
    if (has_custom_logo()) {
        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($logo_id, 'full');
        return '<a href="' . esc_url(home_url('/')) . '" class="site-logo" aria-label="Home"><img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '"></a>';
    }
    return '<a href="' . esc_url(home_url('/')) . '" class="site-logo site-logo--text" aria-label="Home"><span class="site-logo__name">' . esc_html(get_bloginfo('name')) . '</span></a>';
}

/**
 * Get social media links (set in Customizer)
 */
function livia_get_social_links() {
    $platforms = ['instagram', 'facebook', 'tiktok', 'youtube', 'yelp'];
    $links = [];
    
    foreach ($platforms as $platform) {
        $url = get_theme_mod("livia_social_{$platform}", '');
        if ($url) {
            $links[$platform] = $url;
        }
    }
    
    return $links;
}

/**
 * SVG icon helper
 */
function livia_icon($name, $size = 20) {
    $icons = [
        'phone'     => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'mail'      => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
        'map-pin'   => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
        'clock'     => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'star'      => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
        'arrow-right' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        'chevron-up' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>',
        'instagram' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        'facebook'  => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
        'tiktok'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1v-3.49a6.37 6.37 0 0 0-.79-.05A6.34 6.34 0 0 0 3.15 15a6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V8.71a8.21 8.21 0 0 0 4.76 1.52V6.76a4.83 4.83 0 0 1-1-.07z"/></svg>',
        'youtube'   => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'yelp'      => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M20.16 12.594l-4.995 1.433c-.96.276-1.78-.8-1.28-1.68l2.68-4.708c.5-.88 1.88-.5 1.88.52v4.434zm-5.608 5.63l-1.834-4.827c-.364-.96.62-1.842 1.54-1.376l4.903 2.5c.92.47.66 1.83-.36 1.9l-4.25.804zm-4.546-1.38l4.2-2.756c.84-.548 1.78.34 1.48 1.28l-1.62 5.076c-.3.94-1.66.94-1.9-.02l-2.16-3.58zm-1.36-6.47l1.12 5.1c.22.98-.84 1.72-1.66 1.16l-4.38-3.04c-.82-.56-.46-1.86.5-1.82l4.42.6zm3.94-6.6l-.54 5.18c-.1.98-1.32 1.36-1.9.58l-3.12-4.18c-.58-.78.14-1.82 1.02-1.66l4.54 2.08z"/></svg>',
        'search'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
        'menu'      => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="15" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
        'close'     => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
        'dollar'    => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
    ];
    
    return isset($icons[$name]) ? $icons[$name] : '';
}

/* ──────────────────────────────────────────────────────────────────────────
   8. CUSTOMIZER SETTINGS
   ────────────────────────────────────────────────────────────────────────── */

function livia_customize_register($wp_customize) {
    // --- Contact Info Section ---
    $wp_customize->add_section('livia_contact', [
        'title'    => __('Contact Information', 'livia-medspa'),
        'priority' => 30,
    ]);

    $contact_fields = [
        'livia_phone'   => ['Phone Number',   '(813) 230-2219'],
        'livia_email'   => ['Email Address',   'support@liviamedspa.com'],
        'livia_address' => ['Studio Address',  '10043 N Dale Mabry Hwy, Tampa, FL 33618'],
        'livia_booking_url' => ['Booking URL', '#book'],
    ];

    foreach ($contact_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($id, [
            'label'   => __($label, 'livia-medspa'),
            'section' => 'livia_contact',
            'type'    => 'text',
        ]);
    }

    // --- Hours Section ---
    $wp_customize->add_section('livia_hours', [
        'title'    => __('Studio Hours', 'livia-medspa'),
        'priority' => 31,
    ]);

    $hours_fields = [
        'livia_hours_mw'  => ['Mon – Wed', '9am – 7pm'],
        'livia_hours_ts'  => ['Thu – Sat', '9am – 4pm'],
        'livia_hours_sun' => ['Sunday',    'Closed'],
    ];

    foreach ($hours_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($id, [
            'label'   => __($label, 'livia-medspa'),
            'section' => 'livia_hours',
            'type'    => 'text',
        ]);
    }

    // --- Social Media Section ---
    $wp_customize->add_section('livia_social', [
        'title'    => __('Social Media', 'livia-medspa'),
        'priority' => 32,
    ]);

    $social_fields = [
        'livia_social_instagram' => 'Instagram URL',
        'livia_social_facebook'  => 'Facebook URL',
        'livia_social_tiktok'    => 'TikTok URL',
        'livia_social_youtube'   => 'YouTube URL',
        'livia_social_yelp'      => 'Yelp URL',
    ];

    foreach ($social_fields as $id => $label) {
        $wp_customize->add_setting($id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control($id, [
            'label'   => __($label, 'livia-medspa'),
            'section' => 'livia_social',
            'type'    => 'url',
        ]);
    }

    // --- Hero Section ---
    $wp_customize->add_section('livia_hero', [
        'title'    => __('Homepage Hero', 'livia-medspa'),
        'priority' => 33,
    ]);

    $wp_customize->add_setting('livia_hero_heading', [
        'default'           => 'Look & feel your absolute best.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('livia_hero_heading', [
        'label'   => __('Hero Heading', 'livia-medspa'),
        'section' => 'livia_hero',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('livia_hero_subheading', [
        'default'           => 'Expert aesthetic treatments tailored to you. From Botox and fillers to medical-grade lasers, we customize every treatment to your unique skin and goals.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('livia_hero_subheading', [
        'label'   => __('Hero Subheading', 'livia-medspa'),
        'section' => 'livia_hero',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('livia_hero_bg', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'livia_hero_bg', [
        'label'     => __('Hero Background Image', 'livia-medspa'),
        'section'   => 'livia_hero',
        'mime_type' => 'image',
    ]));

    // --- Google Reviews Section ---
    $wp_customize->add_section('livia_reviews', [
        'title'    => __('Google Reviews', 'livia-medspa'),
        'priority' => 34,
    ]);

    $wp_customize->add_setting('livia_review_count', [
        'default'           => '67',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('livia_review_count', [
        'label'   => __('Number of Google Reviews', 'livia-medspa'),
        'section' => 'livia_reviews',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('livia_review_rating', [
        'default'           => '5.0',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('livia_review_rating', [
        'label'   => __('Google Rating', 'livia-medspa'),
        'section' => 'livia_reviews',
        'type'    => 'text',
    ]);
}
add_action('customize_register', 'livia_customize_register');

/* ──────────────────────────────────────────────────────────────────────────
   9. DISABLE GUTENBERG FOR CPTs (optional simple editor)
   ────────────────────────────────────────────────────────────────────────── */

function livia_disable_gutenberg_for_cpts($use_block_editor, $post_type) {
    $cpt_no_gutenberg = ['service', 'before_after', 'team_member'];
    if (in_array($post_type, $cpt_no_gutenberg)) {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'livia_disable_gutenberg_for_cpts', 10, 2);

/* ──────────────────────────────────────────────────────────────────────────
   10. BODY CLASSES
   ────────────────────────────────────────────────────────────────────────── */

function livia_body_classes($classes) {
    // Add page slug as class
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Home page
    if (is_front_page()) {
        $classes[] = 'is-home';
    }
    
    return $classes;
}
add_filter('body_class', 'livia_body_classes');

/* ──────────────────────────────────────────────────────────────────────────
   11. REMOVE UNNECESSARY WP HEAD OUTPUT
   ────────────────────────────────────────────────────────────────────────── */

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
