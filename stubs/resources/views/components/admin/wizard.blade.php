@props(['steps' => []])

@php $total = count($steps); @endphp

<div x-data="{ step: 1 }" {{ $attributes }}>
    <nav aria-label="{{ __('Tiến trình') }}">
        <ol class="flex items-center">
            @foreach($steps as $index => $label)
                @php $n = $index + 1; @endphp
                <li class="relative flex-1 {{ ! $loop->last ? 'pr-8 sm:pr-16' : '' }}">
                    @if(! $loop->last)
                        <div class="absolute inset-0 left-0 top-4 flex items-center" aria-hidden="true">
                            <div class="h-0.5 w-full transition-colors" :class="step > {{ $n }} ? 'bg-primary-600' : 'bg-neutral-200'"></div>
                        </div>
                    @endif

                    <div class="relative flex flex-col items-center gap-y-2">
                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-semibold transition-colors"
                            :class="{
                                'bg-primary-600 text-white': step > {{ $n }},
                                'border-2 border-primary-600 bg-white text-primary-600': step === {{ $n }},
                                'border-2 border-neutral-300 bg-white text-neutral-400': step < {{ $n }},
                            }"
                        >
                            <template x-if="step > {{ $n }}"><x-admin.icon name="check" class="h-4 w-4" /></template>
                            <template x-if="step <= {{ $n }}"><span>{{ $n }}</span></template>
                        </span>
                        <span class="text-xs font-medium transition-colors" :class="step >= {{ $n }} ? 'text-neutral-900' : 'text-neutral-400'">
                            {{ $label }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>

    <div class="mt-6">
        {{ $slot }}
    </div>

    <div class="mt-6 flex items-center justify-between border-t border-neutral-200 pt-4">
        <x-admin.button type="button" variant="secondary" x-show="step > 1" @click="step--" x-cloak>
            {{ __('Quay lại') }}
        </x-admin.button>
        <span x-show="step === 1"></span>

        <div class="flex items-center gap-x-2">
            @if($total > 1)
                <x-admin.button type="button" variant="primary" x-show="step < {{ $total }}" @click="step++" x-cloak>
                    {{ __('Tiếp theo') }}
                </x-admin.button>
            @endif

            <x-admin.button type="submit" variant="primary" x-show="step === {{ $total }}" x-cloak>
                {{ __('Hoàn tất') }}
            </x-admin.button>
        </div>
    </div>
</div>
