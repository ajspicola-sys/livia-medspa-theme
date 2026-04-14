<?php
/**
 * Livia Med Spa — Functions
 */

// Load the stylesheet with cache-busting version
function livia_enqueue_styles() {
    wp_enqueue_style('livia-style', get_stylesheet_uri(), array(), '2.0.' . time());
}
add_action('wp_enqueue_scripts', 'livia_enqueue_styles');
