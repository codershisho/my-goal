<template>
  <div class="left-menu w-80">
    <div
      class="input-label text-lg"
      :class="btnState.department ? 'active-btn' : ''"
      @click="clickDepartment"
    >
      部目標
    </div>
    <div
      class="input-label text-lg"
      :class="btnState.first ? 'active-btn' : ''"
      @click="clickFirst"
    >
      目標1
    </div>
    <div
      class="input-label text-lg"
      :class="btnState.secound ? 'active-btn' : ''"
      @click="clickSecound"
    >
      目標2
    </div>
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

<style>
.goal-setting .left-menu {
  border-right: 1px solid rgba(var(--v-theme-contract), 0.2);
  margin-top: 36px;
}
.goal-setting .left-menu > div {
  margin: 30px 0px;
}

.left-menu > .input-label {
  background-color: rgb(var(--v-theme-bInputSubLabel));
  color: rgb(var(--v-theme-fInputSubLabel));
  opacity: 1;
  padding: 8px;
  width: 200px;
  text-align: center;
  border-radius: 4px;
  cursor: pointer;
}
</style>
