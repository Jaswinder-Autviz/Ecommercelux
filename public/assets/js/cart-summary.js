const CartSummary = {
    init() {
        this.bindEvents();
        this.updateSummary();
    },

    bindEvents() {},

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
        
        const finalTotal = subtotal;

        // Update UI
        const summaryCount = document.getElementById('summary-count');
        const billMrp = document.getElementById('bill-mrp');
        const billDiscount = document.getElementById('bill-discount');
        const billTotal = document.getElementById('bill-total');

        if (summaryCount) summaryCount.textContent = cart.length;
        if (billMrp) billMrp.textContent = `₹ ${mrp.toLocaleString()}`;
        if (billDiscount) billDiscount.textContent = `-₹ ${discountOnMRP.toLocaleString()}`;
        if (billTotal) billTotal.textContent = `₹ ${finalTotal.toLocaleString()}`;
        
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
