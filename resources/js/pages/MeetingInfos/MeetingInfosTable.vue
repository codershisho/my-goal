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
          v-for="(meeting, i) in meetings"
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
            <v-chip class="mr-2" label color="primary">
              {{ meeting.from_user_name }}</v-chip
            >
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
import { ref, onMounted } from 'vue'
import { _IMeeting } from '../../types/meeting'
import { fetchMeetings } from './ApiMeeting'
import { useMeetingStore } from '../../stores/meeting'

const meetingStore = useMeetingStore()
const meetings = ref<_IMeeting[]>()
let meetingsBackup: _IMeeting[] = []
const searchText = ref('')

onMounted(async () => {
  meetings.value = await fetchMeetings()
  // filter用に別で保持
  meetingsBackup = meetings.value
})

const onClickRow = (meeting: _IMeeting): void => {
  meetingStore.setSelectedMeetingId(meeting.mtg_id)
}

const filterName = (searchText: string): void => {
  if (searchText == null) {
    meetings.value = meetingsBackup
    return
  }
  meetings.value = meetingsBackup.filter((meeting: _IMeeting) => {
    return meeting.to_user_name == searchText
  })
}

const filterUnClose = (): void => {
  meetings.value = meetingsBackup.filter((meeting: _IMeeting) => {
    return meeting.status == 0
  })
}

const filterClose = (): void => {
  meetings.value = meetingsBackup.filter((meeting: _IMeeting) => {
    return meeting.status == 1
  })
}

const filterClear = () => {
  searchText.value = ''
  meetings.value = meetingsBackup
}
</script>
<style>
.meeting-table {
  cursor: pointer;
}
</style>
