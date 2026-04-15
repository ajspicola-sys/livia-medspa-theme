<?php
/**
 * Livia Med Spa — Footer Template
 * Performance-optimized: deferred JS, passive listeners, requestIdleCallback
 */
?>

<!-- CLIENT PORTAL (site-wide) -->
<section class="client-portal">
    <div class="client-portal__bg-glow"></div>
    <div class="section__inner">
        <div class="client-portal__layout">
            <!-- Phone mockup -->
            <div class="client-portal__phone reveal">
                <div class="client-portal__phone-wrapper">
                    <div class="client-portal__phone-glow"></div>
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
                <span class="section__label" style="color: rgba(201,169,110,0.8);">Client Portal</span>
                <h2 class="section__title" style="color: #faf8f5;">Click. Book. <em>Glow.</em></h2>
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
                <a href="#" class="btn btn--primary btn--lg">Client Portal →</a>
            </div>
        </div>
    </div>
</section>

<!-- Floating Mobile CTA -->
<div class="floating-cta" id="floating-cta" aria-label="Quick actions">
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="floating-cta__btn floating-cta__btn--book">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
        Book Now
    </a>
    <a href="tel:8132302219" class="floating-cta__btn floating-cta__btn--call">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call
    </a>
</div>

<!-- FOOTER -->
<footer class="site-footer" role="contentinfo">
    <div class="footer__top">
        <div class="footer__inner">
            <!-- Brand Column -->
            <div class="footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <span class="site-logo__name">Livia</span>
                    <span class="site-logo__tagline">MED SPA</span>
                </a>
                <p class="footer__brand-text">Tampa's premier destination for advanced aesthetics. We combine artistry with science to enhance your natural beauty.</p>
                <div class="footer__social">
                    <a href="#" class="footer__social-link" aria-label="Follow us on Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Follow us on Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Follow us on TikTok">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
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
                        <span>Tampa, FL 33606</span>
                    </div>
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:8132302219">(813) 230-2219</a>
                    </div>
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Mon–Sat: 9am – 6pm</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--sm" style="margin-top:1.25rem;">Book Consultation</a>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer__bottom">
        <div class="footer__inner">
            <p class="footer__copyright">© <?php echo date('Y'); ?> Livia Med Spa. All rights reserved.</p>
            <div class="footer__legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top -->
<button class="scroll-top" id="scroll-top" aria-label="Back to top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m18 15-6-6-6 6"/></svg>
</button>

<!-- ════════════════════════════════════════════════════════════════════
     OPTIMIZED SCRIPTS — deferred, passive listeners, GPU compositing
     ════════════════════════════════════════════════════════════════════ -->
