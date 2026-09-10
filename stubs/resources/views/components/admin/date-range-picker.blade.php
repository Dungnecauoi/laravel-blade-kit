@props([
    'name' => 'range',
    'label' => null,
    'startValue' => null,
    'endValue' => null,
    'hint' => null,
    'error' => null,
])

@php
    $locale = app()->getLocale() === 'vi' ? 'vi-VN' : 'en-US';
    $start = old("{$name}.start", $startValue);
    $end = old("{$name}.end", $endValue);
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div
    x-data="{
        open: false,
        editing: 'start',
        start: @js($start ?: null),
        end: @js($end ?: null),
        viewDate: new Date(),
        weekdayLabels: Array.from({ length: 7 }, (_, i) => new Date(2023, 0, i + 1).toLocaleDateString('{{ $locale }}', { weekday: 'short' })),
        get monthLabel() {
            return this.viewDate.toLocaleDateString('{{ $locale }}', { month: 'long', year: 'numeric' });
        },
        toIso(date) {
            return date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
        },
        display(iso) {
            if (! iso) return '';
            const [y, m, d] = iso.split('-');
            return new Date(y, m - 1, d).toLocaleDateString('{{ $locale }}');
        },
        get cells() {
            const year = this.viewDate.getFullYear();
            const month = this.viewDate.getMonth();
            const firstWeekday = new Date(year, month, 1).getDay();
            const cells = [];
            for (let i = 0; i < 42; i++) {
                const date = new Date(year, month, 1 - firstWeekday + i);
                const iso = this.toIso(date);
                cells.push({
                    date,
                    iso,
                    inMonth: date.getMonth() === month,
                    inRange: this.start && this.end && iso > this.start && iso < this.end,
                    isEdge: iso === this.start || iso === this.end,
                });
            }
            return cells;
        },
        openFor(field) { this.editing = field; this.open = true; },
        prevMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() - 1, 1); },
        nextMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() + 1, 1); },
        choose(cell) {
            if (this.editing === 'start') {
                this.start = cell.iso;
                if (this.end && this.end < this.start) this.end = null;
                this.editing = 'end';
            } else {
                if (this.start && cell.iso < this.start) return;
                this.end = cell.iso;
                this.open = false;
            }
        },
    }"
    @click.outside="open = false"
    @keydown.escape="open = false"
>
    @if($label)
        <x-admin.label>{{ $label }}</x-admin.label>
    @endif

    <input type="hidden" name="{{ $name }}[start]" :value="start">
    <input type="hidden" name="{{ $name }}[end]" :value="end">

    <div class="flex items-center gap-x-3">
        <button
            type="button"
            x-ref="startTrigger"
            @click="openFor('start')"
            :class="editing === 'start' && open ? 'ring-2 ring-primary-600' : '{{ $ringClass }}'"
            class="flex w-full flex-1 items-center gap-x-2 rounded-md bg-white py-2.5 pl-3 pr-3 text-left shadow-sm ring-1 ring-inset focus:outline-none sm:text-sm"
        >
            <x-admin.icon name="calendar" class="h-4 w-4 shrink-0 text-neutral-400" />
            <span x-text="display(start) || @js(__('Từ ngày'))" :class="{ 'text-neutral-400': ! start }"></span>
        </button>

        <span class="shrink-0 text-sm text-neutral-400">{{ __('đến') }}</span>

        <button
            type="button"
            x-ref="endTrigger"
            @click="openFor('end')"
            :class="editing === 'end' && open ? 'ring-2 ring-primary-600' : '{{ $ringClass }}'"
            class="flex w-full flex-1 items-center gap-x-2 rounded-md bg-white py-2.5 pl-3 pr-3 text-left shadow-sm ring-1 ring-inset focus:outline-none sm:text-sm"
        >
            <x-admin.icon name="calendar" class="h-4 w-4 shrink-0 text-neutral-400" />
            <span x-text="display(end) || @js(__('Đến ngày'))" :class="{ 'text-neutral-400': ! end }"></span>
        </button>
    </div>

    <div
        x-anchor.bottom-start.offset.8="editing === 'start' ? $refs.startTrigger : $refs.endTrigger"
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="z-40 w-72 rounded-md bg-white p-3 shadow-lg ring-1 ring-black/5"
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
                    :class="{
                        'text-neutral-300': ! cell.inMonth,
                        'text-neutral-900 hover:bg-primary-50': cell.inMonth && ! cell.isEdge,
                        'bg-primary-100': cell.inRange,
                        'bg-primary-600 text-white hover:bg-primary-600': cell.isEdge,
                    }"
                    class="flex h-8 w-8 items-center justify-center rounded-full text-sm"
                    x-text="cell.date.getDate()"
                ></button>
            </template>
        </div>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
