{{-- resources/views/frontend/components/categories-grid.blade.php --}}

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories-grid.css') }}">
@endpush

<section class="categories-grid-section">
    <div class="container p-0">
        <div class="content-width">
        <div class="categories-grid">
            @foreach(\App\Models\Category::where('status', true)->get() as $index => $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                   class="category-card reveal"
                   style="transition-delay: {{ $index * 0.08 }}s">
                    <div class="category-poster-bg">
                        <div class="category-poster-grid">
                            <div class="poster-item poster-1"></div>
                            <div class="poster-item poster-2"></div>
                            <div class="poster-item poster-3"></div>
                            <div class="poster-item poster-4"></div>
                        </div>
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">{{ strtoupper($category->name) }} POSTER</h3>
                        <span class="category-btn">{{ strtolower($category->name) }} collection</span>
                    </div>
                </a>
            @endforeach
        </div>
        </div>
    </div>
</section>
