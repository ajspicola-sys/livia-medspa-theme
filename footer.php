<?php
/**
 * Livia Med Spa — Footer Template
 */
?>

<!-- FOOTER -->
<footer class="site-footer">
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
                    <a href="#" class="footer__social-link" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="TikTok">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer__col">
                <h4 class="footer__heading">Quick Links</h4>
                <ul class="footer__links">
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Before & After</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Top Services -->
            <div class="footer__col">
                <h4 class="footer__heading">Popular Treatments</h4>
                <ul class="footer__links">
                    <li><a href="#">Botox & Dysport</a></li>
                    <li><a href="#">Dermal Fillers</a></li>
                    <li><a href="#">Microneedling</a></li>
                    <li><a href="#">Chemical Peels</a></li>
                    <li><a href="#">Laser Treatments</a></li>
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
                <a href="#book" class="btn btn--primary btn--sm" style="margin-top:1.25rem;">Book Consultation</a>
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

<!-- SCRIPTS -->
<script>
// Header scroll + announcement
const header = document.getElementById('site-header');
const annoBar = document.getElementById('announcement-bar');
let annoBarHeight = annoBar ? annoBar.offsetHeight : 0;
let annoDismissed = false;
const adminBarEl = document.getElementById('wpadminbar');
const adminBarH = adminBarEl ? adminBarEl.offsetHeight : 0;

// Set initial header position below announcement bar
function updateHeaderPosition() {
    const base = adminBarH;
    if (annoBar && !annoDismissed) {
        annoBarHeight = annoBar.offsetHeight;
        if (window.scrollY <= annoBarHeight) {
            header.style.top = (base + annoBarHeight - window.scrollY) + 'px';
        } else {
            header.style.top = base + 'px';
        }
    } else {
        header.style.top = base + 'px';
    }
}

updateHeaderPosition();

window.addEventListener('scroll', () => {
    header.classList.toggle('is-scrolled', window.scrollY > 50);
    updateHeaderPosition();
});

// Announcement dismiss
const annoClose = document.getElementById('announcement-close');
if (annoClose) {
    annoClose.addEventListener('click', () => {
        annoDismissed = true;
        annoBar.style.transform = 'translateY(-100%)';
        annoBar.style.opacity = '0';
        annoBar.style.transition = 'transform 0.4s ease, opacity 0.3s ease';
        header.style.transition = 'top 0.4s ease, background 0.4s ease, padding 0.4s ease, box-shadow 0.4s ease';
        header.style.top = '0px';
        document.body.classList.remove('has-announcement');
        setTimeout(() => { annoBar.style.display = 'none'; }, 400);
    });
}

// Mobile menu
const toggle = document.getElementById('mobile-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const mobileOverlay = document.getElementById('mobile-overlay');
const mobileClose = document.getElementById('mobile-close');

function openMenu() {
    mobileMenu.classList.add('is-open');
    toggle.classList.add('is-active');
    document.body.style.overflow = 'hidden';
}
function closeMenu() {
    mobileMenu.classList.remove('is-open');
    toggle.classList.remove('is-active');
    document.body.style.overflow = '';
}

if (toggle) toggle.addEventListener('click', openMenu);
if (mobileOverlay) mobileOverlay.addEventListener('click', closeMenu);
if (mobileClose) mobileClose.addEventListener('click', closeMenu);

// Scroll reveal animation
const observerOptions = { threshold: 0.15, rootMargin: '0px 0px -50px 0px' };
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ── Services Carousel (Infinite) ──────────────────────────────────
(function() {
    const carousel = document.getElementById('services-carousel');
    if (!carousel) return;

    const track = carousel.querySelector('.carousel__track');
    const slides = Array.from(carousel.querySelectorAll('.carousel__slide'));
    const dotsContainer = document.getElementById('carousel-dots');
    const prevBtn = carousel.querySelector('.carousel__arrow--prev');
    const nextBtn = carousel.querySelector('.carousel__arrow--next');
    const total = slides.length;
    if (total === 0) return;

    let current = 0;
    let autoplayTimer;

    // Create dots
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'carousel__dot' + (i === 0 ? ' is-active' : '');
        dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        dot.addEventListener('click', () => goTo(i));
        dotsContainer.appendChild(dot);
    });

    // Modular index helper
    function mod(n, m) { return ((n % m) + m) % m; }

    // Track previous positions to detect wrapping
    let prevPositions = {};

    function getPosition(i) {
        const diff = mod(i - current, total);
        if (diff === 0) return 0;       // active
        if (diff === 1) return 1;       // next
        if (diff === total - 1) return -1; // prev
        if (diff === 2) return 2;       // far-next
        if (diff === total - 2) return -2; // far-prev
        return 99;                      // hidden
    }

    function updateSlides() {
        slides.forEach((slide, i) => {
            const newPos = getPosition(i);
            const oldPos = prevPositions[i] !== undefined ? prevPositions[i] : newPos;

            // Detect wrapping: large jump means it's looping around
            const isWrapping = Math.abs(newPos - oldPos) > 3;

            if (isWrapping) {
                // Teleport: disable transition, hide, move to new spot
                slide.style.transition = 'none';
                slide.style.opacity = '0';
            }

            slide.classList.remove('is-active', 'is-prev', 'is-next', 'is-far-prev', 'is-far-next');

            if (newPos === 0) slide.classList.add('is-active');
            else if (newPos === 1) slide.classList.add('is-next');
            else if (newPos === -1) slide.classList.add('is-prev');
            else if (newPos === 2) slide.classList.add('is-far-next');
            else if (newPos === -2) slide.classList.add('is-far-prev');
            else slide.style.opacity = '0';

            if (isWrapping) {
                // Re-enable transition on next frame so it fades in
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        slide.style.transition = '';
                        slide.style.opacity = '';
                    });
                });
            } else {
                slide.style.opacity = '';
            }

            prevPositions[i] = newPos;
        });

        // Update dots
        dotsContainer.querySelectorAll('.carousel__dot').forEach((dot, i) => {
            dot.classList.toggle('is-active', i === current);
        });
    }

    function goTo(index) {
        current = mod(index, total);
        updateSlides();
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    prevBtn.addEventListener('click', prev);
    nextBtn.addEventListener('click', next);

    // Touch / swipe support
    let touchStartX = 0;
    track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) { diff > 0 ? next() : prev(); }
    });

    // Autoplay every 4 seconds
    function resetAutoplay() {
        clearInterval(autoplayTimer);
        autoplayTimer = setInterval(next, 4000);
    }

    carousel.addEventListener('mouseenter', () => clearInterval(autoplayTimer));
    carousel.addEventListener('mouseleave', resetAutoplay);

    // Init
    goTo(0);
    resetAutoplay();
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
