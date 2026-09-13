<?php

use App\Http\Controllers\Admin\BackupController;
use Illuminate\Support\Facades\Route;

// Requires `composer require spatie/laravel-backup` — headless (console
// commands only), so this file and BackupController are the entire UI
// for it, calling that package's own BackupDestination/Backup classes
// directly rather than reimplementing how it enumerates or deletes files.
Route::middleware(['web', 'admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('backups', [BackupController::class, 'index'])->name('backups.index');
    Route::post('backups', [BackupController::class, 'store'])->name('backups.store');

    // Backup paths are "{disk-relative-dir}/{filename}.zip" — the {path}
    // segment needs to match slashes, hence the explicit constraint.
    Route::get('backups/{disk}/{path}/download', [BackupController::class, 'download'])
        ->where('path', '.*')->name('backups.download');
    Route::delete('backups/{disk}/{path}', [BackupController::class, 'destroy'])
        ->where('path', '.*')->name('backups.destroy');
});
