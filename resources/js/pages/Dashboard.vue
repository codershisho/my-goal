<script setup lang="ts">
import { ref, reactive } from 'vue'
import GoalEdit from '@/components/GoalEdit.vue'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
console.log(auth.user)

//------------------
// typeエリア
//------------------
type TDispInfoObj = {
  goalDepartmentEditFlag: boolean
  goalFirstEditFlag: boolean
  goalSecondEditFlag: boolean
}

type Tgoal = {
  goalDepartment: string
  goalFirst: string
  goalSecond: string
}

type child = {
  goal: string
  btn: boolean
}

//------------------
// modelエリア
//------------------
// ゴールオブジェクト
const goalObj = reactive<Tgoal>({
  goalDepartment: '',
  goalFirst: '',
  goalSecond: '',
})
// 表示制御用
const dispInfo = reactive<TDispInfoObj>({
  goalDepartmentEditFlag: false,
  goalFirstEditFlag: false,
  goalSecondEditFlag: false,
})

//------------------
// イベントエリア
//------------------
const updateDepartment = (child: child): void => {
  goalObj.goalSecond = child.goal
  dispInfo.goalSecondEditFlag = child.btn
}
const updateFirst = (child: child): void => {
  goalObj.goalFirst = child.goal
  dispInfo.goalFirstEditFlag = child.btn
}
const updateSecond = (child: child): void => {
  goalObj.goalSecond = child.goal
  dispInfo.goalSecondEditFlag = child.btn
}
</script>

<template>
  <div class="goal-wrap">
    <GoalEdit
      icon="fa-solid fa-crown"
      title="部・チーム目標"
      class="department bg-backsub"
      :goal="goalObj.goalDepartment"
      :btn="dispInfo.goalDepartmentEditFlag"
      @update="updateDepartment"
    />
    <div class="d-flex align-stretch mt-5 personal">
      <GoalEdit
        icon="fa-solid fa-star"
        title="目標 1 "
        class="w-50 mr-5 bg-backsub"
        :goal="goalObj.goalFirst"
        :btn="dispInfo.goalFirstEditFlag"
        @update="updateFirst"
      />
      <GoalEdit
        icon="fa-solid fa-star"
        title="目標 2 "
        class="w-50 bg-backsub"
        :goal="goalObj.goalSecond"
        :btn="dispInfo.goalSecondEditFlag"
        @update="updateSecond"
      />
    </div>
  </div>
</template>
<style>
.goal-wrap {
  height: 100%;
}
.goal-wrap > .department {
  height: 45%;
}
.goal-wrap > .personal {
  height: 50%;
}
</style>
