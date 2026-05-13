<section class="related-products">
    <div class="container">
        <div class="rp-header">
            <h2 class="rp-title">YOU MAY ALSO LIKE</h2>
        </div>
        <div class="rp-grid">
            @foreach($relatedProducts as $related)
                @include('frontend.components.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
</section>
