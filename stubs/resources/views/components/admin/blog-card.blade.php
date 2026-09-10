@props([
    'image' => null,
    'category' => null,
    'title',
    'excerpt' => null,
    'author' => null,
    'date' => null,
    'href' => '#',
])

<article {{ $attributes->class(['flex flex-col overflow-hidden rounded-xl ring-1 ring-neutral-200']) }}>
    @if($image)
        <a href="{{ $href }}" class="block aspect-[16/9] overflow-hidden bg-neutral-100">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
    @endif

    <div class="flex flex-1 flex-col p-5">
        @if($category)
            <x-admin.badge color="primary" class="w-fit">{{ $category }}</x-admin.badge>
        @endif

        <a href="{{ $href }}" class="mt-3 text-base font-semibold text-neutral-900 hover:text-primary-600">{{ $title }}</a>

        @if($excerpt)
            <p class="mt-2 flex-1 text-sm text-neutral-500">{{ $excerpt }}</p>
        @endif

        @if($author || $date)
            <div class="mt-4 flex items-center gap-x-2 text-sm text-neutral-400">
                @if($author)
                    <x-admin.avatar :name="$author" size="xs" />
                    <span>{{ $author }}</span>
                @endif
                @if($author && $date)
                    <span>&middot;</span>
                @endif
                @if($date)
                    <span>{{ $date }}</span>
                @endif
            </div>
        @endif
    </div>
</article>
