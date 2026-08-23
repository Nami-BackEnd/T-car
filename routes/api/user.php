<?php

use App\Http\Controllers\Api\User\UserAuthController;
use App\Http\Controllers\Api\User\UserLicenseController;
use App\Http\Controllers\Api\User\ContactUsController;
use App\Http\Controllers\Api\User\JoinUsController;
use App\Http\Controllers\Api\User\UserNotificationController;
use App\Http\Controllers\Api\User\UserSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserWalletContorller;

Route::prefix('user')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/request-otp', [UserAuthController::class, 'requestOtp']);
        Route::post('/verify-otp', [UserAuthController::class, 'verifyOtp']);
    });
    Route::get('/settings', [UserSettingController::class, 'settings']);
    Route::get('/faqs', [UserSettingController::class, 'faqs']);
});

  
Route::middleware('auth:user')->prefix('user')->name('api.user.')->group(function () {
    Route::get('/profile', [UserAuthController::class, 'profile']);
    Route::post('/store-fcm-token', [UserNotificationController::class, 'store']);
    Route::post('/contact-us', [ContactUsController::class, 'store']);
    Route::post('/join-us', [JoinUsController::class, 'store']);
    Route::post('/complete-profile', [UserAuthController::class, 'completeProfile']);
    Route::post('/assign-location', [UserAuthController::class, 'assignLocation']);
    Route::post('/change-lang', [UserAuthController::class, 'changeLang']);
    Route::put('/update-profile', [UserAuthController::class, 'updateProfile']);
    Route::delete('/delete-account', [UserAuthController::class, 'deleteAccount']);
    Route::post('/license', [UserLicenseController::class, 'store']);
    Route::apiResource('wallet', UserWalletContorller::class);



});
