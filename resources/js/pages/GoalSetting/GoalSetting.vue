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
            density="compact"
          >
            <template #text>
              <div class="d-flex">
                <div class="mr-6">期の選択</div>
                <HelpIcon
                  message="目標を表示したい期を選択してください。<br>選択すると目標が表示されます。"
                />
              </div>
            </template>
          </v-alert>
        </div>
        <div class="w-33">
          <v-autocomplete
            variant="outlined"
            :items="goalStore.terms"
            item-value="id"
            item-title="name"
            bg-color="input"
            hide-details
            density="compact"
            v-model="termId"
            placeholder="期を選択してください"
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
          :disabled="!termId"
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
      <div class="w-80" v-if="termId">
        <GoalEdit></GoalEdit>
      </div>
    </v-sheet>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { _IGoal, _ITerm } from '../../types/goal'
import { useGoalStore } from '../../stores/goal'
import GoalTable from './GoalTable.vue'
import GoalEdit from './GoalEdit.vue'

const goalStore = useGoalStore()
const termId = computed({
  get() {
    return goalStore.selectedTermId
  },
  set(v) {
    goalStore.setSelectedTermId(v)
  },
})

goalStore.searchTerms()

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
