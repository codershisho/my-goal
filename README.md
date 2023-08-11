## 環境構築

- clone
- env のコピー
  - .env.example -> .env
- composer install
- php artisan key:generate
- npm install
- npm run dev
- [画面確認](http://localhost/login)

## TinyMCE 導入方法

- [リンク](https://www.tiny.cloud/docs/tinymce/6/vue-pm/)
- Vue ファイルをコピー

```vue
<script setup lang="ts">
import { ref, reactive } from 'vue'
import Editor from '@tinymce/tinymce-vue'

// const props = defineProps({
//   editorArr: Array,
//   workdayIndex: Number,
// });

// const index = props.workdayIndex;

// エディタのmodel
// let editorHtml = props.editorArr[index];
// const editor: string = ref(editorHtml);

// type Emits = { (e: 'update', value: object): void };
// const emit = defineEmits<Emits>();
// const save = () => {
//   emit('update', { html: editor.value, index: index });
// };

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
    // editor.ui.registry.addButton('saveButton', {
    //   text: 'Save',
    //   icon: 'save',
    //   tooltip: '保存',
    //   onAction: () => save(),
    // })
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
    plugins="code lists table checklist"
    toolbar="saveButton bold italic underline strikethrough h1 h2 h3 h4 numlist bullist checklist fontsize forecolor backcolor code hr indent outdent lineheight table"
    :init="editorInitObj"
  />
</template>
```
