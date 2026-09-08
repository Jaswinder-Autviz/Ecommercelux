{{-- resources/views/frontend/components/categories-grid.blade.php --}}

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories-grid.css') }}">
@endpush

<section class="categories-grid-section">
    <div class="container p-0">
        <div class="content-width">
        <div class="categories-header">
            <h2 class="categories-title">CATEGORIES</h2>
            <a href="{{ route('shop') }}" class="categories-view-all">View All</a>
        </div>
        <div class="categories-grid">
            @foreach(\App\Models\Category::where('status', true)->get() as $index => $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}"
                   class="category-card reveal"
                   style="transition-delay: {{ $index * 0.08 }}s">
                    <div class="category-image-wrapper">
                        @if($category->image)
                            <img src="{{ asset('assets/images/categories/' . $category->image) }}"
                                 alt="{{ $category->name }}"
                                 class="category-bg-image">
                        @else
                            <div class="category-placeholder">
                                <span>{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <h3 class="category-title">{{ strtoupper($category->name) }} POSTER</h3>
                        <span class="category-btn">{{ ucfirst(strtolower($category->name)) }} collection</span>
                    </div>
                </a>
            @endforeach
        </div>
        </div>
    </div>
</section>
