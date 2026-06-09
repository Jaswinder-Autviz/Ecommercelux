@extends('frontend.layouts.app')

@section('title', 'Shop All Collections - Hustler')

@section('content')
<div class="shop-page-wrapper">

    {{-- PREMIUM SHOP BANNER --}}
    <div class="shop-hero">
        <img src="{{ asset('assets/images/banners/Banner2.png') }}" alt="Shop" class="shop-hero-img">
        <div class="shop-hero-overlay">
            <p class="shop-hero-sub">All Collections</p>
            <h1 class="shop-hero-title">SHOP ALL</h1>
            <p class="shop-hero-count">{{ $products->total() }} Products</p>
        </div>
    </div>

    <div class="container">

        {{-- TOPBAR --}}
        <div class="sp-topbar">
            <div class="sp-topbar-left">
                <nav class="sp-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Shop</span>
                </nav>
                <p class="sp-result-count"><span>{{ $products->total() }}</span> products found</p>
            </div>
            <div class="sp-topbar-right">
                <select class="sp-sort-select" id="product-sort">
                    <option value="" disabled selected>Sort By</option>
                    <option value="featured">Featured</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="newest">Newest First</option>
                </select>
                <button class="sp-filter-btn mobile-filter-trigger">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h10M4 18h6"/></svg>
                    Filters
                </button>
            </div>
        </div>

        <div class="shop-main-layout">

            {{-- SIDEBAR --}}
            <aside class="shop-sidebar-container">
                <div class="mobile-sidebar-header">
                    <h2 class="mobile-sidebar-title">Filters</h2>
                    <button class="mobile-sidebar-close">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Category Filter --}}
                <div class="sf-block">
                    <button class="sf-block-title">Category <span class="sf-arrow">+</span></button>
                    <div class="sf-block-body">
                        @foreach(\App\Models\Category::where('status', true)->get() as $cat)
                        <label class="sf-check-item">
                            <input type="checkbox" class="category-filter" value="{{ strtolower($cat->name) }}">
                            <span class="sf-checkmark"></span>
                            <span>{{ $cat->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Size Filter --}}
                <div class="sf-block">
                    <button class="sf-block-title">Size <span class="sf-arrow">+</span></button>
                    <div class="sf-block-body">
                        <div class="sf-size-grid">
                            @foreach(['UK 6','UK 7','UK 8','UK 9','UK 10','UK 11','UK 12'] as $size)
                            <button class="sf-size-btn size-filter-btn" data-size="{{ $size }}">{{ $size }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Price Filter --}}
                <div class="sf-block">
                    <button class="sf-block-title">Price <span class="sf-arrow">+</span></button>
                    <div class="sf-block-body">
                        @foreach([
                            ['label'=>'Under ₹2,000','min'=>0,'max'=>2000],
                            ['label'=>'₹2,000 – ₹3,000','min'=>2000,'max'=>3000],
                            ['label'=>'₹3,000 – ₹4,000','min'=>3000,'max'=>4000],
                            ['label'=>'₹4,000 – ₹5,000','min'=>4000,'max'=>5000],
                            ['label'=>'Over ₹5,000','min'=>5000,'max'=>999999],
                        ] as $range)
                        <label class="sf-radio-item">
                            <input type="radio" name="price-filter" class="price-radio-filter"
                                   data-min="{{ $range['min'] }}" data-max="{{ $range['max'] }}">
                            <span class="sf-radio-mark"></span>
                            <span>{{ $range['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

            </aside>

            {{-- PRODUCT GRID --}}
            <main class="shop-content-area">
                <div class="sp-grid" id="product-grid">
                    @forelse($products as $product)
                    <div class="shop-item"
                         data-category="{{ strtolower($product->category->name ?? '') }}"
                         data-price="{{ $product->price }}"
                         data-id="{{ $product->id }}"
                         data-trending="{{ $product->is_featured ? 'true' : 'false' }}">
                        @include('frontend.components.product-card', ['product' => $product])
                    </div>
                    @empty
                    <div class="sp-empty">
                        <p>No products found.</p>
                    </div>
                    @endforelse
                </div>

                {{-- No Results --}}
                <div id="no-results" class="sp-no-results" style="display:none;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <p>No products match your filters.</p>
                    <button class="sp-clear-btn clear-filters-btn">Clear Filters</button>
                </div>

                {{-- Pagination --}}
                @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="sp-pagination">{{ $products->links() }}</div>
                @endif
            </main>

        </div>
    </div>
</div>

<div class="mobile-filter-overlay"></div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop-sidebar.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/shop-filter.js') }}"></script>
<script src="{{ asset('assets/js/shop-sort.js') }}"></script>
<script>
// Sidebar accordion
document.querySelectorAll('.sf-block-title').forEach(btn => {
    btn.addEventListener('click', () => {
        const block = btn.closest('.sf-block');
        block.classList.toggle('open');
        btn.querySelector('.sf-arrow').textContent = block.classList.contains('open') ? '−' : '+';
    });
    // open by default
    btn.click();
});
</script>
@endpush
