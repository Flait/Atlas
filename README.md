# Atlas MVP

Atlas is an MVP platform centered on an internal admin and data management application for musician, venue, and matching-related operations.

The repository is intentionally split into:

- `apps/api`: Symfony backend for internal admin APIs first
- `apps/admin`: Nuxt internal admin frontend
- `docs`: product and architecture notes

## Current scope

- Internal admin/data workflows only
- Strict future separation between internal ACL-protected endpoints and external/public token-based endpoints
- No public frontend app yet
- No business entities yet
- No database schema yet
- No authentication implementation yet
- No dynamic attributes yet

## Project structure

```text
apps/
  api/      Symfony backend
  admin/    Nuxt internal admin frontend
docs/
  mvp.md
  architecture.md
AGENTS.md
README.md
```

## Setup

If you use `make`, the repository includes a small root [Makefile](C:/Projects/Atlas/Makefile) for the common commands:

```bash
make install
make api-serve
make admin-serve
```

### Backend

Requirements:

- PHP 8.3+
- Composer 2+

From the repo root:

```bash
cd apps/api
composer install
php -S 127.0.0.1:8000 -t public
```

### Frontend

Requirements:

- Node.js 20+
- npm 10+ or another compatible package manager

From the repo root:

```bash
cd apps/admin
npm install
npm run dev
```

## Runability

Yes, the skeleton is runnable.

- Backend serves with PHP from `apps/api/public`
- Frontend serves with Nuxt from `apps/admin`
- Run them in two separate terminals

## Intended API split

- Internal admin API lives in the Symfony app and is intended for admin-only workflows.
- Future public API endpoints will be exposed separately and deliberately, even if implemented in the same Symfony codebase at first.
- Internal and public surfaces should differ in routing, security, contracts, rate limits, and use cases.
- Public endpoints should never directly mirror internal admin endpoints.

## Next steps

- Add bounded application modules for musician, venue, and matching
- Introduce authentication and authorization
- Add persistence and migrations once the first data model is agreed
