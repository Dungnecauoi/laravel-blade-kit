@props(['plans' => [], 'features' => []])

<div {{ $attributes->class(['overflow-x-auto rounded-xl ring-1 ring-neutral-200']) }}>
    <table class="min-w-full divide-y divide-neutral-200">
        <thead class="bg-neutral-50">
            <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500"></th>
                @foreach($plans as $plan)
                    <th scope="col" class="px-4 py-3 text-center text-sm font-semibold text-neutral-900">{{ $plan }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 bg-white">
            @foreach($features as $feature)
                <tr>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-neutral-700">{{ $feature['label'] }}</td>
                    @foreach($plans as $plan)
                        @php $value = $feature['values'][$plan] ?? false; @endphp
                        <td class="px-4 py-3 text-center text-sm">
                            @if(is_bool($value))
                                @if($value)
                                    <x-admin.icon name="check" class="mx-auto h-4 w-4 text-success-600" />
                                @else
                                    <x-admin.icon name="minus" class="mx-auto h-4 w-4 text-neutral-300" />
                                @endif
                            @else
                                <span class="text-neutral-700">{{ $value }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
