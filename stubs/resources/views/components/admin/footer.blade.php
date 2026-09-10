@props(['columns' => [], 'description' => null])

<footer {{ $attributes->class(['border-t border-neutral-200 bg-white']) }}>
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-5">
            <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                <div class="flex items-center gap-x-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-sm font-bold text-white">
                        {{ mb_substr(config('admin.name'), 0, 1) }}
                    </span>
                    <span class="text-base font-semibold text-neutral-900">{{ config('admin.name') }}</span>
                </div>

                @if($description)
                    <p class="mt-4 text-sm text-neutral-500">{{ $description }}</p>
                @endif
            </div>

            @foreach($columns as $heading => $links)
                <div>
                    <h3 class="text-sm font-semibold text-neutral-900">{{ $heading }}</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach($links as $label => $href)
                            <li>
                                <a href="{{ $href }}" class="text-sm text-neutral-500 hover:text-neutral-700">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-neutral-100 pt-8 sm:flex-row">
            <p class="text-sm text-neutral-400">&copy; {{ date('Y') }} {{ config('admin.name') }}. {{ __('Đã đăng ký bản quyền.') }}</p>

            @isset($social)
                <div class="flex items-center gap-x-4">
                    {{ $social }}
                </div>
            @endisset
        </div>
    </div>
</footer>
