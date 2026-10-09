<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard redirect
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin CMS Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::match(['put', 'post'], '/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::resource('services', AdminServiceController::class);
    Route::match(['put', 'post'], 'portfolios/{portfolio}', [AdminPortfolioController::class, 'update'])->name('portfolios.update');
    Route::resource('portfolios', AdminPortfolioController::class)->except(['update']);
    Route::resource('faqs', AdminFaqController::class)->except(['create', 'show', 'edit']);
    Route::match(['put', 'post'], 'testimonials/{testimonial}', [AdminTestimonialController::class, 'update'])->name('testimonials.update');
    Route::resource('testimonials', AdminTestimonialController::class)->except(['create', 'show', 'edit', 'update']);
});

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
