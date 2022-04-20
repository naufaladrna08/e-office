<template>
  <div>
    <div class="container text-center py-4">
      <form @submit.prevent="send">
        <b class="my-4"> BUAT SURAT </b>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group my-2">
              <input
                type="text"
                class="form-control"
                placeholder="Judul"
                v-model="subject"
              />
            </div>
          </div>
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
  name: 'InboxView',
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