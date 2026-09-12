<?php

namespace App\Providers;

use App\Contracts\MenuServiceInterface;
use App\Services\Admin\MenuService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use LaravelCore\Settings\SettingsRegistry;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * MenuRegistry and SettingsRegistry are bound by duxbo/laravel-core's
     * own CoreServiceProvider (a real composer dependency of this kit, not
     * a file copied in here) — this provider only uses them, the same as
     * any other package would.
     */
    public function register(): void
    {
        $this->app->singleton(MenuServiceInterface::class, MenuService::class);
    }

    public function boot(): void
    {
        $this->registerCoreSettingsPanels();

        View::composer('admin.partials.sidebar-content', function ($view): void {
            $view->with('menuItems', $this->app->make(MenuServiceInterface::class)->items());
        });

        View::composer('components.layouts.admin', function ($view): void {
            $view->with('commands', $this->app->make(MenuServiceInterface::class)->flat());
        });

        Blade::if('routeActive', fn (string $pattern) => request()->routeIs($pattern));
    }

    /**
     * The app's own settings tabs, registered the same way a package would
     * register its own (see SettingsRegistry's docblock) — proves the
     * extension point by using it, instead of special-casing the core tabs.
     */
    private function registerCoreSettingsPanels(): void
    {
        $settings = $this->app->make(SettingsRegistry::class);

        $settings->register('profile', [
            'label' => 'Hồ sơ',
            'icon' => 'users',
            'view' => 'admin.settings.profile',
            'order' => 10,
        ]);

        $settings->register('permissions', [
            'label' => 'Bảo mật & phân quyền',
            'icon' => 'shield-check',
            'view' => 'admin.settings.permissions',
            'order' => 20,
        ]);

        $settings->register('appearance', [
            'label' => 'Giao diện',
            'icon' => 'swatch',
            'view' => 'admin.settings.appearance',
            'order' => 30,
        ]);
    }
}
