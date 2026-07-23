<?php
/**
 * LIVIA Med Spa — Customizer
 * Deal popup controls (enable, copy, image, delay, frequency).
 *
 * Split out of functions.php; load order is defined there.
 */

// ── Deal Popup — Customizer Controls ───────────────────────────────
// Client manages all popup content from Appearance → Customize → Deal Popup
// Zero code required. Changes go live on Save & Publish.
add_action('customize_register', 'livia_popup_customizer');
function livia_popup_customizer($wp_customize) {

    $wp_customize->add_section('livia_popup', [
        'title'       => 'Deal Popup',
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

    // Popup Image (optional — shown above the badge/title)
    $wp_customize->add_setting('livia_popup_image', [
        'default'           => '',
        'sanitize_callback' => 'absint', // stores attachment ID
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'livia_popup_image', [
        'section'     => 'livia_popup',
        'label'       => 'Popup Image (optional)',
        'description' => 'Shows above the headline. Pick from the Media Library or upload a new image. Leave blank to hide.',
        'mime_type'   => 'image',
    ]));
}

