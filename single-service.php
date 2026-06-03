<?php
/**
 * LIVIA Med Spa — Single Service Template
 * Premium redesign: Alternating 2-column sections, Expectation full-width bg,
 * side-by-side prep & aftercare columns, FAQ accordion, location map banner.
 * Supports fallback to classic 2-col layout if content is not section-enriched.
 */
get_header();

$post_id      = get_the_ID();
$icon         = get_post_meta($post_id, '_service_icon', true)     ?: '✨';
$price        = get_post_meta($post_id, '_service_price', true);
$duration     = get_post_meta($post_id, '_service_duration', true);
$video        = get_post_meta($post_id, '_service_video', true);
$benefits_raw = get_post_meta($post_id, '_service_benefits', true);
$benefits     = $benefits_raw ? array_filter(array_map('trim', explode("\n", $benefits_raw))) : [];

$categories    = get_the_terms($post_id, 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
$has_image     = has_post_thumbnail();
$post_slug     = get_post_field('post_name', $post_id);

// Convert YouTube / Vimeo URL → embed URL
$video_embed = '';
if ($video) {
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video, $m)) {
        $video_embed = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1&iv_load_policy=3&color=white&playsinline=1&autoplay=1&mute=1&loop=1&playlist=' . $m[1];
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video, $m)) {
        $video_embed = 'https://player.vimeo.com/video/' . $m[1] . '?title=0&byline=0&portrait=0&color=AC13F9';
    }
}

// ── Parse WordPress editor content into section blocks ───────────────────────
$raw_content = get_the_content();
$parts = preg_split('/<h2[^>]*>(.*?)<\/h2>/is', $raw_content, -1, PREG_SPLIT_DELIM_CAPTURE);

$intro_content = trim($parts[0]);
$sections = [];
for ($i = 1; $i < count($parts); $i += 2) {
    if (empty($parts[$i])) continue;
    $sections[] = [
        'heading' => trim(strip_tags($parts[$i])),
        'content' => isset($parts[$i+1]) ? trim($parts[$i+1]) : '',
    ];
}

$is_enriched = (count($sections) >= 3);

// Helper functions for parsing content blocks
if (!function_exists('get_list_from_html')) {
    function get_list_from_html($html) {
        if (preg_match('/<ul[^>]*>(.*?)<\/ul>/is', $html, $m)) {
            return $m[1];
        }
        return '';
    }
}

if (!function_exists('strip_list_from_html')) {
    function strip_list_from_html($html) {
        return preg_replace('/<ul[^>]*>.*?<\/ul>/is', '', $html);
    }
}

// Match sections by keywords
$what_is_sec = null;
$treat_sec = null;
$expect_sec = null;
$aftercare_sec = null;
$plan_sec = null;
$faq_sec = null;

foreach ($sections as $sec) {
    $h = strtolower($sec['heading']);
    if (strpos($h, 'what is') !== false) {
        $what_is_sec = $sec;
    } elseif (strpos($h, 'treat') !== false || strpos($h, 'areas') !== false) {
        $treat_sec = $sec;
    } elseif (strpos($h, 'process') !== false || strpos($h, 'expect') !== false || strpos($h, 'works') !== false) {
        $expect_sec = $sec;
    } elseif (strpos($h, 'aftercare') !== false || strpos($h, 'preparation') !== false) {
        $aftercare_sec = $sec;
    } elseif (strpos($h, 'cost') !== false || strpos($h, 'price') !== false || strpos($h, 'choose') !== false || strpos($h, 'plan') !== false) {
        $plan_sec = $sec;
    } elseif (strpos($h, 'faq') !== false || strpos($h, 'frequently') !== false || strpos($h, 'question') !== false) {
        $faq_sec = $sec;
    }
}

// Image mapping logic for Livia Med Spa services
$default_images = [
    'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
    'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
    'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
    'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
];

