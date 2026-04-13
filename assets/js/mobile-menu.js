/**
 * Livia Med Spa — Mobile Menu
 * 
 * Handles mobile menu drawer open/close, overlay, body scroll lock.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

(function() {
    'use strict';

    const toggle  = document.getElementById('mobileMenuToggle');
    const menu    = document.getElementById('mobileMenu');
    const close   = document.getElementById('mobileMenuClose');
    const overlay = document.getElementById('mobileMenuOverlay');

    if (!toggle || !menu) return;

    function openMenu() {
        menu.classList.add('is-open');
        menu.setAttribute('aria-hidden', 'false');
        toggle.classList.add('is-active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu.classList.remove('is-open');
        menu.setAttribute('aria-hidden', 'true');
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    // Toggle button
    toggle.addEventListener('click', function() {
        const isOpen = menu.classList.contains('is-open');
        isOpen ? closeMenu() : openMenu();
    });

    // Close button
    if (close) {
        close.addEventListener('click', closeMenu);
    }

    // Overlay click
    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    // Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && menu.classList.contains('is-open')) {
            closeMenu();
        }
    });

    // Close on nav link click
    menu.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });

    // Close on resize above breakpoint
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 1024 && menu.classList.contains('is-open')) {
                closeMenu();
            }
        }, 100);
    });

    /* ──────────────────────────────────────────────────────────────────────
       MOBILE SUB-MENU TOGGLE
       ────────────────────────────────────────────────────────────────────── */

    const parentItems = menu.querySelectorAll('.menu-item-has-children');
    
    parentItems.forEach(function(item) {
        const link = item.querySelector('a');
        if (!link) return;

        // Create toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'mobile-submenu-toggle';
        toggleBtn.setAttribute('aria-label', 'Toggle submenu');
        toggleBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>';
        
        link.after(toggleBtn);

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const submenu = item.querySelector('.sub-menu');
            if (!submenu) return;

            const isExpanded = item.classList.contains('is-expanded');
            
            // Close sibling submenus
            parentItems.forEach(function(sibling) {
                if (sibling !== item) {
                    sibling.classList.remove('is-expanded');
                    const sibSub = sibling.querySelector('.sub-menu');
                    if (sibSub) sibSub.style.maxHeight = '0';
                }
            });

            if (isExpanded) {
                item.classList.remove('is-expanded');
                submenu.style.maxHeight = '0';
            } else {
                item.classList.add('is-expanded');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }
        });

        // Initialize sub-menus as collapsed
        const submenu = item.querySelector('.sub-menu');
        if (submenu) {
            submenu.style.maxHeight = '0';
            submenu.style.overflow = 'hidden';
            submenu.style.transition = 'max-height 0.3s ease';
        }
    });

})();
