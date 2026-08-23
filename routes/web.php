<?php

use App\Http\Controllers\Api\User\UserWalletContorller;
use App\Http\Controllers\User\WebViewController as UserWebViewController;
use App\Http\Controllers\Driver\WebViewController as DriverWebViewController;
use Illuminate\Support\Facades\Route;

Route::get('wallet/pay/{transactionId}', [UserWalletContorller::class, 'pay'])->name('pay.wallet');
Route::get('wallet/success/{transactionId}', [UserWalletContorller::class, 'success'])->name('success.wallet');
Route::get('wallet/fail/{transactionId}', [UserWalletContorller::class, 'fail'])->name('fail.wallet');

Route::prefix('user')->name('user.web.')->group(function () {
    Route::get('/faqs', [UserWebViewController::class, 'faqs'])->name('faqs');
    Route::get('/terms', [UserWebViewController::class, 'terms'])->name('terms');
    Route::get('/about-us', [UserWebViewController::class, 'aboutUs'])->name('about-us');
    Route::get('/privacy', [UserWebViewController::class, 'privacyPolicy'])->name('privacy');
});

Route::prefix('driver')->name('driver.web.')->group(function () {
    Route::get('/faqs', [DriverWebViewController::class, 'faqs'])->name('faqs');
    Route::get('/terms', [DriverWebViewController::class, 'terms'])->name('terms');
    Route::get('/about-us', [DriverWebViewController::class, 'aboutUs'])->name('about-us');
    Route::get('/privacy', [DriverWebViewController::class, 'privacyPolicy'])->name('privacy');
});