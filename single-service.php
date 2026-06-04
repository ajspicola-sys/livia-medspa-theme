<?php
/**
 * LIVIA Med Spa — Single Service Template
 * Clean, premium rewrite of the single service page template.
 * Supports both enriched (alternating sections) and classic content layouts.
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


/* -- Redesigned Enriched Layout Styles -- */
/* ==========================================================================
   REDESIGNED SERVICE PAGES STYLES
   ========================================================================== */

.breadcrumbs--services {
  padding: 2rem 0 1rem;
  background: var(--bg-cream);
}

.service-section {
  padding: clamp(3rem, 2rem + 3vw, 5rem) 0;
  background: #fff;
}

.service-section:nth-of-type(even) {
  background: var(--bg-cream);
}

.service-section__inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: clamp(3rem, 2rem + 4vw, 6rem);
}

.service-section--reverse .service-section__inner {
  grid-template-columns: 1fr 1fr;
}

.service-section--reverse .service-section__content {
  grid-column: 2;
}

.service-section--reverse .service-section__image {
  grid-column: 1;
  grid-row: 1;
}

.service-section__content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.service-section__label {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--brand);
  margin-bottom: 1rem;
}

.service-section__title {
  font-size: clamp(2rem, 1.6rem + 2vw, 3.4rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.15;
  margin-bottom: 1.5rem;
}

.service-section__desc {
  font-size: 0.95rem;
  color: var(--text-mid);
  line-height: 1.8;
  margin-bottom: 1.5rem;
}

.service-section__desc p {
  margin-bottom: 1rem;
}

.service-section__desc p:last-child {
  margin-bottom: 0;
}

.service-section__image {
  position: relative;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 20px 48px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(var(--brand-rgb), 0.06);
  aspect-ratio: 4 / 3;
}

.service-section__image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.service-section__actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-top: 1.5rem;
  flex-wrap: wrap;
}

.service-section__provider-note {
  margin-top: 2rem;
  padding: 1.25rem 1.5rem;
  background: rgba(var(--brand-rgb), 0.04);
  border-left: 3px solid var(--brand);
  border-radius: 0 12px 12px 0;
  font-size: 0.88rem;
  color: var(--text-dark);
  line-height: 1.6;
}

.service-section__provider-note p {
  margin-bottom: 0;
}

/* -- Checklist Items -- */
.service-checklist {
  list-style: none;
  padding: 0;
  margin: 1.5rem 0 0;
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
  width: 100%;
}

.service-checklist__item {
  display: flex;
  align-items: flex-start;
  gap: 0.85rem;
  font-size: 0.92rem;
  color: var(--text-mid);
  line-height: 1.5;
}

.service-checklist__check {
  flex-shrink: 0;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--brand), var(--brand-bright));
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 0.72rem;
  font-weight: 700;
  margin-top: 1px;
}

/* -- Section 3: Expectation Banner -- */
.service-expect-banner {
  padding: clamp(6rem, 5rem + 5vw, 10rem) 0;
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: center;
  overflow: hidden;
}

.service-expect-banner__overlay {
  position: absolute;
  inset: 0;
  background: rgba(var(--dark-rgb), 0.15);
  z-index: 1;
}

.service-expect-banner__inner {
  max-width: 1280px;
  width: 100%;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
  position: relative;
  z-index: 2;
}

.service-expect-card {
  background: rgba(255, 255, 255, 0.88);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.25);
  border-radius: 28px;
  padding: clamp(2rem, 1.5rem + 3vw, 3.5rem);
  max-width: 580px;
  box-shadow: 0 24px 60px rgba(0, 0, 0, 0.12);
}

.service-expect-card__label {
  display: inline-block;
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--brand-mid);
  margin-bottom: 0.75rem;
}

.service-expect-card__title {
  font-size: clamp(1.6rem, 1.3rem + 1.2vw, 2.4rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.2;
  margin-bottom: 1.25rem;
}

.service-expect-card__desc {
  font-size: 0.92rem;
  color: var(--text-mid);
  line-height: 1.75;
}

.service-expect-card__desc p {
  margin-bottom: 0.75rem;
}

.service-expect-card__desc p:last-child {
  margin-bottom: 0;
}

/* -- Section 4: Preparation & Aftercare -- */
.service-prep-aftercare {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #fff;
}

.service-prep-aftercare__inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
}

