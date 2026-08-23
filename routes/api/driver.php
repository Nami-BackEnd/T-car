<?php

use App\Http\Controllers\Api\Driver\DriverAuthController;
use App\Http\Controllers\Api\Driver\DriverNotificationController;
use App\Http\Controllers\Api\Driver\DriverSettingController;
use App\Http\Controllers\Api\Driver\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::prefix('driver')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [DriverAuthController::class, 'login']);
        Route::post('/verify-otp', [DriverAuthController::class, 'verifyOtp']);

    });
    Route::get('/settings', [DriverSettingController::class, 'settings']);
     Route::get('/faqs', [DriverSettingController::class, 'faqs']);
});
Route::middleware('auth:sanctum')->prefix('driver')->name('api.driver.')->group(function () {
     Route::post('/store-fcm-token', [DriverNotificationController::class, 'store']);
     Route::get('/settings', [DriverSettingController::class, 'settings']);
     Route::post('/contact-us', [ContactUsController::class, 'store']);
     Route::post('/change-lang', [DriverAuthController::class, 'changeLang']);
});
