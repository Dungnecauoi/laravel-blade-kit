@props(['paginator', 'onEachSide' => 2, 'ajax' => false])

@php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();

    $window = collect(range(max(1, $current - $onEachSide), min($last, $current + $onEachSide)));

    $pages = collect();
    if ($window->first() > 1) {
        $pages->push(1);
        if ($window->first() > 2) {
            $pages->push('...');
        }
    }
    $pages = $pages->merge($window);
    if ($window->last() < $last) {
        if ($window->last() < $last - 1) {
            $pages->push('...');
        }
        $pages->push($last);
    }
@endphp

@if($paginator->hasPages())
    <div {{ $attributes->class(['flex items-center justify-between border-t border-neutral-200 px-4 py-3 sm:px-6']) }}>
        <div class="flex flex-1 justify-between sm:hidden">
            <x-admin.button
                :href="$paginator->previousPageUrl()"
                variant="secondary"
                size="sm"
                :disabled="$paginator->onFirstPage()"
                @click="if ({{ $ajax ? 'true' : 'false' }}) { $event.preventDefault(); $dispatch('paginate', { page: {{ $current - 1 }} }) }"
            >{{ __('Trước') }}</x-admin.button>
            <x-admin.button
                :href="$paginator->nextPageUrl()"
                variant="secondary"
                size="sm"
                :disabled="!$paginator->hasMorePages()"
                @click="if ({{ $ajax ? 'true' : 'false' }}) { $event.preventDefault(); $dispatch('paginate', { page: {{ $current + 1 }} }) }"
            >{{ __('Sau') }}</x-admin.button>
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <p class="text-sm text-neutral-600">
                {{ __('Hiển thị :first đến :last trong :total kết quả', [
                    'first' => $paginator->firstItem(),
                    'last' => $paginator->lastItem(),
                    'total' => $paginator->total(),
                ]) }}
            </p>

            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="{{ __('Điều hướng trang') }}">
                <a
                    href="{{ $paginator->previousPageUrl() ?? '#' }}"
                    @if($ajax && ! $paginator->onFirstPage()) @click.prevent="$dispatch('paginate', { page: {{ $current - 1 }} })" @endif
                    @class([
                        'relative inline-flex items-center rounded-l-md px-2 py-2 ring-1 ring-inset ring-neutral-300',
                        'pointer-events-none text-neutral-300' => $paginator->onFirstPage(),
                        'text-neutral-500 hover:bg-neutral-50' => ! $paginator->onFirstPage(),
                    ])
                >
                    <x-admin.icon name="chevron-right" class="h-4 w-4 rotate-180" />
                </a>

                @foreach($pages as $page)
                    @if($page === '...')
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-neutral-700 ring-1 ring-inset ring-neutral-300">&hellip;</span>
                    @else
                        <a
                            href="{{ $paginator->url($page) }}"
                            @if($ajax) @click.prevent="$dispatch('paginate', { page: {{ $page }} })" @endif
                            @class([
                                'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-neutral-300',
                                'z-10 bg-primary-600 text-white' => $page === $current,
                                'text-neutral-900 hover:bg-neutral-50' => $page !== $current,
                            ])
                        >{{ $page }}</a>
                    @endif
                @endforeach

                <a
                    href="{{ $paginator->nextPageUrl() ?? '#' }}"
                    @if($ajax && $paginator->hasMorePages()) @click.prevent="$dispatch('paginate', { page: {{ $current + 1 }} })" @endif
                    @class([
                        'relative inline-flex items-center rounded-r-md px-2 py-2 ring-1 ring-inset ring-neutral-300',
                        'pointer-events-none text-neutral-300' => ! $paginator->hasMorePages(),
                        'text-neutral-500 hover:bg-neutral-50' => $paginator->hasMorePages(),
                    ])
                >
                    <x-admin.icon name="chevron-right" class="h-4 w-4" />
                </a>
            </nav>
        </div>
    </div>
@endif
