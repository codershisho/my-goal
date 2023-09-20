<template>
  <div class="left-menu w-80">
    <div
      class="input-label text-xl"
      @click="goalStore.setDispGoalItemName('department')"
    >
      部目標
    </div>
    <div
      class="input-label text-xl"
      @click="goalStore.setDispGoalItemName('first')"
    >
      目標1
    </div>
    <div
      class="input-label text-xl"
      @click="goalStore.setDispGoalItemName('secound')"
    >
      目標2
    </div>
  </div>
</template>

<script setup lang="ts">
import { useGoalStore } from '../../stores/goal'

const goalStore = useGoalStore()
</script>

<style>
.goal-setting .left-menu {
  border-right: 1px solid white;
  margin-top: 36px;
}
.goal-setting .left-menu > div {
  color: rgb(var(--v-theme-textmain));
  margin: 30px 0px;
}
</style>
