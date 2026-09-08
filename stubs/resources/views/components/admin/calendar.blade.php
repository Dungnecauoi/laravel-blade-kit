@props(['events' => [], 'name' => null, 'value' => null, 'selectable' => true])

@php
    $locale = app()->getLocale() === 'vi' ? 'vi-VN' : 'en-US';
    $selected = $name ? old($name, $attributes->get('value', $value)) : $value;

    $eventColorClasses = [
        'primary' => 'bg-primary-100 text-primary-700',
        'success' => 'bg-success-100 text-success-700',
        'danger' => 'bg-danger-100 text-danger-700',
        'warning' => 'bg-warning-100 text-warning-700',
        'info' => 'bg-info-100 text-info-700',
        'neutral' => 'bg-neutral-100 text-neutral-700',
    ];

    $eventsByDate = collect($events)->map(fn ($items, $date) => ['date' => $date, 'items' => $items])->values();
@endphp

<div
    x-data="{
        viewDate: new Date(),
        selected: @js($selected),
        selectable: @js($selectable),
        events: @js($eventsByDate),
        colorClasses: @js($eventColorClasses),
        weekdayLabels: Array.from({ length: 7 }, (_, i) => new Date(2023, 0, i + 1).toLocaleDateString('{{ $locale }}', { weekday: 'short' })),
        select(cell) {
            if (! this.selectable) return;
            this.selected = cell.iso;
            $dispatch('calendar-select', { date: cell.iso });
        },
        get monthLabel() {
            return this.viewDate.toLocaleDateString('{{ $locale }}', { month: 'long', year: 'numeric' });
        },
        toIso(date) {
            return date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
        },
        get cells() {
            const year = this.viewDate.getFullYear();
            const month = this.viewDate.getMonth();
            const firstWeekday = new Date(year, month, 1).getDay();
            const todayIso = this.toIso(new Date());
            const cells = [];
            for (let i = 0; i < 42; i++) {
                const date = new Date(year, month, 1 - firstWeekday + i);
                const iso = this.toIso(date);
                cells.push({
                    date,
                    iso,
                    inMonth: date.getMonth() === month,
                    isToday: iso === todayIso,
                    items: this.events.find((e) => e.date === iso)?.items ?? [],
                });
            }
            return cells;
        },
        prevMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() - 1, 1); },
        nextMonth() { this.viewDate = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() + 1, 1); },
        goToday() { this.viewDate = new Date(); },
    }"
    {{ $attributes->class(['rounded-xl bg-white ring-1 ring-neutral-200']) }}
>
    @if($name)
        <input type="hidden" name="{{ $name }}" :value="selected">
    @endif

    <div class="flex items-center justify-between border-b border-neutral-200 px-4 py-3">
        <button type="button" @click="prevMonth()" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-100">
            <span class="sr-only">{{ __('Tháng trước') }}</span>
            <x-admin.icon name="chevron-right" class="h-4 w-4 rotate-180" />
        </button>

        <div class="flex items-center gap-x-3">
            <span class="text-sm font-semibold capitalize text-neutral-900" x-text="monthLabel"></span>
            <button type="button" @click="goToday()" class="text-xs font-medium text-primary-600 hover:text-primary-700">
                {{ __('Hôm nay') }}
            </button>
        </div>

        <button type="button" @click="nextMonth()" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-100">
            <span class="sr-only">{{ __('Tháng sau') }}</span>
            <x-admin.icon name="chevron-right" class="h-4 w-4" />
        </button>
    </div>

    <div class="grid grid-cols-7 border-b border-neutral-100">
        <template x-for="dayLabel in weekdayLabels" :key="dayLabel">
            <div class="py-2 text-center text-xs font-medium capitalize text-neutral-400" x-text="dayLabel"></div>
        </template>
    </div>

    <div class="grid grid-cols-7">
        <template x-for="cell in cells" :key="cell.iso">
            <div
                @click="select(cell)"
                class="min-h-[6rem] border-b border-r border-neutral-100 p-1.5 transition-colors [&:nth-child(7n)]:border-r-0"
                :class="[
                    ! cell.inMonth ? 'bg-neutral-50/60' : '',
                    selectable ? 'cursor-pointer hover:bg-neutral-50' : '',
                    selected === cell.iso ? 'ring-1 ring-inset ring-primary-300 bg-primary-50/40' : '',
                ]"
            >
                <span
                    class="flex h-6 w-6 items-center justify-center rounded-full text-xs"
                    :class="cell.isToday ? 'bg-primary-600 font-semibold text-white' : (selected === cell.iso ? 'bg-primary-100 font-semibold text-primary-700' : (cell.inMonth ? 'text-neutral-700' : 'text-neutral-300'))"
                    x-text="cell.date.getDate()"
                ></span>
                <div class="mt-1 space-y-0.5">
                    <template x-for="item in cell.items.slice(0, 3)" :key="item.label">
                        <p class="truncate rounded px-1 py-0.5 text-[11px] font-medium" :class="colorClasses[item.color] ?? colorClasses.neutral" x-text="item.label"></p>
                    </template>
                    <p class="px-1 text-[11px] text-neutral-400" x-show="cell.items.length > 3" x-text="'+' + (cell.items.length - 3)"></p>
                </div>
            </div>
        </template>
    </div>
</div>
