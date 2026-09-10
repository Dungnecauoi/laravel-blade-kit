@props(['stats' => []])

<div {{ $attributes->class(['grid grid-cols-2 gap-8 sm:grid-cols-4']) }}>
    @foreach($stats as $stat)
        <div class="text-center">
            <p class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl">{{ $stat['value'] }}</p>
            <p class="mt-1 text-sm text-neutral-500">{{ $stat['label'] }}</p>
        </div>
    @endforeach
</div>
