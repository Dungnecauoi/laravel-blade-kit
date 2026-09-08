@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->class(['block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100']) }}>
    {{ $slot }}
</a>
