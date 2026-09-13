<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UiKitController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Route::get('locale/{locale}', LocaleController::class)->name('locale');

// Public marketing page demo — uses x-layouts.guest, separate from the admin.* group below.
Route::view('landing', 'admin.landing')->name('landing');

// 'admin.auth' is a neutral alias registered by duxbo/laravel-core (a
// pass-through by default) — installing a real auth package overrides it,
// which is what actually turns login enforcement on for these routes.
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('ui-kit', UiKitController::class)->name('ui-kit');
    Route::view('settings', 'admin.settings')->name('settings');
    Route::view('inventory', 'admin.inventory')->name('inventory');
    Route::view('orders/1082', 'admin.orders.show')->name('orders.show');
    Route::view('invoice', 'admin.invoice')->name('invoice');
});

// Users/roles/permissions/login/register/... routes aren't here — they're
// owned entirely by duxbo/laravel-auth now (routes/auth.php,
// routes/admin-auth.php), copied into the app by its own
// `laravel-auth:install --stack=blade` command.

Route::prefix('errors-demo')->name('errors-demo.')->group(function () {
    Route::view('404', 'admin.errors.404')->name('404');
    Route::view('403', 'admin.errors.403')->name('403');
    Route::view('500', 'admin.errors.500')->name('500');
});
