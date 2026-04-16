<?php
/**
 * Template Name: Contact
 * Livia Med Spa — Contact Page
 * Performance-optimized with form validation
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Page Hero -->
    <section class="page-hero" aria-label="Contact us">
        <div class="page-hero__inner">
            <span class="section__label">Get in Touch</span>
            <h1 class="page-hero__title">Contact Us</h1>
            <p class="page-hero__desc">We'd love to hear from you. Reach out to schedule a consultation or ask any questions.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-section" aria-label="Contact form and information">
        <div class="section__inner">
            <div class="contact-grid">

                <!-- Contact Form -->
                <div class="contact-form-wrap reveal">
                    <h2 class="contact-form__title">Send a Message</h2>
                    <p class="contact-form__subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>
                    <form class="contact-form" id="contact-form" method="post" novalidate>
                        <?php wp_nonce_field('livia_contact_form', 'livia_contact_nonce'); ?>
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-first" class="form-label">First Name</label>
                                <input type="text" id="cf-first" name="first_name" class="form-input" placeholder="Jane" required autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label for="cf-last" class="form-label">Last Name</label>
                                <input type="text" id="cf-last" name="last_name" class="form-input" placeholder="Doe" required autocomplete="family-name">
                            </div>
                        </div>
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-email" class="form-label">Email</label>
                                <input type="email" id="cf-email" name="email" class="form-input" placeholder="jane@example.com" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="cf-phone" class="form-label">Phone</label>
                                <input type="tel" id="cf-phone" name="phone" class="form-input" placeholder="(813) 000-0000" autocomplete="tel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cf-service" class="form-label">Service of Interest</label>
                            <select id="cf-service" name="service" class="form-input form-select">
                                <option value="">Select a service...</option>
                                <?php
                                $svc_query = new WP_Query([
                                    'post_type'      => 'service',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                    'no_found_rows'  => true,
                                ]);
                                if ($svc_query->have_posts()) :
                                    while ($svc_query->have_posts()) : $svc_query->the_post(); ?>
                                        <option value="<?php echo esc_attr(sanitize_title(get_the_title())); ?>"><?php the_title(); ?></option>
                                    <?php endwhile; wp_reset_postdata();
                                endif; ?>
                                <option value="other">Other / General Inquiry</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cf-message" class="form-label">Message</label>
                            <textarea id="cf-message" name="message" class="form-input form-textarea" rows="5" placeholder="Tell us about your goals or ask a question..."></textarea>
                        </div>
                        <input type="hidden" name="action" value="livia_contact_submit">
                        <button type="submit" class="btn btn--primary btn--lg contact-form__submit">
                            Send Message
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>

                    <!-- Form success state -->
                    <div class="contact-form__success" id="form-success">
                        <div class="contact-form__success-icon">✨</div>
                        <h3 class="contact-form__success-title">Message Sent!</h3>
                        <p class="contact-form__success-text">Thank you for reaching out. Our team will get back to you within 24 hours.</p>
                    </div>
                </div>

                <!-- Contact Info Sidebar -->
                <aside class="contact-sidebar reveal" aria-label="Contact information">
                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h3 class="contact-card__title">Phone</h3>
                        <a href="tel:8132302219" class="contact-card__text">(813) 230-2219</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <h3 class="contact-card__title">Email</h3>
                        <a href="mailto:support@liviamedspa.com" class="contact-card__text">support@liviamedspa.com</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h3 class="contact-card__title">Location</h3>
                        <p class="contact-card__text">Tampa, FL 33606</p>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h3 class="contact-card__title">Hours</h3>
                        <div class="contact-card__hours">
                            <div class="contact-card__hour-row">
                                <span>Monday – Wednesday</span>
                                <span>9:00 AM – 7:00 PM</span>
                            </div>
                            <div class="contact-card__hour-row">
                                <span>Thursday – Saturday</span>
                                <span>9:00 AM – 4:00 PM</span>
                            </div>
                            <div class="contact-card__hour-row">
                                <span>Sunday</span>
                                <span>Closed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="contact-social">
                        <span class="contact-social__label">Follow Us</span>
                        <div class="contact-social__links">
                            <a href="https://www.instagram.com/liviamedspa/" class="footer__social-link" aria-label="Follow us on Instagram" target="_blank" rel="noopener noreferrer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                            </a>
                            <a href="https://www.facebook.com/p/Livia-Med-Spa-61561610168278/" class="footer__social-link" aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="contact-map" aria-label="Our location">
        <div class="contact-map__wrap reveal">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112539.75152973957!2d-82.5511647!3d27.9505669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2c48aef610245%3A0xdea2de0661043e26!2sTampa%2C+FL!5e0!3m2!1sen!2sus!4v1"
                width="100%"
                height="400"
                style="border:0;border-radius:16px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Livia Med Spa location in Tampa, FL">
            </iframe>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Get in touch">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">We're Here for You</span>
            <h2 class="cta-section__title">Have Questions?<br>We Have Answers</h2>
            <p class="cta-section__text">Our team is ready to help you find the perfect treatment. Don't hesitate to reach out.</p>
            <div class="cta-section__actions">
                <a href="tel:8132302219" class="btn btn--primary btn--lg">Call (813) 230-2219</a>
                <a href="mailto:support@liviamedspa.com" class="btn btn--outline btn--lg">Email Us</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
