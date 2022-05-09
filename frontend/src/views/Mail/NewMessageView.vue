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
                  <select class="form-control" id="type" name="type">
                    <option selected="true" disabled="true"> Nota Dinas </option>
                  </select>
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
              <select class="form-control" name="klasifikasi_masalah" id="klasifikasi_masalah">
                <option selected="true" disabled="true"> KL848-AMDAL / Limbah Kapal </option>
                
              </select>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Lampiran </label>
              
              <div class="row mt-2">
                <div class="col">
                  <input type="text" placeholder="" class="form-control" id="lampiran" name="lampiran">
                </div>
                <div class="col">
                  <select class="form-control" id="prioritas" name="prioritas">
                    <option selected="true" disabled="true"> Prioritas </option>
                  </select>
                </div>
                <div class="col">
                  <select class="form-control" id="klasifikasi" name="klasifikasi">
                    <option selected="true" disabled="true"> Klasifikasi </option>
                
                  </select>
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
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Tembusan (Non Pekerja) </label>
              
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="btn btn-primary"> + </div>
              </div>
            </div>

            <p class="lead"> * Pemeriksa </p>

            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Pemeriksa </label>
              
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
  </div>
</template>

<script>
import Editor from '@ckeditor/ckeditor5-build-decoupled-document'
import axios from 'axios'

export default {
  name: 'NewMessageView',
  data() {
    return {
      editor: Editor,
      editorData: this.content,
      mailNumber: null,
      sendTo: null,
      subject: null,
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
      }
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
    }
  },
  created() {
    axios.get('/profile/userdata').then((resp) => {
      this.userdata = resp.data.data
    })
  }
}
</script>

<style scoped>
.float-right {
  float: right;
}

.ck-content { 
  height: 500px; 
  border: 1px solid #ABABAB;
}
</style>