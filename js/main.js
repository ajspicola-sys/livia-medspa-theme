/**
 * Livia Med Spa — Main JavaScript
 * 
 * Core functionality: header scroll, scroll progress, back-to-top,
 * counter animations, accordion, smooth scroll.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

(function() {
    'use strict';

    /* ──────────────────────────────────────────────────────────────────────
       1. STICKY HEADER
       ────────────────────────────────────────────────────────────────────── */

    const header = document.getElementById('siteHeader');
    let lastScroll = 0;

    function handleHeaderScroll() {
        const currentScroll = window.scrollY;
        
        if (currentScroll > 50) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
        
        lastScroll = currentScroll;
    }

    /* ──────────────────────────────────────────────────────────────────────
       2. SCROLL PROGRESS BAR
       ────────────────────────────────────────────────────────────────────── */

    const progressBar = document.getElementById('scrollProgress');

    function updateScrollProgress() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        
        if (progressBar) {
            progressBar.style.width = scrollPercent + '%';
        }
    }

    /* ──────────────────────────────────────────────────────────────────────
       3. BACK TO TOP BUTTON
       ────────────────────────────────────────────────────────────────────── */

    const backToTop = document.getElementById('backToTop');

    function handleBackToTop() {
        if (window.scrollY > 500) {
            backToTop.classList.add('is-visible');
        } else {
            backToTop.classList.remove('is-visible');
        }
    }

    if (backToTop) {
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       4. SCROLL EVENT (debounced)
       ────────────────────────────────────────────────────────────────────── */

    let scrollTicking = false;

    window.addEventListener('scroll', function() {
        if (!scrollTicking) {
            window.requestAnimationFrame(function() {
                handleHeaderScroll();
                updateScrollProgress();
                handleBackToTop();
                scrollTicking = false;
            });
            scrollTicking = true;
        }
    }, { passive: true });

    // Initial call
    handleHeaderScroll();
    updateScrollProgress();

    /* ──────────────────────────────────────────────────────────────────────
       5. COUNTER ANIMATION
       ────────────────────────────────────────────────────────────────────── */

    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        if (isNaN(target)) return;
        
        const duration = 2000;
        const frameDuration = 1000 / 60;
        const totalFrames = Math.round(duration / frameDuration);
        let frame = 0;
        
        const counter = setInterval(function() {
            frame++;
            const progress = frame / totalFrames;
            const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
            const current = Math.round(eased * target);
            
            element.textContent = current;
            
            if (frame === totalFrames) {
                clearInterval(counter);
                element.textContent = target;
            }
        }, frameDuration);
    }

    // Observe counter elements
    const counterElements = document.querySelectorAll('[data-count]');
    if (counterElements.length > 0) {
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counterElements.forEach(function(el) {
            counterObserver.observe(el);
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       6. ACCORDION (FAQ)
       ────────────────────────────────────────────────────────────────────── */

    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.accordion__trigger');
        if (!trigger) return;

        const item = trigger.closest('.accordion__item');
        const isOpen = item.classList.contains('is-open');
        
        // Close all siblings
        const accordion = item.closest('.accordion');
        if (accordion) {
            accordion.querySelectorAll('.accordion__item.is-open').forEach(function(openItem) {
                openItem.classList.remove('is-open');
            });
        }

        // Toggle current
        if (!isOpen) {
            item.classList.add('is-open');
        }
    });

    /* ──────────────────────────────────────────────────────────────────────
       7. SMOOTH SCROLL FOR ANCHOR LINKS
       ────────────────────────────────────────────────────────────────────── */

    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href^="#"]');
        if (!link) return;

        const targetId = link.getAttribute('href');
        if (targetId === '#' || targetId === '#book') return;

        const target = document.querySelector(targetId);
        if (target) {
            e.preventDefault();
            const headerHeight = header ? header.offsetHeight : 0;
            const targetPos = target.getBoundingClientRect().top + window.scrollY - headerHeight - 20;
            
            window.scrollTo({
                top: targetPos,
                behavior: 'smooth'
            });
        }
    });

    /* ──────────────────────────────────────────────────────────────────────
       8. LAZY LOAD IMAGES (native fallback)
       ────────────────────────────────────────────────────────────────────── */

    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading supported
        document.querySelectorAll('img[loading="lazy"]').forEach(function(img) {
            img.decoding = 'async';
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       9. EXTERNAL LINKS — open in new tab
       ────────────────────────────────────────────────────────────────────── */

    document.querySelectorAll('a[href^="http"]').forEach(function(link) {
        if (!link.hostname.includes(window.location.hostname)) {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        }
    });

})();
