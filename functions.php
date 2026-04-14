<?php
/**
 * Livia Med Spa — Functions
 */

// Load the stylesheet
function livia_enqueue_styles() {
    wp_enqueue_style('livia-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'livia_enqueue_styles');
