<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockLogController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// This special route is only for deployment on Render. You can ignore it.
Route::get('/setup-application', function() {
    Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
    return 'Application Setup Complete.';
});


// --- PUBLIC-FACING ROUTES ---
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/packages', [FrontendController::class, 'packages'])->name('frontend.packages');
Route::get('/booking', [FrontendController::class, 'booking'])->name('frontend.booking');
Route::post('/booking', [FrontendController::class, 'storeBooking'])->name('frontend.booking.store');


// --- ADMIN AND AUTH ROUTES ---
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::resource('events', EventController::class);
    Route::get('/events/{event}/invoice', [EventController::class, 'invoice'])->name('events.invoice');
    Route::resource('inventory-items', InventoryItemController::class);
    Route::get('/inventory-items/{inventoryItem}/stock-logs', [StockLogController::class, 'index'])->name('stock-logs.index');
    Route::post('/inventory-items/{inventoryItem}/stock-logs', [StockLogController::class, 'store'])->name('stock-logs.store');

    Route::middleware(['role:Admin/Manager|Super Admin'])->group(function () {
        Route::resource('expenses', ExpenseController::class);
        Route::resource('packages', PackageController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
    });

    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

        // --- THIS IS THE MISSING PART THAT THIS FILE ADDS ---
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        // ---------------------------------------------------
    });
});

require __DIR__.'/auth.php';