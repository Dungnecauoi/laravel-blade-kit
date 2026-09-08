<?php

namespace App\Providers;

use App\Contracts\MenuServiceInterface;
use App\Services\Admin\MenuService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bind admin-facing services here. Controllers and Blade views only ever
     * depend on the contract, never on the concrete implementation.
     */
    public function register(): void
    {
        $this->app->singleton(MenuServiceInterface::class, MenuService::class);
    }

    public function boot(): void
    {
        View::composer('admin.partials.sidebar-content', function ($view): void {
            $view->with('menuItems', $this->app->make(MenuServiceInterface::class)->items());
        });

        View::composer('components.layouts.admin', function ($view): void {
            $view->with('commands', $this->app->make(MenuServiceInterface::class)->flat());
        });

        Blade::if('routeActive', fn (string $pattern) => request()->routeIs($pattern));
    }
}
