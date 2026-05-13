<div class="cart-item" data-id="{{ $product['id'] }}" data-size="{{ $size }}">
    <div class="ci-left">
        <label class="ci-checkbox">
            <input type="checkbox" class="ci-check-input" checked>
            <span class="ci-checkmark"></span>
        </label>
        <div class="ci-img-wrap">
            <img src="{{ asset('assets/images/products/' . $product['images'][0]) }}" alt="{{ $product['title'] }}">
        </div>
        <div class="ci-details">
            <h3 class="ci-title">{{ $product['title'] }}</h3>
            <p class="ci-subtitle">{{ $product['subtitle'] }}</p>
            <div class="ci-meta">
                <span class="ci-size">Size: <strong>{{ $size }}</strong></span>
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
            <div class="ci-current-price">₹ {{ number_format($product['price']) }}</div>
            @if(isset($product['oldPrice']))
                <div class="ci-old-price">₹ {{ number_format($product['oldPrice']) }}</div>
                <div class="ci-savings">Save ₹ {{ number_format($product['oldPrice'] - $product['price']) }}</div>
            @endif
        </div>
        <div class="ci-qty-wrap">
            <select class="ci-qty-select">
                @for($i=1; $i<=10; $i++)
                    <option value="{{ $i }}" {{ $quantity == $i ? 'selected' : '' }}>Qty: {{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="ci-total">
            ₹ {{ number_format($product['price'] * $quantity) }}
        </div>
    </div>
</div>
