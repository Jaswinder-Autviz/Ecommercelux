<a href="{{ route('products.show', $product->slug) }}" class="product-card-premium reveal">
    @php
        $mainImage = $product->main_image ?? '1.jpg';
        $hoverImage = $product->relationLoaded('images')
            ? optional($product->images->first())->image_path
            : optional($product->images()->oldest()->first())->image_path;
        $cardPrice = $product->discount_price ?? $product->price;
    @endphp

    {{-- Image Wrap --}}
    <div class="pcp-img-wrap">
        <img src="{{ asset('assets/images/products/' . $mainImage) }}"
             alt="{{ $product->name }}"
             class="pcp-img"
             onerror="this.src='{{ asset('assets/images/placeholders/placeholder-product.svg') }}'">
        @if($hoverImage)
            <img src="{{ asset('assets/images/products/' . $hoverImage) }}"
                 alt="{{ $product->name }}"
                 class="pcp-img pcp-img-hover"
                 loading="lazy"
                 onerror="this.style.display='none'">
        @endif

        {{-- 12 x 8 Size Badge --}}
        <span class="pcp-size-badge">12 &times; 8 in</span>

        {{-- Add to Bundle Button --}}
        <button type="button" class="pcp-bundle-add-btn"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-slug="{{ $product->slug }}"
            data-price="{{ $cardPrice }}"
            data-old-price="{{ $product->discount_price ? $product->price : '' }}"
            data-image="{{ asset('assets/images/products/' . $mainImage) }}"
            data-size="12 × 8 inches"
            title="Add to Bundle"
            aria-label="Add to Bundle">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    {{-- Info --}}
    <div class="pcp-body">
        <p class="pcp-category">{{ $product->category->name ?? 'Wall Poster' }}</p>
        <h3 class="pcp-name">{{ $product->name }}</h3>
        <div class="pcp-price">
            <span class="pcp-new">&#8377; {{ number_format($cardPrice) }}</span>
            <span class="pcp-bundle-tag">Bundle Only</span>
        </div>
    </div>
</a>
