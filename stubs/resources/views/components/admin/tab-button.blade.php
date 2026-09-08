@props(['value'])

<button
    type="button"
    @click="tab = '{{ $value }}'"
    :class="tab === '{{ $value }}' ? 'border-primary-600 text-primary-600' : 'border-transparent text-neutral-500 hover:border-neutral-300 hover:text-neutral-700'"
    class="whitespace-nowrap border-b-2 px-1 py-3 text-sm font-medium"
>
    {{ $slot }}
</button>
