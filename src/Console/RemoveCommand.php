<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RemoveCommand extends Command
{
    protected $signature = 'blade-kit:remove {components* : Component names to remove}
                            {--force : Remove even if other views still reference it}';

    protected $description = 'Remove components this app no longer needs — refuses when another view still uses them';

    public function handle(Filesystem $files): int
    {
        $force = (bool) $this->option('force');
        $viewsRoot = resource_path('views');

        $targets = [];

        foreach ($this->argument('components') as $name) {
            $path = $this->locate($files, $viewsRoot, $name);

            if ($path === null) {
                $this->components->warn("{$name}: not installed here, skipping.");

                continue;
            }

            $targets[$name] = $path;
        }

        if ($targets === []) {
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
