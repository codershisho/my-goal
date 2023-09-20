<template>
  <div class="page">
    <v-sheet
      class="pa-6 d-flex align-stretch mb-5 rounded-lg"
      color="input"
      elevation="1"
    >
      <div class="w-50 d-flex align-stretch">
        <div class="w-20 mr-3">
          <v-alert
            class="h-100"
            border="start"
            variant="tonal"
            color="secondary"
            text="期の選択"
            density="compact"
          >
          </v-alert>
        </div>
        <div class="w-33">
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
          >
          </v-autocomplete>
        </div>
      </div>
      <div class="w-50 text-right">
        <s-btn
          class="h-100"
          preicon="fa-regular fa-floppy-disk"
          label="保存"
          color="primary"
          width="150"
          @click="save"
        />
      </div>
    </v-sheet>
    <v-sheet
      class="pa-6 d-flex rounded-lg"
      color="input"
      elevation="1"
      style="max-height: 800"
    >
      <div class="w-20">
        <GoalTable></GoalTable>
      </div>
      <div class="w-80">
        <GoalEdit></GoalEdit>
      </div>
    </v-sheet>
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
