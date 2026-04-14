<?php
/**
 * Template Name: Contact
 * Livia Med Spa — Contact Page
 */
get_header(); ?>

<main class="site-main">

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">Get in Touch</span>
            <h1 class="page-hero__title">Contact Us</h1>
            <p class="page-hero__desc">We'd love to hear from you. Reach out to schedule a consultation or ask any questions.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-section">
        <div class="section__inner">
            <div class="contact-grid">

                <!-- Contact Form -->
                <div class="contact-form-wrap reveal">
                    <h2 class="contact-form__title">Send a Message</h2>
                    <p class="contact-form__subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>
                    <form class="contact-form" id="contact-form" method="post">
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-first" class="form-label">First Name</label>
                                <input type="text" id="cf-first" name="first_name" class="form-input" placeholder="Jane" required>
                            </div>
                            <div class="form-group">
                                <label for="cf-last" class="form-label">Last Name</label>
                                <input type="text" id="cf-last" name="last_name" class="form-input" placeholder="Doe" required>
                            </div>
                        </div>
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-email" class="form-label">Email</label>
                                <input type="email" id="cf-email" name="email" class="form-input" placeholder="jane@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="cf-phone" class="form-label">Phone</label>
                                <input type="tel" id="cf-phone" name="phone" class="form-input" placeholder="(813) 000-0000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cf-service" class="form-label">Service of Interest</label>
                            <select id="cf-service" name="service" class="form-input form-select">
                                <option value="">Select a service...</option>
                                <option value="botox">Botox & Dysport</option>
                                <option value="fillers">Dermal Fillers</option>
                                <option value="microneedling">Microneedling</option>
                                <option value="peels">Chemical Peels</option>
                                <option value="laser">Laser Treatments</option>
                                <option value="iv">IV Therapy</option>
                                <option value="other">Other / General Inquiry</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cf-message" class="form-label">Message</label>
                            <textarea id="cf-message" name="message" class="form-input form-textarea" rows="5" placeholder="Tell us about your goals or ask a question..."></textarea>
                        </div>
                        <button type="submit" class="btn btn--primary btn--lg contact-form__submit">
                            Send Message
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Contact Info Sidebar -->
                <div class="contact-sidebar reveal">
                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h3 class="contact-card__title">Phone</h3>
                        <a href="tel:8132302219" class="contact-card__text">(813) 230-2219</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <h3 class="contact-card__title">Email</h3>
                        <a href="mailto:support@liviamedspa.com" class="contact-card__text">support@liviamedspa.com</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h3 class="contact-card__title">Location</h3>
                        <p class="contact-card__text">Tampa, FL 33606</p>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h3 class="contact-card__title">Hours</h3>
                        <div class="contact-card__hours">
                            <div class="contact-card__hour-row">
                                <span>Monday – Friday</span>
                                <span>9:00 AM – 6:00 PM</span>
                            </div>
                            <div class="contact-card__hour-row">
                                <span>Saturday</span>
                                <span>10:00 AM – 4:00 PM</span>
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
                            <a href="#" class="footer__social-link" aria-label="Instagram">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                            </a>
                            <a href="#" class="footer__social-link" aria-label="Facebook">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                            <a href="#" class="footer__social-link" aria-label="TikTok">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
