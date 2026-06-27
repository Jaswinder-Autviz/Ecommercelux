@extends('frontend.layouts.app')

@section('title', 'Home - Hustler')

@section('content')

<div id="page-loader">
    <div class="loader-inner">
        <div class="loader-tee" aria-hidden="true">
            <div class="loader-tee-neck"></div>
            <div class="loader-tee-print">H</div>
            <div class="loader-tee-scan"></div>
        </div>
        <div class="loader-logo">HUSTLER</div>
        <div class="loader-copy">Printing the drop</div>
        <div class="loader-dots" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<div class="home-page">

    @include('frontend.components.hero-banner')

    <section class="container p-0">
        <div class="why-luxe-section">
            <div class="wl-row">
                <div class="wl-row-card reveal" style="transition-delay:0s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3>Premium Fabric</h3>
                    <p>Soft cotton blends selected for shape, comfort, and all-day street movement.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.1s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <h3>2-Day Delivery</h3>
                    <p>Fast dispatch with careful packing so your fresh fit reaches clean and ready.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.2s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                    </div>
                    <h3>Easy Exchanges</h3>
                    <p>Size not right? Exchange within 7 days with a simple, no-drama process.</p>
                </div>
                <div class="wl-row-card reveal" style="transition-delay:0.3s">
                    <div class="wl-row-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    </div>
                    <h3>Exclusive Drops</h3>
                    <p>Early access to limited graphics, seasonal colors, and pieces that move fast.</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.choose')
    @include('frontend.components.new-arrivals-slider')
    <!-- @include('frontend.components.categories-grid') -->
    @include('frontend.components.filter-product-section')

    @if(isset($reels) && $reels->count())
        <section class="reels-section">
            <div class="container p-0">
                <div class="reels-header reveal">
                    <div class="reels-eyebrow">Social proof</div>
                    <h2 class="reels-title">Hustler on the street</h2>
                </div>
                <div class="reels-grid">
                    @foreach($reels as $index => $reel)
                        <a href="{{ $reel->reel_url }}" target="_blank" rel="noopener" class="reel-card reveal" style="transition-delay:{{ $index * 0.08 }}s">
                            <div class="reel-inner">
                                <img src="{{ asset('assets/images/reels/' . $reel->thumbnail) }}" alt="Hustler reel" class="reel-img" loading="lazy">
                                <div class="reel-overlay">
                                    <div class="reel-play">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                <span class="reel-badge">Instagram</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>

@endsection

