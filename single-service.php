<?php
/**
 * LIVIA Med Spa — Single Service Template
 * Premium Redesign: Supports Section-Enriched Layout & Classic Sidebar Layout.
 * Features inlined compiled layout styling for performance.
 */

// Global Helper Functions
if (!function_exists('livia_get_service_image_url')) {
    /**
     * Resolves service image attachment URL or returns slug-based stock fallback.
     */
    function livia_get_service_image_url($image_id, $section, $post_slug = '') {
        if (!empty($image_id) && is_numeric($image_id) && intval($image_id) > 0) {
            $url = wp_get_attachment_url(intval($image_id));
            if ($url) {
                return $url;
            }
        }
        
        $slug = strtolower($post_slug);
        
        // Match keywords in post slug for specific treatments
        $is_botox = (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'dysport') !== false || strpos($slug, 'jeuveau') !== false);
        $is_filler = (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false);
        
        if ($is_botox) {
            switch ($section) {
                case 'sec_a': // Areas Treated / Hero
                    return 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_538904225-scaled.jpeg';
                case 'sec_b': // How Works
                    return 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_446213685-scaled.jpeg';
                case 'sec_c': // Expect BG
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg';
                case 'sec_e': // Plan
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_374628525-scaled.jpeg';
            }
        } elseif ($is_filler) {
            switch ($section) {
                case 'sec_a':
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_260345614-1-scaled.jpeg';
                case 'sec_b':
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_474297401-1-scaled.jpeg';
                case 'sec_c':
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg';
                case 'sec_e':
                    return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg';
            }
        }
        
        // Laser / LHR & Generic Default
        switch ($section) {
            case 'sec_a':
                return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg';
            case 'sec_b':
                return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg';
            case 'sec_c':
                return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg';
            case 'sec_e':
                return 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg';
        }
        
        return '';
    }
}

if (!function_exists('livia_get_default_prep_aftercare')) {
    /**
     * Resolves default pre-care & post-care instructions if field inputs are blank.
     */
    function livia_get_default_prep_aftercare($post_slug) {
        $slug = strtolower($post_slug);
        
        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false || strpos($slug, 'lhr') !== false) {
            return [
                'prep' => [
                    'Shave the treatment area completely 24 hours prior to your session.',
                    'Avoid waxing, plucking, threading, or electrolysis for at least 4 weeks prior to treatment.',
                    'Avoid active tanning, sunbeds, and self-tanning creams for at least 2 weeks before your appointment.',
                    'Ensure the treatment area is clean and free of lotions, deodorants, or makeup.'
                ],
                'after' => [
                    'Avoid direct sun exposure and apply a broad-spectrum SPF 30+ sunscreen daily.',
                    'Do not wax, pluck, or thread the treated area between sessions (shaving is allowed).',
                    'Avoid hot baths, saunas, steam rooms, and intense exercise for 24 to 48 hours.',
                    'Gently apply aloe vera to soothe any temporary redness or mild swelling.'
                ]
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'dysport') !== false || strpos($slug, 'jeuveau') !== false) {
            return [
                'prep' => [
                    'Avoid alcohol, red wine, and caffeine for 24 hours before your procedure.',
                    'Avoid blood thinners, aspirin, and anti-inflammatory medications like ibuprofen for 3 to 5 days prior to treatment.',
                    'Arrive with a clean, makeup-free face.',
                    'Inform your practitioner of any active cold sores or skin infections in the treatment area.'
                ],
                'after' => [
                    'Keep upright for at least 4 hours after injection; do not lie down or bend forward.',
                    'Skip active face rubbing, massaging, or applying heavy pressure to the treatment areas.',
                    'Avoid strenuous exercise, hot tubs, and saunas for 24 hours.',
                    'Do not consume alcohol or take blood thinners for 24 hours post-treatment.'
                ]
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            return [
                'prep' => [
                    'Avoid blood-thinning medications, aspirin, ibuprofen, and herbal supplements for 3 to 5 days prior.',
                    'Avoid alcohol and red wine for 24 hours before your appointment.',
                    'Arrive with a clean, makeup-free face.',
                    'Ensure no dental procedures are scheduled within 2 weeks before or after your treatment.'
                ],
                'after' => [
                    'Apply a cold compress gently to the treatment area to reduce swelling and bruising.',
                    'Sleep elevated on your back for the first 1-2 nights; avoid sleeping directly on your face.',
                    'Avoid strenuous exercise and intense physical activity for 24 to 48 hours.',
                    'Avoid touching, rubbing, or manipulating the filler unless instructed by your injector.'
                ]
            ];
        }
        
        // Generic MedSpa defaults
        return [
            'prep' => [
                'Avoid blood-thinning medications, aspirin, or ibuprofen for 3 days prior to your visit.',
                'Avoid alcohol and strenuous workouts for 24 hours before your treatment.',
                'Arrive with clean skin, free of heavy creams, makeup, or oils.',
                'Stay hydrated and drink plenty of water leading up to your appointment.'
            ],
            'after' => [
                'Apply SPF 30+ daily and avoid direct sun exposure on the treated area.',
                'Avoid touching, scratching, or rubbing the treated area to prevent infection.',
                'Avoid hot showers, steam rooms, saunas, and heavy exercise for 24 hours.',
                'Follow any specific recovery or product application instructions provided by your practitioner.'
            ]
        ];
    }
}

get_header();

// Fetch post identifiers & field inputs
$post_id          = get_the_ID();
$post_slug        = get_post($post_id)->post_name;

// Core Meta Schema
$icon             = get_post_meta($post_id, '_service_icon', true) ?: '✨';
$price            = get_post_meta($post_id, '_service_price', true);
$duration         = get_post_meta($post_id, '_service_duration', true);
$video            = get_post_meta($post_id, '_service_video', true);
$benefits_raw     = get_post_meta($post_id, '_service_benefits', true);
$benefits         = $benefits_raw ? array_filter(array_map('trim', explode("\n", $benefits_raw))) : [];

// Enriched Section Meta Schema
$sec_a_title      = get_post_meta($post_id, '_service_sec_a_title', true);
$sec_a_desc       = get_post_meta($post_id, '_service_sec_a_desc', true);
$sec_a_checklist_raw = get_post_meta($post_id, '_service_sec_a_checklist', true);
$sec_a_checklist  = $sec_a_checklist_raw ? array_filter(array_map('trim', explode("\n", $sec_a_checklist_raw))) : [];
$sec_a_image_id   = get_post_meta($post_id, '_service_sec_a_image_id', true);

$sec_b_title      = get_post_meta($post_id, '_service_sec_b_title', true);
$sec_b_desc       = get_post_meta($post_id, '_service_sec_b_desc', true);
$sec_b_image_id   = get_post_meta($post_id, '_service_sec_b_image_id', true);

$sec_c_title      = get_post_meta($post_id, '_service_sec_c_title', true);
$sec_c_desc       = get_post_meta($post_id, '_service_sec_c_desc', true);
$sec_c_bg_image_id = get_post_meta($post_id, '_service_sec_c_bg_image_id', true);

