import store from '@/store'
import axios from 'axios'

store.subscribe((mutation) => {
  if (mutation.type == 'auth/SET_TOKEN') {
    if (mutation.payload) {
      axios.defaults.headers = {
        'Authorization': `Bearer ${mutation.payload}`
      }

      localStorage.setItem('token', mutation.payload)
    } else {
      axios.defaults.headers = {
        'Authorization': null
      }

      localStorage.setItem('token', null)
    }
  } 
})