if (strpos($post_slug, 'laser') !== false || strpos($post_slug, 'hair') !== false) {
    $service_imgs = [
        'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
        'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
        'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
        'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
    ];
} elseif (strpos($post_slug, 'botox') !== false || strpos($post_slug, 'xeomin') !== false || strpos($post_slug, 'jeuveau') !== false || strpos($post_slug, 'dysport') !== false) {
    $service_imgs = [
        'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_538904225-scaled.jpeg',
        'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_446213685-scaled.jpeg',
        'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
        'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_374628525-scaled.jpeg'
    ];
} elseif (strpos($post_slug, 'filler') !== false || strpos($post_slug, 'radiesse') !== false || strpos($post_slug, 'sculptra') !== false) {
    $service_imgs = [
        'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_260345614-1-scaled.jpeg',
        'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_474297401-1-scaled.jpeg',
        'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
        'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
    ];
} else {
    $service_imgs = $default_images;
}

if (has_post_thumbnail()) {
    $service_imgs['areas_treated'] = get_the_post_thumbnail_url($post_id, 'large');
}

$bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
if ($bottom_photo_id) {
    $bottom_photo_url = wp_get_attachment_url($bottom_photo_id);
    if ($bottom_photo_url) {
        $service_imgs['plan'] = $bottom_photo_url;
    }
}

// Generate pre-treatment & aftercare guidelines
if (!function_exists('livia_get_prep_aftercare')) {
    function livia_get_prep_aftercare($slug, $aftercare_sec) {
        $after_list = '';
        if ($aftercare_sec) {
            $after_list = get_list_from_html($aftercare_sec['content']);
        }
        
        $prep_items = [];
        $after_items = [];
        
        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false || strpos($slug, 'candela') !== false || strpos($slug, 'lhr') !== false) {
            $prep_items = [
                'Shave the treatment area completely 24 hours prior to your session.',
                'Avoid plucking, waxing, or tweezing hair in the target area for 4 weeks.',
                'Avoid direct sun exposure and tanning beds for at least 2 weeks.',
                'Ensure skin is completely free of self-tanner, lotions, oils, and makeup on the day of treatment.'
            ];
            $after_items = [
                'Avoid direct sun exposure on the treated areas and apply broad-spectrum SPF 30+ daily.',
                'Avoid hot tubs, saunas, steam rooms, and hot showers for 24–48 hours.',
                'Postpone strenuous exercise and excessive sweating for 24 hours.',
                'Do not pluck, wax, or tweeze between sessions; shaving is the only permitted hair removal method.'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $prep_items = [
                'Avoid alcohol and blood-thinning supplements for 24-48 hours before treatment.',
                'Arrive with a clean, makeup-free face if possible.',
                'Reschedule if you have an active skin rash, cold sore, or infection in the treatment area.'
            ];
            $after_items = [
                'Keep your head elevated and avoid lying down for 4 hours after treatment.',
                'Avoid rubbing, massaging, or placing pressure on the treated areas for 24 hours.',
                'Postpone strenuous exercise and heavy sweating for 24 hours.',
                'Avoid facials, chemical peels, and microdermabrasion for 2 weeks.'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $prep_items = [
                'Avoid blood-thinning medications and supplements (like aspirin, fish oil) for 1 week prior.',
                'Avoid alcohol intake for 24-48 hours prior to your appointment to minimize bruising.',
                'Plan your treatment at least 2 weeks before any major social events.'
            ];
            $after_items = [
                'Apply cold packs gently to the treated areas for 15-20 minutes at a time to reduce swelling.',
                'Avoid touching, rubbing, or massaging the injection sites (except Sculptra 5-5-5 rule).',
                'Avoid sleeping face-down; sleep on your back with head elevated on pillows for 2-3 nights.',
                'Avoid strenuous exercise, saunas, and hot tubs for 24-48 hours.'
            ];
        } else {
            if (!empty($after_list)) {
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $after_list, $matches);
                $after_items = !empty($matches[1]) ? $matches[1] : [];
            }
            if (empty($after_items)) {
                $after_items = [
                    'Follow all specific post-treatment instructions provided by your practitioner.',
                    'Keep the treated area clean and hydrated with recommended skincare products.',
                    'Apply broad-spectrum sunscreen daily and avoid direct sun exposure.'
                ];
            }
            $prep_items = [
                'Avoid facial treatments, chemical peels, or laser procedures for 2 weeks prior.',
                'Arrive with clean skin, free of heavy makeup, lotions, or perfumes.',
                'Stay well-hydrated and follow any specific pre-treatment advice.'
            ];
        }
        
        return [
            'prep' => $prep_items,
            'after' => $after_items
        ];
    }
}
?>

