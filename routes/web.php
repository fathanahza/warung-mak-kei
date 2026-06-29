<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\WishlistController;
use App\Http\Controllers\Public\NewsletterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\BannerAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ──────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/search', [ProductController::class, 'search'])->name('search');  // AJAX
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
    Route::post('/{product}/whatsapp-click', [ProductController::class, 'trackWhatsapp'])->name('whatsapp.click');
});

// Contact
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::post('/whatsapp-click', [ContactController::class, 'trackWhatsapp'])->name('whatsapp.click');
});

// Wishlist (session-based)
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/toggle/{product}', [WishlistController::class, 'toggle'])->name('toggle');
    Route::delete('/remove/{product}', [WishlistController::class, 'remove'])->name('remove');
});

// Newsletter
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ─── ADMIN ROUTES ────────────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('products', ProductAdminController::class);
    Route::delete('/products/{product}/image/{image}', [ProductAdminController::class, 'destroyImage'])
        ->name('products.image.destroy');
    Route::post('/products/{product}/toggle-featured', [ProductAdminController::class, 'toggleFeatured'])
        ->name('products.toggle-featured');
    Route::post('/products/{product}/toggle-bestseller', [ProductAdminController::class, 'toggleBestSeller'])
        ->name('products.toggle-bestseller');

    // Kategori
    Route::resource('categories', CategoryAdminController::class);

    // Banner Promosi
    Route::resource('banners', BannerAdminController::class);
    Route::post('/banners/{banner}/toggle', [BannerAdminController::class, 'toggle'])
        ->name('banners.toggle');

    // Testimoni
    Route::resource('testimonials', TestimonialAdminController::class);

    // FAQ
    Route::resource('faqs', FaqAdminController::class);

    // Pesan Masuk
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactAdminController::class, 'index'])->name('index');
        Route::get('/{contactMessage}', [ContactAdminController::class, 'show'])->name('show');
        Route::patch('/{contactMessage}/status', [ContactAdminController::class, 'updateStatus'])->name('status');
        Route::delete('/{contactMessage}', [ContactAdminController::class, 'destroy'])->name('destroy');
    });

    // Pengaturan Website
    Route::get('/settings', [SettingAdminController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingAdminController::class, 'update'])->name('settings.update');

});

// Auth routes (Breeze)
require __DIR__ . '/auth.php';

// ─── SEO ROUTES ──────────────────────────────────────────────────────────────

Route::get('/sitemap.xml', function () {
    return response()->view('seo.sitemap', [
        'products'   => \App\Models\Product::active()->latest()->get(),
        'categories' => \App\Models\Category::active()->get(),
    ])->header('Content-Type', 'text/xml');
})->name('sitemap');
