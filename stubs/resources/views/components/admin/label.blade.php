@props(['for' => null, 'required' => false])

<label @if($for) for="{{ $for }}" @endif {{ $attributes->class(['block text-sm font-medium leading-6 text-neutral-900 mb-1']) }}>
    {{ $slot }}
    @if($required)
        <span class="text-danger-500">*</span>
    @endif
</label>
