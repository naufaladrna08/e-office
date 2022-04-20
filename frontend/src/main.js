import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import 'font-awesome/css/font-awesome.min.css'
import '@/assets/style.scss'
import CKEditor from '@ckeditor/ckeditor5-vue';

require('@/store/subscriber')

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'
axios.defaults.withCredentials = true

store.dispatch('auth/me', localStorage.getItem('token')).then(() => {
  const app = createApp(App)

  app.use(router)
  app.use(store)
  app.use(CKEditor)
  app.mount('#app')
})