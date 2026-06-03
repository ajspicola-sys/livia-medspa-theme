<?php
/**
 * LIVIA Med Spa ΓÇö Single Service Template
 * Premium redesign: 2-col hero with image, content + sidebar,
 * conditional benefits grid, conditional video section.
 */
get_header();
?>
<style id="livia-single-service-inlined-css">

/* --- Livia Med Spa Single Service Layout Inline CSS --- */

/* -- CTA Section Styles -- */
/* ==========================================================================
   CTA SECTION
   ========================================================================== */
.cta-section {
  padding: clamp(4rem, 3rem + 4vw, 6rem) 0;
  background: var(--bg-cream);
  position: relative;
  overflow: hidden;
}

.cta-section::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(var(--brand-rgb), 0.3), transparent);
}

.cta-section::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 600px;
  height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(var(--brand-rgb), 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.cta-section__inner {
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
  padding: 0 2rem;
  position: relative;
  z-index: 2;
}

.cta-section__label {
  display: inline-flex;
  padding: 0.4rem 1.25rem;
  background: rgba(var(--brand-rgb), 0.12);
  border: 1px solid rgba(var(--brand-rgb), 0.2);
  border-radius: 9999px;
  font-size: 0.68rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--brand);
  margin-bottom: 1.5rem;
}

.cta-section__title {
  font-size: clamp(2.2rem, 1.6rem + 3vw, 3.8rem);
  font-weight: 300;
  color: var(--text-dark);
  margin-bottom: 1rem;
}

.cta-section__text {
  font-size: clamp(0.95rem, 0.88rem + 0.35vw, 1.1rem);
  color: rgba(60, 30, 90, 0.65);
  line-height: 1.7;
  margin-bottom: 2.5rem;
}

.cta-section__urgency {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--brand);
  margin-bottom: 1.5rem;
  animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
  0%, 100% { opacity: 0.8; }
  50% { opacity: 1; }
}

/* ==========================================================================
   TESTIMONIALS
   ========================================================================== */
/* NOTE: Testimonial-card styles are defined above (line ~2410). Do not duplicate here. */


.cta-section__actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.cta-section__actions .btn--outline {
  color: var(--text-dark);
  border-color: rgba(var(--dark-rgb), 0.25);
}

.cta-section__actions .btn--outline:hover {
  border-color: var(--brand);
  color: var(--brand);
}



/* -- Service Hero & Layout Styles -- */
/* ==========================================================================
   SINGLE SERVICE PAGE
   ========================================================================== */

/* -- Service Hero ------------------------------------------------ */
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

/* No thumbnail  revert to centered single column */
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

/* Price & Duration badges */
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

/* Featured image column */
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

.service-hero__img-glow {
  display: none;
}

.service-hero__location {
  font-style: italic;
  font-weight: 300;
  color: var(--brand);
  -webkit-text-fill-color: var(--brand);
  background: none;
  font-size: 0.75em;
}

/* Responsive */
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

.service-hero__actions .btn--outline {
  color: var(--text-dark);
  border-color: rgba(var(--dark-rgb), 0.2);
}

.service-hero__actions .btn--outline:hover {
  color: var(--brand);
  border-color: var(--brand);
}

/* -- Service Body: content + sticky sidebar ---------------------- */
.service-body {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: #fff;
}

.service-body__layout {
  display: grid;
  grid-template-columns: 1fr 300px;
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

/* -- Service Content typography (shared via .service-content__body) -- */
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
  content: '?';
  position: absolute;
  left: 0;
  color: var(--brand);
  font-size: 0.7rem;
  top: 0.35rem;
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

.service-content__body strong {
  color: var(--text-dark);
  font-weight: 600;
}

/* -- Benefits Grid (conditional) --------------------------------- */
.service-benefits {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: var(--bg-cream);
}

.service-benefits__grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 1rem;
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
  box-shadow: 0 4px 20px rgba(var(--brand-rgb), 0.08);
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



/* -- Video Section Styles -- */
/* -- Video Section (conditional) --------------------------------- */
.service-video {
  padding: clamp(3rem, 2.5rem + 3vw, 5rem) 0;
  background: #fff;
}

.service-video__wrap {
  position: relative;
  width: 100%;
  margin: 2.5rem auto 0;
  aspect-ratio: 16 / 9;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 24px 72px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(var(--brand-rgb), 0.08);
}

.service-video__wrap iframe {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  border: none;
}



/* -- Why Choose Us Styles -- */
/* -- Why People Choose Livia (Static) ---------------------------- */

.service-why-us {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #fff;
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
  border-radius: 16px;
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
  height: 3px;
  background: linear-gradient(90deg, var(--brand), var(--brand-bright));
  transform: scaleX(0);
  transition: transform 0.4s ease;
  transform-origin: left;
}

.service-why-us__card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
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



/* -- Related Services Styles -- */
/* ==========================================================================
   RELATED SERVICES
   ========================================================================== */
.related-services {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: var(--border-soft);
}

.related-services__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}

@media (max-width: 768px) {
  .related-services__grid {
    grid-template-columns: 1fr;
  }
}

/* Keep old service card meta for archive pages */
.service-card__meta {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
  padding-top: 0.75rem;
  border-top: 1px solid #f0f0f4;
}

.service-card__price {
  font-size: 0.85rem;
  font-weight: 700;
  color: var(--brand);
}

.service-card__duration {
  font-size: 0.78rem;
  color: var(--text-subtle);
}