$sec_d_prep_raw   = get_post_meta($post_id, '_service_sec_d_prep', true);
$sec_d_after_raw  = get_post_meta($post_id, '_service_sec_d_after', true);

$sec_e_title      = get_post_meta($post_id, '_service_sec_e_title', true);
$sec_e_desc       = get_post_meta($post_id, '_service_sec_e_desc', true);
$sec_e_image_id   = get_post_meta($post_id, '_service_sec_e_image_id', true);

// FAQs Meta Schema
$faqs = [];
for ($i = 1; $i <= 6; $i++) {
    $q = get_post_meta($post_id, '_service_faq_q' . $i, true);
    $a = get_post_meta($post_id, '_service_faq_a' . $i, true);
    if (!empty($q) && !empty($a)) {
        $faqs[] = ['q' => $q, 'a' => $a];
    }
}

// Convert video URL to embed format
$video_embed = '';
if ($video) {
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video, $m)) {
        $video_embed = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1&iv_load_policy=3&color=white&playsinline=1';
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video, $m)) {
        $video_embed = 'https://player.vimeo.com/video/' . $m[1] . '?title=0&byline=0&portrait=0&color=AC13F9';
    }
}

// Category details
$categories    = get_the_terms($post_id, 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
$has_image     = has_post_thumbnail();

// Enrichment State Detection
$is_enriched = (!empty($sec_a_desc) || !empty($sec_b_desc) || !empty($sec_c_desc) || !empty($sec_e_desc));

// Image Resolutions
$sec_a_img_url = '';
if ($has_image) {
    $sec_a_img_url = get_the_post_thumbnail_url($post_id, 'large');
}
if (!$sec_a_img_url && !empty($sec_a_image_id) && is_numeric($sec_a_image_id) && intval($sec_a_image_id) > 0) {
    $sec_a_img_url = wp_get_attachment_url(intval($sec_a_image_id));
}
if (!$sec_a_img_url) {
    $sec_a_img_url = livia_get_service_image_url($sec_a_image_id, 'sec_a', $post_slug);
}

$sec_b_img_url = livia_get_service_image_url($sec_b_image_id, 'sec_b', $post_slug);
$sec_c_img_url = livia_get_service_image_url($sec_c_bg_image_id, 'sec_c', $post_slug);
$sec_e_img_url = livia_get_service_image_url($sec_e_image_id, 'sec_e', $post_slug);

// Resolve Prep & Aftercare
$prep_guidelines = [];
$after_guidelines = [];
if (!empty($sec_d_prep_raw)) {
    $prep_guidelines = array_filter(array_map('trim', explode("\n", $sec_d_prep_raw)));
}
if (!empty($sec_d_after_raw)) {
    $after_guidelines = array_filter(array_map('trim', explode("\n", $sec_d_after_raw)));
}
if (empty($prep_guidelines) && empty($after_guidelines)) {
    $defaults = livia_get_default_prep_aftercare($post_slug);
    $prep_guidelines = $defaults['prep'];
    $after_guidelines = $defaults['after'];
} else {
    $defaults = null;
    if (empty($prep_guidelines)) {
        $defaults = livia_get_default_prep_aftercare($post_slug);
        $prep_guidelines = $defaults['prep'];
    }
    if (empty($after_guidelines)) {
        if (!$defaults) { $defaults = livia_get_default_prep_aftercare($post_slug); }
        $after_guidelines = $defaults['after'];
    }
}
?>

<style id="livia-single-service-inlined-css">
/* --- Livia Med Spa Single Service Layout Inline CSS --- */
:root {
  --brand: #AC13F9;
  --brand-rgb: 172, 19, 249;
  --brand-dark: #7A0BB8;
  --brand-mid: #9B2FD0;
  --brand-bright: #D06AF5;
  --brand-pink: #F471D1;
  --brand-pink-mid: #C955F0;
  --bg-cream: #FDFBF7;
  --bg-lavender: #FAF6FF;
  --bg-lavender-deep: #F3E8FF;
  --text-dark: #1F112E;
  --text-muted: #574B64;
  --text-subtle: #80738C;
  --text-mid: #3D2E4D;
  --text-pale: #B2A6BF;
  --border-soft: #F0E6FC;
}

/* ==========================================================================
   GLOBAL COMPONENT STYLES
   ========================================================================== */
.breadcrumbs-bar {
  background: #ffffff;
  padding: 1.25rem 0;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.breadcrumbs__list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.8rem;
  font-weight: 500;
}

.breadcrumbs__link {
  color: var(--text-subtle);
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcrumbs__link:hover {
  color: var(--brand);
}

.breadcrumbs__sep {
  color: var(--text-pale);
  font-size: 0.85rem;
}

.breadcrumbs__current {
  color: var(--brand);
  font-weight: 600;
}

/* ==========================================================================
   PREMIUM ENRICHED LAYOUT
   ========================================================================== */

/* Section A: Areas Treated / Hero */
.service-hero-enriched {
  background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-lavender) 60%, var(--bg-lavender-deep) 100%);
  padding: clamp(4rem, 3rem + 5vw, 7rem) 0;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.06);
}

.service-hero-enriched::before {
  content: '';
  position: absolute;
  top: -20%;
  right: -10%;
  width: 500px;
  height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(var(--brand-rgb), 0.06) 0%, transparent 70%);
  pointer-events: none;
}

.service-hero-enriched__inner {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  align-items: stretch;
  gap: clamp(3rem, 2rem + 4vw, 6rem);
}

.service-hero-enriched__content {
  position: relative;
  z-index: 2;
}

.service-hero-enriched__cat {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--brand);
  background: rgba(var(--brand-rgb), 0.08);
  border: 1px solid rgba(var(--brand-rgb), 0.12);
  padding: 0.4rem 1.25rem;
  border-radius: 99px;
  margin-bottom: 1.5rem;
}

.service-hero-enriched__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2.4rem, 1.8rem + 3vw, 4rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.15;
  margin-bottom: 1.5rem;
}

.service-hero-enriched__desc {
  font-size: clamp(0.95rem, 0.88rem + 0.25vw, 1.1rem);
  color: var(--text-muted);
  line-height: 1.75;
  margin-bottom: 1.75rem;
}

.service-hero-enriched__desc p {
  margin-bottom: 1rem;
}

.service-hero-enriched__desc p:last-child {
  margin-bottom: 0;
}

.service-hero-enriched__checklist {
  list-style: none;
  padding: 0;
  margin: 0 0 2.25rem 0;
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
}

.service-hero-enriched__checklist li {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  font-size: 0.95rem;
  font-weight: 500;
  color: var(--text-mid);
}

.service-hero-enriched__check {
  color: var(--brand);
  flex-shrink: 0;
  margin-top: 0.25rem;
}

.service-hero-enriched__meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1.25rem;
  margin-bottom: 2.25rem;
}

.service-hero-enriched__meta-item {
  background: #ffffff;
  border: 1px solid rgba(var(--brand-rgb), 0.12);
  border-radius: 16px;
  padding: 0.85rem 1.75rem;
  min-width: 140px;
  box-shadow: 0 8px 20px rgba(var(--brand-rgb), 0.02);
}

