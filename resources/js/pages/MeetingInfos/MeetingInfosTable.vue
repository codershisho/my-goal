<template>
  <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
    <s-text
      placeholder="氏名"
      bg-color="input"
      hide-details
      density="compact"
      preicon="fa-solid fa-magnifying-glass"
      v-model="searchText"
      @update:modelValue="filterName"
    />
    <v-chip class="mr-3 mt-3" color="accent" @click="filterUnClose"
      >未実施</v-chip
    >
    <v-chip class="mr-3 mt-3" color="#607D8B" @click="filterClose"
      >実施済み</v-chip
    >
    <v-btn class="mt-3" variant="text" color="primary" @click="filterClear"
      >クリア</v-btn
    >
  </v-sheet>
  <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
    <v-table class="meeting-table bg-input">
      <thead>
        <tr>
          <th class="text-contract">日付</th>
          <th class="text-contract">ステータス</th>
          <th class="text-contract">面談した人</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(meeting, i) in meetingsFiltered"
          :key="i"
          @click="onClickRow(meeting)"
        >
          <td>{{ meeting.mtg_date }}</td>
          <td>
            <v-chip :color="meeting.status == 1 ? '#607D8B' : 'accent'">
              {{ meeting.status_name }}
            </v-chip>
          </td>
          <td>
            <v-avatar size="35" color="primary" class="mr-2">
              <v-img
                :src="'storage/avatar/' + meeting.from_user_avatar"
              ></v-img>
            </v-avatar>
            <v-chip label color="primary"> {{ meeting.from_user_name }}</v-chip>
            <span class="mx-2">⇒</span>
            <v-avatar size="35" color="accent" class="mr-2">
              <v-img :src="'storage/avatar/' + meeting.to_user_avatar"></v-img>
            </v-avatar>
            <v-chip class="mr-2" label color="accent">
              {{ meeting.to_user_name }}</v-chip
            >
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-sheet>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { _IMeeting } from '../../types/meeting'
import { useMeetingStore } from '../../stores/meeting'

const meetingStore = useMeetingStore()
const searchText = ref('')

const meetings = computed(() => {
  return meetingStore.mettings
})
const meetingsFiltered = computed(() => {
  return meetingStore.meetingsFiltered
})

onMounted(async () => {
  await meetingStore.searchMeetings()
})

const onClickRow = async (meeting: _IMeeting): Promise<void> => {
  meetingStore.setInsertMode(false)
  meetingStore.setSelectedMeetingId(meeting.mtg_id)
  await meetingStore.searchMeetingBase()
  await meetingStore.searchMeetingDetails()
}

const filterName = (searchText: string): void => {
  if (searchText == null) {
    meetingStore.filterClear()
    return
  }
  meetingStore.filterName(searchText)
}

const filterUnClose = (): void => {
  meetingStore.filterUnClose()
}

const filterClose = (): void => {
  meetingStore.filterClose()
}

const filterClear = () => {
  searchText.value = ''
  meetingStore.filterClear()
}
</script>
<style>
.meeting-table {
  cursor: pointer;
}
</style>