<script>
(function() {
    'use strict';

    // ── Cache DOM lookups once ────────────────────────────────────
    var header      = document.getElementById('site-header');
    var toggle      = document.getElementById('mobile-toggle');
    var mobileMenu  = document.getElementById('mobile-menu');
    var mobileOver  = document.getElementById('mobile-overlay');
    var mobileClose = document.getElementById('mobile-close');
    var scrollBtn   = document.getElementById('scroll-top');
    var lastScrollY = 0;
    var ticking     = false;

    // ── Page load animation ─────────────────────────────────────
    document.body.classList.add('is-loaded');

    // Smooth page exit transition
    document.querySelectorAll('a[href]').forEach(function(link) {
        var href = link.getAttribute('href');
        // Only apply to internal links, not anchors, tel:, mailto:, or new tab links
        if (href && href.charAt(0) !== '#' && !href.startsWith('tel:') && !href.startsWith('mailto:') &&
            !link.hasAttribute('target') && href.indexOf(window.location.hostname) !== -1 || (href.charAt(0) === '/')) {
            link.addEventListener('click', function(e) {
                if (e.ctrlKey || e.metaKey || e.shiftKey) return; // Allow cmd/ctrl+click
                e.preventDefault();
                document.body.classList.add('is-leaving');
                setTimeout(function() { window.location.href = href; }, 250);
            });
        }
    });

    // ── Set initial positions ────────────────────────────────────
    function setPositions() {
        // Ensure header stays at top (admin bar is hidden via CSS)
        header.style.top = '0px';
    }

    // ── Header scroll — uses rAF throttle for 60fps ──────────────
    function onScroll() {
        lastScrollY = window.scrollY;
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    }

    function updateOnScroll() {
        var y = lastScrollY;
        header.classList.toggle('is-scrolled', y > 50);

        if (scrollBtn) {
            scrollBtn.classList.toggle('is-visible', y > 600);
        }
        ticking = false;
    }

    // Initial setup
    setPositions();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', setPositions, { passive: true });

    // ── Mobile menu ──────────────────────────────────────────────
    function openMenu() {
        mobileMenu.classList.add('is-open');
        mobileMenu.setAttribute('aria-hidden', 'false');
        toggle.classList.add('is-active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        // Trap focus: focus the close button
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

    // Close mobile menu on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
            closeMenu();
        }
    });

    // ── Scroll Reveal — using IntersectionObserver with rootMargin for early trigger ──
    var revealObserver = new IntersectionObserver(function(entries) {
        for (var i = 0; i < entries.length; i++) {
            if (entries[i].isIntersecting) {
                entries[i].target.classList.add('is-visible');
                revealObserver.unobserve(entries[i].target);
            }
        }
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    var revealEls = document.querySelectorAll('.reveal');
    for (var r = 0; r < revealEls.length; r++) {
        revealObserver.observe(revealEls[r]);
    }

    // ── Services Carousel (Infinite) ─────────────────────────────
    var carousel = document.getElementById('services-carousel');
    if (carousel) {
        var track = carousel.querySelector('.carousel__track');
        var slides = carousel.querySelectorAll('.carousel__slide');
        var dotsC = document.getElementById('carousel-dots');
        var prevB = carousel.querySelector('.carousel__arrow--prev');
        var nextB = carousel.querySelector('.carousel__arrow--next');
        var total = slides.length;

        if (total > 0) {
            var current = 0;
            var autoT;
            var prevPos = {};

            // Create dots
            for (var d = 0; d < total; d++) {
                var dot = document.createElement('button');
                dot.className = 'carousel__dot' + (d === 0 ? ' is-active' : '');
                dot.setAttribute('aria-label', 'Go to slide ' + (d + 1));
                (function(idx) { dot.addEventListener('click', function() { goTo(idx); }); })(d);
                dotsC.appendChild(dot);
            }

            function mod(n, m) { return ((n % m) + m) % m; }

            function getPos(i) {
                var diff = mod(i - current, total);
                if (diff === 0) return 0;
                if (diff === 1) return 1;
                if (diff === total - 1) return -1;
                if (diff === 2) return 2;
                if (diff === total - 2) return -2;
                return 99;
            }

            function updateSlides() {
                for (var i = 0; i < total; i++) {
                    var sl = slides[i];
                    var np = getPos(i);
                    var op = prevPos[i] !== undefined ? prevPos[i] : np;
                    var wrapping = Math.abs(np - op) > 3;

                    if (wrapping) {
                        sl.style.transition = 'none';
                        sl.style.opacity = '0';
                    }

                    sl.classList.remove('is-active', 'is-prev', 'is-next', 'is-far-prev', 'is-far-next');
                    if (np === 0) sl.classList.add('is-active');
                    else if (np === 1) sl.classList.add('is-next');
                    else if (np === -1) sl.classList.add('is-prev');
                    else if (np === 2) sl.classList.add('is-far-next');
                    else if (np === -2) sl.classList.add('is-far-prev');
                    else sl.style.opacity = '0';

                    if (wrapping) {
                        (function(s) {
                            requestAnimationFrame(function() {
                                requestAnimationFrame(function() {
                                    s.style.transition = '';
                                    s.style.opacity = '';
                                });
                            });
                        })(sl);
                    } else {
                        sl.style.opacity = '';
                    }
                    prevPos[i] = np;
                }

                var dots = dotsC.querySelectorAll('.carousel__dot');
                for (var j = 0; j < dots.length; j++) {
                    dots[j].classList.toggle('is-active', j === current);
                }
            }

            function goTo(idx) { current = mod(idx, total); updateSlides(); }
            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            prevB.addEventListener('click', prev);
            nextB.addEventListener('click', next);

            // Touch / swipe — passive for performance
            var touchX = 0;
            track.addEventListener('touchstart', function(e) { touchX = e.touches[0].clientX; }, { passive: true });
            track.addEventListener('touchend', function(e) {
                var diff = touchX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) diff > 0 ? next() : prev();
            });

            // Keyboard navigation for carousel
            carousel.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') prev();
                if (e.key === 'ArrowRight') next();
            });

            // Autoplay — 5s (better for UX than 4s)
            function resetAuto() {
                clearInterval(autoT);
                autoT = setInterval(next, 5000);
            }
            carousel.addEventListener('mouseenter', function() { clearInterval(autoT); });
            carousel.addEventListener('mouseleave', resetAuto);

            // Pause autoplay when tab is not visible (performance)
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) { clearInterval(autoT); }
                else { resetAuto(); }
            });

            goTo(0);
            resetAuto();
        }
    }

    // ── Scroll to Top ────────────────────────────────────────────
    if (scrollBtn) {
        scrollBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ── Active nav link — deferred to idle time ──────────────────
    if ('requestIdleCallback' in window) {
        requestIdleCallback(setActiveNav);
    } else {
        setTimeout(setActiveNav, 100);
    }

    function setActiveNav() {
        var path = window.location.pathname;
        var links = document.querySelectorAll('.nav__link');
        for (var i = 0; i < links.length; i++) {
            var href = links[i].getAttribute('href');
            if (href && href !== '/' && path.indexOf(href.replace(/\/$/, '').split('/').pop()) !== -1) {
                links[i].classList.add('is-active');
            }
        }
    }

    // ── Stat counter animation (Why Us section) ──────────────────
    var statObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateCounters(entry.target);
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    var statSection = document.querySelector('.why-us__visual');
    if (statSection) statObserver.observe(statSection);

    function animateCounters(container) {
        var nums = container.querySelectorAll('.why-us__stat-number');
        nums.forEach(function(el) {
            var text = el.textContent.trim();
            var match = text.match(/^([\d,]+)(\+?)$/);
            if (!match) return;
            var target = parseInt(match[1].replace(/,/g, ''), 10);
            var suffix = match[2] || '';
            var duration = 1800;
            var start = performance.now();

            function tick(now) {
                var elapsed = now - start;
                var progress = Math.min(elapsed / duration, 1);
                // Ease out cubic
                var eased = 1 - Math.pow(1 - progress, 3);
                var current = Math.round(eased * target);
                el.textContent = current.toLocaleString() + suffix;
                if (progress < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        });
    }

    // ── Stats bar counter animation (About page) ─────────────────
    var statsBar = document.querySelector('.stats-bar');
    if (statsBar) {
        var statsBarObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var nums = entry.target.querySelectorAll('.stats-bar__number');
                    nums.forEach(function(el) {
                        var text = el.textContent.trim();
                        var match = text.match(/^([\d,]+)(\+?)$/);
                        if (!match) return;
                        var target = parseInt(match[1].replace(/,/g, ''), 10);
                        var suffix = match[2] || '';
                        var duration = 2000;
                        var startTime = performance.now();
                        function tick(now) {
                            var elapsed = now - startTime;
                            var progress = Math.min(elapsed / duration, 1);
                            var eased = 1 - Math.pow(1 - progress, 3);
                            el.textContent = Math.round(eased * target).toLocaleString() + suffix;
                            if (progress < 1) requestAnimationFrame(tick);
                        }
                        requestAnimationFrame(tick);
                    });
                    statsBarObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        statsBarObserver.observe(statsBar);
    }

    // ── Gallery Filters (Before & After) ──────────────────────────
    var filterBtns = document.querySelectorAll('.gallery-filter');
    var galleryCards = document.querySelectorAll('.gallery-card');
    if (filterBtns.length && galleryCards.length) {
        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var filter = this.getAttribute('data-filter');

                // Update active state
                filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
                this.classList.add('is-active');

                // Show/hide cards with animation
                galleryCards.forEach(function(card) {
                    var category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = '';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(12px)';
                        requestAnimationFrame(function() {
                            card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        });
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(12px)';
                        setTimeout(function() { card.style.display = 'none'; }, 300);
                    }
                });
            });
        });
    }

    // ── Smooth anchor scrolling with offset ──────────────────────
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
            }
        });
    });

    // ── Reading progress bar (blog posts only) ──────────────────
    var progressBar = document.getElementById('reading-progress-bar');
    var postContent = document.querySelector('.post-content');
    if (progressBar && postContent) {
        window.addEventListener('scroll', function() {
            var rect = postContent.getBoundingClientRect();
            var scrolled = -rect.top;
            var total = rect.height - window.innerHeight;
            var pct = Math.min(Math.max(scrolled / total * 100, 0), 100);
            progressBar.style.width = pct + '%';
        }, { passive: true });
    }

    // ── Hide floating CTA near footer ───────────────────────────
    var floatingCta = document.getElementById('floating-cta');
    var siteFooter = document.querySelector('.site-footer');
    if (floatingCta && siteFooter) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                floatingCta.style.opacity = entry.isIntersecting ? '0' : '';
                floatingCta.style.pointerEvents = entry.isIntersecting ? 'none' : '';
            });
        }, { threshold: 0.1 });
        observer.observe(siteFooter);
    }

})();
</script>

<?php wp_footer(); ?>
</body>
</html>