/* -- Lightbox & Bottom Photo Styles -- */
/* ==========================================================================
   SERVICE BOTTOM PHOTO LIGHTBOX & ZOOM
   ========================================================================== */
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

/* Lightbox Overlay */
.livia-lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(18, 12, 24, 0.94); /* Luxurious deep translucent purple */
  z-index: 99999;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  backdrop-filter: blur(12px); /* High-end glassmorphic blur */
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
  font-size: 24px;
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

/* Standalone Service Bottom Photo Section */
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

.service-bottom-photo__wrap img {
  display: block;
  margin: 0 auto;
  max-width: 100%;
  height: auto;
  border-radius: 24px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(var(--brand-rgb), 0.08);
}


/* -- Responsive Overrides -- */

@media (max-width: 576px) {
  .cta-section__actions {
    flex-direction: column;
  }
  .cta-section__actions .btn {
    width: 100%;
  }
}


</style>
<?php

$post_id      = get_the_ID();
$icon         = get_post_meta($post_id, '_service_icon', true)     ?: 'Γ£¿';
$price        = get_post_meta($post_id, '_service_price', true);
$duration     = get_post_meta($post_id, '_service_duration', true);
$video        = get_post_meta($post_id, '_service_video', true);
$benefits_raw = get_post_meta($post_id, '_service_benefits', true);
$benefits     = $benefits_raw ? array_filter(array_map('trim', explode("\n", $benefits_raw))) : [];

// Convert YouTube / Vimeo URL ΓåÆ embed URL
// Accepts: watch?v=, youtu.be/, /shorts/, /embed/, /v/
$video_embed = '';
if ($video) {
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video, $m)) {
        $video_embed = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1&iv_load_policy=3&color=white&playsinline=1&autoplay=1&mute=1&loop=1&playlist=' . $m[1];
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video, $m)) {
        $video_embed = 'https://player.vimeo.com/video/' . $m[1] . '?title=0&byline=0&portrait=0&color=AC13F9';
    }
}

$categories    = get_the_terms($post_id, 'service_category');
$category_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Treatment';
$has_image     = has_post_thumbnail();
?>

<main class="site-main" id="main-content">

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         HERO ΓÇö 2-column when featured image exists, centered when not
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <section class="service-hero<?php echo !$has_image ? ' service-hero--no-image' : ''; ?>"
             aria-label="Service details"
             itemscope itemtype="https://schema.org/MedicalProcedure">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <span class="service-hero__glow" aria-hidden="true"></span>

        <div class="service-hero__inner">

            <!-- Left: text content -->
            <div class="service-hero__content reveal">

                <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb"
                     itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="breadcrumbs__list">
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">ΓÇ║</li>
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">ΓÇ║</li>
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

            <!-- Right: featured image (only renders when thumbnail exists) -->
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

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         CONTENT + STICKY SIDEBAR
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <section class="service-body" aria-label="Treatment information">
        <div class="section__inner">
            <div class="service-body__layout">

                <!-- Main WP editor content -->
                <div class="service-body__main service-content__body reveal" itemprop="description">
                    <?php the_content(); ?>

                </div>

                <!-- Sticky quick-info & booking sidebar -->
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
                        <p class="service-sidebar__fine">Free consultation ┬╖ No commitment required</p>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         STANDALONE BOTTOM PHOTO SECTION
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <?php
    $bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
    if (!empty($bottom_photo_id)):
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

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         BENEFITS GRID ΓÇö only renders when meta field has content
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
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

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         VIDEO SECTION ΓÇö only renders when _service_video meta set
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
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

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         WHY PEOPLE CHOOSE LIVIA (Static)
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
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

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         RELATED SERVICES (Dynamic)
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <?php
    // Pull from same category first; backfill with random others if < 3 found
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
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: 'Γ£¿';
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
                    <span class="service-card__link">Learn More ΓåÆ</span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>



    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         CTA (Static)
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <section class="cta-section" aria-label="Book a consultation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Start Your Journey</span>
            <h2 class="cta-section__title">Ready to Book<br>Your <?php the_title(); ?>?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create a personalized treatment plan just for you.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book a Consultation</a>
                <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn--outline btn--lg">ΓåÉ All Services</a>
            </div>
        </div>
    </section>

    <!-- ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ
         LIGHTBOX CONTAINER & LOGIC (Vanilla JS)
         ΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉΓòÉ -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.querySelector('.service-bottom-photo__lightbox-trigger');
        if (!trigger) return;

        // Create overlay element dynamically
        const overlay = document.createElement('div');
        overlay.className = 'livia-lightbox-overlay';
        overlay.innerHTML = `
            <button class="livia-lightbox-close" aria-label="Close Image">&times;</button>
            <img class="livia-lightbox-image" src="" alt="Zoomed Service Image">
        `;
        document.body.appendChild(overlay);

        const lightboxImg = overlay.querySelector('.livia-lightbox-image');
        const closeBtn = overlay.querySelector('.livia-lightbox-close');

        // Open lightbox
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const imgUrl = this.getAttribute('href');
            lightboxImg.src = imgUrl;
            overlay.classList.add('is-active');
            document.body.style.overflow = 'hidden'; // block page scroll
        });

        // Close lightbox
        function closeLightbox() {
            overlay.classList.remove('is-active');
            document.body.style.overflow = ''; // restore page scroll
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
    });
    </script>

</main>

<?php get_footer(); ?>
