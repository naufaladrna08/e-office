<template>
  <section class="container my-4">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="my-4">
              <h3> Selamat Datang </h3>
              <p class="lead">
                E-OFFICE DPC SPPI II PTP
              </p>
            </div>
            <form action="javascript:void(0)" class="row" method="post">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" v-model="auth.username" name="username" id="username" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-solid fa-lock"></i></span>
                <input type="text" v-model="auth.password" name="password" id="password" class="form-control" aria-label="password" aria-describedby="basic-addon1" placeholder="***">
              </div>
              <div class="col-12 mt-4">
                <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                  {{ processing ? "Please wait" : "Login" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
  name: 'LoginView',
  data() {
    return {
      auth: {
        username: '',
        password: ''
      },
      processing: false
    }
  },
  methods: {
    ...mapActions({
      signIn: 'auth/login'
    }),
    async login() {
      this.processing = true

      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/login', this.auth).then(() => {
        this.signIn()
      }).catch(({response: {data}}) => {
        alert(data.message)
      }).finally(() => {
        this.processing = false
      })
    }
  }
}
</script>