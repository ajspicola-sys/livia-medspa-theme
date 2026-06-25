<?php
/**
 * LIVIA Med Spa — Admin Meta Boxes
 * Editing UI for custom post types: team/product fields, service
 * sections editor, bottom photo, and before/after image pickers.
 *
 * Split out of functions.php; load order is defined there.
 */

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
    $website      = get_post_meta($post->ID, '_team_website', true);
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
    <div class="livia-team-row">
        <div class="livia-team-field">
            <label for="team_website">Personal Website (optional)</label>
            <input type="url" id="team_website" name="team_website" value="<?php echo esc_attr($website); ?>" placeholder="https://example.com">
            <p class="description">If filled in, a "Visit Website" button appears on this person's team card. Leave blank to hide it.</p>
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

    if (isset($_POST['team_website'])) {
        update_post_meta($post_id, '_team_website', esc_url_raw(trim($_POST['team_website'])));
    }
}
add_action('save_post_team_member', 'livia_save_team_meta');


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


// ── Service Bottom Photo Meta Box ──────────────────────────────────
function livia_service_bottom_photo_meta_box() {
    add_meta_box(
        'livia_service_bottom_photo',
        'Service Bottom Photo',
        'livia_service_bottom_photo_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_service_bottom_photo_meta_box');

function livia_service_bottom_photo_html($post) {
    wp_nonce_field('livia_service_bottom_photo_nonce_action', 'livia_service_bottom_photo_nonce');
    $photo_id = get_post_meta($post->ID, '_service_bottom_photo_id', true);
    $photo_url = '';
    if ($photo_id) {
        $photo_url = wp_get_attachment_url($photo_id);
    }
    ?>
    <div style="padding: 10px 0; text-align: center;">
        <input type="hidden" id="service_bottom_photo_id" name="service_bottom_photo_id" value="<?php echo esc_attr($photo_id); ?>">
        
        <div id="livia_bottom_photo_preview_container" style="margin-bottom: 15px; <?php echo empty($photo_url) ? 'display:none;' : ''; ?>">
            <img id="livia_bottom_photo_preview" src="<?php echo esc_url($photo_url); ?>" style="max-width:300px; max-height:200px; border:1px solid #ddd; border-radius:8px; padding:4px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
        </div>
        
        <div style="display:flex; justify-content:center; gap:10px;">
            <button type="button" class="button button-primary" id="livia_bottom_photo_upload_btn">
                <?php echo empty($photo_url) ? 'Upload / Choose Image' : 'Change Image'; ?>
            </button>
            <button type="button" class="button button-link-delete" id="livia_bottom_photo_remove_btn" style="<?php echo empty($photo_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                Remove Image
            </button>
        </div>
        <p class="description" style="margin-top:8px; text-align:center;">Choose a photo from your Media Library or upload a new one. It will be centered at the bottom of the service page in its natural dimensions.</p>
    </div>
    <?php
}

function livia_save_service_bottom_photo($post_id) {
    if (!isset($_POST['livia_service_bottom_photo_nonce']) || !wp_verify_nonce($_POST['livia_service_bottom_photo_nonce'], 'livia_service_bottom_photo_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['service_bottom_photo_id'])) {
        update_post_meta($post_id, '_service_bottom_photo_id', sanitize_text_field($_POST['service_bottom_photo_id']));
    }
}
add_action('save_post_service', 'livia_save_service_bottom_photo');

function livia_service_bottom_photo_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frame;
            $('#livia_bottom_photo_upload_btn').on('click', function(e) {
                e.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media({
                    title: 'Select Bottom Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });
                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#service_bottom_photo_id').val(attachment.id);
                    $('#livia_bottom_photo_preview').attr('src', attachment.url);
                    $('#livia_bottom_photo_preview_container').show();
                    $('#livia_bottom_photo_upload_btn').text('Change Image');
                    $('#livia_bottom_photo_remove_btn').show();
                });
                file_frame.open();
            });
            
            $('#livia_bottom_photo_remove_btn').on('click', function(e) {
                e.preventDefault();
                $('#service_bottom_photo_id').val('');
                $('#livia_bottom_photo_preview_container').hide();
                $('#livia_bottom_photo_preview').attr('src', '');
                $('#livia_bottom_photo_upload_btn').text('Upload / Choose Image');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_service_bottom_photo_admin_scripts');



// ── Before & After Image Meta Box ──────────────────────────────────
function livia_before_after_meta_box() {
    add_meta_box(
        'livia_before_after_images',
        'Before & After Images',
        'livia_before_after_meta_html',
        'before_after',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_before_after_meta_box');

function livia_before_after_meta_html($post) {
    wp_nonce_field('livia_before_after_nonce_action', 'livia_before_after_nonce');
    $before_id = get_post_meta($post->ID, '_before_image_id', true);
    $after_id  = get_post_meta($post->ID, '_after_image_id', true);
    
    $before_url = $before_id ? wp_get_attachment_url($before_id) : '';
    $after_url  = $after_id ? wp_get_attachment_url($after_id) : '';
    ?>
    <style>
        .livia-ba-row { display: flex; gap: 2rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .livia-ba-col { flex: 1; min-width: 280px; background: #fafafa; border: 1px solid #e5e5e5; border-radius: 8px; padding: 1.5rem; text-align: center; }
        .livia-ba-title { font-weight: 600; font-size: 1.1em; margin-top: 0; margin-bottom: 1rem; color: #23282d; }
        .livia-ba-preview-container { margin-bottom: 15px; min-height: 150px; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px dashed #ccc; border-radius: 6px; padding: 8px; }
        .livia-ba-preview { max-width: 100%; max-height: 180px; border-radius: 4px; object-fit: contain; }
        .livia-ba-placeholder { color: #aaa; font-style: italic; }
        .livia-ba-buttons { display: flex; justify-content: center; gap: 8px; }
    </style>
    <div class="livia-ba-row">
        <!-- Before Image Column -->
        <div class="livia-ba-col">
            <h3 class="livia-ba-title">Before Photo</h3>
            <input type="hidden" id="before_image_id" name="before_image_id" value="<?php echo esc_attr($before_id); ?>">
            <div class="livia-ba-preview-container">
                <img id="before_preview" src="<?php echo esc_url($before_url); ?>" style="<?php echo empty($before_url) ? 'display:none;' : ''; ?>" class="livia-ba-preview">
                <span id="before_placeholder" style="<?php echo !empty($before_url) ? 'display:none;' : ''; ?>" class="livia-ba-placeholder">No image selected (uses default placeholder)</span>
            </div>
            <div class="livia-ba-buttons">
                <button type="button" class="button button-primary ba-upload-btn" data-target="before">
                    <?php echo empty($before_url) ? 'Select Before Photo' : 'Change Photo'; ?>
                </button>
                <button type="button" class="button button-link-delete ba-remove-btn" data-target="before" style="<?php echo empty($before_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                    Remove
                </button>
            </div>
        </div>

        <!-- After Image Column -->
        <div class="livia-ba-col">
            <h3 class="livia-ba-title">After Photo</h3>
            <input type="hidden" id="after_image_id" name="after_image_id" value="<?php echo esc_attr($after_id); ?>">
            <div class="livia-ba-preview-container">
                <img id="after_preview" src="<?php echo esc_url($after_url); ?>" style="<?php echo empty($after_url) ? 'display:none;' : ''; ?>" class="livia-ba-preview">
                <span id="after_placeholder" style="<?php echo !empty($after_url) ? 'display:none;' : ''; ?>" class="livia-ba-placeholder">No image selected (uses default placeholder)</span>
            </div>
            <div class="livia-ba-buttons">
                <button type="button" class="button button-primary ba-upload-btn" data-target="after">
                    <?php echo empty($after_url) ? 'Select After Photo' : 'Change Photo'; ?>
                </button>
                <button type="button" class="button button-link-delete ba-remove-btn" data-target="after" style="<?php echo empty($after_url) ? 'display:none;' : ''; ?> color:#a00; font-weight:600; text-decoration:none;">
                    Remove
                </button>
            </div>
        </div>
    </div>

    <!-- Photo Credits Input Field -->
    <?php $credits = get_post_meta($post->ID, '_photo_credits', true); ?>
    <div style="margin-top: 1.5rem; background: #fafafa; border: 1px solid #e5e5e5; border-radius: 8px; padding: 1.5rem;">
        <label for="photo_credits" style="display: block; font-weight: 600; font-size: 1.1em; margin-bottom: 0.5rem; color: #23282d;">Photo / Case Credits (Optional)</label>
        <input type="text" id="photo_credits" name="photo_credits" value="<?php echo esc_attr($credits); ?>" class="regular-text" style="width: 100%; max-width: 500px;" placeholder="e.g. Dr. Jane Smith, MD or Courtesy of Partner Clinic">
        <p class="description">If you acquired these comparison photos from somewhere else, enter the credits here to display them on the gallery card.</p>
    </div>
    <?php
}

function livia_save_before_after_meta($post_id) {
    if (!isset($_POST['livia_before_after_nonce']) || !wp_verify_nonce($_POST['livia_before_after_nonce'], 'livia_before_after_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['before_image_id'])) {
        update_post_meta($post_id, '_before_image_id', sanitize_text_field($_POST['before_image_id']));
    }
    if (isset($_POST['after_image_id'])) {
        update_post_meta($post_id, '_after_image_id', sanitize_text_field($_POST['after_image_id']));
    }
    if (isset($_POST['photo_credits'])) {
        update_post_meta($post_id, '_photo_credits', sanitize_text_field($_POST['photo_credits']));
    }
}
add_action('save_post_before_after', 'livia_save_before_after_meta');

function livia_before_after_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'before_after') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frames = {};
            
            $('.ba-upload-btn').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                
                if (file_frames[target]) {
                    file_frames[target].open();
                    return;
                }
                
                file_frames[target] = wp.media({
                    title: 'Select ' + (target === 'before' ? 'Before' : 'After') + ' Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });
                
                file_frames[target].on('select', function() {
                    var attachment = file_frames[target].state().get('selection').first().toJSON();
                    $('#' + target + '_image_id').val(attachment.id);
                    $('#' + target + '_preview').attr('src', attachment.url).show();
                    $('#' + target + '_placeholder').hide();
                    $('button.ba-upload-btn[data-target="' + target + '"]').text('Change Photo');
                    $('button.ba-remove-btn[data-target="' + target + '"]').show();
                });
                
                file_frames[target].open();
            });
            
            $('.ba-remove-btn').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('#' + target + '_image_id').val('');
                $('#' + target + '_preview').hide().attr('src', '');
                $('#' + target + '_placeholder').show();
                $('button.ba-upload-btn[data-target="' + target + '"]').text('Select ' + (target === 'before' ? 'Before' : 'After') + ' Photo');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_before_after_admin_scripts');


// ── Service Page Custom Fields & UI Editor ──────────────────────────
function livia_register_service_meta_boxes() {
    add_meta_box(
        'livia_service_sections_layout',
        'Service Sections Layout (Custom Fields)',
        'livia_service_sections_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'livia_register_service_meta_boxes');

function livia_service_sections_html($post) {
    wp_nonce_field('livia_service_sections_nonce_action', 'livia_service_sections_nonce');

    // Retrieve current values
    $icon = get_post_meta($post->ID, '_service_icon', true) ?: '✨';
    $price = get_post_meta($post->ID, '_service_price', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $video = get_post_meta($post->ID, '_service_video', true);
    $external_url = get_post_meta($post->ID, '_service_external_url', true);

    $sec_a_title = get_post_meta($post->ID, '_service_sec_a_title', true);
    $sec_a_desc = get_post_meta($post->ID, '_service_sec_a_desc', true);
    $sec_a_checklist = get_post_meta($post->ID, '_service_sec_a_checklist', true);
    $sec_a_image_id = get_post_meta($post->ID, '_service_sec_a_image_id', true);

    $sec_b_title = get_post_meta($post->ID, '_service_sec_b_title', true);
    $sec_b_desc = get_post_meta($post->ID, '_service_sec_b_desc', true);
    $sec_b_image_id = get_post_meta($post->ID, '_service_sec_b_image_id', true);

    $sec_c_title = get_post_meta($post->ID, '_service_sec_c_title', true);
    $sec_c_desc = get_post_meta($post->ID, '_service_sec_c_desc', true);
    $sec_c_bg_image_id = get_post_meta($post->ID, '_service_sec_c_bg_image_id', true);

    $sec_d_prep = get_post_meta($post->ID, '_service_sec_d_prep', true);
    $sec_d_after = get_post_meta($post->ID, '_service_sec_d_after', true);

    $sec_e_title = get_post_meta($post->ID, '_service_sec_e_title', true);
    $sec_e_desc = get_post_meta($post->ID, '_service_sec_e_desc', true);
    $sec_e_image_id = get_post_meta($post->ID, '_service_sec_e_image_id', true);
    ?>
    <div class="livia-meta-container">
        <p class="description" style="margin-bottom:20px; font-size:13px; color:#50575e;">
            Fill in the sections below to build the alternating premium layout. <strong>Any section left completely blank (empty title/description) will not pop up on the page.</strong> If all fields are left empty, the page defaults back to using the standard post editor content.
        </p>

        <!-- General Info Section -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>General Metadata</span>
                <span class="livia-meta-badge">Badge & Header</span>
            </div>
            <div class="livia-meta-section-body" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_icon">Service Icon</label>
                    <input type="text" class="livia-meta-input-text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="e.g. ✨">
                    <div class="livia-meta-help">Emoji icon shown in badges/cards.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_price">Price Tag</label>
                    <input type="text" class="livia-meta-input-text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g. $250 or $12/unit">
                    <div class="livia-meta-help">Displayed in the page hero and badges.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_duration">Treatment Duration</label>
                    <input type="text" class="livia-meta-input-text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" placeholder="e.g. 30 mins or 1 hour">
                    <div class="livia-meta-help">Displayed in the page hero.</div>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_video">Video URL (Vimeo/YouTube)</label>
                    <input type="text" class="livia-meta-input-text" id="service_video" name="service_video" value="<?php echo esc_attr($video); ?>" placeholder="e.g. https://www.youtube.com/watch?v=...">
                    <div class="livia-meta-help">Will render a looping autoplay video in the hero area.</div>
                </div>
                <div class="livia-meta-row" style="grid-column:1 / -1;">
                    <label class="livia-meta-label" for="service_external_url">External Link (optional)</label>
                    <input type="url" class="livia-meta-input-text" id="service_external_url" name="service_external_url" value="<?php echo esc_attr($external_url); ?>" placeholder="e.g. https://elliemd.com/weight-loss/?bp=angiespicola">
                    <div class="livia-meta-help">If filled in, clicking this service (in the menu and on the services page) opens this URL in a new tab instead of the internal service page. Leave blank for a normal service.</div>
                </div>
            </div>
        </div>

        <!-- Section A: Areas Treated -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section A: Areas Treated</span>
                <span class="livia-meta-badge">Section 1 (Left Text, Right Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_a_title" name="service_sec_a_title" value="<?php echo esc_attr($sec_a_title); ?>" placeholder="e.g. Areas Treated with Dermal Fillers">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_a_desc" name="service_sec_a_desc" placeholder="Describe the treatment areas..."><?php echo esc_textarea($sec_a_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_a_checklist">Checklist (One item per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_a_checklist" name="service_sec_a_checklist" style="height:80px;" placeholder="Cheeks&#10;Lips&#10;Jawline"><?php echo esc_textarea($sec_a_checklist); ?></textarea>
                    <div class="livia-meta-help">These will show with purple checkmarks below the paragraph.</div>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $a_img_url = $sec_a_image_id ? wp_get_attachment_url($sec_a_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_a_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_a_image_id" value="<?php echo esc_attr($sec_a_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($a_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($a_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($a_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($a_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section B: How It Works -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section B: How It Works</span>
                <span class="livia-meta-badge">Section 2 (Right Text, Left Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_b_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_b_title" name="service_sec_b_title" value="<?php echo esc_attr($sec_b_title); ?>" placeholder="e.g. How It Works">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_b_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_b_desc" name="service_sec_b_desc" placeholder="Explain the scientific mechanism or procedure..."><?php echo esc_textarea($sec_b_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $b_img_url = $sec_b_image_id ? wp_get_attachment_url($sec_b_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_b_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_b_image_id" value="<?php echo esc_attr($sec_b_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($b_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($b_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($b_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($b_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section C: Expectations -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section C: What to Expect</span>
                <span class="livia-meta-badge">Section 3 (Overlay Card with Background Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_c_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_c_title" name="service_sec_c_title" value="<?php echo esc_attr($sec_c_title); ?>" placeholder="e.g. What to Expect During Your Treatment">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_c_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_c_desc" name="service_sec_c_desc" placeholder="What does the patient experience during the treatment?"><?php echo esc_textarea($sec_c_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $c_img_url = $sec_c_bg_image_id ? wp_get_attachment_url($sec_c_bg_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_c_bg_image_id">
                        <label class="livia-meta-label">Background Image</label>
                        <input type="hidden" name="service_sec_c_bg_image_id" value="<?php echo esc_attr($sec_c_bg_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($c_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($c_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($c_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($c_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section D: Prep & Aftercare -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section D: Prep & Aftercare Guidelines</span>
                <span class="livia-meta-badge">Section 4 (Side-by-side Lists)</span>
            </div>
            <div class="livia-meta-section-body" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_d_prep">Pre-Treatment Instructions (One per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_d_prep" name="service_sec_d_prep" style="height:150px;" placeholder="Avoid alcohol 24h prior&#10;Arrive with clean skin"><?php echo esc_textarea($sec_d_prep); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_d_after">Aftercare Instructions (One per line)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_d_after" name="service_sec_d_after" style="height:150px;" placeholder="Keep head elevated for 4h&#10;Avoid heavy exercise for 24h"><?php echo esc_textarea($sec_d_after); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Section E: Treatment Plan & Results -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section E: Treatment Plan & Results</span>
                <span class="livia-meta-badge">Section 5 (Left Text, Right Image)</span>
            </div>
            <div class="livia-meta-section-body">
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_e_title">Section Title</label>
                    <input type="text" class="livia-meta-input-text" id="service_sec_e_title" name="service_sec_e_title" value="<?php echo esc_attr($sec_e_title); ?>" placeholder="e.g. Treatment Plan and Results">
                </div>
                <div class="livia-meta-row">
                    <label class="livia-meta-label" for="service_sec_e_desc">Section Content (HTML allowed)</label>
                    <textarea class="livia-meta-input-textarea" id="service_sec_e_desc" name="service_sec_e_desc" placeholder="Detail the results timeline and ongoing maintenance sessions..."><?php echo esc_textarea($sec_e_desc); ?></textarea>
                </div>
                <div class="livia-meta-row">
                    <?php
                    $e_img_url = $sec_e_image_id ? wp_get_attachment_url($sec_e_image_id) : '';
                    ?>
                    <div class="livia-media-uploader" data-field-id="service_sec_e_image_id">
                        <label class="livia-meta-label">Section Image</label>
                        <input type="hidden" name="service_sec_e_image_id" value="<?php echo esc_attr($sec_e_image_id); ?>">
                        <div class="livia-media-preview" style="margin-bottom: 8px; <?php echo empty($e_img_url) ? 'display:none;' : ''; ?>">
                            <img src="<?php echo esc_url($e_img_url); ?>" style="max-width: 150px; height: auto;">
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="button livia-media-upload-btn"><?php echo empty($e_img_url) ? 'Upload / Choose Image' : 'Change Image'; ?></button>
                            <button type="button" class="button button-link-delete livia-media-remove-btn" style="<?php echo empty($e_img_url) ? 'display:none;' : ''; ?> color:#a00;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section F: FAQs -->
        <div class="livia-meta-section">
            <div class="livia-meta-section-header">
                <span>Section F: Frequently Asked Questions</span>
                <span class="livia-meta-badge">Section 6 (Interactive Accordions)</span>
            </div>
            <div class="livia-meta-section-body">
                <p class="description" style="margin-bottom: 10px; font-size:12px;">Fill out up to 6 custom FAQs. Empty questions will not be displayed.</p>
                <?php for ($i = 1; $i <= 6; $i++): 
                    $q_val = get_post_meta($post->ID, '_service_faq_q' . $i, true);
                    $a_val = get_post_meta($post->ID, '_service_faq_a' . $i, true);
                ?>
                <div class="faq-grid-row">
                    <div class="faq-grid-col">
                        <label class="livia-meta-label" for="service_faq_q<?php echo $i; ?>">Question <?php echo $i; ?></label>
                        <input type="text" class="livia-meta-input-text" id="service_faq_q<?php echo $i; ?>" name="service_faq_q<?php echo $i; ?>" value="<?php echo esc_attr($q_val); ?>" placeholder="e.g. Is treatment painful?">
                    </div>
                    <div class="faq-grid-col">
                        <label class="livia-meta-label" for="service_faq_a<?php echo $i; ?>">Answer <?php echo $i; ?> (HTML allowed)</label>
                        <textarea class="livia-meta-input-textarea" id="service_faq_a<?php echo $i; ?>" name="service_faq_a<?php echo $i; ?>" style="height:60px;" placeholder="Provide answer here..."><?php echo esc_textarea($a_val); ?></textarea>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php
}

function livia_save_service_sections($post_id) {
    if (!isset($_POST['livia_service_sections_nonce']) || !wp_verify_nonce($_POST['livia_service_sections_nonce'], 'livia_service_sections_nonce_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        '_service_icon'              => 'text',
        '_service_price'             => 'text',
        '_service_duration'          => 'text',
        '_service_video'             => 'text',
        '_service_external_url'      => 'url',
        '_service_sec_a_title'       => 'text',
        '_service_sec_a_desc'        => 'html',
        '_service_sec_a_checklist'   => 'textarea',
        '_service_sec_a_image_id'    => 'int',
        '_service_sec_b_title'       => 'text',
        '_service_sec_b_desc'        => 'html',
        '_service_sec_b_image_id'    => 'int',
        '_service_sec_c_title'       => 'text',
        '_service_sec_c_desc'        => 'html',
        '_service_sec_c_bg_image_id' => 'int',
        '_service_sec_d_prep'        => 'textarea',
        '_service_sec_d_after'       => 'textarea',
        '_service_sec_e_title'       => 'text',
        '_service_sec_e_desc'        => 'html',
        '_service_sec_e_image_id'    => 'int',
    ];

    for ($i = 1; $i <= 6; $i++) {
        $fields['_service_faq_q' . $i] = 'text';
        $fields['_service_faq_a' . $i] = 'html';
    }

    foreach ($fields as $key => $type) {
        $post_key = ltrim($key, '_');
        if (isset($_POST[$post_key])) {
            $value = $_POST[$post_key];
            if ($type === 'int') {
                update_post_meta($post_id, $key, absint($value));
            } elseif ($type === 'url') {
                update_post_meta($post_id, $key, esc_url_raw(trim($value)));
            } elseif ($type === 'html') {
                update_post_meta($post_id, $key, wp_kses_post($value));
            } elseif ($type === 'textarea') {
                update_post_meta($post_id, $key, sanitize_textarea_field($value));
            } else {
                update_post_meta($post_id, $key, sanitize_text_field($value));
            }
        } else {
            update_post_meta($post_id, $key, '');
        }
    }
}
add_action('save_post_service', 'livia_save_service_sections');

function livia_service_sections_admin_styles() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        ?>
        <style>
        .livia-meta-container {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            max-width: 100%;
        }
        .livia-meta-section {
            border: 1px solid #ccd0d4;
            border-radius: 6px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        .livia-meta-section-header {
            background: #f6f7f7;
            padding: 12px 16px;
            border-bottom: 1px solid #ccd0d4;
            font-weight: 600;
            font-size: 14px;
            color: #1d2327;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 6px 6px 0 0;
        }
        .livia-meta-section-body {
            padding: 16px;
        }
        .livia-meta-row {
            margin-bottom: 15px;
        }
        .livia-meta-row:last-child {
            margin-bottom: 0;
        }
        .livia-meta-label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1d2327;
            font-size: 13px;
        }
        .livia-meta-input-text {
            width: 100%;
            padding: 8px 10px;
            font-size: 13px;
            line-height: 1.5;
            border-radius: 4px;
            border: 1px solid #8c8f94;
            background-color: #fff;
            color: #2c3338;
        }
        .livia-meta-input-text:focus, .livia-meta-input-textarea:focus {
            border-color: #AC13F9;
            box-shadow: 0 0 0 1px #AC13F9;
            outline: 2px solid transparent;
        }
        .livia-meta-input-textarea {
            width: 100%;
            height: 120px;
            padding: 8px 10px;
            font-size: 13px;
            line-height: 1.5;
            border-radius: 4px;
            border: 1px solid #8c8f94;
            background-color: #fff;
            color: #2c3338;
            font-family: inherit;
        }
        .livia-meta-badge {
            background: #AC13F9;
            color: #fff;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .livia-media-preview img {
            max-width: 180px;
            height: auto;
            border: 1px solid #c3c4c7;
            border-radius: 4px;
            padding: 4px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .faq-grid-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px dashed #ccd0d4;
        }
        .faq-grid-row:last-child {
            border-bottom: none;
        }
        .faq-grid-col {
            display: flex;
            flex-direction: column;
        }
        .livia-meta-help {
            font-size: 12px;
            color: #646970;
            margin-top: 4px;
            font-style: italic;
        }
        </style>
        <?php
    }
}
add_action('admin_head', 'livia_service_sections_admin_styles');

function livia_service_sections_admin_scripts() {
    global $pagenow;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'service') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($){
            var file_frame;
            var active_uploader;

            $(document).on('click', '.livia-media-upload-btn', function(e) {
                e.preventDefault();
                active_uploader = $(this).closest('.livia-media-uploader');

                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media({
                    title: 'Select Photo',
                    button: { text: 'Use this photo' },
                    multiple: false
                });

                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    if (active_uploader) {
                        var fieldId = active_uploader.data('field-id');
                        active_uploader.find('input[type="hidden"]').val(attachment.id);
                        active_uploader.find('.livia-media-preview img').attr('src', attachment.url);
                        active_uploader.find('.livia-media-preview').show();
                        active_uploader.find('.livia-media-upload-btn').text('Change Image');
                        active_uploader.find('.livia-media-remove-btn').show();
                    }
                });

                file_frame.open();
            });

            $(document).on('click', '.livia-media-remove-btn', function(e) {
                e.preventDefault();
                var uploader = $(this).closest('.livia-media-uploader');
                uploader.find('input[type="hidden"]').val('');
                uploader.find('.livia-media-preview img').attr('src', '');
                uploader.find('.livia-media-preview').hide();
                uploader.find('.livia-media-upload-btn').text('Upload / Choose Image');
                $(this).hide();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'livia_service_sections_admin_scripts');

