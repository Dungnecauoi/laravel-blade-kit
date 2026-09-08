@props(['field', 'label'])

@php
    $currentField = request('sort');
    $currentDirection = request('direction', 'asc');
    $isActive = $currentField === $field;
    $nextDirection = $isActive && $currentDirection === 'asc' ? 'desc' : 'asc';
    $url = request()->fullUrlWithQuery(['sort' => $field, 'direction' => $nextDirection]);
@endphp

<a href="{{ $url }}" {{ $attributes->class(['group inline-flex items-center gap-x-1 text-xs font-semibold uppercase tracking-wide text-neutral-500 hover:text-neutral-700']) }}>
    {{ $label }}
    <span class="flex h-3.5 w-3.5 items-center justify-center">
        @if($isActive)
            <x-admin.icon :name="$currentDirection === 'asc' ? 'chevron-up' : 'chevron-down'" class="h-3.5 w-3.5 text-neutral-700" />
        @else
            <x-admin.icon name="chevron-up-down" class="h-3.5 w-3.5 text-neutral-400 opacity-0 group-hover:opacity-100" />
        @endif
    </span>
</a>
