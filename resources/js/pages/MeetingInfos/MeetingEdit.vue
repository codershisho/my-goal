<template>
  <div id="meeting-edit">
    <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
      <div class="d-flex">
        <s-btn
          class="me-auto text-white"
          preicon="fa-solid fa-plus"
          label="新規作成する"
          color="newbtn"
          width="150"
          variant="outlined"
          @click="create"
        />
        <s-btn
          preicon="fa-regular fa-floppy-disk"
          label="保存"
          color="primary"
          width="150"
          @click="save"
        />
      </div>
      <div class="d-flex align-center mt-5 w-50">
        <div class="w-33">
          <v-alert
            class="mr-3"
            border="start"
            variant="tonal"
            color="secondary"
            text="日付"
            density="compact"
          />
        </div>
        <div class="w-80">
          <VueDatePicker
            format="yyyy-MM-dd"
            week-start="0"
            locale="ja"
            :enable-time-picker="false"
            auto-apply
            model-type="yyyy-MM-dd"
            v-model="meetingBase.mtg_date"
          />
        </div>
      </div>
      <div class="d-flex align-stretch mt-2">
        <v-alert
          class="mr-3"
          border="start"
          variant="tonal"
          color="secondary"
          text="面談する人"
          density="compact"
        />
        <v-autocomplete
          class="w-25 mr-3"
          :items="users"
          item-value="id"
          item-title="name"
          variant="outlined"
          bg-color="input"
          density="compact"
          hide-details
          placeholder="面談相手を選択してください"
          v-model="meetingBase.to_user_id"
        ></v-autocomplete>
        <v-alert
          class="mr-3"
          border="start"
          variant="tonal"
          color="secondary"
          text="ステータス"
          density="compact"
        />
        <v-autocomplete
          class="w-25"
          :items="[
            { id: 0, name: '未実施' },
            { id: 1, name: '実施済み' },
          ]"
          item-value="id"
          item-title="name"
          variant="outlined"
          bg-color="input"
          density="compact"
          hide-details
          v-model="meetingBase.status"
        ></v-autocomplete>
      </div>
    </v-sheet>
    <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
      <div v-for="(detail, i) in meetingDetails" :key="i" class="mb-5">
        <v-alert
          class="pa-0"
          border="start"
          variant="tonal"
          color="secondary"
          density="compact"
        >
          <v-checkbox
            class="mb-1 pl-4"
            :label="detail.topic_name"
            v-model="detail.checked"
            density="compact"
            hide-details
          ></v-checkbox>
        </v-alert>
        <template v-if="detail.checked">
          <v-radio-group
            v-model="detail.selected"
            inline
            density="compact"
            hide-details
          >
            <template v-for="(topicDetail, j) in detail.details" :key="j">
              <v-radio
                class="pl-4 my-1"
                style="width: 33%"
                :label="topicDetail.name"
                :value="topicDetail.id"
                color="secondary"
                density="compact"
                hide-details
              ></v-radio>
            </template>
          </v-radio-group>
          <div class="pl-4">
            <v-alert
              class="my-2"
              border="start"
              variant="text"
              color="newbtn"
              density="compact"
              text="自分用メモ"
            >
            </v-alert>
            <RichTextEditor v-model="detail.from_memo" />
          </div>
          <div class="pl-4">
            <v-alert
              class="my-2"
              border="start"
              variant="text"
              color="newbtn"
              density="compact"
              text="面談者メモ"
            >
            </v-alert>
            <RichTextEditor v-model="detail.to_memo" />
          </div>
        </template>
      </div>
    </v-sheet>
  </div>
</template>

<script setup lang="ts">
import { useMeetingStore } from '../../stores/meeting'
import { onMounted, computed } from 'vue'
import { _IMeeting, _IMeetingDetail } from '../../types/meeting'
import { _IUser } from '../../types/user'
import RichTextEditor from '../../components/QuillEditor.vue'

const meetingStore = useMeetingStore()

// store async
const meetingDetails = computed({
  get() {
    return meetingStore.meetingDetails
  },
  set(v) {
    meetingStore.setMeetingDetails(v)
  },
})
const meetingBase = computed({
  get() {
    return meetingStore.meetingBase
  },
  set(v) {
    meetingStore.setMeetingBase(v)
  },
})
const users = computed(() => {
  return meetingStore.users
})

onMounted(async () => {
  await meetingStore.searchUsers()
})

const create = async () => {
  meetingStore.setInsertMode(true)
  meetingStore.setMeetingBase({
    mtg_id: 0,
    mtg_date: '',
    status: 0,
  })
  await meetingStore.searchTopics()
}

/**
 * 保存時イベント
 */
const save = async () => {
  // チェック
  if (meetingStore.meetingDetailsLength == 0) {
    alert('新規作成を押してから入力してください')
    return
  }
  if (!meetingBase.value.mtg_date) {
    alert('面談日を選択してください')
    return
  }
  if (!meetingBase.value.to_user_id) {
    alert('面談する人を選択してください')
    return
  }
  if (
    meetingBase.value.status == null ||
    meetingBase.value.status == undefined
  ) {
    alert('ステータスを選択してください')
    return
  }

  // 更新
  const data = {
    mtg_id: meetingBase.value.mtg_id,
    mtg_date: meetingBase.value.mtg_date,
    to_user_id: meetingBase.value.to_user_id,
    status: meetingBase.value.status,
    topics: meetingDetails.value,
  }

  const insertMode = meetingStore.insertMode

  insertMode
    ? await meetingStore.createMeeting(data)
    : await meetingStore.updateMeeting(data)

  await meetingStore.searchMeetings()
}
</script>
