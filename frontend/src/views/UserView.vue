<template>
  <div>
    <!-- START OF COVER -->
    <div class="container-fluid" id="green">
      <div class="container d-flex vertical-align-middle py-4">
        <img src="https://github.com/mdo.png" class="img-thumbnail avatar-lg">

        <div class="p-4 my-4">
          <h1> {{ user.name }} </h1>
          <p class="lead"> Sistem Informasi </p>
        </div>
      </div>
    </div>
    <!-- END OF COVER -->

    <!-- START OF DETAILS -->
    <div class="container mt-4">
      <div class="row">
        <div class="col-6">
          <div class="row mb-2">
            <div class="col">
              <h3> Nama </h3>
              <p class="lead"> {{ user.name }} </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <h3> Unit Kerja </h3>
              <p class="lead"> Sistem Informasi </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <h3> No. Telp </h3>
              <p class="lead"> <i>-</i> </p>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="row mb-2">
            <div class="col">
              <h3> NIP / NIPP </h3>
              <p class="lead"> {{ user.id }} </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <h3> Jabatan </h3>
              <p class="lead"> {{ userdata.nama_jabatan }} </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <h3> Divisi </h3>
              <p class="lead"> {{ userdata.nama_divisi }} </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF DETAILS -->
  </div>
</template>

<script>
import store from '../store'
import axios from 'axios';

export default {
  name: 'UserView',
  data() {
    return {
      user: store.state.auth.user,
      userdata: null
    }
  },
  created() {
    axios.get('/profile/userdata', this.auth).then((resp) => {
      this.userdata = resp.data.data
    })
  }
}
</script>

<style scoped>
  #green {
    color: #fff;
    background-color: #528B8D;
  }

  .avatar-lg {
    width: 15%;
    height: 15%;
    border-radius: 100%;
  }

  .underline {
    border-bottom: 1px solid #222;
    padding-bottom: 3px;
  }
</style>