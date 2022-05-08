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
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
                <div class="col">
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
                <div class="col">
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Perihal </label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Klasifikasi Masalah </label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Lampiran </label>
              
              <div class="row mt-2">
                <div class="col">
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
                <div class="col">
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
                <div class="col">
                  <input type="text" placeholder="AAA" class="form-control">
                </div>
              </div>
            </div>

            <p class="lead mt-4"> * Pengirim </p>

            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Jabatan </label>
              <input type="text" value="Autocomplete" class="form-control" disabled>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> NIPP / Nama </label>

              <div class="row mt-2">
                <div class="col">
                  <input type="text" value="Autocomplete" class="form-control" disabled>
                </div>
                <div class="col">
                  <input type="text" value="Autocomplete" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="form-group my-2">
              <label class="fw-bolder mb-2"> Divisi </label>
              <input type="text" value="Autocomplete" class="form-control" disabled>
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
          <div class="col-md-6">
            <div class="form-group my-2">
              <input
                type="text"
                class="form-control"
                placeholder="Nomor Surat"
                v-model="mailNumber"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group my-2">
              <input
                type="text"
                class="form-control"
                placeholder="Kirim Ke"
                v-model="sendTo"
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
      subject: null
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
  }
}
</script>

<style scoped>
.float-right {
  float: right;
}

.ck-content { 
  height: 500px; 
  border:1px solid #ABABAB;
}
</style>