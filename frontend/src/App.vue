<template>
  <div>
    <div v-if="user != null">
      <div class="sidebar d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <a href="#" class="nav-link active py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-home" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-user" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <router-link to="/inbox" class="nav-link py-3 border-bottom" title="Inbox" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-inbox" style="width: 24px; height: 24px"></i>
            </router-link>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-archive" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-sign-out" style="width: 24px; height: 24px" @click="logout"></i>
            </a>
          </li>
        </ul>
        <div class="dropdown border-top">
          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="javascript:void(0);" @click="logout">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
import store from './store'
import { mapActions } from 'vuex'

export default {
  name: 'App',
  components: {
  },
  data() {
    return {
      user: store.state.auth.user,
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
}
</script>

<style>
#app {
  font-family: 'Open Sans', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #222222;
}

.sidebar {
  background-color: rgba(115, 24, 152, 1);
  position: fixed;
  height: 100vh !important;
  z-index: 9999 !important;
}

</style>
