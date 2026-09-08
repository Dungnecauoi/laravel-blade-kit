<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use LaravelBladeKit\Support\ComponentRegistry;

class RemoveCommand extends Command
{
    protected $signature = 'blade-kit:remove {components?* : Component names to remove}
                            {--all : Remove every component currently installed here}
                            {--force : Remove even if other views still reference it}';

    protected $description = 'Remove components this app no longer needs — refuses when another view still uses them';

    public function handle(Filesystem $files): int
    {
        $force = (bool) $this->option('force');
        $viewsRoot = resource_path('views');
        $names = $this->resolveNames($files, $viewsRoot);

        if ($names === null) {
            $this->components->error('Provide one or more component names, or pass --all to remove everything installed here.');

            return self::FAILURE;
        }

        $targets = [];

        foreach ($names as $name) {
            $path = $this->locate($files, $viewsRoot, $name);

            if ($path === null) {
                $this->components->warn("{$name}: not installed here, skipping.");

                continue;
            }

            $targets[$name] = $path;
        }

        if ($targets === []) {
            if ($this->option('all')) {
                $this->components->info('Nothing installed here — nothing to remove.');
            }

            return self::SUCCESS;
        }

        $blocked = false;

        foreach ($targets as $name => $path) {
            $dependents = $this->findDependents($files, $viewsRoot, $name, array_keys($targets));

            if ($dependents !== [] && ! $force) {
                $this->components->error("Cannot remove '{$name}' — still used by: ".implode(', ', $dependents));
                $blocked = true;

                continue;
            }

            $files->delete($path);
            $this->components->twoColumnDetail($this->relative($path), '<fg=red>removed</>');
        }

        if ($blocked) {
            $this->newLine();
            $this->line('Pass <fg=cyan>--force</> to remove anyway — this will likely break the views listed above.');

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * @return list<string>|null null means the call was invalid (no names, no --all)
     */
    private function resolveNames(Filesystem $files, string $viewsRoot): ?array
    {
        if ($this->option('all')) {
            $stubs = dirname(__DIR__, 2).'/stubs';
            $registry = new ComponentRegistry($files, $stubs);

            return array_values(array_filter(
                $registry->all(),
                fn (string $name) => $files->exists($registry->appPathFor($name, $viewsRoot)),
            ));
        }

        $names = $this->argument('components');

        return $names !== [] ? $names : null;
    }

    private function locate(Filesystem $files, string $viewsRoot, string $name): ?string
    {
        foreach (["{$viewsRoot}/components/admin/{$name}.blade.php", "{$viewsRoot}/components/layouts/{$name}.blade.php"] as $candidate) {
            if ($files->exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    /**
     * @param  list<string>  $batchNames  components being removed together in this same call —
     *                                    they don't count as "blocking" each other.
     * @return list<string>
     */
    private function findDependents(Filesystem $files, string $viewsRoot, string $name, array $batchNames): array
    {
        $batchPaths = array_filter(array_map(
            fn (string $n) => $this->locate($files, $viewsRoot, $n),
            $batchNames,
        ));

        $dependents = [];
        $pattern = '/<x-(?:admin|layouts)\.'.preg_quote($name, '/').'\b/';

        foreach ($files->allFiles($viewsRoot) as $file) {
            $path = $file->getPathname();

            if (! str_ends_with($path, '.blade.php') || in_array($path, $batchPaths, true)) {
                continue;
            }

            if (preg_match($pattern, $files->get($path)) === 1) {
                $dependents[] = $this->relative($path);
            }
        }

        return $dependents;
    }

    private function relative(string $path): string
    {
        return str_replace(base_path().'/', '', $path);
    }
}
