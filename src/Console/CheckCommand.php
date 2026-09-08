<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use LaravelBladeKit\Support\ComponentRegistry;

class CheckCommand extends Command
{
    protected $signature = 'blade-kit:check {paths?* : Directories to scan for <x-admin.xxx> / <x-layouts.xxx> usage — defaults to config(\'admin.check_paths\')}';

    protected $description = "Scan Blade views (e.g. another package's, installed under vendor/) for the blade-kit components they reference, and report which ones aren't installed in this app yet";

    public function handle(Filesystem $files): int
    {
        $paths = $this->argument('paths') ?: config('admin.check_paths', []);

        if ($paths === []) {
            $this->components->error('No paths to scan. Pass one or more directories, or set \'check_paths\' in config/admin.php.');

            return self::FAILURE;
        }

        $stubs = dirname(__DIR__, 2).'/stubs';
        $registry = new ComponentRegistry($files, $stubs);
        $viewsRoot = resource_path('views');

        $missing = [];
        $scanned = false;

        foreach ($paths as $path) {
            if (! $files->isDirectory($path)) {
                $this->components->warn("{$path}: not a directory, skipping.");

                continue;
            }

            $scanned = true;

            foreach ($registry->resolve($registry->scanUsedComponents($path)) as $name) {
                if (! $registry->exists($name) || $files->exists($registry->appPathFor($name, $viewsRoot))) {
                    continue;
                }

                $missing[$name][] = $path;
            }
        }

        if (! $scanned) {
            return self::FAILURE;
        }

        if ($missing === []) {
            $this->components->info('Every blade-kit component referenced in the scanned paths is installed here.');

            return self::SUCCESS;
        }

        $this->components->warn('Missing components:');

        foreach ($missing as $name => $sources) {
            $this->components->twoColumnDetail($name, 'needed by: '.implode(', ', array_unique($sources)));
        }

        $this->newLine();
        $this->line('Install them with: <fg=cyan>php artisan blade-kit:add '.implode(' ', array_keys($missing)).'</>');

        return self::FAILURE;
    }
}