<main class="site-main" id="main-content">

<?php if ($is_enriched): ?>
    
    <!-- ═══════════════════════════════════════════════════════
         BREADCRUMBS & TOP BAR
         ═══════════════════════════════════════════════════════ -->
    <nav class="breadcrumbs breadcrumbs--services reveal animate-fade" aria-label="Breadcrumb"
         itemscope itemtype="https://schema.org/BreadcrumbList">
        <div class="section__inner">
            <ol class="breadcrumbs__list">
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                    <meta itemprop="position" content="2">
                </li>
                <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                    <span itemprop="name"><?php the_title(); ?></span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </nav>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 1: AREAS TREATED (Text left, Image right)
         ═══════════════════════════════════════════════════════ -->
    <?php if ($treat_sec): 
        $desc = strip_list_from_html($treat_sec['content']);
        $list = get_list_from_html($treat_sec['content']);
    ?>
    <section class="service-section" aria-label="Areas Treated">
        <div class="service-section__inner">
            <div class="service-section__content reveal animate-slide-left">
                <span class="service-section__label uppercase-brand">AREAS TREATED WITH <?php the_title(); ?></span>
                <h1 class="service-section__title serif-title"><?php the_title(); ?></h1>
                
                <div class="service-section__desc">
                    <?php echo $desc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>

                <?php if (!empty($list)): ?>
                <ul class="service-checklist" role="list">
                    <?php 
                        preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $list, $matches);
                        foreach ($matches[1] as $item):
                    ?>
                    <li class="service-checklist__item">
                        <span class="service-checklist__check" aria-hidden="true">✓</span>
                        <span><?php echo trim(strip_tags($item)); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            
            <div class="service-section__image reveal animate-slide-right">
                <img src="<?php echo esc_url($service_imgs['areas_treated']); ?>" alt="<?php the_title_attribute(); ?> areas treated">
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 2: HOW IT WORKS (Image left, Text right)
         ═══════════════════════════════════════════════════════ -->
    <?php if ($what_is_sec): ?>
    <section class="service-section service-section--reverse" aria-label="How it works">
        <div class="service-section__inner">
            <div class="service-section__content reveal animate-slide-right">
                <span class="service-section__label uppercase-brand">HOW <?php the_title(); ?> WORKS</span>
                <h2 class="service-section__title serif-title"><?php echo esc_html($what_is_sec['heading']); ?></h2>
                
                <div class="service-section__desc">
                    <?php echo $what_is_sec['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
                
                <div class="service-section__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">Book Treatment</a>
                    <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                </div>
            </div>
            
            <div class="service-section__image reveal animate-slide-left">
                <img src="<?php echo esc_url($service_imgs['how_works']); ?>" alt="<?php the_title_attribute(); ?> mechanism of action">
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 3: WHAT TO EXPECT (Full-width bg image with card overlay)
         ═══════════════════════════════════════════════════════ -->
    <?php if ($expect_sec): ?>
    <section class="service-expect-banner" style="background-image: url('<?php echo esc_url($service_imgs['expect_bg']); ?>');" aria-label="Expectations">
        <div class="service-expect-banner__overlay"></div>
        <div class="service-expect-banner__inner">
            <div class="service-expect-card reveal animate-fade">
                <span class="service-expect-card__label uppercase-brand">Comfortable, In-Office Sessions</span>
                <h2 class="service-expect-card__title serif-title"><?php echo esc_html($expect_sec['heading']); ?></h2>
                <div class="service-expect-card__desc">
                    <?php echo $expect_sec['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 4: PREPARATION & AFTERCARE (Side-by-side Before/After columns)
         ═══════════════════════════════════════════════════════ -->
    <?php 
        $prep_after = livia_get_prep_aftercare($post_slug, $aftercare_sec);
    ?>
    <section class="service-prep-aftercare" aria-label="Preparation and Aftercare">
        <div class="service-prep-aftercare__inner">
            <div class="service-prep-aftercare__header reveal">
                <span class="service-prep-aftercare__label uppercase-brand">SUPPORTING SAFE AND EFFECTIVE TREATMENT</span>
                <h2 class="service-prep-aftercare__title serif-title">Preparation and Aftercare</h2>
            </div>
            
            <div class="service-prep-aftercare__grid reveal">
                <!-- Pre-Treatment (Before) -->
                <div class="service-prep-aftercare__col">
                    <h3 class="service-prep-aftercare__subtitle">Before treatment, patients are typically advised to:</h3>
                    <ul class="service-checklist" role="list">
                        <?php foreach ($prep_after['prep'] as $item): ?>
                        <li class="service-checklist__item">
                            <span class="service-checklist__check" aria-hidden="true">✓</span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Post-Treatment (After) -->
                <div class="service-prep-aftercare__col">
                    <h3 class="service-prep-aftercare__subtitle">After treatment, patients should:</h3>
                    <ul class="service-checklist" role="list">
                        <?php foreach ($prep_after['after'] as $item): ?>
                        <li class="service-checklist__item">
                            <span class="service-checklist__check" aria-hidden="true">✓</span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 5: TREATMENT PLAN & RESULTS (Image left, Text right)
         ═══════════════════════════════════════════════════════ -->
    <?php if ($plan_sec): ?>
    <section class="service-section service-section--reverse" aria-label="Treatment Plan">
        <div class="service-section__inner">
            <div class="service-section__content reveal animate-slide-right">
                <span class="service-section__label uppercase-brand">TREATMENT PLAN AND RESULTS</span>
                <h2 class="service-section__title serif-title"><?php echo esc_html($plan_sec['heading']); ?></h2>
                
                <div class="service-section__desc">
                    <?php echo $plan_sec['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
                
                <div class="service-section__provider-note">
                    <p>Treatments are performed by <strong>Angela Spicola, APRN</strong>; treatments are customized to your skin type, concerns, and goals, ensuring precise, safe, and effective care.</p>
                </div>
            </div>
            
            <div class="service-section__image reveal animate-slide-left">
                <img src="<?php echo esc_url($service_imgs['plan']); ?>" alt="<?php the_title_attribute(); ?> treatment plan results">
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 6: FAQS (Custom Accordion)
         ═══════════════════════════════════════════════════════ -->
    <?php if ($faq_sec): 
        $faq_parts = preg_split('/<h3[^>]*>(.*?)<\/h3>/is', $faq_sec['content'], -1, PREG_SPLIT_DELIM_CAPTURE);
    ?>
    <section class="service-faqs" aria-label="Frequently Asked Questions">
        <div class="service-faqs__inner">
            <div class="service-faqs__header reveal">
                <h2 class="service-faqs__title serif-title"><?php echo esc_html($faq_sec['heading']); ?></h2>
            </div>
            
            <div class="faq-accordion reveal">
                <?php for ($j = 1; $j < count($faq_parts); $j += 2): 
                    $q = trim(strip_tags($faq_parts[$j]));
                    $a = isset($faq_parts[$j+1]) ? trim($faq_parts[$j+1]) : '';
                    if (empty($q)) continue;
                ?>
                <div class="faq-accordion__item">
                    <button class="faq-accordion__header" aria-expanded="false">
                        <span class="faq-accordion__title"><?php echo esc_html($q); ?></span>
                        <span class="faq-accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-accordion__content">
                        <div class="faq-accordion__content-inner">
                            <?php echo $a; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 7: LOCATION MAP BANNER (CTA left, Iframe right)
         ═══════════════════════════════════════════════════════ -->
    <section class="service-map-banner reveal" aria-label="Visit Our Spa">
        <div class="service-map-banner__inner">
            <div class="service-map-banner__content">
                <span class="service-map-banner__label uppercase-brand">LOCATED IN TAMPA</span>
                <h2 class="service-map-banner__title serif-title">Visit Livia Med Spa<br>in Tampa, FL</h2>
                <div class="service-map-banner__info">
                    <div class="service-map-banner__info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>10043 N Dale Mabry Hwy, Tampa, FL 33618</span>
                    </div>
                    <div class="service-map-banner__info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:8132302219">(813) 230-2219</a>
                    </div>
                    <div class="service-map-banner__info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Mon–Wed: 9am–7pm &nbsp;|&nbsp; Thu–Sat: 9am–4pm</span>
                    </div>
                </div>
                <div class="service-map-banner__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">Book Consultation</a>
                </div>
            </div>
            
            <div class="service-map-banner__map">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3520.1062927231405!2d-82.5042456!3d28.0441617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2c159265ea5e9%3A0xeab50c5d5e2fe10c!2sLivia%20Med%20Spa!5e0!3m2!1sen!2sus!4v1714490000000!5m2!1sen!2sus" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Related Treatments section below alternating sections -->
    <?php
    $related_args = [
        'post_type'      => 'service',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id],
        'orderby'        => 'rand',
        'no_found_rows'  => true,
    ];
    if ($categories && !is_wp_error($categories)) {
        $related_args['tax_query'] = [[
            'taxonomy' => 'service_category',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck($categories, 'term_id'),
        ]];
    }
    $related = new WP_Query($related_args);

    if ($related->post_count < 3 && $related->post_count > 0) {
        $found_ids   = wp_list_pluck($related->posts, 'ID');
        $exclude_ids = array_merge([$post_id], $found_ids);
        $backfill    = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => 3 - $related->post_count,
            'post__not_in'   => $exclude_ids,
            'orderby'        => 'rand',
            'no_found_rows'  => true,
        ]);
        if ($backfill->have_posts()) {
            $related->posts      = array_merge($related->posts, $backfill->posts);
            $related->post_count = count($related->posts);
        }
    }
    if ($related->have_posts()): ?>
    <section class="related-services" aria-label="Related treatments">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Explore More</span>
                <h2 class="section__title">Related Treatments</h2>
            </div>
            <div class="related-services__grid reveal">
                <?php while ($related->have_posts()): $related->the_post();
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                ?>
                <a href="<?php the_permalink(); ?>" class="service-card">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="service-card__thumb">
                        <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                    </div>
                    <?php else: ?>
                    <div class="service-card__icon" aria-hidden="true"><?php echo esc_html($r_icon); ?></div>
                    <?php endif; ?>
                    <h3 class="service-card__title"><?php the_title(); ?></h3>
                    <p class="service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ Accordion Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const headers = document.querySelectorAll('.faq-accordion__header');
        headers.forEach(button => {
            button.addEventListener('click', () => {
                const expanded = button.getAttribute('aria-expanded') === 'true';
                
                // Toggle current item
                button.setAttribute('aria-expanded', !expanded);
                const item = button.closest('.faq-accordion__item');
                const icon = button.querySelector('.faq-accordion__icon');
                const content = button.nextElementSibling;
                
                if (!expanded) {
                    item.classList.add('is-active');
                    icon.textContent = '−';
                    content.style.maxHeight = content.scrollHeight + 'px';
                } else {
                    item.classList.remove('is-active');
                    icon.textContent = '+';
                    content.style.maxHeight = '0px';
                }
            });
        });
    });
    </script>

