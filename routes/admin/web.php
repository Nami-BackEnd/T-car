<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AlrtController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Dasher template)
|--------------------------------------------------------------------------
*/

// Guest routes
Route::middleware(['guest:admin', 'admin.locale'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
});

// Public AJAX endpoints
Route::middleware('admin.locale')->prefix('admin')->name('admin.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('lang', [AuthController::class, 'switchLang'])->name('lang.switch');
});

// Authenticated routes
Route::middleware(['auth:admin', 'admin.locale'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');

    // Users management (AJAX CRUD)
    Route::resource('users', UserController::class)->except(['show', 'create', 'edit']);

    // FAQs management (AJAX CRUD)
    Route::resource('faqs', FaqController::class)->except(['show', 'create', 'edit']);

    // Alerts management (AJAX CRUD)
    Route::resource('alrts', AlrtController::class)->except(['show', 'create', 'edit']);

    // Contact messages (AJAX: list, view, delete)
    Route::resource('contact-us', ContactUsController::class)
        ->parameters(['contact-us' => 'contact_us'])
        ->only(['index', 'show', 'destroy']);

    // Content management (singleton pages: user/driver tabs)
    Route::get('terms', [TermController::class, 'index'])->name('terms.index');
    Route::put('terms', [TermController::class, 'update'])->name('terms.update');
    Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::put('about-us', [AboutUsController::class, 'update'])->name('about-us.update');
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
    Route::put('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');
});

Route::middleware(['auth:admin', 'admin.locale'])
    ->get('/admin-dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');
