# Laravel Blade Kit

A lean, self-hosted admin UI kit for Laravel — built with **Blade components** (the modern `<x-component>` syntax, not `@extends`), **Tailwind CSS v4**, and **Alpine.js**. No Livewire required, no black-box package lock-in.

Unlike most component libraries, Blade Kit doesn't hide behind a package namespace. Installing it **copies real files into your app** — the same components, controllers, and services you'd write by hand — so you own the code from minute one and can change anything without fighting a vendor abstraction.

## What's included

90+ components across 4 layouts:

- **Layouts**: `<x-layouts.admin>` (sidebar, navbar, command palette, toast container), `<x-layouts.auth>` (centered card — login/register/forgot-password), `<x-layouts.blank>` (chrome-free — print/standalone pages), `<x-layouts.error>` (404/403/500).
- **Navigation**: config-driven sidebar menu (`config/admin.php` + `MenuService`), breadcrumbs, command palette (⌘K). Sidebar collapses to icon-only on desktop (state remembered via `@alpinejs/persist`) and ships in `dark` (default) or `light` (`ADMIN_SIDEBAR_VARIANT=light`) variants. Dropdown/combobox/date-picker popups reposition automatically near screen edges via `@alpinejs/anchor` (Floating UI).
- **Forms**: input (variants: outline/filled, icon prefix/suffix, addon before/after, password toggle, clearable), textarea (autosize), select, combobox (searchable, single or multi-select with tags), number input (stepper), search input, date picker, color picker, slider, toggle group (segmented control), rating, checkbox, radio, toggle, file upload, avatar upload, tag input, rich text editor, filter builder, multi-step wizard.
- **Feedback**: alert, toast, empty-state, skeleton, progress bar, spinner.
- **Data display**: table (with sortable headers, bulk-select toolbar), pagination (classic + AJAX via Alpine/Axios), card, badge, avatar, avatar group, stat-card, accordion, timeline, stepper, description list, list group, kbd, tree view, permission matrix.
- **Charts & scheduling**: line/bar/donut charts (pure SVG, no chart library), calendar, activity heatmap.
- **Dashboards & organization**: kanban board (drag & drop), file manager, context menu.
- **Ecommerce & inventory**: stock badge, inventory table, stock-history log, product card, price tag, variant selector, product gallery, order timeline, order summary, payment method badge, invoice (printable).
- **Overlays**: modal, drawer (slide-over), dropdown, tooltip.
- **Actions**: button, split button, confirm-action (delete confirm + real form submit), copy-to-clipboard.
- **i18n**: every string wrapped in `__()`, Vietnamese as the source language, `lang/en.json` for English — add more locales the same way.
- **Design tokens**: one `@theme` block (`resources/css/blade-kit.css`) mapping semantic names (`primary`, `neutral`, `danger`, `success`, `warning`, `info`) to Tailwind palettes. Re-skin the whole kit by editing 5 color scales in one file — no Blade file ever needs to change.

Demo pages ship for every layout — `/auth-demo/{login,register,forgot-password}`, `/errors-demo/{404,403,500}`, plus `/admin/{settings,inventory,orders/1082,invoice}` — wired into `routes/admin.php` for reference. The auth pages are UI only (no session/auth logic); wire them to your own auth flow or Breeze/Fortify.

Run `php artisan blade-kit:list` any time to see the full, current list.

## Requirements

- PHP ^8.2
- Laravel ^11.0 / ^12.0 / ^13.0
- Tailwind CSS v4 (CSS-first `@theme` config)

## Installation

```bash
composer require dungnecauoi/laravel-blade-kit
php artisan blade-kit:install
```

The installer copies files into your app (skipping anything that already exists — pass `--force` to overwrite) and prints the remaining manual steps, since those touch files it won't edit for you:

```bash
npm install alpinejs @alpinejs/collapse @alpinejs/anchor @alpinejs/persist axios
```

Then, by hand:

1. `resources/js/app.js` — add `import './blade-kit';`
2. `resources/css/app.css` — right after `@import 'tailwindcss';`, add `@import './blade-kit.css';`
3. `routes/web.php` — add `require __DIR__.'/admin.php';`
4. `bootstrap/app.php` — inside `withMiddleware()`, add `$middleware->web(append: [\App\Http\Middleware\SetLocale::class]);`
5. `bootstrap/providers.php` — add `App\Providers\AdminServiceProvider::class`
6. `npm run build`

Visit `/admin/dashboard` and `/admin/ui-kit` (the second is a living catalogue of every component — copy patterns from it).

## Installing only what you need

A small project doesn't need all 90+ components sitting in `resources/views/components/admin`. Add one at a time — the installer scans each component's own source for `<x-admin.xxx>` references and pulls in whatever it depends on automatically:

```bash
php artisan blade-kit:list                    # see every available component
php artisan blade-kit:add stat-card            # also copies card + icon (its dependencies)
php artisan blade-kit:add button table modal   # install several at once
```

Remove what you don't use — it refuses if something else in your app still references it, so you can't accidentally break a page:

```bash
php artisan blade-kit:remove drawer
# Cannot remove 'drawer' — still used by: resources/views/admin/edit-user.blade.php
php artisan blade-kit:remove drawer --force    # only if you're sure
```

`blade-kit:install` (no arguments) remains the "just give me everything" option for getting a full admin panel running in one shot.

## Why files, not a package namespace

Component libraries that keep everything inside `vendor/` are easy to install and hard to bend. The moment you need one button variant they didn't think of, you're forking the package or writing CSS overrides around it. Blade Kit ships as source you copy in once — every component is a plain `.blade.php` file in your own `resources/views/components/admin`, editable like any file you wrote yourself.

## Theming

```css
/* resources/css/app.css */
@theme {
    --color-primary-600: var(--color-blue-600); /* was indigo — done */
}
```

Every button, badge, focus ring, and active nav state re-skins automatically.

## License

MIT.
