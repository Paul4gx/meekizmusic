<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PurchasedController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BeatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LicenseController;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/beats/previews/{filename}', [BeatController::class, 'preview']);

// Marketplace routes
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/', [MarketplaceController::class, 'index'])->name('index');
    Route::get('/afrobeat', [MarketplaceController::class, 'afrobeat'])->name('afrobeat');
    Route::get('/featured', [MarketplaceController::class, 'featured'])->name('featured');
});

// Authentication routes
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard and Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])->name('settings.account');
    
    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{beat}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    
    // Purchases
    Route::get('/purchased', [PurchasedController::class, 'index'])->name('purchased.index');
// The download route in your web.php routes file should look like this:
Route::get('/purchased/{order}/download', [PurchasedController::class, 'download'])->name('purchased.download');
Route::get('/license/{beat}', [LicenseController::class, 'download'])->name('license.download');

    // Beats
    Route::get('/beats/{beat}', [BeatController::class, 'show'])->name('beats.show');
    // Route::get('/beats/full/{filename}', [BeatController::class, 'full']);
    
    
    // Checkout
    Route::get('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
    Route::get('/checkout/{beat}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/initialize', [CheckoutController::class, 'initialize'])->name('checkout.initialize');
    
    //Play Beat
    

});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Beats Management
    Route::resource('beats', App\Http\Controllers\Admin\BeatController::class);
    
    // Users Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::patch('users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Orders Management
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::get('/orders/update-status', [App\Http\Controllers\Admin\AdminController::class, 'update-status'])->name('orders.update-status');
    
    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
