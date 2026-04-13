/**
 * Livia Med Spa — Scroll Animations
 * 
 * IntersectionObserver-based reveal animations for elements
 * with the `.animate-on-scroll` class.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

(function() {
    'use strict';

    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) {
        // Show everything immediately
        document.querySelectorAll('.animate-on-scroll').forEach(function(el) {
            el.classList.add('is-visible');
        });
        return;
    }

    /* ──────────────────────────────────────────────────────────────────────
       INTERSECTION OBSERVER
       ────────────────────────────────────────────────────────────────────── */

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animated elements
    function initAnimations() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        elements.forEach(function(el) {
            observer.observe(el);
        });
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAnimations);
    } else {
        initAnimations();
    }

    /* ──────────────────────────────────────────────────────────────────────
       PARALLAX EFFECT (simple CSS transform-based)
       ────────────────────────────────────────────────────────────────────── */

    const parallaxElements = document.querySelectorAll('.parallax-bg');
    
    if (parallaxElements.length > 0) {
        let parallaxTicking = false;

        window.addEventListener('scroll', function() {
            if (!parallaxTicking) {
                window.requestAnimationFrame(function() {
                    parallaxElements.forEach(function(el) {
                        const section = el.closest('.parallax-section');
                        if (!section) return;
                        
                        const rect = section.getBoundingClientRect();
                        const scrolled = rect.top / window.innerHeight;
                        const offset = scrolled * 50;
                        
                        el.style.transform = 'translateY(' + offset + 'px)';
                    });
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        }, { passive: true });
    }

})();
