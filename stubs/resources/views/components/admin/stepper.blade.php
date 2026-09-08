@props(['steps' => [], 'current' => 1])

<nav {{ $attributes }} aria-label="Progress">
    <ol class="flex items-center">
        @foreach($steps as $index => $step)
            @php $stepNumber = $index + 1; @endphp
            <li class="relative flex-1 {{ ! $loop->last ? 'pr-8 sm:pr-20' : '' }}">
                @if(! $loop->last)
                    <div class="absolute inset-0 left-0 top-4 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full {{ $stepNumber < $current ? 'bg-primary-600' : 'bg-neutral-200' }}"></div>
                    </div>
                @endif

                <div class="relative flex flex-col items-center gap-y-2">
                    <span @class([
                        'flex h-8 w-8 items-center justify-center rounded-full text-sm font-semibold',
                        'bg-primary-600 text-white' => $stepNumber < $current,
                        'border-2 border-primary-600 bg-white text-primary-600' => $stepNumber === $current,
                        'border-2 border-neutral-300 bg-white text-neutral-400' => $stepNumber > $current,
                    ])>
                        @if($stepNumber < $current)
                            <x-admin.icon name="check" class="h-4 w-4" />
                        @else
                            {{ $stepNumber }}
                        @endif
                    </span>
                    <span class="text-xs font-medium {{ $stepNumber <= $current ? 'text-neutral-900' : 'text-neutral-400' }}">
                        {{ $step }}
                    </span>
                </div>
            </li>
        @endforeach
    </ol>
</nav>
