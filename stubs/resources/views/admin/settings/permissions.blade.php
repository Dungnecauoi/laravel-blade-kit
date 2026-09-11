@php
    $roles = [
        ['key' => 'admin', 'label' => __('Quản trị viên')],
        ['key' => 'editor', 'label' => __('Biên tập viên')],
        ['key' => 'member', 'label' => __('Thành viên')],
    ];

    $permissionGroups = [
        __('Nội dung') => [
            ['key' => 'content.view', 'label' => __('Xem')],
            ['key' => 'content.create', 'label' => __('Tạo mới')],
            ['key' => 'content.delete', 'label' => __('Xoá')],
        ],
        __('Người dùng') => [
            ['key' => 'users.view', 'label' => __('Xem')],
            ['key' => 'users.manage', 'label' => __('Quản lý')],
        ],
        __('Hệ thống') => [
            ['key' => 'system.settings', 'label' => __('Cài đặt hệ thống')],
        ],
    ];

    $checked = [
        'admin' => ['content.view', 'content.create', 'content.delete', 'users.view', 'users.manage', 'system.settings'],
        'editor' => ['content.view', 'content.create', 'users.view'],
        'member' => ['content.view'],
    ];
@endphp

<x-admin.card :title="__('Ma trận phân quyền')" :subtitle="__('Chọn quyền hạn cho từng vai trò')" :padding="false">
    <x-admin.permission-matrix :roles="$roles" :permission-groups="$permissionGroups" :checked="$checked" class="rounded-none ring-0" />
</x-admin.card>
