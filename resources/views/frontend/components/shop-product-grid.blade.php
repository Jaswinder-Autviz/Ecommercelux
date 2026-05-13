<div class="shop-grid-container">
    <div class="shop-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="product-grid">
        @if(isset($products) && $products->count() > 0)
            @foreach($products as $product)
                <div class="shop-item" 
                     data-category="{{ $product->category->name ?? '' }}" 
                     data-price="{{ $product->price }}"
                     data-id="{{ $product->id }}"
                     data-trending="{{ $product->is_featured ? 'true' : 'false' }}">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
            @endforeach
        @endif
    </div>
    
    <div class="mt-12">
        @if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $products->links() }}
        @endif
    </div>
    
    <!-- No Results State -->
    <div id="no-results" class="no-results" style="display: none;">
        <p>No products match your filters.</p>
        <button class="clear-filters-btn">Clear All Filters</button>
    </div>
</div>
