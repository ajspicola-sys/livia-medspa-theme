<?php
/**
 * Sidebar Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

if (!is_active_sidebar('blog-sidebar')) {
    return;
}
?>

<aside class="blog-sidebar" role="complementary">
    <?php dynamic_sidebar('blog-sidebar'); ?>
</aside>
