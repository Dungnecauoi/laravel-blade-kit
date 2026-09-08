@props(['href' => null, 'current' => false])

<li class="flex items-center gap-x-1.5 text-sm [&:first-child_svg]:hidden">
    <x-admin.icon name="chevron-right" class="h-4 w-4 text-neutral-400" />

    @if($current || !$href)
        <span class="font-medium text-neutral-500" aria-current="page">{{ $slot }}</span>
    @else
        <a href="{{ $href }}" class="font-medium text-neutral-500 hover:text-neutral-700">{{ $slot }}</a>
    @endif
</li>
