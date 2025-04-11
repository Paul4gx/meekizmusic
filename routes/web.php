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

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Marketplace routes
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/', [MarketplaceController::class, 'index'])->name('index');
    Route::get('/afrobeat', [MarketplaceController::class, 'afrobeat'])->name('afrobeat');
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
    
    // Beats
    Route::get('/beats/{beat}', [BeatController::class, 'show'])->name('beats.show');
    
    // Checkout
    Route::get('/checkout/{beat}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/initialize', [CheckoutController::class, 'initialize'])->name('checkout.initialize');
    Route::get('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
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
    
    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
