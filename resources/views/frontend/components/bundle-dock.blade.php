{{-- Floating Bundle Dock and Progress Drawer --}}
<div class="bundle-dock-wrapper" id="bundleDock">

    {{-- Bottom Floating Bar --}}
    <div class="bundle-dock-bar">
        <div class="dock-left">
            <div class="dock-badge">
                <i class="fas fa-layer-group"></i>
                <span class="js-bundle-target-label">5 Poster Bundle</span>
            </div>
            <div class="dock-info">
                <div class="dock-title">
                    <span class="js-bundle-count-text">Selected: 0 / 5 Posters</span>
                </div>
                <div class="dock-progress-bar">
                    <div class="dock-progress-fill js-bundle-progress-fill" style="width: 0%;"></div>
                </div>
            </div>
        </div>

        <div class="dock-right">
            <button type="button" class="dock-btn dock-btn-outline js-dock-toggle">
                <i class="fas fa-images"></i> View Bundle
            </button>
            <button type="button" class="dock-btn dock-btn-primary js-bundle-buy-now disabled" disabled>
                <i class="fas fa-bolt"></i> Buy Now
            </button>
        </div>
    </div>

    {{-- Slide-up Full Bundle Drawer --}}
    <div class="bundle-dock-drawer">
        <div class="drawer-header">
            <div>
                <h3 class="drawer-title">WALL POSTER BUNDLE BUILDER</h3>
                <p class="drawer-subtitle">All posters are standard <strong>12 × 8 inches</strong>. Select unique posters to complete your bundle.</p>
            </div>
            <button type="button" class="drawer-close js-dock-close" aria-label="Close drawer">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Bundle Size Selector --}}
        <div class="bundle-size-toggle">
            <button type="button" class="bundle-size-btn js-bundle-size-btn active" data-size="5">
                5 Poster Bundle
            </button>
            <button type="button" class="bundle-size-btn js-bundle-size-btn" data-size="10">
                10 Poster Bundle
            </button>
        </div>

        {{-- Selected Posters Slots Grid --}}
        <div class="bundle-slots-grid js-bundle-thumbnails">
            {{-- Rendered dynamically by BundleManager.syncUI() --}}
        </div>

        <div class="drawer-footer">
            <div class="dock-info">
                <strong class="js-bundle-progress-text" style="font-size:14px;color:#fff;">0 of 5 posters selected</strong>
                <span style="font-size:12px;color:#888;">Add unique posters without duplicates</span>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="button" class="dock-btn dock-btn-outline js-bundle-add-cart disabled" disabled>
                    <i class="fas fa-shopping-bag"></i> Add Bundle to Cart
                </button>
                <button type="button" class="dock-btn dock-btn-primary js-bundle-buy-now disabled" disabled>
                    <i class="fas fa-bolt"></i> Buy Now
                </button>
            </div>
        </div>
    </div>

</div>
