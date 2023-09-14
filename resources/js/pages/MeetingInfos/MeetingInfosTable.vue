<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useMeetingStore } from '../../stores/meeting'

// // data
const infos = ref([])
const meetingStore = useMeetingStore()

// // mounted
onMounted(async () => {
  const result = await axios.get('/api/my-goal/v1/mtgs')
  infos.value = result.data.data
})
// methods
const clickRow = async (info: Info) => {
  await show(info.mtg_id)
  meetingStore.changeModeUpdate()
}

async function show(id: number) {
  await meetingStore.fetchMeeting(id)
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
          <td class="text-center text-textmain">{{ info.created_at }}</td>
          <td class="text-center text-textmain">{{ info.status }}</td>
          <td class="text-center text-textmain">
            {{ info.to_user_name }}
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
