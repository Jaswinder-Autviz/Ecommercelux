const CartSummary = {
    init() {
        this.bindEvents();
        this.updateSummary();
    },

    bindEvents() {
        const openBtn = document.getElementById('open-coupon-modal');
        const modal = document.getElementById('coupon-modal');
        const closeBtn = document.querySelector('.close-coupon');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                modal.classList.add('active');
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.classList.remove('active');
            });
        }

        // Close on outside click
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Coupon application
        const applyBtns = document.querySelectorAll('.apply-specific-coupon');
        applyBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const code = btn.dataset.code;
                this.applyCoupon(code);
                modal.classList.remove('active');
            });
        });
    },

    applyCoupon(code) {
        // Simple mock logic for coupons
        let discount = 0;
        const subtotal = this.calculateSubtotal();

        if (code === 'HUSTLER10') {
            discount = subtotal * 0.1;
        } else if (code === 'FREESHIP') {
            // Logic handled in updateSummary
        }

        localStorage.setItem('luxe_applied_coupon', JSON.stringify({ code, discount }));
        this.updateSummary();
        alert(`Coupon ${code} applied!`);
    },

    calculateSubtotal() {
        const cart = Cart.get();
        return cart.reduce((total, item) => {
            return total + (parseFloat(item.price) || 0) * item.quantity;
        }, 0);
    },

    calculateMRP() {
        const cart = Cart.get();
        return cart.reduce((total, item) => {
            const price = item.oldPrice ? parseFloat(item.oldPrice) : parseFloat(item.price) || 0;
            return total + price * item.quantity;
        }, 0);
    },

    updateSummary() {
        const cart = Cart.get();
        const subtotal = this.calculateSubtotal();
        const mrp = this.calculateMRP();
        const discountOnMRP = mrp - subtotal;
        
        const couponData = JSON.parse(localStorage.getItem('luxe_applied_coupon')) || { code: '', discount: 0 };
        const shipping = (subtotal > 2999 || couponData.code === 'FREESHIP') ? 0 : 99;
        const finalTotal = subtotal - couponData.discount + shipping;

        // Update UI
        const summaryCount = document.getElementById('summary-count');
        const billMrp = document.getElementById('bill-mrp');
        const billDiscount = document.getElementById('bill-discount');
        const billShipping = document.getElementById('bill-shipping');
        const billTotal = document.getElementById('bill-total');
        const couponText = document.querySelector('.apply-coupon-link');

        if (summaryCount) summaryCount.textContent = cart.length;
        if (billMrp) billMrp.textContent = `₹ ${mrp.toLocaleString()}`;
        if (billDiscount) billDiscount.textContent = `-₹ ${discountOnMRP.toLocaleString()}`;
        if (billShipping) billShipping.textContent = shipping === 0 ? 'FREE' : `₹ ${shipping}`;
        if (billTotal) billTotal.textContent = `₹ ${finalTotal.toLocaleString()}`;
        
        if (couponText) {
            couponText.textContent = couponData.code ? `Coupon Applied: ${couponData.code} (-₹ ${couponData.discount})` : 'Apply Coupon';
            couponText.style.color = couponData.code ? '#1a1a1a' : '#e8353b';
        }

        // Update selected count text in main cart
        const selectedText = document.getElementById('selected-count-text');
        if (selectedText) {
            selectedText.textContent = `${cart.length}/${cart.length} ITEMS SELECTED`;
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    CartSummary.init();
});
