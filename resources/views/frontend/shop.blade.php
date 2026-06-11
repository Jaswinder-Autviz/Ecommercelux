@extends('frontend.layouts.app')

@php
    $products = $products ?? \App\Models\Product::where('status', true)->with('category')->latest()->paginate(12);
@endphp

@section('title', 'Shop All Collections - Hustler')

@section('content')
<div class="shop-page-wrapper">

    <!-- <div class="shop-hero">
        <img src="{{ asset('assets/images/banners/Banner2.png') }}" alt="Shop Hustler collection" class="shop-hero-img">
        <div class="shop-hero-overlay">
            <p class="shop-hero-sub">All Collections</p>
            <h1 class="shop-hero-title">SHOP ALL</h1>
            <p class="shop-hero-copy">Explore graphic tees, clean staples, oversized fits, and limited Hustler drops built for everyday street movement.</p>
            <p class="shop-hero-count">{{ $products->total() }} Products Ready</p>
        </div>
    </div> -->

    <div class="container">
        <!-- <div class="sp-topbar">
            <div class="sp-topbar-left">
                <nav class="sp-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span>Shop</span>
                </nav>
                <h2 class="sp-heading">Find your next rotation</h2>
                <p class="sp-result-count"><span id="filtered-count">{{ $products->total() }}</span> of {{ $products->total() }} products shown. Filter by category, size, and price to lock in the right fit faster.</p>
            </div>
            <div class="sp-topbar-right">
                <button class="sp-filter-btn mobile-filter-trigger">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h10M4 18h6"/></svg>
                    Filters
                </button>
            </div>
        </div> -->

        <div class="shop-main-layout">
            <aside class="shop-sidebar-container">
                <div class="mobile-sidebar-header">
                    <h2 class="mobile-sidebar-title">Filters</h2>
                    <button class="mobile-sidebar-close">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="sf-intro">
                    <span>Refine the drop</span>
                    <p>Use quick filters to narrow the collection without losing your place.</p>
                </div>

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

                <div class="sf-block">
                    <button class="sf-block-title">Size <span class="sf-arrow">+</span></button>
                    <div class="sf-block-body">
                        <div class="sf-size-grid">
                            @foreach(\App\Models\Product::DEFAULT_APPAREL_SIZES as $size)
                            <button class="sf-size-btn size-filter-btn" data-size="{{ $size }}">{{ $size }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="sf-block">
                    <button class="sf-block-title">Price <span class="sf-arrow">+</span></button>
                    <div class="sf-block-body">
                        @foreach([
                            ['label'=>'Under Rs. 2,000','min'=>0,'max'=>2000],
                            ['label'=>'Rs. 2,000 - Rs. 3,000','min'=>2000,'max'=>3000],
                            ['label'=>'Rs. 3,000 - Rs. 4,000','min'=>3000,'max'=>4000],
                            ['label'=>'Rs. 4,000 - Rs. 5,000','min'=>4000,'max'=>5000],
                            ['label'=>'Over Rs. 5,000','min'=>5000,'max'=>999999],
                        ] as $range)
                        <label class="sf-radio-item">
                            <input type="radio" name="price-filter" class="price-radio-filter" data-min="{{ $range['min'] }}" data-max="{{ $range['max'] }}">
                            <span class="sf-radio-mark"></span>
                            <span>{{ $range['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </aside>

            <main class="shop-content-area">
                <div class="sp-grid" id="product-grid">
                    @forelse($products as $product)
                    <div class="shop-item"
                         data-category="{{ strtolower($product->category->name ?? '') }}"
                         data-sizes="{{ implode(',', $product->available_sizes) }}"
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

                <div id="no-results" class="sp-no-results" style="display:none;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <p>No products match your filters.</p>
                    <button class="sp-clear-btn clear-filters-btn">Clear Filters</button>
                </div>

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
<script>
document.querySelectorAll('.sf-block-title').forEach(btn => {
    btn.addEventListener('click', () => {
        const block = btn.closest('.sf-block');
        block.classList.toggle('open');
        btn.querySelector('.sf-arrow').textContent = block.classList.contains('open') ? '-' : '+';
    });
    btn.click();
});
</script>
@endpush
