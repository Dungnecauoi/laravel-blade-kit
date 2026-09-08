@props(['columns' => []])

{{--
    Cards are re-orderable client-side (native HTML5 drag & drop), so the whole
    board — columns and cards — is rendered from Alpine state via x-for rather
    than split into separate Blade components: a server-rendered sub-component
    couldn't reflect a drop that only ever happens in the browser.
--}}

<div {{ $attributes }}>
    @if(empty($columns))
        <x-admin.empty-state icon="columns" :title="__('Chưa có cột nào')" class="py-10" />
    @else
        <div
            x-data="{
                columns: @js($columns),
                dragging: null,
                dragStart(columnKey, cardId) { this.dragging = { columnKey, cardId }; },
                dragEnd() { this.dragging = null; },
                dropOn(targetColumnKey, targetIndex = null) {
                    if (! this.dragging) return;
                    const fromColumn = this.columns.find((c) => c.key === this.dragging.columnKey);
                    const cardIndex = fromColumn.cards.findIndex((c) => c.id === this.dragging.cardId);
                    if (cardIndex === -1) return;
                    const [card] = fromColumn.cards.splice(cardIndex, 1);
                    const toColumn = this.columns.find((c) => c.key === targetColumnKey);
                    if (targetIndex === null || targetIndex > toColumn.cards.length) {
                        toColumn.cards.push(card);
                    } else {
                        toColumn.cards.splice(targetIndex, 0, card);
                    }
                    this.dragging = null;
                },
            }"
            class="flex items-start gap-4 overflow-x-auto pb-2"
        >
            <template x-for="column in columns" :key="column.key">
                <div
                    @dragover.prevent
                    @drop.prevent="dropOn(column.key)"
                    class="flex w-72 shrink-0 flex-col rounded-xl bg-neutral-100 p-3"
                >
                    <div class="mb-3 flex items-center gap-x-2 px-1">
                        <span class="text-sm font-semibold text-neutral-700" x-text="column.label"></span>
                        <span class="rounded-full bg-neutral-200 px-1.5 py-0.5 text-xs font-medium text-neutral-500" x-text="column.cards.length"></span>
                    </div>

                    <div class="flex flex-col gap-2">
                        <template x-for="(card, index) in column.cards" :key="card.id">
                            <div
                                draggable="true"
                                @dragstart="dragStart(column.key, card.id)"
                                @dragend="dragEnd()"
                                @dragover.prevent.stop
                                @drop.prevent.stop="dropOn(column.key, index)"
                                :class="{ 'opacity-40': dragging && dragging.cardId === card.id }"
                                class="cursor-grab rounded-lg bg-white p-3 shadow-sm ring-1 ring-neutral-200 transition-shadow hover:shadow-md active:cursor-grabbing"
                            >
                                <p class="text-sm font-medium text-neutral-900" x-text="card.title"></p>
                                <p class="mt-1 text-xs text-neutral-500" x-text="card.description" x-show="card.description"></p>

                                <div class="mt-2.5 flex items-center justify-between gap-2">
                                    <div class="flex flex-wrap gap-1">
                                        <template x-for="tag in (card.tags || [])" :key="tag">
                                            <span class="rounded bg-primary-50 px-1.5 py-0.5 text-[11px] font-medium text-primary-700" x-text="tag"></span>
                                        </template>
                                    </div>
                                    <span
                                        x-show="card.assignee"
                                        :title="card.assignee"
                                        x-text="(card.assignee || '?').charAt(0).toUpperCase()"
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary-100 text-[11px] font-semibold uppercase text-primary-700"
                                    ></span>
                                </div>
                            </div>
                        </template>

                        <div
                            x-show="column.cards.length === 0"
                            class="rounded-lg border-2 border-dashed border-neutral-200 py-3 text-center text-xs text-neutral-400"
                        >
                            {{ __('Kéo thẻ vào đây') }}
                        </div>
                    </div>
                </div>
            </template>
        </div>
    @endif
</div>
