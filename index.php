<?php
/**
 * Livia Med Spa — Premium Header with Mega Menu
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tampa's elite aesthetics studio — expert Botox, fillers, and laser treatments tailored to enhance your natural beauty.">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══════════════════════════════════════════════════════════════
     HEADER
     ═══════════════════════════════════════════════════════════════ -->
<header class="site-header" id="site-header">
    <div class="site-header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="Home">
            <span class="site-logo__name">Livia</span>
            <span class="site-logo__tagline">MED SPA</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="site-header__nav" aria-label="Main navigation">
            <ul class="nav__links">
                <li class="nav__item nav__item--active">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link">Home</a>
                </li>

                <!-- Services with Mega Menu -->
                <li class="nav__item nav__item--has-mega">
                    <a href="#" class="nav__link">
                        Services <span class="nav__arrow">▾</span>
                    </a>

                    <div class="mega-menu">
                        <div class="mega-menu__inner">
                            <!-- Column 1: Face -->
                            <div class="mega-menu__column">
                                <span class="mega-menu__heading">Face</span>
                                <div class="mega-menu__items">
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(196,122,122,0.12);color:#c47a7a;">💉</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Botox & Dysport</span>
                                            <span class="mega-menu__item-desc">Smooth fine lines & wrinkles</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(201,169,110,0.12);color:#c9a96e;">✨</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Dermal Fillers</span>
                                            <span class="mega-menu__item-desc">Restore volume & contour</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(143,170,143,0.12);color:#8faa8f;">🧬</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">PRP Facial</span>
                                            <span class="mega-menu__item-desc">Rejuvenate with growth factors</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 2: Skin -->
                            <div class="mega-menu__column">
                                <span class="mega-menu__heading">Skin</span>
                                <div class="mega-menu__items">
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(160,142,196,0.12);color:#a08ec4;">🔬</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Microneedling</span>
                                            <span class="mega-menu__item-desc">Stimulate collagen production</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(201,169,110,0.12);color:#c9a96e;">🧴</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Chemical Peels</span>
                                            <span class="mega-menu__item-desc">Reveal fresh, radiant skin</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(111,163,214,0.12);color:#6fa3d6;">⚡</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Laser Treatments</span>
                                            <span class="mega-menu__item-desc">Advanced skin resurfacing</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 3: Body -->
                            <div class="mega-menu__column">
                                <span class="mega-menu__heading">Body & Hair</span>
                                <div class="mega-menu__items">
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(196,122,122,0.12);color:#c47a7a;">💆</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">CO2 Laser</span>
                                            <span class="mega-menu__item-desc">Deep skin rejuvenation</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(143,170,143,0.12);color:#8faa8f;">🌿</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">Hair Restoration</span>
                                            <span class="mega-menu__item-desc">PRP therapy for hair growth</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                    <a href="#" class="mega-menu__item">
                                        <span class="mega-menu__item-icon" style="background:rgba(160,142,196,0.12);color:#a08ec4;">💎</span>
                                        <span class="mega-menu__item-content">
                                            <span class="mega-menu__item-title">IV Therapy</span>
                                            <span class="mega-menu__item-desc">Wellness drips & vitamin boosts</span>
                                        </span>
                                        <span class="mega-menu__item-arrow">→</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Promo Panel -->
                            <div class="mega-menu__promo">
                                <div>
                                    <span class="mega-menu__promo-label">✦ New Client Special</span>
                                    <h3 class="mega-menu__promo-title">Your First Visit is 20% Off</h3>
                                    <p class="mega-menu__promo-text">Experience Tampa's most advanced aesthetic treatments with a personalized consultation.</p>
                                </div>
                                <a href="#book" class="mega-menu__promo-cta">Book Now →</a>
                            </div>
                        </div>

                        <!-- Bottom bar -->
                        <div class="mega-menu__bottom">
                            <div class="mega-menu__bottom-links">
                                <a href="#" class="mega-menu__bottom-link">📋 Treatment Guide</a>
                                <a href="#" class="mega-menu__bottom-link">💰 Pricing</a>
                                <a href="#" class="mega-menu__bottom-link">❓ FAQ</a>
                            </div>
                            <a href="#" class="mega-menu__bottom-cta">View All Services →</a>
                        </div>
                    </div>
                </li>

                <li class="nav__item">
                    <a href="#" class="nav__link">Before &amp; After</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link">About</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link">Blog</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- Actions -->
        <div class="site-header__actions">
            <a href="tel:8132302219" class="site-header__phone" aria-label="Call us">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </a>
            <a href="#book" class="btn btn--primary btn--sm nav__cta-desktop">Book Now</a>
        </div>

        <!-- Mobile Toggle -->
        <button class="nav__mobile-toggle" id="mobile-toggle" aria-label="Open menu">
            <span class="hamburger">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </span>
        </button>
    </div>
</header>

<!-- ═══════════════════════════════════════════════════════════════
     MOBILE MENU
     ═══════════════════════════════════════════════════════════════ -->
<div class="mobile-menu" id="mobile-menu">
    <div class="mobile-menu__overlay" id="mobile-overlay"></div>
    <div class="mobile-menu__drawer">
        <div class="mobile-menu__header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <span class="site-logo__name">Livia</span>
                <span class="site-logo__tagline">MED SPA</span>
            </a>
            <button class="mobile-menu__close" id="mobile-close" aria-label="Close menu">✕</button>
        </div>
        <nav class="mobile-menu__nav">
            <ul class="mobile-menu__links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Before & After</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="mobile-menu__footer">
            <a href="#book" class="btn btn--primary" style="width:100%;justify-content:center;">Book a Consultation</a>
            <a href="tel:8132302219" class="mobile-menu__contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                (813) 230-2219
            </a>
            <a href="mailto:support@liviamedspa.com" class="mobile-menu__contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                support@liviamedspa.com
            </a>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     MAIN CONTENT
     ═══════════════════════════════════════════════════════════════ -->
<main class="site-main">
    <div class="test-section">
        <div class="test-badge">
            <span class="test-badge__dot"></span>
            Step 1 Complete
        </div>
        <h1>Premium Header ✓</h1>
        <p>Hover over "Services" to see the mega menu. Try resizing to mobile to see the hamburger menu. Next: hero section with full-screen background.</p>
    </div>
</main>

<!-- ═══════════════════════════════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════════════════════════════ -->
<script>
// Header scroll effect
const header = document.getElementById('site-header');
window.addEventListener('scroll', () => {
    header.classList.toggle('is-scrolled', window.scrollY > 50);
});

// Mobile menu
const toggle = document.getElementById('mobile-toggle');
const menu = document.getElementById('mobile-menu');
const overlay = document.getElementById('mobile-overlay');
const closeBtn = document.getElementById('mobile-close');

function openMenu() {
    menu.classList.add('is-open');
    toggle.classList.add('is-active');
    document.body.style.overflow = 'hidden';
}
function closeMenu() {
    menu.classList.remove('is-open');
    toggle.classList.remove('is-active');
    document.body.style.overflow = '';
}

toggle.addEventListener('click', openMenu);
overlay.addEventListener('click', closeMenu);
closeBtn.addEventListener('click', closeMenu);
</script>

<?php wp_footer(); ?>
</body>
</html>
