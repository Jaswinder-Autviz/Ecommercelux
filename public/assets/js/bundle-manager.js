/* ============================================================
   BUNDLE MANAGER — bundle-manager.js
   Handles 5 & 10 Poster Bundles, Duplicate Checks & Progress UI
   ============================================================ */

window.BundleManager = (function () {
    'use strict';

    const STORAGE_KEY = 'luxe_active_bundle';

    function getActive() {
        try {
            const data = JSON.parse(localStorage.getItem(STORAGE_KEY));
            if (data && (data.bundle_size === 5 || data.bundle_size === 10) && Array.isArray(data.posters)) {
                return data;
            }
        } catch (e) {}
        return {
            bundle_size: 5,
            posters: []
        };
    }

    function saveActive(bundle) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(bundle));
        window.dispatchEvent(new CustomEvent('bundle:updated', { detail: bundle }));
        syncUI();
    }

    function setBundleSize(size) {
        size = parseInt(size, 10);
        if (size !== 5 && size !== 10) size = 5;

        const active = getActive();
        if (active.bundle_size === size) return;

        if (size === 5 && active.posters.length > 5) {
            if (confirm('Switching to 5 Poster Bundle will keep only your first 5 selected posters. Continue?')) {
                active.posters = active.posters.slice(0, 5);
            } else {
                return;
            }
        }

        active.bundle_size = size;
        saveActive(active);

        if (typeof Toast !== 'undefined') {
            Toast.info(`Switched to ${size} Poster Bundle. Pick ${size} unique posters to complete.`, 'Bundle Updated');
        }
    }

    function hasPoster(posterId) {
        const active = getActive();
        return active.posters.some(p => String(p.id) === String(posterId));
    }

    function addPoster(poster) {
        const active = getActive();

        // 1. Check Duplicate
        if (hasPoster(poster.id)) {
            if (typeof Toast !== 'undefined') {
                Toast.warning('This poster is already added to your bundle.', 'Duplicate Poster');
            }
            return false;
        }

        // 2. Check Bundle Limit
        if (active.posters.length >= active.bundle_size) {
            if (typeof Toast !== 'undefined') {
                if (active.bundle_size === 5) {
                    Toast.warning('Your 5 Poster Bundle is full! Switch to 10 Poster Bundle or remove a poster to add this one.', 'Bundle Full');
                } else {
                    Toast.warning('Your 10 Poster Bundle is full! Remove a poster to add a different one.', 'Bundle Full');
                }
            }
            return false;
        }

        // 3. Add unique poster
        active.posters.push({
            id: poster.id,
            name: poster.name,
            slug: poster.slug || '',
            price: parseFloat(poster.price) || 0,
            oldPrice: poster.oldPrice ? parseFloat(poster.oldPrice) : null,
            image: poster.image || '',
            size: '12 × 8 inches'
        });

        saveActive(active);

        if (typeof Toast !== 'undefined') {
            const count = active.posters.length;
            const target = active.bundle_size;
            if (count === target) {
                Toast.success(`Your ${target} Poster Bundle is complete! You can now Add to Cart or Buy Now.`, 'Bundle Complete! 🎉');
            } else {
                Toast.success(`Added "${poster.name}" (${count} of ${target} posters selected)`, 'Added to Bundle');
            }
        }

        return true;
    }

    function removePoster(posterId) {
        const active = getActive();
        const before = active.posters.length;
        active.posters = active.posters.filter(p => String(p.id) !== String(posterId));

        if (active.posters.length !== before) {
            saveActive(active);
            if (typeof Toast !== 'undefined') {
                Toast.info('Poster removed from your bundle.', 'Poster Removed');
            }
            return true;
        }
        return false;
    }

    function isComplete() {
        const active = getActive();
        return active.posters.length === active.bundle_size && active.bundle_size > 0;
    }

    function getPrice() {
        const active = getActive();
        return active.posters.reduce((sum, p) => sum + (parseFloat(p.price) || 0), 0);
    }

    function getMRP() {
        const active = getActive();
        return active.posters.reduce((sum, p) => sum + (parseFloat(p.oldPrice) || parseFloat(p.price) || 0), 0);
    }

    function clear() {
        localStorage.removeItem(STORAGE_KEY);
        window.dispatchEvent(new CustomEvent('bundle:updated', { detail: getActive() }));
        syncUI();
    }

    function addBundleToCart() {
        const active = getActive();
        if (!isComplete()) {
            if (typeof Toast !== 'undefined') {
                Toast.warning('Please select all posters required for your bundle.', 'Incomplete Bundle');
            }
            return false;
        }

        // Prepare bundle cart item
        const bundleItem = {
            id: 'bundle_' + Date.now(),
            type: 'bundle',
            bundle_size: active.bundle_size,
            name: `${active.bundle_size} Poster Bundle (12 × 8 inches)`,
            size: '12 × 8 inches',
            price: getPrice(),
            oldPrice: getMRP(),
            quantity: 1,
            image: active.posters[0]?.image || '',
            posters: active.posters.map(p => ({
                id: p.id,
                name: p.name,
                price: p.price,
                image: p.image
            }))
        };

        if (typeof Cart !== 'undefined') {
            let cart = Cart.get();
            cart.push(bundleItem);
            Cart.save(cart);
        }

        // Reset active bundle
        clear();

        if (typeof Toast !== 'undefined') {
            Toast.success('Bundle added to your cart!', 'Cart Updated');
        }

        // Close dock drawer if open
        const dock = document.getElementById('bundleDock');
        if (dock) dock.classList.remove('drawer-open');

        return true;
    }

    function buyNow() {
        if (!isComplete()) {
            if (typeof Toast !== 'undefined') {
                Toast.warning('Please select all posters required for your bundle.', 'Incomplete Bundle');
            }
            return false;
        }

        if (addBundleToCart()) {
            window.location.href = '/checkout';
            return true;
        }
        return false;
    }

    // Sync all bundle UI elements across the page
    function syncUI() {
        const active = getActive();
        const count = active.posters.length;
        const target = active.bundle_size;
        const complete = isComplete();
        const percent = Math.min(100, Math.round((count / target) * 100));

        // 1. Text indicators
        document.querySelectorAll('.js-bundle-count-text').forEach(el => {
            el.textContent = `Selected: ${count} / ${target} Posters`;
        });
        document.querySelectorAll('.js-bundle-progress-text').forEach(el => {
            el.textContent = `${count} of ${target} posters selected`;
        });
        document.querySelectorAll('.js-bundle-target-label').forEach(el => {
            el.textContent = `${target} Poster Bundle`;
        });

        // 2. Progress bars
        document.querySelectorAll('.js-bundle-progress-fill').forEach(el => {
            el.style.width = `${percent}%`;
            if (complete) {
                el.classList.add('is-complete');
            } else {
                el.classList.remove('is-complete');
            }
        });

        // 3. Tab pills (5 vs 10)
        document.querySelectorAll('.js-bundle-size-btn').forEach(btn => {
            const btnSize = parseInt(btn.dataset.size, 10);
            if (btnSize === target) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // 4. Action buttons (Add Bundle to Cart / Buy Now)
        document.querySelectorAll('.js-bundle-add-cart').forEach(btn => {
            if (complete) {
                btn.removeAttribute('disabled');
                btn.classList.remove('disabled');
            } else {
                btn.setAttribute('disabled', 'disabled');
                btn.classList.add('disabled');
            }
        });

        document.querySelectorAll('.js-bundle-buy-now').forEach(btn => {
            if (complete) {
                btn.removeAttribute('disabled');
                btn.classList.remove('disabled');
            } else {
                btn.setAttribute('disabled', 'disabled');
                btn.classList.add('disabled');
            }
        });

        // 5. Product Page: Current Poster Button status
        if (window.currentProduct) {
            const currentId = window.currentProduct.id;
            const inBundle = hasPoster(currentId);
            document.querySelectorAll('.js-add-current-poster').forEach(btn => {
                if (inBundle) {
                    btn.innerHTML = '<i class="fas fa-check-circle"></i> Added in Bundle (Click to Remove)';
                    btn.classList.add('btn-in-bundle');
                } else {
                    btn.innerHTML = '<i class="fas fa-plus-circle"></i> Add This Poster to Bundle';
                    btn.classList.remove('btn-in-bundle');
                }
            });
        }

        // 6. Shop Product Cards: Button state
        document.querySelectorAll('.pcp-bundle-add-btn').forEach(btn => {
            const cardId = btn.dataset.id;
            if (hasPoster(cardId)) {
                btn.classList.add('in-bundle');
                btn.setAttribute('title', 'Already in bundle');
                btn.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                btn.classList.remove('in-bundle');
                btn.setAttribute('title', 'Add to bundle');
                btn.innerHTML = '<i class="fas fa-plus"></i>';
            }
        });

        // 7. Render thumbnail preview trays
        renderThumbnailTrays(active);

        // 8. Dock visibility
        const dock = document.getElementById('bundleDock');
        if (dock) {
            if (count > 0 || window.location.pathname.includes('/product/')) {
                dock.classList.add('dock-visible');
            } else {
                dock.classList.remove('dock-visible');
            }
        }
    }

    function renderThumbnailTrays(active) {
        document.querySelectorAll('.js-bundle-thumbnails').forEach(tray => {
            let html = '';
            for (let i = 0; i < active.bundle_size; i++) {
                const poster = active.posters[i];
                if (poster) {
                    html += `
                        <div class="bundle-slot slot-filled" data-id="${poster.id}" title="${poster.name}">
                            <img src="${poster.image}" alt="${poster.name}" onerror="this.src='/assets/images/placeholders/placeholder-product.svg'">
                            <button type="button" class="slot-remove-btn" onclick="BundleManager.removePoster('${poster.id}')" aria-label="Remove poster">
                                <i class="fas fa-times"></i>
                            </button>
                            <span class="slot-num">${i + 1}</span>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="bundle-slot slot-empty">
                            <span class="slot-empty-icon"><i class="fas fa-plus"></i></span>
                            <span class="slot-num">${i + 1}</span>
                        </div>
                    `;
                }
            }
            tray.innerHTML = html;
        });
    }

    return {
        getActive,
        saveActive,
        setBundleSize,
        hasPoster,
        addPoster,
        removePoster,
        isComplete,
        getPrice,
        getMRP,
        clear,
        addBundleToCart,
        buyNow,
        syncUI
    };
})();

