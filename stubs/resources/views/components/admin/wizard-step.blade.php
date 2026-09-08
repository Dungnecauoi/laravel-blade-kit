@props(['index'])

<div x-show="step === {{ $index }}" x-cloak {{ $attributes }}>
    {{ $slot }}
</div>
