@props(['title' => null])

<!DOCTYPE html>
<html lang="vi" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? "{$title} · " : '' }}{{ config('admin.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-neutral-900 antialiased" x-data="{ mobileMenuOpen: false }">
    <header class="border-b border-neutral-200">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="flex shrink-0 items-center gap-x-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-sm font-bold text-white">
                    {{ mb_substr(config('admin.name'), 0, 1) }}
                </span>
                <span class="text-base font-semibold text-neutral-900">{{ config('admin.name') }}</span>
            </a>

            @isset($nav)
                <div class="hidden items-center gap-x-8 md:flex">
                    {{ $nav }}
                </div>
            @endisset

            @isset($cta)
                <div class="hidden items-center gap-x-3 md:flex">
                    {{ $cta }}
                </div>
            @endisset

            @if(isset($nav) || isset($cta))
                <button type="button" class="text-neutral-500 md:hidden" @click="mobileMenuOpen = ! mobileMenuOpen">
                    <span class="sr-only">{{ __('Mở menu') }}</span>
                    <x-admin.icon name="menu" class="h-6 w-6" />
                </button>
            @endif
        </nav>

        @if(isset($nav) || isset($cta))
            <div x-show="mobileMenuOpen" x-collapse x-cloak class="border-t border-neutral-100 px-4 py-4 md:hidden">
                <div class="flex flex-col gap-y-3">
                    {{ $nav ?? '' }}
                    {{ $cta ?? '' }}
                </div>
            </div>
        @endif
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>
