@props(['name', 'role' => null, 'avatar' => null, 'bio' => null])

<div {{ $attributes->class(['text-center']) }}>
    <x-admin.avatar :name="$name" :src="$avatar" size="xl" class="mx-auto" />

    <h3 class="mt-4 text-base font-semibold text-neutral-900">{{ $name }}</h3>

    @if($role)
        <p class="text-sm text-primary-600">{{ $role }}</p>
    @endif

    @if($bio)
        <p class="mt-2 text-sm text-neutral-500">{{ $bio }}</p>
    @endif

    @isset($social)
        <div class="mt-3 flex items-center justify-center gap-x-3">
            {{ $social }}
        </div>
    @endisset
</div>
