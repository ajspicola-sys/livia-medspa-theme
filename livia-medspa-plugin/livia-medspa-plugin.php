<?php
/**
 * Plugin Name:  Livia Med Spa — Content Types
 * Plugin URI:   https://liviamedspa.com
 * Description:  Registers custom post types (Services, Before & Afters, Team Members) and associated taxonomies for the Livia Med Spa website. Content types are in a plugin so they persist across theme changes.
 * Version:      1.0.0
 * Author:       Livia Med Spa
 * Author URI:   https://liviamedspa.com
 * Text Domain:  livia-medspa
 * License:      GPL v2 or later
 */

defined('ABSPATH') || exit;

define('LIVIA_PLUGIN_DIR', plugin_dir_path(__FILE__));

/* ──────────────────────────────────────────────────────────────────────────
   1. CUSTOM POST TYPES
   ────────────────────────────────────────────────────────────────────────── */

function livia_register_post_types() {

    // ── Services ────────────────────────────────────────────────────────────
    register_post_type('service', [
        'labels' => [
            'name'                  => __('Services', 'livia-medspa'),
            'singular_name'         => __('Service', 'livia-medspa'),
            'add_new'               => __('Add New Service', 'livia-medspa'),
            'add_new_item'          => __('Add New Service', 'livia-medspa'),
            'edit_item'             => __('Edit Service', 'livia-medspa'),
            'new_item'              => __('New Service', 'livia-medspa'),
            'view_item'             => __('View Service', 'livia-medspa'),
            'search_items'          => __('Search Services', 'livia-medspa'),
            'not_found'             => __('No services found', 'livia-medspa'),
            'not_found_in_trash'    => __('No services found in trash', 'livia-medspa'),
            'all_items'             => __('All Services', 'livia-medspa'),
            'menu_name'             => __('Services', 'livia-medspa'),
            'featured_image'        => __('Service Image', 'livia-medspa'),
            'set_featured_image'    => __('Set service image', 'livia-medspa'),
            'remove_featured_image' => __('Remove service image', 'livia-medspa'),
        ],
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'services', 'with_front' => false],
        'menu_icon'           => 'dashicons-heart',
        'menu_position'       => 5,
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        'show_in_rest'        => true,
        'rest_base'           => 'services',
        'publicly_queryable'  => true,
        'show_in_nav_menus'   => true,
    ]);

    // ── Before & Afters ─────────────────────────────────────────────────────
    register_post_type('before_after', [
        'labels' => [
            'name'                  => __('Before & Afters', 'livia-medspa'),
            'singular_name'         => __('Before & After', 'livia-medspa'),
            'add_new'               => __('Add New Before & After', 'livia-medspa'),
            'add_new_item'          => __('Add New Before & After', 'livia-medspa'),
            'edit_item'             => __('Edit Before & After', 'livia-medspa'),
            'new_item'              => __('New Before & After', 'livia-medspa'),
            'view_item'             => __('View Before & After', 'livia-medspa'),
            'search_items'          => __('Search Before & Afters', 'livia-medspa'),
            'not_found'             => __('No results found', 'livia-medspa'),
            'not_found_in_trash'    => __('No results found in trash', 'livia-medspa'),
            'all_items'             => __('All Before & Afters', 'livia-medspa'),
            'menu_name'             => __('Before & Afters', 'livia-medspa'),
            'featured_image'        => __('After Image', 'livia-medspa'),
            'set_featured_image'    => __('Set after image', 'livia-medspa'),
            'remove_featured_image' => __('Remove after image', 'livia-medspa'),
        ],
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'before-and-after', 'with_front' => false],
        'menu_icon'           => 'dashicons-format-gallery',
        'menu_position'       => 6,
        'supports'            => ['title', 'editor', 'thumbnail', 'revisions'],
        'show_in_rest'        => true,
        'rest_base'           => 'before-afters',
        'publicly_queryable'  => true,
        'show_in_nav_menus'   => true,
    ]);

    // ── Team Members ────────────────────────────────────────────────────────
    register_post_type('team_member', [
        'labels' => [
            'name'                  => __('Team Members', 'livia-medspa'),
            'singular_name'         => __('Team Member', 'livia-medspa'),
            'add_new'               => __('Add New Team Member', 'livia-medspa'),
            'add_new_item'          => __('Add New Team Member', 'livia-medspa'),
            'edit_item'             => __('Edit Team Member', 'livia-medspa'),
            'new_item'              => __('New Team Member', 'livia-medspa'),
            'view_item'             => __('View Team Member', 'livia-medspa'),
            'search_items'          => __('Search Team Members', 'livia-medspa'),
            'not_found'             => __('No team members found', 'livia-medspa'),
            'not_found_in_trash'    => __('No team members found in trash', 'livia-medspa'),
            'all_items'             => __('All Team Members', 'livia-medspa'),
            'menu_name'             => __('Team', 'livia-medspa'),
            'featured_image'        => __('Headshot', 'livia-medspa'),
            'set_featured_image'    => __('Set headshot', 'livia-medspa'),
            'remove_featured_image' => __('Remove headshot', 'livia-medspa'),
        ],
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => ['slug' => 'team', 'with_front' => false],
        'menu_icon'           => 'dashicons-groups',
        'menu_position'       => 7,
        'supports'            => ['title', 'editor', 'thumbnail', 'revisions'],
        'show_in_rest'        => true,
        'rest_base'           => 'team',
        'publicly_queryable'  => true,
        'show_in_nav_menus'   => false,
    ]);
}
add_action('init', 'livia_register_post_types');

