<template>
  <div class="page goal-setting">
    <div class="d-flex align-end">
      <div class="w-25">
        <div class="text-textmain mr-5 text-lg">期選択</div>
        <v-autocomplete
          variant="outlined"
          :items="terms"
          item-value="id"
          item-title="name"
          bg-color="input"
          hide-details
          density="compact"
          v-model="goal.term_id"
          @update:modelValue="selected"
        ></v-autocomplete>
      </div>
      <div class="w-25 ml-5">
        <s-btn
          preicon="fa-regular fa-floppy-disk"
          label="保存"
          color="primary"
          width="150"
          @click="save"
        />
      </div>
    </div>
    <div class="body">
      <div class="text-xl pa-4 my-2">部目標</div>
      <TinyMCEMeeting v-model="goal.goal_department" />
      <div class="text-xl pa-4 my-2">目標１</div>
      <TinyMCEMeeting v-model="goal.goal_first" />
      <div class="text-xl pa-4 my-2">目標２</div>
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

<style>
.goal-setting > .body > div {
  background-color: rgba(var(--v-theme-secondary), 0.3);
  color: rgb(var(--v-theme-secondary));
  font-weight: 500;
  border-radius: 20px;
}
</style>
