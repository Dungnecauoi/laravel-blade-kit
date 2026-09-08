@props([])

<div>
    {{-- Mobile off-canvas sidebar --}}
    <div class="relative z-50 lg:hidden" x-show="sidebarOpen" x-cloak>
        <div class="fixed inset-0 bg-neutral-900/80" x-show="sidebarOpen" x-transition.opacity></div>

        <div class="fixed inset-0 flex">
            <div
                class="relative mr-16 flex w-full max-w-xs flex-1"
                x-show="sidebarOpen"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                @click.outside="sidebarOpen = false"
            >
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="text-white" @click="sidebarOpen = false">
                        <span class="sr-only">{{ __('Đóng menu') }}</span>
                        <x-admin.icon name="x-mark" class="h-6 w-6" />
                    </button>
                </div>

                @include('admin.partials.sidebar-content')
            </div>
        </div>
    </div>

    {{-- Desktop static sidebar --}}
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col">
        @include('admin.partials.sidebar-content')
    </div>
</div>
