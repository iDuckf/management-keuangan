# AGENTS.md — mymoney

Laravel 12 personal finance manager. Default SQLite.

## Commands

| Action | Command |
|---|---|
| Start full dev environment | `composer dev` (runs Artisan serve + queue:listen + pail logs + Vite via concurrently) |
| Vite dev server only | `npm run dev` |
| Build assets | `npm run build` |
| Run tests | `php artisan test` or `vendor/bin/phpunit` |
| Run Pint (PHP CS fixer) | `vendor/bin/pint` |

## Architecture

- **Routes**: `routes/web.php`, `routes/console.php`
- **Models**: `app/Models/User.php` only (migrations exist for incomes, categories, expenses tables but models not yet created)
- **Migrations**: default users/cache/jobs + `incomes`, `categories`, `expenses`
- **Frontend**: Tailwind CSS 4 via `@tailwindcss/vite`, Vite with `laravel-vite-plugin`
- **Layout**: `<x-layout>` component (`app/View/Components/layout.php` + `resources/views/components/layout.blade.php`) — sidebar nav with emerald accent
- **DB**: SQLite default (`DB_CONNECTION=sqlite`)

## Views

| Route | View | Features |
|---|---|---|
| `/dashboard` | `dashboard.blade.php` | Dashboard stub |
| `/incomes` | `incomes.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |
| `/categories` | `categories.blade.php` | Card grid by type + modals (Add/Edit/Delete) |
| `/expenses` | `expenses.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |

All CRUD views use `<x-layout>`, follow dark theme (`bg-gray-950`, `bg-gray-900` cards), and include vanilla JS modal toggles (Escape key closes). Forms include proper input names matching migration columns for easy backend wiring.

## CRUD Modal Pattern

Each view has three modals: Add (green save), Edit (blue update), Delete (red confirmation). JS functions `openModal(id)` / `closeModal(id)` control visibility. Modals use `fixed inset-0 z-50` with backdrop blur.

## Testing

- `tests/Unit/` and `tests/Feature/` (extends `Tests\TestCase`)
- phpunit.xml sets `APP_ENV=testing`, `CACHE_STORE=array`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=array`
- DB env is **commented out** in phpunit.xml — SQLite in-memory not auto-configured. Either add `<env name="DB_DATABASE" value=":memory:"/>` or create a dedicated test SQLite DB.

## Style

- PSR-4 autoloading: `App\` → `app/`, `Tests\` → `tests/`
- Indent: 4 spaces (per `.editorconfig`)
- PHP code style: Laravel Pint (no custom config, uses defaults)
