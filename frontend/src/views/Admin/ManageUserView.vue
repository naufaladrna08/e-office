<template>
  <div class="container">
    <h1> Manage User </h1>

    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="divisi" aria-selected="true"> User List </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="role-tab" data-bs-toggle="tab" data-bs-target="#role" type="button" role="tab" aria-controls="role" aria-selected="false"> Assign Role </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="divisi-tab" data-bs-toggle="tab" data-bs-target="#divisi" type="button" role="tab" aria-controls="divisi" aria-selected="false"> Assign Divisi </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="jabatan-tab" data-bs-toggle="tab" data-bs-target="#jabatan" type="button" role="tab" aria-controls="jabatan" aria-selected="false"> Assign Jabatan </button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
        <div class="my-4">
          <button 
            class="btn btn-primary" 
            data-bs-toggle="modal" 
            data-bs-target="#createUser" 
            @click.prevent="changeLabels('create', 'users')"
          > 
            Create 
          </button> 
          <button class="btn btn-primary mx-2" disabled> Upload </button> 
        </div>
      
        <DataTables
          url="profile/list"
          tclass="table table-bordered w-100 p-2" 
          :columns="listUsers"
          useNumber="1"
          useAction="1"
          ref="users"
          @actionClicked="editUser"
          @deleteClicked="deleteUser"
        />
      </div>
      <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">
        <div class="text-center my-4 lead"> Coming Soon </div>
      </div>
      <div class="tab-pane fade" id="divisi" role="tabpanel" aria-labelledby="divisi-tab">
        <br>
        
        <DataTables
          url="profile/user_divisi"
          tclass="table table-bordered w-100 p-2" 
          :columns="divisiColumn"
          useNumber="1"
          useAssigner="1"
          ref="divisi"
          @actionClicked="editDivisi"
        />
      </div>
      <div class="tab-pane fade" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab">
        4
      </div>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="createUser" ref="userModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createUserLabel"> Create User </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="form-group">
                <label for="code"> NIPP </label>
                <input type="text" class="form-control my-2" id="nipp" name="nipp" v-model="userdata.nipp">
              </div>
              <div class="form-group">
                <label for="name"> Username </label>
                <input type="text" class="form-control my-2" id="username" name="username" v-model="userdata.username">
              </div>
              <div class="form-group">
                <label for="name"> Name </label>
                <input type="text" class="form-control my-2" id="name" name="name" v-model="userdata.name">
              </div>
              <div class="form-group">
                <label for="name"> E-Mail </label>
                <input type="email" class="form-control my-2" id="email" name="email" v-model="userdata.email">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" id="create-user-button" @click="action == 'create' ? ioUser('create') : ioUser('update')"> Create </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="changeDivisi" ref="divisiModal" tabindex="-1" aria-labelledby="changeDivisiLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changeDivisiLabel"> Update divisi </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form">
              <div class="form-group">
                <label for="code"> NIPP </label>
                <input type="text" class="form-control my-2" id="nipp" name="nipp" v-model="userdataDivisi.nipp" disabled>
              </div>
              <div class="form-group">
                <label for="code"> Username </label>
                <input type="text" class="form-control my-2" id="username" name="username" v-model="userdataDivisi.username" disabled>
              </div>
              <div class="form-group">
                <label for="code"> Divisi </label>

                <select class="form-control my-2" id="divisi" name="divisi" v-model="userdataDivisi.nama_divisi">
                  <option disabled="true" selected> {{ userdataDivisi.nama_divisi }} </option>
                  <option v-for="data in dropdownDivisi" :value="data.code_divisi" :key="data.code_divisi">{{data.nama_divisi}}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" id="assign-divisi-button" @click="ioDivisi()"> Assign </button>
          </div>
        </div>
      </div>
    </div>
  </div>  
</template>

<script>
import DataTables from '../../components/DataTables.vue'
import { Modal } from 'bootstrap'
import 'bootstrap/dist/js/bootstrap.js'
import axios from 'axios'

export default {
  name: 'ManageUserView',
  components: {
    DataTables
  },
  data() {
    return {
      listUsers: {
        id: 'NIPP',
        username: 'Username',
        name: 'Name',
        email: 'E-Mail',
        created_at: 'Created'
      },
      divisiColumn: {
        nipp: 'NIPP',
        username: 'Username',
        nama_divisi: 'Nama Divisi'
      },
      userdata: {
        nipp: '',
        username: '',
        name: '',
        email: '',
      },
      userdataDivisi: {
        nipp: '',
        username: '',
        nama_divisi: '',
        code_divisi: ''
      },
      ioUserModal: null,
      action: 'create',
      tmpCode: null,
      dropdownDivisi: []
    }
  },
  mounted() {
    this.ioUserModal = new Modal(this.$refs.userModal)
    this.ioDivisiModal = new Modal(this.$refs.divisiModal)
  },
  methods: {
    async ioUser(type) {
      let url = '/profile/' + type

      if (type == 'update') {
        this.userdata.old_nipp = this.tmpCode
        delete this.userdata.password
      } else if (type == 'create') {
        this.userdata.password = '12345678'
        delete this.userdata.old_nipp
      } else {
        console.error('Type not found')
      }

      await axios.post(url, this.userdata).then(() => {
        this.$refs.users.fetchData()

        this.$swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Data has been saved!'
        })
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      this.ioUserModal.hide()
    },
    async ioDivisi() {
      console.log(this.userdataDivisi)
      await axios.post('/divisi/user', this.userdataDivisi).then(() => {
        this.$refs.divisi.fetchData()

        this.$swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Data has been saved!'
        })
      }).catch(({response: {data}}) => {
        alert(data.message)
      })

      this.$refs.divisi.fetchData()
      this.ioDivisiModal.hide()
    },
    changeLabels(type, to) {
      if (type == 'create') {
        this.action = 'create'

        if (to == 'users') {
          document.getElementById('createUserLabel').innerHTML = 'Create User'
          document.getElementById('create-user-button').innerHTML = 'Create'

          for (let member in this.userdata) delete this.userdata[member]
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
        
        if (to == 'users') {
          document.getElementById('createUserLabel').innerHTML = 'Update User'
          document.getElementById('create-user-button').innerHTML = 'Update'
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
    editUser(data) {
      this.ioUserModal.show()
      this.changeLabels('update', 'users')
      
      let id = data.id
      let username = data.username
      let name = data.name
      let email = data.email

      this.tmpCode = data.id
      this.userdata.id = id
      this.userdata.nipp = id
      this.userdata.username = username
      this.userdata.name = name
      this.userdata.email = email
    },
    deleteUser(data) {
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
          axios.post('/profile/delete', { old_nipp: data.id }).then((resp) => {
            if (resp.data.data == 'SELF_DELETE') {
              this.$swal.fire(
                'Oops!',
                'You can\'t delete yourself',
                'error'
              )
            } else {
              this.$swal.fire(
                'Deleted!',
                'Data has been deleted.',
                'success'
              )
            }

            this.$refs.users.fetchData()  
          }).catch(({response: {data}}) => {
            alert(data.message)
          })
        }
      })
    },
    editDivisi(data) {
      this.ioDivisiModal.show()

      this.userdataDivisi.nipp = data.nipp
      this.userdataDivisi.username = data.username
      this.userdataDivisi.nama_divisi = data.nama_divisi

      axios.get('divisi/dropdown?nama_divisi=' + data.nama_divisi).then((resp) => {
        this.dropdownDivisi = resp.data.data
      })
    }
  }
}
</script>

<style scoped>

</style>