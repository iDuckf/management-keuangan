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
- **Models**: `User`, `Income`, `Category`, `Expense` — all under `app/Models/`
- **Migrations**: default users/cache/jobs + `incomes`, `categories`, `expenses`
- **Frontend**: Tailwind CSS 4 via `@tailwindcss/vite`, Vite with `laravel-vite-plugin`
- **Layout**: `<x-layout>` component (`app/View/Components/layout.php` + `resources/views/components/layout.blade.php`) — sidebar nav with emerald accent
- **DB**: SQLite default (`DB_CONNECTION=sqlite`)
- **Flash messages**: success flash with auto-dismiss (3.5s + fade-out) in `layout.blade.php`

## Routes (authenticated)

All CRUD routes are inside `Route::middleware('auth')->group(...)`:

| Method | URI | Controller Method | Route Name |
|---|---|---|---|
| GET | `/dashboard` | `dashboard` | `dashboard` |
| GET | `/incomes` | `incomesShow` | `incomes-show` |
| POST | `/incomes` | `incomeSave` | `incomes-save` |
| PUT | `/incomes/{income:id}` | `incomeEdit` | `income-edit` |
| DELETE | `/incomes/{income:id}` | `incomeDelete` | `income-delete` |
| GET | `/categories` | `categoriesShow` | `categories-show` |
| GET | `/expenses` | `expensesShow` | `expenses-show` |

## Models

| Model | Table | Relations | Fillable |
|---|---|---|---|
| `User` | `users` | hasMany incomes, categories, expenses | — |
| `Income` | `incomes` | belongsTo user, category | category_id, user_id, source, amount, date, description |
| `Category` | `categories` | belongsTo user; hasMany incomes, expenses | user_id, name, slug, type, color |
| `Expense` | `expenses` | belongsTo user, category | category_id, user_id, title, amount, date, description |

All transaction models cast `date` as `date` (Carbon).

## Database — cascadeOnDelete

- `incomes.category_id` → `categories.id` **cascadeOnDelete**
- `incomes.user_id` → `users.id` **cascadeOnDelete**
- `expenses.category_id` → `categories.id` **cascadeOnDelete**
- `expenses.user_id` → `users.id` **cascadeOnDelete**
- `categories.user_id` → `users.id` **cascadeOnDelete**

Menghapus parent akan otomatis menghapus semua child records.

## Views

| Route | View | Features |
|---|---|---|
| `/dashboard` | `dashboard.blade.php` | Dashboard stub |
| `/incomes` | `incomes.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |
| `/categories` | `categories.blade.php` | Card grid by type + modals (Add/Edit/Delete) |
| `/expenses` | `expenses.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |

All CRUD views use `<x-layout>`, follow dark theme (`bg-gray-950`, `bg-gray-900` cards), and include vanilla JS modal toggles (Escape key closes). Forms include proper input names matching migration columns.

## CRUD Modal Pattern

Each view has three modals: Add (green save), Edit (blue update), Delete (red confirmation). JS functions `openModal(id)` / `closeModal(id)` control visibility via `hidden` class toggling. Modals use `fixed inset-0 z-50` with backdrop blur.

### Edit Modal — Data Pre-fill

Edit button passes data via `@json($model)` wrapped in single-quoted `onclick`:
```blade
onclick='openEditModal({{ $income->id }}, @json($income))'
```
JS function fills form fields by ID (`edit_id`, `edit_source`, etc.) and dynamically sets form `action` to `/incomes/${id}`.

### Delete Modal — Form Pattern

Delete modal wraps content in `<form method="POST">` with `@csrf` + `@method('DELETE')` and a hidden `<input id="delete_id" name="id">`. JS dynamically sets form action:
```js
document.querySelector('#deleteIncomeModal form').action = `/incomes/${id}`;
```
Delete button is `type="submit"`.

### Flash Messages

Success flash (`->with('success', '...')`) auto-dismisses after 3.5s with fade-out. Added in `layout.blade.php`.

### Auto-open Modal on Validation Error

If add-form fields have validation errors, Blade checks `$errors->hasAny([...])` and auto-opens the add modal via `DOMContentLoaded`.

## Testing

- `tests/Unit/` and `tests/Feature/` (extends `Tests\TestCase`)
- phpunit.xml sets `APP_ENV=testing`, `CACHE_STORE=array`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=array`
- DB env is **commented out** in phpunit.xml — SQLite in-memory not auto-configured. Either add `<env name="DB_DATABASE" value=":memory:"/>` or create a dedicated test SQLite DB.

## Style

- PSR-4 autoloading: `App\` → `app/`, `Tests\` → `tests/`
- Indent: 4 spaces (per `.editorconfig`)
- PHP code style: Laravel Pint (no custom config, uses defaults)
- Form fields use `old()` helper to retain input on validation failure
- Select options use `@selected(old('field') == $value)` for persistence
