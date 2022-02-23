<template>
  <div class="home col-5 mx-auto py-5 mt-5">
    <h1 class="text-center">Login</h1>
    <div class="card">
      <div class="card-body">
        <div class="form-group my-2">
          <label for="username">Username:</label>
          <input
            type="text"
            v-model="form.username"
            class="form-control"
            id="username"
          />
          <span class="text-danger" v-if="errors.username">
            {{ errors.username[0] }}
          </span>
        </div>
        <div class="form-group my-2">
          <label for="password">Password:</label>
          <input
            type="password"
            v-model="form.password"
            class="form-control"
            id="password"
          />
          <span class="text-danger" v-if="errors.password">
            {{ errors.password[0] }}
          </span>
        </div>
        <button @click.prevent="login" class="btn btn-primary btn-block">
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
import User from "../apis/User";
export default {
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      errors: []
    };
  },
  methods: {
    login() {
      User.login(this.form)
        .then(() => {
          this.$root.$emit("login", true);
          localStorage.setItem("auth", "true");
          this.$router.push({ name: "Dashboard" });
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>