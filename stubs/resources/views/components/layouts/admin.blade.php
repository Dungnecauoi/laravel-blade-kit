@props(['title' => null, 'notifications' => []])

<!DOCTYPE html>
<html lang="vi" class="h-full bg-neutral-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? "{$title} · " : '' }}{{ config('admin.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-neutral-900 antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-full">
        <x-admin.sidebar />

        <div class="lg:pl-72">
            <x-admin.navbar :title="$title" :notifications="$notifications" />

            <main class="py-8">
                <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <x-admin.toast />
    <x-admin.command-palette :commands="$commands ?? []" />
</body>
</html>
