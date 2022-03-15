
import router from 'vue-router'
import axios from '@/axios'

export default ({
  state: {
    authenticated: false, 
    user: {}
  },
  getters: {
    get_auth(state) {
      return state.authenticated
    },
    get_user(state) {
      return state.user
    }
  },
  mutations: {
    SET_AUTH(state, value) {
      state.authenticated = value
    },
    SET_USER(state, value) {
      state.user = value
    }
  },
  actions: {
    login({commit}){
      return axios.get('/api/user').then(({data})=>{
        commit('SET_USER', data)
        commit('SET_AUTHENTICATED', true)
        router.push({name: 'dashboard'})
      }).catch(() => {
        commit('SET_USER', {})
        commit('SET_AUTHENTICATED', false)
      })
    },
    logout({commit}){
      commit('SET_USER', {})
      commit('SET_AUTHENTICATED', false)
    }
  },
  modules: {
  }
})
