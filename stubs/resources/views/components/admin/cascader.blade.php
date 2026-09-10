@props([
    'name',
    'label' => null,
    'options' => [],
    'placeholder' => null,
    'error' => null,
    'hint' => null,
    'required' => false,
])

@php
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div
    x-data="{
        open: false,
        options: @js($options),
        path: [],
        get columns() {
            const cols = [this.options];
            let current = this.options;
            for (const step of this.path) {
                const match = current.find((o) => o.value === step.value);
                if (match && match.children && match.children.length) {
                    cols.push(match.children);
                    current = match.children;
                } else {
                    break;
                }
            }
            return cols;
        },
        get displayLabel() { return this.path.map((p) => p.label).join(' / '); },
        get value() { return this.path.length ? this.path[this.path.length - 1].value : ''; },
        select(levelIndex, option) {
            this.path = this.path.slice(0, levelIndex);
            this.path.push({ value: option.value, label: option.label });
            if (! option.children || ! option.children.length) this.open = false;
        },
    }"
    @click.outside="open = false"
    @keydown.escape="open = false"
    class="relative"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="value">

    <button
        type="button"
        id="{{ $name }}"
        x-ref="trigger"
        @click="open = ! open"
        {{ $attributes->class(["flex w-full items-center gap-x-2 rounded-md bg-white py-2.5 pl-3 pr-3 text-left shadow-sm ring-1 ring-inset focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm {$ringClass}"]) }}
    >
        <span class="flex-1 truncate" :class="{ 'text-neutral-400': ! path.length }" x-text="displayLabel || @js($placeholder ?? __('Chọn...'))"></span>
        <x-admin.icon name="chevron-up-down" class="h-4 w-4 shrink-0 text-neutral-400" />
    </button>

    <div
        x-anchor.bottom-start.offset.8="$refs.trigger"
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="z-40 flex rounded-md bg-white shadow-lg ring-1 ring-black/5"
    >
        <template x-for="(column, levelIndex) in columns" :key="levelIndex">
            <ul class="max-h-60 w-44 overflow-auto border-r border-neutral-100 py-1 last:border-r-0">
                <template x-for="option in column" :key="option.value">
                    <li>
                        <button
                            type="button"
                            @click="select(levelIndex, option)"
                            :class="path[levelIndex]?.value === option.value ? 'bg-primary-50 text-primary-700' : 'text-neutral-700 hover:bg-neutral-50'"
                            class="flex w-full items-center justify-between px-3 py-2 text-left text-sm"
                        >
                            <span x-text="option.label"></span>
                            <x-admin.icon name="chevron-right" class="h-3.5 w-3.5 text-neutral-300" x-show="option.children && option.children.length" />
                        </button>
                    </li>
                </template>
            </ul>
        </template>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
