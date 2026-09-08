<?php

namespace LaravelBladeKit\Support;

use Illuminate\Filesystem\Filesystem;

/**
 * Scans the kit's own Blade components to build a dependency graph
 * (who references whom via <x-admin.xxx> / <x-layouts.xxx>), so
 * `blade-kit:add` / `blade-kit:remove` can resolve transitive
 * dependencies without a hand-maintained manifest that drifts out
 * of sync with the actual component source.
 */
class ComponentRegistry
{
    /**
     * Components that need more than a Blade file to work — PHP
     * classes, config, or lang wired through AdminServiceProvider.
     * Kept as a short, explicit list since these can't be scanned
     * from <x-admin.xxx> tags the way view-to-view deps can.
     *
     * @var array<string, list<string>>
     */
    private const EXTRA_FILES = [
        'sidebar' => [
            'resources/views/admin/partials/sidebar-content.blade.php',
            'app/Providers/AdminServiceProvider.php',
            'app/Services/Admin/MenuService.php',
            'app/Contracts/MenuServiceInterface.php',
            'config/admin.php',
        ],
        'command-palette' => [
            'app/Providers/AdminServiceProvider.php',
            'app/Services/Admin/MenuService.php',
            'app/Contracts/MenuServiceInterface.php',
            'config/admin.php',
        ],
        'locale-switcher' => [
            'app/Http/Controllers/LocaleController.php',
            'app/Http/Middleware/SetLocale.php',
            'config/admin.php',
            'lang/en.json',
        ],
    ];

    private string $componentsDir;

    private string $layoutsDir;

    /** @var array<string, list<string>> */
    private array $graph;

    public function __construct(
        private readonly Filesystem $files,
        private readonly string $stubsPath,
    ) {
        $this->componentsDir = "{$stubsPath}/resources/views/components/admin";
        $this->layoutsDir = "{$stubsPath}/resources/views/components/layouts";
        $this->graph = $this->buildGraph();
    }

    /** @return list<string> */
    public function all(): array
    {
        return array_keys($this->graph);
    }

    public function exists(string $name): bool
    {
        return array_key_exists($name, $this->graph);
    }

    /**
     * Resolve one or more component names into the full, deduplicated
     * set of components needed (itself + every transitive dependency).
     *
     * @param  list<string>  $names
     * @return list<string>
     */
    public function resolve(array $names): array
    {
        $resolved = [];

        $visit = function (string $name) use (&$visit, &$resolved): void {
            if (isset($resolved[$name])) {
                return;
            }

            $resolved[$name] = true;

            foreach ($this->graph[$name] ?? [] as $dependency) {
                $visit($dependency);
            }
        };

        foreach ($names as $name) {
            $visit($name);
        }

        return array_keys($resolved);
    }

    /**
     * Direct dependents of $name among the given $installed set
     * (used by `blade-kit:remove` to block breaking removals).
     *
     * @param  list<string>  $installed
     * @return list<string>
     */
    public function dependents(string $name, array $installed): array
    {
        return array_values(array_filter(
            $installed,
            fn (string $candidate) => $candidate !== $name && in_array($name, $this->graph[$candidate] ?? [], true),
        ));
    }

    public function stubPathFor(string $name): string
    {
        return $this->isLayout($name)
            ? "{$this->layoutsDir}/{$name}.blade.php"
            : "{$this->componentsDir}/{$name}.blade.php";
    }

    public function appPathFor(string $name, string $resourceViewsPath): string
    {
        return $this->isLayout($name)
            ? "{$resourceViewsPath}/components/layouts/{$name}.blade.php"
            : "{$resourceViewsPath}/components/admin/{$name}.blade.php";
    }

    /** @return list<string> relative stub paths, e.g. "app/Providers/AdminServiceProvider.php" */
    public function extraFilesFor(array $resolvedNames): array
    {
        $extras = [];

        foreach ($resolvedNames as $name) {
            foreach (self::EXTRA_FILES[$name] ?? [] as $extra) {
                $extras[$extra] = true;
            }
        }

        return array_keys($extras);
    }

    /**
     * Resolve $names plus every transitive dependency, including
     * components only referenced from a non-component "extra" Blade
     * view (e.g. sidebar's admin/partials/sidebar-content.blade.php
     * references <x-admin.sidebar-item>, which the component-to-
     * component graph alone would never see).
     *
     * @param  list<string>  $names
     * @return list<string>
     */
    public function resolveWithExtras(array $names): array
    {
        $resolved = $this->resolve($names);

        for ($i = 0; $i < 5; $i++) {
            $discovered = $this->extraComponentDependencies($resolved);
            $merged = $this->resolve(array_merge($resolved, $discovered));

            if ($merged === $resolved) {
                break;
            }

            $resolved = $merged;
        }

        return $resolved;
    }

    /** @return list<string> component names referenced from the extra Blade views of $resolvedNames */
    private function extraComponentDependencies(array $resolvedNames): array
    {
        $deps = [];

        foreach ($this->extraFilesFor($resolvedNames) as $relative) {
            if (! str_ends_with($relative, '.blade.php')) {
                continue;
            }

            $path = "{$this->stubsPath}/{$relative}";

            if (! $this->files->exists($path)) {
                continue;
            }

            foreach ($this->extractDependencies($this->files->get($path)) as $dep) {
                $deps[$dep] = true;
            }
        }

        return array_keys($deps);
    }

    private function isLayout(string $name): bool
    {
        return $this->files->exists("{$this->layoutsDir}/{$name}.blade.php");
    }

    /** @return array<string, list<string>> */
    private function buildGraph(): array
    {
        $graph = [];

        foreach ($this->files->glob("{$this->componentsDir}/*.blade.php") as $path) {
            $name = basename($path, '.blade.php');
            $graph[$name] = $this->extractDependencies($this->files->get($path));
        }

        foreach ($this->files->glob("{$this->layoutsDir}/*.blade.php") as $path) {
            $name = basename($path, '.blade.php');
            $graph[$name] = $this->extractDependencies($this->files->get($path));
        }

        return $graph;
    }

    /** @return list<string> */
    private function extractDependencies(string $source): array
    {
        preg_match_all('/<x-(?:admin|layouts)\.([a-z0-9-]+)/', $source, $matches);

        return array_values(array_unique($matches[1]));
    }
}