/* ──────────────────────────────────────────────────────────────────────────
   2. CUSTOM TAXONOMIES
   ────────────────────────────────────────────────────────────────────────── */

function livia_register_taxonomies() {

    // ── Service Category ────────────────────────────────────────────────────
    register_taxonomy('service_category', ['service'], [
        'labels' => [
            'name'              => __('Service Categories', 'livia-medspa'),
            'singular_name'     => __('Service Category', 'livia-medspa'),
            'search_items'      => __('Search Categories', 'livia-medspa'),
            'all_items'         => __('All Categories', 'livia-medspa'),
            'parent_item'       => __('Parent Category', 'livia-medspa'),
            'parent_item_colon' => __('Parent Category:', 'livia-medspa'),
            'edit_item'         => __('Edit Category', 'livia-medspa'),
            'update_item'       => __('Update Category', 'livia-medspa'),
            'add_new_item'      => __('Add New Category', 'livia-medspa'),
            'new_item_name'     => __('New Category Name', 'livia-medspa'),
            'menu_name'         => __('Categories', 'livia-medspa'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'service-category', 'with_front' => false],
    ]);

    // ── Treatment Area ──────────────────────────────────────────────────────
    register_taxonomy('treatment_area', ['service', 'before_after'], [
        'labels' => [
            'name'              => __('Treatment Areas', 'livia-medspa'),
            'singular_name'     => __('Treatment Area', 'livia-medspa'),
            'search_items'      => __('Search Treatment Areas', 'livia-medspa'),
            'all_items'         => __('All Treatment Areas', 'livia-medspa'),
            'edit_item'         => __('Edit Treatment Area', 'livia-medspa'),
            'update_item'       => __('Update Treatment Area', 'livia-medspa'),
            'add_new_item'      => __('Add New Treatment Area', 'livia-medspa'),
            'new_item_name'     => __('New Treatment Area Name', 'livia-medspa'),
            'menu_name'         => __('Treatment Areas', 'livia-medspa'),
        ],
        'hierarchical'      => false,
        'public'            => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'treatment-area', 'with_front' => false],
    ]);
}
add_action('init', 'livia_register_taxonomies');

/* ──────────────────────────────────────────────────────────────────────────
   3. FLUSH REWRITE RULES ON ACTIVATION
   ────────────────────────────────────────────────────────────────────────── */

function livia_plugin_activation() {
    livia_register_post_types();
    livia_register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'livia_plugin_activation');

function livia_plugin_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'livia_plugin_deactivation');

/* ──────────────────────────────────────────────────────────────────────────
   4. INCLUDE CUSTOM FIELDS
   ────────────────────────────────────────────────────────────────────────── */

require_once LIVIA_PLUGIN_DIR . 'includes/custom-fields.php';
