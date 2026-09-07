<a href="{{ route('products.show', $product->slug) }}" class="product-card-premium reveal">
    @php
        $mainImage = $product->main_image ?? '1.jpg';
        $hoverImage = $product->relationLoaded('images')
            ? optional($product->images->first())->image_path
            : optional($product->images()->oldest()->first())->image_path;
        $cardPrice = $product->discount_price ?? $product->price;
        $defaultSize = $product->available_sizes[0] ?? '8×12';
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

        {{-- Add to Cart --}}
        <button type="button" class="pcp-cart"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-price="{{ $cardPrice }}"
            data-old-price="{{ $product->discount_price ? $product->price : '' }}"
            data-image="{{ asset('assets/images/products/' . $mainImage) }}"
            data-size="{{ $defaultSize }}"
            data-frame="Unframed (Rolled)"
            title="Add to Cart"
            aria-label="Add to Cart">
            <i class="fas fa-shopping-bag"></i>
        </button>
    </div>

    {{-- Info --}}
    <div class="pcp-body">
        <p class="pcp-category">{{ $product->category->name ?? 'Collection' }}</p>
        <h3 class="pcp-name">{{ $product->name }}</h3>
        <div class="pcp-price">
            @if($product->discount_price)
                <span class="pcp-old">&#8377;{{ number_format($product->price) }}</span>
                <span class="pcp-new">&#8377;{{ number_format($product->discount_price) }}</span>
            @else
                <span class="pcp-new">&#8377;{{ number_format($product->price) }}</span>
            @endif
        </div>
    </div>
</a>
