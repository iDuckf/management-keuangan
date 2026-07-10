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
- **Models**: `User`, `Income`, `Category`, `Expense`, `Balance` — all under `app/Models/`
- **Controllers**: `AdminController` (show pages), `IncomeController`, `ExpenseController`, `CategoryController`, `BalanceController` — all under `app/Http/Controllers/`
- **Migrations**: default users/cache/jobs + `incomes`, `categories`, `expenses`, `balances`
- **Frontend**: Tailwind CSS 4 via `@tailwindcss/vite`, Vite with `laravel-vite-plugin`
- **Layout**: `<x-layout>` component (`app/View/Components/layout.php` + `resources/views/components/layout.blade.php`) — fixed sidebar nav (does not scroll), emerald accent
- **DB**: SQLite default (`DB_CONNECTION=sqlite`)
- **Flash messages**: success flash with auto-dismiss (3.5s + fade-out) in `layout.blade.php`
- **Session keys**: `id`, `username`, `email` (set in `AuthContoller::login`)

## Routes (authenticated)

All CRUD routes are inside `Route::middleware('auth')->group(...)`:

| Method | URI | Controller Method | Route Name |
|---|---|---|---|
| GET | `/dashboard` | `dashboard` | `dashboard` |
| GET | `/incomes` | `incomesShow` | `incomes-show` |
| POST | `/incomes` | `incomeSave` | `incomes-save` |
| PUT | `/incomes/{income:id}` | `incomeEdit` | `income-edit` |
| DELETE | `/incomes/{income:id}` | `incomeDelete` | `income-delete` |
| GET | `/expenses` | `expensesShow` | `expenses-show` |
| POST | `/expenses` | `expenseSave` | `expense-save` |
| PUT | `/expenses/{expense:id}` | `expenseEdit` | `expense-edit` |
| DELETE | `/expenses/{expense:id}` | `expenseDelete` | `expense-delete` |
| GET | `/categories` | `categoryShow` | `categories-show` |
| POST | `/categories` | `categorySave` | `category-save` |
| PUT | `/categories/{category:id}` | `categoryEdit` | `category-edit` |
| DELETE | `/categories/{category:id}` | `categoryDelete` | `category-delete` |
| GET | `/balances` | `balancesShow` | `balances-show` |
| POST | `/balances` | `balanceSave` | `balances-save` |
| PUT | `/balances/{balance:id}` | `balanceEdit` | `balances-edit` |
| DELETE | `/balances/{balance:id}` | `balanceDelete` | `balances-delete` |

## Models

| Model | Table | Relations | Fillable |
|---|---|---|---|
| `User` | `users` | hasMany incomes, categories, expenses, balances | — |
| `Income` | `incomes` | belongsTo user, category, **balance** | category_id, user_id, balance_id, source, amount, date, description |
| `Category` | `categories` | belongsTo user; hasMany incomes, expenses | user_id, name, slug, type, color |
| `Expense` | `expenses` | belongsTo user, category, **balance** | category_id, user_id, balance_id, title, amount, date, description |
| `Balance` | `balances` | belongsTo user; hasMany incomes, expenses | user_id, name, tipe, amount |

All transaction models cast `date` as `date` (Carbon).

## Database — cascadeOnDelete

- `incomes.category_id` → `categories.id` **cascadeOnDelete**
- `incomes.user_id` → `users.id` **cascadeOnDelete**
- `incomes.balance_id` → `balances.id` **cascadeOnDelete**
- `expenses.category_id` → `categories.id` **cascadeOnDelete**
- `expenses.user_id` → `users.id` **cascadeOnDelete**
- `expenses.balance_id` → `balances.id` **cascadeOnDelete**
- `categories.user_id` → `users.id` **cascadeOnDelete**
- `balances.user_id` → `users.id` **cascadeOnDelete**

Menghapus parent akan otomatis menghapus semua child records.

## Balance Auto-Update Logic

Income dan Expense terhubung ke Balance. Amount balance otomatis terupdate:

| Action | Balance Effect |
|---|---|
| Income created | `balance.increment('amount', income.amount)` |
| Income edited | `oldBalance.decrement(oldAmount)` + `newBalance.increment(newAmount)` |
| Income deleted | `balance.decrement('amount', income.amount)` |
| Expense created | `balance.decrement('amount', expense.amount)` + validasi saldo cukup |
| Expense edited | `oldBalance.increment(oldAmount)` + `newBalance.decrement(newAmount)` + validasi saldo |
| Expense deleted | `balance.increment('amount', expense.amount)` |

Balance `tipe` values: `cash`, `ewallet`, `bank`.

## Views

| Route | View | Features |
|---|---|---|
| `/dashboard` | `dashboard.blade.php` | Dashboard stub |
| `/incomes` | `incomes.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |
| `/categories` | `categories.blade.php` | Card grid grouped by type + modals (Add/Edit/Delete) |
| `/expenses` | `expenses.blade.php` | Summary cards + table + modals (Add/Edit/Delete) |
| `/balances` | `balances.blade.php` | Total balance summary + ATM cards grouped by type + modals (Add/Edit/Delete) |

All CRUD views use `<x-layout>`, follow dark theme (`bg-gray-950`, `bg-gray-900` cards), and include vanilla JS modal toggles. Forms include proper input names matching migration columns.

## Layout

- Sidebar: `fixed inset-y-0 left-0 w-64 z-40` — does not scroll with page
- Main content: `ml-64 overflow-y-auto` — independent scroll
- Sidebar nav items: Dashboard, Incomes, Expenses, Category, Balances (wallet icon)
- Active nav detection: `request()->routeIs('...')` toggles emerald accent class

## CRUD Modal Pattern

Each view has three modals: Add (green save), Edit (blue update), Delete (red confirmation). JS functions `openModal(id)` / `closeModal(id)` control visibility via `hidden` class toggling. Modals use `fixed inset-0 z-50` with backdrop blur.

### Edit Modal — Data Pre-fill

Edit button passes data via `@json($model)` **must** be wrapped in **single-quoted** `onclick`. Double quotes break the attribute because `@json` outputs structural `"`:
```blade
onclick='openEditModal({{ $income->id }}, @json($income))'
```
JS function fills form fields by ID (`edit_id`, `edit_source`, etc.) and dynamically sets form `action` to `/incomes/${id}`.

### Color Picker — Real-time Hex Sync

Color input paired with hex text input. Add `oninput="this.nextElementSibling.value = this.value"` on the `<input type="color">`:
```blade
<input type="color" name="color" oninput="this.nextElementSibling.value = this.value">
<input type="text" name="color_hex">
```
In edit modals (where IDs exist), use `document.getElementById('edit_color_hex').value = this.value` instead.

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

## Balance View — ATM Card Design

Balance cards are displayed grouped by `tipe` (Cash / E-Wallet / Bank). Each group has a section header with icon, count, and subtotal.

Each card uses ATM-style design:
- Gradient background per type: Cash (emerald→teal), E-Wallet (blue→indigo→purple), Bank (slate→zinc)
- Chip icon (amber), type label (top-right), amount (center), card holder name (bottom-left)
- Edit/Delete buttons appear on hover (`opacity-0 group-hover:opacity-100`)
- Decorative translucent circles for visual depth

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
