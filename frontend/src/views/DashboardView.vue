<template>
  <div class="root">
    <div class="main">
      <div class="sidebar d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="Icon-only" data-bs-toggle="tooltip" data-bs-placement="right">
          <svg class="bi" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
          <span class="visually-hidden">Icon-only</span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <a href="#" class="nav-link active py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-home" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-user" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-inbox" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-archive" style="width: 24px; height: 24px"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
              <i class="fa fa-sign-out" style="width: 24px; height: 24px" @click="logout"></i>
            </a>
          </li>
        </ul>
        <div class="dropdown border-top">
          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="javascript:void(0);" @click="logout">Sign out</a></li>
          </ul>
        </div>
      </div>

      <div class="dashboard">
        <nav class="navbar navbar-light bg-light fixed-top">
          <div class="container px-2">
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </nav>

        <div class="container px-4 py-5 my-4">
          <h1> Overview </h1>          
          <div class="media" id="overview">
            <nav class="bg-green radius-16 px-2 py-3">
              <a href="">
                <b class="btn text-white lead mx-2"><i class="fa fa-filter"></i></b>
              </a>

              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-white"> Kirim </button>
                <button type="button" class="btn btn-outline-white"> Kembalikan </button>
                <button type="button" class="btn btn-outline-white"> Disposisi </button>
              </div>
            </nav>
            <div class="media-body">
              <ul class="list-group list-group-striped">
                <li class="d-flex flex-row p-2">
                  <img src="https://github.com/mdo.png" class="my-4 mx-2 img-circle" alt="User" width="48" height="48">

                  <div class="list-body flex-grow-1 px-2">
                    <h5> Tomi Pandu </h5>
                    <p class="lead">
                      Surat Permohonan Cuti <br>
                      <small>UM.338/3/18/PI.II-13</small>
                    </p>
                  </div>

                  <p class="lead align-self-center" id="time">
                    1 Okt 2021
                  </p>
                </li>
                <li class="d-flex flex-row p-2">
                  <img src="https://github.com/mdo.png" class="my-4 mx-2 img-circle" alt="User" width="48" height="48">

                  <div class="list-body flex-grow-1 px-2">
                    <h5> Tomi Pandu </h5>
                    <p class="lead">
                      Surat Permohonan Cuti <br>
                      <small>UM.338/3/18/PI.II-13</small>
                    </p>
                  </div>

                  <p class="lead align-self-center" id="time">
                    1 Okt 2021
                  </p>
                </li> 
                <li class="d-flex flex-row p-2">
                  <img src="https://github.com/mdo.png" class="my-4 mx-2 img-circle" alt="User" width="48" height="48">

                  <div class="list-body flex-grow-1 px-2">
                    <h5> Tomi Pandu </h5>
                    <p class="lead">
                      Surat Permohonan Cuti <br>
                      <small>UM.338/3/18/PI.II-13</small>
                    </p>
                  </div>

                  <p class="lead align-self-center" id="time">
                    1 Okt 2021
                  </p>
                </li>
                <li class="d-flex flex-row p-2">
                  <img src="https://github.com/mdo.png" class="my-4 mx-2 img-circle" alt="User" width="48" height="48">

                  <div class="list-body flex-grow-1 px-2">
                    <h5> Tomi Pandu </h5>
                    <p class="lead">
                      Surat Permohonan Cuti <br>
                      <small>UM.338/3/18/PI.II-13</small>
                    </p>
                  </div>

                  <p class="lead align-self-center" id="time">
                    1 Okt 2021
                  </p>
                </li> 
              </ul>
            </div>
          </div>

          <div class="media bg-lightblue mt-4" id="mail">
            <div class="media-body p-2">
<!--          
              <table class="table">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> No. Surat </th>
                    <th> Kepada </th>
                    <th> Perihal </th>
                    <th> Tanggal </th>
                    <th> Jenis Surat </th>
                    <th> Status </th>
                    <th> Keterangan </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> 1 </td>
                    <td> UM.338/3/18/PI.II-13 </td>
                    <td> SM PERENCANAAN STRATEGIS </td>
                    <td> PEMBENTUKAN TIM PENYUSUNAN RENCANA JANGA - </td>
                    <td> 20-1-21 </td>
                    <td> Surat Keputusan Direksi </td>
                    <td> KIRIM </td>
                    <td> - </td>
                  </tr>
                </tbody>
              </table> -->
              <DatatablesComponent 
                tclass="table table-hover p-2" 
                url="profile/list"
                :columns="arr" 
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store'
import DatatablesComponent from '../components/DatatablesComponent.vue'
import { mapActions } from 'vuex'

export default {
  name: 'DashboardView',
  data() {
    return {
      user: store.state.auth.user,
      arr: [
        'id',
        'name',
        'username',
        'email', 
        'created_at'
      ]
    }
  },
  components: {
    DatatablesComponent
  },
  methods: {
    ...mapActions({
      signOut: "auth/signOut"
    }),
    async logout() {
      this.signOut()
      this.$router.push('/login')
    }
  }
};
</script>

<style scoped>
.sidebar {
  background-color: rgba(115, 24, 152, 1);
  position: fixed;
  height: 100vh !important;
  z-index: 9999 !important;
}

.img-circle {
  border-radius: 100%;
}

.main {
  display: flex;
  flex-wrap: nowrap;
  height: -webkit-fill-available;
  max-height: 100vh;
  overflow-x: auto;
}

.dashboard {
  width: 100%;
}

.bg-green {
  background-color: #528A8C;
}

.bg-lightblue {
  background: #F4F7FC;
}

.btn-white {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

.btn-white:hover {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

.btn-outline-white {
  color: #fff;
  border: 2px solid white;
}

.btn-outline-white:hover {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

ul.list-group.list-group-striped li:nth-of-type(odd){
  background: white;
}
ul.list-group.list-group-striped li:nth-of-type(even){
  background: #ebebeb;
}
ul.list-group.list-group-hover li:hover{
  background: red;
}

.radius-16 {
  border-radius: 16px 16px 0 0;
}

.nvihre .btn {
  border-radius: 12px;
  margin-right: 4px;
}
</style>