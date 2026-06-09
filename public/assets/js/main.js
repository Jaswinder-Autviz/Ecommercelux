/* ========================================
   PREMIUM ECOMMERCE MAIN JS
   ======================================== */

(function () {
    'use strict';

    /* ========== ELEMENTS ========== */
    const header          = document.getElementById('siteHeader');
    const announcementBar = document.getElementById('announcementBar');
    const closeAnnounce   = document.getElementById('closeAnnouncement');
    const mobileToggle    = document.getElementById('mobileMenuToggle');
    const mobileNav       = document.getElementById('mobileNav');
    const mobileOverlay   = document.getElementById('mobileOverlay');
    const mobileClose     = document.getElementById('mobileClose');
    const searchToggle    = document.getElementById('searchToggle');
    const searchOverlay   = document.getElementById('searchOverlay');
    const searchClose     = document.getElementById('searchClose');
    const searchInput     = document.getElementById('searchInput');
    const cartBadge       = document.getElementById('cartBadge');

    /* ========== SCROLL SHADOW ========== */
    function handleScroll() {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    /* ========== ANNOUNCEMENT BAR ========== */
    if (closeAnnounce && announcementBar) {
        closeAnnounce.addEventListener('click', function () {
            announcementBar.style.height = announcementBar.offsetHeight + 'px';
            requestAnimationFrame(function () {
                announcementBar.style.transition = 'height 0.3s ease, opacity 0.3s ease';
                announcementBar.style.height = '0';
                announcementBar.style.opacity = '0';
                announcementBar.style.overflow = 'hidden';
            });
            setTimeout(function () {
                announcementBar.style.display = 'none';
            }, 300);
            sessionStorage.setItem('announcementClosed', 'true');
        });

        if (sessionStorage.getItem('announcementClosed') === 'true') {
            announcementBar.style.display = 'none';
        }
    }

    /* ========== MOBILE MENU ========== */
    function openMobileMenu() {
        mobileNav.classList.add('active');
        mobileOverlay.classList.add('active');
        mobileToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileNav.classList.remove('active');
        mobileOverlay.classList.remove('active');
        mobileToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', openMobileMenu);
    }

    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    /* ========== MOBILE SUBMENU ========== */
    const mobileSubToggles = document.querySelectorAll('.mobile-sub-toggle');

    mobileSubToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const parent = this.closest('.mobile-has-sub');
            const isActive = parent.classList.contains('active');

            // Close all
            document.querySelectorAll('.mobile-has-sub').forEach(function (item) {
                item.classList.remove('active');
            });

            // Open clicked if it was closed
            if (!isActive) {
                parent.classList.add('active');
            }
        });
    });

    /* ========== SEARCH OVERLAY ========== */
    function openSearch() {
        searchOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
            if (searchInput) searchInput.focus();
        }, 200);
    }

    function closeSearch() {
        searchOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (searchToggle) {
        searchToggle.addEventListener('click', openSearch);
    }

    if (searchClose) {
        searchClose.addEventListener('click', closeSearch);
    }

    // Close search on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSearch();
            closeMobileMenu();
        }
    });

    // Close search on overlay click
    if (searchOverlay) {
        searchOverlay.addEventListener('click', function (e) {
            if (e.target === searchOverlay) {
                closeSearch();
            }
        });
    }

    /* ========== CART BADGE ========== */
    function updateCartBadge(count) {
        if (!cartBadge) return;
        cartBadge.textContent = count;
        if (count > 0) {
            cartBadge.style.display = 'flex';
        } else {
            cartBadge.style.display = 'none';
        }
    }

    function getCartCount() {
        try {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            return cart.reduce(function (sum, item) {
                return sum + (item.qty || 1);
            }, 0);
        } catch (e) {
            return 0;
        }
    }

    updateCartBadge(getCartCount());

    // Expose globally for other scripts
    window.Hustler = {
        updateCartBadge: updateCartBadge,
        getCartCount: getCartCount,
    };

    /* ========== SMOOTH ANCHOR SCROLL ========== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* ========== LAZY IMAGE LOADING ========== */
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(function (img) {
            imageObserver.observe(img);
        });
    }

})();
