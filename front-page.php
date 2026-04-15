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
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">
                    Book Consultation
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">View Services</a>
            </div>
            <div class="hero__trust">
                <div class="hero__trust-stars">★★★★★</div>
                <span class="hero__trust-text">500+ Five-Star Reviews</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SERVICES CAROUSEL
         ═══════════════════════════════════════════════════════════════ -->
    <section class="services" id="services">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Our Expertise</span>
                <h2 class="section__title">Premium Treatments</h2>
                <p class="section__desc">Each treatment is customized to your unique goals, delivered with precision in a luxurious environment.</p>
            </div>

            <?php
            // Pull services from CPT
            $services = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => 12,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);

            // Fallback services if none created yet
            $fallback = [
                ['icon' => '💉', 'title' => 'Botox & Dysport', 'text' => 'Smooth away fine lines and wrinkles with precision neurotoxin injections for a refreshed, youthful look.'],
                ['icon' => '✨', 'title' => 'Dermal Fillers', 'text' => 'Restore lost volume and sculpt facial contours with premium hyaluronic acid fillers.'],
                ['icon' => '🔬', 'title' => 'Microneedling', 'text' => 'Stimulate your skin\'s natural collagen production for firmer, smoother, more radiant skin.'],
                ['icon' => '🧴', 'title' => 'Chemical Peels', 'text' => 'Reveal fresh, glowing skin and reduce discoloration with our medical-grade peel treatments.'],
                ['icon' => '⚡', 'title' => 'Laser Treatments', 'text' => 'Advanced laser technology for skin resurfacing, pigment correction, and hair removal.'],
                ['icon' => '💎', 'title' => 'IV Therapy', 'text' => 'Boost vitality from within with custom vitamin drips designed for energy, glow, and wellness.'],
            ];
            ?>

            <div class="carousel reveal" id="services-carousel">
                <div class="carousel__track">
                    <?php if ($services->have_posts()) : $i = 0; ?>
                        <?php while ($services->have_posts()) : $services->the_post();
                            $icon  = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                            $price = get_post_meta(get_the_ID(), '_service_price', true);
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        ?>
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>">
                                <div class="carousel-card">
                                    <div class="carousel-card__image">
                                        <?php if ($thumb) : ?>
                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php else : ?>
                                            <div class="carousel-card__placeholder">
                                                <span><?php echo esc_html($icon); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo esc_html($icon); ?></div>
                                        <h3 class="carousel-card__title"><?php the_title(); ?></h3>
                                        <p class="carousel-card__text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <?php if ($price) : ?>
                                            <span class="carousel-card__price">From <?php echo esc_html($price); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="btn btn--primary btn--sm">View Treatment →</a>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ($fallback as $i => $svc) : ?>
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>">
                                <div class="carousel-card">
                                    <div class="carousel-card__image">
                                        <div class="carousel-card__placeholder">
                                            <span><?php echo $svc['icon']; ?></span>
                                        </div>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo $svc['icon']; ?></div>
                                        <h3 class="carousel-card__title"><?php echo $svc['title']; ?></h3>
                                        <p class="carousel-card__text"><?php echo $svc['text']; ?></p>
                                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--primary btn--sm">View Treatment →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Navigation -->
                <div class="carousel__nav">
                    <button class="carousel__arrow carousel__arrow--prev" aria-label="Previous">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <div class="carousel__dots" id="carousel-dots"></div>
                    <button class="carousel__arrow carousel__arrow--next" aria-label="Next">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
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
                    <a href="<?php echo esc_url(home_url('/team/')); ?>" class="btn btn--primary">Meet Our Team →</a>
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
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
