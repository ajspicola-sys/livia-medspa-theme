<?php
/**
 * Template Name: Homepage
 *
 * The front page template — hero, services, before/afters, about, testimonials, CTA.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

// Gather data
$hero_heading    = get_theme_mod('livia_hero_heading', 'Look & feel your absolute best.');
$hero_subheading = get_theme_mod('livia_hero_subheading', 'Expert aesthetic treatments tailored to you. From Botox and fillers to medical-grade lasers, we customize every treatment to your unique skin and goals.');
$hero_bg_id      = get_theme_mod('livia_hero_bg', '');
$hero_bg_url     = $hero_bg_id ? wp_get_attachment_image_url($hero_bg_id, 'livia-hero') : LIVIA_URI . '/assets/images/hero-placeholder.jpg';
$booking_url     = get_theme_mod('livia_booking_url', '#book');
$review_count    = get_theme_mod('livia_review_count', '67');
$review_rating   = get_theme_mod('livia_review_rating', '5.0');
?>

<!-- ═══════════════════════════════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="hero" id="hero">
    <div class="hero__bg">
        <?php if ($hero_bg_id) : ?>
            <img src="<?php echo esc_url($hero_bg_url); ?>" alt="Livia Med Spa Tampa" class="hero__bg-image" loading="eager">
        <?php endif; ?>
        <div class="hero__bg-overlay"></div>
    </div>
    
    <!-- Animated mesh + orbs -->
    <div class="hero__mesh"></div>
    <div class="hero__orb hero__orb--1"></div>
    <div class="hero__orb hero__orb--2"></div>
    <div class="hero__orb hero__orb--3"></div>
    
    <div class="hero__content container">
        <div class="hero__badge animate-on-scroll">
            <span class="hero__badge-dot"></span>
            Medical-Grade Aesthetics
        </div>
        
        <h1 class="hero__title animate-on-scroll">
            <?php echo esc_html($hero_heading); ?>
        </h1>
        
        <p class="hero__subtitle animate-on-scroll">
            <?php echo esc_html($hero_subheading); ?>
        </p>
        
        <div class="hero__cta-group animate-on-scroll">
            <a href="<?php echo esc_url($booking_url); ?>" class="btn btn--primary btn--lg">
                Book a Consultation
                <?php echo livia_icon('arrow-right', 18); ?>
            </a>
            <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn btn--glass btn--lg">
                Explore Services
            </a>
        </div>
        
        <div class="hero__stats animate-on-scroll">
            <div class="hero__stat">
                <span class="hero__stat-number" data-count="200">0</span><span class="hero__stat-plus">+</span>
                <span class="hero__stat-label">Happy Clients</span>
            </div>
            <div class="hero__stat-divider"></div>
            <div class="hero__stat">
                <span class="hero__stat-number"><?php echo esc_html($review_rating); ?></span>
                <span class="hero__stat-label">
                    <span class="hero__stat-stars">
                        <?php for ($i = 0; $i < 5; $i++) echo livia_icon('star', 14); ?>
                    </span>
                    Google Rating
                </span>
            </div>
            <div class="hero__stat-divider"></div>
            <div class="hero__stat">
                <span class="hero__stat-number">Medical</span>
                <span class="hero__stat-label">Grade Treatments</span>
            </div>
        </div>
    </div>
    
    <div class="hero__scroll-indicator">
        <div class="hero__scroll-mouse">
            <div class="hero__scroll-wheel"></div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     TRUST MARQUEE BAR
     ═══════════════════════════════════════════════════════════════════════ -->
<div class="trust-marquee">
    <div class="trust-marquee__track">
        <div class="trust-marquee__content">
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Board Certified Providers</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> 200+ Happy Clients</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> 5.0 Google Rating</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Medical Grade Treatments</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Personalized Care Plans</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Tampa's Premier Med Spa</span>
        </div>
        <div class="trust-marquee__content" aria-hidden="true">
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Board Certified Providers</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> 200+ Happy Clients</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> 5.0 Google Rating</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Medical Grade Treatments</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Personalized Care Plans</span>
            <span class="trust-marquee__item"><span class="trust-marquee__dot"></span> Tampa's Premier Med Spa</span>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════
     SERVICES SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section section--cream" id="services">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Our Services</span>
            <h2 class="section-title">Expert Treatments,<br>Exceptional Results</h2>
            <hr class="section-divider">
            <p class="section-subtitle">From injectables and laser treatments to customized skincare solutions — every service is performed with precision and care.</p>
        </div>
        
        <div class="services-grid stagger-children">
            <?php
            $services = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => 8,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);
            
            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $short_desc  = get_post_meta(get_the_ID(), '_livia_short_description', true);
                    $price_range = get_post_meta(get_the_ID(), '_livia_price_range', true);
                    $duration    = get_post_meta(get_the_ID(), '_livia_duration', true);
                    $categories  = get_the_terms(get_the_ID(), 'service_category');
                    $cat_name    = ($categories && !is_wp_error($categories)) ? $categories[0]->name : '';
            ?>
                <a href="<?php the_permalink(); ?>" class="service-card animate-on-scroll">
                    <div class="service-card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('livia-card', ['loading' => 'lazy']); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:var(--color-cream);display:flex;align-items:center;justify-content:center;color:var(--color-gray-400);font-size:var(--text-sm);">Image Coming Soon</div>
                        <?php endif; ?>
                        <?php if ($cat_name) : ?>
                            <span class="service-card__category"><?php echo esc_html($cat_name); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="service-card__content">
                        <h3 class="service-card__title"><?php the_title(); ?></h3>
                        <?php if ($short_desc) : ?>
                            <p class="service-card__desc"><?php echo esc_html($short_desc); ?></p>
                        <?php endif; ?>
                        <div class="service-card__meta">
                            <?php if ($price_range) : ?>
                                <span><?php echo livia_icon('dollar', 14); ?> <?php echo esc_html($price_range); ?></span>
                            <?php endif; ?>
                            <?php if ($duration) : ?>
                                <span><?php echo livia_icon('clock', 14); ?> <?php echo esc_html($duration); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="service-card__arrow"><?php echo livia_icon('arrow-right', 16); ?></span>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <!-- Placeholder cards when no services exist yet -->
                <?php
                $placeholder_services = ['Botox', 'Dermal Fillers', 'Microneedling', 'Chemical Peels', 'CO2 Laser', 'PRP Facial', 'Hair Restoration', 'Laser Treatments'];
                foreach ($placeholder_services as $name) :
                ?>
                <div class="service-card animate-on-scroll">
                    <div class="service-card__image">
                        <div style="width:100%;height:100%;background:linear-gradient(135deg, var(--color-cream) 0%, var(--color-blush-light) 100%);display:flex;align-items:center;justify-content:center;">
                            <span style="font-family:var(--font-heading);font-size:var(--text-lg);color:var(--color-gold);"><?php echo esc_html($name); ?></span>
                        </div>
                    </div>
                    <div class="service-card__content">
                        <h3 class="service-card__title"><?php echo esc_html($name); ?></h3>
                        <p class="service-card__desc">Expert treatment tailored to your unique skin and goals.</p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="text-center" style="margin-top: var(--space-3xl);">
            <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn btn--secondary">
                View All Services <?php echo livia_icon('arrow-right', 16); ?>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     BEFORE & AFTER SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section section--dark" id="results">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Real Results</span>
            <h2 class="section-title">Before & After<br>Transformations</h2>
            <hr class="section-divider">
            <p class="section-subtitle" style="color: var(--color-gray-400);">See the real results our clients achieve. Every transformation is a testament to our commitment to excellence.</p>
        </div>
        
        <div class="ba-showcase stagger-children">
            <?php
            $before_afters = new WP_Query([
                'post_type'      => 'before_after',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            
            if ($before_afters->have_posts()) :
                while ($before_afters->have_posts()) : $before_afters->the_post();
                    $before_img = get_post_meta(get_the_ID(), '_livia_before_image', true);
                    $after_img  = get_post_meta(get_the_ID(), '_livia_after_image', true);
                    $service_id = get_post_meta(get_the_ID(), '_livia_related_service', true);
                    $service_name = $service_id ? get_the_title($service_id) : '';
            ?>
                <div class="ba-item animate-on-scroll">
                    <div class="ba-slider" data-ba-slider>
                        <div class="ba-slider__after">
                            <?php if ($after_img) : ?>
                                <img src="<?php echo esc_url(wp_get_attachment_image_url($after_img, 'livia-ba')); ?>" alt="After - <?php the_title(); ?>" loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="ba-slider__before">
                            <?php if ($before_img) : ?>
                                <img src="<?php echo esc_url(wp_get_attachment_image_url($before_img, 'livia-ba')); ?>" alt="Before - <?php the_title(); ?>" loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="ba-slider__divider"></div>
                        <div class="ba-slider__handle">⇔</div>
                        <span class="ba-slider__label ba-slider__label--before">Before</span>
                        <span class="ba-slider__label ba-slider__label--after">After</span>
                    </div>
                    <?php if ($service_name) : ?>
                        <p class="ba-item__service"><?php echo esc_html($service_name); ?></p>
                    <?php endif; ?>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="ba-placeholder animate-on-scroll">
                    <div class="ba-placeholder__inner">
                        <h3 style="color: var(--color-cream); font-family: var(--font-heading); font-size: var(--text-2xl); margin-bottom: var(--space-md);">Transformations Coming Soon</h3>
                        <p style="color: var(--color-gray-400);">Our before & after gallery will be updated with real client results. Check back soon!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($before_afters->have_posts()) : ?>
        <div class="text-center" style="margin-top: var(--space-3xl);">
            <a href="<?php echo esc_url(get_post_type_archive_link('before_after')); ?>" class="btn btn--secondary" style="border-color: var(--color-gold-light); color: var(--color-gold-light);">
                See All Results <?php echo livia_icon('arrow-right', 16); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     ABOUT SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about__image animate-on-scroll from-left">
                <div class="about__image-frame">
                    <?php
                    $about_page = get_page_by_path('about');
                    if ($about_page && has_post_thumbnail($about_page->ID)) :
                        echo get_the_post_thumbnail($about_page->ID, 'livia-portrait', ['class' => 'about__photo', 'loading' => 'lazy']);
                    else :
                    ?>
                        <div class="about__photo-placeholder">
                            <span style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-gold);">L</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="about__image-accent"></div>
                <div class="about__experience-badge">
                    <span class="about__experience-number"><?php echo esc_html($review_rating); ?></span>
                    <span class="about__experience-stars">
                        <?php for ($i = 0; $i < 5; $i++) echo livia_icon('star', 12); ?>
                    </span>
                    <span class="about__experience-text"><?php echo esc_html($review_count); ?> Reviews</span>
                </div>
            </div>
            
            <div class="about__content animate-on-scroll from-right">
                <span class="section-label">About Livia</span>
                <h2 class="section-title" style="text-align: left;">The Livia<br>Difference</h2>
                <hr class="section-divider" style="margin-left: 0;">
                <p>At Livia Med Spa, we believe aesthetics should enhance your natural beauty while helping you feel confident in your own skin.</p>
                <p>Located in Tampa, our med spa blends advanced medical expertise with personalized care to deliver results that look refreshed, balanced, and natural.</p>
                <p>Our team focuses on treatments that support healthy, radiant skin — from injectables and laser treatments to customized skincare solutions. Every service is performed with precision and attention to detail.</p>
                
                <div class="about__features">
                    <div class="about__feature">
                        <div class="about__feature-icon">✓</div>
                        <div>
                            <strong>Board Certified</strong>
                            <span>Licensed medical professionals</span>
                        </div>
                    </div>
                    <div class="about__feature">
                        <div class="about__feature-icon">✓</div>
                        <div>
                            <strong>Personalized Care</strong>
                            <span>Treatment plans tailored to you</span>
                        </div>
                    </div>
                    <div class="about__feature">
                        <div class="about__feature-icon">✓</div>
                        <div>
                            <strong>Medical Grade</strong>
                            <span>FDA-approved treatments only</span>
                        </div>
                    </div>
                </div>
                
                <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn--dark" style="margin-top: var(--space-xl);">
                    Learn Our Story <?php echo livia_icon('arrow-right', 16); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     AI PREVIEW SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section section--blush" id="ai-preview">
    <div class="container">
        <div class="ai-preview animate-on-scroll">
            <div class="ai-preview__content">
                <span class="section-label">AI-Powered</span>
                <h2 class="section-title" style="text-align: left;">See Your Results<br>Before You Book</h2>
                <hr class="section-divider" style="margin-left: 0;">
                <p>Upload a selfie and instantly see a photorealistic AI preview of what aesthetic treatments could look like on your face — personalized, private, and under a minute.</p>
                <ul class="ai-preview__features">
                    <li>Real AI-generated previews, not stock photos</li>
                    <li>Try it with your own face in under 60 seconds</li>
                    <li>Private · Secure · HIPAA Compliant</li>
                </ul>
                <a href="#" class="btn btn--primary btn--lg" style="margin-top: var(--space-lg);">
                    See My AI Preview <?php echo livia_icon('arrow-right', 18); ?>
                </a>
                <p class="ai-preview__powered">Powered by Ageless AI</p>
            </div>
            <div class="ai-preview__visual">
                <div class="ai-preview__mockup">
                    <div class="ai-preview__screen">
                        <div class="ai-preview__placeholder">
                            <span style="font-size: var(--text-3xl);">🪞</span>
                            <span style="color: var(--color-gold); font-family: var(--font-heading); font-size: var(--text-lg);">AI Preview</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     TESTIMONIALS SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section" id="testimonials">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <span class="section-label">Client Testimonials</span>
            <h2 class="section-title">What Our Clients Say</h2>
            <hr class="section-divider">
        </div>
        
        <div class="testimonials-grid stagger-children">
            <?php
            // Testimonials — can be managed via a simple custom query or hardcoded
            $testimonials = [
                [
                    'quote'  => 'Livia Med Spa is by far the best med spa in Tampa. The results exceeded my expectations and the staff made me feel so comfortable throughout the entire process.',
                    'name'   => 'Sarah M.',
                    'role'   => 'Botox & Fillers Client',
                    'rating' => 5,
                ],
                [
                    'quote'  => 'I\'ve been to many med spas but Livia is truly different. Their attention to detail and personalized approach made all the difference. My skin has never looked better!',
                    'name'   => 'Jessica R.',
                    'role'   => 'Facial Rejuvenation',
                    'rating' => 5,
                ],
                [
                    'quote'  => 'The team at Livia is incredibly knowledgeable and professional. They took the time to understand exactly what I wanted and delivered natural-looking results.',
                    'name'   => 'Michelle K.',
                    'role'   => 'Laser Treatment Client',
                    'rating' => 5,
                ],
            ];
            
            foreach ($testimonials as $testimonial) :
            ?>
            <div class="testimonial-card animate-on-scroll">
                <div class="testimonial-card__stars">
                    <?php for ($i = 0; $i < $testimonial['rating']; $i++) echo livia_icon('star', 16); ?>
                </div>
                <p class="testimonial-card__quote">"<?php echo esc_html($testimonial['quote']); ?>"</p>
                <div class="testimonial-card__author">
                    <div>
                        <div class="testimonial-card__name"><?php echo esc_html($testimonial['name']); ?></div>
                        <div class="testimonial-card__role"><?php echo esc_html($testimonial['role']); ?></div>
                    </div>
                </div>
                <span class="testimonial-card__icon">"</span>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center" style="margin-top: var(--space-3xl);">
            <div class="google-reviews-badge animate-on-scroll">
                <div class="google-reviews-badge__stars">
                    <?php for ($i = 0; $i < 5; $i++) echo livia_icon('star', 18); ?>
                </div>
                <span class="google-reviews-badge__text">
                    <?php echo esc_html($review_rating); ?> out of 5 · Based on <?php echo esc_html($review_count); ?> Google Reviews
                </span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     CTA SECTION
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="section cta-section" id="book">
    <div class="cta-section__bg"></div>
    <div class="container">
        <div class="cta-section__inner animate-on-scroll">
            <span class="section-label" style="color: var(--color-gold-light);">Ready for Your Transformation?</span>
            <h2 class="cta-section__title">Book Your<br>Consultation Today</h2>
            <p class="cta-section__text">Take the first step towards looking and feeling your best. Our expert team is ready to create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url($booking_url); ?>" class="btn btn--primary btn--lg">
                    Book a Consultation <?php echo livia_icon('arrow-right', 18); ?>
                </a>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('livia_phone', '8132302219'))); ?>" class="btn btn--glass btn--lg">
                    <?php echo livia_icon('phone', 18); ?>
                    <?php echo esc_html(get_theme_mod('livia_phone', '(813) 230-2219')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
