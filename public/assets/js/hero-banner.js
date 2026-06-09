(function () {
    'use strict';

    function initHeroBanner() {
        var swiperEl = document.querySelector('.hero-swiper');
        if (!swiperEl || typeof Swiper === 'undefined') return;

        var progressBar  = document.querySelector('.hero-progress-bar');
        var autoplayDelay = 5500;

        /* ── Animate text in the real active slide ── */
        function animateActiveSlide(swiper) {
            // Remove from ALL slides (including loop clones)
            swiperEl.querySelectorAll('.hero-slide-content').forEach(function (content) {
                var els = content.querySelectorAll('.hsc-tag, .hsc-title, .hsc-sub, .hsc-actions');
                els.forEach(function (el) {
                    el.classList.remove('slide-animate');
                    // force reflow so transition re-triggers
                    void el.offsetWidth;
                });
                content.closest('.swiper-slide').classList.remove('slide-animate');
            });

            // Add to active slide (and its clone if looped)
            var activeSlides = swiperEl.querySelectorAll('.swiper-slide-active');
            activeSlides.forEach(function (slide) {
                slide.classList.add('slide-animate');
                var els = slide.querySelectorAll('.hsc-tag, .hsc-title, .hsc-sub, .hsc-actions');
                els.forEach(function (el) {
                    void el.offsetWidth; // reflow
                    el.classList.add('slide-animate');
                });
            });
        }

        /* ── Progress bar ── */
        function resetProgress() {
            if (!progressBar) return;
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    progressBar.style.transition = 'width ' + autoplayDelay + 'ms linear';
                    progressBar.style.width = '100%';
                });
            });
        }

        var heroSwiper = new Swiper('.hero-swiper', {
            loop:          true,
            speed:         700,
            grabCursor:    true,
            slidesPerView: 1,
            spaceBetween:  0,
            simulateTouch:  true,
            allowTouchMove: true,
            touchRatio:     1,
            touchAngle:     45,

            autoplay: {
                delay:                autoplayDelay,
                disableOnInteraction: false,
                pauseOnMouseEnter:    true,
                waitForTransition:    true,
            },

            keyboard: { enabled: true, onlyInViewport: true },

            navigation: false,

            pagination: {
                el:        '.hero-pagination',
                clickable: true,
                type:      'bullets',
            },

            on: {
                init: function (swiper) {
                    animateActiveSlide(swiper);
                    resetProgress();

                    document.addEventListener('visibilitychange', function () {
                        if (document.hidden) {
                            swiper.autoplay.stop();
                        } else {
                            swiper.autoplay.start();
                            resetProgress();
                        }
                    });
                },

                slideChangeTransitionEnd: function (swiper) {
                    animateActiveSlide(swiper);
                    resetProgress();
                },
            },
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroBanner);
    } else {
        initHeroBanner();
    }

})();
