@props(['title' => null, 'maxWidth' => '4xl'])

@php
    $maxWidthClass = [
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
    ][$maxWidth] ?? 'max-w-4xl';
@endphp

<!DOCTYPE html>
<html lang="vi" class="h-full bg-neutral-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? "{$title} · " : '' }}{{ config('admin.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-neutral-900 antialiased" x-data>
    <div class="mx-auto w-full {{ $maxWidthClass }} px-4 py-8 sm:px-6 lg:px-0">
        {{ $slot }}
    </div>
</body>
</html>
