<template>
  <div class="root">
    <div class="main">
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
            <h5 class="py-2"> 
              <i class="fa fa-inbox"></i>
              Inbox 
            </h5>
            <div class="media-body border p-2">
              <DataTables 
                tclass="table table-hover table-bordered w-100 p-2" 
                url="mail/inbox"
                :columns="arr"
                useNumber="true"
                id="inbox-table"
              />
            </div>
          </div>

          <div class="media mt-4" id="mail">
            <h5 class="py-2"> 
              <i class="fa fa-paper-plane"></i>
              Sent 
            </h5>
            
            <div class="media-body bg-lightblue border p-2">
              <DataTables 
                tclass="table table-hover table-bordered w-100 p-2" 
                url="mail/read-all"
                :columns="arr"
                useNumber="true"
                id="overview-table"
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
import DataTables from '../components/DataTables.vue'

export default {
  name: 'DashboardView',
  data() {
    return {
      user: store.state.auth.user,
      arr: [
        'no_surat',
        'kepada',
        'perihal', 
        'tanggal',
        'jenis_surat',
        'status',
        'keterangan'
      ]
    }
  },
  components: {
    DataTables
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

#overview-table {
  overflow: auto;
  white-space: nowrap;
}
</style>