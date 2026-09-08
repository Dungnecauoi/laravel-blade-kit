@props(['value'])

<div x-show="tab === '{{ $value }}'" x-cloak {{ $attributes }}>
    {{ $slot }}
</div>