.service-hero-enriched__meta-label {
  display: block;
  font-size: 0.65rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--text-subtle);
  margin-bottom: 0.25rem;
}

.service-hero-enriched__meta-value {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.45rem;
  font-weight: 500;
  color: var(--brand);
}

.service-hero-enriched__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.service-hero-enriched__actions .btn {
  padding: 0.9rem 2rem;
  font-size: 0.92rem;
  font-weight: 600;
  border-radius: 99px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.service-hero-enriched__image-wrap {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
}

.service-hero-enriched__image {
  position: relative;
  border-radius: 32px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(var(--brand-rgb), 0.06);
  flex-grow: 1;
  height: 100%;
  min-height: 350px;
}

.service-hero-enriched__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

@media (max-width: 900px) {
  .service-hero-enriched__inner {
    grid-template-columns: 1fr;
    text-align: center;
    align-items: center;
  }
  .service-hero-enriched__cat, .service-hero-enriched__checklist li, .service-hero-enriched__meta {
    justify-content: center;
  }
  .service-hero-enriched__actions {
    justify-content: center;
  }
  .service-hero-enriched__image-wrap {
    order: -1;
    max-width: 550px;
    margin: 0 auto;
    width: 100%;
  }
  .service-hero-enriched__image {
    aspect-ratio: 16 / 10;
    height: auto;
    min-height: auto;
  }
}

/* Section B: How it Works */
.service-how-works {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #ffffff;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-how-works__grid {
  display: grid;
  grid-template-columns: 0.9fr 1.15fr;
  align-items: stretch;
  gap: clamp(3rem, 2rem + 4vw, 6rem);
}

.service-how-works__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2rem, 1.5rem + 2vw, 3.2rem);
  font-weight: 300;
  color: var(--text-dark);
  margin: 1rem 0 1.5rem;
  line-height: 1.25;
}

.service-how-works__desc {
  font-size: 0.95rem;
  line-height: 1.8;
  color: var(--text-muted);
  margin-bottom: 2.25rem;
}

.service-how-works__desc p {
  margin-bottom: 1rem;
}

.service-how-works__desc p:last-child {
  margin-bottom: 0;
}

.service-how-works__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.service-how-works__image-wrap {
  position: relative;
  display: flex;
  flex-direction: column;
}

.service-how-works__image {
  position: relative;
  border-radius: 32px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(var(--brand-rgb), 0.05);
  flex-grow: 1;
  height: 100%;
  min-height: 350px;
}

.service-how-works__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

@media (max-width: 900px) {
  .service-how-works__grid {
    grid-template-columns: 1fr;
    text-align: center;
    align-items: center;
  }
  .service-how-works__image-wrap {
    max-width: 480px;
    margin: 0 auto;
    width: 100%;
  }
  .service-how-works__image {
    aspect-ratio: 4 / 5;
    height: auto;
    min-height: auto;
  }
  .service-how-works__actions {
    justify-content: center;
  }
}

/* Section C: What to Expect Banner */
.service-expect-banner {
  position: relative;
  background-size: cover;
  background-position: center;
  padding: clamp(5rem, 4rem + 6vw, 10rem) 0;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.service-expect-banner__overlay {
  position: absolute;
  inset: 0;
  background: rgba(18, 12, 24, 0.7);
  z-index: 1;
}

.service-expect-banner__inner {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1200px;
  padding: 0 1.5rem;
  display: flex;
  justify-content: center;
}

.service-expect-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
  border-radius: 24px;
  padding: clamp(2rem, 1.5rem + 3vw, 4rem);
  max-width: 780px;
  width: 100%;
  text-align: center;
  color: #ffffff;
}

.service-expect-card__subtitle {
  display: inline-block;
  color: var(--brand-bright);
  font-size: 0.72rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  margin-bottom: 1rem;
}

.service-expect-card__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2rem, 1.6rem + 2vw, 3.2rem);
  font-weight: 300;
  color: #ffffff;
  margin-bottom: 1.5rem;
  line-height: 1.2;
}

.service-expect-card__desc {
  font-size: clamp(0.95rem, 0.88rem + 0.2vw, 1.05rem);
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.85);
}

.service-expect-card__desc p {
  margin-bottom: 1rem;
}

.service-expect-card__desc p:last-child {
  margin-bottom: 0;
}

/* Section D: Prep & Aftercare columns */
.service-prep-aftercare {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #ffffff;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-prep-aftercare__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(2rem, 1.5rem + 3vw, 4rem);
  margin-top: 3rem;
}

.service-prep-aftercare__card {
  background: var(--bg-cream);
  border: 1px solid rgba(var(--brand-rgb), 0.08);
  border-radius: 24px;
  padding: clamp(2rem, 1.5rem + 2vw, 3rem);
  height: 100%;
  transition: all 0.4s ease;
}

.service-prep-aftercare__card--prep {
  border-top: 4px solid var(--brand);
}

.service-prep-aftercare__card--after {
  border-top: 4px solid var(--brand-pink);
}

.service-prep-aftercare__card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(var(--brand-rgb), 0.04);
  border-color: rgba(var(--brand-rgb), 0.15);
}

.service-prep-aftercare__icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  background: rgba(var(--brand-rgb), 0.06);
  color: var(--brand);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
}

.service-prep-aftercare__card--after .service-prep-aftercare__icon {
  background: rgba(244, 113, 209, 0.08);
  color: var(--brand-pink);
}

.service-prep-aftercare__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.6rem;
  font-weight: 500;
  color: var(--text-dark);
  margin-bottom: 0.5rem;
}

.service-prep-aftercare__subtitle {
  font-size: 0.88rem;
  color: var(--text-muted);
  margin-bottom: 1.75rem;
}

.service-prep-aftercare__list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.service-prep-aftercare__list li {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  font-size: 0.92rem;
  line-height: 1.6;
  color: var(--text-mid);
}

.service-prep-aftercare__check {
  flex-shrink: 0;
  color: var(--brand);
  margin-top: 0.2rem;
}

.service-prep-aftercare__card--after .service-prep-aftercare__check {
  color: var(--brand-pink);
}

@media (max-width: 768px) {
  .service-prep-aftercare__grid {
    grid-template-columns: 1fr;
  }
}

/* Section E: Treatment Plan */
.service-plan {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: var(--bg-lavender);
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-plan__grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: clamp(3rem, 2rem + 4vw, 6rem);
  align-items: stretch;
}

.service-plan__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2rem, 1.5rem + 2vw, 3.2rem);
  font-weight: 300;
  color: var(--text-dark);
  margin: 1rem 0 1.5rem;
  line-height: 1.2;
}

.service-plan__desc {
  font-size: 0.95rem;
  line-height: 1.8;
  color: var(--text-muted);
  margin-bottom: 2rem;
}

.service-plan__desc p {
  margin-bottom: 1rem;
}

.service-plan__desc p:last-child {
  margin-bottom: 0;
}

.service-credentials-card {
  background: #ffffff;
  border-left: 4px solid var(--brand);
  border-radius: 16px;
  padding: 1.5rem 1.75rem;
  box-shadow: 0 15px 35px rgba(var(--brand-rgb), 0.04), 0 1px 3px rgba(var(--brand-rgb), 0.01);
  margin-top: 2.25rem;
}

