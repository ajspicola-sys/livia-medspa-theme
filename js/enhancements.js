/**
 * Livia Med Spa — Enhancement Scripts
 * 
 * Cursor glow, smooth scroll enhancements, and micro-interactions.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

(function() {
    'use strict';

    /* ──────────────────────────────────────────────────────────────────────
       1. CURSOR GLOW EFFECT (desktop only)
       ────────────────────────────────────────────────────────────────────── */

    const cursorGlow = document.getElementById('cursorGlow');
    
    if (cursorGlow && window.innerWidth > 1024) {
        let mouseX = 0, mouseY = 0;
        let glowX = 0, glowY = 0;
        let isVisible = false;

        document.addEventListener('mousemove', function(e) {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            if (!isVisible) {
                isVisible = true;
                cursorGlow.style.opacity = '1';
            }
        });

        document.addEventListener('mouseleave', function() {
            isVisible = false;
            cursorGlow.style.opacity = '0';
        });

        // Smooth follow with lerp
        function animateGlow() {
            glowX += (mouseX - glowX) * 0.08;
            glowY += (mouseY - glowY) * 0.08;
            
            cursorGlow.style.left = glowX + 'px';
            cursorGlow.style.top = glowY + 'px';
            
            requestAnimationFrame(animateGlow);
        }
        
        animateGlow();
    }

    /* ──────────────────────────────────────────────────────────────────────
       2. TILT EFFECT ON WHY-CARDS
       ────────────────────────────────────────────────────────────────────── */

    const whyCards = document.querySelectorAll('.why-card');
    
    if (window.innerWidth > 1024) {
        whyCards.forEach(function(card) {
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -3;
                const rotateY = ((x - centerX) / centerX) * 3;
                
                card.style.transform = 'translateY(-8px) perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)';
            });
            
            card.addEventListener('mouseleave', function() {
                card.style.transform = '';
            });
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       3. HEADER LINK ACTIVE STATE ON SCROLL
       ────────────────────────────────────────────────────────────────────── */

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav__link');

    function updateActiveNav() {
        const scrollY = window.scrollY + 200;

        sections.forEach(function(section) {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');

            if (scrollY >= top && scrollY < top + height) {
                navLinks.forEach(function(link) {
                    link.closest('.nav__item')?.classList.remove('nav__item--active');
                    
                    if (link.getAttribute('href') === '#' + id) {
                        link.closest('.nav__item')?.classList.add('nav__item--active');
                    }
                });
            }
        });
    }

    let navTicking = false;
    window.addEventListener('scroll', function() {
        if (!navTicking) {
            requestAnimationFrame(function() {
                updateActiveNav();
                navTicking = false;
            });
            navTicking = true;
        }
    }, { passive: true });

    /* ──────────────────────────────────────────────────────────────────────
       4. TESTIMONIAL CARD HOVER DEPTH
       ────────────────────────────────────────────────────────────────────── */

    const testimonialCards = document.querySelectorAll('.testimonial-card');
    
    testimonialCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            card.style.transform = 'translateY(-4px)';
            card.style.boxShadow = '0 12px 40px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            card.style.transform = '';
            card.style.boxShadow = '';
        });
    });

    /* ──────────────────────────────────────────────────────────────────────
       5. PAUSE MARQUEE ON HOVER
       ────────────────────────────────────────────────────────────────────── */

    const marquee = document.querySelector('.trust-marquee');
    const marqueeTrack = document.querySelector('.trust-marquee__track');
    
    if (marquee && marqueeTrack) {
        marquee.addEventListener('mouseenter', function() {
            marqueeTrack.style.animationPlayState = 'paused';
        });
        
        marquee.addEventListener('mouseleave', function() {
            marqueeTrack.style.animationPlayState = 'running';
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       6. SMOOTH REVEAL FOR HERO CONTENT
       ────────────────────────────────────────────────────────────────────── */

    window.addEventListener('load', function() {
        const heroElements = document.querySelectorAll('.hero .animate-on-scroll');
        
        heroElements.forEach(function(el, index) {
            setTimeout(function() {
                el.classList.add('is-visible');
            }, 300 + (index * 200));
        });
    });

    /* ──────────────────────────────────────────────────────────────────────
       7. FLOATING PROMO CLOSE
       ────────────────────────────────────────────────────────────────────── */

    const floatingPromo = document.getElementById('floatingPromo');
    const floatingPromoClose = document.getElementById('floatingPromoClose');
    
    if (floatingPromo && floatingPromoClose) {
        floatingPromoClose.addEventListener('click', function() {
            floatingPromo.classList.add('is-hidden');
        });

        // Also close when CTA is clicked
        const promoCta = floatingPromo.querySelector('.floating-promo__cta');
        if (promoCta) {
            promoCta.addEventListener('click', function() {
                floatingPromo.classList.add('is-hidden');
            });
        }
    }

    /* ──────────────────────────────────────────────────────────────────────
       7b. ANNOUNCEMENT BAR CLOSE
       ────────────────────────────────────────────────────────────────────── */

    const announcementBar = document.getElementById('announcementBar');
    const announcementBarClose = document.getElementById('announcementBarClose');
    
    if (announcementBar && announcementBarClose) {
        announcementBarClose.addEventListener('click', function() {
            announcementBar.classList.add('is-hidden');
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       8. SERVICE CARD MAGNETIC HOVER (desktop)
       ────────────────────────────────────────────────────────────────────── */

    if (window.innerWidth > 1024) {
        const serviceCards = document.querySelectorAll('.service-card');
        
        serviceCards.forEach(function(card) {
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                
                card.style.setProperty('--mouse-x', x + '%');
                card.style.setProperty('--mouse-y', y + '%');
            });
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       9. TYPED EFFECT ON HERO BADGE TEXT
       ────────────────────────────────────────────────────────────────────── */

    const heroBadge = document.querySelector('.hero__badge');
    if (heroBadge) {
        heroBadge.style.opacity = '0';
        setTimeout(function() {
            heroBadge.style.opacity = '';
        }, 500);
    }

    /* ──────────────────────────────────────────────────────────────────────
       10. COOKIE CONSENT HANDLERS
       ────────────────────────────────────────────────────────────────────── */

    const cookieConsent = document.getElementById('cookieConsent');
    const cookieAccept = document.getElementById('cookieAccept');
    const cookieDecline = document.getElementById('cookieDecline');

    function dismissCookie() {
        if (cookieConsent) {
            cookieConsent.classList.add('is-hidden');
        }
    }

    if (cookieAccept) cookieAccept.addEventListener('click', dismissCookie);
    if (cookieDecline) cookieDecline.addEventListener('click', dismissCookie);

    /* ──────────────────────────────────────────────────────────────────────
       11. MOBILE STICKY CTA VISIBILITY
       ────────────────────────────────────────────────────────────────────── */

    const mobileCta = document.getElementById('mobileStickyCtA');
    
    if (mobileCta && window.innerWidth <= 767) {
        let mobileCtaVisible = false;
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 600 && !mobileCtaVisible) {
                mobileCta.style.transform = 'translateY(0)';
                mobileCtaVisible = true;
            }
        }, { passive: true });
        
        // Start hidden
        mobileCta.style.transform = 'translateY(100%)';
        mobileCta.style.transition = 'transform 0.3s ease';
    }

    /* ──────────────────────────────────────────────────────────────────────
       12. MEMBERSHIP CARD HOVER GLOW
       ────────────────────────────────────────────────────────────────────── */

    const membershipCards = document.querySelectorAll('.membership-card');
    
    membershipCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            card.style.transition = 'all 0.3s ease';
        });
    });

    /* ──────────────────────────────────────────────────────────────────────
       13. RESULT CARD IMAGE COMPARISON HOVER
       ────────────────────────────────────────────────────────────────────── */

    const resultCards = document.querySelectorAll('.result-card');
    
    resultCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            const afterImg = card.querySelector('.result-card__after');
            if (afterImg) {
                afterImg.style.opacity = '1';
                afterImg.style.transform = 'scale(1.02)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const afterImg = card.querySelector('.result-card__after');
            if (afterImg) {
                afterImg.style.opacity = '';
                afterImg.style.transform = '';
            }
        });
    });

})();

