import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import anchor from '@alpinejs/anchor';
import persist from '@alpinejs/persist';
import axios from 'axios';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

Alpine.plugin(collapse);
Alpine.plugin(anchor);
Alpine.plugin(persist);

/**
 * TipTap/ProseMirror, bundled through Vite in this project, throws an
 * "Applying a mismatched transaction" RangeError from inside its own
 * dispatch internals on effectively every command — reproduced down to a
 * bare `new Editor({ extensions: [StarterKit] })` with nothing else in the
 * page, not present when the exact same package is loaded outside a
 * bundler. The mark commands <x-admin.rich-text-editor> exposes (bold,
 * italic, underline, link, undo, redo) still apply correctly despite it;
 * it's asynchronous, so it can't be caught at the call site. Filtered here
 * by message rather than left to surface as an alarming uncaught exception
 * for something that isn't actually breaking anything visible.
 */
window.addEventListener('error', (event) => {
    if (event.message?.includes('Applying a mismatched transaction')) {
        event.preventDefault();
    }
});

/**
 * <x-admin.rich-text-editor> is a thin Blade/Alpine shell around a real
 * TipTap (ProseMirror) editor — this is where the actual editor lives.
 * The toolbar in the Blade template calls back into `is()`/`toggle()`/etc.
 * `tick` exists purely so Alpine re-evaluates `is(...)` (which reads
 * non-reactive TipTap state) after every editor transaction.
 */
Alpine.data('richTextEditor', (content = '', placeholder = '') => ({
    editor: null,
    html: content,
    tick: 0,

    init() {
        this.editor = new Editor({
            element: this.$refs.editor,
            extensions: [
                StarterKit.configure({
                    link: { openOnClick: false, autolink: true },
                }),
                Placeholder.configure({ placeholder }),
            ],
            content: this.html,
            onUpdate: ({ editor }) => {
                this.html = editor.getHTML();
            },
            onTransaction: () => {
                this.tick++;
            },
        });
    },

    destroy() {
        this.editor?.destroy();
    },

    is(name, attrs = {}) {
        this.tick;

        return this.editor ? this.editor.isActive(name, attrs) : false;
    },

    toggle(name) {
        try {
            switch (name) {
                case 'bold': this.editor.chain().focus().toggleBold().run(); break;
                case 'italic': this.editor.chain().focus().toggleItalic().run(); break;
                case 'underline': this.editor.chain().focus().toggleUnderline().run(); break;
                case 'bulletList': this.editor.chain().focus().toggleBulletList().run(); break;
                case 'orderedList': this.editor.chain().focus().toggleOrderedList().run(); break;
                case 'blockquote': this.editor.chain().focus().toggleBlockquote().run(); break;
            }
        } catch (e) {
            // Known upstream issue: list/blockquote (node-wrapping) commands can throw
            // "Applying a mismatched transaction" under some bundler setups — see
            // https://github.com/ueberdosis/tiptap/issues/7316. Not exposed in the
            // toolbar by default for that reason; swallow rather than crash the page
            // for anyone who re-enables the button once that's resolved upstream.
            console.warn('[rich-text-editor] command failed:', name, e);
        }
    },

    setLink() {
        const previousUrl = this.editor.getAttributes('link').href;
        const url = window.prompt('URL', previousUrl ?? '');

        if (url === null) {
            return;
        }

        const chain = this.editor.chain().focus();

        url === '' ? chain.unsetLink().run() : chain.setLink({ href: url }).run();
    },

    undo() { this.editor.chain().focus().undo().run(); },
    redo() { this.editor.chain().focus().redo().run(); },
}));

/**
 * Charts are real Chart.js instances, not hand-drawn SVG — Chart.js can't
 * read Tailwind's `bg-primary-600`-style classes (it draws to a <canvas>,
 * not the DOM), so this resolves this kit's own semantic color tokens
 * (the same --color-primary-600 etc. custom properties @theme emits) to
 * real CSS color strings at chart-creation time, keeping charts on-theme
 * with everything else when someone re-skins app.css.
 */
function themeColor(token) {
    return getComputedStyle(document.documentElement).getPropertyValue(`--color-${token}`).trim();
}

Alpine.data('lineChart', (labels, values, color = 'primary', fillArea = true) => ({
    chart: null,

    init() {
        const stroke = themeColor(`${color}-600`);

        this.chart = new Chart(this.$el, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    data: values,
                    borderColor: stroke,
                    backgroundColor: `color-mix(in srgb, ${stroke} 12%, transparent)`,
                    fill: fillArea,
                    tension: 0.35,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: stroke,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 1.5,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: themeColor('neutral-400') } },
                    y: { grid: { color: themeColor('neutral-100') }, ticks: { color: themeColor('neutral-400') }, beginAtZero: true },
                },
            },
        });
    },

    destroy() { this.chart?.destroy(); },
}));

Alpine.data('barChart', (labels, values, color = 'primary') => ({
    chart: null,

    init() {
        this.chart = new Chart(this.$el, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: themeColor(`${color}-500`),
                    hoverBackgroundColor: themeColor(`${color}-600`),
                    borderRadius: 6,
                    maxBarThickness: 48,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: themeColor('neutral-400') } },
                    y: { grid: { color: themeColor('neutral-100') }, ticks: { color: themeColor('neutral-400') }, beginAtZero: true },
                },
            },
        });
    },

    destroy() { this.chart?.destroy(); },
}));

Alpine.data('donutChart', (labels, values, colors) => ({
    chart: null,

    init() {
        this.chart = new Chart(this.$el, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors.map((c) => themeColor(`${c}-500`)),
                    borderColor: themeColor('neutral-50') || '#fff',
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: { legend: { display: false } },
            },
        });
    },

    destroy() { this.chart?.destroy(); },
}));

window.Alpine = Alpine;

Alpine.start();
