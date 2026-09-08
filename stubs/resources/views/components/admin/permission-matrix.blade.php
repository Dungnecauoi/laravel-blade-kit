@props([
    'roles' => [],
    'permissionGroups' => [],
    'checked' => [],
    'name' => 'permissions',
])

@php
    $allPermissions = collect($permissionGroups)->flatten(1)->pluck('key')->all();

    $matrix = [];
    foreach ($roles as $role) {
        foreach ($allPermissions as $permissionKey) {
            $matrix[$role['key']][$permissionKey] = in_array($permissionKey, $checked[$role['key']] ?? [], true);
        }
    }
@endphp

<div
    x-data="{
        matrix: @js($matrix),
        permissions: @js($allPermissions),
        isColumnFull(role) { return this.permissions.every((p) => this.matrix[role][p]); },
        toggleColumn(role) {
            const next = ! this.isColumnFull(role);
            this.permissions.forEach((p) => { this.matrix[role][p] = next; });
        },
    }"
    {{ $attributes->class(['overflow-x-auto rounded-xl ring-1 ring-neutral-200']) }}
>
    <table class="min-w-full divide-y divide-neutral-200">
        <thead class="bg-neutral-50">
            <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">
                    {{ __('Quyền hạn') }}
                </th>
                @foreach($roles as $role)
                    <th scope="col" class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wide text-neutral-500">
                        <div class="flex flex-col items-center gap-y-1.5">
                            <span>{{ $role['label'] }}</span>
                            <input
                                type="checkbox"
                                :checked="isColumnFull('{{ $role['key'] }}')"
                                @change="toggleColumn('{{ $role['key'] }}')"
                                aria-label="{{ __('Chọn tất cả cho').' '.$role['label'] }}"
                                class="h-4 w-4 rounded border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1"
                            >
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 bg-white">
            @foreach($permissionGroups as $groupLabel => $permissions)
                <tr class="bg-neutral-50/60">
                    <td colspan="{{ count($roles) + 1 }}" class="px-4 py-2 text-xs font-semibold text-neutral-500">
                        {{ $groupLabel }}
                    </td>
                </tr>
                @foreach($permissions as $permission)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2.5 text-sm text-neutral-700">{{ $permission['label'] }}</td>
                        @foreach($roles as $role)
                            <td class="px-4 py-2.5 text-center">
                                <input
                                    type="checkbox"
                                    x-model="matrix['{{ $role['key'] }}']['{{ $permission['key'] }}']"
                                    name="{{ $name }}[{{ $role['key'] }}][]"
                                    value="{{ $permission['key'] }}"
                                    aria-label="{{ $role['label'].' — '.$permission['label'] }}"
                                    class="h-4 w-4 rounded border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1"
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
