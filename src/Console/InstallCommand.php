<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use SplFileInfo;

class InstallCommand extends Command
{
    protected $signature = 'blade-kit:install {--force : Overwrite files that already exist in the app}';

    protected $description = 'Copy the Blade Kit admin components, layout, services, and demo pages into this application';

    public function handle(Filesystem $files): int
    {
        $stubs = dirname(__DIR__, 2).'/stubs';
        $force = (bool) $this->option('force');

        $this->copyDirectory($files, "{$stubs}/resources/views", resource_path('views'), $force);
        $this->copyDirectory($files, "{$stubs}/app", app_path(), $force);
        $this->copyFile($files, "{$stubs}/config/admin.php", config_path('admin.php'), $force);
        $this->copyFile($files, "{$stubs}/resources/css/blade-kit.css", resource_path('css/blade-kit.css'), $force);
        $this->copyFile($files, "{$stubs}/resources/js/blade-kit.js", resource_path('js/blade-kit.js'), $force);
        $this->copyFile($files, "{$stubs}/routes/admin.php", base_path('routes/admin.php'), $force);
        $this->mergeLangJson($files, "{$stubs}/lang/en.json", base_path('lang/en.json'));

        $this->newLine();
        $this->components->info('Blade Kit files installed.');
        $this->printNextSteps();

        return self::SUCCESS;
    }

    private function copyDirectory(Filesystem $files, string $from, string $to, bool $force): void
    {
        foreach ($files->allFiles($from) as $file) {
            /** @var SplFileInfo $file */
            $relative = substr($file->getPathname(), strlen($from) + 1);
            $this->copyFile($files, $file->getPathname(), "{$to}/{$relative}", $force);
        }
    }

    private function copyFile(Filesystem $files, string $from, string $to, bool $force): void
    {
        if ($files->exists($to) && ! $force) {
            $this->components->twoColumnDetail($this->relative($to), '<fg=yellow>SKIPPED (exists)</>');

            return;
        }

        $files->ensureDirectoryExists(dirname($to));
        $files->copy($from, $to);
        $this->components->twoColumnDetail($this->relative($to), '<fg=green>copied</>');
    }

    private function mergeLangJson(Filesystem $files, string $from, string $to): void
    {
        $incoming = json_decode($files->get($from), true) ?? [];

        if ($files->exists($to)) {
            $existing = json_decode($files->get($to), true) ?? [];
            $incoming = array_merge($incoming, $existing);
        }

        $files->ensureDirectoryExists(dirname($to));
        $files->put($to, json_encode($incoming, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n");
        $this->components->twoColumnDetail($this->relative($to), '<fg=green>merged</>');
    }

    private function relative(string $path): string
    {
        return str_replace(base_path().'/', '', $path);
    }

    private function printNextSteps(): void
    {
        $this->newLine();
        $this->line('  <fg=yellow>Next steps (files below are intentionally left untouched):</>');
        $this->line('  1. npm install alpinejs @alpinejs/collapse axios');
        $this->line("  2. Import the kit's JS in resources/js/app.js:  import './blade-kit';");
        $this->line("  3. Import the kit's tokens in resources/css/app.css, right after @import 'tailwindcss':");
        $this->line("     @import './blade-kit.css';");
        $this->line('  4. Include the routes — add to routes/web.php:  require __DIR__.\'/admin.php\';');
        $this->line('  5. Register the middleware in bootstrap/app.php inside withMiddleware():');
        $this->line('     $middleware->web(append: [\App\Http\Middleware\SetLocale::class]);');
        $this->line('  6. Register the provider in bootstrap/providers.php:');
        $this->line('     App\Providers\AdminServiceProvider::class');
        $this->line('  7. (Optional) Set APP_LOCALE=vi in .env — English falls back automatically via lang/en.json.');
        $this->line('  8. npm run build');
        $this->newLine();
    }
}
