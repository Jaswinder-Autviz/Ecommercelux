@extends('frontend.layouts.app')

@section('title', 'Home - Hustler')

@section('content')

{{-- PAGE LOADER --}}
<div id="page-loader">
    <div class="loader-inner">
        <div class="loader-logo">HUSTLER</div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>
</div>

<div class="home-page">

    @include('frontend.components.hero-banner')

    <!-- <section class="hustler-marquee" aria-label="Hustler highlights">
        <div class="hustler-marquee-track">
            @for ($i = 0; $i < 2; $i++)
                <span>Oversized Tees</span>
                <span>Heavy Cotton</span>
                <span>Street Fits</span>
                <span>Limited Drops</span>
                <span>Made For Daily Hustle</span>
            @endfor
        </div>
    </section> -->

         {{-- WHY HUSTLER ROW --}}
    <section class="container p-0">
        <div class="why-luxe-section">
            <div class="wl-row ">
                <div class="wl-row-card reveal" style="transition-delay:0s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3>Premium Fabric</h3>
                    <p>Soft cotton blends selected for shape, comfort, and everyday wear.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.1s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <h3>2-Day Delivery</h3>
                    <p>Same-day dispatch on all orders placed before 3PM.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.2s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                    </div>
                    <h3>Easy Exchanges</h3>
                    <p>Size not right? Exchange within 7 days without the drama.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.3s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    </div>
                    <h3>Exclusive Drops</h3>
                    <p>Early access to limited releases before they sell out.</p>
                </div>
            </div>
        </div>
    </section>
    


 

    @include('frontend.components.choose')

        <section class="brand-story-section">
        <div class="container p-0">
            <div class="brand-story-grid">
                <div class="brand-story-copy reveal-left">
                    <span class="section-eyebrow">Hustler essentials</span>
                    <h2>Tees that work hard without trying too hard.</h2>
                    <p>Clean silhouettes, bold attitude, and fabrics made for repeat wear. Build your daily uniform with graphic tees, oversized fits, and statement basics.</p>
                    <a href="{{ route('shop') }}" class="brand-story-btn">Shop T-Shirts</a>
                </div>
                <div class="brand-story-stats reveal-right">
                    <div class="brand-stat">
                        <strong>240 GSM</strong>
                        <span>Premium cotton feel</span>
                    </div>
                    <div class="brand-stat">
                        <strong>Drop Based</strong>
                        <span>Fresh designs every week</span>
                    </div>
                    <div class="brand-stat">
                        <strong>All Day</strong>
                        <span>Comfort-first streetwear</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('frontend.components.new-arrivals-slider')
    @include('frontend.components.categories-grid')
    @include('frontend.components.filter-product-section')

    {{-- LOOKBOOK ROW (above footer) --}}
    <section class="categories-grid-section">
        <div class="container p-0">
            <div class="categories-title reveal">
                <h2>THE HUSTLER FIT</h2>
            </div>
            <div class="categories-grid">
                <div class="category-card lace-card reveal" style="transition-delay:0s">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/images/categories/clothes1.jpg') }}" alt="Oversized Hustler T-shirt" class="category-image">
                    </div>
                    <div class="lookbook-label">Oversized</div>
                </div>
                <div class="category-card lace-card reveal" style="transition-delay:0.07s">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/images/categories/clothes2.jpg') }}" alt="Graphic Hustler T-shirt" class="category-image">
                    </div>
                    <div class="lookbook-label">Graphic</div>
               </div>
                <div class="category-card lace-card reveal" style="transition-delay:0.14s">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/images/categories/clothes4.jpg') }}" alt="Streetwear Hustler T-shirt" class="category-image">
                    </div>
                    <div class="lookbook-label">Streetwear</div>
                </div>
                <div class="category-card lace-card reveal" style="transition-delay:0.21s">
                    <div class="category-image-wrapper">
                        <img src="{{ asset('assets/images/categories/clothes5.jpg') }}" alt="Everyday Hustler T-shirt" class="category-image">
                    </div>
                    <div class="lookbook-label">Everyday</div>
               </div>
            </div>
        </div>
    </section>

  

    {{-- FEATURED DROPS --}}
    <!-- <section class="featured-drops-section">
        <div class="container">
            <div class="fd-header reveal">
                <span class="fd-eyebrow">Limited Edition</span>
                <h2 class="fd-title">THIS WEEK'S DROPS</h2>
            </div>
            <div class="fd-grid">
                <div class="fd-card fd-card--large reveal-left">
                    <div class="fd-card-inner" style="background: linear-gradient(135deg, #111111 0%, #1a1a2e 50%, #16213e 100%)">
                        <div class="fd-shoe-visual">
                            <div class="fd-shoe-glow" style="background: radial-gradient(circle, rgba(255,107,53,0.4) 0%, transparent 70%)"></div>
                            <svg viewBox="0 0 300 180" class="fd-shoe-svg">
                                <ellipse cx="150" cy="155" rx="130" ry="12" fill="rgba(255,255,255,0.05)"/>
                                <path d="M40,130 Q60,80 120,70 Q160,65 200,75 Q240,85 260,110 Q270,125 265,135 Q200,145 150,148 Q90,150 40,130Z" fill="#e71318" opacity="0.9"/>
                                <path d="M40,130 Q60,80 120,70 Q160,65 200,75 Q240,85 260,110" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                                <path d="M80,125 Q100,95 140,88 Q170,84 200,90" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="8" stroke-linecap="round"/>
                                <path d="M55,128 Q75,100 115,92" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="6" stroke-linecap="round"/>
                                <circle cx="220" cy="100" r="8" fill="rgba(255,255,255,0.1)"/>
                                <circle cx="235" cy="108" r="5" fill="rgba(255,255,255,0.08)"/>
                                <path d="M150,70 L155,50 L160,70" fill="rgba(255,255,255,0.2)"/>
                                <path d="M170,68 L175,45 L180,68" fill="rgba(255,255,255,0.15)"/>
                                <path d="M190,72 L195,52 L200,72" fill="rgba(255,255,255,0.1)"/>
                            </svg>
                        </div>
                        <div class="fd-card-content">
                            <span class="fd-tag">🔥 Hot Drop</span>
                            <h3 class="fd-card-title">PHANTOM X1</h3>
                            <p class="fd-card-sub">Ultra-light performance meets street style</p>
                            <a href="{{ route('shop') }}" class="fd-card-btn">Shop Now →</a>
                        </div>
                    </div>
                </div>

                <div class="fd-right">
                    <div class="fd-card fd-card--small reveal" style="transition-delay:0.1s">
                        <div class="fd-card-inner" style="background: linear-gradient(135deg, #f8f8f8 0%, #ececec 100%)">
                            <div class="fd-shoe-visual">
                                <svg viewBox="0 0 300 180" class="fd-shoe-svg">
                                    <ellipse cx="150" cy="155" rx="130" ry="12" fill="rgba(0,0,0,0.05)"/>
                                    <path d="M40,130 Q60,80 120,70 Q160,65 200,75 Q240,85 260,110 Q270,125 265,135 Q200,145 150,148 Q90,150 40,130Z" fill="#0a0a0a" opacity="0.85"/>
                                    <path d="M80,125 Q100,95 140,88 Q170,84 200,90" fill="none" stroke="rgba(255,107,53,0.6)" stroke-width="8" stroke-linecap="round"/>
                                    <path d="M55,128 Q75,100 115,92" fill="none" stroke="rgba(255,107,53,0.4)" stroke-width="6" stroke-linecap="round"/>
                                    <path d="M150,70 L155,50 L160,70" fill="rgba(0,0,0,0.3)"/>
                                    <path d="M170,68 L175,45 L180,68" fill="rgba(0,0,0,0.2)"/>
                                </svg>
                            </div>
                            <div class="fd-card-content">
                                <span class="fd-tag fd-tag--dark">New</span>
                                <h3 class="fd-card-title fd-card-title--dark">SHADOW RUN</h3>
                                <a href="{{ route('shop') }}" class="fd-card-btn fd-card-btn--dark">Explore →</a>
                            </div>
                        </div>
                    </div>

                    <div class="fd-card fd-card--small reveal" style="transition-delay:0.2s">
                        <div class="fd-card-inner" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%)">
                            <div class="fd-shoe-visual">
                                <svg viewBox="0 0 300 180" class="fd-shoe-svg">
                                    <ellipse cx="150" cy="155" rx="130" ry="12" fill="rgba(255,255,255,0.03)"/>
                                    <path d="M40,130 Q60,80 120,70 Q160,65 200,75 Q240,85 260,110 Q270,125 265,135 Q200,145 150,148 Q90,150 40,130Z" fill="#ffffff" opacity="0.9"/>
                                    <path d="M80,125 Q100,95 140,88 Q170,84 200,90" fill="none" stroke="rgba(255,107,53,0.8)" stroke-width="8" stroke-linecap="round"/>
                                    <path d="M55,128 Q75,100 115,92" fill="none" stroke="rgba(255,107,53,0.5)" stroke-width="6" stroke-linecap="round"/>
                                    <path d="M150,70 L155,50 L160,70" fill="rgba(255,255,255,0.5)"/>
                                    <path d="M170,68 L175,45 L180,68" fill="rgba(255,255,255,0.3)"/>
                                </svg>
                            </div>
                            <div class="fd-card-content">
                                <span class="fd-tag">Limited</span>
                                <h3 class="fd-card-title">CLOUD FORCE</h3>
                                <a href="{{ route('shop') }}" class="fd-card-btn">Explore →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    {{-- REELS SECTION --}}
    <!-- <section class="reels-section">
        <div class="container">
            <div class="reels-header reveal">
                <p class="reels-eyebrow">@hustler</p>
                <h2 class="reels-title">AS SEEN ON INSTAGRAM</h2>
            </div>
            <div class="reels-grid">
                @forelse($reels as $index => $reel)
                <div class="reel-card reveal" style="transition-delay:{{ $index * 0.08 }}s">
                    <div class="reel-inner">
                        <img src="{{ asset('assets/images/reels/' . $reel->thumbnail) }}" alt="Reel {{ $index + 1 }}" class="reel-img">
                        <div class="reel-overlay">
                            <div class="reel-play">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="reel-meta">
                                @if($reel->likes)<span class="reel-likes">❤ {{ $reel->likes }}</span>@endif
                            </div>
                        </div>
                        <div class="reel-badge">Reel</div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <div class="reels-follow reveal">
                <a href="#" class="reels-follow-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    Follow @hustler
                </a>
            </div>
        </div>
    </section> -->

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-card.css') }}">
<style>
/* ── LOADER ─────────────────────────────────────────────── */
#page-loader {
    position: fixed; inset: 0; background: #111111; z-index: 99999;
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
.loader-bar-fill { height: 100%; width: 0%; background: #e71318; animation: loaderFill 1.2s ease forwards; }
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
    width:40px; height:2px; background:#e71318; transition:width .4s ease;
}
.na-header:hover .na-title::after,.categories-title:hover h2::after,.choose-title:hover h2::after { width:100%; }

