<?php

namespace App\Services\Admin;

/**
 * Lets other service providers (your own, or a package's — laravel-auth,
 * laravel-media, laravel-seo, ...) add sidebar menu items without touching
 * config/admin.php. Call from any provider's boot():
 *
 *   app(MenuRegistry::class)->register([
 *       'label' => 'Media',
 *       'icon' => 'image',
 *       'route' => 'media.index',
 *   ]);
 *
 * Pass a $parentKey to nest under an existing item instead (config items
 * need a 'key' to be targetable — see config/admin.php):
 *
 *   app(MenuRegistry::class)->register($item, parentKey: 'management');
 */
class MenuRegistry
{
    /** @var list<array> */
    private array $items = [];

    /** @var array<string, list<array>> */
    private array $children = [];

    public function register(array $item, ?string $parentKey = null): static
    {
        if ($parentKey === null) {
            $this->items[] = $item;
        } else {
            $this->children[$parentKey][] = $item;
        }

        return $this;
    }

    /** @return list<array> */
    public function items(): array
    {
        return $this->items;
    }

    /** @return list<array> */
    public function childrenFor(string $parentKey): array
    {
        return $this->children[$parentKey] ?? [];
    }
}
