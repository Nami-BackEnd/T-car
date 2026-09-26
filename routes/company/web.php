<?php

use App\Http\Controllers\Company\AuthController;
use App\Http\Controllers\Company\BranchController;
use App\Http\Controllers\Company\CarController;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\DriverController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\PageController;
use App\Http\Controllers\Company\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Company Panel Routes (T-Car dashboard template)
|--------------------------------------------------------------------------
*/

// Guest routes
Route::middleware(['guest:company', 'company.locale'])->prefix('company')->name('company.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
});

// Public AJAX endpoints
Route::middleware('company.locale')->prefix('company')->name('company.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('lang', [AuthController::class, 'switchLang'])->name('lang.switch');
});

// Authenticated routes
Route::middleware(['auth:company', 'company.locale'])->prefix('company')->name('company.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');

    // Reservations
    Route::get('reservations', [PageController::class, 'show'])->defaults('page', 'reservations')->name('reservations');
    Route::get('late-delivery', [PageController::class, 'show'])->defaults('page', 'late-delivery')->name('late-delivery');
    Route::get('delivery-reservations', [PageController::class, 'show'])->defaults('page', 'delivery-reservations')->name('delivery-reservations');
    Route::get('pending-reservations', [PageController::class, 'show'])->defaults('page', 'pending-reservations')->name('pending-reservations');
    Route::get('scheduled-reservations', [PageController::class, 'show'])->defaults('page', 'scheduled-reservations')->name('scheduled-reservations');
    Route::get('return-reservations', [PageController::class, 'show'])->defaults('page', 'return-reservations')->name('return-reservations');

    // Invoices & orders
    Route::get('invoices', [PageController::class, 'show'])->defaults('page', 'invoices')->name('invoices');
    Route::get('order-updates', [PageController::class, 'show'])->defaults('page', 'order-updates')->name('order-updates');
    Route::get('orders', [PageController::class, 'show'])->defaults('page', 'orders')->name('orders');
    Route::get('subscriptions', [PageController::class, 'show'])->defaults('page', 'subscriptions')->name('subscriptions');

    // Offers & discounts
    Route::get('discounts', [PageController::class, 'show'])->defaults('page', 'discounts')->name('discounts');
    Route::get('trending', [PageController::class, 'show'])->defaults('page', 'trending')->name('trending');
    Route::get('special-offers', [PageController::class, 'show'])->defaults('page', 'special-offers')->name('special-offers');

    // Performance
    Route::get('employee-performance', [PageController::class, 'show'])->defaults('page', 'employee-performance')->name('employee-performance');

    // Branches
    Route::get('branches', [PageController::class, 'show'])->defaults('page', 'branches')->name('branches');
    Route::get('branches/data', [BranchController::class, 'index'])->name('branches.data');
    Route::get('branches/export', [BranchController::class, 'export'])->name('branches.export');
    Route::post('add-office', [BranchController::class, 'store'])->name('add-office.store');
    Route::get('add-office/options', [BranchController::class, 'options'])->name('add-office.options');
    Route::put('edit-office/{branch}', [BranchController::class, 'update'])->name('edit-office.update');
    Route::get('edit-office/{branch}', [BranchController::class, 'show'])->name('edit-office.show');
    Route::delete('branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
    Route::get('add-office', [PageController::class, 'show'])->defaults('page', 'add-office')->name('add-office');
    Route::get('edit-office', [PageController::class, 'show'])->defaults('page', 'add-office')->name('edit-office');

    // Official holidays (admin adds, company activates)
    Route::get('official-holidays', [PageController::class, 'show'])->defaults('page', 'official-holidays')->name('official-holidays');
    Route::get('official-holidays/data', [HolidayController::class, 'index'])->name('official-holidays.data');
    Route::post('official-holidays/{vacation}/toggle', [HolidayController::class, 'toggle'])->name('official-holidays.toggle');
    Route::post('official-holidays/{vacation}/duration', [HolidayController::class, 'updateDuration'])->name('official-holidays.duration');
    Route::get('office-details', [PageController::class, 'show'])->defaults('page', 'office-details')->name('office-details');

    // Cars
    Route::get('car-availability', [CarController::class, 'availability'])->name('car-availability');
    Route::put('car-availability/{car}/stock', [CarController::class, 'updateAvailabilityStock'])->name('car-availability.stock');
    Route::post('car-availability/{car}/toggle', [CarController::class, 'toggleAvailability'])->name('car-availability.toggle');
    Route::get('license-plates', [CarController::class, 'licensePlates'])->name('license-plates');
    Route::get('office-cars', [CarController::class, 'index'])->name('office-cars');
    Route::put('office-cars/{car}/stocks', [CarController::class, 'updateStocks'])->name('office-cars.stocks');
    Route::delete('edit-car/{car}', [CarController::class, 'destroy'])->name('edit-car.destroy');
    Route::get('add-car', [PageController::class, 'show'])->defaults('page', 'add-car')->name('add-car');
    Route::get('edit-car', [PageController::class, 'show'])->defaults('page', 'edit-car')->name('edit-car');
    Route::get('add-car/options', [CarController::class, 'options'])->name('add-car.options');
    Route::post('add-car', [CarController::class, 'store'])->name('add-car.store');
    Route::get('edit-car/{car}', [CarController::class, 'show'])->name('edit-car.show');
    Route::put('edit-car/{car}', [CarController::class, 'update'])->name('edit-car.update');

    // Users
    Route::get('managers-employees', [PageController::class, 'show'])->defaults('page', 'managers-employees')->name('managers-employees');
    Route::get('add-company-manager', [PageController::class, 'show'])->defaults('page', 'add-company-manager')->name('add-company-manager');
    Route::get('edit-company-manager', [PageController::class, 'show'])->defaults('page', 'edit-company-manager')->name('edit-company-manager');
    Route::get('drivers', [PageController::class, 'show'])->defaults('page', 'drivers')->name('drivers');
    Route::get('drivers/data', [DriverController::class, 'index'])->name('drivers.data');
    Route::get('drivers/export', [DriverController::class, 'export'])->name('drivers.export');
    Route::get('drivers/{driver}', [DriverController::class, 'show'])->name('drivers.show');
    Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::patch('drivers/{driver}/status', [DriverController::class, 'toggleStatus'])->name('drivers.status');
    Route::delete('drivers/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');
    Route::get('add-driver', [PageController::class, 'show'])->defaults('page', 'add-driver')->name('add-driver');
    Route::get('add-driver/options', [DriverController::class, 'options'])->name('add-driver.options');
    Route::get('edit-driver/{driver}', [PageController::class, 'show'])->defaults('page', 'edit-driver')->name('edit-driver');
    Route::put('edit-driver/{driver}', [DriverController::class, 'update'])->name('edit-driver.update');

    // Bookings
    Route::get('create-booking', [PageController::class, 'show'])->defaults('page', 'create-booking')->name('create-booking');
    Route::get('booking-details', [PageController::class, 'show'])->defaults('page', 'booking-details')->name('booking-details');
    Route::get('booking-details-two', [PageController::class, 'show'])->defaults('page', 'booking-details-two')->name('booking-details-two');
    Route::get('payment-collection', [PageController::class, 'show'])->defaults('page', 'payment-collection')->name('payment-collection');

    // Profile & system
    Route::get('edit-profile', [PageController::class, 'show'])->defaults('page', 'edit-profile')->name('edit-profile');
    Route::get('settings', [SettingsController::class, 'edit'])->name('settings');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('support', [PageController::class, 'show'])->defaults('page', 'support')->name('support');
});