.service-credentials-card__header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.service-credentials-card__avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--brand), var(--brand-bright));
  color: #ffffff;
  font-weight: 600;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  justify-content: center;
  letter-spacing: 0.05em;
}

.service-credentials-card__name {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--text-dark);
  margin: 0;
}

.service-credentials-card__title {
  font-size: 0.72rem;
  color: var(--brand);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

.service-credentials-card__text {
  font-size: 0.88rem;
  line-height: 1.6;
  color: var(--text-muted);
  margin: 0;
}

.service-plan__image-wrap {
  position: relative;
  display: flex;
  flex-direction: column;
}

.service-plan__image {
  position: relative;
  border-radius: 32px;
  overflow: hidden;
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(var(--brand-rgb), 0.05);
  flex-grow: 1;
  height: 100%;
  min-height: 350px;
}

.service-plan__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

@media (max-width: 900px) {
  .service-plan__grid {
    grid-template-columns: 1fr;
    text-align: center;
    align-items: center;
  }
  .service-plan__image-wrap {
    order: -1;
    max-width: 480px;
    margin: 0 auto;
    width: 100%;
  }
  .service-plan__image {
    aspect-ratio: 4 / 5;
    height: auto;
    min-height: auto;
  }
  .service-credentials-card {
    text-align: left;
  }
}

/* Section F: FAQs Accordion */
.service-faqs {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #ffffff;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.faq-accordion {
  max-width: 800px;
  margin: 3rem auto 0;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.faq-accordion__item {
  background: var(--bg-cream);
  border: 1px solid rgba(var(--brand-rgb), 0.08);
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.faq-accordion__item.is-active {
  border-color: rgba(var(--brand-rgb), 0.2);
  box-shadow: 0 10px 25px rgba(var(--brand-rgb), 0.04);
}

.faq-accordion__header {
  width: 100%;
  background: transparent;
  border: none;
  padding: 1.5rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: left;
  cursor: pointer;
  font-weight: 600;
  font-size: 1.05rem;
  color: var(--text-dark);
  gap: 1.5rem;
  transition: color 0.3s ease;
}

.faq-accordion__header:hover {
  color: var(--brand);
}

.faq-accordion__question {
  line-height: 1.4;
}

.faq-accordion__toggle-icon {
  flex-shrink: 0;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: rgba(var(--brand-rgb), 0.05);
  color: var(--brand);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.faq-accordion__header:hover .faq-accordion__toggle-icon {
  background: var(--brand);
  color: #ffffff;
}

.faq-accordion__item.is-active .faq-accordion__toggle-icon {
  transform: rotate(45deg);
  background: var(--brand);
  color: #ffffff;
}

.faq-accordion__content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.faq-accordion__body {
  padding: 0 2rem 1.5rem;
  font-size: 0.92rem;
  line-height: 1.7;
  color: var(--text-muted);
}

.faq-accordion__body p {
  margin-bottom: 0.75rem;
}

.faq-accordion__body p:last-child {
  margin-bottom: 0;
}

/* Section G: Tampa Location Map Banner */
.service-location-banner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  background: var(--bg-cream);
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.06);
  overflow: hidden;
}

.service-location-banner__info {
  padding: clamp(3rem, 2.5rem + 4vw, 6rem) clamp(1.5rem, 1.25rem + 3vw, 4.5rem);
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.service-location-banner__sub {
  color: var(--brand);
  font-size: 0.72rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  margin-bottom: 0.5rem;
}

.service-location-banner__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2rem, 1.5rem + 2vw, 3.2rem);
  font-weight: 300;
  color: var(--text-dark);
  margin-bottom: 2rem;
  line-height: 1.2;
}

.service-location-banner__details {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.service-location-banner__item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
}

.service-location-banner__icon {
  flex-shrink: 0;
  color: var(--brand);
  margin-top: 0.15rem;
}

.service-location-banner__label {
  display: block;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--text-subtle);
  margin-bottom: 0.25rem;
}

.service-location-banner__value {
  font-size: 0.92rem;
  color: var(--text-mid);
  line-height: 1.6;
  margin: 0;
}

.service-location-banner__value a {
  color: var(--text-dark);
  text-decoration: none;
  font-weight: 600;
}

.service-location-banner__value a:hover {
  color: var(--brand);
}

.service-location-banner__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.service-location-banner__actions .btn {
  padding: 0.85rem 1.75rem;
  font-size: 0.88rem;
  font-weight: 600;
  border-radius: 99px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.service-location-banner__map {
  position: relative;
  min-height: 450px;
  width: 100%;
}

.service-location-banner__map iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}

@media (max-width: 900px) {
  .service-location-banner {
    grid-template-columns: 1fr;
  }
  .service-location-banner__map {
    height: 380px;
    min-height: 380px;
  }
}

/* ==========================================================================
   CLASSIC SIDEBAR LAYOUT
   ========================================================================== */

.service-hero {
  background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-lavender) 60%, var(--bg-lavender-deep) 100%);
  padding: clamp(5rem, 4rem + 5vw, 9rem) 0 clamp(3rem, 2.5rem + 3vw, 5rem);
  position: relative;
  overflow: hidden;
}

.service-hero::before {
  content: '';
  position: absolute;
  top: -30%;
  right: -10%;
  width: 600px;
  height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(var(--brand-rgb), 0.08) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}

.service-hero__inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: clamp(3rem, 2rem + 5vw, 7rem);
}

.service-hero--no-image .service-hero__inner {
  max-width: 860px;
  grid-template-columns: 1fr;
  text-align: center;
}

.service-hero__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2.2rem, 1.7rem + 2.5vw, 3.8rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.15;
  margin-bottom: 1.25rem;
}

.service-hero__desc {
  font-size: clamp(0.95rem, 0.88rem + 0.3vw, 1.1rem);
  color: var(--text-muted);
  line-height: 1.7;
  max-width: 520px;
  margin-bottom: 2rem;
}

.service-hero--no-image .service-hero__desc {
  margin-left: auto;
  margin-right: auto;
}

.service-hero .section__label {
  color: var(--brand);
}

.service-hero__meta {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  margin-bottom: 2.5rem;
  flex-wrap: wrap;
}

.service-hero--no-image .service-hero__meta {
  justify-content: center;
}

.service-hero__meta-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
  background: #FFFFFF;
  border: 1px solid rgba(var(--brand-rgb), 0.15);
  border-radius: 12px;
  padding: 1rem 2rem;
  min-width: 140px;
}

.service-hero__meta-label {
  font-size: 0.68rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--text-subtle);
}

.service-hero__meta-value {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.5rem;
  font-weight: 400;
  color: var(--brand);
}

.service-hero__actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.service-hero--no-image .service-hero__actions {
  justify-content: center;
}

.service-hero__image {
  position: relative;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 24px 72px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(var(--brand-rgb), 0.08);
  aspect-ratio: 4 / 3;
  z-index: 1;
}

