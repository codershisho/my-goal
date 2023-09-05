<script setup lang="ts">
import { ref, reactive } from 'vue'
import { Info } from './types.d.ts'

const infos = reactive<Array<Info>>([{}])

const test: Info = {
  id: 1,
  date: '2023-07-01',
  status: 1,
  partner_user_id: 1,
  partner_user_name: '下津曲',
}
const test2: Info = {
  id: 2,
  date: '2023-07-01',
  status: 1,
  partner_user_id: 2,
  partner_user_name: '吉岡',
}

infos.push(test)
infos.push(test2)

const clickRow = (info: Info) => {
  console.log(info)
}
</script>
<template>
  <v-sheet class="px-4 py-1 bg-backSub" style="height: 88vh" rounded="lg">
    <v-toolbar density="compact" class="bg-transparent" rounded>
      <v-toolbar-title class="a-card-title">
        <v-icon class="mr-2" size="x-small" color="icon">
          fa-solid fa-bars
        </v-icon>
        一覧
      </v-toolbar-title>
    </v-toolbar>
    <div class="border-section"></div>
    <v-table class="info-table bg-backSub text-textmain">
      <thead>
        <tr>
          <th class="text-center text-textmain">日付</th>
          <th class="text-center text-textmain">ステータス</th>
          <th class="text-center text-textmain">面談した人</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="info in infos" :key="info" @click="clickRow(info)">
          <td class="text-center text-textmain">{{ info.date }}</td>
          <td class="text-center text-textmain">{{ info.status }}</td>
          <td class="text-center text-textmain">
            {{ info.partner_user_name }}
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-sheet>
</template>
<style>
.info-table tr {
  cursor: pointer;
}
</style>
