<script setup lang="ts">
import { ref } from 'vue'
import TinyMCE from '@/components/TinyMCE.vue'

const props = defineProps({
  title: {
    type: String,
    default: '',
  },
  goal: {
    type: String,
    default: '',
  },
  btn: {
    type: Boolean,
    default: false,
  },
})
//------------------
// modelエリア
//------------------

const pGoal = ref<string>(props.goal)
const pBtn = ref<boolean>(props.btn)
const editor = ref()

//------------------
// イベントエリア
//------------------
type Emits = { (e: 'update', value: object): void }
const emit = defineEmits<Emits>()
// 目標のコントロールボタン
const clickGoalEdit = () => {
  pBtn.value = !pBtn.value
  // 子のメソッドを呼び出して値を引き継ぐ
  if (!pBtn.value) {
    editor.value.save()
  }
}
// 目標の更新イベント
const handleUpdGoalFirst = (obj: { html: string }): void => {
  pGoal.value = obj.html
  emit('update', {
    goal: pGoal,
    btn: pBtn,
  })
}
</script>

<template>
  <v-sheet color="" class="pa-4" rounded="lg">
    <v-toolbar density="compact" color="white" class="" rounded>
      <v-toolbar-title>{{ title }}</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        color="blue-accent-4"
        variant="tonal"
        prepend-icon="mdi-note-edit-outline"
        size="large"
        @click="clickGoalEdit"
        :text="pBtn ? `終了` : `編集`"
        density="compact"
      >
      </v-btn>
    </v-toolbar>
    <v-divider class="mb-2" :thickness="8" color="blue-accent-4"></v-divider>
    <template v-if="pBtn">
      <TinyMCE ref="editor" :html="pGoal" @update="handleUpdGoalFirst" />
    </template>
    <template v-else>
      <div class="pl-5" v-html="pGoal"></div>
    </template>
  </v-sheet>
</template>
