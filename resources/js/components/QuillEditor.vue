<template>
  <div>
    <QuillEditor
      ref="quill"
      class="editor"
      theme="snow"
      :toolbar="toolbars"
      v-model:content="value"
      contentType="html"
    />
  </div>
</template>

<script setup>
import { QuillEditor } from '@vueup/vue-quill'
import { ref, computed, watch } from 'vue'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import '@vueup/vue-quill/dist/vue-quill.bubble.css'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])
let quill = ref(null)

const value = computed({
  get() {
    return props.modelValue
  },
  set(value) {
    emit('update:modelValue', value)
  },
})

watch(value, (newVal) => {
  // html側が更新されない事象のため、watchしてHTMLを更新
  quill.value.setHTML(newVal)
})

const toolbars = ref([
  ['bold', 'italic', 'underline', 'strike'],
  ['blockquote', 'code-block'],
  [{ list: 'ordered' }, { list: 'bullet' }],
  [{ color: [] }, { background: [] }],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  [{ size: ['small', false, 'large', 'huge'] }],
  [{ indent: '-1' }, { indent: '+1' }],
  [{ align: [] }],
  ['clean'],
])
</script>

<style>
.ql-container {
  color: rgb(var(--v-theme-contract)) !important;
  font-size: 18px !important;
  font-family: 'Noto Sans JP', sans-serif !important;
}
.ql-container .ql-editor {
  line-height: 1.6 !important;
}
.ql-toolbar {
  background-color: rgb(var(--v-theme-textmain)) !important;
}
</style>
