@extends('frontend.layouts.app')

@section('title', 'Hustler Posters — Premium Wall Art')

@section('content')

{{-- Page Loader --}}
<div id="page-loader">
    <div class="loader-inner">
        <div class="loader-frame" aria-hidden="true">
            <div class="loader-frame-inner">H</div>
        </div>
        <div class="loader-logo">HUSTLER</div>
        <div class="loader-copy">Curating your wall art</div>
        <div class="loader-dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>
    </div>
</div>

<div class="home-page">

    @include('frontend.components.hero-banner')

       {{-- Why Choose Us --}}
    <section class="container p-0">
        <div class="content-width">
        <div class="why-section">
            <div class="why-grid">
                <div class="why-card reveal" style="transition-delay:0s">
                    <div class="why-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <h3>Museum-Grade Print</h3>
                    <p>Archival inks on premium paper stock for colours that stay vivid for decades.</p>
                </div>
                <div class="why-card reveal" style="transition-delay:0.08s">
                    <div class="why-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3>Exclusive Designs</h3>
                    <p>Original artwork created in-house — you won't find these anywhere else.</p>
                </div>
                <div class="why-card reveal" style="transition-delay:0.16s">
                    <div class="why-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <h3>Multiple Sizes</h3>
                    <p>From compact desk art to statement wall pieces — every space covered.</p>
                </div>
                <div class="why-card reveal" style="transition-delay:0.24s">
                    <div class="why-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    </div>
                    <h3>Carefully Curated</h3>
                    <p>Every poster is hand-selected for visual impact, balance and room harmony.</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    
    @include('frontend.components.categories-grid')
    @include('frontend.components.choose')
    @include('frontend.components.new-arrivals-slider')
    @include('frontend.components.filter-product-section')

    {{-- Instagram Reels --}}
    @if(isset($reels) && $reels->count())
    <section class="reels-section">
        <div class="container p-0">
            <div class="content-width">
            <div class="reels-header reveal">
                <div class="reels-eyebrow">On the wall</div>
                <h2 class="reels-title">Hustler in Your Space</h2>
            </div>
            <div class="reels-grid">
                @foreach($reels as $index => $reel)
                <a href="{{ $reel->reel_url }}" target="_blank" rel="noopener" class="reel-card reveal" style="transition-delay:{{ $index * 0.08 }}s">
                    <div class="reel-inner">
                        <img src="{{ asset('assets/images/reels/' . $reel->thumbnail) }}" alt="Hustler wall art" class="reel-img" loading="lazy">
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
        </div>
    </section>
    @endif

</div>

@endsection