@push('styles')
<style>
#page-loader { position:fixed; inset:0; z-index:9999; display:flex; align-items:center; justify-content:center; background:#0b0b0b; color:#fff; transition:opacity .45s ease,visibility .45s ease; overflow:hidden; }
#page-loader::before { content:'HUSTLER'; position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); color:rgba(255,255,255,.035); font-size:clamp(74px,16vw,220px); font-weight:900; letter-spacing:0; line-height:.8; pointer-events:none; }
#page-loader.hide { opacity:0; visibility:hidden; pointer-events:none; }
.loader-inner { position:relative; z-index:1; width:min(320px,82vw); text-align:center; display:flex; flex-direction:column; align-items:center; }
.loader-tee { position:relative; width:132px; height:150px; margin-bottom:22px; border:3px solid rgba(255,255,255,.88); border-top-width:8px; border-radius:28px 28px 12px 12px; background:linear-gradient(145deg,#151515 0%,#050505 100%); box-shadow:0 24px 70px rgba(231,19,24,.18); animation:teeFloat 1.4s ease-in-out infinite; overflow:visible; }
.loader-tee::before,
.loader-tee::after { content:''; position:absolute; top:17px; width:44px; height:76px; border:3px solid rgba(255,255,255,.88); background:#090909; z-index:-1; }
.loader-tee::before { left:-42px; border-right:none; border-radius:18px 0 0 12px; transform:rotate(18deg); }
.loader-tee::after { right:-42px; border-left:none; border-radius:0 18px 12px 0; transform:rotate(-18deg); }
.loader-tee-neck { position:absolute; left:50%; top:-2px; width:54px; height:26px; border:4px solid rgba(255,255,255,.85); border-top:0; border-radius:0 0 32px 32px; transform:translateX(-50%); background:#0b0b0b; z-index:3; }
.loader-tee-print { position:absolute; left:50%; top:58%; width:64px; height:64px; display:flex; align-items:center; justify-content:center; transform:translate(-50%,-50%); border:2px solid rgba(231,19,24,.75); background:#e71318; color:#fff; font-size:32px; font-weight:900; line-height:1; box-shadow:0 0 24px rgba(231,19,24,.35); animation:printPulse 1.1s ease-in-out infinite; }
.loader-tee-scan { position:absolute; left:16px; right:16px; top:38px; height:3px; background:#fff; box-shadow:0 0 18px rgba(255,255,255,.9),0 0 32px rgba(231,19,24,.8); animation:printScan 1.1s ease-in-out infinite; }
.loader-logo { font-size:25px; font-weight:900; letter-spacing:4px; margin-bottom:8px; }
.loader-copy { color:rgba(255,255,255,.58); font-size:11px; font-weight:800; letter-spacing:2px; text-transform:uppercase; margin-bottom:15px; }
.loader-dots { display:flex; gap:8px; justify-content:center; }
.loader-dots span { width:7px; height:7px; border-radius:50%; background:#e71318; animation:loaderDot .8s ease-in-out infinite; }
.loader-dots span:nth-child(2) { animation-delay:.12s; }
.loader-dots span:nth-child(3) { animation-delay:.24s; }
@keyframes teeFloat { 0%,100%{ transform:translateY(0) rotate(-1deg); } 50%{ transform:translateY(-8px) rotate(1deg); } }
@keyframes printScan { 0%{ transform:translateY(0); opacity:.2; } 50%{ opacity:1; } 100%{ transform:translateY(82px); opacity:.2; } }
@keyframes printPulse { 0%,100%{ transform:translate(-50%,-50%) scale(.94); filter:saturate(1); } 50%{ transform:translate(-50%,-50%) scale(1); filter:saturate(1.4); } }
@keyframes loaderDot { 0%,100%{ transform:translateY(0); opacity:.35; } 50%{ transform:translateY(-6px); opacity:1; } }
.home-page { background:#fff; overflow:hidden; }
.section-eyebrow { display:block; color:#e71318; font-size:11px; font-weight:900; letter-spacing:2.6px; line-height:1; text-transform:uppercase; margin-bottom:14px; }
.reveal { opacity:0; transform:translateY(36px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal.visible { opacity:1; transform:translateY(0); }
.reveal-left { opacity:0; transform:translateX(-40px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal-left.visible { opacity:1; transform:translateX(0); }
.reveal-right { opacity:0; transform:translateX(40px); transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1); }
.reveal-right.visible { opacity:1; transform:translateX(0); }

.why-luxe-section { background:#f2f7f4; margin:50px 0; border:1px solid #e3ece6; }
.wl-row { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
.wl-row-card { padding:28px 30px; border-right:1px solid #dce8e0; display:flex; flex-direction:column; align-items:flex-start; gap:7px; transition:background .3s ease; }
.wl-row-card:last-child { border-right:none; }
.wl-row-card:hover { background:#fff; }
.wl-row-icon { width:52px; height:52px; border:1px solid #d7e2dc; background:#fff; display:flex; align-items:center; justify-content:center; color:#e71318; transition:all .3s ease; }
.wl-row-card:hover .wl-row-icon { background:#e71318; color:#fff; border-color:#e71318; }
.wl-row-card h3 { font-size:14px; font-weight:800; color:#111; letter-spacing:.5px; margin:0; }
.wl-row-card p { font-size:12px; color:#111; line-height:1.7; margin:0; }

.brand-story-section { padding:66px 0 18px; background:linear-gradient(180deg,#fff 0%,#f7f7f2 100%); overflow:hidden; }
.brand-story-grid { position:relative; display:grid; grid-template-columns:minmax(0,1.18fr) minmax(320px,.82fr); gap:14px; align-items:stretch; }
.brand-story-copy { position:relative; overflow:hidden; background:#111; padding:54px 48px; min-height:390px; display:flex; flex-direction:column; justify-content:center; color:#fff; }
.brand-story-copy::before { content:'HUSTLER'; position:absolute; right:-12px; bottom:-18px; color:rgba(255,255,255,.045); font-size:clamp(76px,12vw,160px); font-weight:900; line-height:.8; letter-spacing:0; pointer-events:none; }
.brand-story-copy::after { content:''; position:absolute; inset:18px; border:1px solid rgba(255,255,255,.10); pointer-events:none; }
.brand-story-copy .section-eyebrow { position:relative; z-index:1; color:#e71318; }
.brand-story-copy h2 { position:relative; z-index:1; max-width:720px; font-size:clamp(34px,4.8vw,64px); line-height:.98; font-weight:900; letter-spacing:0; color:#fff; margin:0 0 20px; text-transform:uppercase; }
.brand-story-copy p { position:relative; z-index:1; max-width:620px; color:rgba(255,255,255,.70); font-size:15px; line-height:1.8; margin:0 0 30px; }
.brand-story-actions { position:relative; z-index:1; display:flex; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:24px; }
.brand-story-btn { width:fit-content; background:#e71318; color:#fff; padding:15px 25px; text-decoration:none; font-size:12px; font-weight:900; letter-spacing:1.6px; text-transform:uppercase; transition:background .25s ease,transform .25s ease; }
.brand-story-btn:hover { background:#fff; color:#111; transform:translateY(-2px); }
.brand-story-note { color:rgba(255,255,255,.58); font-size:12px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase; }
.brand-story-tags { position:relative; z-index:1; display:flex; flex-wrap:wrap; gap:8px; }
.brand-story-tags span { border:1px solid rgba(255,255,255,.16); background:rgba(255,255,255,.06); color:rgba(255,255,255,.78); padding:8px 11px; font-size:11px; font-weight:800; letter-spacing:1.1px; line-height:1; text-transform:uppercase; }
.brand-story-stats { display:grid; gap:14px; }
.brand-stat { position:relative; overflow:hidden; min-height:120px; padding:28px; background:#fff; color:#111; border:1px solid #e8e8df; box-shadow:0 14px 36px rgba(17,17,17,.06); display:flex; flex-direction:column; justify-content:center; transition:transform .3s ease,border-color .3s ease,box-shadow .3s ease; }
.brand-stat::before { content:''; position:absolute; inset:0 auto 0 0; width:4px; background:#e71318; transform:scaleY(.35); transform-origin:top; transition:transform .3s ease; }
.brand-stat:hover { transform:translateX(-6px); border-color:#111; box-shadow:0 20px 44px rgba(17,17,17,.12); }
.brand-stat:hover::before { transform:scaleY(1); }
.brand-stat-index { position:absolute; right:22px; top:18px; color:rgba(231,19,24,.16); font-size:42px; font-weight:900; line-height:1; }
.brand-stat strong { position:relative; display:block; font-size:28px; font-weight:900; letter-spacing:.5px; text-transform:uppercase; }
.brand-stat span { position:relative; color:#666; font-size:12px; letter-spacing:1px; text-transform:uppercase; }
.brand-stat .brand-stat-index { position:absolute; right:22px; top:18px; color:rgba(231,19,24,.16); font-size:42px; }

.reels-section { padding:90px 0 100px; background:#f5f5f2; }
.reels-header { text-align:center; margin-bottom:48px; }
.reels-eyebrow { font-size:12px; font-weight:700; letter-spacing:3px; color:#999; margin-bottom:10px; text-transform:uppercase; }
.reels-title { font-size:26px; font-weight:900; letter-spacing:2px; color:#111; text-transform:uppercase; }
.reels-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
.reel-inner { position:relative; aspect-ratio:9/16; overflow:hidden; background:#111; }
.reel-img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .6s cubic-bezier(.25,.46,.45,.94),filter .4s ease; filter:brightness(.85); }
.reel-card:hover .reel-img { transform:scale(1.06); filter:brightness(.55); }
.reel-overlay { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; opacity:0; color:#fff; transition:opacity .35s ease; }
.reel-card:hover .reel-overlay { opacity:1; }
.reel-play { width:60px; height:60px; border:2px solid rgba(255,255,255,.85); border-radius:50%; display:flex; align-items:center; justify-content:center; }
.reel-badge { position:absolute; top:12px; left:12px; background:rgba(255,255,255,.15); backdrop-filter:blur(6px); border:1px solid rgba(255,255,255,.25); color:#fff; font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:4px 10px; }

@media(max-width:1024px) {
    .wl-row { grid-template-columns:repeat(2,1fr); }
    .wl-row-card { border-right:none; border-bottom:1px solid #dce8e0; }
    .reels-grid { grid-template-columns:repeat(2,1fr); }
}
@media(max-width:900px) {
    .brand-story-grid { grid-template-columns:1fr; gap:14px; }
    .brand-story-copy { min-height:360px; padding:42px 28px; }
    .brand-stat:hover { transform:translateY(-4px); }
}
@media(max-width:600px) {
    .wl-row { grid-template-columns:1fr; }
}
@media(max-width:520px) {
    .brand-story-section { padding:44px 0 12px; }
    .brand-story-copy { min-height:0; padding:36px 22px; }
    .brand-story-copy::after { inset:12px; }
    .brand-story-actions { align-items:flex-start; flex-direction:column; gap:12px; }
    .brand-story-btn { width:100%; text-align:center; }
    .brand-stat { min-height:112px; padding:24px 22px; }
    .brand-stat strong { font-size:24px; }
    .reels-grid { gap:8px; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('page-loader');
    if (loader) {
        setTimeout(() => loader.classList.add('hide'), 900);
    }

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
