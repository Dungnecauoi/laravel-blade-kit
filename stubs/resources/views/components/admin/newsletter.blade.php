@props(['title' => null, 'description' => null, 'name' => 'email', 'placeholder' => null, 'action' => '#'])

<div {{ $attributes->class(['mx-auto max-w-2xl text-center']) }}>
    @if($title)
        <h2 class="text-2xl font-bold tracking-tight text-neutral-900 sm:text-3xl">{{ $title }}</h2>
    @endif

    @if($description)
        <p class="mt-3 text-neutral-500">{{ $description }}</p>
    @endif

    <form method="POST" action="{{ $action }}" class="mx-auto mt-6 flex max-w-md flex-col gap-3 sm:flex-row">
        @csrf
        <label for="{{ $name }}" class="sr-only">Email</label>
        <input
            type="email"
            name="{{ $name }}"
            id="{{ $name }}"
            required
            placeholder="{{ $placeholder ?? __('Nhập email của bạn') }}"
            class="block w-full min-w-0 flex-1 rounded-md border-0 px-3 py-2.5 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm"
        >
        <x-admin.button type="submit" variant="primary" class="shrink-0 justify-center">
            {{ __('Đăng ký') }}
        </x-admin.button>
    </form>
</div>
