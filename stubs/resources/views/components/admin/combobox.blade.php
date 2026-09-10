@props([
    'label' => null,
    'name',
    'options' => [],
    'placeholder' => null,
    'error' => null,
    'hint' => null,
    'required' => false,
    'multiple' => false,
])

@php
    $optionList = collect($options)
        ->map(fn ($optionLabel, $value) => ['value' => (string) $value, 'label' => $optionLabel])
        ->values();

    if ($multiple) {
        $selected = collect(old($name, $attributes->get('value', [])))->map(fn ($v) => (string) $v)->values();
    } else {
        $selected = (string) old($name, $attributes->get('value'));
    }

    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div
    x-data="{
        open: false,
        query: '',
        multiple: @js($multiple),
        selected: @js($selected),
        options: @js($optionList),
        get filtered() {
            return this.query === ''
                ? this.options
                : this.options.filter((option) => option.label.toLowerCase().includes(this.query.toLowerCase()));
        },
        get selectedLabel() {
            return this.options.find((option) => option.value === this.selected)?.label ?? '';
        },
        get selectedOptions() {
            return this.options.filter((option) => this.selected.includes(option.value));
        },
        isChosen(option) {
            return this.multiple ? this.selected.includes(option.value) : this.selected === option.value;
        },
        choose(option) {
            if (this.multiple) {
                this.selected = this.selected.includes(option.value)
                    ? this.selected.filter((v) => v !== option.value)
                    : [...this.selected, option.value];
                this.query = '';
            } else {
                this.selected = option.value;
                this.query = '';
                this.open = false;
            }
        },
        remove(value) {
            this.selected = this.selected.filter((v) => v !== value);
        },
    }"
    @click.outside="open = false"
    @keydown.escape="open = false"
    class="relative"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    @if($multiple)
        <template x-for="value in selected" :key="value">
            <input type="hidden" :name="'{{ $name }}[]'" :value="value">
        </template>
    @else
        <input type="hidden" name="{{ $name }}" :value="selected">
    @endif

    <button
        type="button"
        id="{{ $name }}"
        x-ref="trigger"
        @click="open = ! open"
        {{ $attributes->except('value')->class(["relative w-full cursor-default rounded-md bg-white py-2.5 pl-3 pr-10 text-left text-neutral-900 shadow-sm ring-1 ring-inset focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6 {$ringClass}"]) }}
    >
        <template x-if="! multiple">
            <span class="block truncate" :class="{ 'text-neutral-400': ! selectedLabel }" x-text="selectedLabel || @js($placeholder ?? '')"></span>
        </template>

        <template x-if="multiple">
            <div class="flex flex-wrap gap-1">
                <template x-if="selectedOptions.length === 0">
                    <span class="text-neutral-400" x-text="@js($placeholder ?? '')"></span>
                </template>
                <template x-for="option in selectedOptions" :key="option.value">
                    <span class="inline-flex items-center gap-x-1 rounded bg-primary-50 py-0.5 pl-2 pr-1 text-xs font-medium text-primary-700">
                        <span x-text="option.label"></span>
                        <span @click.stop="remove(option.value)" class="cursor-pointer rounded hover:bg-primary-100">
                            <x-admin.icon name="x-mark" class="h-3 w-3" />
                        </span>
                    </span>
                </template>
            </div>
        </template>

        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
            <x-admin.icon name="chevron-up-down" class="h-4 w-4 text-neutral-400" />
        </span>
    </button>

    <div
        x-anchor.bottom-start.offset.4="$refs.trigger"
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="z-40 max-h-60 w-full overflow-auto rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
    >
        <div class="px-2 py-1.5">
            <input
                type="text"
                x-model="query"
                @click.stop
                placeholder="{{ __('Tìm kiếm...') }}"
                class="block w-full rounded-md border-0 bg-neutral-50 px-2 py-1 text-sm text-neutral-900 focus:outline-none focus:ring-1 focus:ring-primary-600 focus:ring-inset"
            />
        </div>

        <template x-for="option in filtered" :key="option.value">
            <button
                type="button"
                @click="choose(option)"
                class="flex w-full items-center justify-between px-3 py-2 text-left text-sm text-neutral-900 hover:bg-primary-50"
            >
                <span x-text="option.label"></span>
                <x-admin.icon name="check" class="h-4 w-4 text-primary-600" x-show="isChosen(option)" />
            </button>
        </template>

        <p class="px-3 py-2 text-sm text-neutral-400" x-show="filtered.length === 0">{{ __('Không tìm thấy kết quả.') }}</p>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
