<div class="shop-sidebar custom-scrollbar">
    <!-- Categories Filter -->
    <div class="sidebar-block">
        <div class="sidebar-content">
            @php
                $brands = [
                    ['id' => 'dc', 'name' => 'DC Comics™', 'count' => 4],
                    ['id' => 'marvel', 'name' => 'Marvel™', 'count' => 15],
                    ['id' => 'mortal-kombat', 'name' => 'Mortal Kombat™', 'count' => 2],
                    ['id' => 'naruto', 'name' => 'Naruto', 'count' => 1],
                    ['id' => 'naruto-shippuden', 'name' => 'Naruto Shippuden', 'count' => 4],
                    ['id' => 'star-wars', 'name' => 'Star Wars™', 'count' => 5],
                    ['id' => 'top-gun', 'name' => 'Top Gun', 'count' => 1],
                    ['id' => 'transformers', 'name' => 'Transformers', 'count' => 2],
                ];
            @endphp
            <div class="brand-list">
                @foreach($brands as $brand)
                    <label class="filter-item checkbox-item">
                        <input type="checkbox" class="filter-checkbox category-filter" value="{{ $brand['id'] }}">
                        <span class="checkmark"></span>
                        <span class="label-text">{{ $brand['name'] }}</span>
                        <span class="item-count">{{ $brand['count'] }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Size Filter -->
    <div class="sidebar-block">
        <h3 class="sidebar-title">SIZE</h3>
        <div class="sidebar-content">
            <div class="size-search-wrap">
                <input type="text" class="size-search-input" placeholder="Search for Size">
            </div>
            <div class="size-grid">
                @php
                    $sizes = [
                        ['val' => 'UK 6', 'count' => 33],
                        ['val' => 'UK 7', 'count' => 30],
                        ['val' => 'UK 8', 'count' => 26],
                        ['val' => 'UK 9', 'count' => 29],
                        ['val' => 'UK 10', 'count' => 29],
                        ['val' => 'UK 11', 'count' => 27],
                        ['val' => 'UK 12', 'count' => 6],
                    ];
                @endphp
                @foreach($sizes as $size)
                    <button class="size-filter-btn" data-size="{{ $size['val'] }}">
                        {{ $size['val'] }} <span class="btn-count">({{ $size['count'] }})</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Price Filter -->
    <div class="sidebar-block">
        <h3 class="sidebar-title">PRICES</h3>
        <div class="sidebar-content">
            @php
                $priceRanges = [
                    ['label' => 'Rs. 1799 - Rs. 2198', 'min' => 1799, 'max' => 2198],
                    ['label' => 'Rs. 2199 - Rs. 2598', 'min' => 2199, 'max' => 2598],
                    ['label' => 'Rs. 2599 - Rs. 2998', 'min' => 2599, 'max' => 2998],
                    ['label' => 'Rs. 2999 - Rs. 3398', 'min' => 2999, 'max' => 3398],
                    ['label' => 'Rs. 3399 - Rs. 3798', 'min' => 3399, 'max' => 3798],
                    ['label' => 'Rs. 3799 - Rs. 4199', 'min' => 3799, 'max' => 4199],
                ];
            @endphp
            @foreach($priceRanges as $range)
                <label class="filter-item radio-item">
                    <input type="radio" name="price-filter" class="price-radio-filter" 
                           data-min="{{ $range['min'] }}" data-max="{{ $range['max'] }}">
                    <span class="radio-mark"></span>
                    <span class="label-text">{{ $range['label'] }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