.section-eyebrow {
    display: inline-block;
    margin-bottom: 12px;
    color: #e71318;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
}

/* HUSTLER INTRO */
.hustler-marquee {
    background: #111;
    color: #fff;
    overflow: hidden;
    white-space: nowrap;
}
.hustler-marquee-track {
    display: inline-flex;
    min-width: 200%;
    animation: hustlerMarquee 30s linear infinite;
}
.hustler-marquee span {
    position: relative;
    padding: 13px 34px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2.4px;
    text-transform: uppercase;
}
.hustler-marquee span::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -3px;
    width: 6px;
    height: 6px;
    background: #e71318;
    transform: translateY(-50%);
}
@keyframes hustlerMarquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

.brand-story-section { padding: 58px 0 8px; background: #fff; }
.brand-story-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.25fr) minmax(320px, .75fr);
    gap: 36px;
    align-items: stretch;
}
.brand-story-copy {
    background: #f6f7f5;
    padding: 46px;
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.brand-story-copy h2 {
    max-width: 720px;
    font-size: clamp(34px, 5vw, 68px);
    line-height: .98;
    font-weight: 900;
    letter-spacing: 0;
    color: #111;
    margin: 0 0 20px;
    text-transform: uppercase;
}
.brand-story-copy p {
    max-width: 620px;
    color: #555;
    font-size: 15px;
    line-height: 1.8;
    margin: 0 0 28px;
}
.brand-story-btn {
    width: fit-content;
    background: #111;
    color: #fff;
    padding: 14px 24px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.6px;
    text-transform: uppercase;
    transition: background .25s ease;
}
.brand-story-btn:hover { background: #e71318; }
.brand-story-stats { display: grid; gap: 12px; }
.brand-stat {
    min-height: 92px;
    padding: 24px;
    background: #111;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.brand-stat strong {
    display: block;
    font-size: 24px;
    font-weight: 900;
    letter-spacing: .5px;
    text-transform: uppercase;
}
.brand-stat span {
    color: rgba(255,255,255,.72);
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
@media(max-width:900px) {
    .brand-story-grid { grid-template-columns: 1fr; gap: 14px; }
    .brand-story-copy { padding: 34px 22px; }
}

/* ── CHOOSE ─────────────────────────────────────────────── */
.choose-section { padding: 0px 0px 70px 0px; overflow: hidden;}
.choose-item { position:relative; overflow:hidden; display:block; color:inherit; text-decoration:none; }
.choose-item::after { content:''; position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.35) 0%,transparent 60%); opacity:0; transition:opacity .4s ease; }
.choose-item:hover::after { opacity:1; }
.choose-image img { transition:transform 1s cubic-bezier(.4,0,.2,1); }
.choose-item:hover .choose-image img { transform:scale(1.06); }
.choose-label {
    position: absolute;
    left: 18px;
    right: 18px;
    bottom: 18px;
    z-index: 2;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 12px;
    color: #fff;
}
.choose-label span {
    font-size: 20px;
    font-weight: 900;
    line-height: 1;
    text-transform: uppercase;
}
.choose-label strong {
    flex: 0 0 auto;
    background: #fff;
    color: #111;
    padding: 8px 10px;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* ── CATEGORIES / NA / FP ───────────────────────────────── */
.categories-grid-section { padding:0px 0px 70px 0px; }
.na-section { padding:0px 0px 70px 0px; }
.fp-section { padding-bottom:80px; }

/* ── MARQUEE ────────────────────────────────────────────── */
.marquee-strip { background:#111111; color:#fff; overflow:hidden; padding:13px 0; white-space:nowrap; }
.marquee-track { display:inline-flex; animation:marqueeScroll 28s linear infinite; }
.marquee-strip:hover .marquee-track { animation-play-state:paused; }
.marquee-item { font-size:11px; font-weight:700; letter-spacing:2.5px; text-transform:uppercase; padding:0 32px; opacity:.9; }
.marquee-dot { color:#888; margin-left:32px; }
@keyframes marqueeScroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }

/* ── WHY HUSTLER ROW ────────────────────────────────────── */
.why-luxe-section { background: #f2f7f4; margin: 50px 0; border: 1px solid #e3ece6; }
.wl-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 0; }
.wl-row-card { padding: 28px 30px; border-right: 1px solid #dce8e0; display: flex; flex-direction: column; align-items: flex-start; gap: 7px; transition: background 0.3s ease; }
.wl-row-card:last-child { border-right: none; }
.wl-row-card:hover { background: #fff; }
.wl-row-icon { width: 52px; height: 52px; border: 1px solid #d7e2dc; background: #fff; display: flex; align-items: center; justify-content: center; color: #e71318; transition: all 0.3s ease; }
.wl-row-card:hover .wl-row-icon { background: #e71318; color: #fff; border-color: #e71318; }
.wl-row-card h3 { font-size: 14px; font-weight: 800; color: #111111; letter-spacing: 0.5px; margin: 0; }
.wl-row-card p { font-size: 12px; color: #111111; line-height: 1.7; margin: 0; }
@media(max-width:1024px) { .wl-row { grid-template-columns: repeat(2,1fr); } .wl-row-card { border-right: none; border-bottom: 1px solid #dce8e0; } }
@media(max-width:480px) { .wl-row { grid-template-columns: 1fr; } }

/* ── FEATURED DROPS ─────────────────────────────────────── */
.featured-drops-section { padding: 90px 0; background: #F5F5F2; }
.fd-header { text-align: center; margin-bottom: 48px; }
.fd-eyebrow { font-size: 11px; font-weight: 700; letter-spacing: 3px; color: #e71318; text-transform: uppercase; display: block; margin-bottom: 10px; }
.fd-title { font-size: 28px; font-weight: 900; letter-spacing: 2px; color: #111111; text-transform: uppercase; }
.fd-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 16px; }
.fd-right { display: flex; flex-direction: column; gap: 16px; }
.fd-card { border-radius: 28px; overflow: hidden; cursor: pointer; }
.fd-card--large { height: 420px; }
.fd-card--small { flex: 1; }
.fd-card-inner { height: 100%; padding: 32px; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; transition: transform 0.4s ease; }
.fd-card:hover .fd-card-inner { transform: scale(1.02); }
.fd-shoe-visual { position: absolute; right: -20px; bottom: 60px; width: 85%; opacity: 0.9; }
.fd-card--small .fd-shoe-visual { width: 90%; bottom: 40px; right: -10px; }
.fd-shoe-glow { position: absolute; inset: 0; pointer-events: none; }
.fd-shoe-svg { width: 100%; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4)); }
.fd-card-content { position: relative; z-index: 2; }
.fd-tag { display: inline-block; background: rgba(255,255,255,0.15); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2); color: #fff; font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 5px 12px; border-radius: 20px; margin-bottom: 12px; }
.fd-tag--dark { background: rgba(235,62,37,0.15); border-color: rgba(235,62,37,0.3); color: #111111; }
.fd-card-title { font-size: 28px; font-weight: 900; color: #fff; letter-spacing: 1px; margin-bottom: 8px; }
.fd-card--large .fd-card-title { font-size: 36px; }
.fd-card-title--dark { color: #111111; }
.fd-card-sub { font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 20px; }
.fd-card-btn { display: inline-flex; align-items: center; gap: 6px; background: #e71318; color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 10px 20px; border-radius: 20px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(231,19,24,0.35); }
.fd-card-btn:hover { background: #111111; box-shadow: none; }
.fd-card-btn--dark { background: #111111; color: #fff; }
.fd-card-btn--dark:hover { background: #e71318; }
@media(max-width:768px) { .fd-grid { grid-template-columns: 1fr; } .fd-card--large { height: 320px; } }

/* ── REELS SECTION ──────────────────────────────────────── */
.reels-section { padding:90px 0 100px; background:#F5F5F2; }
.reels-header { text-align:center; margin-bottom:48px; }
.reels-eyebrow { font-size:12px; font-weight:700; letter-spacing:3px; color:#999; margin-bottom:10px; text-transform:uppercase; }
.reels-title { font-size:26px; font-weight:900; letter-spacing:2px; color:#111111; text-transform:uppercase; }
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
.reels-follow-btn { display:inline-flex; align-items:center; gap:10px; height:48px; padding:0 32px; border:1.5px solid #111111; color:#111111; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; text-decoration:none; transition:all .3s ease; border-radius:2px; }
.reels-follow-btn:hover { background:#e71318; color:#fff; border-color:#e71318; }
@media(max-width:1024px) { .reels-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:480px) { .reels-grid { grid-template-columns:repeat(2,1fr); gap:8px; } }

/* ── LOOKBOOK IMAGES ROW ────────────────────────────────── */
.lace-row-section { padding: 36px 0 48px; }
.lace-row { display: flex;  gap: 5px; }
.lace-card { overflow: hidden; position: relative; }
.lace-card .category-image-wrapper { position: relative; }
.lace-card .category-image-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35);
    pointer-events: none;
    transition: background .3s ease;
}
.lace-card:hover .category-image-wrapper::after { background: rgba(0, 0, 0, 0.2); }
.lace-card .category-image { width: 100%; display: block; transition: transform .45s cubic-bezier(.2,.9,.2,1), filter .3s ease; }
.lookbook-label {
    position: absolute;
    left: 14px;
    bottom: 14px;
    z-index: 2;
    background: rgba(255,255,255,.92);
    color: #111;
    padding: 8px 12px;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 1.4px;
    text-transform: uppercase;
}
@media(max-width:1024px) { .lace-row { grid-template-columns: repeat(2, 1fr); } .lace-card .category-image { height: 180px; } }
@media(max-width:480px) { .lace-row { grid-template-columns: repeat(1, 1fr); } .lace-card .category-image { height: 160px; } }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => loader.classList.add('hide'), 1400);

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => io.observe(el));
});
</script>
@endpush
