@extends('frontend.layouts.app')

@section('title', 'Home - LuxeStore')

@section('content')

{{-- PAGE LOADER --}}
<div id="page-loader">
    <div class="loader-inner">
        <div class="loader-logo">LUXE</div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>
</div>

<div class="home-page">

    @include('frontend.components.hero-banner')
    @include('frontend.components.choose')
    @include('frontend.components.new-arrivals-slider')
    @include('frontend.components.categories-grid')
    @include('frontend.components.filter-product-section')

    {{-- STATS SECTION --}}
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item reveal">
                    <div class="stat-number" data-target="15000">0</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item reveal" style="transition-delay:0.1s">
                    <div class="stat-number" data-target="500">0</div>
                    <div class="stat-label">Premium Products</div>
                </div>
                <div class="stat-item reveal" style="transition-delay:0.2s">
                    <div class="stat-number" data-target="50">0</div>
                    <div class="stat-label">Top Brands</div>
                </div>
                <div class="stat-item reveal" style="transition-delay:0.3s">
                    <div class="stat-number" data-target="99">0</div>
                    <div class="stat-label">% Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </section>

    {{-- REELS SECTION --}}
    <section class="reels-section">
        <div class="container">
            <div class="reels-header reveal">
                <p class="reels-eyebrow">@luxestore</p>
                <h2 class="reels-title">AS SEEN ON INSTAGRAM</h2>
            </div>
            <div class="reels-grid">

                <div class="reel-card reveal" style="transition-delay:0s">
                    <div class="reel-inner">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=85&fit=crop&crop=center" alt="Reel 1" class="reel-img">
                        <div class="reel-overlay">
                            <div class="reel-play">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="reel-meta">
                                <span class="reel-likes">❤ 4.2k</span>
                            </div>
                        </div>
                        <div class="reel-badge">Reel</div>
                    </div>
                </div>

                <div class="reel-card reveal" style="transition-delay:0.08s">
                    <div class="reel-inner">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600&q=85&fit=crop&crop=center" alt="Reel 2" class="reel-img">
                        <div class="reel-overlay">
                            <div class="reel-play">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="reel-meta">
                                <span class="reel-likes">❤ 6.8k</span>
                            </div>
                        </div>
                        <div class="reel-badge">Reel</div>
                    </div>
                </div>

                <div class="reel-card reveal" style="transition-delay:0.16s">
                    <div class="reel-inner">
                        <img src="https://images.unsplash.com/photo-1584735175315-9d5df23be620?w=600&q=85&fit=crop&crop=center" alt="Reel 3" class="reel-img">
                        <div class="reel-overlay">
                            <div class="reel-play">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="reel-meta">
                                <span class="reel-likes">❤ 3.1k</span>
                            </div>
                        </div>
                        <div class="reel-badge">Reel</div>
                    </div>
                </div>

                <div class="reel-card reveal" style="transition-delay:0.24s">
                    <div class="reel-inner">
                        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&q=85&fit=crop&crop=center" alt="Reel 4" class="reel-img">
                        <div class="reel-overlay">
                            <div class="reel-play">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="reel-meta">
                                <span class="reel-likes">❤ 9.4k</span>
                            </div>
                        </div>
                        <div class="reel-badge">Reel</div>
                    </div>
                </div>

            </div>
            <div class="reels-follow reveal">
                <a href="#" class="reels-follow-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    Follow @luxestore
                </a>
            </div>
        </div>
    </section>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<style>
