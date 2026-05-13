@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/new-arrivals-slider.css') }}">
@endpush

<section class="na-section">

    <div class="na-header container">
        <div class="na-header-left reveal">
            <h2 class="na-title">FRESH OUT THE LAB</h2>
        </div>
    </div>

    <div class="na-slider-wrap container">
        <div class="swiper na-swiper">
            <div class="swiper-wrapper">
                @foreach(\App\Models\Product::where('status', true)->latest()->take(6)->get() as $product)
                <div class="swiper-slide">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
                @endforeach
            </div>
        </div>

        <button class="na-nav na-nav-prev" aria-label="Previous">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="na-nav na-nav-next" aria-label="Next">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
    </div>

</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/new-arrivals-slider.js') }}"></script>
@endpush
