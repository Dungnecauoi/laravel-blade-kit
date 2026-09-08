<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin brand name
    |--------------------------------------------------------------------------
    */
    'name' => env('ADMIN_NAME', env('APP_NAME', 'Core Admin')),

    /*
    |--------------------------------------------------------------------------
    | Supported locales
    |--------------------------------------------------------------------------
    |
    | Shown in the language switcher. Keys must match a lang/{locale}.json
    | translation file (the default locale needs none, since its own strings
    | are the translation keys).
    |
    */
    'locales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sidebar appearance
    |--------------------------------------------------------------------------
    |
    | 'dark' (default) or 'light'.
    |
    */
    'sidebar_variant' => env('ADMIN_SIDEBAR_VARIANT', 'dark'),

    /*
    |--------------------------------------------------------------------------
    | Sidebar menu
    |--------------------------------------------------------------------------
    |
    | Data-driven navigation tree. Each entry accepts:
    |   label      string   display text
    |   icon       string   key handled by <x-admin.icon>
    |   route      string   named route, resolved + active-checked by MenuService
    |   url        string   plain fallback link when no route exists yet
    |   children   array    nested items, same shape
    |
    | Adding/removing menu items never touches Blade files.
    |
    */
    'menu' => [
        [
            'label' => 'Tổng quan',
            'icon' => 'home',
            'route' => 'admin.dashboard',
        ],
        [
            'label' => 'UI Kit',
            'icon' => 'puzzle',
            'route' => 'admin.ui-kit',
        ],
        [
            'label' => 'Quản lý',
            'icon' => 'folder',
            'children' => [
                ['label' => 'Người dùng', 'icon' => 'users', 'url' => '#'],
                ['label' => 'Vai trò & phân quyền', 'icon' => 'settings', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Kho hàng',
            'icon' => 'box',
            'route' => 'admin.inventory',
        ],
        [
            'label' => 'Đơn hàng',
            'icon' => 'truck',
            'route' => 'admin.orders.show',
        ],
        [
            'label' => 'Cài đặt',
            'icon' => 'settings',
            'route' => 'admin.settings',
        ],
    ],
];
