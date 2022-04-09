<template>
  <div id="app">
    <ckeditor :editor="editor" @ready="onReady"></ckeditor>
  </div>
</template>

<script>
import CKEditor from '@ckeditor/ckeditor5-vue'
import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document'

export default {
  name: 'TextEditor',
  components: {
    // Use the <ckeditor> component in this view.
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: DecoupledEditor,
      editorConfig: {
        plugins: [

        ],
        toolbar: {
          items: [
            'export-document'
          ]
        }
      }
    };
  },
  methods: {
    onReady( editor )  {
      // Insert the toolbar before the editable area.
      editor.ui.getEditableElement().parentElement.insertBefore(
        editor.ui.view.toolbar.element,
        editor.ui.getEditableElement()
      );
    }
  }
}
</script>