@props([
    'name',
    'label' => null,
    'swatches' => ['#ef4444', '#f97316', '#f59e0b', '#84cc16', '#22c55e', '#14b8a6', '#06b6d4', '#3b82f6', '#6366f1', '#a855f7', '#ec4899', '#64748b'],
    'value' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
])

@php
    $selected = old($name, $attributes->get('value', $value));
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div
    x-data="{ open: false, selected: @js($selected), swatches: @js($swatches) }"
    @click.outside="open = false"
    @keydown.escape="open = false"
    class="relative"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="selected">

    <button
        type="button"
        id="{{ $name }}"
        @click="open = ! open"
        {{ $attributes->except('value')->class(["flex w-full items-center gap-x-2 rounded-md bg-white py-2.5 pl-2.5 pr-3 text-left shadow-sm ring-1 ring-inset focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm {$ringClass}"]) }}
    >
        <span class="h-5 w-5 shrink-0 rounded-full ring-1 ring-inset ring-black/10" :style="`background-color: ${selected || '#e5e7eb'}`"></span>
        <span class="flex-1 truncate text-neutral-900" x-text="selected || @js(__('Chọn màu'))" :class="{ 'text-neutral-400': ! selected }"></span>
        <x-admin.icon name="chevron-up-down" class="h-4 w-4 shrink-0 text-neutral-400" />
    </button>

    <div
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="absolute z-40 mt-1 w-64 rounded-md bg-white p-3 shadow-lg ring-1 ring-black/5"
    >
        <div class="grid grid-cols-6 gap-2">
            <template x-for="swatch in swatches" :key="swatch">
                <button
                    type="button"
                    @click="selected = swatch; open = false"
                    class="h-7 w-7 rounded-full ring-1 ring-inset ring-black/10 transition-transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    :class="{ 'ring-2 ring-offset-2 ring-primary-600': selected === swatch }"
                    :style="`background-color: ${swatch}`"
                    :aria-label="swatch"
                ></button>
            </template>
        </div>

        <div class="mt-3 flex items-center gap-x-2 border-t border-neutral-100 pt-3">
            <span class="h-6 w-6 shrink-0 rounded ring-1 ring-inset ring-black/10" :style="`background-color: ${selected || '#e5e7eb'}`"></span>
            <input
                type="text"
                x-model="selected"
                placeholder="#RRGGBB"
                class="w-full rounded-md border-0 bg-neutral-50 px-2 py-1 text-sm text-neutral-900 focus:outline-none focus:ring-1 focus:ring-primary-600 focus:ring-inset"
            >
        </div>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
