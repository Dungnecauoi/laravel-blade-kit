@props(['title' => null, 'notifications' => []])

<div class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-x-4 border-b border-neutral-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-neutral-700 lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">{{ __('Mở menu') }}</span>
        <x-admin.icon name="menu" class="h-6 w-6" />
    </button>

    <div class="flex flex-1 items-center gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex flex-1 items-center gap-x-4">
            @if($title)
                <h1 class="text-lg font-semibold text-neutral-900">{{ $title }}</h1>
            @endif

            <button
                type="button"
                @click="$dispatch('open-command-palette')"
                class="hidden items-center gap-x-2 rounded-md bg-neutral-100 px-3 py-1.5 text-sm text-neutral-400 hover:bg-neutral-200 sm:flex"
            >
                <x-admin.icon name="search" class="h-4 w-4" />
                {{ __('Tìm kiếm...') }}
                <kbd class="ml-2 rounded border border-neutral-300 bg-white px-1 text-xs text-neutral-400">&#8984;K</kbd>
            </button>
        </div>

        <div class="flex items-center gap-x-4 lg:gap-x-6">
            <x-admin.locale-switcher />

            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-neutral-200" aria-hidden="true"></div>

            <x-admin.notification-panel :notifications="$notifications" />

            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-neutral-200" aria-hidden="true"></div>

            <x-admin.dropdown align="right" width="56">
                <x-slot:trigger>
                    <button type="button" class="flex items-center gap-x-2">
                        <span class="sr-only">{{ __('Mở menu người dùng') }}</span>
                        <x-admin.avatar :name="auth()->user()?->name ?? 'Admin'" size="sm" />
                        <span class="hidden lg:flex lg:items-center">
                            <span class="text-sm font-semibold text-neutral-900">{{ auth()->user()?->name ?? 'Admin' }}</span>
                            <x-admin.icon name="chevron-down" class="ml-1 h-4 w-4 text-neutral-400" />
                        </span>
                    </button>
                </x-slot:trigger>

                <x-admin.dropdown-link href="#">{{ __('Hồ sơ của tôi') }}</x-admin.dropdown-link>
                <x-admin.dropdown-link href="#">{{ __('Cài đặt tài khoản') }}</x-admin.dropdown-link>
                <div class="my-1 border-t border-neutral-100"></div>
                <x-admin.dropdown-link href="#">{{ __('Đăng xuất') }}</x-admin.dropdown-link>
            </x-admin.dropdown>
        </div>
    </div>
</div>
