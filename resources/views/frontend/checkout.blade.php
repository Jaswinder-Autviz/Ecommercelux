@extends('frontend.layouts.app')

@section('title', 'Checkout - LuxeStore')

@section('content')
<div class="co-page">
    <div class="container">

        <div class="co-header">
            <h1 class="co-title">CHECKOUT</h1>
            <div class="co-steps">
                <span class="co-step active">1. Details</span>
                <span class="co-step-line"></span>
                <span class="co-step active">2. Payment</span>
            </div>
        </div>

        <div class="co-layout">

            {{-- LEFT: Form --}}
            <div class="co-left">

                {{-- Contact --}}
                <div class="co-section">
                    <h2 class="co-section-title">Contact Information</h2>
                    <div class="co-grid-2">
                        <div class="co-field">
                            <label>Full Name *</label>
                            <input type="text" id="co_name" placeholder="Rahul Sharma" required>
                        </div>
                        <div class="co-field">
                            <label>Phone Number *</label>
                            <input type="tel" id="co_phone" placeholder="+91 98765 43210" required>
                        </div>
                    </div>
                    <div class="co-field">
                        <label>Email Address *</label>
                        <input type="email" id="co_email" placeholder="rahul@example.com" required>
                    </div>
                </div>

                {{-- Shipping --}}
                <div class="co-section">
                    <h2 class="co-section-title">Shipping Address</h2>
                    <div class="co-field">
                        <label>Address *</label>
                        <input type="text" id="co_address" placeholder="House No, Street, Area" required>
                    </div>
                    <div class="co-grid-3">
                        <div class="co-field">
                            <label>City *</label>
                            <input type="text" id="co_city" placeholder="Mumbai" required>
                        </div>
                        <div class="co-field">
                            <label>State *</label>
                            <input type="text" id="co_state" placeholder="Maharashtra" required>
                        </div>
                        <div class="co-field">
                            <label>PIN Code *</label>
                            <input type="text" id="co_pin" placeholder="400001" required>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="co-section">
                    <h2 class="co-section-title">Payment Method</h2>
                    <div class="co-pay-methods">

                        <label class="co-pay-option active" data-method="googlepay">
                            <input type="radio" name="payment_method" value="googlepay" checked>
                            <div class="co-pay-icon">
                                <svg width="28" height="28" viewBox="0 0 48 48"><text y="36" font-size="36">G</text></svg>
                            </div>
                            <div class="co-pay-info">
                                <span class="co-pay-name">Google Pay</span>
                                <span class="co-pay-desc">Pay via UPI using Google Pay</span>
                            </div>
                            <div class="co-pay-check"><i class="fas fa-check-circle"></i></div>
                        </label>

                        <label class="co-pay-option" data-method="upi">
                            <input type="radio" name="payment_method" value="upi">
                            <div class="co-pay-icon" style="background:#f0f4ff">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect width="24" height="24" rx="4" fill="#097939"/><text x="3" y="17" font-size="10" fill="#fff" font-weight="bold">UPI</text></svg>
                            </div>
                            <div class="co-pay-info">
                                <span class="co-pay-name">UPI / PhonePe / Paytm</span>
                                <span class="co-pay-desc">Any UPI app on your phone</span>
                            </div>
                            <div class="co-pay-check"><i class="fas fa-check-circle"></i></div>
                        </label>

                        <label class="co-pay-option" data-method="card">
                            <input type="radio" name="payment_method" value="card">
                            <div class="co-pay-icon" style="background:#fff3e0">
                                <i class="fas fa-credit-card" style="color:#e65100;font-size:20px"></i>
                            </div>
                            <div class="co-pay-info">
                                <span class="co-pay-name">Credit / Debit Card</span>
                                <span class="co-pay-desc">Visa, Mastercard, RuPay</span>
                            </div>
                            <div class="co-pay-check"><i class="fas fa-check-circle"></i></div>
                        </label>

                        <label class="co-pay-option" data-method="netbanking">
                            <input type="radio" name="payment_method" value="netbanking">
                            <div class="co-pay-icon" style="background:#e8f5e9">
                                <i class="fas fa-university" style="color:#2e7d32;font-size:20px"></i>
                            </div>
                            <div class="co-pay-info">
                                <span class="co-pay-name">Net Banking</span>
                                <span class="co-pay-desc">All major Indian banks</span>
                            </div>
                            <div class="co-pay-check"><i class="fas fa-check-circle"></i></div>
                        </label>

                        <label class="co-pay-option" data-method="cod">
                            <input type="radio" name="payment_method" value="cod">
                            <div class="co-pay-icon" style="background:#fce4ec">
                                <i class="fas fa-money-bill-wave" style="color:#c62828;font-size:20px"></i>
                            </div>
                            <div class="co-pay-info">
                                <span class="co-pay-name">Cash on Delivery</span>
                                <span class="co-pay-desc">Pay when you receive</span>
                            </div>
                            <div class="co-pay-check"><i class="fas fa-check-circle"></i></div>
                        </label>

                    </div>
                </div>

            </div>

            {{-- RIGHT: Order Summary --}}
            <div class="co-right">
                <div class="co-summary">
                    <h2 class="co-section-title">Order Summary</h2>
                    <div id="co-items" class="co-items"></div>
                    <div class="co-summary-rows">
                        <div class="co-row"><span>Subtotal</span><span id="co-subtotal">₹0</span></div>
                        <div class="co-row"><span>Shipping</span><span class="text-green-600">FREE</span></div>
                        <div class="co-row co-row-total"><span>Total</span><span id="co-total">₹0</span></div>
                    </div>
                    <button id="co-pay-btn" class="co-pay-btn" onclick="initiatePayment()">
                        <i class="fas fa-lock mr-2"></i>
                        <span id="co-pay-btn-text">Pay Now</span>
                    </button>
                    <p class="co-secure-note">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Secured by Razorpay · 256-bit SSL
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.co-page { padding: 50px 0 100px; background: #fafafa; min-height: 80vh; }
.co-header { text-align: center; margin-bottom: 40px; }
.co-title { font-size: 26px; font-weight: 900; letter-spacing: 2px; color: #292b2c; margin-bottom: 14px; }
.co-steps { display: flex; align-items: center; justify-content: center; gap: 12px; }
.co-step { font-size: 12px; font-weight: 700; letter-spacing: 1px; color: #e8353b; text-transform: uppercase; }
.co-step-line { width: 40px; height: 1px; background: #ddd; }

.co-layout { display: grid; grid-template-columns: 1fr 400px; gap: 32px; align-items: start; }

.co-section { background: #fff; border: 1px solid #ebebeb; padding: 28px; margin-bottom: 20px; }
.co-section-title { font-size: 13px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: #292b2c; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f0f0f0; }

.co-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.co-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
.co-field { margin-bottom: 16px; }
.co-field label { display: block; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #666; margin-bottom: 7px; }
.co-field input { width: 100%; padding: 12px 14px; border: 1.5px solid #e0e0e0; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; background: #fff; }
.co-field input:focus { border-color: #292b2c; }

/* Payment options */
.co-pay-methods { display: flex; flex-direction: column; gap: 10px; }
.co-pay-option { display: flex; align-items: center; gap: 14px; padding: 14px 16px; border: 1.5px solid #e0e0e0; cursor: pointer; transition: all 0.2s; background: #fff; }
.co-pay-option input[type="radio"] { display: none; }
.co-pay-option.active { border-color: #292b2c; background: #fafafa; }
.co-pay-icon { width: 44px; height: 44px; border-radius: 10px; background: #f0f9f0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.co-pay-info { flex: 1; }
.co-pay-name { display: block; font-size: 14px; font-weight: 700; color: #292b2c; margin-bottom: 2px; }
.co-pay-desc { font-size: 11px; color: #999; }
.co-pay-check { color: #e8353b; font-size: 18px; opacity: 0; transition: opacity 0.2s; }
.co-pay-option.active .co-pay-check { opacity: 1; }

/* Summary */
.co-summary { background: #fff; border: 1px solid #ebebeb; padding: 28px; position: sticky; top: 90px; }
.co-items { margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 20px; }
.co-item { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
.co-item-img { width: 52px; height: 52px; object-fit: cover; background: #f4f4f4; flex-shrink: 0; }
.co-item-info { flex: 1; }
.co-item-name { font-size: 13px; font-weight: 700; color: #292b2c; }
.co-item-size { font-size: 11px; color: #999; }
.co-item-price { font-size: 13px; font-weight: 700; color: #292b2c; }
.co-summary-rows { margin-bottom: 24px; }
.co-row { display: flex; justify-content: space-between; font-size: 14px; color: #555; margin-bottom: 10px; }
.co-row-total { font-size: 16px; font-weight: 800; color: #292b2c; padding-top: 12px; border-top: 1px solid #ebebeb; margin-top: 4px; }
.co-pay-btn { width: 100%; height: 52px; background: #292b2c; color: #fff; border: none; font-size: 13px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
.co-pay-btn:hover { background: #e8353b; }
.co-pay-btn:disabled { opacity: 0.6; cursor: not-allowed; }
.co-secure-note { text-align: center; font-size: 11px; color: #aaa; margin-top: 12px; }

@media (max-width: 1024px) { .co-layout { grid-template-columns: 1fr; } .co-summary { position: static; } }
@media (max-width: 640px) { .co-grid-2, .co-grid-3 { grid-template-columns: 1fr; } }
</style>
@endpush

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('luxe_cart') || '[]');
    const itemsEl    = document.getElementById('co-items');
    const subtotalEl = document.getElementById('co-subtotal');
    const totalEl    = document.getElementById('co-total');
    const payBtn     = document.getElementById('co-pay-btn');
    const payBtnText = document.getElementById('co-pay-btn-text');

    // ── Render cart items + calculate total ──────────────────
    if (!cart.length) {
        itemsEl.innerHTML = '<p style="color:#999;font-size:13px;text-align:center;padding:20px 0">Your cart is empty. <a href="/shop">Shop Now</a></p>';
        if (payBtn) payBtn.disabled = true;
        return;
    }

    let subtotal = 0;
    let html = '';

    cart.forEach(item => {
        const price = parseFloat(item.price) || 0;
        subtotal += price * item.quantity;
        html += `
        <div class="co-item">
            <img src="${item.image || ''}" alt="${item.name}" class="co-item-img"
                 onerror="this.style.background='#f4f4f4';this.src=''">
            <div class="co-item-info">
                <div class="co-item-name">${item.name}</div>
                <div class="co-item-size">Size: ${item.size} &middot; Qty: ${item.quantity}</div>
            </div>
            <div class="co-item-price">₹${(price * item.quantity).toLocaleString('en-IN')}</div>
        </div>`;
    });

    itemsEl.innerHTML = html;
    subtotalEl.textContent = '₹' + subtotal.toLocaleString('en-IN');
    totalEl.textContent    = '₹' + subtotal.toLocaleString('en-IN');
    if (payBtnText) payBtnText.textContent = 'Pay ₹' + subtotal.toLocaleString('en-IN');

    // Store total for payment
    window._cartTotal = subtotal;

    // ── Payment method selection ─────────────────────────────
    document.querySelectorAll('.co-pay-option').forEach(opt => {
        opt.addEventListener('click', () => {
            document.querySelectorAll('.co-pay-option').forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
            opt.querySelector('input').checked = true;
        });
    });
});

async function submitCheckoutOrder(payload) {
    const res = await fetch('/payment/submit-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(payload),
    });
    return res.json();
}

async function initiatePayment() {
    const name  = document.getElementById('co_name').value.trim();
    const email = document.getElementById('co_email').value.trim();
    const phone = document.getElementById('co_phone').value.trim();
    const addr  = document.getElementById('co_address').value.trim();
    const city  = document.getElementById('co_city').value.trim();
    const state = document.getElementById('co_state').value.trim();
    const pin   = document.getElementById('co_pin').value.trim();

    if (!name || !email || !phone || !addr || !city || !state || !pin) {
        alert('Please fill in all required fields.');
        return;
    }

    const method  = document.querySelector('input[name="payment_method"]:checked').value;
    const amount  = window._cartTotal || 0;
    const btn     = document.getElementById('co-pay-btn');
    const btnText = document.getElementById('co-pay-btn-text');

    if (amount <= 0) {
        alert('Cart is empty!');
        return;
    }

    btn.disabled = true;
    btnText.textContent = 'Processing...';

    const cartItems = JSON.parse(localStorage.getItem('luxe_cart') || '[]').map(item => ({
        product_id: item.product_id || item.id || null,
        product_name: item.name || 'Item',
        quantity: item.quantity || 1,
        price: item.price || 0,
        size: item.size || null,
    }));

    const orderPayload = {
        name,
        email,
        phone,
        address: addr,
        city,
        state,
        pin,
        method,
        amount,
        items: cartItems,
    };

    if (method === 'cod') {
        try {
            const submitData = await submitCheckoutOrder(orderPayload);
            if (!submitData.success) throw new Error(submitData.message || 'Unable to create order.');
            localStorage.removeItem('luxe_cart');
            window.location.href = '/payment/success?method=cod&order=' + encodeURIComponent(submitData.order_number);
            return;
        } catch (e) {
            alert('Error: ' + e.message);
            btn.disabled = false;
            btnText.textContent = 'Pay ₹' + amount.toLocaleString('en-IN');
            return;
        }
    }

    try {
        const res = await fetch('/payment/create-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ amount, name, email, phone }),
        });

        const data = await res.json();
        if (!data.success) throw new Error(data.message);

        const options = {
            key:         data.key,
            amount:      data.amount,
            currency:    data.currency,
            order_id:    data.order_id,
            name:        'LuxeStore',
            description: 'Order Payment',
            prefill:     { name: data.name, email: data.email, contact: data.phone },
            theme:       { color: '#e8353b' },
            handler: async function(response) {
                try {
                    const vRes = await fetch('/payment/verify', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            razorpay_order_id:   response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature:  response.razorpay_signature,
                        }),
                    });
                    const vData = await vRes.json();
                    if (!vData.success) throw new Error('Payment verification failed.');

                    orderPayload.payment_id = response.razorpay_payment_id;
                    const submitData = await submitCheckoutOrder(orderPayload);
                    if (!submitData.success) throw new Error(submitData.message || 'Unable to create order.');

                    localStorage.removeItem('luxe_cart');
                    window.location.href = '/payment/success?payment_id=' + response.razorpay_payment_id + '&order=' + encodeURIComponent(submitData.order_number);
                } catch (error) {
                    alert('Error: ' + error.message + '. Please contact support.');
                    btn.disabled = false;
                    btnText.textContent = 'Pay ₹' + amount.toLocaleString('en-IN');
                }
            },
            modal: {
                ondismiss: function() {
                    btn.disabled = false;
                    btnText.textContent = 'Pay ₹' + amount.toLocaleString('en-IN');
                }
            }
        };

        new Razorpay(options).open();

    } catch (e) {
        alert('Error: ' + e.message);
        btn.disabled = false;
        btnText.textContent = 'Pay ₹' + amount.toLocaleString('en-IN');
    }
}
</script>
@endpush
