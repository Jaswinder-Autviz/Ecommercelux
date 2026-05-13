/* ============================================================
   WISHLIST — wishlist.js
   localStorage based, no backend required
   ============================================================ */

const Wishlist = {
    storageKey: 'luxe_wishlist',

    get() {
        try { return JSON.parse(localStorage.getItem(this.storageKey)) || []; }
        catch(e) { return []; }
    },

    save(list) {
        localStorage.setItem(this.storageKey, JSON.stringify(list));
        this.updateBadge();
    },

    has(productId) {
        return this.get().some(i => i.id == productId);
    },

    toggle(product) {
        let list = this.get();
        const idx = list.findIndex(i => i.id == product.id);
        if (idx > -1) {
            list.splice(idx, 1);
        } else {
            list.push(product);
        }
        this.save(list);
        return idx === -1; // true = added
    },

    remove(productId) {
        let list = this.get().filter(i => i.id != productId);
        this.save(list);
    },

    updateBadge() {
        const badge = document.getElementById('wishlistBadge');
        if (!badge) return;
        const count = this.get().length;
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    },

    render() {
        const container = document.getElementById('wishlist-container');
        if (!container) return;

        const list = this.get();

        if (list.length === 0) {
            container.innerHTML = `
                <div class="wl-empty">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <h3>Your wishlist is empty</h3>
                    <p>Save items you love and find them here anytime.</p>
                    <a href="/shop" class="wl-shop-btn">Discover Products</a>
                </div>`;
            return;
        }

        let html = `<div class="wl-grid">`;
        list.forEach(item => {
            html += `
            <div class="wl-card" data-id="${item.id}">
                <a href="${item.url}" class="wl-card-img-wrap">
                    <img src="${item.image}" alt="${item.name}" class="wl-card-img">
                </a>
                <button class="wl-remove" data-id="${item.id}" title="Remove">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </button>
                <div class="wl-card-body">
                    <p class="wl-card-cat">${item.category || ''}</p>
                    <h3 class="wl-card-name">${item.name}</h3>
                    <p class="wl-card-price">${item.price}</p>
                    <a href="${item.url}" class="wl-card-btn">View Product</a>
                </div>
            </div>`;
        });
        html += `</div>`;
        container.innerHTML = html;

        // Bind remove buttons
        container.querySelectorAll('.wl-remove').forEach(btn => {
            btn.addEventListener('click', () => {
                Wishlist.remove(btn.dataset.id);
                btn.closest('.wl-card').style.opacity = '0';
                btn.closest('.wl-card').style.transform = 'scale(0.95)';
                setTimeout(() => Wishlist.render(), 300);
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    Wishlist.updateBadge();
    Wishlist.render();

    // Handle wishlist toggle buttons on product cards / product page
    document.addEventListener('click', e => {
        const btn = e.target.closest('.wl-toggle-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();

        const product = {
            id:       btn.dataset.id,
            name:     btn.dataset.name,
            price:    btn.dataset.price,
            image:    btn.dataset.image,
            url:      btn.dataset.url,
            category: btn.dataset.category || '',
        };

        const added = Wishlist.toggle(product);
        btn.classList.toggle('wl-active', added);

        // Swap icon fill
        const path = btn.querySelector('path');
        if (path) path.setAttribute('fill', added ? 'currentColor' : 'none');

        // Toast
        showWishlistToast(added ? `Added to Wishlist` : `Removed from Wishlist`);
    });
});

function showWishlistToast(msg) {
    let toast = document.getElementById('wl-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'wl-toast';
        toast.style.cssText = `
            position:fixed; bottom:28px; left:50%; transform:translateX(-50%) translateY(20px);
            background:#292b2c; color:#fff; padding:12px 28px; font-size:13px; font-weight:600;
            letter-spacing:.5px; z-index:99999; opacity:0; transition:all .3s ease;
            white-space:nowrap; pointer-events:none;
        `;
        document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    toast.style.transform = 'translateX(-50%) translateY(0)';
    clearTimeout(toast._timer);
    toast._timer = setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(-50%) translateY(20px)';
    }, 2200);
}
