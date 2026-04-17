<?php
/**
 * Livia Med Spa — Footer Template
 * Performance-optimized: deferred JS, passive listeners, requestIdleCallback
 */
?>

<!-- FOOTER -->
<footer class="site-footer" role="contentinfo">

<!-- CLIENT PORTAL (site-wide) -->
<section class="client-portal">
    <div class="section__inner">
        <div class="client-portal__layout">
            <!-- Phone mockup -->
            <div class="client-portal__phone reveal">
                <div class="client-portal__phone-wrapper">
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/02/Phone-mockup-1-scaled-e1770923706701-768x979.png"
                         alt="Livia Med Spa Client Portal on Phone"
                         class="client-portal__phone-img"
                         loading="lazy"
                         decoding="async"
                         width="300"
                         height="382">
                </div>
            </div>
            <!-- Content -->
            <div class="client-portal__content reveal">
                <span class="section__label">Client Portal</span>
                <h2 class="section__title">Click. Book. <em>Glow.</em></h2>
                <p class="client-portal__text">Access the Livia Med Spa Client Portal to easily manage your appointments, view your vouchers and memberships, and share referral links with friends. Enjoy a seamless, secure experience that puts all your spa benefits and perks right at your fingertips.</p>
                <div class="client-portal__features">
                    <div class="client-portal__feature">
                        <span class="client-portal__feature-check">✓</span>
                        <span>Book &amp; manage appointments 24/7</span>
                    </div>
                    <div class="client-portal__feature">
                        <span class="client-portal__feature-check">✓</span>
                        <span>View vouchers &amp; memberships</span>
                    </div>
                    <div class="client-portal__feature">
                        <span class="client-portal__feature-check">✓</span>
                        <span>Share referral links &amp; earn rewards</span>
                    </div>
                    <div class="client-portal__feature">
                        <span class="client-portal__feature-check">✓</span>
                        <span>Secure, HIPAA-compliant access</span>
                    </div>
                </div>
                <a href="https://blvd.app/@liviamedspa/login" class="btn btn--primary btn--lg" target="_blank" rel="noopener noreferrer">Client Portal →</a>
            </div>
        </div>
    </div>
</section>

<!-- Floating Mobile CTA -->
<div class="floating-cta" id="floating-cta" aria-label="Quick actions">
    <a href="#book-now" class="floating-cta__btn floating-cta__btn--book">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
        Book Now
    </a>
    <a href="tel:8132302219" class="floating-cta__btn floating-cta__btn--call">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call
    </a>
