/* ============================================================
   NEW ARRIVALS SLIDER — new-arrivals-slider.js
   ============================================================ */

(function () {
    'use strict';

    function initNewArrivals() {
        var el = document.querySelector('.na-swiper');
        if (!el || typeof Swiper === 'undefined') return;

        new Swiper('.na-swiper', {

            /* ── Layout ───────────────────────────────── */
            slidesPerView:  1.2,
            spaceBetween:   5,
            centeredSlides: false,
            grabCursor:     true,
            loop:           true,

            /* ── Breakpoints ──────────────────────────── */
            breakpoints: {
                480: {
                    slidesPerView: 1.5,
                    spaceBetween:  5,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween:  5,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween:  5,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween:  5,
                },
            },

            /* ── Autoplay ─────────────────────────────── */
            autoplay: {
                delay:                4500,
                disableOnInteraction: false,
                pauseOnMouseEnter:    true,
            },

            /* ── Speed ────────────────────────────────── */
            speed: 700,

            /* ── Navigation ───────────────────────────── */
            navigation: {
                prevEl: '.na-nav-prev',
                nextEl: '.na-nav-next',
            },

            /* ── Pagination ───────────────────────────── */
            pagination: {
                el:        '.na-pagination',
                clickable: true,
                type:      'bullets',
            },

            /* ── Touch ────────────────────────────────── */
            touchRatio:     1,
            touchAngle:     45,
            simulateTouch:  true,
            allowTouchMove: true,

            /* ── Keyboard ─────────────────────────────── */
            keyboard: {
                enabled:        true,
                onlyInViewport: true,
            },

            /* ── A11y ─────────────────────────────────── */
            a11y: {
                enabled:          true,
                prevSlideMessage: 'Previous product',
                nextSlideMessage: 'Next product',
            },
        });

        /* ── Wishlist toggle ──────────────────────────── */
        document.querySelectorAll('.na-wishlist').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                this.classList.toggle('active');
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNewArrivals);
    } else {
        initNewArrivals();
    }

})();
