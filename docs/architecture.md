# Architecture Notes

## Top-level structure

- `apps/api`: Symfony backend
- `apps/admin`: Nuxt internal admin UI
- `docs`: product and architecture notes

## Architectural direction

The MVP is designed around an internal admin/data system first. Public access is a later concern and must be intentionally exposed through a separate API surface.

## Backend principles

- Start with the minimum Symfony skeleton only
- Add packages only when a clear need exists
- Keep controllers thin
- Put use-case logic in application-level handlers/endpoints
- Avoid coupling internal admin contracts to future public contracts

## Internal vs public API separation

Even if both surfaces live in the same Symfony application initially, they should be treated as different products:

- Internal admin API
  - ACL-protected
  - Optimized for operational workflows
  - Can expose richer admin-oriented actions
  - Route namespace should be explicit, for example `/internal/...`

- Future public API
  - Token-based access
  - Narrow, stable, documented contracts
  - Only selected capabilities should be published
  - Route namespace should be explicit, for example `/public/...` or `/v1/...`

Recommended guardrails:

- Separate route groups
- Separate request/response DTOs where useful
- Separate security configuration paths
- Separate tests for internal and public surfaces
- No direct reuse of internal admin endpoints as public endpoints

## Application layering

A simple starting shape for backend code:

- `Controller/`
  - HTTP transport only
- `Application/`
  - handlers, commands, queries, DTOs
- `Domain/`
  - business concepts when they emerge
- `Infrastructure/`
  - framework and persistence integrations

At this stage, only create additional layers when real use cases require them.
