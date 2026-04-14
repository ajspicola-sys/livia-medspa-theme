<?php
/**
 * Template Name: Homepage
 * Livia Med Spa — Front Page
 */
get_header(); ?>

<main class="site-main">

    <!-- ═══════════════════════════════════════════════════════════════
         HERO SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="hero" id="hero">
        <div class="hero__bg-overlay"></div>
        <div class="hero__particles">
            <span class="hero__particle" style="--x:10%;--y:20%;--delay:0s;--size:3px;"></span>
            <span class="hero__particle" style="--x:85%;--y:15%;--delay:1s;--size:2px;"></span>
            <span class="hero__particle" style="--x:70%;--y:60%;--delay:2s;--size:4px;"></span>
            <span class="hero__particle" style="--x:25%;--y:75%;--delay:0.5s;--size:2px;"></span>
            <span class="hero__particle" style="--x:50%;--y:35%;--delay:1.5s;--size:3px;"></span>
            <span class="hero__particle" style="--x:90%;--y:80%;--delay:3s;--size:2px;"></span>
        </div>
        <div class="hero__content">
            <span class="hero__badge">✦ Tampa's Premier Aesthetics Studio</span>
            <h1 class="hero__title">Where Science<br>Meets <em>Beauty</em></h1>
            <p class="hero__subtitle">Advanced aesthetic treatments tailored to enhance your natural beauty — delivered by Tampa's most trusted medical professionals.</p>
            <div class="hero__actions">
                <a href="#book" class="btn btn--primary btn--lg">
                    Book Consultation
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="#services" class="btn btn--outline btn--lg">View Services</a>
            </div>
            <div class="hero__trust">
                <div class="hero__trust-stars">★★★★★</div>
                <span class="hero__trust-text">500+ Five-Star Reviews</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SERVICES SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="services" id="services">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Our Expertise</span>
                <h2 class="section__title">Premium Treatments</h2>
                <p class="section__desc">Each treatment is customized to your unique goals, delivered with precision in a luxurious environment.</p>
            </div>

            <div class="services__grid reveal">
                <a href="#" class="service-card">
                    <div class="service-card__icon">💉</div>
                    <h3 class="service-card__title">Botox & Dysport</h3>
                    <p class="service-card__text">Smooth away fine lines and wrinkles with precision neurotoxin injections for a refreshed, youthful look.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <a href="#" class="service-card">
                    <div class="service-card__icon">✨</div>
                    <h3 class="service-card__title">Dermal Fillers</h3>
                    <p class="service-card__text">Restore lost volume and sculpt facial contours with premium hyaluronic acid fillers.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <a href="#" class="service-card">
                    <div class="service-card__icon">🔬</div>
                    <h3 class="service-card__title">Microneedling</h3>
                    <p class="service-card__text">Stimulate your skin's natural collagen production for firmer, smoother, more radiant skin.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <a href="#" class="service-card">
                    <div class="service-card__icon">🧴</div>
                    <h3 class="service-card__title">Chemical Peels</h3>
                    <p class="service-card__text">Reveal fresh, glowing skin and reduce discoloration with our medical-grade peel treatments.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <a href="#" class="service-card">
                    <div class="service-card__icon">⚡</div>
                    <h3 class="service-card__title">Laser Treatments</h3>
                    <p class="service-card__text">Advanced laser technology for skin resurfacing, pigment correction, and hair removal.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <a href="#" class="service-card">
                    <div class="service-card__icon">💎</div>
                    <h3 class="service-card__title">IV Therapy</h3>
                    <p class="service-card__text">Boost vitality from within with custom vitamin drips designed for energy, glow, and wellness.</p>
                    <span class="service-card__link">Learn More →</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHY LIVIA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="why-us">
        <div class="section__inner">
            <div class="why-us__grid">
                <div class="why-us__content reveal">
                    <span class="section__label">The Livia Difference</span>
                    <h2 class="section__title">Why Tampa Trusts Us</h2>
                    <p class="section__desc">We don't believe in one-size-fits-all. Every treatment plan is crafted around your unique anatomy, goals, and lifestyle.</p>
                    <div class="why-us__features">
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon">🏆</div>
                            <div>
                                <h4 class="why-us__feature-title">Board-Certified Team</h4>
                                <p class="why-us__feature-text">Our providers hold advanced certifications in aesthetic medicine.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon">🎯</div>
                            <div>
                                <h4 class="why-us__feature-title">Precision Artistry</h4>
                                <p class="why-us__feature-text">Subtle, natural-looking results that enhance — never overdo.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon">🔬</div>
                            <div>
                                <h4 class="why-us__feature-title">Latest Technology</h4>
                                <p class="why-us__feature-text">We invest in the newest FDA-approved devices and techniques.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn--primary">Meet Our Team →</a>
                </div>
                <div class="why-us__visual reveal">
                    <div class="why-us__stat-card why-us__stat-card--1">
                        <span class="why-us__stat-number">10K+</span>
                        <span class="why-us__stat-label">Treatments Performed</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--2">
                        <span class="why-us__stat-number">500+</span>
                        <span class="why-us__stat-label">5-Star Reviews</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--3">
                        <span class="why-us__stat-number">8+</span>
                        <span class="why-us__stat-label">Years Experience</span>
                    </div>
                    <div class="why-us__image-placeholder">
                        <div class="why-us__image-gradient"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TESTIMONIALS
         ═══════════════════════════════════════════════════════════════ -->
    <section class="testimonials">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Client Love</span>
                <h2 class="section__title">Real Results, Real Stories</h2>
            </div>
            <div class="testimonials__grid reveal">
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">★★★★★</div>
                    <p class="testimonial-card__text">"The team at Livia made me feel so comfortable. My results look completely natural — my friends just say I look 'refreshed.' Exactly what I wanted!"</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar">JM</div>
                        <div>
                            <span class="testimonial-card__name">Jessica M.</span>
                            <span class="testimonial-card__treatment">Botox & Fillers</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card testimonial-card--featured">
                    <div class="testimonial-card__stars">★★★★★</div>
                    <p class="testimonial-card__text">"I've been to several med spas in Tampa, and Livia is by far the best. The attention to detail, the luxury atmosphere, and the incredible results speak for themselves."</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar">SR</div>
                        <div>
                            <span class="testimonial-card__name">Sarah R.</span>
                            <span class="testimonial-card__treatment">Microneedling + PRP</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">★★★★★</div>
                    <p class="testimonial-card__text">"The laser treatment completely transformed my skin. Dark spots are gone, texture is smoother. I can't stop touching my face! Highly recommend."</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar">AT</div>
                        <div>
                            <span class="testimonial-card__name">Amanda T.</span>
                            <span class="testimonial-card__treatment">Laser Skin Rejuvenation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         CTA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-section" id="book">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Reveal<br>Your Best Self?</h2>
            <p class="cta-section__text">Book a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
