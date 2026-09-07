<div class="product-info">
    <style>
        .poster-option-group { margin-top: 18px; }
        .poster-option-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #111;
            margin-bottom: 10px;
        }
        .poster-option-row {
            display: flex;
            gap: 10px;
            margin-top: 8px;
            flex-wrap: wrap;
        }
        .poster-option-btn {
            min-width: 120px;
            border: 1px solid #cfcfcf;
            background: #efefef;
            color: #111;
            padding: 14px 12px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .poster-option-btn.active {
            background: #fff;
            border: 1px solid #111;
            box-shadow: inset 0 0 0 1px #111;
        }
        .poster-option-btn:hover { background: #f7f7f7; }
    </style>

    <script>
        window.currentProduct = {
            id:       {{ $product->id }},
            name:     "{{ addslashes($product->name) }}",
            image:    "{{ asset('assets/images/products/' . $product->main_image) }}",
            price:    {{ $product->discount_price ?? $product->price }},
            oldPrice: {{ $product->discount_price ? $product->price : 'null' }}
        };
    </script>

    <span class="pi-subtitle">{{ $product->category->name ?? 'Wall Art' }}</span>
    <h1 class="pi-title">{{ $product->name }}</h1>
    <div class="pi-price">
        @if($product->discount_price)
            <span class="pi-price-old">₹ {{ number_format($product->price) }}</span>
            <span class="pi-price-new">₹ {{ number_format($product->discount_price) }}</span>
        @else
            <span class="pi-price-new">₹ {{ number_format($product->price) }}</span>
        @endif
    </div>
    <p class="pi-tax-note">Price incl. of all taxes</p>

    <div class="poster-option-group">
        <span class="poster-option-label">Frame</span>
        <div class="poster-option-row">
            @foreach($product->frames ?: \App\Models\Product::DEFAULT_POSTER_FRAMES as $frame)
                <button type="button" class="poster-option-btn {{ $loop->first ? 'active' : '' }}" data-frame="{{ $frame }}">{{ $frame }}</button>
            @endforeach
        </div>
    </div>

    <div class="poster-option-group">
        <span class="poster-option-label">Size</span>
        <div class="poster-option-row">
            @foreach($product->available_sizes as $size)
                <button type="button" class="poster-option-btn {{ $loop->first ? 'active' : '' }}" data-size="{{ $size }}">{{ $size }}</button>
            @endforeach
        </div>
    </div>

    @if($product->materials)
        <div class="poster-option-group">
            <span class="poster-option-label">Material</span>
            <div class="poster-option-row">
                @foreach($product->materials as $material)
                    <button type="button" class="poster-option-btn {{ $loop->first ? 'active' : '' }}" data-material="{{ $material }}">{{ $material }}</button>
                @endforeach
            </div>
        </div>
    @endif

    @if($product->orientations)
        <div class="poster-option-group">
            <span class="poster-option-label">Orientation</span>
            <div class="poster-option-row">
                @foreach($product->orientations as $orientation)
                    <button type="button" class="poster-option-btn {{ $loop->first ? 'active' : '' }}" data-orientation="{{ $orientation }}">{{ $orientation }}</button>
                @endforeach
            </div>
        </div>
    @endif

    <div class="pi-actions" style="margin-top: 20px;">
        <div class="pi-qty">
            <button class="pi-qty-btn minus" type="button">−</button>
            <input type="number" value="1" min="1" max="{{ $product->stock_quantity }}" class="pi-qty-input">
            <button class="pi-qty-btn plus" type="button">+</button>
        </div>
        <button class="pi-add-to-cart {{ $product->stock_quantity <= 0 ? 'pi-disabled' : '' }}"
                {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
            {{ $product->stock_quantity <= 0 ? 'OUT OF STOCK' : 'ADD TO CART' }}
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

    @if($product->stock_quantity > 0)
    <div class="pi-buy-now-wrap">
        <button class="pi-buy-now" type="button"><i class="fas fa-bolt"></i> BUY NOW</button>
    </div>
    @endif

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
            <button class="pi-acc-btn" type="button">Poster Details</button>
            <div class="pi-acc-content">
                <ul style="padding-left:0;list-style:none">
                    <li style="padding:6px 0;border-bottom:1px solid #f5f5f5"><strong>SKU:</strong> {{ $product->sku }}</li>
                    <li style="padding:6px 0;border-bottom:1px solid #f5f5f5"><strong>Category:</strong> {{ $product->category->name ?? 'Wall Art' }}</li>
                    <li style="padding:6px 0"><strong>Stock:</strong> {{ $product->stock_quantity }} units</li>
                </ul>
            </div>
        </div>
    </div>
</div>
