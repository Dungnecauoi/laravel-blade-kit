@props(['headers' => []])

<div {{ $attributes->except('class') }} class="{{ $attributes->get('class') ?: 'overflow-x-auto rounded-xl ring-1 ring-neutral-200' }}">
    <table class="min-w-full divide-y divide-neutral-200">
        @if(isset($header))
            <thead class="bg-neutral-50">
                {{ $header }}
            </thead>
        @elseif(count($headers))
            <thead class="bg-neutral-50">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody class="divide-y divide-neutral-100 bg-white">
            {{ $slot }}
        </tbody>
    </table>
</div>
