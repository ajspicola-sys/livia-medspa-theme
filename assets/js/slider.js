/**
 * Livia Med Spa — Before/After Image Comparison Slider
 * 
 * Touch and mouse drag-enabled slider for comparing before/after images.
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

(function() {
    'use strict';

    function initSlider(container) {
        const beforeEl = container.querySelector('.ba-slider__before');
        const divider  = container.querySelector('.ba-slider__divider');
        const handle   = container.querySelector('.ba-slider__handle');
        
        if (!beforeEl || !divider || !handle) return;

        let isDragging = false;
        let containerRect;

        function updatePosition(x) {
            containerRect = container.getBoundingClientRect();
            let pos = (x - containerRect.left) / containerRect.width;
            pos = Math.max(0, Math.min(1, pos));
            
            const percent = pos * 100;
            
            beforeEl.style.clipPath = 'inset(0 ' + (100 - percent) + '% 0 0)';
            divider.style.left = percent + '%';
            handle.style.left = percent + '%';
        }

        // --- Mouse Events ---
        function onMouseDown(e) {
            e.preventDefault();
            isDragging = true;
            container.classList.add('is-dragging');
            updatePosition(e.clientX);
        }

        function onMouseMove(e) {
            if (!isDragging) return;
            e.preventDefault();
            updatePosition(e.clientX);
        }

        function onMouseUp() {
            isDragging = false;
            container.classList.remove('is-dragging');
        }

        // --- Touch Events ---
        function onTouchStart(e) {
            isDragging = true;
            container.classList.add('is-dragging');
            updatePosition(e.touches[0].clientX);
        }

        function onTouchMove(e) {
            if (!isDragging) return;
            e.preventDefault();
            updatePosition(e.touches[0].clientX);
        }

        function onTouchEnd() {
            isDragging = false;
            container.classList.remove('is-dragging');
        }

        // Bind mouse events
        container.addEventListener('mousedown', onMouseDown);
        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);

        // Bind touch events
        container.addEventListener('touchstart', onTouchStart, { passive: true });
        container.addEventListener('touchmove', onTouchMove, { passive: false });
        container.addEventListener('touchend', onTouchEnd);

        // Keyboard accessibility
        handle.setAttribute('tabindex', '0');
        handle.setAttribute('role', 'slider');
        handle.setAttribute('aria-label', 'Before and after comparison slider');
        handle.setAttribute('aria-valuemin', '0');
        handle.setAttribute('aria-valuemax', '100');
        handle.setAttribute('aria-valuenow', '50');

        handle.addEventListener('keydown', function(e) {
            containerRect = container.getBoundingClientRect();
            const currentLeft = parseFloat(handle.style.left || '50');
            let newPos = currentLeft;

            if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') {
                e.preventDefault();
                newPos = Math.max(0, currentLeft - 2);
            } else if (e.key === 'ArrowRight' || e.key === 'ArrowUp') {
                e.preventDefault();
                newPos = Math.min(100, currentLeft + 2);
            }

            if (newPos !== currentLeft) {
                beforeEl.style.clipPath = 'inset(0 ' + (100 - newPos) + '% 0 0)';
                divider.style.left = newPos + '%';
                handle.style.left = newPos + '%';
                handle.setAttribute('aria-valuenow', Math.round(newPos));
            }
        });
    }

    /* ──────────────────────────────────────────────────────────────────────
       INITIALIZE ALL SLIDERS
       ────────────────────────────────────────────────────────────────────── */

    function initAllSliders() {
        const sliders = document.querySelectorAll('[data-ba-slider]');
        sliders.forEach(initSlider);
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllSliders);
    } else {
        initAllSliders();
    }

    // Re-init for dynamically loaded content
    window.liviaInitBASliders = initAllSliders;

})();
