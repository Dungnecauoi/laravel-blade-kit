@props([
    'label' => null,
    'name',
    'error' => null,
    'hint' => null,
    'required' => false,
    'min' => null,
    'max' => null,
])

@php
    $value = old($name, $attributes->get('value'));
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
    $locale = app()->getLocale() === 'vi' ? 'vi-VN' : 'en-US';
@endphp

<div
    x-data="{
        open: false,
        selected: @js($value ?: null),
        viewDate: @js($value ?: null) ? new Date(@js($value)) : new Date(),
        min: @js($min),
        max: @js($max),
        weekdayLabels: Array.from({ length: 7 }, (_, i) => new Date(2023, 0, i + 1).toLocaleDateString('{{ $locale }}', { weekday: 'short' })),
        toIso(date) {
            return date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
        },
        get monthLabel() {
            return this.viewDate.toLocaleDateString('{{ $locale }}', { month: 'long', year: 'numeric' });
        },
        get displayValue() {
            if (! this.selected) return '';
            const [y, m, d] = this.selected.split('-');
            return new Date(y, m - 1, d).toLocaleDateString('{{ $locale }}');
        },
        get cells() {
            const year = this.viewDate.getFullYear();
            const month = this.viewDate.getMonth();
            const firstWeekday = new Date(year, month, 1).getDay();
            const cells = [];
            for (let i = 0; i < 42; i++) {
                const date = new Date(year, month, 1 - firstWeekday + i);
                cells.push({ date, iso: this.toIso(date), inMonth: date.getMonth() === month });
            }
            return cells;
        },
        isDisabled(cell) {
            return (this.min && cell.iso < this.min) || (this.max && cell.iso > this.max);
        },
        prevMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() - 1, 1); },
        nextMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() + 1, 1); },
        choose(cell) {
            if (this.isDisabled(cell)) return;
            this.selected = cell.iso;
            this.open = false;
        },
        goToday() {
            const today = new Date();
            this.viewDate = today;
            this.selected = this.toIso(today);
            this.open = false;
        },
    }"
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
        {{ $attributes->except('value')->class(["relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-neutral-900 shadow-sm ring-1 ring-inset focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6 {$ringClass}"]) }}
    >
        <span x-text="displayValue || @js(__('Chọn ngày'))" :class="{ 'text-neutral-400': ! selected }"></span>
        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <x-admin.icon name="calendar" class="h-4 w-4 text-neutral-400" />
        </span>
    </button>

    <div
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="absolute z-40 mt-1 w-72 rounded-md bg-white p-3 shadow-lg ring-1 ring-black/5"
    >
        <div class="flex items-center justify-between pb-2">
            <button type="button" @click="prevMonth()" class="rounded p-1 text-neutral-500 hover:bg-neutral-100">
                <span class="sr-only">{{ __('Tháng trước') }}</span>
                <x-admin.icon name="chevron-right" class="h-4 w-4 rotate-180" />
            </button>
            <span class="text-sm font-medium capitalize text-neutral-900" x-text="monthLabel"></span>
            <button type="button" @click="nextMonth()" class="rounded p-1 text-neutral-500 hover:bg-neutral-100">
                <span class="sr-only">{{ __('Tháng sau') }}</span>
                <x-admin.icon name="chevron-right" class="h-4 w-4" />
            </button>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center text-xs text-neutral-400">
            <template x-for="dayLabel in weekdayLabels" :key="dayLabel">
                <span x-text="dayLabel"></span>
            </template>
        </div>

        <div class="mt-1 grid grid-cols-7 gap-1">
            <template x-for="cell in cells" :key="cell.iso">
                <button
                    type="button"
                    @click="choose(cell)"
                    :disabled="isDisabled(cell)"
                    :class="{
                        'text-neutral-300': ! cell.inMonth,
                        'text-neutral-900 hover:bg-primary-50': cell.inMonth && cell.iso !== selected && ! isDisabled(cell),
                        'bg-primary-600 text-white hover:bg-primary-600': cell.iso === selected,
                        'pointer-events-none opacity-30': isDisabled(cell),
                    }"
                    class="flex h-8 w-8 items-center justify-center rounded-full text-sm"
                    x-text="cell.date.getDate()"
                ></button>
            </template>
        </div>

        <div class="mt-2 flex justify-end border-t border-neutral-100 pt-2">
            <button type="button" @click="goToday()" class="text-xs font-medium text-primary-600 hover:text-primary-700">
                {{ __('Hôm nay') }}
            </button>
        </div>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
