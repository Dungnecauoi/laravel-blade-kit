<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UiKitController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Route::get('locale/{locale}', LocaleController::class)->name('locale');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('ui-kit', UiKitController::class)->name('ui-kit');
});
