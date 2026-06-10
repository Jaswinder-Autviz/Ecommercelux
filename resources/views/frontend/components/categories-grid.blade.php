{{-- resources/views/frontend/components/categories-grid.blade.php --}}

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories-grid.css') }}">
@endpush

<section class="categories-grid-section">
    <div class="container p-0">
        <div class="categories-width">
        <div class="categories-title reveal">
            <h2>CATEGORIES</h2>
        </div>
        <div class="categories-grid">
            @foreach(\App\Models\Category::where('status', true)->get() as $index => $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                   class="category-card reveal"
                   style="transition-delay: {{ $index * 0.07 }}s">
                    <div class="category-image-wrapper">
                        @if($category->image)
                            <img
                                src="{{ asset('assets/images/categories/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                class="category-image"
                                loading="lazy"
                            >
                        @else
                            <div class="category-image" style="background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-tag" style="font-size:2rem;color:#d1d5db;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="category-label">{{ $category->name }}</div>
                </a>
            @endforeach
        </div>
    </div>
    </div>
</section>
