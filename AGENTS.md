# AGENTS.md

## Repository purpose

This repository contains the MVP skeleton for Atlas:

- `apps/api`: Symfony backend for internal admin/data operations
- `apps/admin`: Nuxt internal admin frontend
- `docs`: product and architecture notes

## Working principles

- Keep the architecture simple and explicit
- Use the minimum Symfony skeleton and only add packages when required
- Do not assume future features before they are needed
- Prefer incremental changes over speculative abstractions

## Backend guidance

- Controllers must stay thin
- Put application logic in application-level handlers/endpoints
- Keep internal admin API concerns separate from the future public API surface
- Treat internal and public endpoints as separate contracts
- Do not expose internal admin endpoints publicly

## Frontend guidance

- `apps/admin` is an internal admin app only
- Prefer clear operational UI flows over brand-heavy presentation
- Do not introduce public-site assumptions into the admin app

## Current non-goals

- No public frontend app
- No business entities yet
- No database schema yet
- No authentication implementation yet
- No dynamic attributes yet

## When adding new work

- Document meaningful architectural decisions in `docs/architecture.md`
- Document product-scope decisions in `docs/mvp.md`
- Add dependencies only with a clear reason
- Keep start/setup instructions in `README.md` current
