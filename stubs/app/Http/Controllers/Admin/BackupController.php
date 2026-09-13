<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Backup\BackupDestination\BackupDestination;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * spatie/laravel-backup is headless (console commands only) — this
 * controller is the entire UI for it, calling the package's own
 * BackupDestination/Backup classes directly rather than reimplementing
 * how it enumerates or deletes backup files.
 */
class BackupController extends Controller
{
    public function index(): View
    {
        $name = config('backup.backup.name');
        $backups = collect();

        foreach (config('backup.backup.destination.disks', []) as $diskName) {
            $destination = BackupDestination::create($diskName, $name);

            foreach ($destination->backups()->all() as $backup) {
                $backups->push([
                    'disk' => $diskName,
                    'path' => $backup->path(),
                    'date' => $backup->date(),
                    'size' => $backup->sizeInBytes(),
                ]);
            }
        }

        return view('admin.backup.index', [
            'backups' => $backups->sortByDesc('date')->values(),
        ]);
    }

    /**
     * Runs synchronously — fine for a manual "back up now" click on an
     * app small enough to finish within the request timeout. A large app
     * should rely on the scheduled `backup:run` instead and use this
     * button only to check the result, not to kick off routine backups.
     */
    public function store(): RedirectResponse
    {
        $exitCode = Artisan::call('backup:run', ['--disable-notifications' => true]);

        return back()->with(
            $exitCode === 0 ? 'success' : 'error',
            $exitCode === 0 ? __('Sao lưu thành công.') : __('Sao lưu thất bại — xem log để biết chi tiết.')
        );
    }

    public function download(string $disk, string $path): StreamedResponse
    {
        return Storage::disk($disk)->download($path);
    }

    public function destroy(string $disk, string $path): RedirectResponse
    {
        Storage::disk($disk)->delete($path);

        return back()->with('success', __('Đã xoá bản sao lưu.'));
    }
}
