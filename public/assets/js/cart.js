/* ============================================================
   CART SYSTEM — cart.js
   Dedicated Wall Poster Bundle Cart (5 & 10 Poster Bundles)
   ============================================================ */

const Cart = {
    storageKey: 'luxe_cart',

    get() {
        try {
            const raw = JSON.parse(localStorage.getItem(this.storageKey)) || [];
            // Filter out any legacy loose single items - only keep valid bundles
            return raw.filter(item => item && (item.type === 'bundle' || Array.isArray(item.posters)) && item.posters?.length >= 5);
        } catch (e) {
            return [];
        }
    },

    save(cart) {
        localStorage.setItem(this.storageKey, JSON.stringify(cart));
        this.updateBadge();
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: cart }));
    },

    remove(bundleId) {
        let cart = this.get().filter(i => String(i.id) !== String(bundleId));
        this.save(cart);
        this.render();
        if (typeof Toast !== 'undefined') {
            Toast.info('Poster bundle removed from your bag.', 'Removed');
        }
    },

    clear() {
        localStorage.removeItem(this.storageKey);
        this.updateBadge();
        this.render();
    },

    updateBadge() {
        const badge = document.getElementById('cartBadge');
        if (!badge) return;
        const totalBundles = this.get().length;
        badge.textContent = totalBundles;
        badge.style.display = totalBundles > 0 ? 'flex' : 'none';

        if (window.Hustler && typeof window.Hustler.updateCartBadge === 'function') {
            window.Hustler.updateCartBadge(totalBundles);
        }
    },

    render() {
        const container = document.getElementById('cart-items-container');
        if (!container) return;

        const cart = this.get();

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="cart-empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.2" style="margin:0 auto 20px;display:block">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    <h3>Your bag is empty</h3>
                    <p>Build a 5 or 10 Wall Poster Bundle to get started.</p>
                    <a href="/shop" class="shop-now-btn">BROWSE POSTERS</a>
                </div>`;
            if (typeof CartSummary !== 'undefined') CartSummary.updateSummary();
            return;
        }

        let html = '';
        cart.forEach((bundle, index) => {
            html += this.getBundleHTML(bundle, index);
        });
        container.innerHTML = html;
        this.bindItemEvents();

        if (typeof CartSummary !== 'undefined') CartSummary.updateSummary();
    },

    getBundleHTML(bundle, index) {
        const price = parseFloat(bundle.price) || 0;
        const oldPrice = bundle.oldPrice ? parseFloat(bundle.oldPrice) : null;
        const savings = oldPrice && oldPrice > price ? oldPrice - price : 0;
        const bundleSize = bundle.bundle_size || bundle.posters?.length || 5;
        const bundleName = bundle.name || `${bundleSize} Poster Bundle (12 × 8 inches)`;

        // Render thumbnails of selected posters inside the bundle
        let postersHtml = '';
        if (Array.isArray(bundle.posters)) {
            bundle.posters.forEach((poster, pIndex) => {
                postersHtml += `
                    <div class="cbc-poster-item" title="${poster.name}">
                        <div class="cbc-poster-thumb">
                            <img src="${poster.image}" alt="${poster.name}" onerror="this.src='/assets/images/placeholders/placeholder-product.svg'">
                        </div>
                        <div class="cbc-poster-info">
                            <div class="cbc-poster-name">${poster.name}</div>
                            <div class="cbc-poster-size">12 × 8 in</div>
                        </div>
                    </div>
                `;
            });
        }

        return `
            <div class="cart-bundle-card" data-bundle-id="${bundle.id}">
                <div class="cbc-header">
                    <div>
                        <span class="cbc-badge">${bundleSize} Piece Bundle</span>
                        <h3 class="cbc-title">${bundleName}</h3>
                        <p class="cbc-subtitle">Includes ${bundleSize} unique 12 &times; 8 inch wall posters</p>
                    </div>
                    <div class="cbc-pricing">
                        <div class="cbc-current-price">&#8377; ${price.toLocaleString('en-IN')}</div>
                        ${oldPrice ? `<div class="cbc-old-price">&#8377; ${oldPrice.toLocaleString('en-IN')}</div>` : ''}
                        ${savings > 0 ? `<div class="cbc-savings">Save &#8377; ${savings.toLocaleString('en-IN')}</div>` : ''}
                    </div>
                </div>

                <div class="cbc-posters-title">Included Posters in Bundle:</div>
                <div class="cbc-posters-grid">
                    ${postersHtml}
                </div>

                <div class="cbc-footer">
                    <span class="cbc-bundle-qty">Quantity: 1 Bundle</span>
                    <button type="button" class="cbc-remove-btn js-remove-bundle" data-id="${bundle.id}">
                        <i class="fas fa-trash-alt"></i> Remove Bundle
                    </button>
                </div>
            </div>
        `;
    },

    bindItemEvents() {
        const container = document.getElementById('cart-items-container');
        if (!container) return;

        // Remove Bundle
        container.querySelectorAll('.js-remove-bundle').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const bundleId = btn.dataset.id;
                this.remove(bundleId);
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    Cart.updateBadge();
    Cart.render();

    // Remove ALL selected button
    document.getElementById('remove-selected')?.addEventListener('click', () => {
        if (Cart.get().length === 0) return;
        if (confirm('Remove all poster bundles from your bag?')) {
            Cart.clear();
        }
    });

    // Place Order -> go to checkout
    document.getElementById('place-order')?.addEventListener('click', () => {
        const cart = Cart.get();
        if (cart.length === 0) {
            if (typeof Toast !== 'undefined') {
                Toast.warning('Your bag is empty! Please add a poster bundle first.', 'Empty Bag');
            } else {
                alert('Your cart is empty!');
            }
            return;
        }
        window.location.href = '/checkout';
    });
});
