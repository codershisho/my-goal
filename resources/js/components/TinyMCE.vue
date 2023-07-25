<script setup lang="ts">
import { ref, reactive } from 'vue'
import Editor from '@tinymce/tinymce-vue'

const props = defineProps({
  html: {
    type: String,
    default: '',
  },
  disable: {
    type: Boolean,
    default: false,
  },
})

// エディタのmodel
const editor = ref<string>(props.html)
const editorDisable = ref<boolean>(props.disable)
let editorToolbar = ref<string>('')
editorToolbar.value = editorDisable.value
  ? 'false'
  : 'saveButton bold italic underline strikethrough h1 h2 h3 h4 numlist bullist checklist fontsize forecolor backcolor code hr indent outdent lineheight table'

type Emits = { (e: 'update', value: object): void }
const emit = defineEmits<Emits>()
const save = () => {
  emit('update', { html: editor.value })
}
defineExpose({
  // 親から呼べるように
  save,
})
/**
 * エディタの初期処理オブジェクト
 */
const editorInitObj = reactive({
  setup: (editor) => {
    // 取り消し線のショートカット追加
    editor.addShortcut(
      'ctrl+alt+t',
      'Add yellow highlight to selected text.',
      () => {
        editor.execCommand('Strikethrough', true, true)
      }
    )
    editor.ui.registry.addButton('saveButton', {
      text: 'Save',
      icon: 'save',
      tooltip: '保存',
      onAction: () => save(),
    })
  },
  // リストの際にtabでインデント
  lists_indent_on_tab: true,
  // メニューを非表示
  menubar: false,
  placeholder: 'ここに記載（markdown使用可）...',
})
</script>

<template>
  <Editor
    api-key="uxuv5mcna6rpk2blhue26reiad1yc455ujsix9mznz3jyroy"
    plugins="code lists table"
    :toolbar="editorToolbar"
    :init="editorInitObj"
    v-model="editor"
    :disabled="editorDisable"
  />
</template>
