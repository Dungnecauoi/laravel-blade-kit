import Alpine from 'alpinejs';

/**
 * <x-admin.media-library> — a full browser/upload UI over duxbo/laravel-media's
 * own REST endpoints (see stubs/routes/media.php, which mounts that
 * package's actual controllers under the admin session instead of
 * duplicating their upload/validation/security logic here).
 *
 * A separate entry point rather than part of blade-kit.js, imported only
 * when this feature is actually added — most projects never install
 * duxbo/laravel-media, and shouldn't ship its browser JS if they don't.
 * `import Alpine from 'alpinejs'` here resolves to the same module
 * instance blade-kit.js already started (Vite/ES modules dedupe by
 * specifier), so this only needs to run before blade-kit.js's own
 * `Alpine.start()` — see the required import order in this file's
 * install instructions.
 */
Alpine.data('mediaLibrary', (endpoints) => ({
    items: [],
    meta: { current_page: 1, last_page: 1, total: 0 },
    folders: [],
    currentFolderId: null,
    selected: [],
    search: '',
    uploading: false,
    loading: false,
    dragging: false,

    init() {
        this.fetchFolders();
        this.fetchItems();
    },

    fetchFolders() {
        // Flattened with a depth for indentation, rather than rendered as a
        // recursive template — Alpine has no built-in recursive-component
        // primitive, so a flat list driving one x-for is the simplest way
        // to render a tree of arbitrary depth.
        window.axios.get(endpoints.foldersTree).then((res) => { this.folders = this.flattenFolders(res.data.data, 0); });
    },

    flattenFolders(nodes, depth) {
        return nodes.flatMap((node) => [
            { id: node.id, name: node.name, depth, media_count: node.media_count },
            ...this.flattenFolders(node.children ?? [], depth + 1),
        ]);
    },

    fetchItems(page = 1) {
        this.loading = true;
        this.selected = [];

        window.axios.get(endpoints.items, {
            params: {
                page,
                search: this.search || undefined,
                folder_id: this.currentFolderId ?? 'null',
            },
        }).then((res) => {
            this.items = res.data.data;
            this.meta = res.data.meta;
        }).finally(() => { this.loading = false; });
    },

    openFolder(folderId) {
        this.currentFolderId = folderId;
        this.fetchItems();
    },

    toggleSelect(id) {
        this.selected = this.selected.includes(id)
            ? this.selected.filter((i) => i !== id)
            : [...this.selected, id];
    },

    upload(fileList) {
        const files = Array.from(fileList);

        if (files.length === 0) {
            return;
        }

        const formData = new FormData();
        files.forEach((file) => formData.append('files[]', file));

        if (this.currentFolderId) {
            formData.append('folder_id', this.currentFolderId);
        }

        this.uploading = true;

        window.axios.post(endpoints.uploadMultiple, formData)
            .then(() => this.fetchItems())
            .finally(() => { this.uploading = false; });
    },

    deleteItem(id) {
        if (! confirm(this.i18n.confirmDelete)) {
            return;
        }

        window.axios.delete(endpoints.itemDestroy.replace(':id', id)).then(() => this.fetchItems());
    },

    deleteSelected() {
        if (this.selected.length === 0 || ! confirm(this.i18n.confirmBulkDelete)) {
            return;
        }

        window.axios.post(endpoints.bulkDelete, { ids: this.selected }).then(() => this.fetchItems());
    },

    createFolder() {
        const name = prompt(this.i18n.newFolderName);

        if (! name) {
            return;
        }

        window.axios.post(endpoints.foldersStore, { name, parent_id: this.currentFolderId }).then(() => this.fetchFolders());
    },

    isImage(item) {
        return item.mime_type?.startsWith('image/');
    },

    i18n: window.bladeKitMediaLibraryI18n ?? {
        confirmDelete: 'Xoá file này?',
        confirmBulkDelete: 'Xoá các file đã chọn?',
        newFolderName: 'Tên thư mục mới:',
    },
}));
