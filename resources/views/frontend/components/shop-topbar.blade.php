<div class="shop-topbar">
    <div class="topbar-left">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('shop') }}">Marvel™</a>
            <span class="separator">/</span>
            <span class="current">Hustler Graphic T-Shirts</span>
        </nav>
        <h1 class="collection-title">Hustler Graphic T-Shirts - <span id="filtered-count">{{ isset($products) ? count($products) : 0 }}</span> items</h1>
    </div>
    <div class="topbar-right">
        <button class="mobile-filter-trigger">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16m-7 6h7"/></svg>
            Filters
        </button>
    </div>
</div>
