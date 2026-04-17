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
    "@type": ["MedicalBusiness", "HealthAndBeautyBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Livia Med Spa",
    "alternateName": "Livia Medical Spa Tampa",
    "description": "Tampa's premier medical spa offering Botox, dermal fillers, RF microneedling, laser treatments, and medical-grade skincare led by Angela Spicola, APRN.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18132302219",
    "email": "support@liviamedspa.com",
    "currenciesAccepted": "USD",
    "paymentAccepted": "Cash, Credit Card, AMEX, Visa, MasterCard",
    "priceRange": "$$-$$$",
    "image": "https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png",
    "logo": "https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "10043 N Dale Mabry Hwy",
        "addressLocality": "Tampa",
        "addressRegion": "FL",
        "postalCode": "33618",
        "addressCountry": "US"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "28.0764",
        "longitude": "-82.5205"
    },
    "areaServed": [
        { "@type": "City", "name": "Tampa" },
        { "@type": "City", "name": "Westchase" },
        { "@type": "City", "name": "Carrollwood" },
        { "@type": "City", "name": "Lutz" },
        { "@type": "City", "name": "Odessa" },
        { "@type": "City", "name": "Land O' Lakes" }
    ],
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday"],
            "opens": "09:00",
            "closes": "19:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Thursday", "Friday", "Saturday"],
            "opens": "09:00",
            "closes": "16:00"
        }
    ],
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Medical Spa Services",
        "itemListElement": [
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Botox & Neuromodulators", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Dermal Fillers", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "RF Microneedling", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Laser Hair Removal", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Chemical Peels", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Medical-Grade Facials", "areaServed": "Tampa, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Beauty Bank Membership", "areaServed": "Tampa, FL" } }
        ]
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "70",
        "bestRating": "5",
        "worstRating": "1"
    },
    "sameAs": [
        "https://www.instagram.com/liviamedspa/",
        "https://www.facebook.com/p/Livia-Med-Spa-61561610168278/"
    ],
    "founder": {
        "@type": "Person",
        "name": "Angela Spicola",
        "jobTitle": "APRN, Board-Certified Aesthetic Provider",
        "worksFor": { "@id": "<?php echo esc_url(home_url('/')); ?>#business" }
    }
}
</script>

    <!-- ═══════════════════════════════════════════════════════════════
         HERO SECTION — above the fold, no lazy loading
         ═══════════════════════════════════════════════════════════════ -->
    <section class="hero" id="hero" aria-label="Welcome to Livia Med Spa">

        <!-- Background layers -->
        <div class="hero__bg-overlay" aria-hidden="true"></div>
        <div class="hero__aurora" aria-hidden="true">
            <div class="hero__aurora-blob hero__aurora-blob--1"></div>
            <div class="hero__aurora-blob hero__aurora-blob--2"></div>
            <div class="hero__aurora-blob hero__aurora-blob--3"></div>
        </div>
        <div class="hero__particles" aria-hidden="true">
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
                <span class="hero__badge">✦ Tampa's Premier Aesthetics Studio</span>

                <h1 class="hero__title">
                    Where Science<br>
                    Meets <em>Beauty</em>
                </h1>

                <div class="hero__divider" aria-hidden="true"></div>

                <p class="hero__subtitle">Advanced aesthetic treatments tailored to enhance your natural beauty — delivered by Tampa's most trusted medical professionals.</p>

                <div class="hero__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">
                        Book Consultation
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
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
                        <span class="hero__stat-num">3+</span>
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
            <div class="hero__visual" aria-hidden="true">

                <!-- Cutout model image with bottom fade -->
                <div class="hero__model">
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png"
                         alt="Livia Med Spa aesthetic treatment model"
                         class="hero__model-img"
                         fetchpriority="high"
                         decoding="async"
                         width="600"
                         height="932">
                </div>

                <!-- Floating treatment badges -->
                <div class="hero__visual-badge hero__visual-badge--1">
                    <span>💉</span> Botox &amp; Fillers
                </div>
                <div class="hero__visual-badge hero__visual-badge--2">
                    <span>✨</span> Laser Treatments
                </div>
                <div class="hero__visual-badge hero__visual-badge--3">
                    <span>🌿</span> Medical-Grade Skincare
                </div>
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
                <span class="trust-ticker__item">✦ 70+ Five-Star Reviews</span>
                <span class="trust-ticker__item">✦ HIPAA Compliant</span>
                <span class="trust-ticker__item">✦ Allergan Partner</span>
                <span class="trust-ticker__item">✦ Galderma Partner</span>
                <span class="trust-ticker__item">✦ Complimentary Consultations</span>
                <span class="trust-ticker__item">✦ Tampa's #1 Med Spa</span>
                <!-- Duplicate for seamless loop -->
                <span class="trust-ticker__item">✦ FDA Approved Products</span>
                <span class="trust-ticker__item">✦ Board-Certified Providers</span>
                <span class="trust-ticker__item">✦ 70+ Five-Star Reviews</span>
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
         AGELESS AI — Before/After Transformation Preview
         ═══════════════════════════════════════════════════════════════ -->
    <section class="ai-preview" id="ai-preview" aria-label="AI-powered treatment preview">
        <div class="ai-preview__inner section__inner">
            <div class="ai-preview__layout">

                <!-- LEFT: Carousel -->
                <div class="ai-preview__left">
                    <div class="ai-preview__carousel" id="aiCarousel">
                        <div class="ai-preview__stage">
                            <div class="ai-preview__track" id="aiTrack">

                                <!-- Slide 1: Phil -->
                                <div class="ai-preview__slide">
                                    <div class="ai-preview__card">
                                        <div class="ai-preview__slider" data-ai-slider>
                                            <img class="ai-preview__img ai-preview__img--before"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/phil-before.0fh3d~ztkb16..jpg' ) ); ?>"
                                                alt="Phil — before treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <img class="ai-preview__img ai-preview__img--after"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/phil-after.0hhz6q..2jt~p.jpg' ) ); ?>"
                                                alt="Phil — AI preview after treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <span class="ai-preview__label ai-preview__label--before">Before</span>
                                            <span class="ai-preview__label ai-preview__label--after">AI Preview</span>
                                            <div class="ai-preview__divider"></div>
                                        </div>
                                        <div class="ai-preview__card-footer">
                                            <div class="ai-preview__name">Phil</div>
                                            <div class="ai-preview__treatment">Body Contouring</div>
                                            <div class="ai-preview__badge">Ageless AI</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 2: Courtney -->
                                <div class="ai-preview__slide">
                                    <div class="ai-preview__card">
                                        <div class="ai-preview__slider" data-ai-slider>
                                            <img class="ai-preview__img ai-preview__img--before"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/courtney-before.0zffl2pbfkg_4.png' ) ); ?>"
                                                alt="Courtney — before treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <img class="ai-preview__img ai-preview__img--after"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/courtney-after.0ef7079sn6uaf.png' ) ); ?>"
                                                alt="Courtney — AI preview after treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <span class="ai-preview__label ai-preview__label--before">Before</span>
                                            <span class="ai-preview__label ai-preview__label--after">AI Preview</span>
                                            <div class="ai-preview__divider"></div>
                                        </div>
                                        <div class="ai-preview__card-footer">
                                            <div class="ai-preview__name">Courtney</div>
                                            <div class="ai-preview__treatment">Facial Rejuvenation</div>
                                            <div class="ai-preview__badge">Ageless AI</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 3: Eric -->
                                <div class="ai-preview__slide">
                                    <div class="ai-preview__card">
                                        <div class="ai-preview__slider" data-ai-slider>
                                            <img class="ai-preview__img ai-preview__img--before"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/eric-before.10zwxajum~4my.png' ) ); ?>"
                                                alt="Eric — before treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <img class="ai-preview__img ai-preview__img--after"
                                                src="<?php echo esc_url( livia_cached_image_url( 'https://www.ageless.ai/_next/static/media/erica-after.03p5i6nizrcdp.png' ) ); ?>"
                                                alt="Eric — AI preview after treatment" loading="lazy" decoding="async"
                                                width="800" height="1067">
                                            <span class="ai-preview__label ai-preview__label--before">Before</span>
                                            <span class="ai-preview__label ai-preview__label--after">AI Preview</span>
                                            <div class="ai-preview__divider"></div>
                                        </div>
                                        <div class="ai-preview__card-footer">
                                            <div class="ai-preview__name">Eric</div>
                                            <div class="ai-preview__treatment">Anti-Aging Treatments</div>
                                            <div class="ai-preview__badge">Ageless AI</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Dots -->
                        <div class="ai-preview__dots" id="aiDots" role="tablist" aria-label="Before & After slides">
                            <button class="ai-preview__dot is-active" role="tab" aria-selected="true" data-index="0" aria-label="Slide 1 — Phil"></button>
                            <button class="ai-preview__dot" role="tab" aria-selected="false" data-index="1" aria-label="Slide 2 — Courtney"></button>
                            <button class="ai-preview__dot" role="tab" aria-selected="false" data-index="2" aria-label="Slide 3 — Eric"></button>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Content -->
                <div class="ai-preview__right">
                    <div class="ai-preview__header reveal">
                        <span class="section__label">AI-Powered Visualization</span>
                        <h2 class="section__title">See Your Results<br><em>Before</em> You Book</h2>
                        <p class="ai-preview__desc">Upload a selfie and instantly see a photorealistic AI preview of what aesthetic treatments could look like on <em>your</em> face — personalized, private, and under a minute.</p>
                    </div>

                    <div class="ai-preview__cta reveal">
                        <p class="ai-preview__cta-text">Real AI-generated previews, not stock photos. Try it with your own face in under 60 seconds.</p>
                        <a class="btn btn--primary btn--lg"
                           href="https://ageless.ai/a/liviamedspa/transformation?utm_source=website&utm_medium=website"
                           target="_blank" rel="noopener">
                            See My AI Preview
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <div class="ai-preview__trust">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                            Private · Under a minute · Powered by Ageless AI
                        </div>
                    </div>

                    <div class="ai-preview__powered reveal">
                        <span class="ai-preview__powered-dot"></span>
                        Clinically Accurate AI Visualization by Ageless
                        <span class="ai-preview__powered-dot"></span>
                    </div>
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
        <div class="section__inner">
            <div class="product-showcase__layout">
                <div class="product-showcase__content reveal">
                    <span class="section__label">Medical-Grade Skincare</span>
                    <h2 class="section__title">Professional Products,<br>Exceptional Results</h2>
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
                        <img src="https://liviamedspa.com/wp-content/uploads/2026/04/Hydrinity.png"
                             alt="Hydrinity medical-grade skincare products available at Livia Med Spa"
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
                        <a href="https://us.fullscript.com/welcome/liviamedspa" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Shop Our Supplement Store →</a>
                        <span class="supplements__discount">10% off retail — exclusive to Livia patients</span>
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
                            <p class="supplement-feature__text">Fast shipping with 10% off retail for Livia patients</p>
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
                        <span class="why-us__stat-number">500+</span>
                        <span class="why-us__stat-label">Patients Treated</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--2">
                        <span class="why-us__stat-number">70+</span>
                        <span class="why-us__stat-label">5-Star Reviews</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--3">
                        <span class="why-us__stat-number">3+</span>
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
         TESTIMONIALS — Split Layout
         ═══════════════════════════════════════════════════════════════ -->
    <section class="testimonials-split" aria-label="Client testimonials">
        <div class="section__inner">
            <div class="testimonials-split__layout">

                <!-- Left: Cutout Image -->
                <div class="testimonials-split__visual reveal">
                    <div class="testimonials-split__img-wrap">
                        <img src="https://liviamedspa.com/wp-content/uploads/2026/02/Livia-visual-3-1-e1770845322806-768x924.png"
                             alt="Livia Med Spa client"
                             width="768" height="924"
                             loading="lazy" decoding="async">
                    </div>
                    <!-- Google Rating Badge -->
                    <div class="testimonials-split__badge">
                        <div class="testimonials-split__badge-stars">★★★★★</div>
                        <span class="testimonials-split__badge-text">5.0 on Google · 70+ Reviews</span>
                    </div>
                </div>

                <!-- Right: Reviews -->
                <div class="testimonials-split__content reveal">
                    <span class="section__label">Client Love</span>
                    <h2 class="section__title">Real Results,<br><em>Real Stories</em></h2>
                    <p class="section__desc">Hear what our clients have to say about their experience at Livia Med Spa.</p>

                    <div class="testimonials-split__cards">
                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"I have been getting Botox for about 5 years now and I can say hands-down this has been the best treatment I have ever had! Angie was extremely professional. Her equipment was top notch and like nothing I've ever seen before."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Lindsay S.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>

                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"Angie is the best! I've been coming to her for over a year now. I do my Botox and my microneedling and she never fails me. She's also really nice, makes you feel comfortable and so welcoming."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Luna</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>

                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"I can't say enough great things about Angie. She has been so helpful and kind as I start my journey. She has been there every step of the way if I have questions or concerns. I would 1000/10 recommend Angie!"</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Sydney M.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         LATEST FROM THE BLOG
         ═══════════════════════════════════════════════════════════════ -->
    <section class="blog-section" aria-label="Latest blog posts">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Beauty Intel</span>
                <h2 class="section__title">Latest from the Blog</h2>
                <p class="section__desc">Expert tips, treatment guides, and the latest in aesthetic medicine.</p>
            </div>

            <div class="blog-grid">
                <?php
                $blog_posts = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'no_found_rows'  => true,
                ]);

                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) : $blog_posts->the_post();
                        $categories = get_the_category();
                        $cat_name = !empty($categories) ? $categories[0]->name : 'Beauty';
                ?>
                    <article class="blog-card reveal">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <div class="blog-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                <?php else : ?>
                                    <div class="blog-card__img--placeholder">
                                        <span>📝</span>
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
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <!-- Placeholder cards when no posts exist yet -->
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>💉</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Injectables</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">Botox vs. Fillers: Which Is Right for You?</h3>
                            <p class="blog-card__excerpt">Understanding the difference between neuromodulators and dermal fillers to choose the best treatment.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>✨</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Skincare</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">The Ultimate Guide to Medical-Grade Skincare</h3>
                            <p class="blog-card__excerpt">Why medical-grade products outperform drugstore brands and how to build your routine.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>🔬</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Treatments</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">What to Expect at Your First Med Spa Visit</h3>
                            <p class="blog-card__excerpt">A complete walkthrough of your consultation, treatment, and aftercare at Livia Med Spa.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <div style="text-align:center; margin-top:2.5rem;">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--outline">View All Posts →</a>
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
                <a href="#book-now" class="btn btn--primary btn--lg">Book Free Consultation</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
