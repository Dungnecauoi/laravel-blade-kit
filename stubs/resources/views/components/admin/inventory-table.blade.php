@props(['items' => []])

<x-admin.table :headers="[__('SKU'), __('Sản phẩm'), __('Kho'), __('Tồn kho'), __('Trạng thái')]" {{ $attributes }}>
    @forelse($items as $item)
        <tr>
            <td class="whitespace-nowrap px-4 py-3 font-mono text-sm text-neutral-500">{{ $item['sku'] }}</td>
            <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-neutral-900">{{ $item['name'] }}</td>
            <td class="whitespace-nowrap px-4 py-3 text-sm text-neutral-500">{{ $item['warehouse'] ?? '—' }}</td>
            <td class="whitespace-nowrap px-4 py-3 text-sm text-neutral-500">{{ $item['quantity'] }}</td>
            <td class="whitespace-nowrap px-4 py-3">
                <x-admin.stock-badge :quantity="$item['quantity']" :threshold="$item['threshold'] ?? 5" />
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">
                <x-admin.empty-state icon="box" :title="__('Không có sản phẩm nào trong kho')" />
            </td>
        </tr>
    @endforelse
</x-admin.table>
