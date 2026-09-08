@props(['default'])

<div x-data="{ tab: '{{ $default }}' }">
    <div class="border-b border-neutral-200">
        <nav class="-mb-px flex gap-x-6">
            {{ $tabs }}
        </nav>
    </div>

    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
