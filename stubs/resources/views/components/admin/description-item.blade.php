@props(['label'])

<div class="grid grid-cols-1 gap-1 py-3 text-sm sm:grid-cols-3 sm:gap-4 sm:py-3">
    <dt class="font-medium text-neutral-500">{{ $label }}</dt>
    <dd class="col-span-2 text-neutral-900">{{ $slot }}</dd>
</div>
