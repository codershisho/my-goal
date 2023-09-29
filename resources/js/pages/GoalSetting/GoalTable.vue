<template>
  <div class="w-80">
    <div class="d-flex mb-5">
      <div class="mr-6">目標の切り替え</div>
      <HelpIcon
        message="ボタンで表示する目標を切り替えれます<br>編集したい目標を選択してください"
      />
    </div>
    <v-card
      class="text-lg text-center pt-2"
      :class="btnState.department ? 'active-btn' : ''"
      variant="outlined"
      :color="btnState.department ? '' : 'primary'"
      min-height="50"
    >
      <div @click="clickDepartment">部目標</div>
    </v-card>
    <v-card
      class="my-3 text-lg text-center pt-2"
      :class="btnState.first ? 'active-btn' : ''"
      variant="outlined"
      :color="btnState.first ? '' : 'primary'"
      min-height="50"
      flat
    >
      <div @click="clickFirst">目標１</div>
    </v-card>
    <v-card
      class="my-3 text-lg text-center pt-2"
      :class="btnState.secound ? 'active-btn' : ''"
      variant="outlined"
      :color="btnState.secound ? '' : 'primary'"
      min-height="50"
      flat
    >
      <div @click="clickSecound">目標2</div>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { useGoalStore } from '../../stores/goal'
import { ref } from 'vue'

const goalStore = useGoalStore()
const btnState = ref({
  department: false,
  first: false,
  secound: false,
})
const clickDepartment = () => {
  goalStore.setDispGoalItemName('department')
  btnState.value.department = true
  btnState.value.first = false
  btnState.value.secound = false
}
const clickFirst = () => {
  goalStore.setDispGoalItemName('first')
  btnState.value.department = false
  btnState.value.first = true
  btnState.value.secound = false
}
const clickSecound = () => {
  goalStore.setDispGoalItemName('secound')
  btnState.value.department = false
  btnState.value.first = false
  btnState.value.secound = true
}
</script>