.service-hero__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.service-hero__location {
  font-style: italic;
  font-weight: 300;
  color: var(--brand);
  background: none;
  font-size: 0.75em;
}

@media (max-width: 900px) {
  .service-hero__inner {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .service-hero__image {
    order: -1;
    aspect-ratio: 16 / 9;
  }
  .service-hero__meta { justify-content: center; }
  .service-hero__actions { justify-content: center; }
  .service-hero__desc { margin-left: auto; margin-right: auto; }
}

.service-body {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: #fff;
}

.service-body__layout {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 3.5rem;
  align-items: start;
}

.service-body__main {
  min-width: 0;
}

.service-body__sidebar {
  position: sticky;
  top: 100px;
}

.service-sidebar {
  background: linear-gradient(180deg, var(--bg-cream) 0%, var(--bg-lavender) 100%);
  border: 1px solid rgba(var(--brand-rgb), 0.1);
  border-radius: 24px;
  padding: 2.25rem 2rem;
  text-align: center;
  box-shadow: 0 20px 40px rgba(var(--dark-rgb), 0.04), 0 1px 3px rgba(var(--brand-rgb), 0.03);
  transition: box-shadow 0.3s ease;
}

.service-sidebar:hover {
  box-shadow: 0 24px 48px rgba(var(--dark-rgb), 0.07), 0 1px 5px rgba(var(--brand-rgb), 0.04);
}

.service-sidebar__icon {
  font-size: 2.2rem;
  width: 68px;
  height: 68px;
  background: #FFFFFF;
  border-radius: 50%;
  margin: 0 auto 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 20px rgba(var(--brand-rgb), 0.12), 0 0 0 1px rgba(var(--brand-rgb), 0.04);
  transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.service-sidebar:hover .service-sidebar__icon {
  transform: scale(1.08) rotate(6deg);
}

.service-sidebar__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.45rem;
  font-weight: 500;
  color: var(--text-dark);
  margin-bottom: 1.5rem;
  line-height: 1.25;
  letter-spacing: -0.01em;
}

.service-sidebar__row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.85rem 0;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.08);
  gap: 0.5rem;
}

.service-sidebar__row:last-of-type {
  border-bottom: none;
}

.service-sidebar__label {
  font-size: 0.72rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-subtle);
}

.service-sidebar__value {
  font-size: 0.92rem;
  font-weight: 600;
  color: var(--text-dark);
  text-align: right;
}

.service-sidebar__divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(var(--brand-rgb), 0.15), transparent);
  margin: 1.5rem 0;
}

.service-sidebar__book {
  width: 100%;
  justify-content: center;
  display: flex;
  padding: 0.9rem 1.5rem;
  font-size: 0.92rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  border-radius: 99px;
  box-shadow: 0 8px 20px rgba(var(--brand-rgb), 0.2);
  transition: all 0.3s ease;
  margin-bottom: 0.75rem;
  text-decoration: none;
}

.service-sidebar__book:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(var(--brand-rgb), 0.3);
}

.service-sidebar__call {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.6rem;
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--brand);
  text-decoration: none;
  padding: 0.75rem;
  border-radius: 99px;
  border: 1px solid rgba(var(--brand-rgb), 0.2);
  background: transparent;
  transition: all 0.3s ease;
  width: 100%;
}

.service-sidebar__call:hover {
  color: #FFFFFF;
  background: var(--brand);
  border-color: var(--brand);
  box-shadow: 0 6px 15px rgba(var(--brand-rgb), 0.18);
}

.service-sidebar__call svg {
  transition: transform 0.3s ease;
}

.service-sidebar__call:hover svg {
  transform: rotate(15deg) scale(1.1);
}

.service-sidebar__fine {
  font-size: 0.68rem;
  color: var(--text-pale);
  margin-top: 1rem;
  line-height: 1.5;
  letter-spacing: 0.02em;
}

@media (max-width: 860px) {
  .service-body__layout {
    grid-template-columns: 1fr;
  }
  .service-body__sidebar { position: static; }
}

.service-content__body {
  min-width: 0;
}

.service-content__body h2 {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(1.6rem, 1.3rem + 1.3vw, 2.2rem);
  font-weight: 400;
  color: var(--text-dark);
  margin: 3rem 0 1.25rem;
  padding-top: 2rem;
  border-top: 1px solid #f0f0f4;
  line-height: 1.25;
}

.service-content__body h2:first-child {
  margin-top: 0;
  padding-top: 0;
  border-top: none;
}

.service-content__body h3 {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(1.2rem, 1.05rem + 0.7vw, 1.5rem);
  font-weight: 400;
  color: var(--text-dark);
  margin: 2rem 0 1rem;
  line-height: 1.3;
}

.service-content__body p {
  font-size: 0.95rem;
  color: var(--text-mid);
  line-height: 1.8;
  margin-bottom: 1.25rem;
}

.service-content__body img {
  border-radius: 16px;
  margin: 2rem 0;
  width: 100%;
  height: auto;
}

.service-content__body ul,
.service-content__body ol {
  margin: 1.25rem 0;
  padding-left: 1.5rem;
}

.service-content__body ul {
  list-style: none;
  padding-left: 0;
}

.service-content__body ul li {
  position: relative;
  padding-left: 1.5rem;
  margin-bottom: 0.75rem;
  font-size: 0.92rem;
  color: var(--text-mid);
  line-height: 1.7;
}

.service-content__body ul li::before {
  content: '✦';
  position: absolute;
  left: 0;
  color: var(--brand);
  font-size: 0.7rem;
  top: 0.15rem;
}

.service-content__body ol li {
  margin-bottom: 0.75rem;
  font-size: 0.92rem;
  color: var(--text-mid);
  line-height: 1.7;
}

.service-content__body blockquote {
  border-left: 3px solid var(--brand);
  padding: 1.25rem 1.5rem;
  margin: 2rem 0;
  background: rgba(var(--brand-rgb), 0.04);
  border-radius: 0 12px 12px 0;
  font-style: italic;
}

.service-content__body blockquote p {
  color: var(--text-dark);
  margin-bottom: 0;
}

/* Benefits Grid */
.service-benefits {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: var(--bg-cream);
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-benefits__grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 1.25rem;
  margin-top: 2.5rem;
  list-style: none;
  padding: 0;
}

.service-benefits__item {
  display: flex;
  align-items: flex-start;
  gap: 0.85rem;
  background: #fff;
  border: 1px solid rgba(var(--brand-rgb), 0.1);
  border-radius: 12px;
  padding: 1.1rem 1.25rem;
  font-size: 0.88rem;
  font-weight: 500;
  color: var(--text-dark);
  line-height: 1.5;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.service-benefits__item:hover {
  border-color: rgba(var(--brand-rgb), 0.3);
  box-shadow: 0 8px 24px rgba(var(--brand-rgb), 0.06);
}

.service-benefits__check {
  flex-shrink: 0;
  width: 26px;
  height: 26px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--brand), var(--brand-bright));
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  margin-top: 1px;
}

/* Video Section */
.service-video {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: #fff;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-video__wrap {
  position: relative;
  width: 100%;
  margin: 2.5rem auto 0;
  aspect-ratio: 16 / 9;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 24px 72px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(var(--brand-rgb), 0.08);
}

