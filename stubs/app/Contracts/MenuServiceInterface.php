<?php

namespace App\Contracts;

interface MenuServiceInterface
{
    /**
     * Build the resolved admin sidebar menu tree.
     *
     * Each item: label, icon, url, route, active, children (same shape, recursive).
     *
     * @return array<int, array{label: string, icon: ?string, url: string, route: ?string, active: bool, children: array}>
     */
    public function items(): array;

    /**
     * Flatten the menu tree into leaf items only, for the command palette.
     *
     * @return array<int, array{label: string, icon: ?string, url: string, route: ?string, active: bool, children: array}>
     */
    public function flat(): array;
}
