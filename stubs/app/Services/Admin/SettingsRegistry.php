<?php

namespace App\Services\Admin;

use Illuminate\Support\Collection;

/**
 * Lets other service providers add a tab/panel to /admin/settings without
 * touching the settings page itself. Call from any provider's boot():
 *
 *   app(SettingsRegistry::class)->register('media', [
 *       'label' => 'Media',
 *       'icon' => 'image',
 *       'view' => 'laravel-media::settings-panel',
 *       'order' => 20,
 *   ]);
 *
 * The view is included as-is (no data passed in) — it's expected to be a
 * self-contained Blade file that computes whatever it needs, same as
 * resources/views/admin/settings/profile.blade.php does.
 */
class SettingsRegistry
{
    /** @var array<string, array> */
    private array $panels = [];

    public function register(string $key, array $panel): static
    {
        $this->panels[$key] = array_merge(['key' => $key, 'order' => 100], $panel);

        return $this;
    }

    /** @return list<array{key: string, label: string, icon: ?string, view: string, order: int}> */
    public function all(): array
    {
        return Collection::make($this->panels)
            ->sortBy('order')
            ->values()
            ->all();
    }
}
