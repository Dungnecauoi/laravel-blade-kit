@props([])

<x-admin.dropdown align="right" width="48">
    <x-slot:trigger>
        <button type="button" class="flex items-center gap-x-1 text-sm font-medium text-neutral-500 hover:text-neutral-700">
            <span class="sr-only">{{ __('Ngôn ngữ') }}</span>
            <span class="uppercase">{{ app()->getLocale() }}</span>
            <x-admin.icon name="chevron-down" class="h-4 w-4" />
        </button>
    </x-slot:trigger>

    @foreach(config('admin.locales', []) as $code => $label)
        <a
            href="{{ route('locale', $code) }}"
            @class([
                'flex items-center justify-between gap-x-4 px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100',
                'font-semibold text-primary-600' => app()->getLocale() === $code,
            ])
        >
            {{ $label }}
            @if(app()->getLocale() === $code)
                <x-admin.icon name="check" class="h-4 w-4" />
            @endif
        </a>
    @endforeach
</x-admin.dropdown>
