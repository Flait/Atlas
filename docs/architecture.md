# Architecture Notes

## Repository Shape

Atlas is a monorepo with two application surfaces kept together:

- `apps/api`: Symfony backend server application
- `apps/admin`: Nuxt internal admin UI
- `docs`: product and architecture notes

This is intentionally different from keeping backend and frontend in separate repositories. Atlas should keep monorepo ergonomics, while the backend application itself should evolve with a clear layered server-application style.

## Architectural Direction

The product starts as an internal admin/data system. The backend should therefore be optimized first for operational workflows, but it should still preserve a clean boundary for a future public API.

The core backend direction is:

- transport concerns stay in `Presentation`
- use-case orchestration lives in `Application`
- domain concepts are isolated from framework concerns
- infrastructure implements ports and integrations
- HTTP and CLI entry points are explicit and discoverable

Atlas should start with strong architectural boundaries from day one. Operational and infrastructural complexity should be added deliberately, when real use cases require it.

## What Atlas Should Reuse From This Style

- Clear layer split: `Presentation`, `Application`, `Domain`, `Infrastructure`
- Thin HTTP actions/controllers
- Explicit application endpoints for use cases
- One transport entry point should delegate into one application endpoint/use case
- Transport-specific DTOs only where useful
- Explicit console commands for operational workflows
- Separate tests for HTTP contracts and application logic
- Explicit internal API handling instead of mixing internal and public concerns

## What Atlas Should Delay Until Needed

- Large package surface
- Database, migrations, and fixtures before the first agreed model
- Search infrastructure
- Worker, scheduler, or messaging infrastructure before real background jobs exist
- Container orchestration as a requirement for day-one local development
- Detailed enterprise conventions that have no current feature pressure behind them

## Backend Application Shape

Target structure for `apps/api`:

```text
src/
  Presentation/
    Http/
      Action/
      DTO/
      Listener/
      Service/
    Console/
      Command/
  Application/
    Endpoint/
    Feature/
    Port/
    Query/
  Domain/
  Infrastructure/
tests/
  Action/
  Application/
  Unit/
```

Layer responsibilities:

- `Presentation/Http/Action`
  - Symfony HTTP entry points
  - attribute routes
  - request extraction, auth checks, response mapping
  - no business orchestration beyond adapting transport to application calls
- `Presentation/Console/Command`
  - CLI entry points
  - scheduling or operational commands when needed
- `Presentation`
  - every transport entry point should delegate to an application endpoint or feature endpoint
  - transport code should not become the place where workflow logic accumulates
- `Application/Endpoint`
  - one use case per endpoint class
  - input/output objects when needed
  - orchestration across domain objects and ports
- `Application/Feature`
  - cohesive technical or cross-cutting capabilities such as health checks, imports, or indexing if they appear
- `Application/Port`
  - abstractions owned by the application layer
- `Application/Query`
  - read-oriented queries when read models become useful
- `Domain`
  - entities, value objects, IDs, policies, and business rules when the model becomes concrete
- `Infrastructure`
  - persistence, framework adapters, third-party clients, serializers, storage, mail, and similar integrations

## HTTP Conventions

Atlas should move toward this HTTP style:

- controllers live under `Presentation/Http/Action`
- routes are defined with Symfony attributes on action classes
- actions depend on application endpoints instead of embedding workflow logic
- request authentication/authorization is handled at the presentation boundary
- response bodies should be shaped deliberately, not leaked directly from internal persistence models

Expected flow:

- HTTP Action/Controller -> Application Endpoint -> Domain/Infrastructure
- Console Command -> Application Endpoint or Feature Endpoint -> Domain/Infrastructure

This is the key style decision. Controllers and commands are transport adapters. The application endpoint is the unit that owns the use case.

The current skeleton still contains a simple `Controller/` directory and YAML route definition. That is acceptable at bootstrap stage, but the first real feature should establish the target `Presentation/Http/Action` pattern instead of extending the temporary bootstrap layout.

## Internal vs Public API Separation

Internal and public API surfaces must be treated as different products, even if they initially live in the same Symfony app.

Internal admin API:

- optimized for operational workflows
- may expose richer admin-oriented actions
- should use an explicit namespace such as `/internal/...`
- should remain private and protected

Future public API:

- narrower and more stable
- versioned deliberately, for example `/v1/...`
- documented and secured independently
- must not be created by exposing internal admin endpoints as-is

Recommended guardrails:

- separate action namespaces
- separate request/response models where useful
- separate security paths and policies
- separate tests for internal and public surfaces

## Service Registration Direction

Atlas can start with Symfony defaults while the app is tiny, but should move toward more explicit namespace-based registrations as soon as multiple modules or transports appear.

That means:

- avoid one opaque catch-all service graph once the codebase grows
- keep presentation, application, and infrastructure registration readable
- make backend entry points easy to discover from config

## Testing Direction

Atlas should keep a clear separation of test intent while keeping the test stack minimal:

- `tests/Action` for HTTP contract tests
- `tests/Application` for use-case tests
- `tests/Unit` for isolated low-level logic when it exists

The first test to add should cover an internal HTTP action and the corresponding application endpoint boundary.

## Monorepo Implication

`apps/admin` and `apps/api` should evolve independently but stay coordinated at the repository level:

- shared product language belongs in `docs/`
- setup instructions belong in the root `README.md`
- root automation should orchestrate app-level commands
- internal admin frontend should consume the internal API contract exposed by `apps/api`
