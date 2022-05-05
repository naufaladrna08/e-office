<template>
  <div>
    <div class="container">
      <h1> Edit Application Parameter </h1>

      <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="divisi-tab" data-bs-toggle="tab" data-bs-target="#divisi" type="button" role="tab" aria-controls="divisi" aria-selected="true"> Manage Divisi </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button" role="tab" aria-controls="jabatan" aria-selected="false"> Manage Jabatan </button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="divisi" role="tabpanel" aria-labelledby="divisi-tab">
          <div class="btn btn-primary mr-2 my-4" data-bs-toggle="modal" data-bs-target="#createDivisi"> Create </div>
          <div class="btn btn-primary mr-2 my-4"> Upload </div>
          <div class="btn btn-primary mr-2 my-4"> Download Template </div>

          <!-- Datatables -->
          <DataTables 
            tclass="table table-hover table-bordered w-100 p-2" 
            url="divisi/read"
            :columns="divisiFields"
            useNumber="true"
            ref="divisi"
          />
        </div>
        <div class="tab-pane fade" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab">
          <div class="btn btn-primary mr-2 my-4" data-bs-toggle="modal" data-bs-target="#createJabatan"> Create </div>
          <div class="btn btn-primary mr-2 my-4"> Upload </div>
          <div class="btn btn-primary mr-2 my-4"> Download Template </div>

          <!-- Datatables -->
          <DataTables 
            tclass="table table-hover table-bordered w-100 p-2" 
            url="jabatan/read"
            :columns="jabatanFields"
            useNumber="true"
            ref="jabatan"
          />
        </div>
      </div>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="createDivisi" tabindex="-1" aria-labelledby="createDivisiLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createDivisiLabel"> Create Divisi </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="form-group">
                <label for="code"> Kode Divisi </label>
                <input type="text" class="form-control my-2" maxlength="8" id="code" name="code" v-model="divisiData.code_divisi">
              </div>
              <div class="form-group">
                <label for="name"> Nama Divisi </label>
                <input type="text" class="form-control my-2" id="name" name="name" v-model="divisiData.nama_divisi">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" @click="createDivisi"> Create Divisi </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createJabatan" tabindex="-1" aria-labelledby="createJabatanLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createJabatanLabel"> Create Jabatan </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="form-group">
                <label for="code"> Kode Jabatan </label>
                <input type="text" class="form-control my-2" maxlength="8" id="code" name="code" v-model="jabatanData.code_jabatan">
              </div>
              <div class="form-group">
                <label for="name"> Nama Jabatan </label>
                <input type="text" class="form-control my-2" id="name" name="name" v-model="jabatanData.nama_jabatan">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" @click="createJabatan"> Create Jabatan </button>
          </div>
        </div>
      </div>
    </div>
    <!-- END OF MODALS -->
  </div>
</template>

<script>
import DataTables from '../components/DataTables.vue'
import axios from 'axios'
import 'bootstrap/dist/js/bootstrap.js'

export default {
  name: 'ParameterView',
  components: {
    DataTables
  },
  data() {
    return {
      divisiFields: ['code_divisi', 'nama_divisi'],
      jabatanFields: ['code_jabatan', 'nama_jabatan'],
      divisiData: {
        code_divisi: null,
        nama_divisi: null,
      },
      jabatanData: {
        code_jabatan: null,
        nama_jabatan: null,
      }
    }
  },
  methods: {
    async createDivisi() {
      let modal = document.getElementById("createDivisi")

      await axios.post('/divisi/create', this.divisiData).then(() => {
        this.$refs.divisi.fetchData()
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      /* Close modal. I dont think this is the right way. */
      modal.classList.remove('show')
      modal.style.display = 'none'
      const el = document.getElementsByClassName('modal-backdrop')
      while (el.length > 0) el[0].remove();
    },
    async createJabatan() {
      let modal = document.getElementById("createJabatan")

      await axios.post('/jabatan/create', this.jabatanData).then(() => {
        this.$refs.jabatan.fetchData()
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      /* Close modal. I dont think this is the right way. */
      modal.classList.remove('show')
      modal.style.display = 'none'
      const el = document.getElementsByClassName('modal-backdrop')
      while (el.length > 0) el[0].remove();
    }
  }
}
</script>

<style scoped>
  .mr-2 { margin-right: .4em; }
</style>