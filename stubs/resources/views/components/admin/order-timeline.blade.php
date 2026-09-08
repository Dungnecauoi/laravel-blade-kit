@props(['steps' => [], 'current' => 1, 'cancelled' => false])

<ol {{ $attributes }}>
    @foreach($steps as $index => $step)
        @php
            $n = $index + 1;
            $done = ! $cancelled && $n < $current;
            $active = ! $cancelled && $n === $current;
            $isCancelledMarker = $cancelled && $n === $current;
            $upcoming = ! $done && ! $active && ! $isCancelledMarker;
        @endphp
        <li class="relative flex gap-x-4 pb-8 last:pb-0">
            @if(! $loop->last)
                <div class="absolute left-[15px] top-8 h-[calc(100%-2rem)] w-0.5 {{ $done ? 'bg-primary-600' : 'bg-neutral-200' }}"></div>
            @endif

            <span @class([
                'relative flex h-8 w-8 shrink-0 items-center justify-center rounded-full',
                'bg-primary-600 text-white' => $done,
                'border-2 border-primary-600 bg-white text-primary-600' => $active,
                'bg-danger-600 text-white' => $isCancelledMarker,
                'border-2 border-neutral-200 bg-white text-neutral-300' => $upcoming,
            ])>
                @if($done)
                    <x-admin.icon name="check" class="h-4 w-4" />
                @elseif($isCancelledMarker)
                    <x-admin.icon name="x-mark" class="h-4 w-4" />
                @else
                    <span class="h-2 w-2 rounded-full {{ $active ? 'bg-primary-600' : 'bg-neutral-300' }}"></span>
                @endif
            </span>

            <div class="pt-1">
                <p class="text-sm font-medium {{ $upcoming ? 'text-neutral-400' : 'text-neutral-900' }}">{{ $step['label'] }}</p>
                @if(! empty($step['at']))
                    <p class="text-xs text-neutral-400">{{ $step['at'] }}</p>
                @endif
            </div>
        </li>
    @endforeach
</ol>
