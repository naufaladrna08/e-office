<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>Dashboard</h1>
    <a href="javascript:void(0)" @click="logout">Logout</a>

    <div class="card my-4">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store'
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
  name: 'DashboardView',
  data() {
    return {
      user: store.state.auth.user
    }
  },
  methods: {
    ...mapActions({
      signOut: "auth/signOut"
    }),
    async logout() {
      this.signOut()
      this.$router.push('/login')
    }
  }
};
</script>