@push('styles')
<style>
/* ── Loader ─────────────────────────────────────────────── */
#page-loader{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:#000;color:#fff;transition:opacity .45s ease,visibility .45s ease}
#page-loader::before{content:'HUSTLER';position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);color:rgba(255,255,255,.03);font-size:clamp(74px,16vw,220px);font-weight:900;letter-spacing:0;line-height:.8;pointer-events:none}
#page-loader.hide{opacity:0;visibility:hidden;pointer-events:none}
.loader-inner{position:relative;z-index:1;text-align:center;display:flex;flex-direction:column;align-items:center}
.loader-frame{width:80px;height:100px;border:3px solid rgba(255,255,255,.9);background:#111;display:flex;align-items:center;justify-content:center;margin-bottom:20px;animation:frameFloat 1.4s ease-in-out infinite;box-shadow:0 0 40px rgba(231,19,24,.25)}
.loader-frame-inner{font-size:36px;font-weight:900;color:#e71318}
.loader-logo{font-size:22px;font-weight:900;letter-spacing:5px;margin-bottom:6px}
.loader-copy{color:rgba(255,255,255,.5);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:14px}
.loader-dots{display:flex;gap:8px;justify-content:center}
.loader-dots span{width:6px;height:6px;border-radius:50%;background:#e71318;animation:loaderDot .8s ease-in-out infinite}
.loader-dots span:nth-child(2){animation-delay:.12s}
.loader-dots span:nth-child(3){animation-delay:.24s}
@keyframes frameFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@keyframes loaderDot{0%,100%{transform:translateY(0);opacity:.35}50%{transform:translateY(-6px);opacity:1}}

/* ── Page ───────────────────────────────────────────────── */
.home-page{background:#fff;overflow:hidden}
.content-width{max-width:1400px;margin:0 auto;padding:0 20px}
.section-eyebrow{display:block;color:#e71318;font-size:11px;font-weight:900;letter-spacing:2.6px;line-height:1;text-transform:uppercase;margin-bottom:14px}
.reveal{opacity:0;transform:translateY(40px);transition:opacity 1.2s cubic-bezier(.22,1,.36,1),transform 1.2s cubic-bezier(.22,1,.36,1)}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-50px);transition:opacity 1.2s cubic-bezier(.22,1,.36,1),transform 1.2s cubic-bezier(.22,1,.36,1)}
.reveal-left.visible{opacity:1;transform:translateX(0)}
.reveal-right{opacity:0;transform:translateX(50px);transition:opacity 1.2s cubic-bezier(.22,1,.36,1),transform 1.2s cubic-bezier(.22,1,.36,1)}
.reveal-right.visible{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(0.95);transition:opacity 1.2s cubic-bezier(.22,1,.36,1),transform 1.2s cubic-bezier(.22,1,.36,1)}
.reveal-scale.visible{opacity:1;transform:scale(1)}

/* ── Hover Effects ──────────────────────────────────────── */
.why-card { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
.why-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

.reel-card { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
.reel-card:hover { transform: scale(1.02); z-index: 10; }

/* ── Smooth Scroll ──────────────────────────────────────── */
html { scroll-behavior: smooth; }

/* ── Why Section ────────────────────────────────────────── */
.why-section{background:#f8f9fa;margin:56px 0;padding:0}
.why-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0}
.why-card{position:relative;padding:32px 28px;border-right:1px solid rgba(0,0,0,.08);display:flex;flex-direction:column;align-items:flex-start;gap:10px;transition:background .3s ease}
.why-card::before{content:'';position:absolute;left:28px;right:28px;top:0;height:2px;background:#e71318;transform:scaleX(.2);transform-origin:left;transition:transform .3s ease}
.why-card:last-child{border-right:none}
.why-card:hover{background:#fff}
.why-card:hover::before{transform:scaleX(1)}
.why-icon{width:48px;height:48px;border:1px solid rgba(231,19,24,.3);display:flex;align-items:center;justify-content:center;color:#e71318;transition:all .3s ease}
.why-card:hover .why-icon{background:#e71318;color:#fff;border-color:#e71318}
.why-card h3{font-size:13px;font-weight:800;color:#111;letter-spacing:.5px;margin:0;text-transform:uppercase}
.why-card p{font-size:12px;color:rgba(0,0,0,.6);line-height:1.7;margin:0}

/* ── Promo Banner ───────────────────────────────────────── */
.promo-banner-section{padding:70px 0}
.promo-banner-inner{background:#000;display:grid;grid-template-columns:1fr auto;align-items:center;padding:60px 64px;position:relative;overflow:hidden}
.promo-banner-inner::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(231,19,24,.12) 0%,transparent 60%);pointer-events:none}
.promo-banner-eyebrow{display:block;font-size:11px;font-weight:800;letter-spacing:3px;text-transform:uppercase;color:#e71318;margin-bottom:14px}
.promo-banner-text h2{font-size:clamp(28px,3.5vw,48px);font-weight:900;color:#fff;line-height:1.1;margin:0 0 16px;letter-spacing:-1px}
.promo-banner-text p{color:rgba(255,255,255,.6);font-size:14px;line-height:1.7;margin:0 0 28px;max-width:480px}
.promo-banner-btn{display:inline-flex;align-items:center;gap:8px;background:#e71318;color:#fff;padding:14px 28px;font-size:12px;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;text-decoration:none;transition:background .25s ease,transform .25s ease}
.promo-banner-btn:hover{background:#fff;color:#000;transform:translateY(-2px)}
.promo-banner-deco{font-size:clamp(80px,10vw,140px);font-weight:900;color:rgba(255,255,255,.04);letter-spacing:-4px;line-height:1;user-select:none;flex-shrink:0}

/* ── Reels ──────────────────────────────────────────────── */
.reels-section{padding:80px 0 90px;background:#f7f7f7}
.reels-header{text-align:center;margin-bottom:44px}
.reels-eyebrow{font-size:11px;font-weight:700;letter-spacing:3px;color:#999;margin-bottom:10px;text-transform:uppercase}
.reels-title{font-size:24px;font-weight:900;letter-spacing:2px;color:#000;text-transform:uppercase}
.reels-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}
.reel-inner{position:relative;aspect-ratio:9/16;overflow:hidden;background:#111}
.reel-img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s cubic-bezier(.25,.46,.45,.94),filter .4s ease;filter:brightness(.85)}
.reel-card:hover .reel-img{transform:scale(1.06);filter:brightness(.5)}
.reel-overlay{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0;color:#fff;transition:opacity .35s ease}
.reel-card:hover .reel-overlay{opacity:1}
.reel-play{width:56px;height:56px;border:2px solid rgba(255,255,255,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.reel-badge{position:absolute;top:12px;left:12px;background:rgba(255,255,255,.12);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.2);color:#fff;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 10px}

@media(max-width:1024px){
    .why-grid{grid-template-columns:repeat(2,1fr)}
    .why-card{border-right:none;border-bottom:1px solid rgba(255,255,255,.08)}
    .reels-grid{grid-template-columns:repeat(2,1fr)}
    .promo-banner-inner{padding:44px 36px}
    .promo-banner-deco{display:none}
}
@media(max-width:640px){
    .why-grid{grid-template-columns:1fr}
    .promo-banner-inner{padding:36px 24px}
    .promo-banner-text h2{font-size:26px}
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('page-loader');
    if (loader) setTimeout(() => loader.classList.add('hide'), 900);

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 60);
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => io.observe(el));
});
</script>
@endpush
