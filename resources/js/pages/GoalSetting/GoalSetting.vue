<template>
  <div class="page">
    <div class="d-flex align-center align-stretch w-100">
      <div class="input-label text-lg mr-3">期選択</div>
      <div class="w-20">
        <v-autocomplete
          variant="outlined"
          :items="terms"
          item-value="id"
          item-title="name"
          bg-color="input"
          hide-details
          density="compact"
          v-model="termId"
          @update:modelValue="search"
        ></v-autocomplete>
      </div>
      <v-spacer></v-spacer>
      <s-btn
        style="height: inherit"
        preicon="fa-regular fa-floppy-disk"
        label="保存"
        color="primary"
        width="150"
        @click="save"
      />
    </div>
    <div class="goal-setting d-flex">
      <div class="w-20 goal-table">
        <GoalTable></GoalTable>
      </div>
      <div class="w-80">
        <GoalEdit></GoalEdit>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { _IGoal, _ITerm } from '../../types/goal'
import { useGoalStore } from '../../stores/goal'
import GoalTable from './GoalTable.vue'
import GoalEdit from './GoalEdit.vue'

const goalStore = useGoalStore()
const terms = ref<_ITerm[]>()
const termId = ref(0)

onMounted(async (): Promise<void> => {
  await goalStore.searchTerms()
  terms.value = goalStore.terms
})

/**
 * 検索処理
 */
const search = async () => {
  await goalStore.searchGoal(termId.value)
}

/**
 * 保存処理
 */
const save = async () => {
  await goalStore.save(termId.value)
}
</script>
