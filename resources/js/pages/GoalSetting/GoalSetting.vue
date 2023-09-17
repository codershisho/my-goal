<template>
  <div id="goal-setting">
    <div class="header">
      <v-autocomplete
        label="期選択"
        :items="terms"
        item-value="id"
        item-title="name"
        v-model="goal.term_id"
        @update:modelValue="selected"
      ></v-autocomplete>
      <v-btn @click="save">保存</v-btn>
    </div>
    <div class="body">
      <div>部目標</div>
      <TinyMCEMeeting v-model="goal.goal_department" />
      <div>目標１</div>
      <TinyMCEMeeting v-model="goal.goal_first" />
      <div>目標２</div>
      <TinyMCEMeeting v-model="goal.goal_secound" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { _IGoal, _ITerm } from '../../types/goal'
import { createGoal, fetchGoal, fetchTerms, updateGoal } from './ApiGoalSetting'
import TinyMCEMeeting from '../../components/TinyMCEMeeting.vue'

const terms = ref<_ITerm[]>()

const goal = ref<_IGoal>({
  term_id: 0,
  goal_department: '',
  goal_first: '',
  goal_secound: '',
})

onMounted(async (): Promise<void> => {
  terms.value = await fetchTerms()
})

/**
 * 期選択時
 */
const selected = async () => {
  await search()
}

/**
 * 検索処理
 */
const search = async () => {
  const resGoal = await fetchGoal(goal.value.term_id)
  if (resGoal != null) {
    goal.value = resGoal
  }
}

/**
 * 保存処理
 */
const save = async () => {
  if ('id' in goal.value) {
    await updateGoal(goal.value.term_id, goal.value)
  } else {
    await createGoal(goal.value.term_id, goal.value)
  }
  await search()
}
</script>
