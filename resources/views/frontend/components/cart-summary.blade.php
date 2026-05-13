<div class="cart-summary-card">
    <div class="cs-block">
        <h3 class="cs-title">COUPONS</h3>
        <div class="cs-coupon-btn" id="open-coupon-modal">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 5l-1.761 4.239L9 11l4.239 1.761L15 17l1.761-4.239L21 11l-4.239-1.761L15 5zM5 3L3.5 6.5 0 8l3.5 1.5L5 13l1.5-3.5L10 8 6.5 6.5 5 3z"/></svg>
            Apply Coupons
            <button class="apply-link">APPLY</button>
        </div>
    </div>

    <!-- Coupon Modal Overlay -->
    <div id="coupon-modal" class="coupon-modal">
        <div class="coupon-modal-content">
            @include('frontend.components.cart-coupon')
        </div>
    </div>

    <div class="cs-block">
        <h3 class="cs-title">GIFTING & PERSONALIZATION</h3>
        <div class="cs-gift-box">
            <div class="gift-icon">🎁</div>
            <div class="gift-text">
                <strong>Buying for a loved one?</strong>
                <p>Gift wrap and personalised message on card.</p>
            </div>
            <button class="gift-add-btn">ADD NOW</button>
        </div>
    </div>

    <div class="cs-block billing-details">
        <h3 class="cs-title">PRICE DETAILS (<span id="summary-count">0</span> Items)</h3>
        <div class="bill-row">
            <span>Total MRP</span>
            <span id="bill-mrp">₹ 0</span>
        </div>
        <div class="bill-row">
            <span>Discount on MRP</span>
            <span class="text-success" id="bill-discount">-₹ 0</span>
        </div>
        <div class="bill-row">
            <span>Coupon Discount</span>
            <span class="apply-coupon-link">Apply Coupon</span>
        </div>
        <div class="bill-row">
            <span>Shipping Fee</span>
            <span id="bill-shipping">FREE</span>
        </div>
        <div class="bill-total">
            <strong>Total Amount</strong>
            <strong id="bill-total">₹ 0</strong>
        </div>
    </div>

    <button class="place-order-btn" id="place-order">
        <i class="fas fa-lock" style="margin-right:8px;font-size:12px"></i> PLACE ORDER
    </button>
</div>
