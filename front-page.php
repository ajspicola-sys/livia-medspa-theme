<?php
/**
 * Template Name: Homepage
 * LIVIA Med Spa — Front Page
 * Performance-optimized: lazy loading, fetchpriority, semantic HTML
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <?php
    // Structured data (MedicalBusiness, WebSite, FAQ, Reviews) is output once
    // via wp_head() — see livia_schema_markup() and related hooks in functions.php.
    // Do not add page-level JSON-LD here; duplicate business entities with
    // conflicting data confuse Google and AI crawlers.
    ?>

    <!-- ═══════════════════════════════════════════════════════════════
         HERO SECTION — above the fold, no lazy loading
         ═══════════════════════════════════════════════════════════════ -->
    <section class="hero" id="hero" aria-label="Welcome to LIVIA Med Spa">

        <!-- Background layers -->
        <div class="hero__bg-overlay"></div>
        <div class="hero__aurora">
            <div class="hero__aurora-blob hero__aurora-blob--1"></div>
            <div class="hero__aurora-blob hero__aurora-blob--2"></div>
            <div class="hero__aurora-blob hero__aurora-blob--3"></div>
        </div>
        <div class="hero__particles">
            <span class="hero__particle" style="--x:10%;--y:20%;--delay:0s;--size:3px;"></span>
            <span class="hero__particle" style="--x:85%;--y:15%;--delay:1s;--size:2px;"></span>
            <span class="hero__particle" style="--x:70%;--y:60%;--delay:2s;--size:4px;"></span>
            <span class="hero__particle" style="--x:25%;--y:75%;--delay:0.5s;--size:2px;"></span>
            <span class="hero__particle" style="--x:50%;--y:35%;--delay:1.5s;--size:3px;"></span>
            <span class="hero__particle" style="--x:90%;--y:80%;--delay:3s;--size:2px;"></span>
            <span class="hero__particle" style="--x:35%;--y:10%;--delay:2.5s;--size:2px;"></span>
            <span class="hero__particle" style="--x:60%;--y:88%;--delay:0.8s;--size:3px;"></span>
        </div>

        <div class="hero__inner">
            <!-- LEFT: Content -->
            <div class="hero__content">
                <span class="hero__badge">✦ Tampa's #1 Med Spa</span>

                <h1 class="hero__title">
                    Tampa's Premier
                    <em>Med Spa</em>
                </h1>

                <div class="hero__divider" aria-hidden="true"></div>

                <p class="hero__subtitle">Advanced aesthetic treatments in Tampa, FL — Botox, fillers, laser & RF microneedling delivered by Angela Spicola, APRN.</p>

                <div class="hero__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">
                        Book Consultation
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">View Services</a>
                </div>

                <!-- Stats row -->
                <div class="hero__stats" aria-label="Practice highlights">
                    <div class="hero__stat">
                        <span class="hero__stat-num">500+</span>
                        <span class="hero__stat-label">Patients Treated</span>
                    </div>
                    <div class="hero__stat-divider" aria-hidden="true"></div>
                    <div class="hero__stat">
                        <span class="hero__stat-num">20+</span>
                        <span class="hero__stat-label">Years Experience</span>
                    </div>
                    <div class="hero__stat-divider" aria-hidden="true"></div>
                    <div class="hero__stat">
                        <span class="hero__stat-num">5★</span>
                        <span class="hero__stat-label">Google Rating</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Model image -->
            <div class="hero__visual">

                <!-- Cutout model image with bottom fade -->
                <div class="hero__model">
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png"
                         alt="LIVIA Med Spa Tampa — Botox, fillers & aesthetic treatments by Angela Spicola APRN"
                         class="hero__model-img"
                         fetchpriority="high"
                         decoding="async"
                         width="600"
                         height="932">
                </div>

                <!-- Floating treatment badges -->
                <div class="hero__visual-badge hero__visual-badge--1">
                    <span>&#x2726;</span> Botox &amp; Fillers
                </div>
                <div class="hero__visual-badge hero__visual-badge--2">
                    <span>&#x2726;</span> Laser Treatments
                </div>
                <div class="hero__visual-badge hero__visual-badge--3">
                    <span>&#x2726;</span> Medical-Grade Skincare
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="hero__scroll-indicator">
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
                <div class="trust-ticker__group">
                    <span class="trust-ticker__item">✦ FDA Approved Products</span>
                    <span class="trust-ticker__item">✦ Board-Certified Providers</span>
                    <span class="trust-ticker__item">✦ 75+ Five-Star Reviews</span>
                    <span class="trust-ticker__item">✦ HIPAA Compliant</span>
                    <span class="trust-ticker__item">✦ Allergan Partner</span>
                    <span class="trust-ticker__item">✦ Galderma Partner</span>
                    <span class="trust-ticker__item">✦ Tampa's Only Helix CO2 Laser</span>
                    <span class="trust-ticker__item">✦ Complimentary Consultations</span>
                    <span class="trust-ticker__item">✦ Tampa's #1 Med Spa</span>
                </div>
                <div class="trust-ticker__group" aria-hidden="true">
                    <span class="trust-ticker__item">✦ FDA Approved Products</span>
                    <span class="trust-ticker__item">✦ Board-Certified Providers</span>
                    <span class="trust-ticker__item">✦ 75+ Five-Star Reviews</span>
                    <span class="trust-ticker__item">✦ HIPAA Compliant</span>
                    <span class="trust-ticker__item">✦ Allergan Partner</span>
                    <span class="trust-ticker__item">✦ Galderma Partner</span>
                    <span class="trust-ticker__item">✦ Tampa's Only Helix CO2 Laser</span>
                    <span class="trust-ticker__item">✦ Complimentary Consultations</span>
                    <span class="trust-ticker__item">✦ Tampa's #1 Med Spa</span>
                </div>
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
                <h2 class="section__title">Tampa Med Spa Treatments</h2>
                <p class="section__desc">LIVIA Med Spa in Tampa offers Botox, dermal fillers, RF microneedling, laser resurfacing, and more — every treatment customized to your goals by board-certified providers.</p>
            </div>

            <?php
            // Pull services from CPT — capped at 8 for carousel DOM efficiency
            // (carousel shows 1 at a time; full list lives on /services/)
            $services = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => 8,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'no_found_rows'  => true, // Performance: skip pagination count
                'update_post_meta_cache' => true,
                'update_post_term_cache' => false, // We don't need terms
            ]);

            // Shared sparkle icon — matches the journey section's SVG line-icon
            // style (replaces the old per-service emoji for a consistent look)
            $card_icon_svg = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>';
            $card_icon_lg  = str_replace(['width="22"', 'height="22"'], ['width="56"', 'height="56"'], $card_icon_svg);

            // Fallback services if none created yet
            $fallback = [
                ['title' => 'Botox & Dysport', 'text' => 'Smooth away fine lines and wrinkles with precision neurotoxin injections for a refreshed, youthful look.'],
                ['title' => 'Dermal Fillers', 'text' => 'Restore lost volume and sculpt facial contours with premium hyaluronic acid fillers.'],
                ['title' => 'Microneedling', 'text' => 'Stimulate your skin\'s natural collagen production for firmer, smoother, more radiant skin.'],
                ['title' => 'Chemical Peels', 'text' => 'Reveal fresh, glowing skin and reduce discoloration with our medical-grade peel treatments.'],
                ['title' => 'Laser Treatments', 'text' => 'Advanced laser technology for skin resurfacing, pigment correction, and hair removal.'],
                ['title' => 'IV Therapy', 'text' => 'Boost vitality from within with custom vitamin drips designed for energy, glow, and wellness.'],
            ];
            ?>

            <div class="carousel reveal" id="services-carousel" role="region" aria-label="Services carousel" tabindex="0">
                <div class="carousel__track">
                    <?php if ($services->have_posts()) : $i = 0; ?>
                        <?php while ($services->have_posts()) : $services->the_post();
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
                                                <span><?php echo $card_icon_lg; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo $card_icon_svg; ?></div>
                                        <h3 class="carousel-card__title"><?php the_title(); ?></h3>
                                        <p class="carousel-card__text"><?php echo wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 20); ?></p>
                                        <?php if ($price) : ?>
                                            <span class="carousel-card__price">From <?php echo esc_html($price); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="btn btn--primary btn--sm" aria-label="View Treatment — <?php the_title_attribute(); ?>">View Treatment →</a>
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
                                            <span><?php echo $card_icon_lg; ?></span>
                                        </div>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo $card_icon_svg; ?></div>
                                        <h3 class="carousel-card__title"><?php echo esc_html($svc['title']); ?></h3>
                                        <p class="carousel-card__text"><?php echo esc_html($svc['text']); ?></p>
                                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--primary btn--sm" aria-label="View Treatment — <?php echo esc_attr($svc['title']); ?>">View Treatment →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Navigation -->
                <div class="carousel__nav">
                    <button class="carousel__arrow carousel__arrow--prev" aria-label="Previous slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <div class="carousel__dots" id="carousel-dots" aria-label="Slide indicators"></div>
                    <button class="carousel__arrow carousel__arrow--next" aria-label="Next slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="m9 18 6-6-6-6"/></svg>
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
                <h2 class="section__title">Your Botox & Filler Journey in Tampa</h2>
                <p class="section__desc">From your first free consultation to your final results — our Tampa med spa team makes every step seamless, safe, and luxurious.</p>
            </div>
            <div class="journey-steps reveal">
                <div class="journey-step">
                    <div class="journey-step__number">01</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 12h6"/><path d="M9 16h6"/></svg>
                    </div>
                    <h3 class="journey-step__title">Free Consultation</h3>
                    <p class="journey-step__text">Meet with our providers to discuss your goals and get a perfect treatment plan.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">02</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/><path d="m19.07 4.93-1.41 1.41M6.34 17.66l-1.41 1.41M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <h3 class="journey-step__title">Custom Plan</h3>
                    <p class="journey-step__text">Tailored to your unique anatomy, skin type, and aesthetic goals. No cookie-cutter solutions.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">03</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4M3 5h4M19 17v4M17 19h4"/></svg>
                    </div>
                    <h3 class="journey-step__title">Expert Treatment</h3>
                    <p class="journey-step__text">Relax in our luxury suite while certified professionals deliver precision treatments.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">04</div>
                    <div class="journey-step__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="m5 3 1 2M3 4h2M19 17l1 2M17 18h2"/></svg>
                    </div>
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
        <div class="section__inner">
            <div class="product-showcase__layout">
                <div class="product-showcase__content reveal">
                    <span class="section__label">Medical-Grade Skincare</span>
                    <h2 class="section__title">Medical-Grade Skincare Products,<br>Exceptional Results</h2>
                    <p class="product-showcase__text">Available exclusively at our Tampa med spa location — we carry only the most trusted, clinically-proven skincare lines handpicked by Angela Spicola, APRN, to complement your in-office treatments and deliver visible results at home.</p>
                    <div class="product-showcase__features">
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Physician-Strength Formulas</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Clinically Proven Results</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
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
                        <img src="https://liviamedspa.com/wp-content/uploads/2026/04/Hydrinity.png"
                             alt="Hydrinity medical-grade skincare products available at LIVIA Med Spa"
                             class="product-showcase__image"
                             loading="lazy"
                             decoding="async"
                             width="280"
                             height="378">
                        <div class="product-showcase__badge product-showcase__badge--1" aria-hidden="true">
                            <span class="product-showcase__badge-icon">&#x2605;</span>
                            <span class="product-showcase__badge-text">Best Seller</span>
                        </div>
                        <div class="product-showcase__badge product-showcase__badge--2" aria-hidden="true">
                            <span class="product-showcase__badge-icon">&#x2665;</span>
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
                        <a href="https://us.fullscript.com/welcome/liviamedspa" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Shop Our Supplement Store →</a>
                        <span class="supplements__discount">10% off retail — exclusive to LIVIA patients</span>
                    </div>
                    <div class="supplements__partnership">
                        <span class="supplements__partner-label">LIVIA Med Spa</span>
                        <span class="supplements__partner-x">×</span>
                        <span class="supplements__partner-powered">Powered by</span>
                        <span class="supplements__partner-brand">Fullscript</span>
                    </div>
                </div>

                <!-- Right: Feature Cards -->
                <div class="supplements__features reveal">
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">&#x2726;</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Pharmaceutical-Grade Quality</h3>
                            <p class="supplement-feature__text">Top-tier, certified brands hand-picked by our clinical team</p>
                        </div>
                    </div>
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">&#x2726;</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Third-Party Tested</h3>
                            <p class="supplement-feature__text">Every product verified for purity and potency</p>
                        </div>
                    </div>
                    <div class="supplement-feature">
                        <div class="supplement-feature__icon" aria-hidden="true">&#x2726;</div>
                        <div class="supplement-feature__content">
                            <h3 class="supplement-feature__title">Delivered to Your Door</h3>
                            <p class="supplement-feature__text">Fast shipping with 10% off retail for LIVIA patients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHY LIVIA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="why-us" aria-label="Why choose LIVIA Med Spa">
        <div class="section__inner">
            <div class="why-us__grid">
                <div class="why-us__content reveal">
                    <span class="section__label">The LIVIA Difference</span>
                    <h2 class="section__title">Why Tampa Chooses LIVIA Med Spa</h2>
                    <p class="section__desc">Tampa patients choose LIVIA because we don't believe in one-size-fits-all. Every med spa treatment plan is crafted around your unique anatomy, goals, and lifestyle — with results that look natural, never overdone.</p>
                    <div class="why-us__features">
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Board-Certified Team</h4>
                                <p class="why-us__feature-text">Our providers hold advanced certifications in aesthetic medicine.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Precision Artistry</h4>
                                <p class="why-us__feature-text">Subtle, natural-looking results that enhance — never overdo.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Tampa's Only Helix CO2 Laser</h4>
                                <p class="why-us__feature-text">LIVIA is the only med spa in Tampa offering the Helix CO2 Laser — the most advanced skin resurfacing technology available.</p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/team/')); ?>" class="btn btn--primary">Meet Our Team →</a>
                </div>
                <div class="why-us__visual reveal">
                    <div class="why-us__stat-card why-us__stat-card--1">
                        <span class="why-us__stat-number">500+</span>
                        <span class="why-us__stat-label">Patients Treated</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--2">
                        <span class="why-us__stat-number">75+</span>
                        <span class="why-us__stat-label">5-Star Google Reviews</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--3">
                        <span class="why-us__stat-number">20+</span>
                        <span class="why-us__stat-label">Years Experience</span>
                    </div>
                    <div class="why-us__image-placeholder">
                        <img src="https://liviamedspa.com/wp-content/uploads/2026/03/IMG_2626-scaled-e1775741183210.jpg"
                             alt="Inside LIVIA Med Spa Tampa — luxury medical spa treatment room on Dale Mabry Hwy"
                             class="why-us__image"
                             loading="lazy"
                             decoding="async"
                             width="600"
                             height="750">
                        <div class="why-us__image-gradient" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TESTIMONIALS — Split Layout
         ═══════════════════════════════════════════════════════════════ -->
    <section class="testimonials-split" aria-label="Client testimonials">
        <div class="section__inner">
            <div class="testimonials-split__layout">

                <!-- Left: Cutout Image -->
                <div class="testimonials-split__visual reveal">
                    <div class="testimonials-split__img-wrap">
                        <img src="https://liviamedspa.com/wp-content/uploads/2026/02/Livia-visual-3-1-e1770845322806-768x924.png"
                             alt="LIVIA Med Spa client"
                             width="768" height="924"
                             loading="lazy" decoding="async">
                    </div>
                    <!-- Google Rating Badge -->
                    <div class="testimonials-split__badge">
                        <div class="testimonials-split__badge-stars">★★★★★</div>
                        <span class="testimonials-split__badge-text">5.0 on Google · 75+ Tampa Reviews</span>
                    </div>
                </div>

                <!-- Right: Reviews -->
                <div class="testimonials-split__content reveal">
                    <span class="section__label">Client Love</span>
                    <h2 class="section__title">Real Tampa Patient Results,<br><em>Real Stories</em></h2>
                    <p class="section__desc">See what Tampa med spa patients say about their Botox, filler, and laser results at LIVIA.</p>

                    <div class="testimonials-split__cards">
                        <div class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"I have been getting Botox for about 5 years now and I can say hands-down this has been the best treatment I have ever had! Angie was extremely professional. Her equipment was top notch and like nothing I've ever seen before."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Lindsay S.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </div>

                        <div class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"Angie is the best! I've been coming to her for over a year now. I do my Botox and my microneedling and she never fails me. She's also really nice, makes you feel comfortable and so welcoming."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Luna</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </div>

                        <div class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"I can't say enough great things about Angie. She has been so helpful and kind as I start my journey. She has been there every step of the way if I have questions or concerns. I would 1000/10 recommend Angie!"</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Sydney M.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         LATEST FROM THE BLOG — only renders when published posts exist
         ═══════════════════════════════════════════════════════════════ -->
    <?php
    $blog_posts = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'no_found_rows'  => true,
    ]);
    if ($blog_posts->have_posts()) : ?>
    <section class="blog-section" aria-label="Latest blog posts">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Beauty Intel</span>
                <h2 class="section__title">Tampa Med Spa Tips & Guides</h2>
                <p class="section__desc">Expert Botox aftercare tips, filler guides, and the latest in aesthetic medicine from Tampa's premier med spa team.</p>
            </div>
            <div class="blog-grid">
                <?php while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    $categories = get_the_category();
                    $cat_name = !empty($categories) ? $categories[0]->name : 'Beauty';
                ?>
                    <div class="blog-card reveal">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <div class="blog-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                <?php else : ?>
                                    <div class="blog-card__img--placeholder">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <span class="blog-card__cat"><?php echo esc_html($cat_name); ?></span>
                                    <span class="blog-card__date"><?php echo get_the_date('M j, Y'); ?></span>
                                </div>
                                <h3 class="blog-card__title"><?php the_title(); ?></h3>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                <span class="blog-card__read">Read More →</span>
                            </div>
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="blog-section__cta">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--outline">View All Posts →</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════════════
         CTA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-section" id="book" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Book Your Tampa<br>Med Spa Consultation</h2>
            <p class="cta-section__text">Start with a free consultation at LIVIA Med Spa — Tampa's #1 rated medical spa on Dale Mabry Hwy. Our providers will build a personalized treatment plan just for you. Serving Carrollwood, Westchase, North Tampa, Hyde Park, and surrounding areas.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
