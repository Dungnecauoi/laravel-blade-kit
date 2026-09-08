<x-layouts.admin :title="__('Tổng quan')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($stats as $stat)
            <x-admin.stat-card
                :label="$stat['label']"
                :value="$stat['value']"
                :change="$stat['change']"
                :trend="$stat['trend']"
                :icon="$stat['icon']"
            />
        @endforeach
    </div>

    <x-admin.card :title="__('Người dùng mới')" :subtitle="__('5 người dùng đăng ký gần nhất')" :padding="false">
        <x-slot:actions>
            <x-admin.button :href="route('admin.ui-kit')" variant="secondary" size="sm">{{ __('Xem UI Kit') }}</x-admin.button>
        </x-slot:actions>

        <x-admin.table :headers="[__('Tên'), __('Email'), __('Vai trò'), __('Trạng thái'), '']" class="rounded-none ring-0">
            @foreach($recentUsers as $user)
                <tr>
                    <td class="flex items-center gap-x-3 whitespace-nowrap px-4 py-3">
                        <x-admin.avatar :name="$user['name']" size="sm" />
                        <span class="font-medium text-neutral-900">{{ $user['name'] }}</span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-neutral-500">{{ $user['email'] }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-neutral-500">{{ $user['role'] }}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <x-admin.badge :color="$user['status'] === 'active' ? 'success' : 'neutral'">
                            {{ $user['status'] === 'active' ? __('Hoạt động') : __('Ngừng hoạt động') }}
                        </x-admin.badge>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-right">
                        <x-admin.dropdown align="right">
                            <x-slot:trigger>
                                <button type="button" class="p-1 text-neutral-400 hover:text-neutral-600">
                                    <x-admin.icon name="dots-vertical" class="h-5 w-5" />
                                </button>
                            </x-slot:trigger>
                            <x-admin.dropdown-link href="#">{{ __('Sửa') }}</x-admin.dropdown-link>
                            <x-admin.dropdown-link href="#">{{ __('Xoá') }}</x-admin.dropdown-link>
                        </x-admin.dropdown>
                    </td>
                </tr>
            @endforeach
        </x-admin.table>
    </x-admin.card>
</x-layouts.admin>
