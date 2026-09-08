@props([
    'image' => null,
    'name',
    'price' => 0,
    'compareAt' => null,
    'quantity' => null,
    'threshold' => 5,
    'href' => '#',
])

<div {{ $attributes->class(['group overflow-hidden rounded-xl bg-white ring-1 ring-neutral-200 transition-shadow hover:shadow-md']) }}>
    <a href="{{ $href }}" class="block aspect-square overflow-hidden bg-neutral-100">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
        @else
            <div class="flex h-full w-full items-center justify-center text-neutral-300">
                <x-admin.icon name="image" class="h-10 w-10" />
            </div>
        @endif
    </a>

    <div class="space-y-2 p-4">
        <a href="{{ $href }}" class="line-clamp-2 text-sm font-medium text-neutral-900 hover:text-primary-600">{{ $name }}</a>

        <x-admin.price-tag :price="$price" :compare-at="$compareAt" />

        <div class="flex items-center justify-between">
            @if(! is_null($quantity))
                <x-admin.stock-badge :quantity="$quantity" :threshold="$threshold" />
            @else
                <span></span>
            @endif

            @isset($actions)
                <div class="flex items-center gap-x-1">{{ $actions }}</div>
            @endisset
        </div>
    </div>
</div>
