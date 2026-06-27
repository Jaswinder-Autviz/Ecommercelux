<a href="{{ route('products.show', $product->slug) }}" class="product-card-premium reveal">
    @php
        $mainImage = $product->main_image ?? '1.jpg';
        $hoverImage = $product->relationLoaded('images')
            ? optional($product->images->first())->image_path
            : optional($product->images()->oldest()->first())->image_path;
    @endphp

    {{-- Image --}}
    <div class="pcp-img-wrap">
        <img src="{{ asset('assets/images/products/' . $mainImage) }}"
             alt="{{ $product->name }}"
             class="pcp-img">
        @if($hoverImage)
            <img src="{{ asset('assets/images/products/' . $hoverImage) }}"
                 alt="{{ $product->name }}"
                 class="pcp-img pcp-img-hover"
                 loading="lazy">
        @endif

        {{-- Badges --}}
        @if($product->discount_price)
            <span class="pcp-badge pcp-badge-sale">
                {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF
            </span>
        @elseif($product->is_featured)
            <span class="pcp-badge pcp-badge-featured">Featured</span>
        @endif

        {{-- Overlay CTA --}}
        <div class="pcp-overlay">
            <span class="pcp-cta">View Product</span>
        </div>

        {{-- Wishlist --}}
        <button class="wl-toggle-btn pcp-wishlist"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-price="₹{{ number_format($product->discount_price ?? $product->price) }}"
            data-image="{{ asset('assets/images/products/' . $mainImage) }}"
            data-url="{{ route('products.show', $product->slug) }}"
            data-category="{{ $product->category->name ?? '' }}"
            title="Add to Wishlist">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </button>
    </div>

    {{-- Info --}}
    <div class="pcp-body">
        <p class="pcp-category">{{ $product->category->name ?? 'Collection' }}</p>
        <h3 class="pcp-name">{{ $product->name }}</h3>
        <div class="pcp-price">
            @if($product->discount_price)
                <span class="pcp-old">₹{{ number_format($product->price) }}</span>
                <span class="pcp-new">₹{{ number_format($product->discount_price) }}</span>
            @else
                <span class="pcp-new">₹{{ number_format($product->price) }}</span>
            @endif
        </div>
    </div>

</a>
