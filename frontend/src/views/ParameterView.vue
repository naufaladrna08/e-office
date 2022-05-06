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
          <div 
            class="btn btn-primary mr-2 my-4" 
            data-bs-toggle="modal" 
            data-bs-target="#createDivisi" 
            @click="this.changeLabels('create', 'divisi')"
          > 
            Create 
          </div>
          <div class="btn btn-primary mr-2 my-4"> Upload </div>
          <div class="btn btn-primary mr-2 my-4"> Download Template </div>

          <!-- Datatables -->
          <DataTables 
            tclass="table table-hover table-bordered w-100 p-2" 
            url="divisi/read"
            :columns="divisiFields"
            useNumber="1"
            useAction="1"
            ref="divisi"
            @actionClicked="editDivisi"
            @deleteClicked="deleteDivisi"
          />
        </div>
        <div class="tab-pane fade" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab">
          <div class="btn btn-primary mr-2 my-4" data-bs-toggle="modal" data-bs-target="#createJabatan" @click="this.changeLabels('create', 'jabatan')"> Create </div>
          <div class="btn btn-primary mr-2 my-4"> Upload </div>
          <div class="btn btn-primary mr-2 my-4"> Download Template </div>

          <!-- Datatables -->
          <DataTables 
            tclass="table table-hover table-bordered w-100 p-2" 
            url="jabatan/read"
            :columns="jabatanFields"
            useNumber="1"
            useAction="1"
            ref="jabatan"
            @actionClicked="editJabatan"
            @deleteClicked="deleteJabatan"
          />
        </div>
      </div>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="createDivisi" ref="divisiModal" tabindex="-1" aria-labelledby="createDivisiLabel" aria-hidden="true">
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
                <input type="text" class="form-control my-2" maxlength="8" id="code" name="code" v-bind="divisiData.code_divisi" v-model="divisiData.code_divisi">
              </div>
              <div class="form-group">
                <label for="name"> Nama Divisi </label>
                <input type="text" class="form-control my-2" id="name" name="name" v-model="divisiData.nama_divisi">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" id="create-divisi-button" @click="action == 'create' ? ioDivisi('create') : ioDivisi('update')"> Create Divisi </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createJabatan" ref="jabatanModal" tabindex="-1" aria-labelledby="createJabatanLabel" aria-hidden="true">
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
                <input type="text" class="form-control my-2" maxlength="8" id="code_jabatan" name="code" v-model="jabatanData.code_jabatan">
              </div>
              <div class="form-group">
                <label for="name"> Nama Jabatan </label>
                <input type="text" class="form-control my-2" id="nama_jabatan" name="name" v-model="jabatanData.nama_jabatan">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" id="create-jabatan-button" @click="action == 'create' ? ioJabatan('create') : ioJabatan('update')"> Create Jabatan </button>
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
import { Modal } from 'bootstrap'
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
      },
      divisiModal: null,
      jabatanModal: null,
      action: null
    }
  },
  mounted() {
    this.divisiModal = new Modal(this.$refs.divisiModal)
    this.jabatanModal = new Modal(this.$refs.jabatanModal)
  },
  methods: {
    async ioDivisi(type) {
      let url = '/divisi/' + type

      if (type == 'update') {
        this.divisiData.old_code_divisi = this.tmpCode
      } else if (type == 'create') {
        delete this.divisiData.old_code_divisi
      } else {
        console.error('Type not found')
      }

      await axios.post(url, this.divisiData).then(() => {
        this.$refs.divisi.fetchData()
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      this.divisiModal.hide()
    },
    async ioJabatan(type) {
      let url = '/jabatan/' + type

      if (type == 'update') {
        this.jabatanData.old_code_jabatan = this.tmpCode
      } else if (type == 'create') {
        delete this.jabatanData.old_code_jabatan
      } else {
        console.error('Type not found')
      }

      await axios.post(url, this.jabatanData).then(() => {
        this.$refs.jabatan.fetchData()
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      this.jabatanModal.hide()
    },
    changeLabels(type, to) {
      if (type == 'create') {
        this.action = 'create'

        if (to == 'divisi') {
          document.getElementById('createDivisiLabel').innerHTML = 'Create Divisi'
          document.getElementById('create-divisi-button').innerHTML = 'Create'

          for (let member in this.divisiData) delete this.divisiData[member]
          document.getElementById('code').value = ''
          document.getElementById('name').value = ''
        } else if (to == 'jabatan') {
          document.getElementById('createJabatanLabel').innerHTML = 'Create Jabatan'
          document.getElementById('create-jabatan-button').innerHTML = 'Create'

          for (let member in this.jabatanData) delete this.jabatanData[member]
          document.getElementById('code_jabatan').value = ''
          document.getElementById('nama_Jabatan').value = ''
        } else {
          console.error('Target is not found')
        }
      } else if (type == 'update') {
        this.action = 'update'
        
        if (to == 'divisi') {
          document.getElementById('createDivisiLabel').innerHTML = 'Update Divisi'
          document.getElementById('create-divisi-button').innerHTML = 'Update'
        } else if (to == 'jabatan') {
          document.getElementById('createJabatanLabel').innerHTML = 'Update Jabatan'
          document.getElementById('create-jabatan-button').innerHTML = 'Update'
        } else {
          console.error('Target is not found')
        }
      } else {
        console.error('Type is not found')
      }
    },
    editDivisi(data) {
      this.divisiModal.show()
      this.changeLabels('update', 'divisi')
      
      let code = data.code_divisi
      let nama = data.nama_divisi

      this.tmpCode = data.code_divisi
      this.divisiData.code_divisi = code
      this.divisiData.nama_divisi = nama

      document.getElementById('code').value = code
      document.getElementById('name').value = nama
    },
    deleteDivisi(data) {
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const postData = {
            code_divisi: data.code_divisi
          }
          
          axios.post('/divisi/delete', postData).then(() => {
            this.$swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )

            this.$refs.divisi.fetchData()
          }).catch(({response: {data}}) => {
            alert(data.message)
          })
        }
      })
    },
    editJabatan(data) {
      this.jabatanModal.show()
      this.changeLabels('update', 'jabatan')
      
      let code = data.code_jabatan
      let nama = data.nama_jabatan

      this.tmpCode = data.code_jabatan
      this.jabatanData.code_jabatan = code
      this.jabatanData.nama_jabatan = nama

      document.getElementById('code_jabatan').value = code
      document.getElementById('nama_jabatan').value = nama
    },
    deleteJabatan(data) {
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const postData = {
            code_jabatan: data.code_jabatan
          }
          
          axios.post('/jabatan/delete', postData).then(() => {
            this.$swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )

            this.$refs.jabatan.fetchData()
          }).catch(({response: {data}}) => {
            alert(data.message)
          })
        }
      })
    }
  }
}
</script>

<style scoped>
  .mr-2 { margin-right: .4em; }
</style>