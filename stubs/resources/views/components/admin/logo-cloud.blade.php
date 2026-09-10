@props(['logos' => []])

<div {{ $attributes->class(['mx-auto grid grid-cols-2 items-center gap-8 sm:grid-cols-3 md:grid-cols-6']) }}>
    @foreach($logos as $logo)
        <div class="flex items-center justify-center">
            @if(is_array($logo))
                <img
                    src="{{ $logo['src'] }}"
                    alt="{{ $logo['alt'] ?? '' }}"
                    class="max-h-8 w-auto grayscale opacity-60 transition hover:opacity-100 hover:grayscale-0"
                >
            @else
                <span class="text-lg font-semibold text-neutral-400">{{ $logo }}</span>
            @endif
        </div>
    @endforeach
</div>