.service-prep-aftercare__header {
  text-align: center;
  margin-bottom: 3.5rem;
}

.service-prep-aftercare__label {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--brand);
  margin-bottom: 0.75rem;
}

.service-prep-aftercare__title {
  font-size: clamp(1.8rem, 1.5rem + 1.5vw, 2.8rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.2;
}

.service-prep-aftercare__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(2.5rem, 2rem + 3vw, 5rem);
}

.service-prep-aftercare__subtitle {
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-dark);
  margin-bottom: 1.5rem;
  line-height: 1.4;
  font-family: 'DM Sans', sans-serif;
  letter-spacing: -0.01em;
}

/* -- Section 6: FAQ Accordion -- */
.service-faqs {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: var(--bg-cream);
}

.service-faqs__inner {
  max-width: 860px;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
}

.service-faqs__header {
  text-align: center;
  margin-bottom: 3rem;
}

.service-faqs__title {
  font-size: clamp(1.8rem, 1.5rem + 1.5vw, 2.8rem);
  font-weight: 300;
  color: var(--text-dark);
  line-height: 1.2;
}

.faq-accordion {
  border-top: 1px solid rgba(0, 0, 0, 0.07);
}

.faq-accordion__item {
  border-bottom: 1px solid rgba(0, 0, 0, 0.07);
}

.faq-accordion__header {
  width: 100%;
  background: transparent;
  border: none;
  padding: 1.5rem 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1.5rem;
  cursor: pointer;
  text-align: left;
  font-family: 'DM Sans', sans-serif;
}

.faq-accordion__title {
  font-size: 1.05rem;
  font-weight: 600;
  color: var(--text-dark);
  transition: color 0.3s ease;
  letter-spacing: -0.01em;
}

.faq-accordion__icon {
  font-size: 1.3rem;
  color: var(--brand);
  font-weight: 400;
  line-height: 1;
  transition: transform 0.3s ease;
  flex-shrink: 0;
  display: inline-block;
  width: 20px;
  height: 20px;
  text-align: center;
}

.faq-accordion__content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-accordion__content-inner {
  padding: 0 0.5rem 1.5rem;
  font-size: 0.95rem;
  color: var(--text-mid);
  line-height: 1.75;
}

.faq-accordion__content-inner p {
  margin-bottom: 0.75rem;
}

.faq-accordion__content-inner p:last-child {
  margin-bottom: 0;
}

.faq-accordion__item.is-active .faq-accordion__title {
  color: var(--brand);
}

/* -- Section 7: Location Map Banner -- */
.service-map-banner {
  padding: clamp(4rem, 3rem + 4vw, 7rem) 0;
  background: #fff;
}

.service-map-banner__inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
  display: grid;
  grid-template-columns: 1.3fr 1.7fr;
  gap: clamp(3rem, 2rem + 4vw, 6rem);
  align-items: center;
}

.service-map-banner__content {
  background: linear-gradient(135deg, var(--brand) 0%, var(--brand-pink-mid) 100%);
  color: #fff;
  padding: clamp(2.5rem, 2rem + 3vw, 4rem) clamp(2rem, 1.5rem + 3vw, 3.5rem);
  border-radius: 28px;
  box-shadow: 0 24px 60px rgba(var(--brand-rgb), 0.18);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.service-map-banner__label {
  display: inline-block;
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.75);
  margin-bottom: 0.85rem;
}

.service-map-banner__title {
  color: #fff;
  font-size: clamp(1.8rem, 1.5rem + 1vw, 2.6rem);
  font-weight: 300;
  line-height: 1.2;
  margin-bottom: 2rem;
}

.service-map-banner__info {
  display: flex;
  flex-direction: column;
  gap: 1.1rem;
  margin-bottom: 2rem;
  width: 100%;
}

.service-map-banner__info-item {
  display: flex;
  align-items: flex-start;
  gap: 0.85rem;
  font-size: 0.92rem;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.4;
}

.service-map-banner__info-item svg {
  flex-shrink: 0;
  margin-top: 2px;
  stroke: #fff;
}

.service-map-banner__info-item a {
  color: inherit;
  text-decoration: none;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.4);
  transition: border-bottom-color 0.25s;
}

.service-map-banner__info-item a:hover {
  border-bottom-color: #fff;
}