</div>
    <div class="footer__top">
        <div class="footer__inner">
            <!-- Brand Column -->
            <div class="footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo" aria-label="Livia Med Spa — Home">
                    <img src="https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png" alt="Livia Med Spa" width="160" height="auto" loading="lazy" decoding="async">
                </a>
                <p class="footer__brand-text">Tampa's premier destination for advanced aesthetics. We combine artistry with science to enhance your natural beauty.</p>
                <div class="footer__social">
                    <a href="https://www.instagram.com/liviamedspa/" class="footer__social-link" aria-label="Follow us on Instagram" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="https://www.facebook.com/p/Livia-Med-Spa-61561610168278/" class="footer__social-link" aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer__col">
                <h4 class="footer__heading">Quick Links</h4>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url(home_url('/products/')); ?>">Products</a></li>
                    <li><a href="<?php echo esc_url(home_url('/before-after/')); ?>">Before &amp; After</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/team/')); ?>">Meet the Team</a></li>
                    <li><a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a></li>
                    <li><a href="<?php echo esc_url(home_url('/parties/')); ?>">Parties</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Top Services -->
            <div class="footer__col">
                <h4 class="footer__heading">Popular Treatments</h4>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url(home_url('/services/botox/')); ?>">Botox &amp; Dysport</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/dermal-fillers/')); ?>">Dermal Fillers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/microneedling/')); ?>">Microneedling</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/chemical-peels/')); ?>">Chemical Peels</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/laser-treatments/')); ?>">Laser Treatments</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/weight-loss/')); ?>">Weight Loss</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer__col">
                <h4 class="footer__heading">Visit Us</h4>
                <div class="footer__contact">
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>10043 N Dale Mabry Hwy, Tampa, FL 33618</span>
                    </div>
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:8132302219">(813) 230-2219</a>
                    </div>
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Mon–Wed: 9am–7pm &nbsp;|&nbsp; Thu–Sat: 9am–4pm</span>
                    </div>
                </div>
                <a href="#book-now" class="btn btn--primary btn--sm" style="margin-top:1.25rem;">Book Consultation</a>
            </div>
        </div>
    </div>

    <!-- Newsletter bar -->
    <div class="footer__newsletter">
        <div class="footer__inner">
            <div class="newsletter">
                <div class="newsletter__text">
                    <h4 class="newsletter__title">Stay in the Glow ✨</h4>
                    <p class="newsletter__desc">Get exclusive offers, beauty tips, and early access to new treatments.</p>
                </div>
                <form class="newsletter__form" action="#" method="post" id="newsletter-form">
                    <div class="newsletter__input-group">
                        <input type="email" name="newsletter_email" class="newsletter__input" placeholder="Enter your email" required aria-label="Email address">
                        <button type="submit" class="newsletter__btn btn btn--primary">Subscribe</button>
                    </div>
                    <p class="newsletter__privacy">We respect your privacy. Unsubscribe anytime.</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer__bottom">
        <div class="footer__inner">
            <p class="footer__copyright">© <?php echo date('Y'); ?> Livia Med Spa. All rights reserved.</p>
            <div class="footer__legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/cancellation-policy/')); ?>">Cancellation Policy</a>
                <a href="<?php echo esc_url(home_url('/refund-policy/')); ?>">Refund Policy</a>
                <a href="<?php echo esc_url(home_url('/beauty-bank/')); ?>">Beauty Bank</a>
            </div>
        </div>
    </div>
</footer>


<!-- Scroll to Top -->
<button class="scroll-top" id="scroll-top" aria-label="Back to top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m18 15-6-6-6 6"/></svg>
</button>

<!-- ════════════════════════════════════════════════════════════════════
     OPTIMIZED SCRIPTS — tiered idle loading to eliminate long main-thread tasks
     ════════════════════════════════════════════════════════════════════ -->
