<div class="product-gallery">

    {{-- Main Image --}}
    <div class="pg-main-wrap">
        <img id="pgMainImg"
             src="{{ asset('assets/images/products/' . $product->main_image) }}"
             alt="{{ $product->name }}"
             class="pg-main-img">
    </div>

    {{-- Thumbnails --}}
    @if($product->images->count() > 0)
    <div class="pg-thumbs">
        <div class="pg-thumb active" onclick="pgSwitch(this, '{{ asset('assets/images/products/' . $product->main_image) }}')">
            <img src="{{ asset('assets/images/products/' . $product->main_image) }}" alt="Main">
        </div>
        @foreach($product->images as $image)
        <div class="pg-thumb" onclick="pgSwitch(this, '{{ asset('assets/images/products/' . $image->image_path) }}')">
            <img src="{{ asset('assets/images/products/' . $image->image_path) }}" alt="Gallery">
        </div>
        @endforeach
    </div>
    @endif

</div>

<script>
function pgSwitch(thumb, src) {
    document.getElementById('pgMainImg').src = src;
    document.querySelectorAll('.pg-thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}
</script>
