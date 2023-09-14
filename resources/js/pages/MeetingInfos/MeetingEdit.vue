<template>
  <div id="meeting-edit">
    <div class="header">
      <div>日付{{ meetingBase?.mtg_date }}</div>
      <div>面談者{{ meetingBase?.to_user_name }}</div>
    </div>
    <div class="body">
      <!-- {{ meetingDetails }} -->
      <div v-for="(detail, i) in meetingDetails" :key="i">
        <v-checkbox
          :label="detail.topic_name"
          v-model="detail.checked"
        ></v-checkbox>
        <v-radio-group v-model="detail.selected">
          <template v-for="(topicDetail, j) in detail.details" :key="j">
            <v-radio
              :label="topicDetail.name"
              :value="topicDetail.id"
            ></v-radio>
          </template>
        </v-radio-group>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useMeetingStore } from '../../stores/meeting'
import { ref } from 'vue'
import { IMeeting, ITopic } from '../../types/meeting'
import { fetchMeetingBase, fetchMeetingDetail } from './ApiMeeting'

const meetingStore = useMeetingStore()

const meetingDetails = ref<ITopic[]>()
const meetingBase = ref<IMeeting>()

meetingStore.$subscribe(async (mutation, state) => {
  meetingBase.value = await fetchMeetingBase(state._selectedMeetingId)
  meetingDetails.value = await fetchMeetingDetail(state._selectedMeetingId)
})
</script>
