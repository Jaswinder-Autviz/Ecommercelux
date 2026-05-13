{{-- resources/views/frontend/components/categories-grid.blade.php --}}

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories-grid.css') }}">
@endpush

<section class="categories-grid-section">
    <div class="categories-container">
        <div class="categories-title reveal">
            <h2>CATEGORIES</h2>
        </div>
        <div class="categories-grid">
            @foreach(\App\Models\Category::where('status', true)->get() as $index => $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                   class="category-card reveal"
                   style="transition-delay: {{ $index * 0.07 }}s">
                    <div class="category-image-wrapper">
                        <img
                            src="{{ asset('assets/images/categories/category' . ($index + 1) . '.jpg') }}"
                            alt="{{ $category->name }}"
                            class="category-image"
                            loading="lazy"
                        >
                    </div>
                    <div class="category-label">{{ $category->name }}</div>
                </a>
            @endforeach
        </div>
    </div>
</section>
