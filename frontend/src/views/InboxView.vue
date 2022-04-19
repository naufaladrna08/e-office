<template>
  <div>
    <div class="container text-center">
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
          <!-- <ckeditor 
            :editor="editor" 
            v-model="editorData" 
            :config="editorConfig" 
            class="form-control"
          /> -->
        </div>

        <button class="btn btn-primary float-right mt-4"> Kirim </button>
      </form>
    </div>
  </div>
</template>

<script>
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
// import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials'
// import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold'
// import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic'
// import LinkPlugin from '@ckeditor/ckeditor5-link/src/link'
// import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph'

// /* Tables */
// import Table from '@ckeditor/ckeditor5-table/src/table'
// import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar'
// import TableProperties from '@ckeditor/ckeditor5-table/src/tableproperties'
// import TableCellProperties from '@ckeditor/ckeditor5-table/src/tablecellproperties'

export default {
  name: 'InboxView',
  data() {
    return {
      // editor: ClassicEditor,
      editorConfig: {
        plugins: [
          // Table,
          // TableToolbar,
          // TableProperties, 
          // TableCellProperties, 
          // EssentialsPlugin,
          // BoldPlugin,
          // ItalicPlugin,
          // LinkPlugin,
          // ParagraphPlugin,
        ],
        toolbar: {
          items: [
            'heading',
            'bold',
            'italic',
            'link',
            'undo',
            'redo',
            'insertTable',
          ]
        },
        table: {
          contentToolbar: [
            'tableColumn', 'tableRow', 'mergeTableCells',
            'tableProperties', 'tableCellProperties'
          ],
          tableProperties: {

          },
          tableCellProperties: {

          }
        }
      },
      editorData: this.content,
    };
  },
  methods: {
    onReady(editor)  {
      // editor.ui.getEditableElement().parentElement.insertBefore(
      //   editor.ui.view.toolbar.element,
      //   editor.ui.getEditableElement()
      // );
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