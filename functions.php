<?php
/**
 * Livia Med Spa — Theme Functions
 */

// ── Theme Setup ────────────────────────────────────────────────────
function livia_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
}
add_action('after_setup_theme', 'livia_setup');

// ── Enqueue Assets ─────────────────────────────────────────────────
function livia_enqueue_styles() {
    // Google Fonts
    wp_enqueue_style(
        'livia-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // Main stylesheet with cache busting
    wp_enqueue_style('livia-style', get_stylesheet_uri(), ['livia-google-fonts'], '2.0.' . time());
}
add_action('wp_enqueue_scripts', 'livia_enqueue_styles');

// ── Auto-create Home Page ──────────────────────────────────────────
function livia_create_pages() {
    // Only run once
    if (get_option('livia_pages_created')) return;

    // Create Home page
    $home_id = wp_insert_post([
        'post_title'   => 'Home',
        'post_content' => '',
        'post_status'  => 'publish',
        'post_type'    => 'page',
    ]);

    if ($home_id && !is_wp_error($home_id)) {
        // Set as static front page
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    update_option('livia_pages_created', true);
}
add_action('after_switch_theme', 'livia_create_pages');