<?php else: ?>

    <!-- ═══════════════════════════════════════════════════════
         FALLBACK CLASSIC LAYOUT (For non-enriched services)
         ═══════════════════════════════════════════════════════ -->
    <section class="service-hero<?php echo !$has_image ? ' service-hero--no-image' : ''; ?>"
             aria-label="Service details"
             itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <span class="service-hero__glow" aria-hidden="true"></span>

        <div class="service-hero__inner">
            <div class="service-hero__content reveal">
                <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb"
                     itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="breadcrumbs__list">
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                            <span itemprop="name"><?php the_title(); ?></span>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </nav>

                <span class="section__label service-hero__cat">
                    <span aria-hidden="true"><?php echo esc_html($icon); ?></span>
                    <?php echo esc_html($category_name); ?>
                </span>

                <h1 class="service-hero__title">
                    <?php the_title(); ?><br>
                    <em class="service-hero__location">in Tampa, FL</em>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="service-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <?php if ($price || $duration): ?>
                <div class="service-hero__meta">
                    <?php if ($price): ?>
                    <div class="service-hero__meta-item" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="USD">
                        <span class="service-hero__meta-label">Starting at</span>
                        <span class="service-hero__meta-value" itemprop="price"><?php echo esc_html($price); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($duration): ?>
                    <div class="service-hero__meta-item">
                        <span class="service-hero__meta-label">Duration</span>
                        <span class="service-hero__meta-value"><?php echo esc_html($duration); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="service-hero__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">Book This Treatment</a>
                    <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                </div>
            </div>

            <?php if ($has_image): ?>
            <div class="service-hero__image reveal" aria-hidden="true">
                <?php the_post_thumbnail('large', [
                    'loading'       => 'eager',
                    'decoding'      => 'async',
                    'fetchpriority' => 'high',
                    'itemprop'      => 'image',
                    'class'         => 'service-hero__img',
                ]); ?>
                <span class="service-hero__img-glow"></span>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="service-body" aria-label="Treatment information">
        <div class="section__inner">
            <div class="service-body__layout">
                <div class="service-body__main service-content__body reveal" itemprop="description">
                    <?php the_content(); ?>
                </div>

                <aside class="service-body__sidebar reveal" aria-label="Quick booking">
                    <div class="service-sidebar">
                        <div class="service-sidebar__icon" aria-hidden="true"><?php echo esc_html($icon); ?></div>
                        <h2 class="service-sidebar__title"><?php the_title(); ?></h2>

                        <?php if ($price): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Starting At</span>
                            <span class="service-sidebar__value"><?php echo esc_html($price); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Duration</span>
                            <span class="service-sidebar__value"><?php echo esc_html($duration); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Category</span>
                            <span class="service-sidebar__value"><?php echo esc_html($category_name); ?></span>
                        </div>

                        <div class="service-sidebar__divider"></div>

                        <a href="#book-now" class="btn btn--primary service-sidebar__book">Book Now</a>
                        <a href="tel:8132302219" class="service-sidebar__call">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            (813) 230-2219
                        </a>
                        <p class="service-sidebar__fine">Free consultation · No commitment required</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <?php if (!empty($benefits)): ?>
    <section class="service-benefits" aria-label="Treatment benefits">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">What You'll Gain</span>
                <h2 class="section__title">Key Benefits of <?php the_title(); ?></h2>
            </div>
            <ul class="service-benefits__grid reveal" role="list">
                <?php foreach ($benefits as $benefit): ?>
                <li class="service-benefits__item">
                    <span class="service-benefits__check" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <?php echo esc_html($benefit); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($video_embed): ?>
    <section class="service-video" aria-label="Treatment video">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">See It In Action</span>
                <h2 class="section__title"><?php the_title(); ?> at LIVIA Med Spa</h2>
            </div>
            <div class="service-video__wrap reveal">
                <iframe
                    src="<?php echo esc_url($video_embed); ?>"
                    title="<?php the_title_attribute(); ?> treatment video at LIVIA Med Spa Tampa"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="service-why-us" aria-label="Why choose LIVIA Med Spa">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why LIVIA</span>
                <h2 class="section__title">Why People Choose LIVIA</h2>
            </div>
            <div class="service-why-us__grid reveal">
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <h3 class="service-why-us__card-title">Advanced, High-Quality Treatments</h3>
                    <p class="service-why-us__card-text">LIVIA Med Spa specializes in modern, results-driven treatments designed to enhance natural beauty while maintaining a refreshed, natural look.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-why-us__card-title">Safety &amp; Professional Care</h3>
                    <p class="service-why-us__card-text">Our services are performed with a focus on safety, precision, and professionalism, using trusted products and techniques to deliver reliable results.</p>
                </div>
                <div class="service-why-us__card">
                    <div class="service-why-us__icon" aria-hidden="true">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
                    </div>
                    <h3 class="service-why-us__card-title">Personalized Experience</h3>
                    <p class="service-why-us__card-text">Every client is unique. At LIVIA Med Spa, we tailor treatments to your individual goals so you receive care that fits your needs and helps you feel your absolute best.</p>
                </div>
            </div>
        </div>
    </section>

    <?php if ($related->have_posts()): ?>
    <section class="related-services" aria-label="Related treatments">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Explore More</span>
                <h2 class="section__title">Related Treatments</h2>
            </div>
            <div class="related-services__grid reveal">
                <?php while ($related->have_posts()): $related->the_post();
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '✨';
                ?>
                <a href="<?php the_permalink(); ?>" class="service-card">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="service-card__thumb">
                        <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                    </div>
                    <?php else: ?>
                    <div class="service-card__icon" aria-hidden="true"><?php echo esc_html($r_icon); ?></div>
                    <?php endif; ?>
                    <h3 class="service-card__title"><?php the_title(); ?></h3>
                    <p class="service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book<br>Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline btn--lg">← All Services</a>
            </div>
        </div>
    </section>