<script>
(function() {
    'use strict';

    // Polyfill requestIdleCallback for Safari
    var rIC = window.requestIdleCallback || function(cb) { return setTimeout(cb, 1); };

    // ── Cache DOM lookups once (used across tiers) ────────────────
    var header      = document.getElementById('site-header');
    var toggle      = document.getElementById('mobile-toggle');
    var mobileMenu  = document.getElementById('mobile-menu');
    var mobileOver  = document.getElementById('mobile-overlay');
    var mobileClose = document.getElementById('mobile-close');
    var scrollBtn   = document.getElementById('scroll-top');
    var lastScrollY = 0;
    var ticking     = false;

    // ══════════════════════════════════════════════════════════════
    // TIER 0 — CRITICAL: runs synchronously, must be instant
    // ══════════════════════════════════════════════════════════════

    // Mark page as loaded (removes FOUC guard)
    document.body.classList.add('is-loaded');

    // Header scroll — rAF-throttled for 60fps
    function onScroll() {
        lastScrollY = window.scrollY;
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    }
    function updateOnScroll() {
        header.classList.toggle('is-scrolled', lastScrollY > 50);
        if (scrollBtn) scrollBtn.classList.toggle('is-visible', lastScrollY > 600);
        ticking = false;
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    header.style.top = '0px';

    // Mobile menu
    function openMenu() {
        mobileMenu.classList.add('is-open');
        mobileMenu.setAttribute('aria-hidden', 'false');
        toggle.classList.add('is-active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        if (mobileClose) mobileClose.focus();
    }
    function closeMenu() {
        mobileMenu.classList.remove('is-open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        toggle.focus();
    }
    if (toggle) toggle.addEventListener('click', openMenu);
    if (mobileOver) mobileOver.addEventListener('click', closeMenu);
    if (mobileClose) mobileClose.addEventListener('click', closeMenu);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) closeMenu();
    });

    // Scroll-to-top button
    if (scrollBtn) {
        scrollBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ══════════════════════════════════════════════════════════════
    // TIER 1 — INTERACTIVE: runs on first idle moment after paint
    // ══════════════════════════════════════════════════════════════
    rIC(function() {

        // ── Page exit transition ──────────────────────────────────
        document.querySelectorAll('a[href]').forEach(function(link) {
            var href = link.getAttribute('href');
            if (href && href.charAt(0) !== '#' && !href.startsWith('tel:') && !href.startsWith('mailto:') &&
                !link.hasAttribute('target') && href.indexOf(window.location.hostname) !== -1 || (href && href.charAt(0) === '/')) {
                link.addEventListener('click', function(e) {
                    if (e.ctrlKey || e.metaKey || e.shiftKey) return;
                    e.preventDefault();
                    document.body.classList.add('is-leaving');
                    setTimeout(function() { window.location.href = href; }, 250);
                });
            }
        });

        // ── Lazy image fade-in ────────────────────────────────────
        document.querySelectorAll('img[loading="lazy"]').forEach(function(img) {
            if (img.complete) { img.classList.add('is-loaded'); }
            else { img.addEventListener('load', function() { this.classList.add('is-loaded'); }); }
        });

        // ── Scroll Reveal ─────────────────────────────────────────
        var revealObserver = new IntersectionObserver(function(entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) {
                    entries[i].target.classList.add('is-visible');
                    revealObserver.unobserve(entries[i].target);
                }
            }
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(function(el) { revealObserver.observe(el); });

        // ── Services Carousel ─────────────────────────────────────
        var carousel = document.getElementById('services-carousel');
        if (carousel) {
            var track  = carousel.querySelector('.carousel__track');
            var slides = carousel.querySelectorAll('.carousel__slide');
            var dotsC  = document.getElementById('carousel-dots');
            var prevB  = carousel.querySelector('.carousel__arrow--prev');
            var nextB  = carousel.querySelector('.carousel__arrow--next');
            var total  = slides.length;
            if (total > 0) {
                var current = 0, autoT, prevPos = {};
                for (var d = 0; d < total; d++) {
                    var dot = document.createElement('button');
                    dot.className = 'carousel__dot' + (d === 0 ? ' is-active' : '');
                    dot.setAttribute('role', 'tab');
                    dot.setAttribute('aria-selected', d === 0 ? 'true' : 'false');
                    dot.setAttribute('aria-label', 'Go to slide ' + (d + 1));
                    (function(idx) { dot.addEventListener('click', function() { goTo(idx); }); })(d);
                    dotsC.appendChild(dot);
                }
                function mod(n, m) { return ((n % m) + m) % m; }
                function getPos(i) {
                    var diff = mod(i - current, total);
                    if (diff === 0) return 0; if (diff === 1) return 1; if (diff === total - 1) return -1;
                    if (diff === 2) return 2; if (diff === total - 2) return -2; return 99;
                }
                function updateSlides() {
                    for (var i = 0; i < total; i++) {
                        var sl = slides[i], np = getPos(i), op = prevPos[i] !== undefined ? prevPos[i] : np;
                        var wrapping = Math.abs(np - op) > 3;
                        if (wrapping) { sl.style.transition = 'none'; sl.style.opacity = '0'; }
                        sl.classList.remove('is-active','is-prev','is-next','is-far-prev','is-far-next');
                        if (np === 0) sl.classList.add('is-active');
                        else if (np === 1) sl.classList.add('is-next');
                        else if (np === -1) sl.classList.add('is-prev');
                        else if (np === 2) sl.classList.add('is-far-next');
                        else if (np === -2) sl.classList.add('is-far-prev');
                        else sl.style.opacity = '0';
                        if (wrapping) {
                            (function(s) {
                                requestAnimationFrame(function() { requestAnimationFrame(function() { s.style.transition = ''; s.style.opacity = ''; }); });
                            })(sl);
                        } else { sl.style.opacity = ''; }
                        prevPos[i] = np;
                    }
                    var dots = dotsC.querySelectorAll('.carousel__dot');
                    for (var j = 0; j < dots.length; j++) {
                        var isActive = j === current;
                        dots[j].classList.toggle('is-active', isActive);
                        dots[j].setAttribute('aria-selected', isActive ? 'true' : 'false');
                    }
                }
                function goTo(idx) { current = mod(idx, total); updateSlides(); }
                function next() { goTo(current + 1); }
                function prev() { goTo(current - 1); }
                prevB.addEventListener('click', prev);
                nextB.addEventListener('click', next);
                var touchX = 0;
                track.addEventListener('touchstart', function(e) { touchX = e.touches[0].clientX; }, { passive: true });
                track.addEventListener('touchend', function(e) { var diff = touchX - e.changedTouches[0].clientX; if (Math.abs(diff) > 50) diff > 0 ? next() : prev(); });
                carousel.addEventListener('keydown', function(e) { if (e.key === 'ArrowLeft') prev(); if (e.key === 'ArrowRight') next(); });
                function resetAuto() { clearInterval(autoT); autoT = setInterval(next, 5000); }
                carousel.addEventListener('mouseenter', function() { clearInterval(autoT); });
                carousel.addEventListener('mouseleave', resetAuto);
                document.addEventListener('visibilitychange', function() { document.hidden ? clearInterval(autoT) : resetAuto(); });
                goTo(0); resetAuto();
            }
        }

        // ── Smooth anchor scroll + #book-now fallback ─────────────
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var targetId = this.getAttribute('href');
                if (targetId === '#') return;
                var target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    var headerHeight = header ? header.offsetHeight : 0;
                    var y = target.getBoundingClientRect().top + window.scrollY - headerHeight - 20;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                } else if (targetId === '#book-now') {
                    e.preventDefault();
                    window.location.href = '<?php echo esc_url(home_url("/contact/")); ?>';
                }
            });
        });

        // ── Active nav link ───────────────────────────────────────
        var path = window.location.pathname;
        document.querySelectorAll('.nav__link').forEach(function(link) {
            var href = link.getAttribute('href');
            if (href && href !== '/' && path.indexOf(href.replace(/\/$/, '').split('/').pop()) !== -1) {
                link.classList.add('is-active');
            }
        });

        // ── Smooth scroll behaviour ───────────────────────────────
        document.documentElement.style.scrollBehavior = 'smooth';

        // ── Forms: contact + newsletter + phone format ────────────
        var newsletterForm = document.getElementById('newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var input = this.querySelector('.newsletter__input');
                var btn   = this.querySelector('.newsletter__btn');
                if (input && input.value) {
                    btn.textContent = '✓ Subscribed!'; btn.style.background = '#2d6a4f';
                    input.value = ''; input.disabled = true;
                    setTimeout(function() { btn.textContent = 'Subscribe'; btn.style.background = ''; input.disabled = false; }, 3000);
                }
            });
        }

        var contactForm = document.getElementById('contact-form');
        var formSuccess = document.getElementById('form-success');
        if (contactForm && formSuccess) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = contactForm.querySelector('.contact-form__submit');
                var originalText = btn ? btn.innerHTML : '';
                if (btn) { btn.innerHTML = 'Sending…'; btn.disabled = true; }
                var data = new FormData(contactForm);
                data.set('action', 'livia_contact_submit');
                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', { method: 'POST', body: data, credentials: 'same-origin' })
                    .then(function(r) { return r.json(); })
                    .then(function(res) {
                        if (res.success) { contactForm.style.display = 'none'; formSuccess.classList.add('is-visible'); formSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
                        else { if (btn) { btn.innerHTML = originalText; btn.disabled = false; } alert((res.data && res.data.message) ? res.data.message : 'Something went wrong. Please try again.'); }
                    })
                    .catch(function() { if (btn) { btn.innerHTML = originalText; btn.disabled = false; } alert('Connection error. Please call us at (813) 230-2219.'); });
            });
        }

        var phoneInput = document.getElementById('cf-phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                var digits = this.value.replace(/\D/g, '');
                if (digits.length <= 3) this.value = digits.length ? '(' + digits : '';
                else if (digits.length <= 6) this.value = '(' + digits.slice(0,3) + ') ' + digits.slice(3);
                else this.value = '(' + digits.slice(0,3) + ') ' + digits.slice(3,6) + '-' + digits.slice(6,10);
            });
        }

        // ── Reading progress bar ──────────────────────────────────
        var progressBar  = document.getElementById('reading-progress-bar');
        var postContent  = document.querySelector('.post-content');
        if (progressBar && postContent) {
            window.addEventListener('scroll', function() {
                var rect = postContent.getBoundingClientRect();
                var pct  = Math.min(Math.max(-rect.top / (rect.height - window.innerHeight) * 100, 0), 100);
                progressBar.style.width = pct + '%';
            }, { passive: true });
        }

        // ── Hide scroll indicator ─────────────────────────────────
        var scrollIndicator = document.querySelector('.hero__scroll-indicator');
        if (scrollIndicator) {
            var scrollHidden = false;
            window.addEventListener('scroll', function() {
                if (!scrollHidden && window.scrollY > 100) {
                    scrollIndicator.style.opacity = '0';
                    scrollIndicator.style.transition = 'opacity 0.5s ease';
                    scrollHidden = true;
                }
            }, { passive: true });
        }

        // ── Hide floating CTA near footer ─────────────────────────
        var floatingCta = document.getElementById('floating-cta');
        var siteFooter  = document.querySelector('.site-footer');
        if (floatingCta && siteFooter) {
            new IntersectionObserver(function(entries) {
                floatingCta.style.opacity       = entries[0].isIntersecting ? '0' : '';
                floatingCta.style.pointerEvents = entries[0].isIntersecting ? 'none' : '';
            }, { threshold: 0.1 }).observe(siteFooter);
        }

    }); // end tier 1

    // ══════════════════════════════════════════════════════════════
    // TIER 2 — NON-CRITICAL: deferred 200ms into idle time
    //          (social proof, counters, gallery, AI preview, cookies)
    // ══════════════════════════════════════════════════════════════
    setTimeout(function() { rIC(function() {

        // ── Cookie Consent Banner (injected dynamically — never in HTML to avoid LCP penalty) ──
        if (!localStorage.getItem('livia-cookie-consent')) {
            setTimeout(function() {
                var banner = document.createElement('div');
                banner.id = 'cookie-banner';
                banner.className = 'cookie-banner';
                banner.setAttribute('role', 'dialog');
                banner.setAttribute('aria-label', 'Cookie consent');
                banner.innerHTML =
                    '<div class="cookie-banner__inner">' +
                        '<p class="cookie-banner__text"><strong>\uD83C\uDF6A Cookies</strong> \u2014 We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>' +
                        '<div class="cookie-banner__actions">' +
                            '<button class="cookie-banner__btn cookie-banner__btn--accept" id="cookie-accept">Accept</button>' +
                            '<button class="cookie-banner__btn cookie-banner__btn--decline" id="cookie-decline">Decline</button>' +
                        '</div>' +
                    '</div>';
                document.body.appendChild(banner);
                requestAnimationFrame(function() { banner.classList.add('is-visible'); });

                document.getElementById('cookie-accept').addEventListener('click', function() {
                    localStorage.setItem('livia-cookie-consent', 'accepted');
                    banner.classList.remove('is-visible');
                    setTimeout(function() { banner.remove(); }, 400);
                });
                document.getElementById('cookie-decline').addEventListener('click', function() {
                    localStorage.setItem('livia-cookie-consent', 'declined');
                    banner.classList.remove('is-visible');
                    setTimeout(function() { banner.remove(); }, 400);
                });
            }, 5000);
        }


        // ── Stats bar counter (About page) ────────────────────────
        var statsBar = document.querySelector('.stats-bar');
        if (statsBar) {
            new IntersectionObserver(function(entries) {
                if (!entries[0].isIntersecting) return;
                entries[0].target.querySelectorAll('.stats-bar__number').forEach(function(el) {
                    var match = el.textContent.trim().match(/^([\d,]+)(\+?)$/);
                    if (!match) return;
                    var target = parseInt(match[1].replace(/,/g,''), 10), suffix = match[2] || '';
                    var startTime = performance.now();
                    (function tick(now) {
                        var p = Math.min((now - startTime) / 2000, 1);
                        el.textContent = Math.round((1 - Math.pow(1 - p, 3)) * target).toLocaleString() + suffix;
                        if (p < 1) requestAnimationFrame(tick);
                    })(startTime);
                });
                statsBarObserver.unobserve(entries[0].target);
            }, { threshold: 0.3 }).observe(statsBar);
        }

        // ── Gallery Filters (Before & After) ─────────────────────
        var filterBtns   = document.querySelectorAll('.gallery-filter');
        var galleryCards = document.querySelectorAll('.gallery-card');
        if (filterBtns.length && galleryCards.length) {
            filterBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var filter = this.getAttribute('data-filter');
                    filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
                    this.classList.add('is-active');
                    galleryCards.forEach(function(card) {
                        if (filter === 'all' || card.getAttribute('data-category') === filter) {
                            card.style.display = ''; card.style.opacity = '0'; card.style.transform = 'translateY(12px)';
                            requestAnimationFrame(function() { card.style.transition = 'opacity 0.4s ease, transform 0.4s ease'; card.style.opacity = '1'; card.style.transform = 'translateY(0)'; });
                        } else {
                            card.style.opacity = '0'; card.style.transform = 'translateY(12px)';
                            setTimeout(function() { card.style.display = 'none'; }, 300);
                        }
                    });
                });
            });
        }

        // ── Social Proof Notification ─────────────────────────────
        if (window.innerWidth > 768) {
            var proofNames    = ['Sarah M.','Jessica L.','Emily R.','Amanda K.','Lauren B.','Michelle T.'];
            var proofServices = ['Botox','Dermal Fillers','Chemical Peel','Microneedling','IV Therapy','Laser Treatment'];
            var proofTimes    = ['2 minutes','5 minutes','12 minutes','23 minutes','1 hour'];
            function showSocialProof() {
                var existing = document.getElementById('social-proof');
                if (existing) existing.remove();
                var name    = proofNames[Math.floor(Math.random() * proofNames.length)];
                var service = proofServices[Math.floor(Math.random() * proofServices.length)];
                var time    = proofTimes[Math.floor(Math.random() * proofTimes.length)];
                var el = document.createElement('div');
                el.id = 'social-proof'; el.className = 'social-proof';
                el.innerHTML = '<div class="social-proof__icon">✨</div><div class="social-proof__content"><strong>' + name + '</strong> just booked a <strong>' + service + '</strong><span class="social-proof__time">' + time + ' ago</span></div>';
                document.body.appendChild(el);
                requestAnimationFrame(function() { el.classList.add('is-visible'); });
                setTimeout(function() { el.classList.remove('is-visible'); setTimeout(function() { el.remove(); }, 400); }, 5000);
            }
            setTimeout(showSocialProof, 8000);
            setInterval(showSocialProof, 30000);
        }

        // ── AI Preview — Before/After Carousel + Scan Engine ──────
        var aiTrack = document.getElementById('aiTrack');
        if (aiTrack) {
            var aiDots   = document.querySelectorAll('.ai-preview__dot');
            var aiSlides = document.querySelectorAll('.ai-preview__slide');
            var aiTotal  = aiSlides.length, aiCurrent = 0;
            var scanFrame, scanStartTimer;
            var SWEEP_MIN = 0, SWEEP_MAX = 100, SPEED_EDGE = 1.1, SPEED_MID = 0.18;
            var scanPct = SWEEP_MIN, scanDir = 1;

            function aiGoTo(idx) {
                aiCurrent = ((idx % aiTotal) + aiTotal) % aiTotal;
                aiTrack.style.transform = 'translateX(-' + (aiCurrent * 100) + '%)';
                aiDots.forEach(function(d, i) { d.classList.toggle('is-active', i === aiCurrent); });
                var parts = getAIParts(); applyAIPos(SWEEP_MIN, parts.after, parts.line);
                cancelAnimationFrame(scanFrame); clearTimeout(scanStartTimer);
                scanStartTimer = setTimeout(restartAIScan, 680);
            }
            aiDots.forEach(function(dot) { dot.addEventListener('click', function() { aiGoTo(parseInt(this.dataset.index)); }); });
            function getAIParts() {
                var slide = aiSlides[aiCurrent];
                return { after: slide.querySelector('.ai-preview__img--after'), line: slide.querySelector('.ai-preview__divider') };
            }
            function applyAIPos(pct, afterImg, line) { afterImg.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)'; line.style.left = pct + '%'; }
            function calcAISpeed(pct) {
                var mid = (SWEEP_MIN + SWEEP_MAX) / 2, half = (SWEEP_MAX - SWEEP_MIN) / 2;
                return SPEED_MID + (SPEED_EDGE - SPEED_MID) * Math.pow(Math.abs(pct - mid) / half, 0.6);
            }
            function scanTick() {
                var parts = getAIParts(); scanPct += scanDir * calcAISpeed(scanPct);
                if (scanPct >= SWEEP_MAX) { scanPct = SWEEP_MAX; applyAIPos(scanPct, parts.after, parts.line); cancelAnimationFrame(scanFrame); setTimeout(function() { aiGoTo(aiCurrent + 1); }, 600); return; }
                applyAIPos(scanPct, parts.after, parts.line); scanFrame = requestAnimationFrame(scanTick);
            }
            function restartAIScan() { cancelAnimationFrame(scanFrame); scanPct = SWEEP_MIN; scanDir = 1; var parts = getAIParts(); applyAIPos(SWEEP_MIN, parts.after, parts.line); scanFrame = requestAnimationFrame(scanTick); }

            aiSlides.forEach(function(slide) {
                var wrap = slide.querySelector('.ai-preview__slider'), after = slide.querySelector('.ai-preview__img--after'), line = slide.querySelector('.ai-preview__divider'), dragging = false;
                function dragTo(x) { var rect = wrap.getBoundingClientRect(); applyAIPos(Math.min(100, Math.max(0, ((x - rect.left) / rect.width) * 100)), after, line); }
                wrap.addEventListener('mousedown', function(e) { dragging = true; cancelAnimationFrame(scanFrame); dragTo(e.clientX); });
                window.addEventListener('mousemove', function(e) { if (dragging) dragTo(e.clientX); });
                window.addEventListener('mouseup', function() { dragging = false; });
                wrap.addEventListener('touchstart', function(e) { dragging = true; cancelAnimationFrame(scanFrame); dragTo(e.touches[0].clientX); }, { passive: true });
                window.addEventListener('touchmove', function(e) { if (dragging) dragTo(e.touches[0].clientX); }, { passive: true });
                window.addEventListener('touchend', function() { dragging = false; });
            });

            var aiSection = document.getElementById('ai-preview');
            if (aiSection) {
                new IntersectionObserver(function(entries) {
                    if (entries[0].isIntersecting) { restartAIScan(); this.unobserve(aiSection); }
                }, { threshold: 0.2 }).observe(aiSection);
            }
        }

    }); }, 200); // end tier 2

})();
</script>


