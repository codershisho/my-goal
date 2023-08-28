<script setup lang="ts">
import { ref } from 'vue'
import TinyMCE from '@/components/TinyMCE.vue'

const props = defineProps({
  icon: {
    type: String,
    default: '',
  },
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
  <v-sheet class="py-2 px-4 goal" rounded="lg" :elevation="2">
    <v-toolbar
      density="compact"
      color="blue-grey-darken-2"
      class="mb-2 pl-3"
      rounded
    >
      <v-toolbar-title class="ma-0">
        <v-icon class="mr-3 mb-1" size="x-small" color="yellow-darken-2">
          {{ icon }}
        </v-icon>
        {{ title }}
      </v-toolbar-title>
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
        class="py-2 px-6 goal--area rounded-lg"
        v-html="pGoal"
        @dblclick="dbClickEdit"
      ></div>
    </template>
  </v-sheet>
</template>

<style>
.goal--area {
  color: #333;
  background: #f4faff;
  overflow-y: scroll;
  /*IE(Internet Explorer)・Microsoft Edgeへの対応*/
  -ms-overflow-style: none;
  /*Firefoxへの対応*/
  scrollbar-width: none;
}
.goal--area::-webkit-scrollbar {
  display: none;
}
.goal-wrap > .department > .goal--area {
  height: 83%;
}
.goal-wrap > .personal > .goal > .goal--area {
  height: 85%;
}
</style>
