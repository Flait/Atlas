<template>
  <main class="app-shell">
    <section class="panel">
      <slot />
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
  width: min(100%, 44rem);
  padding: 2rem;
  border: 1px solid rgba(31, 41, 51, 0.12);
  background: rgba(255, 255, 255, 0.82);
  box-shadow: 0 18px 50px rgba(31, 41, 51, 0.08);
}
</style>
