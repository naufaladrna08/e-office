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
              <i class="fa fa-sign-out" style="width: 24px; height: 24px"></i>
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
            <li><a class="dropdown-item" href="#">Sign out</a></li>
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
                <button type="button" class="btn btn-primary"> Kirim </button>
                <button type="button" class="btn btn-outline-primary"> Kembalikan </button>
                <button type="button" class="btn btn-outline-primary"> Disposisi </button>
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

          <div class="media mt-4" id="mail">
            <nav class="radius-16 px-2 py-3">
              <div class="row">
                <div class="col-4">
                  
                  <form class="d-flex">
                    <a href="">
                      <b class="btn text-primary lead mx-2"><i class="fa fa-filter"></i></b>
                    </a>

                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
                
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
        </div>
      </div>
    </div>
  </div>
</template>

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

.btn-primary {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

.btn-primary:hover {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

.btn-outline-primary {
  color: #fff;
  border: 2px solid white;
}

.btn-outline-primary:hover {
  color: #222;
  background: #fff;
  border: 2px solid white;
}

ul.list-group.list-group-striped li:nth-of-type(odd){
  background: white;
  border-radius: 16px;
}
ul.list-group.list-group-striped li:nth-of-type(even){
  background: #ebebeb;
  border-radius: 16px;
}
ul.list-group.list-group-hover li:hover{
  background: red;
}

.radius-16 {
  border-radius: 16px 16px 0 0;
}
</style>

<script>
import store from '../store'
import { mapActions } from 'vuex'

export default {
  name: 'DashboardView',
  data() {
    return {
      user: store.state.auth.user
    }
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