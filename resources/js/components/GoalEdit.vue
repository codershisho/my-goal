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
const pEditFlag = ref<boolean>(props.btn)
const editor = ref()

//------------------
// イベントエリア
//------------------
type Emits = { (e: 'update', value: object): void }
const emit = defineEmits<Emits>()
// 目標のコントロールボタン
const dbClickEdit = () => {
  pEditFlag.value = !pEditFlag.value
  // 子のメソッドを呼び出して値を引き継ぐ
  if (!pEditFlag.value) {
    editor.value.save()
  }
}
// 目標の更新イベント
const handleUpdGoalFirst = (obj: { html: string }): void => {
  pGoal.value = obj.html
  pEditFlag.value = !pEditFlag.value
  emit('update', {
    goal: pGoal,
    btn: pEditFlag,
  })
}

const savePartnerMemo = (): void => {
  editor.value.save()
}
</script>

<template>
  <v-sheet class="pa-4 goal" rounded="lg">
    <v-toolbar density="compact" color="white" class="" rounded>
      <v-toolbar-title>{{ title }}</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <template v-if="pEditFlag">
      <TinyMCE
        ref="editor"
        :html="pGoal"
        @update="handleUpdGoalFirst"
        @blur="savePartnerMemo"
      />
    </template>
    <template v-else>
      <div
        class="py-2 px-6 goal--area"
        v-html="pGoal"
        @dblclick="dbClickEdit"
      ></div>
    </template>
  </v-sheet>
</template>

<style>
.goal .goal--area {
  color: #333;
  background: #e3f2fd;
  border-top: solid 10px #2962ff;
  min-height: 200px;
}
</style>
