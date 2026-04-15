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

// ── Auto-create All Pages ──────────────────────────────────────────
function livia_create_pages() {
    if (get_option('livia_pages_created_v2')) return;

    $pages = [
        'Home'           => '',
        'About'          => '',
        'Team'           => '',
        'Mission'        => '',
        'Values'         => '',
        'Contact'        => '',
        'Before After'   => '',
        'Careers'        => '',
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

    update_option('livia_pages_created_v2', true);
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
