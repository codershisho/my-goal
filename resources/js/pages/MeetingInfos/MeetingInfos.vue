<template>
  <div class="page d-flex">
    <div class="w-35 mr-5">
      <MeetingInfosTable />
    </div>
    <div class="w-65">
      <MeetingEdit />
    </div>
  </div>
</template>

<script setup lang="ts">
import MeetingInfosTable from './MeetingInfosTable.vue'
import MeetingEdit from './MeetingEdit.vue'
import { useMeetingStore } from '../../stores/meeting'
import { useAuthStore } from '../../stores/auth'
import Swal from 'sweetalert2'

const meetingStore = useMeetingStore()
const authStore = useAuthStore()

Echo.channel('channel-public-my-goal')
  .listen('CreateMeeting', (e) => {
    // 新規時
    // 一覧更新のみ
    meetingStore.searchMeetings()
  })
  .listen('UpdateMeeting', (e) => {
    // 更新時
    // meetingのbaseとdetailの更新（上書き）
    const createdMeetingId = e.meetingInfo.createdMeeting.id
    const updateUserId = e.meetingInfo.updateUserId

    // 自身による更新は無視
    if (authStore.user.id == updateUserId) {
      return
    }

    if (createdMeetingId == meetingStore.selectedMeetingId) {
      Swal.fire({
        title: 'OPPS!...他の人が編集しました。',
        text: '他の人の変更で上書きを許可しますか？',
        icon: 'warning',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonText: '上書き許可する',
        cancelButtonText: '許可しない',
        reverseButtons: true,
        allowEnterKey: false,
      }).then(function (result) {
        if (result.value) {
          meetingStore.setSelectedMeetingId(createdMeetingId)
          meetingStore.searchMeetingBase()
          meetingStore.searchMeetingDetails()
        }
      })
    }
  })
</script>
