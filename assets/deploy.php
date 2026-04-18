<?php
/**
 * Livia Med Spa — One-Time Git Deploy Script
 * Upload to: /public_html/deploy.php
 * Visit: https://liviamedspa.com/deploy.php?key=LiviaGitDeploy2026
 * DELETES ITSELF after running for security.
 */

$SECRET_KEY  = 'LiviaGitDeploy2026';
$THEME_PATH  = __DIR__ . '/wp-content/themes/livia-medspa-theme';

// Auth check
if ( ! isset( $_GET['key'] ) || $_GET['key'] !== $SECRET_KEY ) {
    http_response_code( 403 );
    die( 'Forbidden.' );
}

header( 'Content-Type: text/plain; charset=utf-8' );
echo "=== Livia Med Spa Git Deploy ===\n\n";

// Verify theme directory exists
if ( ! is_dir( $THEME_PATH ) ) {
    echo "ERROR: Theme directory not found: $THEME_PATH\n";
    echo "Scanning for theme...\n";
    $found = glob( __DIR__ . '/wp-content/themes/*/style.css' );
    foreach ( $found as $f ) {
        echo "  Found: " . dirname( $f ) . "\n";
    }
    die();
}

echo "Theme path: $THEME_PATH\n\n";

// Run git pull
$cmd    = "cd " . escapeshellarg( $THEME_PATH ) . " && git pull origin main 2>&1";
$output = shell_exec( $cmd );

echo "Git pull output:\n";
echo $output ?: "(no output returned)\n";

echo "\n=== Cache Purge ===\n";

// Trigger WordPress LiteSpeed cache purge via WP CLI if available
$wp_cli = shell_exec( "which wp 2>/dev/null" );
if ( $wp_cli ) {
    $wp_path = __DIR__;
    $purge   = shell_exec( "wp --path=" . escapeshellarg( $wp_path ) . " litespeed-purge all 2>&1" );
    echo "WP LiteSpeed purge: " . ( $purge ?: "done" ) . "\n";
} else {
    // Touch wp-config to bust any file-based caching
    touch( __DIR__ . '/wp-config.php' );
    echo "Cache: touched wp-config.php (LiteSpeed auto-purge will fire on next request)\n";
}

echo "\n=== Done! ===\n";
echo "Script will now self-delete for security.\n";

// Self-delete
@unlink( __FILE__ );