<?php wp_footer(); ?>

<!-- Boulevard Self-Booking Overlay -->
<script>
(function (a) {
    var b = {
        businessId: '9563faa5-e2e5-4a6a-b5f5-0636ea78b80e',
    };
    var c = a.createElement('script');
    var d = a.querySelector('script');
    c.src = 'https://static.joinboulevard.com/injector.min.js';
    c.async = true;
    c.onload = function () {
        blvd.init(b);
    };
    d.parentNode.insertBefore(c, d);
})(document);

// Intercept all booking links and open Boulevard overlay instead
document.addEventListener('click', function(e) {
    var link = e.target.closest('a');
    if (!link) return;

    var href = link.getAttribute('href') || '';
    var text = (link.textContent || '').trim().toLowerCase();

    // Match booking-related links
    var isBookingLink = (
        href.indexOf('/contact/') !== -1 &&
        (text.indexOf('book') !== -1 || text.indexOf('consultation') !== -1 || text.indexOf('schedule') !== -1)
    );

    // Also catch links with #book hash
    if (href.indexOf('#book') !== -1) isBookingLink = true;

    if (isBookingLink && typeof blvd !== 'undefined' && blvd.openBookingWidget) {
        e.preventDefault();
        blvd.openBookingWidget();
    }
});
</script>

</body>
</html>