/* ── LOADER ─────────────────────────────────────────────── */
#page-loader {
    position: fixed; inset: 0; background: #0a0a0a; z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    transition: opacity 0.6s ease, visibility 0.6s ease;
}
#page-loader.hide { opacity: 0; visibility: hidden; pointer-events: none; }
.loader-inner { text-align: center; }
.loader-logo {
    font-size: 36px; font-weight: 900; letter-spacing: 12px; color: #fff;
    margin-bottom: 24px; animation: loaderPulse 1.4s ease-in-out infinite;
}
@keyframes loaderPulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
.loader-bar { width: 160px; height: 2px; background: rgba(255,255,255,0.15); margin: 0 auto; overflow: hidden; }
.loader-bar-fill { height: 100%; width: 0%; background: #fff; animation: loaderFill 1.2s ease forwards; }
@keyframes loaderFill { to { width: 100%; } }

/* ── SCROLL REVEAL ──────────────────────────────────────── */
.reveal { opacity:0; transform:translateY(36px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal.visible { opacity:1; transform:translateY(0); }
.reveal-left { opacity:0; transform:translateX(-40px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal-left.visible { opacity:1; transform:translateX(0); }
.reveal-right { opacity:0; transform:translateX(40px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal-right.visible { opacity:1; transform:translateX(0); }

/* ── SECTION TITLES ─────────────────────────────────────── */
.na-title,.categories-title h2,.choose-title h2 { position:relative; display:inline-block; }
.na-title::after,.categories-title h2::after,.choose-title h2::after {
    content:''; position:absolute; bottom:-6px; left:50%; transform:translateX(-50%);
    width:40px; height:2px; background:#000; transition:width .4s ease;
}
.na-header:hover .na-title::after,.categories-title:hover h2::after,.choose-title:hover h2::after { width:100%; }

/* ── CHOOSE ─────────────────────────────────────────────── */
.choose-section { padding: 70px 0; }
.choose-item { position:relative; overflow:hidden; }
.choose-item::after { content:''; position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.35) 0%,transparent 60%); opacity:0; transition:opacity .4s ease; }
.choose-item:hover::after { opacity:1; }
.choose-image img { transition:transform 1s cubic-bezier(.4,0,.2,1); }
.choose-item:hover .choose-image img { transform:scale(1.06); }

/* ── CATEGORIES / NA / FP ───────────────────────────────── */
.categories-grid-section { padding:70px 0; }
.na-section { padding:70px 0; }
.fp-section { padding-bottom:80px; }

/* ── MARQUEE ────────────────────────────────────────────── */
.marquee-strip { background:#0a0a0a; color:#fff; overflow:hidden; padding:13px 0; white-space:nowrap; }
.marquee-track { display:inline-flex; animation:marqueeScroll 28s linear infinite; }
.marquee-strip:hover .marquee-track { animation-play-state:paused; }
.marquee-item { font-size:11px; font-weight:700; letter-spacing:2.5px; text-transform:uppercase; padding:0 32px; opacity:.9; }
.marquee-dot { color:#888; margin-left:32px; }
@keyframes marqueeScroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }

/* ── STATS ──────────────────────────────────────────────── */
.stats-section { background:#0a0a0a; padding:80px 0; }
.stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
.stat-item { text-align:center; padding:40px 20px; border-right:1px solid rgba(255,255,255,.08); }
.stat-item:last-child { border-right:none; }
.stat-number { font-size:52px; font-weight:900; color:#fff; letter-spacing:-2px; line-height:1; margin-bottom:12px; }
.stat-label { font-size:11px; font-weight:600; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.45); }
@media(max-width:768px) {
    .stats-grid { grid-template-columns:repeat(2,1fr); }
    .stat-item { border-right:none; border-bottom:1px solid rgba(255,255,255,.08); }
    .stat-number { font-size:38px; }
}

/* ── REELS SECTION ──────────────────────────────────────── */
.reels-section { padding:90px 0 100px; background:#fff; }
.reels-header { text-align:center; margin-bottom:48px; }
.reels-eyebrow { font-size:12px; font-weight:700; letter-spacing:3px; color:#999; margin-bottom:10px; text-transform:uppercase; }
.reels-title { font-size:26px; font-weight:900; letter-spacing:2px; color:#0a0a0a; text-transform:uppercase; }
.reels-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:36px; }
.reel-card { cursor:pointer; }
.reel-inner { position:relative; aspect-ratio:9/16; overflow:hidden; background:#111; }
.reel-img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .6s cubic-bezier(.25,.46,.45,.94),filter .4s ease; filter:brightness(.85); }
.reel-card:hover .reel-img { transform:scale(1.06); filter:brightness(.55); }
.reel-overlay { position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; opacity:0; transition:opacity .35s ease; }
.reel-card:hover .reel-overlay { opacity:1; }
.reel-play { width:60px; height:60px; border:2px solid rgba(255,255,255,.85); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:12px; transform:scale(.8); transition:transform .3s ease; }
.reel-card:hover .reel-play { transform:scale(1); }
.reel-meta { position:absolute; bottom:14px; left:14px; }
.reel-likes { font-size:12px; font-weight:700; color:#fff; letter-spacing:.5px; }
.reel-badge { position:absolute; top:12px; left:12px; background:rgba(255,255,255,.15); backdrop-filter:blur(6px); border:1px solid rgba(255,255,255,.25); color:#fff; font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:4px 10px; }
.reels-follow { text-align:center; }
.reels-follow-btn { display:inline-flex; align-items:center; gap:10px; height:48px; padding:0 32px; border:1.5px solid #0a0a0a; color:#0a0a0a; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; text-decoration:none; transition:all .3s ease; }
.reels-follow-btn:hover { background:#0a0a0a; color:#fff; }
@media(max-width:1024px) { .reels-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:480px) { .reels-grid { grid-template-columns:repeat(2,1fr); gap:8px; } }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Loader
    const loader = document.getElementById('page-loader');
    setTimeout(() => loader.classList.add('hide'), 1400);

    // Scroll Reveal
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => io.observe(el));

    // Stats Counter
    const statsIo = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseInt(el.dataset.target);
            const step = target / (1800 / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) { current = target; clearInterval(timer); }
                el.textContent = Math.floor(current).toLocaleString();
            }, 16);
            statsIo.unobserve(el);
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-number').forEach(el => statsIo.observe(el));
});
</script>
@endpush
