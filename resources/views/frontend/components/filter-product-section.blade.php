<section class="fp-section">
    <!-- Section Banner -->
    <div class="fp-banner">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1600&q=90&fit=crop&crop=center" alt="New Season" class="fp-banner-img">
        <div class="fp-banner-overlay"></div>
        <div class="fp-banner-content reveal">
            <span class="fp-banner-tag">Season 2025</span>
            <h2 class="fp-banner-title">NEW SEASON<br>COLLECTIONS</h2>
            <p class="fp-banner-text">Discover the latest trends in luxury footwear and apparel.</p>
            <a href="{{ route('shop') }}" class="fp-banner-btn">Shop Now →</a>
        </div>
    </div>

    <div class="container">
        <!-- Filter Bar -->
        <div class="fp-filter-wrapper">
            <div class="fp-filter-bar">
                <div class="fp-filter-left">
                    <div class="fp-filter-tabs">
                        <button class="fp-filter-btn active" data-filter="all">All</button>
                        @foreach(\App\Models\Category::where('status', true)->get() as $cat)
                            <button class="fp-filter-btn" data-filter="{{ strtolower($cat->name) }}">{{ $cat->name }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="fp-filter-right">
                    <div class="fp-price-filter">
                        <span class="price-label">Price:</span>
                        <select id="fp-price-range" class="classic-select">
                            <option value="all">All Prices</option>
                            <option value="0-3000">Under ₹3,000</option>
                            <option value="3000-5000">₹3,000 – ₹5,000</option>
                            <option value="5000-above">Over ₹5,000</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="fp-grid" id="fp-product-grid">
            @foreach(\App\Models\Product::where('status', true)->with('category')->latest()->take(8)->get() as $product)
                <div class="fp-item"
                     data-category="{{ strtolower($product->category->name ?? '') }}"
                     data-price="{{ $product->price }}">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        <div id="fp-no-results" class="fp-no-results" style="display:none;">
            <p>No products match your selected filters.</p>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/filter-product-section.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/filter-product-section.js') }}"></script>
@endpush
