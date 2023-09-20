<template>
  <div class="mt-9">
    <!-- <TinyMCEMeeting v-model="goalText" /> -->
    <v-textarea
      label="目標"
      bg-color="input"
      hide-details
      density="compact"
      variant="outlined"
      auto-grow
      :rows="15"
      v-model="goalText"
    ></v-textarea>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
// import TinyMCEMeeting from '../../components/TinyMCEMeeting.vue'
import { useGoalStore } from '../../stores/goal'

const goalStore = useGoalStore()

const goalText = computed({
  get: () => {
    const dispGoalItemName = goalStore.dispGoalItemName
    if (dispGoalItemName == 'department') {
      return goalStore.goal.goal_department
    }
    if (dispGoalItemName == 'first') {
      return goalStore.goal.goal_first
    }
    if (dispGoalItemName == 'secound') {
      return goalStore.goal.goal_secound
    }
    return ''
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
