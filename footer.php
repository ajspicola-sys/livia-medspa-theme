<?php
/**
 * Footer Template
 *
 * Global footer with contact info, links, social, newsletter, and back-to-top.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */
?>
</main><!-- /.site-main -->

<!-- ═══════════════════════════════════════════════════════════════════════
     SITE FOOTER
     ═══════════════════════════════════════════════════════════════════════ -->
<footer class="site-footer" id="siteFooter">

    <!-- Top Section: Main Footer Content -->
    <div class="footer__top">
        <div class="container">
            <div class="footer__grid">

                <!-- Brand Column -->
                <div class="footer__brand">
                    <div class="footer__logo">
                        <?php echo livia_get_logo(); ?>
                    </div>
                    <p class="footer__tagline">Tampa's elite aesthetics studio. Expert treatments tailored to enhance your natural beauty.</p>

                    <!-- Google Reviews Badge -->
                    <div class="footer__reviews">
                        <div class="footer__reviews-stars">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <?php echo livia_icon('star', 16); ?>
                            <?php endfor; ?>
                        </div>
                        <span class="footer__reviews-text">
                            <?php echo esc_html(get_theme_mod('livia_review_rating', '5.0')); ?> · <?php echo esc_html(get_theme_mod('livia_review_count', '67')); ?> Google Reviews
                        </span>
                    </div>

                    <!-- Social Links -->
                    <?php
                    $social = livia_get_social_links();
                    if (!empty($social)) :
                    ?>
                    <div class="footer__social">
                        <?php foreach ($social as $platform => $url) : ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="footer__social-link" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                <?php echo livia_icon($platform, 20); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Quick Links -->
                <div class="footer__column">
                    <h4 class="footer__heading">Quick Links</h4>
                    <?php
                    if (has_nav_menu('footer')) {
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'footer__links',
                            'depth'          => 1,
                        ]);
                    } else {
                    ?>
                    <ul class="footer__links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>">Services</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('before_after')); ?>">Before & After</a></li>
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                        <li><a href="<?php echo esc_url(home_url('/products')); ?>">Products</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                    </ul>
                    <?php } ?>
                </div>

                <!-- Services -->
                <div class="footer__column">
                    <h4 class="footer__heading">Popular Services</h4>
                    <ul class="footer__links">
                        <?php
                        $footer_services = get_posts([
                            'post_type'      => 'service',
                            'posts_per_page' => 7,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ]);
                        if ($footer_services) :
                            foreach ($footer_services as $service) :
                        ?>
                            <li><a href="<?php echo get_permalink($service->ID); ?>"><?php echo esc_html($service->post_title); ?></a></li>
                        <?php
                            endforeach;
                            wp_reset_postdata();
                        else :
                        ?>
                            <li><a href="#">Botox</a></li>
                            <li><a href="#">Dermal Fillers</a></li>
                            <li><a href="#">Microneedling</a></li>
                            <li><a href="#">Chemical Peels</a></li>
                            <li><a href="#">Laser Treatments</a></li>
                            <li><a href="#">PRP Facial</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer__column">
                    <h4 class="footer__heading">Visit Our Studio</h4>
                    <ul class="footer__contact">
                        <li class="footer__contact-item">
                            <?php echo livia_icon('map-pin', 18); ?>
                            <div>
                                <span><?php echo esc_html(get_theme_mod('livia_address', '10043 N Dale Mabry Hwy, Tampa, FL 33618')); ?></span>
                            </div>
                        </li>
                        <li class="footer__contact-item">
                            <?php echo livia_icon('phone', 18); ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('livia_phone', '8132302219'))); ?>">
                                <?php echo esc_html(get_theme_mod('livia_phone', '(813) 230-2219')); ?>
                            </a>
                        </li>
                        <li class="footer__contact-item">
                            <?php echo livia_icon('mail', 18); ?>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('livia_email', 'support@liviamedspa.com')); ?>">
                                <?php echo esc_html(get_theme_mod('livia_email', 'support@liviamedspa.com')); ?>
                            </a>
                        </li>
                    </ul>

                    <h4 class="footer__heading" style="margin-top: var(--space-lg);">Studio Hours</h4>
                    <ul class="footer__hours">
                        <li><span>Mon – Wed</span><span><?php echo esc_html(get_theme_mod('livia_hours_mw', '9am – 7pm')); ?></span></li>
                        <li><span>Thu – Sat</span><span><?php echo esc_html(get_theme_mod('livia_hours_ts', '9am – 4pm')); ?></span></li>
                        <li><span>Sunday</span><span><?php echo esc_html(get_theme_mod('livia_hours_sun', 'Closed')); ?></span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Section: Copyright & Legal -->
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <p class="footer__copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
                <div class="footer__legal">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
                    <span class="footer__legal-dot">·</span>
                    <a href="<?php echo esc_url(home_url('/terms')); ?>">Terms of Service</a>
                    <span class="footer__legal-dot">·</span>
                    <a href="<?php echo esc_url(home_url('/accessibility')); ?>">Accessibility</a>
                </div>
            </div>
        </div>
    </div>

</footer>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" aria-label="<?php esc_attr_e('Back to top', 'livia-medspa'); ?>">
    <?php echo livia_icon('chevron-up', 20); ?>
</button>

<?php wp_footer(); ?>
</body>
</html>
