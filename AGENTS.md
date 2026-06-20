# AGENTS.md — mymoney

Fresh Laravel 12 skeleton (no custom app code yet). Default SQLite.

## Commands

| Action | Command |
|---|---|
| Start full dev environment | `composer dev` (runs Artisan serve + queue:listen + pail logs + Vite via concurrently) |
| Vite dev server only | `npm run dev` |
| Build assets | `npm run build` |
| Run tests | `php artisan test` or `vendor/bin/phpunit` |
| Run Pint (PHP CS fixer) | `vendor/bin/pint` |

## Architecture

- **Routes**: `routes/web.php` (only welcome view), `routes/console.php`
- **Models**: `app/Models/User.php` only
- **Migrations**: default users, cache, jobs tables
- **Frontend**: Tailwind CSS 4 via `@tailwindcss/vite`, Vite with `laravel-vite-plugin`
- **DB**: SQLite default (`DB_CONNECTION=sqlite` — no MySQL/Postgres configured)

## Testing

- `tests/Unit/` and `tests/Feature/` (extends `Tests\TestCase`)
- phpunit.xml sets `APP_ENV=testing`, `CACHE_STORE=array`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=array`
- DB env is **commented out** in phpunit.xml — SQLite in-memory not auto-configured. Either add `<env name="DB_DATABASE" value=":memory:"/>` or create a dedicated test SQLite DB.

## Style

- PSR-4 autoloading: `App\` → `app/`, `Tests\` → `tests/`
- Indent: 4 spaces (per `.editorconfig`)
- PHP code style: Laravel Pint (no custom config, uses defaults)
