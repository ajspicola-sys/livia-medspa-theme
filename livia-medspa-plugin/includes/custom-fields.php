<?php
/**
 * Livia Med Spa — Custom Fields (Meta Boxes)
 *
 * Native WordPress meta boxes for CPT custom fields.
 * No plugin dependencies (no ACF, no CMB2).
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

defined('ABSPATH') || exit;

/* ──────────────────────────────────────────────────────────────────────────
   1. SERVICE META BOXES
   ────────────────────────────────────────────────────────────────────────── */

function livia_service_meta_boxes() {
    add_meta_box(
        'livia_service_details',
        __('Service Details', 'livia-medspa'),
        'livia_service_details_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_service_meta_boxes');

function livia_service_details_callback($post) {
    wp_nonce_field('livia_service_nonce_action', 'livia_service_nonce');

    $short_desc  = get_post_meta($post->ID, '_livia_short_description', true);
    $price_range = get_post_meta($post->ID, '_livia_price_range', true);
    $duration    = get_post_meta($post->ID, '_livia_duration', true);
    $benefits    = get_post_meta($post->ID, '_livia_benefits', true);
    $faq         = get_post_meta($post->ID, '_livia_faq', true);
    $cta_link    = get_post_meta($post->ID, '_livia_cta_link', true);
    $cta_text    = get_post_meta($post->ID, '_livia_cta_text', true);

    if (!$benefits) $benefits = [];
    if (!$faq)      $faq      = [];
    ?>
    <style>
        .livia-field { margin-bottom: 20px; }
        .livia-field label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px; }
        .livia-field input[type="text"],
        .livia-field textarea { width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; }
        .livia-field textarea { min-height: 80px; }
        .livia-repeater-item { background: #f9f9f9; padding: 12px; margin-bottom: 8px; border-radius: 6px; border: 1px solid #e5e5e5; position: relative; }
        .livia-repeater-item .remove-item { position: absolute; top: 8px; right: 8px; background: #d94f4f; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 11px; padding: 2px 8px; }
        .livia-add-btn { background: #c9a96e; color: #fff; border: none; border-radius: 4px; padding: 6px 16px; cursor: pointer; font-size: 13px; margin-top: 8px; }
        .livia-add-btn:hover { background: #a88b4a; }
        .livia-row { display: flex; gap: 20px; }
        .livia-row > .livia-field { flex: 1; }
    </style>

    <div class="livia-row">
        <div class="livia-field">
            <label for="livia_short_description"><?php _e('Short Description', 'livia-medspa'); ?></label>
            <textarea id="livia_short_description" name="livia_short_description" placeholder="One-liner for service cards..."><?php echo esc_textarea($short_desc); ?></textarea>
        </div>
    </div>

    <div class="livia-row">
        <div class="livia-field">
            <label for="livia_price_range"><?php _e('Price Range', 'livia-medspa'); ?></label>
            <input type="text" id="livia_price_range" name="livia_price_range" value="<?php echo esc_attr($price_range); ?>" placeholder="e.g. Starting at $250">
        </div>
        <div class="livia-field">
            <label for="livia_duration"><?php _e('Treatment Duration', 'livia-medspa'); ?></label>
            <input type="text" id="livia_duration" name="livia_duration" value="<?php echo esc_attr($duration); ?>" placeholder="e.g. 30-60 minutes">
        </div>
    </div>

    <div class="livia-row">
        <div class="livia-field">
            <label for="livia_cta_link"><?php _e('CTA / Booking Link', 'livia-medspa'); ?></label>
            <input type="text" id="livia_cta_link" name="livia_cta_link" value="<?php echo esc_url($cta_link); ?>" placeholder="https://...">
        </div>
        <div class="livia-field">
            <label for="livia_cta_text"><?php _e('CTA Button Text', 'livia-medspa'); ?></label>
            <input type="text" id="livia_cta_text" name="livia_cta_text" value="<?php echo esc_attr($cta_text); ?>" placeholder="e.g. Book This Treatment">
        </div>
    </div>

    <!-- Benefits Repeater -->
    <div class="livia-field">
        <label><?php _e('Key Benefits', 'livia-medspa'); ?></label>
        <div id="livia-benefits-list">
            <?php foreach ($benefits as $i => $benefit) : ?>
                <div class="livia-repeater-item">
                    <input type="text" name="livia_benefits[]" value="<?php echo esc_attr($benefit); ?>" placeholder="e.g. Reduces fine lines and wrinkles">
                    <button type="button" class="remove-item" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="livia-add-btn" onclick="liviaAddBenefit()">+ Add Benefit</button>
    </div>

    <!-- FAQ Repeater -->
    <div class="livia-field">
        <label><?php _e('FAQ', 'livia-medspa'); ?></label>
        <div id="livia-faq-list">
            <?php foreach ($faq as $i => $item) : ?>
                <div class="livia-repeater-item">
                    <input type="text" name="livia_faq_q[]" value="<?php echo esc_attr($item['q'] ?? ''); ?>" placeholder="Question..." style="margin-bottom: 6px;">
                    <textarea name="livia_faq_a[]" placeholder="Answer..."><?php echo esc_textarea($item['a'] ?? ''); ?></textarea>
                    <button type="button" class="remove-item" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="livia-add-btn" onclick="liviaAddFaq()">+ Add FAQ</button>
    </div>

    <script>
    function liviaAddBenefit() {
        const list = document.getElementById('livia-benefits-list');
        const item = document.createElement('div');
        item.className = 'livia-repeater-item';
        item.innerHTML = '<input type="text" name="livia_benefits[]" placeholder="e.g. Reduces fine lines and wrinkles"><button type="button" class="remove-item" onclick="this.parentElement.remove()">×</button>';
        list.appendChild(item);
    }
    function liviaAddFaq() {
        const list = document.getElementById('livia-faq-list');
        const item = document.createElement('div');
        item.className = 'livia-repeater-item';
        item.innerHTML = '<input type="text" name="livia_faq_q[]" placeholder="Question..." style="margin-bottom: 6px;"><textarea name="livia_faq_a[]" placeholder="Answer..."></textarea><button type="button" class="remove-item" onclick="this.parentElement.remove()">×</button>';
        list.appendChild(item);
    }
    </script>
    <?php
}

function livia_save_service_meta($post_id) {
    if (!isset($_POST['livia_service_nonce']) || !wp_verify_nonce($_POST['livia_service_nonce'], 'livia_service_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $text_fields = [
        'livia_short_description' => '_livia_short_description',
        'livia_price_range'       => '_livia_price_range',
        'livia_duration'          => '_livia_duration',
        'livia_cta_text'          => '_livia_cta_text',
    ];

    foreach ($text_fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }

    if (isset($_POST['livia_cta_link'])) {
        update_post_meta($post_id, '_livia_cta_link', esc_url_raw($_POST['livia_cta_link']));
    }

    // Benefits (repeater)
    if (isset($_POST['livia_benefits'])) {
        $benefits = array_filter(array_map('sanitize_text_field', $_POST['livia_benefits']));
        update_post_meta($post_id, '_livia_benefits', $benefits);
    } else {
        delete_post_meta($post_id, '_livia_benefits');
    }

    // FAQ (repeater)
    if (isset($_POST['livia_faq_q']) && isset($_POST['livia_faq_a'])) {
        $faq = [];
        $questions = $_POST['livia_faq_q'];
        $answers   = $_POST['livia_faq_a'];
        for ($i = 0; $i < count($questions); $i++) {
            $q = sanitize_text_field($questions[$i]);
            $a = sanitize_textarea_field($answers[$i]);
            if ($q || $a) {
                $faq[] = ['q' => $q, 'a' => $a];
            }
        }
        update_post_meta($post_id, '_livia_faq', $faq);
    } else {
        delete_post_meta($post_id, '_livia_faq');
    }
}
add_action('save_post_service', 'livia_save_service_meta');

/* ──────────────────────────────────────────────────────────────────────────
   2. BEFORE & AFTER META BOXES
   ────────────────────────────────────────────────────────────────────────── */

function livia_ba_meta_boxes() {
    add_meta_box(
        'livia_ba_details',
        __('Before & After Details', 'livia-medspa'),
        'livia_ba_details_callback',
        'before_after',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_ba_meta_boxes');

function livia_ba_details_callback($post) {
    wp_nonce_field('livia_ba_nonce_action', 'livia_ba_nonce');

    $before_image = get_post_meta($post->ID, '_livia_before_image', true);
    $after_image  = get_post_meta($post->ID, '_livia_after_image', true);
    $description  = get_post_meta($post->ID, '_livia_ba_description', true);
    $service_id   = get_post_meta($post->ID, '_livia_related_service', true);

    // Get services for the dropdown
    $services = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);
    ?>
    <style>
        .livia-image-field { display: flex; gap: 20px; margin-bottom: 20px; }
        .livia-image-upload { flex: 1; }
        .livia-image-upload label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px; }
        .livia-image-preview { max-width: 300px; max-height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 8px; display: block; border: 1px solid #ddd; }
        .livia-upload-btn { background: #2271b1; color: #fff; border: none; border-radius: 4px; padding: 6px 16px; cursor: pointer; font-size: 13px; }
        .livia-remove-btn { background: #d94f4f; color: #fff; border: none; border-radius: 4px; padding: 6px 12px; cursor: pointer; font-size: 12px; margin-left: 8px; }
    </style>

    <div class="livia-image-field">
        <div class="livia-image-upload">
            <label><?php _e('Before Image', 'livia-medspa'); ?></label>
            <?php if ($before_image) : ?>
                <img src="<?php echo esc_url(wp_get_attachment_image_url($before_image, 'medium')); ?>" class="livia-image-preview" id="before-preview">
            <?php else : ?>
                <img src="" class="livia-image-preview" id="before-preview" style="display:none;">
            <?php endif; ?>
            <input type="hidden" name="livia_before_image" id="livia_before_image" value="<?php echo esc_attr($before_image); ?>">
            <button type="button" class="livia-upload-btn" onclick="liviaUploadImage('before')">Choose Image</button>
            <button type="button" class="livia-remove-btn" onclick="liviaRemoveImage('before')">Remove</button>
        </div>

        <div class="livia-image-upload">
            <label><?php _e('After Image', 'livia-medspa'); ?></label>
            <?php if ($after_image) : ?>
                <img src="<?php echo esc_url(wp_get_attachment_image_url($after_image, 'medium')); ?>" class="livia-image-preview" id="after-preview">
            <?php else : ?>
                <img src="" class="livia-image-preview" id="after-preview" style="display:none;">
            <?php endif; ?>
            <input type="hidden" name="livia_after_image" id="livia_after_image" value="<?php echo esc_attr($after_image); ?>">
            <button type="button" class="livia-upload-btn" onclick="liviaUploadImage('after')">Choose Image</button>
            <button type="button" class="livia-remove-btn" onclick="liviaRemoveImage('after')">Remove</button>
        </div>
    </div>

    <div class="livia-field" style="margin-bottom: 20px;">
        <label for="livia_related_service" style="display:block; font-weight: 600; margin-bottom: 5px; font-size: 13px;"><?php _e('Related Service', 'livia-medspa'); ?></label>
        <select name="livia_related_service" id="livia_related_service" style="width: 100%; max-width: 400px; padding: 8px;">
            <option value=""><?php _e('— Select a service —', 'livia-medspa'); ?></option>
            <?php foreach ($services as $service) : ?>
                <option value="<?php echo esc_attr($service->ID); ?>" <?php selected($service_id, $service->ID); ?>>
                    <?php echo esc_html($service->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="livia-field">
        <label for="livia_ba_description" style="display:block; font-weight: 600; margin-bottom: 5px; font-size: 13px;"><?php _e('Case Description', 'livia-medspa'); ?></label>
        <textarea id="livia_ba_description" name="livia_ba_description" style="width: 100%; min-height: 100px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Brief notes about this transformation..."><?php echo esc_textarea($description); ?></textarea>
    </div>

    <script>
    function liviaUploadImage(type) {
        const frame = wp.media({
            title: type === 'before' ? 'Select Before Image' : 'Select After Image',
            button: { text: 'Use This Image' },
            multiple: false,
        });
        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            document.getElementById('livia_' + type + '_image').value = attachment.id;
            const preview = document.getElementById(type + '-preview');
            preview.src = attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
            preview.style.display = 'block';
        });
        frame.open();
    }
    function liviaRemoveImage(type) {
        document.getElementById('livia_' + type + '_image').value = '';
        document.getElementById(type + '-preview').style.display = 'none';
    }
    </script>
    <?php
}

function livia_save_ba_meta($post_id) {
    if (!isset($_POST['livia_ba_nonce']) || !wp_verify_nonce($_POST['livia_ba_nonce'], 'livia_ba_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $int_fields = [
        'livia_before_image'   => '_livia_before_image',
        'livia_after_image'    => '_livia_after_image',
        'livia_related_service' => '_livia_related_service',
    ];

    foreach ($int_fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, absint($_POST[$field]));
        }
    }

    if (isset($_POST['livia_ba_description'])) {
        update_post_meta($post_id, '_livia_ba_description', sanitize_textarea_field($_POST['livia_ba_description']));
    }
}
add_action('save_post_before_after', 'livia_save_ba_meta');

/* ──────────────────────────────────────────────────────────────────────────
   3. TEAM MEMBER META BOXES
   ────────────────────────────────────────────────────────────────────────── */

function livia_team_meta_boxes() {
    add_meta_box(
        'livia_team_details',
        __('Team Member Details', 'livia-medspa'),
        'livia_team_details_callback',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_team_meta_boxes');

function livia_team_details_callback($post) {
    wp_nonce_field('livia_team_nonce_action', 'livia_team_nonce');

    $role           = get_post_meta($post->ID, '_livia_role', true);
    $certifications = get_post_meta($post->ID, '_livia_certifications', true);

    if (!$certifications) $certifications = [];
    ?>
    <div class="livia-field" style="margin-bottom: 20px;">
        <label for="livia_role" style="display:block; font-weight: 600; margin-bottom: 5px; font-size: 13px;"><?php _e('Title / Role', 'livia-medspa'); ?></label>
        <input type="text" id="livia_role" name="livia_role" value="<?php echo esc_attr($role); ?>" placeholder="e.g. Lead Aesthetician" style="width: 100%; max-width: 400px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
    </div>

    <div class="livia-field">
        <label style="display:block; font-weight: 600; margin-bottom: 5px; font-size: 13px;"><?php _e('Certifications', 'livia-medspa'); ?></label>
        <div id="livia-certs-list">
            <?php foreach ($certifications as $cert) : ?>
                <div class="livia-repeater-item" style="background: #f9f9f9; padding: 10px; margin-bottom: 6px; border-radius: 4px; border: 1px solid #e5e5e5; position: relative;">
                    <input type="text" name="livia_certifications[]" value="<?php echo esc_attr($cert); ?>" style="width: calc(100% - 50px); padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <button type="button" style="position: absolute; top: 8px; right: 8px; background: #d94f4f; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 11px; padding: 2px 8px;" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" style="background: #c9a96e; color: #fff; border: none; border-radius: 4px; padding: 6px 16px; cursor: pointer; font-size: 13px; margin-top: 6px;" onclick="liviaAddCert()">+ Add Certification</button>
    </div>

    <script>
    function liviaAddCert() {
        const list = document.getElementById('livia-certs-list');
        const item = document.createElement('div');
        item.className = 'livia-repeater-item';
        item.style.cssText = 'background: #f9f9f9; padding: 10px; margin-bottom: 6px; border-radius: 4px; border: 1px solid #e5e5e5; position: relative;';
        item.innerHTML = '<input type="text" name="livia_certifications[]" placeholder="e.g. Board Certified PA-C" style="width: calc(100% - 50px); padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px;"><button type="button" style="position: absolute; top: 8px; right: 8px; background: #d94f4f; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 11px; padding: 2px 8px;" onclick="this.parentElement.remove()">×</button>';
        list.appendChild(item);
    }
    </script>
    <?php
}

function livia_save_team_meta($post_id) {
    if (!isset($_POST['livia_team_nonce']) || !wp_verify_nonce($_POST['livia_team_nonce'], 'livia_team_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['livia_role'])) {
        update_post_meta($post_id, '_livia_role', sanitize_text_field($_POST['livia_role']));
    }

    if (isset($_POST['livia_certifications'])) {
        $certs = array_filter(array_map('sanitize_text_field', $_POST['livia_certifications']));
        update_post_meta($post_id, '_livia_certifications', $certs);
    } else {
        delete_post_meta($post_id, '_livia_certifications');
    }
}
add_action('save_post_team_member', 'livia_save_team_meta');

/* ──────────────────────────────────────────────────────────────────────────
   4. ENQUEUE MEDIA UPLOADER ON CPT SCREENS
   ────────────────────────────────────────────────────────────────────────── */

function livia_enqueue_admin_media($hook) {
    global $post_type;
    if (in_array($post_type, ['before_after', 'service', 'team_member']) && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'livia_enqueue_admin_media');
