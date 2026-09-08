@props(['data' => [], 'weeks' => 12])

@php
    $levelClasses = [
        0 => 'bg-neutral-100',
        1 => 'bg-primary-200',
        2 => 'bg-primary-400',
        3 => 'bg-primary-600',
        4 => 'bg-primary-800',
    ];

    $max = ! empty($data) ? max($data) : 0;

    $today = new DateTime('today');
    $start = (clone $today)->modify('-'.($weeks * 7 - 1).' days');
    $start->modify('-'.((int) $start->format('w')).' days');

    $days = [];
    $cursor = clone $start;
    while ($cursor <= $today) {
        $iso = $cursor->format('Y-m-d');
        $count = $data[$iso] ?? 0;
        $level = $max > 0 ? (int) ceil(($count / $max) * 4) : 0;
        $days[] = ['date' => $iso, 'count' => $count, 'level' => $count > 0 ? max($level, 1) : 0];
        $cursor->modify('+1 day');
    }

    $columns = array_chunk($days, 7);
@endphp

<div {{ $attributes }}>
    <div class="flex gap-1 overflow-x-auto pb-1">
        @foreach($columns as $column)
            <div class="flex flex-col gap-1">
                @foreach($column as $day)
                    <span
                        class="h-3 w-3 rounded-sm {{ $levelClasses[$day['level']] }}"
                        title="{{ $day['date'] }}: {{ $day['count'] }}"
                    ></span>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="mt-2 flex items-center justify-end gap-x-1.5 text-xs text-neutral-400">
        {{ __('Ít') }}
        @foreach($levelClasses as $class)
            <span class="h-3 w-3 rounded-sm {{ $class }}"></span>
        @endforeach
        {{ __('Nhiều') }}
    </div>
</div>
