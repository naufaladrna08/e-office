import { createWebHistory, createRouter } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import DashboardView from '../views/DashboardView.vue'
import store from '../store'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView,
    meta: {
      middleware: "guest",
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginView,
    meta: {
      middleware: "guest",
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterView,
    meta: {
      middleware: "guest",
    }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardView,
    meta: {
      middleware: "auth",
    }
  }
]

const history = createWebHistory()
const router = createRouter({
  history,
  routes
})

router.beforeEach(async (to, from, next) => {
  document.title = `E-Office - ${to.name}`
  console.log(store.state.auth.authenticated)
  
  if (to.meta.middleware == "guest"){
    if (store.state.auth.authenticated) {
      next('/dashboard')
    }

    next()
  } else {
    if (store.state.auth.authenticated) {
      next()
    } else {
      next('/login')
    }
  }
})


export default router