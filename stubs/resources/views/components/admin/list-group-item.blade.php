@props(['href' => null])

<li {{ $attributes->class(['bg-white']) }}>
    @if($href)
        <a href="{{ $href }}" class="flex items-center justify-between gap-x-4 px-4 py-3 text-sm hover:bg-neutral-50">
            {{ $slot }}
        </a>
    @else
        <div class="flex items-center justify-between gap-x-4 px-4 py-3 text-sm">
            {{ $slot }}
        </div>
    @endif
</li>
