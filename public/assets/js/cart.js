const Cart = {
    storageKey: 'luxe_cart',

    get() {
        try { return JSON.parse(localStorage.getItem(this.storageKey)) || []; }
        catch(e) { return []; }
    },

    save(cart) {
        localStorage.setItem(this.storageKey, JSON.stringify(cart));
        this.updateBadge();
    },

    add(product, size, quantity = 1) {
        let cart = this.get();
        const existing = cart.find(i => i.id == product.id && i.size === size);
        if (existing) {
            existing.quantity += quantity;
        } else {
            cart.push({
                id:       product.id,
                name:     product.name,
                image:    product.image,
                price:    product.price,
                oldPrice: product.oldPrice || null,
                size:     size,
                quantity: quantity,
            });
        }
        this.save(cart);
        return true;
    },

    updateQty(id, size, quantity) {
        let cart = this.get();
        const item = cart.find(i => i.id == id && i.size === size);
        if (item) { item.quantity = parseInt(quantity); this.save(cart); }
    },

    remove(id, size) {
        let cart = this.get().filter(i => !(i.id == id && i.size === size));
        this.save(cart);
    },

    clear() {
        localStorage.removeItem(this.storageKey);
        this.updateBadge();
    },

    updateBadge() {
        const badge = document.getElementById('cartBadge');
        if (!badge) return;
        const total = this.get().reduce((sum, i) => sum + i.quantity, 0);
        badge.textContent = total;
        badge.style.display = total > 0 ? 'flex' : 'none';
    },

    render() {
        const container = document.getElementById('cart-items-container');
        if (!container) return;

        const cart = this.get();

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="cart-empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.2" style="margin:0 auto 20px;display:block">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    <h3 style="font-size:18px;font-weight:700;margin-bottom:8px">Your bag is empty</h3>
                    <p style="color:#999;margin-bottom:24px">Add items to your bag to continue shopping.</p>
                    <a href="/shop" class="shop-now-btn">SHOP NOW</a>
                </div>`;
            if (typeof CartSummary !== 'undefined') CartSummary.updateSummary();
            return;
        }

        let html = '';
        cart.forEach(item => { html += this.getItemHTML(item); });
        container.innerHTML = html;
        this.bindItemEvents();
        if (typeof CartSummary !== 'undefined') CartSummary.updateSummary();
    },

    getItemHTML(item) {
        const price    = parseFloat(item.price) || 0;
        const oldPrice = item.oldPrice ? parseFloat(item.oldPrice) : null;
        const savings  = oldPrice && oldPrice > price ? oldPrice - price : 0;
        const total    = price * item.quantity;
        const img      = item.image || '';
        const name     = item.name || 'Product';

        return `
        <div class="cart-item" data-id="${item.id}" data-size="${item.size}">
            <div class="ci-left">
                <div class="ci-img-wrap">
                    <img src="${img}" alt="${name}" style="width:100%;height:100%;object-fit:cover">
                </div>
                <div class="ci-details">
                    <h3 class="ci-title">${name}</h3>
                    <div class="ci-meta">
                        <span class="ci-size">Size: <strong>${item.size}</strong></span>
                    </div>
                    <div class="ci-actions">
                        <button class="ci-action-btn move-wishlist">Move to Wishlist</button>
                        <span class="ci-divider">|</span>
                        <button class="ci-action-btn remove-item">Remove</button>
                    </div>
                </div>
            </div>
            <div class="ci-right">
                <div class="ci-price-wrap">
                    <div class="ci-current-price">₹ ${price.toLocaleString('en-IN')}</div>
                    ${oldPrice ? `<div class="ci-old-price">₹ ${oldPrice.toLocaleString('en-IN')}</div>` : ''}
                    ${savings > 0 ? `<div class="ci-savings">Save ₹ ${savings.toLocaleString('en-IN')}</div>` : ''}
                </div>
                <div class="ci-qty-wrap">
                    <select class="ci-qty-select">
                        ${[1,2,3,4,5,6,7,8,9,10].map(q =>
                            `<option value="${q}" ${item.quantity == q ? 'selected' : ''}>Qty: ${q}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="ci-total">₹ ${total.toLocaleString('en-IN')}</div>
            </div>
        </div>`;
    },

    bindItemEvents() {
        const container = document.getElementById('cart-items-container');
        if (!container) return;

        // Qty change
        container.querySelectorAll('.ci-qty-select').forEach(select => {
            select.addEventListener('change', (e) => {
                const el = e.target.closest('.cart-item');
                this.updateQty(el.dataset.id, el.dataset.size, e.target.value);
                this.render();
            });
        });

        // Remove single item
        container.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const el = e.target.closest('.cart-item');
                this.remove(el.dataset.id, el.dataset.size);
                this.render();
            });
        });

        // Move to wishlist
        container.querySelectorAll('.move-wishlist').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const el   = e.target.closest('.cart-item');
                const item = this.get().find(i => i.id == el.dataset.id && i.size === el.dataset.size);
                if (item && typeof Wishlist !== 'undefined') {
                    Wishlist.toggle({
                        id:    item.id,
                        name:  item.name,
                        price: '₹' + item.price,
                        image: item.image,
                        url:   ''
                    });
                }
                this.remove(el.dataset.id, el.dataset.size);
                this.render();
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    Cart.updateBadge();
    Cart.render();

    // Remove ALL selected button
    document.getElementById('remove-selected')?.addEventListener('click', () => {
        if (confirm('Remove all items from cart?')) {
            Cart.clear();
            Cart.render();
        }
    });

    // Place Order → go to checkout
    document.getElementById('place-order')?.addEventListener('click', () => {
        if (Cart.get().length === 0) {
            alert('Your cart is empty!');
            return;
        }
        window.location.href = '/checkout';
    });

    // ── Product Page: Add to Cart & Buy Now ──────────────────
    document.addEventListener('click', (e) => {
        const isAddToCart = e.target.closest('.pi-add-to-cart');
        const isBuyNow    = e.target.closest('.pi-buy-now');
        if (!isAddToCart && !isBuyNow) return;

        // Size validation
        const selectedSize = document.querySelector('.pi-shoe-btn.active')?.dataset.size;
        const sizeError    = document.getElementById('sizeError');

        if (!selectedSize) {
            if (sizeError) {
                sizeError.style.display = 'block';
                document.querySelector('.pi-shoe-size')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }

        if (sizeError) sizeError.style.display = 'none';

        const qty     = parseInt(document.querySelector('.pi-qty-input')?.value) || 1;
        const product = window.currentProduct;
        if (!product) return;

        Cart.add(product, selectedSize, qty);

        // Both Add to Cart AND Buy Now → go to cart page
        // On cart page, user clicks "Place Order" to go to checkout
        window.location.href = '/cart';
    });
});