.service-video__wrap iframe {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  border: none;
}

/* Why Choose Us static cards */
.service-why-us {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #fff;
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.service-why-us__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  margin-top: 3rem;
}

.service-why-us__card {
  background: #FFFFFF;
  border: 1px solid rgba(0, 0, 0, 0.07);
  border-radius: 20px;
  padding: 2.5rem 2rem;
  text-align: center;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.service-why-us__card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--brand), var(--brand-bright));
  transform: scaleX(0);
  transition: transform 0.4s ease;
  transform-origin: left;
}

.service-why-us__card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.06);
  border-color: rgba(var(--brand-rgb), 0.2);
}

.service-why-us__card:hover::before {
  transform: scaleX(1);
}

.service-why-us__icon {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
  display: block;
}

.service-why-us__card-title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(1.15rem, 1rem + 0.6vw, 1.4rem);
  font-weight: 400;
  color: var(--text-dark);
  margin-bottom: 1rem;
  line-height: 1.3;
}

.service-why-us__card-text {
  font-size: 0.85rem;
  color: var(--text-mid);
  line-height: 1.7;
}

@media (max-width: 768px) {
  .service-why-us__grid {
    grid-template-columns: 1fr;
  }
}

/* ==========================================================================
   COMMON PAGE BOTTOM
   ========================================================================== */

/* Related Treatments */
.related-services {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: var(--bg-cream);
  border-bottom: 1px solid rgba(var(--brand-rgb), 0.05);
}

.related-services__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

@media (max-width: 768px) {
  .related-services__grid {
    grid-template-columns: 1fr;
  }
}

.service-card {
  background: #ffffff;
  border: 1px solid rgba(var(--brand-rgb), 0.08);
  border-radius: 20px;
  padding: 1.75rem;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  height: 100%;
  box-shadow: 0 10px 30px rgba(0,0,0,0.02);
  transition: all 0.3s ease;
}

.service-card:hover {
  transform: translateY(-5px);
  border-color: rgba(var(--brand-rgb), 0.2);
  box-shadow: 0 15px 35px rgba(var(--brand-rgb), 0.06);
}

.service-card__thumb {
  border-radius: 12px;
  overflow: hidden;
  aspect-ratio: 16 / 10;
  margin-bottom: 1.25rem;
}

.service-card__thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.service-card__icon {
  font-size: 2.2rem;
  margin-bottom: 1.25rem;
}

.service-card__title {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.35rem;
  font-weight: 500;
  color: var(--text-dark);
  margin-bottom: 0.75rem;
}

.service-card__text {
  font-size: 0.88rem;
  color: var(--text-muted);
  line-height: 1.6;
  margin-bottom: 1.5rem;
  flex-grow: 1;
}

.service-card__link {
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--brand);
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
}

/* CTA Booking Banner */
.cta-section {
  padding: clamp(4rem, 3rem + 4vw, 6rem) 0;
  background: #ffffff;
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 600px;
  height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(var(--brand-rgb), 0.05) 0%, transparent 70%);
  pointer-events: none;
}

.cta-section__inner {
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
  padding: 0 1.5rem;
  position: relative;
  z-index: 2;
}

.cta-section__label {
  display: inline-flex;
  padding: 0.4rem 1.25rem;
  background: rgba(var(--brand-rgb), 0.08);
  border: 1px solid rgba(var(--brand-rgb), 0.15);
  border-radius: 99px;
  font-size: 0.68rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--brand);
  margin-bottom: 1.5rem;
}

.cta-section__title {
  font-size: clamp(2.2rem, 1.6rem + 3vw, 3.5rem);
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-weight: 300;
  color: var(--text-dark);
  margin-bottom: 1rem;
  line-height: 1.2;
}

.cta-section__text {
  font-size: clamp(0.95rem, 0.88rem + 0.35vw, 1.1rem);
  color: var(--text-muted);
  line-height: 1.7;
  margin-bottom: 2.5rem;
}

