<?php
/**
 * LIVIA Med Spa — Theme Functions
 * Performance-optimized build
 *
 * This file only loads the theme's modules. Each area of functionality
 * lives in its own file under /inc:
 *   setup.php          — theme supports, menus, templates, security basics
 *   performance.php    — asset loading, cache tuning, LiteSpeed integration
 *   seo-schema.php     — titles, meta, JSON-LD structured data, redirects
 *   post-types.php     — service / team / product / before-after CPTs
 *   metaboxes.php      — admin editing UI for the custom post types
 *   forms.php          — contact + newsletter AJAX handlers, email template
 *   customizer.php     — deal popup customizer settings
 *   content-seeder.php — one-time page/post/service creation + demo import
 */

foreach ( [
    'setup',
    'performance',
    'seo-schema',
    'post-types',
    'metaboxes',
    'forms',
    'customizer',
    'content-seeder',
] as $livia_module ) {
    require_once get_template_directory() . '/inc/' . $livia_module . '.php';
}
unset( $livia_module );
