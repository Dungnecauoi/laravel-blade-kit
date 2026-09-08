<?php

namespace App\Services\Admin;

use App\Contracts\MenuServiceInterface;
use Illuminate\Support\Facades\Route;

class MenuService implements MenuServiceInterface
{
    public function items(): array
    {
        return array_map(
            fn (array $item) => $this->resolve($item),
            config('admin.menu', []),
        );
    }

    public function flat(): array
    {
        return $this->flatten($this->items());
    }

    private function flatten(array $items): array
    {
        $flat = [];

        foreach ($items as $item) {
            if (! empty($item['children'])) {
                $flat = array_merge($flat, $this->flatten($item['children']));
            } elseif ($item['url'] !== '#') {
                $flat[] = $item;
            }
        }

        return $flat;
    }

    private function resolve(array $item): array
    {
        $children = array_map(
            fn (array $child) => $this->resolve($child),
            $item['children'] ?? [],
        );

        return [
            'label' => __($item['label']),
            'icon' => $item['icon'] ?? null,
            'route' => $item['route'] ?? null,
            'url' => $this->resolveUrl($item),
            'active' => $this->resolveActive($item, $children),
            'children' => $children,
        ];
    }

    private function resolveUrl(array $item): string
    {
        if (isset($item['route']) && Route::has($item['route'])) {
            return route($item['route']);
        }

        return $item['url'] ?? '#';
    }

    private function resolveActive(array $item, array $resolvedChildren): bool
    {
        if (isset($item['route']) && Route::has($item['route']) && request()->routeIs($item['route'])) {
            return true;
        }

        foreach ($resolvedChildren as $child) {
            if ($child['active']) {
                return true;
            }
        }

        return false;
    }
}
