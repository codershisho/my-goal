<script setup lang="ts">
import { ref, reactive } from 'vue'
import Editor from '@tinymce/tinymce-vue'

const props = defineProps({
  html: {
    type: String,
    default: '',
  },
})

// エディタのmodel
const editor = ref<string>(props.html)
let editorToolbar = ref<string>('')
editorToolbar.value =
  'bold underline strikethrough h1 h2 h3 h4 numlist bullist fontsize forecolor backcolor code hr indent outdent lineheight'

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
  },
  // リストの際にtabでインデント
  lists_indent_on_tab: true,
  // メニューを非表示
  menubar: false,
  placeholder: 'ここに記載...',
  height: 270,
})
</script>

<template>
  <Editor
    api-key="uxuv5mcna6rpk2blhue26reiad1yc455ujsix9mznz3jyroy"
    plugins="code lists"
    :toolbar="editorToolbar"
    :init="editorInitObj"
    v-model="editor"
  />
</template>
