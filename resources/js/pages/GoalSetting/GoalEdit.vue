<template>
  <div class="d-flex mb-5">
    <div class="mr-6">目標の編集</div>
    <HelpIcon message="各種メニューボタンで文字の装飾をすることができます" />
  </div>
  <RichTextEditor v-model="goalText" />
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useGoalStore } from '../../stores/goal'
import RichTextEditor from '../../components/QuillEditor.vue'

const goalStore = useGoalStore()

const goalText = computed({
  get: () => {
    const dispGoalItemName = goalStore.dispGoalItemName
    if (dispGoalItemName == 'department') {
      return goalStore.goal.goal_department ?? '※部署の目標を入力してください※'
    }
    if (dispGoalItemName == 'first') {
      return goalStore.goal.goal_first ?? '※目標１を入力してください※'
    }
    if (dispGoalItemName == 'secound') {
      return goalStore.goal.goal_secound ?? '※目標２を入力してください※'
    }
    return '※編集する目標を選択してください※'
  },
  set: (val: string): void => {
    const dispGoalItemName = goalStore.dispGoalItemName
    if (dispGoalItemName == 'department') {
      goalStore.setDepartmentGoalText(val)
      return
    }
    if (dispGoalItemName == 'first') {
      goalStore.setGoalFirstText(val)
      return
    }
    if (dispGoalItemName == 'secound') {
      goalStore.setGoalSecoundText(val)
      return
    }
    return
  },
})
</script>
