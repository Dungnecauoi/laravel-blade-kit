@props(['endpoint'])

{{--
    Server contract: GET {{ $endpoint }}?ajax=1&page=N must return
    { "rows": "<tr>...</tr>", "pagination": "<div>...pagination markup...</div>" }
    rendered from the same Blade partials used for the initial page load,
    so the AJAX response and the first paint never drift apart.
--}}
<div
    x-data="{
        loading: false,
        async goToPage(page) {
            this.loading = true;
            try {
                const { data } = await axios.get('{{ $endpoint }}', { params: { ajax_page: page, ajax: 1 } });
                this.$refs.rows.innerHTML = data.rows;
                this.$refs.pagination.innerHTML = data.pagination;
                const url = new URL(window.location);
                url.searchParams.set('ajax_page', page);
                window.history.replaceState({}, '', url);
            } finally {
                this.loading = false;
            }
        },
    }"
    @paginate="goToPage($event.detail.page)"
    class="relative"
>
    <div
        x-show="loading"
        x-transition.opacity
        x-cloak
        class="absolute inset-0 z-10 flex items-center justify-center bg-white/60"
    >
        <x-admin.spinner class="h-6 w-6 text-primary-600" />
    </div>

    {{ $slot }}
</div>
