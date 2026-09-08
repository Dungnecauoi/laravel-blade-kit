@props(['code' => 404, 'title' => null, 'message' => null])

<!DOCTYPE html>
<html lang="vi" class="h-full bg-neutral-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $code }} · {{ config('admin.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-neutral-900 antialiased">
    <div class="flex min-h-full flex-col items-center justify-center px-4 py-12 text-center sm:px-6 lg:px-8">
        <p class="text-sm font-semibold text-primary-600">{{ $code }}</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl">
            {{ $title ?? __('Đã có lỗi xảy ra') }}
        </h1>
        <p class="mt-4 max-w-md text-base text-neutral-500">
            {{ $message ?? __('Xin lỗi, chúng tôi không thể xử lý yêu cầu này.') }}
        </p>

        <div class="mt-8 flex items-center gap-x-4">
            {{ $slot }}
            <x-admin.button variant="primary" :href="route('admin.dashboard')">
                {{ __('Về trang chủ') }}
            </x-admin.button>
        </div>
    </div>
</body>
</html>
