<?php

namespace LaravelBladeKit;

use Illuminate\Support\ServiceProvider;
use LaravelBladeKit\Console\InstallCommand;

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
            ]);
        }
    }
}
