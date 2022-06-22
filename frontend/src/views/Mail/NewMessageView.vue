<template>
  <div>
    <div class="container">
      <form @submit.prevent="send">
        <div class="row">
          <div class="col-md-6">
            <p class="lead"> * Kepala Surat </p>

            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Jenis / No / Tanggal </label>
              
              <div class="row mt-2">
                <div class="col">
                  <SelectComponent 
                    v-model="formData.jenisSurat" 
                    :options="jenisSuratOptions"
                  />
                </div>
                <div class="col">
                  <input type="text" placeholder="Auto" class="form-control" disabled>
                </div>
                <div class="col">
                  <input type="text" placeholder="Auto" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Perihal </label>
              <input type="text" class="form-control" name="perihal" id="perihal">
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Klasifikasi Masalah </label>
              <SelectComponent 
                v-model="formData.klasifikasiMasalah" 
                :options="klasifikasiMasalahOptions"
              />
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Lampiran </label>
              
              <div class="row mt-2">
                <div class="col">
                  <input type="text" placeholder="" class="form-control" id="lampiran" name="lampiran">
                </div>
                <div class="col">
                  <SelectComponent 
                    v-model="formData.prioritas" 
                    :options="prioritasOptions"
                  />
                </div>
                <div class="col">
                  <SelectComponent 
                    v-model="formData.klasifikasi" 
                    :options="klasifikasiOptions"
                  />
                </div>
              </div>
            </div>

            <p class="lead mt-4"> * Pengirim </p>

            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Jabatan </label>
              <input type="text" :value="userdata.nama_jabatan" class="form-control" disabled>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> NIPP / Nama </label>

              <div class="row mt-2">
                <div class="col">
                  <input type="text" :value="userdata.uid" class="form-control" disabled>
                </div>
                <div class="col">
                  <input type="text" :value="userdata.name" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Divisi </label>
              <input type="text" :value="userdata.nama_divisi" class="form-control" disabled>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Cab / Dir </label>
              <input type="text" value="Autocomplete" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <p class="lead"> * Penerima </p>

            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Kepada (Jabatan) </label>
              
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="btn btn-primary"> + </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Tembusan (Jabatan) </label>
              
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="btn btn-primary"> + </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Kepada (Pekerja) </label>
              
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="btn btn-primary"> + </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Tembusan (Pekerja) </label>
              
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="btn btn-primary"> + </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12">
            <div class="form-group my-2">
              <button class="btn btn-primary ml-2" @click="getTemplate(1)"> Template 1 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(2)"> Template 2 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(3)"> Template 3 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(4)"> Template 4 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(5)"> Template 5 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(6)"> Template 6 </button>
              <button class="btn btn-primary mx-2" @click="getTemplate(7)"> Template 7 </button>
            </div>
            <div class="form-group my-2">
              <ckeditor 
                :editor="editor" 
                v-model="editorData" 
                class="form-control"
                @ready="onReady"
              />
            </div>
          </div>
        </div>

        <button class="btn btn-primary float-right mt-4"> Kirim </button>
      </form>
    </div>

    <div class="modal fade" ref="confirmTemplate">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createParameterLabel"> Use this template </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="lead"> Are you sure to use this template? </p>

            <img v-bind:src="templateImageSource" class="img-thumbnail">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
            <button type="button" class="btn btn-primary" id="create-parameter-button" @click="applyTemplate"> Use </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Editor from '@ckeditor/ckeditor5-build-decoupled-document'
import axios from 'axios'
import SelectComponent from '../../components/SelectComponent.vue'
import {Modal} from 'bootstrap'

export default {
  name: 'NewMessageView',
  components: {
    SelectComponent
  },
  data() {
    return {
      editor: Editor,
      editorData: '',
      mailNumber: null,
      sendTo: null,
      subject: null,
      templateImageSource: null,
      userdata: {
        "uid": null,
        "id": null,
        "name": null,
        "email": null,
        "username": null,
        "code_divisi": null,
        "code_jabatan": null,
        "profile_photo_id": null,
        "cover_photo_id": null,
        "remember_token": null,
        "created_at": null,
        "updated_at": null,
        "nama_divisi": null,
        "nama_jabatan": null,
        "profile_path": null,
        "cover_path": null
      },
      formData: {
        jenisSurat: null,
        klasifikasiMasalah: null,
        prioritas: null,
        klasifikasi: null,
      },
      jenisSuratOptions: null,
      klasifikasiMasalahOptions: null,
      prioritasOptions: null,
      klasifikasiOptions: null,
      confirmTemplate: null,
      templateChoosed: null
    };
  },
  methods: {
    onReady(editor)  {
      editor.ui.getEditableElement().parentElement.insertBefore(
        editor.ui.view.toolbar.element,
        editor.ui.getEditableElement()
      );
    },
    send() {
      const data = {
        mail_number: this.mailNumber,
        send_to: this.sendTo,
        subject: this.subject,
        description: this.editorData,
        type: "TIPE"
      }

      axios.get('/csrf-cookie').then(() => {
        axios.post('/mail/create', data).then((resp) => {
          if (resp.data.code == 200) {
            this.$router.push('/dashboard')
          } else {
            this.message = "Internal Server Error"
          }
        }) 
      })
    },
    selectJenisSurat(value) {
      console.log(value)
    },
    getTemplate(number) {
      this.confirmTemplate.show()

      axios.get('/mail/template?id=' + number)
      .then((resp) => {
        this.templateImageSource = resp.data.image
        this.templateChoosed = number 
      })
    }, 
    applyTemplate() {
      axios.get('/mail/template?id=' + this.templateChoosed)
      .then((resp) => {
        this.editorData = resp.data.data
      })

      this.confirmTemplate.hide()
    }
  },
  created() {
    axios.get('/profile/userdata').then((resp) => {
      this.userdata = resp.data.data
    })

    /* Get jenis surat */
    axios.get('/jenis-surat/dropdown').then((resp) => {
      this.jenisSuratOptions = resp.data
    })

    /* Get jenis surat */
    axios.get('/klasifikasi-masalah/dropdown').then((resp) => {
      this.klasifikasiMasalahOptions = resp.data
    })

    /* Get prioritas */
    axios.get('/parameter/dropdown?type=prioritas').then((resp) => {
      this.prioritasOptions = resp.data
    })

    /* Get klasifikasi */
    axios.get('/parameter/dropdown?type=klasifikasi').then((resp) => {
      this.klasifikasiOptions = resp.data
    })
  },
  mounted() {
    this.confirmTemplate = new Modal(this.$refs.confirmTemplate)
  }
}
</script>

<style>
.float-right {
  float: right;
}

.ck-content { 
  height: 500px; 
  border: 1px solid #ABABAB;
}

.select2 {
  height: 38px;
}
</style>