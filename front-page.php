<?php
/**
 * Template Name: Homepage
 * Livia Med Spa — Front Page
 * Performance-optimized: lazy loading, fetchpriority, semantic HTML
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- LocalBusiness Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MedicalBusiness",
    "name": "Livia Med Spa",
    "description": "Tampa's premier destination for advanced aesthetics including Botox, dermal fillers, laser treatments, and medical-grade skincare.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18132302219",
    "email": "support@liviamedspa.com",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Tampa",
        "addressRegion": "FL",
        "postalCode": "33606",
        "addressCountry": "US"
    },
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens": "09:00",
            "closes": "18:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Saturday",
            "opens": "10:00",
            "closes": "16:00"
        }
    ],
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "500"
    },
    "priceRange": "$$-$$$"
}
</script>

    <!-- ═══════════════════════════════════════════════════════════════
         HERO SECTION — above the fold, no lazy loading
         ═══════════════════════════════════════════════════════════════ -->
    <section class="hero" id="hero" aria-label="Welcome to Livia Med Spa">
        <div class="hero__bg-overlay"></div>
        <div class="hero__particles" aria-hidden="true">
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">View Services</a>
            </div>
            <div class="hero__trust" aria-label="Customer rating">
                <div class="hero__trust-stars" aria-hidden="true">★★★★★</div>
                <span class="hero__trust-text">500+ Five-Star Reviews</span>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="hero__scroll-indicator" aria-hidden="true">
            <div class="hero__scroll-mouse">
                <div class="hero__scroll-dot"></div>
            </div>
            <span class="hero__scroll-text">Scroll</span>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TRUST TICKER — scrolling partner/certification badges
         ═══════════════════════════════════════════════════════════════ -->
    <section class="trust-ticker" aria-label="Certifications and partnerships">
        <div class="trust-ticker__track">
            <div class="trust-ticker__items">
                <span class="trust-ticker__item">✦ FDA Approved Products</span>
                <span class="trust-ticker__item">✦ Board-Certified Providers</span>
                <span class="trust-ticker__item">✦ 500+ Five-Star Reviews</span>
                <span class="trust-ticker__item">✦ HIPAA Compliant</span>
                <span class="trust-ticker__item">✦ Allergan Partner</span>
                <span class="trust-ticker__item">✦ Galderma Partner</span>
                <span class="trust-ticker__item">✦ Complimentary Consultations</span>
                <span class="trust-ticker__item">✦ Tampa's #1 Med Spa</span>
                <!-- Duplicate for seamless loop -->
                <span class="trust-ticker__item">✦ FDA Approved Products</span>
                <span class="trust-ticker__item">✦ Board-Certified Providers</span>
                <span class="trust-ticker__item">✦ 500+ Five-Star Reviews</span>
                <span class="trust-ticker__item">✦ HIPAA Compliant</span>
                <span class="trust-ticker__item">✦ Allergan Partner</span>
                <span class="trust-ticker__item">✦ Galderma Partner</span>
                <span class="trust-ticker__item">✦ Complimentary Consultations</span>
                <span class="trust-ticker__item">✦ Tampa's #1 Med Spa</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SERVICES CAROUSEL
         ═══════════════════════════════════════════════════════════════ -->
    <section class="services" id="services" aria-label="Our treatments">
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
                'no_found_rows'  => true, // Performance: skip pagination count
                'update_post_meta_cache' => true,
                'update_post_term_cache' => false, // We don't need terms
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

            <div class="carousel reveal" id="services-carousel" role="region" aria-label="Services carousel" tabindex="0">
                <div class="carousel__track">
                    <?php if ($services->have_posts()) : $i = 0; ?>
                        <?php while ($services->have_posts()) : $services->the_post();
                            $icon  = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                            $price = get_post_meta(get_the_ID(), '_service_price', true);
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        ?>
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>" role="group" aria-label="Slide <?php echo $i + 1; ?>">
                                <div class="carousel-card">
                                    <div class="carousel-card__image">
                                        <?php if ($thumb) : ?>
                                            <img src="<?php echo esc_url($thumb); ?>"
                                                 alt="<?php the_title_attribute(); ?>"
                                                 loading="lazy"
                                                 decoding="async"
                                                 width="400"
                                                 height="240">
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
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>" role="group" aria-label="Slide <?php echo $i + 1; ?>">
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
                    <button class="carousel__arrow carousel__arrow--prev" aria-label="Previous slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <div class="carousel__dots" id="carousel-dots" role="tablist" aria-label="Slide indicators"></div>
                    <button class="carousel__arrow carousel__arrow--next" aria-label="Next slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         YOUR JOURNEY — 4-step process
         ═══════════════════════════════════════════════════════════════ -->

    <section class="journey-section" aria-label="How it works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Your Beauty Journey</h2>
                <p class="section__desc">From consultation to results — we make every step seamless and luxurious.</p>
            </div>
            <div class="journey-steps reveal">
                <div class="journey-step">
                    <div class="journey-step__number">01</div>
                    <div class="journey-step__icon">📋</div>
                    <h3 class="journey-step__title">Free Consultation</h3>
                    <p class="journey-step__text">Meet with our providers to discuss your goals and get a perfect treatment plan.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">02</div>
                    <div class="journey-step__icon">🎯</div>
                    <h3 class="journey-step__title">Custom Plan</h3>
                    <p class="journey-step__text">Tailored to your unique anatomy, skin type, and aesthetic goals. No cookie-cutter solutions.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">03</div>
                    <div class="journey-step__icon">✨</div>
                    <h3 class="journey-step__title">Expert Treatment</h3>
                    <p class="journey-step__text">Relax in our luxury suite while certified professionals deliver precision treatments.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">04</div>
                    <div class="journey-step__icon">🌟</div>
                    <h3 class="journey-step__title">Glow Up!</h3>
                    <p class="journey-step__text">Walk out feeling radiant and confident with aftercare guidance for lasting results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         PRODUCT SHOWCASE
         ═══════════════════════════════════════════════════════════════ -->
    <section class="product-showcase" aria-label="Medical-grade skincare products">
        <div class="product-showcase__glow" aria-hidden="true"></div>
        <div class="section__inner">
            <div class="product-showcase__layout">
                <div class="product-showcase__content reveal">
                    <span class="section__label" style="color: rgba(201,169,110,0.8);">Medical-Grade Skincare</span>
                    <h2 class="section__title" style="color: #faf8f5;">Professional Products,<br>Exceptional Results</h2>
                    <p class="product-showcase__text">We carry only the most trusted, clinically-proven skincare lines — handpicked by our providers to complement your in-office treatments and deliver visible results at home.</p>
                    <div class="product-showcase__features">
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">🔬</span>
                            <span class="product-showcase__feature-text">Physician-Strength Formulas</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">✨</span>
                            <span class="product-showcase__feature-text">Clinically Proven Results</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">🛡️</span>
                            <span class="product-showcase__feature-text">FDA-Approved Ingredients</span>
                        </div>
                    </div>
                    <div class="product-showcase__actions">
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="btn btn--primary btn--lg">Shop Products</a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline-light btn--lg">Get a Skincare Consultation</a>
                    </div>
                </div>
                <div class="product-showcase__visual reveal">
                    <div class="product-showcase__image-wrapper">
                        <div class="product-showcase__ring" aria-hidden="true"></div>
                        <img src="https://liviamedspa.com/wp-content/uploads/2025/03/1b5814_e3537a28776d47dbbe90ddc516aa73b3mv2-759x1024.avif"
                             alt="ZO Skin Health Products — medical-grade skincare available at Livia Med Spa"
                             class="product-showcase__image"
                             loading="lazy"
                             decoding="async"
                             width="280"
                             height="378">
                        <div class="product-showcase__badge product-showcase__badge--1" aria-hidden="true">
                            <span class="product-showcase__badge-icon">⭐</span>
                            <span class="product-showcase__badge-text">Best Seller</span>
                        </div>
                        <div class="product-showcase__badge product-showcase__badge--2" aria-hidden="true">
                            <span class="product-showcase__badge-icon">👩‍⚕️</span>
                            <span class="product-showcase__badge-text">Dr. Recommended</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SUPPLEMENTS (FULLSCRIPT)
         ═══════════════════════════════════════════════════════════════ -->
    <section class="supplements" aria-label="Practitioner-curated supplements">
        <div class="section__inner">
            <div class="supplements__layout">
                <!-- Left: Branding + CTA -->
                <div class="supplements__content reveal">
                    <span class="section__label">Practitioner-Curated Supplements</span>
                    <h2 class="section__title">Supplements as<br><em>intentional</em> as your care.</h2>
                    <p class="supplements__text">Every product in our Fullscript store is hand-selected by our clinical team — pharmaceutical-grade, third-party tested, and shipped directly to your door at a practitioner discount.</p>
                    <div class="supplements__cta-row">
                        <a href="#" class="btn btn--primary btn--lg">Shop Our Supplement Store →</a>
                        <span class="supplements__discount">20% off retail — exclusive to Livia patients</span>
                    </div>
                    <div class="supplements__partnership">
                        <span class="supplements__partner-label">Livia Med Spa</span>
                        <span class="supplements__partner-x">×</span>
                        <span class="supplements__partner-powered">Powered by</span>
                        <span class="supplements__partner-brand">Fullscript</span>
                    </div>
                </div>

                <!-- Right: Feature Cards -->
                <div class="supplements__features reveal">
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">🏆</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Pharmaceutical-Grade Quality</h3>
                            <p class="supplement-feature__text">Top-tier, certified brands hand-picked by our clinical team</p>
                        </div>
                    </div>
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">🔬</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Third-Party Tested</h3>
                            <p class="supplement-feature__text">Every product verified for purity and potency</p>
                        </div>
                    </div>
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">📦</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Delivered to Your Door</h3>
                            <p class="supplement-feature__text">Fast shipping with 20% off retail for Livia patients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHY LIVIA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="why-us" aria-label="Why choose Livia Med Spa">
        <div class="section__inner">
            <div class="why-us__grid">
                <div class="why-us__content reveal">
                    <span class="section__label">The Livia Difference</span>
                    <h2 class="section__title">Why Tampa Trusts Us</h2>
                    <p class="section__desc">We don't believe in one-size-fits-all. Every treatment plan is crafted around your unique anatomy, goals, and lifestyle.</p>
                    <div class="why-us__features">
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">🏆</div>
                            <div>
                                <h4 class="why-us__feature-title">Board-Certified Team</h4>
                                <p class="why-us__feature-text">Our providers hold advanced certifications in aesthetic medicine.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">🎯</div>
                            <div>
                                <h4 class="why-us__feature-title">Precision Artistry</h4>
                                <p class="why-us__feature-text">Subtle, natural-looking results that enhance — never overdo.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">🔬</div>
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
                        <span class="why-us__stat-number" data-count="10000" data-suffix="+">0</span>
                        <span class="why-us__stat-label">Treatments Performed</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--2">
                        <span class="why-us__stat-number" data-count="500" data-suffix="+">0</span>
                        <span class="why-us__stat-label">5-Star Reviews</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--3">
                        <span class="why-us__stat-number" data-count="8" data-suffix="+">0</span>
                        <span class="why-us__stat-label">Years Experience</span>
                    </div>
                    <div class="why-us__image-placeholder">
                        <div class="why-us__image-gradient" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TESTIMONIALS
         ═══════════════════════════════════════════════════════════════ -->
    <section class="testimonials" aria-label="Client testimonials">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Client Love</span>
                <h2 class="section__title">Real Results, Real Stories</h2>
            </div>
            <div class="testimonials__grid reveal">
                <article class="testimonial-card">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"The team at Livia made me feel so comfortable. My results look completely natural — my friends just say I look 'refreshed.' Exactly what I wanted!"</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" aria-hidden="true">JM</div>
                        <div>
                            <span class="testimonial-card__name">Jessica M.</span>
                            <span class="testimonial-card__treatment">Botox &amp; Fillers</span>
                        </div>
                    </div>
                </article>
                <article class="testimonial-card testimonial-card--featured">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"I've been to several med spas in Tampa, and Livia is by far the best. The attention to detail, the luxury atmosphere, and the incredible results speak for themselves."</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" aria-hidden="true">SR</div>
                        <div>
                            <span class="testimonial-card__name">Sarah R.</span>
                            <span class="testimonial-card__treatment">Microneedling + PRP</span>
                        </div>
                    </div>
                </article>
                <article class="testimonial-card">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"The laser treatment completely transformed my skin. Dark spots are gone, texture is smoother. I can't stop touching my face! Highly recommend."</p>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" aria-hidden="true">AT</div>
                        <div>
                            <span class="testimonial-card__name">Amanda T.</span>
                            <span class="testimonial-card__treatment">Laser Skin Rejuvenation</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         CTA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-section" id="book" aria-label="Book a consultation">
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
