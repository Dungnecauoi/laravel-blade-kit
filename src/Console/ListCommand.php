<?php

namespace LaravelBladeKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use LaravelBladeKit\Support\ComponentRegistry;

class ListCommand extends Command
{
    protected $signature = 'blade-kit:list';

    protected $description = 'List every component available for blade-kit:add, and which are already installed here';

    public function handle(Filesystem $files): int
    {
        $stubs = dirname(__DIR__, 2).'/stubs';
        $registry = new ComponentRegistry($files, $stubs);
        $viewsRoot = resource_path('views');

        $names = $registry->all();
        sort($names);

        foreach ($names as $name) {
            $installed = $files->exists($registry->appPathFor($name, $viewsRoot));
            $status = $installed ? '<fg=green>installed</>' : '<fg=gray>available</>';
            $this->components->twoColumnDetail($name, $status);
        }

        $this->newLine();
        $this->line(sprintf('%d component(s) total. Install one with:', count($names)));
        $this->line('  php artisan blade-kit:add <name> [<name> ...]');

        return self::SUCCESS;
    }
}
