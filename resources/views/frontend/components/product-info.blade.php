<div class="product-info">
    <script>
        window.currentProduct = {
            id:       {{ $product->id }},
            name:     "{{ addslashes($product->name) }}",
            slug:     "{{ $product->slug }}",
            image:    "{{ asset('assets/images/products/' . $product->main_image) }}",
            price:    {{ $product->discount_price ?? $product->price }},
            oldPrice: {{ $product->discount_price ? $product->price : 'null' }}
        };
    </script>

    {{-- Breadcrumb / Subtitle --}}
    <span class="pi-subtitle">{{ $product->category->name ?? 'Wall Art' }} &bull; Wall Poster</span>

    {{-- Title (Black / Dark) --}}
    <h1 class="pi-title">{{ $product->name }}</h1>

    {{-- Price Section --}}
    <div class="pi-price">
        @if($product->discount_price)
            <span class="pi-price-new">&#8377; {{ number_format($product->discount_price) }}</span>
            <span class="pi-price-old">&#8377; {{ number_format($product->price) }}</span>
            <span class="pi-discount-badge">Save &#8377; {{ number_format($product->price - $product->discount_price) }}</span>
        @else
            <span class="pi-price-new">&#8377; {{ number_format($product->price) }}</span>
        @endif
    </div>

    {{-- Bundle Notice Banner --}}
    <div class="bundle-notice-pill">
        <i class="fas fa-layer-group"></i>
        <span>Sold exclusively in <strong>5 or 10 Poster Bundles</strong>. Build your bundle below.</span>
    </div>

    {{-- Fixed Size Display (12 x 8 inches ONLY) --}}
    <div class="poster-spec-box">
        <div class="spec-item">
            <span class="spec-label">Poster Size</span>
            <span class="spec-value highlight-size"><i class="fas fa-ruler-combined"></i> 12 &times; 8 inches</span>
        </div>
        <div class="spec-item">
            <span class="spec-label">Paper Quality</span>
            <span class="spec-value"><i class="fas fa-scroll"></i> 300 GSM Archival Matte</span>
        </div>
        <div class="spec-item">
            <span class="spec-label">Finish</span>
            <span class="spec-value"><i class="fas fa-check-double"></i> Anti-Glare Museum Print</span>
        </div>
    </div>

    {{-- BUNDLE SELECTION BUILDER --}}
    <div class="bundle-builder-card">
        <div class="bbc-header">
            <div class="bbc-header-title">
                <span class="bbc-tag">Step 1</span>
                <strong>Choose Bundle Type</strong>
            </div>
            <div class="bundle-size-toggle">
                <button type="button" class="bundle-size-btn js-bundle-size-btn active" data-size="5">
                    5 Poster Bundle
                </button>
                <button type="button" class="bundle-size-btn js-bundle-size-btn" data-size="10">
                    10 Poster Bundle
                </button>
            </div>
        </div>

        {{-- Add Current Poster to Bundle Button --}}
        <div class="bbc-add-current">
            <button type="button" class="btn-add-poster js-add-current-poster">
                <i class="fas fa-plus-circle"></i> Add This Poster to Bundle
            </button>
            <button class="pi-wishlist-btn wl-toggle-btn" type="button"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="₹{{ number_format($product->discount_price ?? $product->price) }}"
                data-image="{{ asset('assets/images/products/' . $product->main_image) }}"
                data-url="{{ route('products.show', $product->slug) }}"
                data-category="{{ $product->category->name ?? '' }}"
                title="Wishlist">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>
        </div>

        {{-- Bundle Progress Section --}}
        <div class="bbc-progress-wrap">
            <div class="bbc-progress-header">
                <span class="bbc-count-label js-bundle-count-text">Selected: 0 / 5 Posters</span>
                <span class="bbc-progress-text js-bundle-progress-text">0 of 5 posters selected</span>
            </div>
            <div class="bbc-progress-track">
                <div class="bbc-progress-fill js-bundle-progress-fill" style="width: 0%;"></div>
            </div>
        </div>

        {{-- Selected Posters Thumbnail Drawer / Tray --}}
        <div class="bbc-tray">
            <div class="bbc-tray-title">Selected Posters in this Bundle:</div>
            <div class="bundle-slots-grid js-bundle-thumbnails">
                {{-- Dynamically populated by BundleManager.syncUI() --}}
            </div>
            <div class="bbc-browse-row">
                <a href="{{ route('shop') }}" class="bbc-browse-link">
                    <i class="fas fa-search-plus"></i> Browse more posters to complete bundle &rarr;
                </a>
            </div>
        </div>

        {{-- Action Buttons: Add Bundle to Cart & Buy Now --}}
        <div class="bbc-actions">
            <button type="button" class="btn-bundle-cart js-bundle-add-cart disabled" disabled>
                <i class="fas fa-shopping-bag"></i> ADD BUNDLE TO CART
            </button>
            <button type="button" class="btn-bundle-buy js-bundle-buy-now disabled" disabled>
                <i class="fas fa-bolt"></i> BUY NOW
            </button>
        </div>
        <p class="bbc-help-note">
            <i class="fas fa-shield-alt"></i> Exactly 5 or 10 unique posters required per bundle. No duplicate posters allowed.
        </p>
    </div>

    {{-- Product Description & Details Accordion --}}
    <div class="pi-accordion">
        <div class="pi-acc-item active">
            <button class="pi-acc-btn" type="button">Product Description</button>
            <div class="pi-acc-content">
                <p>{{ $product->short_description }}</p>
                @if($product->full_description)
                    <div style="margin-top:10px">{!! $product->full_description !!}</div>
                @endif
            </div>
        </div>
        <div class="pi-acc-item">
            <button class="pi-acc-btn" type="button">Poster Specifications</button>
            <div class="pi-acc-content">
                <ul class="pi-spec-list">
                    <li><strong>Size:</strong> 12 &times; 8 inches</li>
                    <li><strong>Paper Stock:</strong> 300 GSM Heavyweight Archival Matte Paper</li>
                    <li><strong>SKU:</strong> {{ $product->sku }}</li>
                    <li><strong>Category:</strong> {{ $product->category->name ?? 'Wall Art' }}</li>
                    <li><strong>Packaging:</strong> Flat reinforced cardboard envelope with protective sleeve</li>
                </ul>
            </div>
        </div>
    </div>
</div>
