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
  <v-sheet class="pa-4" style="height: 88vh" rounded="lg" :elevation="2">
    <v-toolbar
      density="compact"
      color="blue-grey-darken-2"
      class="mb-2 pl-3"
      rounded
    >
      <v-toolbar-title>
        <v-icon class="mr-3 mb-1" size="x-small" color="yellow-darken-2">
          fa-solid fa-bars
        </v-icon>
        一覧
      </v-toolbar-title>
    </v-toolbar>
    <v-table class="info-table">
      <thead>
        <tr>
          <th class="text-center">日付</th>
          <th class="text-center">ステータス</th>
          <th class="text-center">面談した人</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="info in infos" :key="info" @click="clickRow(info)">
          <td class="text-center">{{ info.date }}</td>
          <td class="text-center">{{ info.status }}</td>
          <td class="text-center">{{ info.partner_user_name }}</td>
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
