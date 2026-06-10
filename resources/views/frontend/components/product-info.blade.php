<div class="product-info">
    <script>
        window.currentProduct = {
            id:       {{ $product->id }},
            name:     "{{ addslashes($product->name) }}",
            image:    "{{ asset('assets/images/products/' . $product->main_image) }}",
            price:    {{ $product->discount_price ?? $product->price }},
            oldPrice: {{ $product->discount_price ? $product->price : 'null' }}
        };
    </script>

    {{-- Header --}}
    <span class="pi-subtitle">{{ $product->category->name ?? 'Collection' }}</span>
    <h1 class="pi-title">{{ $product->name }}</h1>
    <div class="pi-price">
        @if($product->discount_price)
            <span class="pi-price-old">₹ {{ number_format($product->price) }}</span>
            <span class="pi-price-new">₹ {{ number_format($product->discount_price) }}</span>
        @else
            <span class="pi-price-new">₹ {{ number_format($product->price) }}</span>
        @endif
    </div>

    {{-- Stock --}}
    <div class="pi-stock">
        @if($product->stock_quantity > 0)
            <span class="pi-in-stock"><i class="fas fa-check-circle"></i> In Stock ({{ $product->stock_quantity }} units)</span>
        @else
            <span class="pi-out-stock"><i class="fas fa-times-circle"></i> Out of Stock</span>
        @endif
    </div>

    {{-- Size Selector --}}
    <div class="pi-size-selector">
        <div class="pi-size-header">
            <span class="pi-label">Select Size</span>
            <button class="pi-size-guide" type="button" aria-expanded="false" aria-controls="sizeGuideModal">Size Guide</button>
        </div>
        <div class="pi-size-grid">
            @foreach($product->available_sizes as $size)
                <button class="pi-size-btn" data-size="{{ $size }}" type="button">{{ $size }}</button>
            @endforeach
        </div>
        <p id="sizeError" style="display:none;color:#e8353b;font-size:12px;margin-top:8px;">
            <i class="fas fa-exclamation-circle"></i> Please select a size first
        </p>
    </div>

    <div class="pi-size-guide-modal" id="sizeGuideModal" aria-hidden="true">
        <div class="pi-size-guide-backdrop" data-close-size-guide></div>
        <div class="pi-size-guide-panel" role="dialog" aria-modal="true" aria-labelledby="sizeGuideTitle">
            <button class="pi-size-guide-close" type="button" data-close-size-guide aria-label="Close size guide">
                <i class="fas fa-times"></i>
            </button>
            <div class="pi-tee-guide-art" aria-hidden="true">
                <div class="pi-tee-neck"></div>
                <div class="pi-tee-body">
                    <span class="pi-tee-chest">Chest</span>
                    <span class="pi-tee-length">Length</span>
                </div>
            </div>
            <h2 id="sizeGuideTitle" class="pi-size-guide-title">T-Shirt Size Guide</h2>
            <div class="pi-unit-toggle" aria-label="Measurement unit">
                <span class="active">In</span>
                <span>Cms</span>
            </div>
            <table class="pi-size-chart">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chest (Inch)</th>
                        <th>Front Length (Inch)</th>
                        <th>Sleeve Length (Inch)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['S', '42', '29', '9.75'],
                        ['M', '44', '29.75', '10'],
                        ['L', '46', '30.5', '10.25'],
                        ['XL', '48', '31.25', '10.5'],
                        ['2XL', '50', '32', '10.75'],
                    ] as $row)
                    <tr>
                        <td>{{ $row[0] }}</td>
                        <td>{{ $row[1] }}</td>
                        <td>{{ $row[2] }}</td>
                        <td>{{ $row[3] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="pi-actions">
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

    {{-- Buy Now --}}
    @if($product->stock_quantity > 0)
    <div class="pi-buy-now-wrap">
        <button class="pi-buy-now" type="button">
            <i class="fas fa-bolt"></i> BUY NOW
        </button>
    </div>
    @endif

    {{-- Accordion --}}
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
            <button class="pi-acc-btn" type="button">Specifications</button>
            <div class="pi-acc-content">
                <ul style="padding-left:0;list-style:none">
                    <li style="padding:6px 0;border-bottom:1px solid #f5f5f5"><strong>SKU:</strong> {{ $product->sku }}</li>
                    <li style="padding:6px 0;border-bottom:1px solid #f5f5f5"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</li>
                    <li style="padding:6px 0"><strong>Stock:</strong> {{ $product->stock_quantity }} units</li>
                </ul>
            </div>
        </div>
    </div>

</div>
