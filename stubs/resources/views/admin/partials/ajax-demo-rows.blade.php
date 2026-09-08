@foreach($ajaxPaginator as $index => $item)
    <tr>
        <td class="px-4 py-3 text-neutral-500">{{ $ajaxPaginator->firstItem() + $index }}</td>
        <td class="px-4 py-3 text-neutral-900">{{ $item }}</td>
    </tr>
@endforeach
