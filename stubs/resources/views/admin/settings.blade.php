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

<x-layouts.admin :title="__('Cài đặt')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
        <x-admin.breadcrumb-item current>{{ __('Cài đặt') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <x-admin.tabs default="profile">
        <x-slot:tabs>
            <x-admin.tab-button value="profile">{{ __('Hồ sơ') }}</x-admin.tab-button>
            <x-admin.tab-button value="permissions">{{ __('Bảo mật & phân quyền') }}</x-admin.tab-button>
            <x-admin.tab-button value="appearance">{{ __('Giao diện') }}</x-admin.tab-button>
        </x-slot:tabs>

        <x-admin.tab-panel value="profile">
            <x-admin.card :title="__('Thông tin hồ sơ')" :subtitle="__('Cập nhật thông tin cá nhân của bạn')">
                <form action="#" method="POST" class="space-y-5">
                    @csrf

                    <x-admin.avatar-upload name="avatar" :label="__('Đổi ảnh đại diện')" />

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <x-admin.input name="settings_name" :label="__('Họ và tên')" value="Nguyễn Văn An" />
                        <x-admin.input type="email" name="settings_email" label="Email" value="an.nguyen@example.com" />
                    </div>

                    <x-admin.tag-input name="skills" :label="__('Kỹ năng')" :value="['Laravel', 'Tailwind CSS', 'Alpine.js']" :hint="__('Nhập rồi bấm Enter để thêm')" />

                    <div class="flex justify-end">
                        <x-admin.button type="submit" variant="primary">{{ __('Lưu thay đổi') }}</x-admin.button>
                    </div>
                </form>
            </x-admin.card>
        </x-admin.tab-panel>

        <x-admin.tab-panel value="permissions">
            <x-admin.card :title="__('Ma trận phân quyền')" :subtitle="__('Chọn quyền hạn cho từng vai trò')" :padding="false">
                <x-admin.permission-matrix :roles="$roles" :permission-groups="$permissionGroups" :checked="$checked" class="rounded-none ring-0" />
            </x-admin.card>
        </x-admin.tab-panel>

        <x-admin.tab-panel value="appearance">
            <x-admin.card :title="__('Giao diện')" :subtitle="__('Tuỳ chỉnh màu thương hiệu và chế độ hiển thị')">
                <div class="max-w-sm space-y-5">
                    <x-admin.color-picker name="accent_color" :label="__('Màu thương hiệu')" value="#4f46e5" />
                    <x-admin.toggle name="dark_mode" :label="__('Chế độ tối')" />
                </div>
            </x-admin.card>
        </x-admin.tab-panel>
    </x-admin.tabs>
</x-layouts.admin>
