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
  <GoalEdit
    title="部・チーム目標"
    :goal="goalObj.goalDepartment"
    :btn="dispInfo.goalDepartmentEditFlag"
    @update="updateDepartment"
  />
  <GoalEdit
    title="目標 1 "
    class="my-5"
    :goal="goalObj.goalFirst"
    :btn="dispInfo.goalFirstEditFlag"
    @update="updateFirst"
  />
  <GoalEdit
    title="目標 2 "
    class="my-5"
    :goal="goalObj.goalSecond"
    :btn="dispInfo.goalSecondEditFlag"
    @update="updateSecond"
  />
  {{ goalObj }}
</template>
