<script setup lang="ts">
const { data, error, status, refresh } = useInternalStatus()
</script>

<template>
  <p class="eyebrow">Atlas MVP</p>
  <h1>Internal Admin</h1>
  <p class="copy">
    Minimal admin flow that reads the backend internal status contract.
  </p>

  <div class="status-card">
    <p><strong>Fetch status:</strong> {{ status }}</p>
    <p v-if="data">
      <strong>API:</strong>
      {{ data.application }} ({{ data.scope }}) = {{ data.status }}
    </p>
    <p v-else-if="error">
      <strong>API error:</strong>
      {{ error.message }}
    </p>
    <button type="button" @click="refresh">Refresh status</button>
  </div>
</template>

<style scoped>
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
  margin: 1rem 0 1.5rem;
  line-height: 1.6;
}

.status-card {
  display: grid;
  gap: 0.75rem;
  padding: 1rem;
  border: 1px solid rgba(31, 41, 51, 0.15);
  border-radius: 0.5rem;
  background: rgba(255, 255, 255, 0.95);
}

button {
  justify-self: start;
  border: 0;
  border-radius: 0.35rem;
  padding: 0.55rem 0.85rem;
  font: inherit;
  background: #7c5b2a;
  color: #fff;
  cursor: pointer;
}
</style>
