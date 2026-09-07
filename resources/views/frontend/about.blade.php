@extends('frontend.layouts.app')

@section('title', 'About Us - Hustler')

@section('content')
<div class="about-page">
    <section class="about-hero">
        <div class="container about-hero-grid">
            <div class="about-hero-copy">
                <span class="about-eyebrow">Designed for considered spaces</span>
                <h1>Hustler turns blank walls into visual statements.</h1>
                <p>
                    We curate bold wall posters and modern art prints with gallery-inspired composition, dependable print quality, and a finish made for everyday spaces.
                </p>
            </div>
            <div class="about-hero-panel">
                <img src="{{ asset('assets/images/banners/swiper-banner.png') }}" alt="Hustler wall art collection" loading="eager">
                <div class="about-hero-badge">
                    <span>01</span>
                    <strong>Premium wall art</strong>
                    <p>Sharp compositions, rich color, and poster formats made to transform a room.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-story">
        <div class="container about-story-grid">
            <div class="about-story-lead">
                <span class="about-eyebrow">Our design point</span>
                <h2>Gallery energy, everyday spaces.</h2>
            </div>
            <div class="about-story-copy">
                <p>
                    Hustler started with a simple idea: wall art should change the feeling of a room in an instant. Every collection is shaped around strong composition, expressive color, and pieces that reward a closer look.
                </p>
                <p>
                    We keep the collection focused so every poster has a clear point of view, whether it belongs above a desk, in a living room, or at the center of a personal gallery wall.
                </p>
            </div>
        </div>
        <div class="container about-design-strip">
            <figure>
                <img src="{{ asset('assets/images/choose/choose1.png') }}" alt="Expressive anime wall art" loading="lazy">
                <figcaption>Expressive worlds</figcaption>
            </figure>
            <figure>
                <img src="{{ asset('assets/images/choose/choose2.png') }}" alt="Bold red wall art print" loading="lazy">
                <figcaption>Statement prints</figcaption>
            </figure>
            <figure>
                <img src="{{ asset('assets/images/choose/choose3.png') }}" alt="Modern orange wall art" loading="lazy">
                <figcaption>Modern energy</figcaption>
            </figure>
        </div>
    </section>

    <section class="about-values">
        <div class="container">
            <div class="about-values-header">
                <span class="about-eyebrow">What we care about</span>
                <h2>Made to elevate a room and last beyond a trend.</h2>
            </div>

            <div class="about-values-grid">
                <article class="about-value-card">
                    <span>01</span>
                    <h3>Quality First</h3>
                    <p>Thoughtful materials and dependable print quality for art you can live with every day.</p>
                </article>
                <article class="about-value-card">
                    <span>02</span>
                    <h3>Bold Graphics</h3>
                    <p>Artwork with personality, composed to become a focal point without overwhelming the room.</p>
                </article>
                <article class="about-value-card">
                    <span>03</span>
                    <h3>Easy Rotation</h3>
                    <p>Curated colors, formats, and themes that work across bedrooms, studios, offices, and living spaces.</p>
                </article>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
