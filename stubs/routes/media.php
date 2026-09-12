<?php

use Duxbo\Media\Http\Controllers\MediaController;
use Duxbo\Media\Http\Controllers\MediaFolderController;
use Illuminate\Support\Facades\Route;

// Reuses duxbo/laravel-media's own controllers directly — the exact same
// upload/validation/security logic its REST API uses — just mounted under
// the admin session (web + admin.auth) instead of a token-based API guard,
// so the Blade UI below calls it same-origin with the logged-in admin's
// session and a CSRF token, no Sanctum setup required.
//
// Requires `composer require duxbo/laravel-media` — not a dependency of
// this kit, since not every project needs a media library.
Route::middleware(['web', 'admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('media', 'admin.media.index')->name('media.index');

    Route::prefix('media')->name('media.')->group(function () {
        Route::get('items', [MediaController::class, 'index'])->name('items');
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::post('upload-multiple', [MediaController::class, 'uploadMultiple'])->name('upload-multiple');
        Route::post('bulk-delete', [MediaController::class, 'bulkDelete'])->name('bulk-delete');
        Route::delete('items/{id}', [MediaController::class, 'destroy'])->name('items.destroy');

        Route::prefix('folders')->name('folders.')->group(function () {
            Route::get('tree', [MediaFolderController::class, 'tree'])->name('tree');
            Route::post('/', [MediaFolderController::class, 'store'])->name('store');
            Route::put('{id}', [MediaFolderController::class, 'update'])->name('update');
            Route::delete('{id}', [MediaFolderController::class, 'destroy'])->name('destroy');
        });
    });
});
