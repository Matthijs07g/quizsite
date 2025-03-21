<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <header>
    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <RouterLink to="/player">Player</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped>
header {
  line-height: 1.5;
  padding: 1rem 0;
}

.logo {
  width: 80px;
  height: 80px;
  margin-bottom: 1rem;
}

.wrapper {
  margin-bottom: 2rem;
}

nav {
  width: 100%;
  font-size: 1rem;
  margin: 1rem 0;
}

nav a {
  display: inline-block;
  padding: 0.5rem 1rem;
  margin: 0 0.5rem;
  color: var(--slimste-mens-white);
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s;
  border: none;
}

nav a:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

nav a.router-link-exact-active {
  color: var(--slimste-mens-gold);
  font-weight: bold;
}

@media (min-width: 1024px) {
  header {
    padding: 1rem 2rem;
  }

  .wrapper {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .logo {
    margin: 0;
  }

  nav {
    margin: 0;
  }
}
</style>