<?php endif; ?>

<!-- Standalone Bottom Lightbox (Retained for post media bottom photos) -->
<?php
$bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
if (!empty($bottom_photo_id) && !$is_enriched):
    $bottom_photo_html = wp_get_attachment_image($bottom_photo_id, 'full', false, [
        'alt'      => get_the_title() . ' bottom photo',
        'loading'  => 'lazy',
        'decoding' => 'async'
    ]);
    if (!empty($bottom_photo_html)):
    ?>
    <section class="service-bottom-photo" aria-label="Additional service image">
        <div class="service-bottom-photo__inner">
            <div class="service-bottom-photo__wrap reveal">
                <a href="<?php echo esc_url(wp_get_attachment_url($bottom_photo_id)); ?>" class="service-bottom-photo__lightbox-trigger" aria-label="Zoom bottom photo">
                    <?php echo $bottom_photo_html; ?>
                </a>
            </div>
        </div>
    </section>
    <?php 
    endif;
endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.querySelector('.service-bottom-photo__lightbox-trigger');
    if (!trigger) return;

    const overlay = document.createElement('div');
    overlay.className = 'livia-lightbox-overlay';
    overlay.innerHTML = `
        <button class="livia-lightbox-close" aria-label="Close Image">&times;</button>
        <img class="livia-lightbox-image" src="" alt="Zoomed Service Image">
    `;
    document.body.appendChild(overlay);

    const lightboxImg = overlay.querySelector('.livia-lightbox-image');
    const closeBtn = overlay.querySelector('.livia-lightbox-close');

    trigger.addEventListener('click', function(e) {
        e.preventDefault();
        const imgUrl = this.getAttribute('href');
        lightboxImg.src = imgUrl;
        overlay.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    });

    function closeLightbox() {
        overlay.classList.remove('is-active');
        document.body.style.overflow = '';
        setTimeout(() => { lightboxImg.src = ''; }, 400);
    }

    closeBtn.addEventListener('click', closeLightbox);
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeLightbox();
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-active')) {
            closeLightbox();
        }
    });
});
</script>

</main>

<?php get_footer(); ?>
