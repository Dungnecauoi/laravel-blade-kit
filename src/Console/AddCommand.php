<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use LaravelBladeKit\Support\ComponentRegistry;
use LaravelBladeKit\Support\CopiesFiles;

class AddCommand extends Command
{
    use CopiesFiles;

    protected $signature = 'blade-kit:add {components* : Component names, e.g. button card table stat-card}
                            {--force : Overwrite files that already exist in the app}';

    protected $description = 'Install one or more specific components (and whatever they depend on) instead of the whole kit';

    public function handle(Filesystem $files): int
    {
        $stubs = dirname(__DIR__, 2).'/stubs';
        $force = (bool) $this->option('force');
        $registry = new ComponentRegistry($files, $stubs);

        $requested = $this->argument('components');
        $unknown = array_values(array_filter($requested, fn (string $name) => ! $registry->exists($name)));

        if ($unknown !== []) {
            $this->components->error('Unknown component(s): '.implode(', ', $unknown));
            $this->line('Run <fg=cyan>php artisan blade-kit:list</> to see available components.');

            return self::FAILURE;
        }

        $resolved = $registry->resolveWithExtras($requested);
        $extra = array_diff($resolved, $requested);

        if ($extra !== []) {
            $this->components->info('Also installing dependencies: '.implode(', ', $extra));
        }

        foreach ($resolved as $name) {
            $this->copyFile(
                $files,
                $registry->stubPathFor($name),
                $registry->appPathFor($name, resource_path('views')),
                $force,
            );
        }

        foreach ($registry->extraFilesFor($resolved) as $relative) {
            if ($relative === 'lang/en.json') {
                $this->mergeLangJson($files, "{$stubs}/{$relative}", base_path($relative));

                continue;
            }

            $this->copyFile($files, "{$stubs}/{$relative}", base_path($relative), $force);
        }

        $this->newLine();
        $this->components->info(sprintf('%d component(s) installed.', count($resolved)));

        return self::SUCCESS;
    }
}
