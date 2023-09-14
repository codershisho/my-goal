<template>
  <div>
    <v-table>
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
          <td>{{ meeting.status }}</td>
          <td>
            {{ meeting.to_user_name }}
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { IMeeting } from '../../types/meeting'
import { fetchMeetings } from './ApiMeeting'
import { useMeetingStore } from '../../stores/meeting'

const meetingStore = useMeetingStore()
const meetings = ref<IMeeting[]>()

onMounted(async () => {
  meetings.value = await fetchMeetings()
})

const onClickRow = (meeting: IMeeting): void => {
  meetingStore.setSelectedMeetingId(meeting.mtg_id)
}
</script>
