@props(['label', 'variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
    $menuButtonClass = [
        'primary' => 'border-primary-500 bg-primary-600 text-white hover:bg-primary-500',
        'secondary' => 'border-neutral-300 bg-white text-neutral-900 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50',
        'danger' => 'border-danger-500 bg-danger-600 text-white hover:bg-danger-500',
    ][$variant] ?? '';
@endphp

<div {{ $attributes->class(['inline-flex rounded-md shadow-sm']) }}>
    <x-admin.button :variant="$variant" :href="$href" :type="$type" class="rounded-r-none">
        {{ $label }}
    </x-admin.button>

    <x-admin.dropdown align="right">
        <x-slot:trigger>
            <button type="button" class="inline-flex h-full items-center rounded-r-md border-l px-2 {{ $menuButtonClass }}">
                <span class="sr-only">{{ __('Tuỳ chọn khác') }}</span>
                <x-admin.icon name="chevron-down" class="h-4 w-4" />
            </button>
        </x-slot:trigger>

        {{ $slot }}
    </x-admin.dropdown>
</div>