.service-map-banner__actions {
  width: 100%;
}

.service-map-banner__actions .btn {
  background: #fff !important;
  color: var(--brand) !important;
  width: 100%;
  justify-content: center;
  display: flex;
}

.service-map-banner__actions .btn:hover {
  background: rgba(255, 255, 255, 0.9) !important;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.service-map-banner__map {
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 24px 60px rgba(0, 0, 0, 0.08);
  height: 480px;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

/* -- Responsive styling -- */
@media (max-width: 900px) {
  .service-section__inner {
    grid-template-columns: 1fr;
    text-align: center;
  }
  
  .service-section--reverse .service-section__content {
    grid-column: 1;
  }

  .service-section--reverse .service-section__image {
    grid-column: 1;
    grid-row: auto;
  }

  .service-section__content {
    align-items: center;
  }

  .service-section__image {
    order: -1;
    aspect-ratio: 16 / 9;
    width: 100%;
  }

  .service-section__actions {
    justify-content: center;
  }

  .service-section__provider-note {
    text-align: center;
    border-left: none;
    border-top: 3px solid var(--brand);
    border-radius: 0 0 12px 12px;
  }

  .service-expect-banner {
    justify-content: center;
    padding: 4rem 0;
  }

  .service-expect-card {
    margin: 0 auto;
    max-width: 100%;
  }

  .service-prep-aftercare__grid {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }

  .service-map-banner__inner {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }

  .service-map-banner__map {
    height: 350px;
    order: -1;
  }
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

// Retrieve Custom Fields Metadata for Sections
$sec_a_title     = get_post_meta($post_id, '_service_sec_a_title', true);
$sec_a_desc      = get_post_meta($post_id, '_service_sec_a_desc', true);
$sec_a_checklist = get_post_meta($post_id, '_service_sec_a_checklist', true);
$sec_a_image_id  = get_post_meta($post_id, '_service_sec_a_image_id', true);

$sec_b_title     = get_post_meta($post_id, '_service_sec_b_title', true);
$sec_b_desc      = get_post_meta($post_id, '_service_sec_b_desc', true);
$sec_b_image_id  = get_post_meta($post_id, '_service_sec_b_image_id', true);

$sec_c_title       = get_post_meta($post_id, '_service_sec_c_title', true);
$sec_c_desc        = get_post_meta($post_id, '_service_sec_c_desc', true);
$sec_c_bg_image_id = get_post_meta($post_id, '_service_sec_c_bg_image_id', true);

$sec_d_prep  = get_post_meta($post_id, '_service_sec_d_prep', true);
$sec_d_after = get_post_meta($post_id, '_service_sec_d_after', true);

$sec_e_title     = get_post_meta($post_id, '_service_sec_e_title', true);
$sec_e_desc      = get_post_meta($post_id, '_service_sec_e_desc', true);
$sec_e_image_id  = get_post_meta($post_id, '_service_sec_e_image_id', true);

// Parse checklists/guides by line breaks
$sec_a_checklist_items = !empty($sec_a_checklist) ? array_filter(array_map('trim', explode("\n", $sec_a_checklist))) : [];
$sec_d_prep_items      = !empty($sec_d_prep) ? array_filter(array_map('trim', explode("\n", $sec_d_prep))) : [];
$sec_d_after_items     = !empty($sec_d_after) ? array_filter(array_map('trim', explode("\n", $sec_d_after))) : [];

// Retrieve FAQ items
$faqs = [];
for ($i = 1; $i <= 6; $i++) {
    $q = get_post_meta($post_id, '_service_faq_q' . $i, true);
    $a = get_post_meta($post_id, '_service_faq_a' . $i, true);
    if (!empty($q)) {
        $faqs[] = [
            'q' => $q,
            'a' => $a
        ];
    }
}

// Check if we have Custom Section layout data to show the premium sections
$is_enriched = (
    !empty($sec_a_desc) || 
    !empty($sec_b_desc) || 
    !empty($sec_c_desc) || 
    !empty($sec_e_desc)
);

// Helper function to resolve stock image URLs or custom uploads
if (!function_exists('livia_get_service_image_url')) {
    function livia_get_service_image_url($image_id, $type, $slug) {
        if (!empty($image_id) && is_numeric($image_id)) {
            $url = wp_get_attachment_url($image_id);
            if (!empty($url)) {
                return $url;
            }
        }
        
        // Stock fallbacks
        $default_images = [
            'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
            'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
            'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
            'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
        ];

        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_538904225-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_446213685-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_374628525-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_260345614-1-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_474297401-1-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        } else {
            $img_mapping = $default_images;
        }
        
        return isset($img_mapping[$type]) ? $img_mapping[$type] : '';
    }
}

// Helper function for default prep/aftercare
if (!function_exists('livia_get_default_prep_aftercare')) {
    function livia_get_default_prep_aftercare($slug) {
        $prep = [];
        $after = [];
        
        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false || strpos($slug, 'candela') !== false || strpos($slug, 'lhr') !== false) {
            $prep = [
                'Shave the treatment area completely 24 hours prior to your session.',
                'Avoid plucking, waxing, or tweezing hair in the target area for 4 weeks.',
                'Avoid direct sun exposure and tanning beds for at least 2 weeks.',
                'Ensure skin is completely free of self-tanner, lotions, oils, and makeup on the day of treatment.'
            ];
            $after = [
                'Avoid direct sun exposure on the treated areas and apply broad-spectrum SPF 30+ daily.',
                'Avoid hot tubs, saunas, steam rooms, and hot showers for 24–48 hours.',
                'Postpone strenuous exercise and excessive sweating for 24 hours.',
                'Do not pluck, wax, or tweeze between sessions; shaving is the only permitted hair removal method.'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $prep = [
                'Avoid alcohol and blood-thinning supplements for 24-48 hours before treatment.',
                'Arrive with a clean, makeup-free face if possible.',
                'Reschedule if you have an active skin rash, cold sore, or infection in the treatment area.'
            ];
            $after = [
                'Keep your head elevated and avoid lying down for 4 hours after treatment.',
                'Avoid rubbing, massaging, or placing pressure on the treated areas for 24 hours.',
                'Postpone strenuous exercise and heavy sweating for 24 hours.',
                'Avoid facials, chemical peels, and microdermabrasion for 2 weeks.'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $prep = [
                'Avoid blood-thinning medications and supplements (like aspirin, fish oil) for 1 week prior.',
                'Avoid alcohol intake for 24-48 hours prior to your appointment to minimize bruising.',
                'Plan your treatment at least 2 weeks before any major social events.'
            ];
            $after = [
                'Apply cold packs gently to the treated areas for 15-20 minutes at a time to reduce swelling.',
                'Avoid touching, rubbing, or massaging the injection sites (except Sculptra 5-5-5 rule).',
                'Avoid sleeping face-down; sleep on your back with head elevated on pillows for 2-3 nights.',
                'Avoid strenuous exercise, saunas, and hot tubs for 24-48 hours.'
            ];
        } else {
            $prep = [
                'Avoid facial treatments, chemical peels, or laser procedures for 2 weeks prior.',
                'Arrive with clean skin, free of heavy makeup, lotions, or perfumes.',
                'Stay well-hydrated and follow any specific pre-treatment advice.'
            ];
            $after = [
                'Follow all specific post-treatment instructions provided by your practitioner.',
                'Keep the treated area clean and hydrated with recommended skincare products.',
                'Apply broad-spectrum sunscreen daily and avoid direct sun exposure.'
            ];
        }
        
        return ['prep' => $prep, 'after' => $after];
    }
}
?>

<main class="site-main" id="main-content">

<?php if ($is_enriched): ?>
    
    <!-- ═══════════════════════════════════════════════════════
         BREADCRUMBS & TOP BAR (Enriched Layout)
         ═══════════════════════════════════════════════════════ -->
    <nav class="breadcrumbs breadcrumbs--services reveal" aria-label="Breadcrumb"
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
         SECTION 1: AREAS TREATED (Acting as Page Hero)
         ═══════════════════════════════════════════════════════ -->
    <?php 
    $sec_a_display_title = !empty($sec_a_title) ? $sec_a_title : get_the_title();
    $sec_a_display_desc = !empty($sec_a_desc) ? $sec_a_desc : get_the_excerpt();
    $sec_a_img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : livia_get_service_image_url($sec_a_image_id, 'areas_treated', $post_slug);
    ?>
    <section class="service-section" aria-label="Areas Treated">
        <div class="service-section__inner">
            <div class="service-section__content reveal">
                <span class="service-section__label uppercase-brand">AREAS TREATED WITH <?php the_title(); ?></span>
                <h1 class="service-section__title serif-title"><?php echo esc_html($sec_a_display_title); ?></h1>
                
                <div class="service-section__desc">
                    <?php echo wp_kses_post($sec_a_display_desc); ?>
                </div>

                <?php if (!empty($sec_a_checklist_items)): ?>
                <ul class="service-checklist" role="list">
                    <?php foreach ($sec_a_checklist_items as $item): ?>
                    <li class="service-checklist__item">
                        <span class="service-checklist__check" aria-hidden="true">✓</span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($sec_a_img_url)): ?>
            <div class="service-section__image reveal">
                <img src="<?php echo esc_url($sec_a_img_url); ?>" alt="<?php the_title_attribute(); ?> areas treated">
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 2: HOW IT WORKS
         ═══════════════════════════════════════════════════════ -->
    <?php if (!empty($sec_b_desc)): 
        $sec_b_display_title = !empty($sec_b_title) ? $sec_b_title : 'How It Works';
        $sec_b_img_url = livia_get_service_image_url($sec_b_image_id, 'how_works', $post_slug);
    ?>
    <section class="service-section service-section--reverse" aria-label="How it works">
        <div class="service-section__inner">
            <div class="service-section__content reveal">
                <span class="service-section__label uppercase-brand">HOW <?php the_title(); ?> WORKS</span>
                <h2 class="service-section__title serif-title"><?php echo esc_html($sec_b_display_title); ?></h2>
                
                <div class="service-section__desc">
                    <?php echo wp_kses_post($sec_b_desc); ?>
                </div>
                
                <div class="service-section__actions">
                    <a href="#book-now" class="btn btn--primary btn--lg">Book Treatment</a>
                    <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
                </div>
            </div>
            
            <?php if (!empty($sec_b_img_url)): ?>
            <div class="service-section__image reveal">
                <img src="<?php echo esc_url($sec_b_img_url); ?>" alt="<?php the_title_attribute(); ?> mechanism of action">
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 3: WHAT TO EXPECT (Full-width Banner)
         ═══════════════════════════════════════════════════════ -->
    <?php if (!empty($sec_c_desc)): 
        $sec_c_display_title = !empty($sec_c_title) ? $sec_c_title : 'What to Expect';
        $sec_c_bg_url = livia_get_service_image_url($sec_c_bg_image_id, 'expect_bg', $post_slug);
    ?>
    <section class="service-expect-banner" <?php echo !empty($sec_c_bg_url) ? 'style="background-image: url('' . esc_url($sec_c_bg_url) . '');"' : ''; ?> aria-label="Expectations">
        <div class="service-expect-banner__overlay"></div>
        <div class="service-expect-banner__inner">
            <div class="service-expect-card reveal">
                <span class="service-expect-card__label uppercase-brand">Comfortable, In-Office Sessions</span>
                <h2 class="service-expect-card__title serif-title"><?php echo esc_html($sec_c_display_title); ?></h2>
                <div class="service-expect-card__desc">
                    <?php echo wp_kses_post($sec_c_desc); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 4: PREPARATION & AFTERCARE
         ═══════════════════════════════════════════════════════ -->
    <?php 
    $prep_items = $sec_d_prep_items;
    $after_items = $sec_d_after_items;
    if (empty($prep_items) && empty($after_items)) {
        $defaults = livia_get_default_prep_aftercare($post_slug);
        $prep_items = $defaults['prep'];
        $after_items = $defaults['after'];
    }
    if (!empty($prep_items) || !empty($after_items)):
    ?>
    <section class="service-prep-aftercare" aria-label="Preparation and Aftercare">
        <div class="service-prep-aftercare__inner">
            <div class="service-prep-aftercare__header reveal">
                <span class="service-prep-aftercare__label uppercase-brand">SUPPORTING SAFE AND EFFECTIVE TREATMENT</span>
                <h2 class="service-prep-aftercare__title serif-title">Preparation and Aftercare</h2>
            </div>
            
            <div class="service-prep-aftercare__grid reveal">
                <?php if (!empty($prep_items)): ?>
                <div class="service-prep-aftercare__col">
                    <h3 class="service-prep-aftercare__subtitle">Before treatment, patients are typically advised to:</h3>
                    <ul class="service-checklist" role="list">
                        <?php foreach ($prep_items as $item): ?>
                        <li class="service-checklist__item">
                            <span class="service-checklist__check" aria-hidden="true">✓</span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($after_items)): ?>
                <div class="service-prep-aftercare__col">
                    <h3 class="service-prep-aftercare__subtitle">After treatment, patients should:</h3>
                    <ul class="service-checklist" role="list">
                        <?php foreach ($after_items as $item): ?>
                        <li class="service-checklist__item">
                            <span class="service-checklist__check" aria-hidden="true">✓</span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 5: TREATMENT PLAN & RESULTS
         ═══════════════════════════════════════════════════════ -->
    <?php if (!empty($sec_e_desc)): 
        $sec_e_display_title = !empty($sec_e_title) ? $sec_e_title : 'Treatment Plan and Results';
        $sec_e_img_url = livia_get_service_image_url($sec_e_image_id, 'plan', $post_slug);
    ?>
    <section class="service-section service-section--reverse" aria-label="Treatment Plan">
        <div class="service-section__inner">
            <div class="service-section__content reveal">
                <span class="service-section__label uppercase-brand">TREATMENT PLAN AND RESULTS</span>
                <h2 class="service-section__title serif-title"><?php echo esc_html($sec_e_display_title); ?></h2>
                
                <div class="service-section__desc">
                    <?php echo wp_kses_post($sec_e_desc); ?>
                </div>
                
                <div class="service-section__provider-note">
                    <p>Treatments are performed by <strong>Angela Spicola, APRN</strong>; treatments are customized to your skin type, concerns, and goals, ensuring precise, safe, and effective care.</p>
                </div>
            </div>
            
            <?php if (!empty($sec_e_img_url)): ?>
            <div class="service-section__image reveal">
                <img src="<?php echo esc_url($sec_e_img_url); ?>" alt="<?php the_title_attribute(); ?> treatment plan results">
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 6: FAQS
         ═══════════════════════════════════════════════════════ -->
    <?php if (!empty($faqs)): ?>
    <section class="service-faqs" aria-label="Frequently Asked Questions">
        <div class="service-faqs__inner">
            <div class="service-faqs__header reveal">
                <h2 class="service-faqs__title serif-title">Frequently Asked Questions</h2>
            </div>
            
            <div class="faq-accordion reveal">
                <?php foreach ($faqs as $faq): ?>
                <div class="faq-accordion__item">
                    <button class="faq-accordion__header" aria-expanded="false">
                        <span class="faq-accordion__title"><?php echo esc_html($faq['q']); ?></span>
                        <span class="faq-accordion__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-accordion__content">
                        <div class="faq-accordion__content-inner">
                            <?php echo wp_kses_post($faq['a']); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         SECTION 7: LOCATION MAP BANNER
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

    <!-- ═══════════════════════════════════════════════════════
         SERVICE BODY: CONTENT + SIDEBAR
         ═══════════════════════════════════════════════════════ -->
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

    <!-- ═══════════════════════════════════════════════════════
         BENEFITS SECTION
         ═══════════════════════════════════════════════════════ -->
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

    <!-- ═══════════════════════════════════════════════════════
         VIDEO SECTION
         ═══════════════════════════════════════════════════════ -->
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

    <!-- ═══════════════════════════════════════════════════════
         WHY CHOOSE US (Static cards)
         ═══════════════════════════════════════════════════════ -->
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

<!-- ═══════════════════════════════════════════════════════
     COMMON BOTTOM SECTIONS: BOTTOM PHOTO, RELATED, CTA
     ═══════════════════════════════════════════════════════ -->

<!-- Standalone Bottom Lightbox (Only for classic layout bottom photos) -->
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

<!-- Related Treatments -->
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

<!-- CTA Section -->
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

<!-- Lightbox overlay & scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Lightbox logic
    const trigger = document.querySelector('.service-bottom-photo__lightbox-trigger');
    if (trigger) {
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
            if (e.target === overlay) closeLightbox();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && overlay.classList.contains('is-active')) closeLightbox();
        });
    }

    // 2. FAQ Accordion logic
    const faqHeaders = document.querySelectorAll('.faq-accordion__header');
    faqHeaders.forEach(button => {
        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
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

</main>

<?php get_footer(); ?>