.about-page { background:#fff; color:#111; }
.about-hero { padding:86px 0 54px; background:linear-gradient(180deg,#fff 0%,#f7f7f2 100%); overflow:hidden; }
.about-hero-grid { display:grid; grid-template-columns:minmax(0,1.1fr) 360px; gap:18px; align-items:stretch; }
.about-hero-copy { position:relative; background:#111; color:#fff; padding:58px 52px; min-height:420px; display:flex; flex-direction:column; justify-content:center; overflow:hidden; }
.about-hero-copy::before { content:'HUSTLER'; position:absolute; right:-16px; bottom:-18px; color:rgba(255,255,255,.045); font-size:clamp(82px,13vw,170px); font-weight:900; line-height:.8; pointer-events:none; }
.about-hero-copy::after { content:''; position:absolute; inset:18px; border:1px solid rgba(255,255,255,.10); pointer-events:none; }
.about-eyebrow { position:relative; z-index:1; display:block; color:#e71318; font-size:11px; font-weight:900; letter-spacing:2.6px; line-height:1; text-transform:uppercase; margin-bottom:16px; }
.about-hero h1 { position:relative; z-index:1; max-width:720px; font-size:clamp(38px,5.2vw,72px); line-height:.96; font-weight:900; letter-spacing:0; text-transform:uppercase; margin:0 0 22px; }
.about-hero p { position:relative; z-index:1; max-width:620px; color:rgba(255,255,255,.72); font-size:15px; line-height:1.8; margin:0; }
.about-hero-panel { position:relative; background:#e71318; color:#fff; min-height:420px; overflow:hidden; }
.about-hero-panel img { width:100%; height:100%; min-height:420px; object-fit:cover; object-position:center top; display:block; }
.about-hero-panel::after { content:''; position:absolute; inset:0; background:linear-gradient(180deg,rgba(0,0,0,0) 35%,rgba(0,0,0,.78) 100%); pointer-events:none; }
.about-hero-badge { position:absolute; left:24px; right:24px; bottom:24px; z-index:1; }
.about-hero-badge span { display:block; font-size:56px; line-height:1; font-weight:900; color:rgba(255,255,255,.28); margin-bottom:12px; }
.about-hero-badge strong { display:block; font-size:26px; line-height:1.05; font-weight:900; text-transform:uppercase; margin-bottom:10px; }
.about-hero-badge p { color:rgba(255,255,255,.82); font-size:14px; line-height:1.7; margin:0; }
.about-story { padding:64px 0; }
.about-story-grid { display:grid; grid-template-columns:360px minmax(0,1fr); gap:70px; align-items:start; }
.about-story-lead h2, .about-values-header h2 { font-size:clamp(28px,3.8vw,48px); line-height:1; font-weight:900; letter-spacing:0; text-transform:uppercase; margin:0; }
.about-story-copy { display:grid; grid-template-columns:1fr 1fr; gap:36px; color:#555; font-size:15px; line-height:1.9; }
.about-story-copy p { margin:0; }
.about-design-strip { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-top:48px; }
.about-design-strip figure { position:relative; min-height:330px; overflow:hidden; margin:0; background:#111; }
.about-design-strip img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .35s ease; }
.about-design-strip figure:hover img { transform:scale(1.04); }
.about-design-strip figcaption { position:absolute; left:16px; right:16px; bottom:16px; background:rgba(0,0,0,.72); color:#fff; padding:12px 14px; font-size:11px; font-weight:900; letter-spacing:1.4px; line-height:1; text-transform:uppercase; }
.about-values { padding:62px 0 90px; background:#f7f7f2; }
.about-values-header { max-width:720px; margin-bottom:32px; }
.about-values-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.about-value-card { position:relative; background:#fff; border:1px solid #ecece7; padding:30px; min-height:210px; overflow:hidden; }
.about-value-card span { position:absolute; top:18px; right:22px; color:rgba(231,19,24,.16); font-size:42px; font-weight:900; line-height:1; }
.about-value-card h3 { position:relative; font-size:18px; font-weight:900; text-transform:uppercase; letter-spacing:0; margin:0 0 14px; }
.about-value-card p { position:relative; color:#666; font-size:14px; line-height:1.8; margin:0; }
@media (max-width: 900px) {
    .about-hero { padding:58px 0 36px; }
    .about-hero-grid, .about-story-grid, .about-story-copy, .about-values-grid { grid-template-columns:1fr; }
    .about-hero-copy { min-height:0; padding:42px 28px; }
    .about-hero-copy::after { inset:12px; }
    .about-hero-panel { min-height:320px; }
    .about-hero-panel img { min-height:320px; }
    .about-story-grid { gap:28px; }
    .about-story { padding:46px 0; }
    .about-design-strip { grid-template-columns:1fr; margin-top:34px; }
    .about-design-strip figure { min-height:360px; }
}
@media (max-width: 520px) {
    .about-hero-copy { padding:36px 22px; }
    .about-hero-badge span { font-size:52px; }
    .about-value-card { padding:26px 22px; min-height:180px; }
}
</style>
@endpush
