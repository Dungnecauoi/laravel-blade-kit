@props([])

<div
    x-data="{ toasts: [] }"
    x-init="
        if (@js(session('success'))) toasts.push({ id: Date.now(), type: 'success', message: @js(session('success')) });
        if (@js(session('error'))) toasts.push({ id: Date.now() + 1, type: 'error', message: @js(session('error')) });
    "
    @toast.window="
        toasts.push({ id: Date.now(), type: $event.detail.type ?? 'info', message: $event.detail.message });
    "
    class="pointer-events-none fixed top-4 right-4 z-[100] w-full max-w-sm space-y-2"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-init="setTimeout(() => toasts = toasts.filter(t => t.id !== toast.id), 4000)"
            x-transition
            class="pointer-events-auto flex items-start gap-x-3 rounded-lg bg-white p-4 shadow-lg ring-1 ring-black/5"
        >
            <span
                class="mt-1 h-2 w-2 shrink-0 rounded-full"
                :class="{
                    'bg-success-500': toast.type === 'success',
                    'bg-danger-500': toast.type === 'error',
                    'bg-warning-500': toast.type === 'warning',
                    'bg-info-500': toast.type === 'info',
                }"
            ></span>
            <p class="flex-1 text-sm text-neutral-700" x-text="toast.message"></p>
            <button type="button" class="text-neutral-400 hover:text-neutral-600" @click="toasts = toasts.filter(t => t.id !== toast.id)">
                <span class="sr-only">{{ __('Đóng') }}</span>
                <x-admin.icon name="x-mark" class="h-4 w-4" />
            </button>
        </div>
    </template>
</div>
