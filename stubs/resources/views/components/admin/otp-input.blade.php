@props(['name', 'length' => 6, 'label' => null, 'error' => null, 'hint' => null])

<div
    x-data="{
        length: {{ (int) $length }},
        digits: Array({{ (int) $length }}).fill(''),
        get value() { return this.digits.join(''); },
        focusBox(i) { this.$refs['box' + i]?.focus(); },
        onInput(i, e) {
            const val = e.target.value.replace(/[^0-9]/g, '').slice(-1);
            this.digits[i] = val;
            e.target.value = val;
            if (val && i < this.length - 1) this.focusBox(i + 1);
        },
        onKeydown(i, e) {
            if (e.key === 'Backspace' && ! this.digits[i] && i > 0) this.focusBox(i - 1);
        },
        onPaste(e) {
            e.preventDefault();
            const pasted = (e.clipboardData.getData('text') || '').replace(/[^0-9]/g, '').slice(0, this.length);
            pasted.split('').forEach((d, i) => { this.digits[i] = d; });
            this.$nextTick(() => this.focusBox(Math.min(pasted.length, this.length) - 1));
        },
    }"
>
    @if($label)
        <x-admin.label>{{ $label }}</x-admin.label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="value">

    <div class="flex gap-x-2" @paste="onPaste($event)">
        @for($i = 0; $i < $length; $i++)
            <input
                type="text"
                inputmode="numeric"
                autocomplete="one-time-code"
                maxlength="1"
                x-ref="box{{ $i }}"
                :value="digits[{{ $i }}]"
                @input="onInput({{ $i }}, $event)"
                @keydown="onKeydown({{ $i }}, $event)"
                class="h-12 w-12 rounded-md border-0 text-center text-lg font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 focus:outline-none focus:ring-2 focus:ring-primary-600"
            >
        @endfor
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
