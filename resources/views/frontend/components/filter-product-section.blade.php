<section class="fp-section">

    {{-- PREMIUM PROMO SLIDER --}}
    <!-- <div class="container p-0">
    <div class="promo-slider-wrap">
        <div class="swiper promo-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="promo-slide">
                        <img src="{{ asset('assets/images/banners/swiper-banner.png') }}" alt="Premium wall posters for modern spaces" class="promo-slide-img">
                    </div>
                </div>
            </div>
            <div class="promo-pagination"></div>
            <button class="promo-nav promo-nav-prev">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="promo-nav promo-nav-next">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div>
    </div>
</div> -->

    <div class="container p-0">
        <!-- Filter Bar -->
        <div class="fp-filter-wrapper">
            <div class="fp-filter-bar">
                <div class="fp-filter-left">
                    <div class="fp-filter-tabs">
                        <button class="fp-filter-btn active" data-filter="all">Products</button>
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
            @foreach(\App\Models\Product::where('status', true)->with(['category', 'images'])->latest()->get() as $product)
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/filter-product-section.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/filter-product-section.js') }}"></script>
<script>
new Swiper('.promo-swiper', {
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false, pauseOnMouseEnter: true },
    speed: 700,
    slidesPerView: 1,
    spaceBetween: 0,
    grabCursor: true,
    simulateTouch: true,
    allowTouchMove: true,
    touchRatio: 1,
    touchAngle: 45,
    pagination: { el: '.promo-pagination', clickable: true },
    navigation: { prevEl: '.promo-nav-prev', nextEl: '.promo-nav-next' },
    keyboard: { enabled: true, onlyInViewport: true },
});
</script>
@endpush
