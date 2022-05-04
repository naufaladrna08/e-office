<template>
  <div>
    <div v-if="user">
      <div class="sidebar d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link py-3 border-bottom" :class="currentRoute === 'Dashboard' ? 'active' : ''" title="Dashboard">
              <i class="fa fa-home" style="width: 24px; height: 24px"></i>
            </router-link>
          </li>
          <li>
            <router-link to="/user" class="nav-link py-3 border-bottom" :class="currentRoute === 'User' ? 'active' : ''" title="User">
              <i class="fa fa-user" style="width: 24px; height: 24px"></i>
            </router-link>
          </li>
          <li>
            <router-link to="/mail/new" class="nav-link py-3 border-bottom" :class="currentRoute === 'Create Mail' ? 'active' : ''" title="Create Mail">
              <i class="fa fa-inbox" style="width: 24px; height: 24px"></i>
            </router-link>
          </li>
          <li>
            <router-link to="/archive" class="nav-link py-3 border-bottom" :class="currentRoute === 'Archive' ? 'active' : ''" title="Archive">
              <i class="fa fa-archive" style="width: 24px; height: 24px"></i>
            </router-link>
          </li>
          <li>
            <router-link to="/logout" class="nav-link py-3 border-bottom" title="Logout">
              <i class="fa fa-sign-out" style="width: 24px; height: 24px" @click="logout"></i>
            </router-link>
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

      <nav class="navbar navbar-light bg-light">
        <div class="container px-2">
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <div class="container">
        <BreadcrumbGlobal :crumbs="crumbs" @selected="selected" />
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
import store from './store'
import { mapActions } from 'vuex'
import BreadcrumbGlobal from './components/BreadcrumbGlobal.vue'

export default {
  name: 'App',
  components: {
    BreadcrumbGlobal
  },
  data() {
    return {
      user: store.state.auth.authenticated,
      currentRoute: 'dashboard',
      crumbs: []
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
  },
  watch:{
    $route() {
      this.user = store.state.auth.authenticated
      this.currentRoute = this.$route.name
      this.crumbs[0] = this.$route.name
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
