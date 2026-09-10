@props(['quote', 'name', 'role' => null, 'avatar' => null])

<figure {{ $attributes->class(['rounded-2xl bg-neutral-50 p-8']) }}>
    <blockquote class="text-base text-neutral-700">
        <p>&ldquo;{{ $quote }}&rdquo;</p>
    </blockquote>

    <figcaption class="mt-6 flex items-center gap-x-3">
        <x-admin.avatar :name="$name" :src="$avatar" size="sm" />
        <div>
            <div class="font-semibold text-neutral-900">{{ $name }}</div>
            @if($role)
                <div class="text-sm text-neutral-500">{{ $role }}</div>
            @endif
        </div>
    </figcaption>
</figure>
