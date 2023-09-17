<template>
  <s-text
    label=""
    placeholder="search"
    bg-color="input"
    hide-details
    density="compact"
    preicon="fa-solid fa-magnifying-glass"
  />
  <v-table class="meeting-table">
    <thead>
      <tr>
        <th>日付</th>
        <th>ステータス</th>
        <th>面談した人</th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(meeting, i) in meetings"
        :key="i"
        @click="onClickRow(meeting)"
      >
        <td>{{ meeting.created_at }}</td>
        <td>
          <v-chip :color="meeting.status == 1 ? '#607D8B' : 'primary'">
            {{ meeting.status_name }}
          </v-chip>
        </td>
        <td>
          {{ meeting.to_user_name }}
        </td>
      </tr>
    </tbody>
  </v-table>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { _IMeeting } from '../../types/meeting'
import { fetchMeetings } from './ApiMeeting'
import { useMeetingStore } from '../../stores/meeting'

const meetingStore = useMeetingStore()
const meetings = ref<_IMeeting[]>()

onMounted(async () => {
  meetings.value = await fetchMeetings()
})

const onClickRow = (meeting: _IMeeting): void => {
  meetingStore.setSelectedMeetingId(meeting.mtg_id)
}
</script>
<style>
.meeting-table {
  cursor: pointer;
}
</style>
