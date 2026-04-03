<template>
  <main class="app-shell">
    <section class="panel">
      <p class="eyebrow">Atlas MVP</p>
      <h1>Internal Admin</h1>
      <p class="copy">
        Minimal Nuxt shell for the internal admin and data management application.
      </p>
    </section>
  </main>
</template>

<style>
:root {
  color-scheme: light;
  font-family: "Segoe UI", sans-serif;
  background: #f4f1ea;
  color: #1f2933;
}

body {
  margin: 0;
}

.app-shell {
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: 2rem;
  background:
    radial-gradient(circle at top, rgba(196, 167, 125, 0.25), transparent 35%),
    linear-gradient(180deg, #f6f2ea 0%, #ece6db 100%);
}

.panel {
  max-width: 42rem;
  padding: 2rem;
  border: 1px solid rgba(31, 41, 51, 0.12);
  background: rgba(255, 255, 255, 0.82);
  box-shadow: 0 18px 50px rgba(31, 41, 51, 0.08);
}

.eyebrow {
  margin: 0 0 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.16em;
  font-size: 0.75rem;
  color: #7c5b2a;
}

h1 {
  margin: 0;
  font-size: clamp(2rem, 5vw, 3.5rem);
}

.copy {
  margin: 1rem 0 0;
  line-height: 1.6;
}
</style>