.cta-section__actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.cta-section__actions .btn {
  padding: 0.9rem 2rem;
  font-size: 0.92rem;
  font-weight: 600;
  border-radius: 99px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

@media (max-width: 576px) {
  .cta-section__actions .btn {
    width: 100%;
  }
}

/* Lightbox Modal & Zoom Trigger */
.service-bottom-photo {
  background: #ffffff;
  padding: 0 0 clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

.service-bottom-photo__inner {
  max-width: 1200px;
  width: 100%;
  padding: 0 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.service-bottom-photo__wrap {
  text-align: center;
  max-width: 100%;
}

.service-bottom-photo__img {
  display: block;
  margin: 0 auto;
  max-width: 100%;
  height: auto;
  border-radius: 24px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(var(--brand-rgb), 0.08);
}

.service-bottom-photo__lightbox-trigger {
  display: inline-block;
  cursor: zoom-in;
  max-width: 100%;
  transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.service-bottom-photo__lightbox-trigger:hover {
  transform: translateY(-4px) scale(1.01);
}

.service-bottom-photo__lightbox-trigger img {
  transition: box-shadow 0.4s ease, border-color 0.4s ease;
}

.service-bottom-photo__lightbox-trigger:hover img {
  box-shadow: 0 20px 50px rgba(var(--brand-rgb), 0.12);
  border-color: rgba(var(--brand-rgb), 0.15) !important;
}

.livia-lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(18, 12, 24, 0.94);
  z-index: 99999;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
}

.livia-lightbox-overlay.is-active {
  opacity: 1;
  pointer-events: auto;
}

.livia-lightbox-image {
  max-width: 90%;
  max-height: 85%;
  border-radius: 16px;
  box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
  transform: scale(0.92);
  transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  border: 1px solid rgba(255, 255, 255, 0.08);
}

.livia-lightbox-overlay.is-active .livia-lightbox-image {
  transform: scale(1);
}

.livia-lightbox-close {
  position: absolute;
  top: 25px;
  right: 30px;
  background: rgba(255, 255, 255, 0.08);
  border: none;
  color: #FFFFFF;
  font-size: 28px;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  line-height: 1;
  transition: background 0.3s ease, transform 0.3s ease, color 0.3s ease;
  z-index: 100000;
}

.livia-lightbox-close:hover {
  background: #FFFFFF;
  color: #120c18;
  transform: scale(1.08) rotate(90deg);
}
</style>

<main class="site-main" id="main-content">

    <?php if ($is_enriched): ?>
        <!-- ==========================================================================
             ENRICHED LAYOUT (State A)
             ========================================================================== -->



        <!-- 2. Section A (Areas Treated / Hero) -->
        <section class="service-hero-enriched" aria-label="Treatment areas" itemscope itemtype="https://schema.org/MedicalProcedure">
            <meta itemprop="name" content="<?php the_title_attribute(); ?>">
            <div class="section__inner service-hero-enriched__inner">
                <!-- Left Details -->
                <div class="service-hero-enriched__content reveal">
                    <span class="service-hero-enriched__cat">
                        <span aria-hidden="true"><?php echo esc_html($icon); ?></span>
                        <?php echo esc_html($category_name); ?>
                    </span>
                    
                    <h1 class="service-hero-enriched__title" itemprop="headline">
                        <?php echo esc_html($sec_a_title ?: get_the_title()); ?>
                    </h1>
                    
                    <div class="service-hero-enriched__desc" itemprop="description">
                        <?php 
                        if (!empty($sec_a_desc)) {
                            echo wp_kses_post(wpautop($sec_a_desc));
                        } else {
                            echo wp_kses_post(wpautop(get_the_excerpt()));
                        }
                        ?>
                    </div>

                    <?php if (!empty($sec_a_checklist)): ?>
                        <ul class="service-hero-enriched__checklist" role="list">
                            <?php foreach ($sec_a_checklist as $item): ?>
                                <li>
                                    <svg class="service-hero-enriched__check" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span><?php echo esc_html($item); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($price || $duration): ?>
                        <div class="service-hero-enriched__meta">
                            <?php if ($price): ?>
                                <div class="service-hero-enriched__meta-item" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="USD">
                                    <span class="service-hero-enriched__meta-label">Starting At</span>
                                    <span class="service-hero-enriched__meta-value" itemprop="price"><?php echo esc_html($price); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($duration): ?>
                                <div class="service-hero-enriched__meta-item">
                                    <span class="service-hero-enriched__meta-label">Duration</span>
                                    <span class="service-hero-enriched__meta-value"><?php echo esc_html($duration); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="service-hero-enriched__actions">
                        <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                        <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                    </div>
                </div>

                <!-- Right Hero Image -->
                <div class="service-hero-enriched__image-wrap reveal" aria-hidden="true">
                    <div class="service-hero-enriched__image">
                        <img class="service-hero-enriched__img" src="<?php echo esc_url($sec_a_img_url); ?>" alt="<?php echo esc_attr($sec_a_title ?: get_the_title()); ?>" itemprop="image">
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Section B (How It Works) -->
        <?php if (!empty($sec_b_desc)): ?>
            <section class="service-how-works" aria-label="How it works">
                <div class="section__inner">
                    <div class="service-how-works__grid reveal">
                        <!-- Left Image -->
                        <div class="service-how-works__image-wrap" aria-hidden="true">
                            <div class="service-how-works__image">
                                <img class="service-how-works__img" src="<?php echo esc_url($sec_b_img_url); ?>" alt="<?php echo esc_attr($sec_b_title ?: 'How It Works'); ?>" loading="lazy">
                            </div>
                        </div>
                        
                        <!-- Right content & actions -->
                        <div class="service-how-works__content">
                            <span class="section__label">Science &amp; Process</span>
                            <h2 class="service-how-works__title"><?php echo esc_html($sec_b_title ?: 'How It Works'); ?></h2>
                            <div class="service-how-works__desc">
                                <?php echo wp_kses_post(wpautop($sec_b_desc)); ?>
                            </div>
                            <div class="service-how-works__actions">
                                <a href="#book-now" class="btn btn--primary">Book Consultation</a>
                                <a href="tel:8132302219" class="btn btn--outline">Call to Ask Questions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- 4. Section C (What to Expect banner) -->
        <?php if (!empty($sec_c_desc)): ?>
            <section class="service-expect-banner" style="background-image: url('<?php echo esc_url($sec_c_img_url); ?>');" aria-label="What to expect">
                <div class="service-expect-banner__overlay"></div>
                <div class="service-expect-banner__inner">
                    <div class="service-expect-card reveal">
                        <span class="service-expect-card__subtitle">Treatment Comfort</span>
                        <h2 class="service-expect-card__title"><?php echo esc_html($sec_c_title ?: 'What to Expect'); ?></h2>
                        <div class="service-expect-card__desc">
                            <?php echo wp_kses_post(wpautop($sec_c_desc)); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- 5. Section D (Preparation & Aftercare columns) -->
        <section class="service-prep-aftercare" aria-label="Preparation and aftercare guidelines">
            <div class="section__inner">
                <div class="section__header reveal">
                    <span class="section__label">Livia Guidelines</span>
                    <h2 class="section__title">Preparation &amp; Aftercare Guidelines</h2>
                </div>
                
                <div class="service-prep-aftercare__grid reveal">
                    <!-- Column 1: Preparation -->
                    <div class="service-prep-aftercare__col">
                        <div class="service-prep-aftercare__card service-prep-aftercare__card--prep">
                            <div class="service-prep-aftercare__icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <h3 class="service-prep-aftercare__title">Pre-Treatment Advice</h3>
                            <p class="service-prep-aftercare__subtitle">Before treatment, patients are typically advised to:</p>
                            <ul class="service-prep-aftercare__list">
                                <?php foreach ($prep_guidelines as $item): ?>
                                    <li>
                                        <svg class="service-prep-aftercare__check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Column 2: Aftercare -->
                    <div class="service-prep-aftercare__col">
                        <div class="service-prep-aftercare__card service-prep-aftercare__card--after">
                            <div class="service-prep-aftercare__icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <h3 class="service-prep-aftercare__title">Post-Treatment Advice</h3>
                            <p class="service-prep-aftercare__subtitle">After treatment, patients should:</p>
                            <ul class="service-prep-aftercare__list">
                                <?php foreach ($after_guidelines as $item): ?>
                                    <li>
                                        <svg class="service-prep-aftercare__check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Section E (Treatment Plan & APRN Credentials) -->
        <?php if (!empty($sec_e_desc)): ?>
            <section class="service-plan" aria-label="Treatment plan">
                <div class="section__inner">
                    <div class="service-plan__grid reveal">
                        <!-- Left Content -->
                        <div class="service-plan__content">
                            <span class="section__label">Treatment Schedule</span>
                            <h2 class="service-plan__title"><?php echo esc_html($sec_e_title ?: 'Treatment Plan & Results'); ?></h2>
                            <div class="service-plan__desc">
                                <?php echo wp_kses_post(wpautop($sec_e_desc)); ?>
                            </div>
                            
                            <!-- Static Credentials Card -->
                            <div class="service-credentials-card">
                                <div class="service-credentials-card__header">
                                    <div class="service-credentials-card__avatar" aria-hidden="true">AS</div>
                                    <div>
                                        <h4 class="service-credentials-card__name">Angela Spicola, APRN</h4>
                                        <span class="service-credentials-card__title">Nurse Practitioner &amp; Founder</span>
                                    </div>
                                </div>
                                <p class="service-credentials-card__text">
                                    Treatments are performed by Angela Spicola, APRN; treatments are customized to your skin type, concerns, and goals, ensuring precise, safe, and effective care.
                                </p>
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="service-plan__image-wrap" aria-hidden="true">
                            <div class="service-plan__image">
                                <img class="service-plan__img" src="<?php echo esc_url($sec_e_img_url); ?>" alt="<?php echo esc_attr($sec_e_title ?: 'Treatment Plan'); ?>" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- 7. Section F (FAQs Accordion) -->
        <?php if (!empty($faqs)): ?>
            <section class="service-faqs" aria-label="Frequently asked questions">
                <div class="section__inner">
                    <div class="section__header reveal">
                        <span class="section__label">Common Questions</span>
                        <h2 class="section__title">Treatment Frequently Asked Questions</h2>
                    </div>
                    
                    <div class="faq-accordion reveal">
                        <?php foreach ($faqs as $index => $faq): 
                            $faq_id = 'faq-item-' . ($index + 1);
                            $header_id = 'faq-header-' . ($index + 1);
                            $panel_id = 'faq-panel-' . ($index + 1);
                        ?>
                            <div class="faq-accordion__item" id="<?php echo esc_attr($faq_id); ?>">
                                <button class="faq-accordion__header" 
                                        id="<?php echo esc_attr($header_id); ?>" 
                                        aria-expanded="false" 
                                        aria-controls="<?php echo esc_attr($panel_id); ?>">
                                    <span class="faq-accordion__question"><?php echo esc_html($faq['q']); ?></span>
                                    <span class="faq-accordion__toggle-icon" aria-hidden="true">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    </span>
                                </button>
                                <div class="faq-accordion__content" 
                                     id="<?php echo esc_attr($panel_id); ?>" 
                                     role="region" 
                                     aria-labelledby="<?php echo esc_attr($header_id); ?>">
                                    <div class="faq-accordion__body">
                                        <?php echo wp_kses_post($faq['a']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>



    <?php else: ?>
        <!-- ==========================================================================
             CLASSIC LAYOUT (State B)
             ========================================================================== -->

        <!-- 1. Classic Hero (Breadcrumbs inside, price badges) -->
        <section class="service-hero<?php echo !$has_image ? ' service-hero--no-image' : ''; ?>"
                 aria-label="Service details"
                 itemscope itemtype="https://schema.org/MedicalProcedure">
            <meta itemprop="name" content="<?php the_title_attribute(); ?>">
            <span class="service-hero__glow" aria-hidden="true"></span>

            <div class="service-hero__inner">
                <!-- Left: content -->
                <div class="service-hero__content reveal">
                    <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb"
                         itemscope itemtype="https://schema.org/BreadcrumbList">
                        <ol class="breadcrumbs__list">
                            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="breadcrumbs__link"><span itemprop="name">Home</span></a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" itemprop="item" class="breadcrumbs__link"><span itemprop="name">Services</span></a>
                                <meta itemprop="position" content="2">
                            </li>
                            <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                            <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                                <span itemprop="name" class="breadcrumbs__current"><?php the_title(); ?></span>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>

                    <span class="section__label service-hero__cat">
                        <span aria-hidden="true"><?php echo esc_html($icon); ?></span>
                        <?php echo esc_html($category_name); ?>
                    </span>

                    <h1 class="service-hero__title" itemprop="headline">
                        <?php the_title(); ?><br>
                        <em class="service-hero__location">in Tampa, FL</em>
                    </h1>

                    <?php if (has_excerpt()): ?>
                        <p class="service-hero__desc" itemprop="description"><?php echo get_the_excerpt(); ?></p>
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

                <!-- Right: image -->
                <?php if ($has_image): ?>
                <div class="service-hero__image reveal" aria-hidden="true">
                    <?php the_post_thumbnail('large', [
                        'loading'       => 'eager',
                        'decoding'      => 'async',
                        'fetchpriority' => 'high',
                        'itemprop'      => 'image',
                        'class'         => 'service-hero__img',
                    ]); ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- 2. Classic Content body + Sticky Booking Sidebar -->
        <section class="service-body" aria-label="Treatment information">
            <div class="section__inner">
                <div class="service-body__layout">

                    <!-- Main WP editor content -->
                    <div class="service-body__main service-content__body reveal" itemprop="description">
                        <?php the_content(); ?>
                    </div>

                    <!-- Sticky booking sidebar -->
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

        <!-- 3. Benefits grid -->
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

        <!-- 4. Video section -->
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

        <!-- 5. Static Why Choose Us cards -->
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

    <?php endif; ?>

    <!-- ==========================================================================
         COMMON PAGE BOTTOM
         ========================================================================== -->

    <!-- Standalone Bottom Lightbox (Only for Classic photo) -->
    <?php if (!$is_enriched): ?>
        <?php
        $bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
        if (!empty($bottom_photo_id)):
            $bottom_photo_html = wp_get_attachment_image($bottom_photo_id, 'full', false, [
                'alt'      => get_the_title() . ' bottom photo',
                'loading'  => 'lazy',
                'decoding' => 'async',
                'class'    => 'service-bottom-photo__img'
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
    <?php endif; ?>

    <!-- Related Treatments Grid (same-category taxonomy) -->
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

    // Backfill: if same-cat returned fewer than 3, top up with random others
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

    <!-- CTA booking banner -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary">Book a Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline">All Services</a>
            </div>
        </div>
    </section>

    <!-- Lightbox overlay & FAQ accordion Toggle scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. FAQ Accordions animation & aria-expanded adjustments
        const faqHeaders = document.querySelectorAll('.faq-accordion__header');
        faqHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const item = this.parentElement;
                const content = this.nextElementSibling;
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                // Toggle active state
                if (isExpanded) {
                    this.setAttribute('aria-expanded', 'false');
                    item.classList.remove('is-active');
                    content.style.maxHeight = null;
                } else {
                    // Close other active FAQ rows for an accordion effect
                    const activeItem = document.querySelector('.faq-accordion__item.is-active');
                    if (activeItem) {
                        const activeHeader = activeItem.querySelector('.faq-accordion__header');
                        const activeContent = activeItem.querySelector('.faq-accordion__content');
                        if (activeHeader && activeContent) {
                            activeHeader.setAttribute('aria-expanded', 'false');
                            activeItem.classList.remove('is-active');
                            activeContent.style.maxHeight = null;
                        }
                    }
                    
                    this.setAttribute('aria-expanded', 'true');
                    item.classList.add('is-active');
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });

        // 2. Bottom Photo Lightbox modal overlay logic
        const lightboxTrigger = document.querySelector('.service-bottom-photo__lightbox-trigger');
        if (lightboxTrigger) {
            // Instantiate overlay on the fly
            const overlay = document.createElement('div');
            overlay.className = 'livia-lightbox-overlay';
            overlay.innerHTML = `
                <button class="livia-lightbox-close" aria-label="Close zoomed image">&times;</button>
                <img class="livia-lightbox-image" src="" alt="Zoomed View">
            `;
            document.body.appendChild(overlay);

            const lightboxImg = overlay.querySelector('.livia-lightbox-image');
            const closeBtn = overlay.querySelector('.livia-lightbox-close');

            // Open lightbox modal
            lightboxTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                const targetUrl = this.getAttribute('href');
                lightboxImg.src = targetUrl;
                overlay.classList.add('is-active');
                document.body.style.overflow = 'hidden'; // block page scrolling
            });

            // Close lightbox modal
            function closeLightbox() {
                overlay.classList.remove('is-active');
                document.body.style.overflow = ''; // restore scrolling
                setTimeout(() => { lightboxImg.src = ''; }, 400); // clear src after animation finishes
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
        }
    });
    </script>

</main>

<?php get_footer(); ?>
