<?php
/**
 * Template Name: Contact Page
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();
$phone   = get_theme_mod('livia_phone', '(813) 230-2219');
$email   = get_theme_mod('livia_email', 'support@liviamedspa.com');
$address = get_theme_mod('livia_address', '10043 N Dale Mabry Hwy, Tampa, FL 33618');
?>

<!-- Page Hero -->
<section class="page-hero page-hero--short">
    <div class="page-hero__bg"></div>
    <div class="page-hero__content container">
        <span class="section-label">Get in Touch</span>
        <h1 class="page-hero__title">Contact Us</h1>
        <p class="page-hero__desc">Ready for your transformation? Reach out and we'll get you started.</p>
    </div>
</section>

<!-- Contact Content -->
<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info animate-on-scroll from-left">
                <h2 style="font-size: var(--text-3xl); margin-bottom: var(--space-xl);">Visit Our Studio</h2>

                <div class="contact-info__items">
                    <div class="contact-info__item">
                        <div class="contact-info__icon"><?php echo livia_icon('map-pin', 22); ?></div>
                        <div>
                            <strong>Studio Address</strong>
                            <p><?php echo esc_html($address); ?></p>
                            <a href="https://maps.google.com/?q=<?php echo urlencode($address); ?>" target="_blank" rel="noopener" class="contact-info__link">Get Directions →</a>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon"><?php echo livia_icon('phone', 22); ?></div>
                        <div>
                            <strong>Phone</strong>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon"><?php echo livia_icon('mail', 22); ?></div>
                        <div>
                            <strong>Email</strong>
                            <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon"><?php echo livia_icon('clock', 22); ?></div>
                        <div>
                            <strong>Studio Hours</strong>
                            <ul class="contact-hours">
                                <li><span>Mon – Wed</span><span><?php echo esc_html(get_theme_mod('livia_hours_mw', '9am – 7pm')); ?></span></li>
                                <li><span>Thu – Sat</span><span><?php echo esc_html(get_theme_mod('livia_hours_ts', '9am – 4pm')); ?></span></li>
                                <li><span>Sunday</span><span><?php echo esc_html(get_theme_mod('livia_hours_sun', 'Closed')); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Map Embed -->
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3520.4!2d-82.5040!3d28.0547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s10043+N+Dale+Mabry+Hwy%2C+Tampa%2C+FL+33618!5e0!3m2!1sen!2sus!4v1"
                        width="100%"
                        height="250"
                        style="border:0; border-radius: var(--radius-lg);"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Livia Med Spa Location">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrap animate-on-scroll from-right">
                <div class="contact-form-card">
                    <h2 style="font-size: var(--text-2xl); margin-bottom: var(--space-xs);">Request a Consultation</h2>
                    <p style="color: var(--color-gray-500); margin-bottom: var(--space-xl);">Fill out the form and we'll reach out to tailor your treatment plan.</p>

                    <?php
                    // If a contact form plugin shortcode exists, use it
                    if (shortcode_exists('contact-form-7')) :
                        echo do_shortcode('[contact-form-7 id="contact" title="Contact Form"]');
                    elseif (shortcode_exists('wpforms')) :
                        echo do_shortcode('[wpforms id="contact"]');
                    else :
                        // Fallback native form
                    ?>
                    <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="livia_contact_form">
                        <?php wp_nonce_field('livia_contact_nonce', 'livia_contact_nonce_field'); ?>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="contact_first_name">First Name *</label>
                                <input type="text" class="form-input" id="contact_first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="contact_last_name">Last Name *</label>
                                <input type="text" class="form-input" id="contact_last_name" name="last_name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="contact_email">Email *</label>
                                <input type="email" class="form-input" id="contact_email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="contact_phone">Phone</label>
                                <input type="tel" class="form-input" id="contact_phone" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_service">Interested In</label>
                            <select class="form-select" id="contact_service" name="service">
                                <option value="">Select a service...</option>
                                <?php
                                $form_services = get_posts(['post_type' => 'service', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
                                foreach ($form_services as $s) :
                                ?>
                                <option value="<?php echo esc_attr($s->post_title); ?>"><?php echo esc_html($s->post_title); ?></option>
                                <?php endforeach; ?>
                                <option value="Other">Other / Not Sure</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_message">Message</label>
                            <textarea class="form-textarea" id="contact_message" name="message" placeholder="Tell us about your goals..."></textarea>
                        </div>

                        <button type="submit" class="btn btn--primary btn--lg" style="width: 100%;">
                            Submit Request <?php echo livia_icon('arrow-right', 18); ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
