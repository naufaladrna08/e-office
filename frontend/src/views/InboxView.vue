<template>
  <div>
    <div class="container text-center py-4">
      <form @submit.prevent="send">
        <b class="my-4"> BUAT SURAT </b>

        <div class="form-group my-2">
          <input
            type="text"
            class="form-control"
            placeholder="Nomor Surat"
          />
        </div>
        <div class="form-group my-2">
          <ckeditor 
            :editor="editor" 
            v-model="editorData" 
            :config="editorConfig" 
            class="form-control"
            @ready="onReady"
          />
        </div>

        <button class="btn btn-primary float-right mt-4"> Kirim </button>
      </form>
    </div>
  </div>
</template>

<script>
import Editor from '@ckeditor/ckeditor5-build-decoupled-document'
// import Editor from '../../ckeditor/build/ckeditor'

export default {
  name: 'InboxView',
  data() {
    return {
      editor: Editor,
      editorData: this.content,
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
      console.log(this.editorData)
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