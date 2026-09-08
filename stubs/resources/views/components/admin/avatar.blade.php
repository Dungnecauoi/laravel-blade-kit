@props(['name' => null, 'src' => null, 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'h-8 w-8 text-xs',
        'md' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
    ][$size] ?? 'h-10 w-10 text-sm';

    $initials = collect(explode(' ', trim((string) $name)))
        ->filter()
        ->map(fn ($word) => mb_substr($word, 0, 1))
        ->take(2)
        ->implode('');
@endphp

@if($src)
    <img src="{{ $src }}" alt="{{ $name }}" {{ $attributes->class(["rounded-full object-cover {$sizes}"]) }} />
@else
    <span {{ $attributes->class(["inline-flex shrink-0 items-center justify-center rounded-full bg-primary-100 font-medium uppercase text-primary-700 {$sizes}"]) }}>
        {{ $initials ?: '?' }}
    </span>
@endif
