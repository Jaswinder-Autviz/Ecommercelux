const CartSummary = {
    init() {
        this.bindEvents();
        this.updateSummary();
    },

    bindEvents() {
        window.addEventListener('cart:updated', () => {
            this.updateSummary();
        });
    },

    calculateSubtotal() {
        const cart = typeof Cart !== 'undefined' ? Cart.get() : [];
        return cart.reduce((total, item) => {
            return total + (parseFloat(item.price) || 0) * (item.quantity || 1);
        }, 0);
    },

    calculateMRP() {
        const cart = typeof Cart !== 'undefined' ? Cart.get() : [];
        return cart.reduce((total, item) => {
            const price = item.oldPrice ? parseFloat(item.oldPrice) : (parseFloat(item.price) || 0);
            return total + price * (item.quantity || 1);
        }, 0);
    },

    updateSummary() {
        const cart = typeof Cart !== 'undefined' ? Cart.get() : [];
        const subtotal = this.calculateSubtotal();
        const mrp = this.calculateMRP();
        const discountOnMRP = Math.max(0, mrp - subtotal);
        const finalTotal = subtotal;

        // Update UI
        const summaryCount = document.getElementById('summary-count');
        const billMrp = document.getElementById('bill-mrp');
        const billDiscount = document.getElementById('bill-discount');
        const billTotal = document.getElementById('bill-total');

        if (summaryCount) summaryCount.textContent = cart.length;
        if (billMrp) billMrp.textContent = `₹ ${mrp.toLocaleString('en-IN')}`;
        if (billDiscount) billDiscount.textContent = `-₹ ${discountOnMRP.toLocaleString('en-IN')}`;
        if (billTotal) billTotal.textContent = `₹ ${finalTotal.toLocaleString('en-IN')}`;

        // Update selected count text in main cart
        const selectedText = document.getElementById('selected-count-text');
        if (selectedText) {
            selectedText.textContent = `${cart.length}/${cart.length} BUNDLE${cart.length === 1 ? '' : 'S'} SELECTED`;
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    CartSummary.init();
});
