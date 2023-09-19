<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import Editor from '@tinymce/tinymce-vue'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  },
})

// エディタのツールバー設定
const editorToolbar = ref(
  'bold underline strikethrough h1 h2 h3 h4 numlist bullist fontsize forecolor backcolor code hr indent outdent lineheight'
)
// エディタの初期処理オブジェクト
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
    v-model="value"
  />
</template>
