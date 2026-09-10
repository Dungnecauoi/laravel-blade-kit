@props(['columns' => '3'])

@php
    $colClass = [
        '2' => 'sm:grid-cols-2',
        '3' => 'sm:grid-cols-2 lg:grid-cols-3',
        '4' => 'sm:grid-cols-2 lg:grid-cols-4',
    ][(string) $columns] ?? 'sm:grid-cols-2 lg:grid-cols-3';
@endphp

<div {{ $attributes->class(["grid grid-cols-1 gap-x-8 gap-y-10 {$colClass}"]) }}>
    {{ $slot }}
</div>
