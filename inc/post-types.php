<?php
/**
 * LIVIA Med Spa — Custom Post Types
 * Service, team member, product, and before/after post types plus
 * archive tweaks and rewrite flushing.
 *
 * Split out of functions.php; load order is defined there.
 */

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
            'menu_name'          => 'Services',
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
            'menu_name'          => 'Team',
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
            'menu_name'          => 'Products',
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


// ── Flush rewrite rules on theme activation ────────────────────────
function livia_rewrite_flush() {
    livia_register_services();
    livia_register_team();
    livia_register_products();
    livia_register_before_after();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'livia_rewrite_flush');


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
            'menu_name'          => 'Before & After',
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

