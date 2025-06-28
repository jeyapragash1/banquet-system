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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- SPECIAL SETUP ROUTE FOR RENDER DEPLOYMENT ---
// This route will be used by Render's Health Check to set up the database.
Route::get('/setup', function() {
    // Check if the database file exists, if not, create it.
    if (!file_exists(database_path('database.sqlite'))) {
        touch(database_path('database.sqlite'));
        \Illuminate\Support\Facades\Log::info('Created SQLite database file.');
    }

    // Run migrations and seeders. The --force flag is needed for production.
    Artisan::call('migrate:fresh', [
        '--seed' => true,
        '--force' => true
    ]);
    
    return 'Setup Complete: Database migrated and seeded successfully.';
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('You are absolutely right. I apologize. Here is the complete and final code for the `routes/web.php` file with the special `/setup` route included.

This is the only file you need to change fromprofile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::resource('events', EventController::class);
    Route::get('/events/{event}/invoice', [EventController::class, 'invoice'])->name('events.invoice');
    Route::resource('inventory-items', InventoryItemController::class);
    Route::get('/inventory-items/{inventoryItem}/stock-logs', [StockLogController::class, 'index'])->name('stock-logs.index');
    Route::post('/inventory-items/{inventoryItem}/stock- the previous step.

---

### **`routes/web.php` (Complete Final Version for Render)**

**Action:** Please replace the entire content of your `routes/web.php` file with this code.

```php
<?phplogs', [StockLogController::class, 'store'])->name('stock-logs.store');

    Route::middleware(['permission:access finance'])->group(function () {
        Route::resource('expenses', ExpenseController::class);
        Route::resource('packages', PackageController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
    });

    Route::middleware(['permission:manage users'])->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    });
});

require __DIR__.'/auth.php';