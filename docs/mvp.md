# MVP Notes

## Goal

Build an internal admin and data management platform for operational teams managing:

- musicians
- venues
- matching-related data and workflows

## Product Shape

Atlas is an internal admin product first:

- internal users only
- CRUD and operational workflows come before public-facing capabilities
- the frontend is a private admin application built with Nuxt
- the backend is a Symfony server application living in the same monorepo

## Repository Direction

Atlas should stay a monorepo:

- `apps/api` contains the backend server application
- `apps/admin` contains the internal admin UI
- `docs` captures product and architectural decisions

The backend inside `apps/api` should start with a disciplined layered shape from day one, while adding operational complexity only when real requirements justify it.

## Delivery Intent

This repository should remain a clean, explicit base that is easy to evolve:

- monorepo ergonomics at the repository level
- disciplined backend layering inside `apps/api`
- operational complexity only when real workflows require it
- clear separation between internal admin contracts and future public contracts

## Explicit Non-Goals For This Phase

- no public-facing frontend
- no finalized domain model
- no database schema yet
- no authentication implementation yet
- no dynamic attribute system yet
- no attempt to reproduce a large operational backend footprint before it is justified

## First Meaningful Milestones

- establish the first real backend module using `Presentation / Application / Domain / Infrastructure` boundaries ✅ (status reference module)
- establish the first admin workflow in `apps/admin` ✅ (status contract read flow)
- add tests around the first internal API contract ✅ (action + application tests)
- introduce persistence and auth only once the first concrete workflow is agreed