// Global click event handlers for bundle actions
document.addEventListener('DOMContentLoaded', () => {
    BundleManager.syncUI();

    // Size toggle buttons (5 vs 10)
    document.addEventListener('click', (e) => {
        const sizeBtn = e.target.closest('.js-bundle-size-btn');
        if (sizeBtn) {
            e.preventDefault();
            BundleManager.setBundleSize(sizeBtn.dataset.size);
            return;
        }

        // Current product page add / remove toggle
        const addCurrentBtn = e.target.closest('.js-add-current-poster');
        if (addCurrentBtn) {
            e.preventDefault();
            if (!window.currentProduct) return;
            const p = window.currentProduct;
            if (BundleManager.hasPoster(p.id)) {
                BundleManager.removePoster(p.id);
            } else {
                BundleManager.addPoster(p);
            }
            return;
        }

        // Shop card "+ Add to Bundle" button
        const cardAddBtn = e.target.closest('.pcp-bundle-add-btn');
        if (cardAddBtn) {
            e.preventDefault();
            e.stopPropagation();

            const p = {
                id: cardAddBtn.dataset.id,
                name: cardAddBtn.dataset.name,
                price: parseFloat(cardAddBtn.dataset.price) || 0,
                oldPrice: cardAddBtn.dataset.oldPrice ? parseFloat(cardAddBtn.dataset.oldPrice) : null,
                image: cardAddBtn.dataset.image,
                slug: cardAddBtn.dataset.slug || ''
            };

            if (BundleManager.hasPoster(p.id)) {
                Toast.warning('This poster is already added to your bundle.', 'Duplicate Poster');
            } else {
                BundleManager.addPoster(p);
            }
            return;
        }

        // Add bundle to cart button
        const addCartBtn = e.target.closest('.js-bundle-add-cart');
        if (addCartBtn) {
            e.preventDefault();
            BundleManager.addBundleToCart();
            return;
        }

        // Buy now button
        const buyNowBtn = e.target.closest('.js-bundle-buy-now');
        if (buyNowBtn) {
            e.preventDefault();
            BundleManager.buyNow();
            return;
        }

        // Toggle floating dock drawer
        const dockToggle = e.target.closest('.js-dock-toggle');
        if (dockToggle) {
            e.preventDefault();
            const dock = document.getElementById('bundleDock');
            if (dock) dock.classList.toggle('drawer-open');
            return;
        }

        // Close dock drawer
        const dockClose = e.target.closest('.js-dock-close');
        if (dockClose) {
            e.preventDefault();
            const dock = document.getElementById('bundleDock');
            if (dock) dock.classList.remove('drawer-open');
            return;
        }
    });
});
