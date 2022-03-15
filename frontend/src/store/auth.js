import axios from 'axios'
import router from '../router'

export default {
  namespaced: true,
  state:{
    authenticated: false,
    user: {},
    token: null
  },
  getters:{
    authenticated(state) {
      return state.authenticated
    },
    user(state) {
      return state.user
    },
    token(state) {
      return state.token
    }
  },
  mutations:{
    SET_AUTHENTICATED (state, value) {
      state.authenticated = value
    },
    SET_USER (state, value) {
      state.user = value
    },
    SET_TOKEN (state, token) {
      state.token = token
    }
  },
  
  actions: {
    async signIn({dispatch}, credentilals) {
      let response = await axios.post('/login', credentilals)

      return dispatch('me', response.data.access_token)
    },
    signOut({ commit }) {
      axios.post('/logout')
      
      commit('SET_AUTHENTICATED', false)
      commit('SET_USER', null)
      commit('SET_TOKEN', null)
    },
    me({commit}, token) {
      commit('SET_TOKEN', token)

      return axios.get('/user').then((response) => {
        commit('SET_AUTHENTICATED', true)
        commit('SET_USER', response.data)
      }).catch(() => {
        commit('SET_AUTHENTICATED', false)
        commit('SET_USER', null)
      })
    }
  }
}