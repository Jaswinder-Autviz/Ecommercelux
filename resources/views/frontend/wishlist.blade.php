@extends('frontend.layouts.app')

@section('title', 'Wishlist - Hustler')

@section('content')
<div class="wl-page">
    <div class="container">
        <div class="wl-header">
            <h1 class="wl-title">MY WISHLIST</h1>
            <p class="wl-subtitle" id="wl-count"></p>
        </div>
        <div id="wishlist-container"></div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<style>
.wl-page { padding: 60px 0 100px; min-height: 60vh; }
.wl-header { text-align: center; margin-bottom: 48px; }
.wl-title { font-size: 28px; font-weight: 900; letter-spacing: 2px; color: #292b2c; margin-bottom: 8px; }
.wl-subtitle { font-size: 13px; color: #999; letter-spacing: 1px; }

/* Grid */
.wl-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
@media(max-width:1024px) { .wl-grid { grid-template-columns: repeat(3,1fr); } }
@media(max-width:768px)  { .wl-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:480px)  { .wl-grid { grid-template-columns: 1fr; } }

/* Card */
.wl-card { position: relative; transition: opacity .3s, transform .3s; }
.wl-card-img-wrap { display: block; aspect-ratio: 3/4; overflow: hidden; background: #f4f4f4; }
.wl-card-img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s ease; }
.wl-card:hover .wl-card-img { transform: scale(1.04); }
.wl-remove {
    position: absolute; top: 10px; right: 10px;
    width: 30px; height: 30px; border-radius: 50%;
    background: #fff; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,.12); color: #999;
    transition: color .2s, transform .2s;
}
.wl-remove:hover { color: #e8353b; transform: scale(1.1); }
.wl-card-body { padding: 14px 4px 18px; border-bottom: 1px solid #ebebeb; }
.wl-card-cat { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #999; margin-bottom: 5px; }
.wl-card-name { font-size: 14px; font-weight: 700; color: #292b2c; margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.wl-card-price { font-size: 14px; font-weight: 700; color: #292b2c; margin-bottom: 14px; }
.wl-card-btn {
    display: block; text-align: center; padding: 10px;
    background: #292b2c; color: #fff; font-size: 11px;
    font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
    text-decoration: none; transition: background .3s;
}
.wl-card-btn:hover { background: #e8353b; }

/* Empty */
.wl-empty { text-align: center; padding: 80px 20px; }
.wl-empty svg { margin: 0 auto 24px; }
.wl-empty h3 { font-size: 20px; font-weight: 700; color: #292b2c; margin-bottom: 10px; }
.wl-empty p { font-size: 14px; color: #999; margin-bottom: 28px; }
.wl-shop-btn {
    display: inline-block; background: #292b2c; color: #fff;
    padding: 14px 40px; font-size: 12px; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase; text-decoration: none;
    transition: background .3s;
}
.wl-shop-btn:hover { background: #e8353b; }
</style>
@endpush

@push('scripts')
<script>
// Update subtitle count after render
document.addEventListener('DOMContentLoaded', () => {
    const count = (JSON.parse(localStorage.getItem('luxe_wishlist')) || []).length;
    const el = document.getElementById('wl-count');
    if (el) el.textContent = count > 0 ? count + ' saved item' + (count > 1 ? 's' : '') : '';
});
</script>
@endpush
