@props(['label'])

<div class="grid grid-cols-3 gap-4 py-3 text-sm">
    <dt class="font-medium text-neutral-500">{{ $label }}</dt>
    <dd class="col-span-2 text-neutral-900">{{ $slot }}</dd>
</div>
