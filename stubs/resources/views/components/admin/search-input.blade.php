@props(['name' => 'q', 'placeholder' => null])

<div class="relative" x-data="{ value: @js((string) $attributes->get('value', request($name, ''))) }">
    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <x-admin.icon name="search" class="h-4 w-4 text-neutral-400" />
    </span>

    <input
        type="search"
        name="{{ $name }}"
        x-model="value"
        placeholder="{{ $placeholder ?? __('Tìm kiếm...') }}"
        {{ $attributes->except('value')->class(['block w-full rounded-md border-0 py-1.5 pl-9 pr-9 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6']) }}
    />

    <button type="button" x-show="value" x-cloak @click="value = ''" class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-neutral-600" tabindex="-1">
        <span class="sr-only">{{ __('Xoá tìm kiếm') }}</span>
        <x-admin.icon name="x-mark" class="h-4 w-4" />
    </button>
</div>
