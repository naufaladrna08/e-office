import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import 'font-awesome/css/font-awesome.min.css'
import '@/assets/style.scss'

require('@/store/subscriber')

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'
axios.defaults.withCredentials = true

if (store.state.auth.authenticated) {
  axios.defaults.headers = {
    'Authorization': `Bearer ${localStorage.token}`
  }
}

const app = createApp(App)

app.use(router)
app.use(store)
app.mount('#app')