# NurseryPulse

A small API for a multi-tenant nursery group: staff check children into and out of rooms, and a
manager can see who's in a room right now. Each nursery group (tenant) is fully isolated from
every other tenant on the same platform.

## Stack

- PHP 8.3, Laravel 13
- MySQL for local/dev runtime (see `.env`, set up for Homestead)
- SQLite in-memory for automated tests (Laravel's default test config — fast, zero setup, and
  kept deliberately separate from the dev database)
- Pest for testing

## Setup

1. `composer install`
2. `.env` is already present and configured for this project's Homestead site. If you're not
   using Homestead, point `DB_*` at your own MySQL instance and create the database named in
   `DB_DATABASE`.
3. `php artisan key:generate` (skip if `APP_KEY` is already set)
4. `php artisan migrate`
5. One-time: add Pest (not in the base Laravel install) —
   `composer require pestphp/pest pestphp/pest-plugin-laravel --dev --with-all-dependencies`
   then `php artisan pest:install`

## Running the tests

```
vendor/bin/pest
```

Tests run against an in-memory SQLite database (configured in `phpunit.xml`), independent of
whatever MySQL database you've set up for local running.

## Multi-tenancy

Every request must carry an `X-Tenant-ID` header. `ResolveTenant` middleware reads it, rejects
the request with a 400 if it's missing, and binds it into the service container as
`CurrentTenant` for the rest of the request.

Every tenant-owned model (`Room`, `Child`, `CheckIn`) uses a `BelongsToTenant` trait that:
- adds a global Eloquent scope filtering every query by `tenant_id`, and
- auto-stamps `tenant_id` on create.

This means tenant filtering isn't something a controller or a future developer has to remember —
it's structurally part of the model. It also means implicit route-model binding (e.g. `{room}` in
a URL) will 404 instead of leaking when the id belongs to another tenant, since resolving it goes
through the same scoped query.

## API

_(to be filled in once the check-in/check-out/occupants endpoints are built)_

## The double check-in decision

_(to be filled in once that behaviour is implemented — see the brief's "one decision we leave to
you")_

## What I'd do with more time

_(to be filled in)_

## What I left out on purpose

_(to be filled in)_

## AI tool usage

_(to be filled in)_
