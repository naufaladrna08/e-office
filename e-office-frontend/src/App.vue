<template>
  <main>
    <Navbar />

    <router-link to="/home"> Home </router-link>
  </main>
</template>

<script >
import { RouterLink, RouterView } from "vue-router";
import Navbar from "@/components/Navbar.vue";

export default {
  name: 'App',
  components: {
    Navbar
  }
}
</script>

<style>

</style>
