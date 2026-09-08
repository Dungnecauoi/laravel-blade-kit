<?php

namespace LaravelBladeKit;

use Illuminate\Support\ServiceProvider;
use LaravelBladeKit\Console\AddCommand;
use LaravelBladeKit\Console\InstallCommand;
use LaravelBladeKit\Console\ListCommand;
use LaravelBladeKit\Console\RemoveCommand;

class BladeKitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                AddCommand::class,
                RemoveCommand::class,
                ListCommand::class,
            ]);
        }
    }
}
