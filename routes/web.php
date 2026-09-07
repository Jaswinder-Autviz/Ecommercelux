<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\CustomerAccountController;
use App\Http\Controllers\Frontend\AffiliateAuthController;
use App\Http\Controllers\Frontend\AffiliateCouponController;
use App\Http\Controllers\Frontend\AffiliateWithdrawalController as FrontendAffiliateWithdrawalController;

// ─── Customer Auth (OTP only) ──────────────────────────────────────────────────
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/send-otp', [CustomerAuthController::class, 'sendOtp'])->name('customer.sendOtp');
Route::post('/customer/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verifyOtp');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// ─── Protected Customer Routes ─────────────────────────────────────────────────
Route::middleware(['customer.auth'])->group(function () {
    Route::get('/my-account', [CustomerAccountController::class, 'index'])->name('customer.account');
    Route::post('/my-account/profile/update', [CustomerAccountController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/my-account/addresses/store', [CustomerAccountController::class, 'storeAddress'])->name('customer.addresses.store');
    Route::post('/my-account/addresses/{id}/update', [CustomerAccountController::class, 'updateAddress'])->name('customer.addresses.update');
});

// ─── Frontend / Shop ───────────────────────────────────────────────────────────
Route::get('/', function () {
    $reels = \App\Models\InstagramReel::where('status', true)->orderBy('sort_order')->get();
    return view('frontend.home', compact('reels'));
})->name('home');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', fn() => view('frontend.cart.index'))->name('cart');
Route::get('/checkout', fn() => view('frontend.checkout'))->name('checkout');
Route::get('/wishlist', fn() => view('frontend.wishlist'))->name('wishlist');
Route::get('/contact', fn() => view('frontend.contact'))->name('contact');
Route::get('/about', fn() => view('frontend.about'))->name('about');

Route::post('/coupon/apply', [AffiliateCouponController::class, 'apply'])->name('coupon.apply');

// ─── Affiliate ─────────────────────────────────────────────────────────────────
Route::get('/affiliate/register', [AffiliateAuthController::class, 'showRegister'])->name('affiliate.register');
Route::post('/affiliate/register', [AffiliateAuthController::class, 'register'])->name('affiliate.register.post');
Route::get('/affiliate/login', [AffiliateAuthController::class, 'showLogin'])->name('affiliate.login');
Route::post('/affiliate/login', [AffiliateAuthController::class, 'login'])->name('affiliate.login.post');
Route::post('/affiliate/logout', [AffiliateAuthController::class, 'logout'])->name('affiliate.logout');
Route::middleware('affiliate.auth')->group(function () {
    Route::get('/affiliate/dashboard', [AffiliateAuthController::class, 'dashboard'])->name('affiliate.dashboard');
    Route::get('/affiliate/redeem', [FrontendAffiliateWithdrawalController::class, 'index'])->name('affiliate.redeem');
    Route::post('/affiliate/redeem', [FrontendAffiliateWithdrawalController::class, 'store'])->name('affiliate.redeem.store');
});

// ─── Payment ───────────────────────────────────────────────────────────────────
Route::post('/payment/create-order', [\App\Http\Controllers\Frontend\PaymentController::class, 'createOrder'])->name('payment.create');
Route::post('/payment/verify', [\App\Http\Controllers\Frontend\PaymentController::class, 'verifyPayment'])->name('payment.verify');
Route::post('/payment/submit-order', [\App\Http\Controllers\Frontend\PaymentController::class, 'submitOrder'])->name('payment.submit');
Route::get('/payment/success', fn() => view('frontend.payment-success'))->name('payment.success');

// ─── Admin ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', fn() => view('admin.auth.login'))->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::delete('/products/gallery-images/{productImage}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyGalleryImage'])->name('products.gallery-images.destroy');
        Route::delete('/products/{product}/main-image', [\App\Http\Controllers\Admin\ProductController::class, 'destroyMainImage'])->name('products.main-image.destroy');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show', 'destroy']);

        Route::prefix('affiliates')->name('affiliates.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AffiliateController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\AffiliateController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\AffiliateController::class, 'store'])->name('store');
            Route::get('/{affiliate}/edit', [\App\Http\Controllers\Admin\AffiliateController::class, 'edit'])->name('edit');
            Route::put('/{affiliate}', [\App\Http\Controllers\Admin\AffiliateController::class, 'update'])->name('update');
            Route::delete('/{affiliate}', [\App\Http\Controllers\Admin\AffiliateController::class, 'destroy'])->name('destroy');
            Route::post('/{affiliate}/approve', [\App\Http\Controllers\Admin\AffiliateController::class, 'approve'])->name('approve');
            Route::post('/{affiliate}/reject', [\App\Http\Controllers\Admin\AffiliateController::class, 'reject'])->name('reject');
        });

        Route::prefix('affiliate-withdrawals')->name('affiliate-withdrawals.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AffiliateWithdrawalController::class, 'index'])->name('index');
            Route::post('/{id}/approve', [\App\Http\Controllers\Admin\AffiliateWithdrawalController::class, 'approve'])->name('approve');
            Route::post('/{id}/mark-paid', [\App\Http\Controllers\Admin\AffiliateWithdrawalController::class, 'markPaid'])->name('mark-paid');
            Route::post('/{id}/reject', [\App\Http\Controllers\Admin\AffiliateWithdrawalController::class, 'reject'])->name('reject');
        });

        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

        Route::get('/reels', [\App\Http\Controllers\Admin\InstagramReelController::class, 'index'])->name('reels.index');
        Route::post('/reels', [\App\Http\Controllers\Admin\InstagramReelController::class, 'store'])->name('reels.store');
        Route::delete('/reels/{instagramReel}', [\App\Http\Controllers\Admin\InstagramReelController::class, 'destroy'])->name('reels.destroy');
    });
});
