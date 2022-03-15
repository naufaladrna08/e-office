import store from '@/store'
import axios from 'axios'

store.subscribe((mutation) => {
  if (mutation.type == 'auth/SET_TOKEN') {
    if (mutation.payload) {
      axios.defaults.headers = {
        'Authorization': `Bearer ${mutation.payload}`
      }
    } else {
      axios.defaults.headers = {
        'Authorization': null
      }
    }
  } 
})