import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import anchor from '@alpinejs/anchor';
import persist from '@alpinejs/persist';
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

Alpine.plugin(collapse);
Alpine.plugin(anchor);
Alpine.plugin(persist);

window.Alpine = Alpine;

Alpine.start();
