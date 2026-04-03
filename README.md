# Atlas

Atlas is an MVP monorepo for an internal admin and data management platform focused on musician, venue, and matching-related operations.

The repository keeps the backend server application and the internal admin frontend together on purpose:

- `apps/api`: Symfony server application for internal admin APIs first
- `apps/admin`: Nuxt internal admin frontend
- `docs`: product and architecture notes

## Direction

Atlas should evolve as a monorepo, and the backend app inside `apps/api` should follow a disciplined server-application style:

- thin HTTP transport layer
- explicit application endpoints/use cases
- transport entry points delegate to application endpoints
- separate `Presentation`, `Application`, `Domain`, and `Infrastructure` concerns
- clear separation between internal admin contracts and future public contracts
- explicit console entry points when background or operational workflows appear

Atlas should start with strong architectural boundaries from day one, without inheriting unnecessary operational weight too early. We do not need Docker orchestration, database tooling, search infrastructure, messaging, or a broad dependency set before real use cases justify them.

## Monorepo Shape

```text
apps/
  api/      Symfony backend server application
  admin/    Nuxt internal admin frontend
docs/
  architecture.md
  mvp.md
AGENTS.md
README.md
Makefile
```

In other words: Atlas keeps the backend server application and the internal admin UI in one repository, instead of splitting them into separate repositories.

## Backend Target Shape

`apps/api` is currently a very small Symfony skeleton. As the first real modules are added, it should move toward this shape:

```text
apps/api/src/
  Presentation/
    Http/
      Action/
      DTO/
      Service/
    Console/
      Command/
  Application/
    Endpoint/
    Feature/
    Port/
  Domain/
  Infrastructure/
```

Expected responsibilities:

- `Presentation`: HTTP, CLI, and other transport entry points only
- `Application`: use cases, orchestration, input/output models, ports
- `Domain`: business concepts once they become real
- `Infrastructure`: framework, persistence, and external integrations

Expected flow:

- HTTP action/controller -> application endpoint -> domain/ports
- console command -> application endpoint -> domain/ports
- transport layer adapts input/output, but does not own workflow logic

The current minimal `Controller/` layout is acceptable for bootstrapping, but new real features should align with the target structure above instead of deepening the temporary skeleton shape.

## API Direction

- Internal admin API remains the first-class surface
- Internal routes should stay explicit, for example `/internal/...`
- Future public endpoints should be introduced as a different contract, not as a reuse of internal admin endpoints
- Public routes should have their own namespace and versioning strategy when they appear

## Current Scope

- Internal admin/data workflows only
- No public frontend app yet
- No business entities yet
- No database schema yet
- No authentication implementation yet
- No dynamic attributes yet

## Setup

The root [Makefile](./Makefile) provides the common workspace commands:

```bash
make install
make api-serve
make admin-serve
```

### Backend

Requirements:

- PHP 8.2+
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

## Current State

After installing dependencies, the current skeleton is intentionally small and runnable:

- backend serves from `apps/api/public`
- frontend serves from `apps/admin`
- only a minimal internal status endpoint exists so far

The documentation describes the intended direction for the first real modules, not a promise that the current skeleton already contains the full target structure.

## Next Steps

- add the first real module in `apps/api` using the target layer split
- introduce the first admin flow in `apps/admin` that consumes internal API data
- add backend tests for HTTP action and application endpoint boundaries
- introduce authentication and persistence only when the first concrete workflow requires them
