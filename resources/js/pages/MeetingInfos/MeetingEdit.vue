<template>
  <div id="meeting-edit">
    <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
      <div class="d-flex mb-5">
        <div class="mr-6">ミーティング基本情報</div>
        <HelpIcon
          message="新規の場合：「新規作成ボタン」を押下後に入力を開始し、入力をお願いします<br>こちらの項目は全て必須です"
        />
      </div>
      <div class="d-flex">
        <v-btn
          class="me-auto rounded-pill"
          preicon="fa-solid fa-plus"
          color="newbtn"
          width="150"
          variant="outlined"
          @click="create"
        >
          新規作成する
        </v-btn>
        <s-btn
          class="rounded-pill"
          preicon="fa-regular fa-floppy-disk"
          label="保存"
          color="primary"
          width="150"
          @click="save"
        />
      </div>
      <div class="d-flex mt-5">
        <div class="w-50 d-flex align-stretch align-center">
          <div class="w-50">
            <v-alert
              class="mr-3"
              border="start"
              variant="tonal"
              color="secondary"
              text="日付"
              density="compact"
            />
          </div>
          <div class="w-50">
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
        <div class="ml-2 w-50 d-flex align-stretch align-center">
          <div class="w-50">
            <v-alert
              class="mr-3"
              border="start"
              variant="tonal"
              color="secondary"
              text="ステータス"
              density="compact"
            />
          </div>
          <div class="w-50">
            <v-autocomplete
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
        </div>
      </div>
      <div class="d-flex mt-2">
        <div class="w-50 d-flex align-stretch">
          <div class="w-50">
            <v-alert
              class="mr-3"
              border="start"
              variant="tonal"
              color="secondary"
              text="面談される人"
              density="compact"
            />
          </div>
          <div class="w-50">
            <v-autocomplete
              :items="users"
              item-value="id"
              item-title="name"
              variant="outlined"
              bg-color="input"
              density="compact"
              hide-details
              placeholder="面談相手を選択..."
              v-model="meetingBase.to_user_id"
            ></v-autocomplete>
          </div>
        </div>
        <div class="ml-2 w-50 d-flex align-stretch">
          <div class="w-50">
            <v-alert
              class="mr-3"
              border="start"
              variant="tonal"
              color="secondary"
              text="面談する人"
              density="compact"
            />
          </div>
          <div class="w-50">
            <v-autocomplete
              :items="users"
              item-value="id"
              item-title="name"
              variant="outlined"
              bg-color="input"
              density="compact"
              hide-details
              placeholder="面談相手を選択..."
              v-model="meetingBase.to_user_id"
            ></v-autocomplete>
          </div>
        </div>
      </div>
    </v-sheet>
    <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
      <div class="d-flex mb-5">
        <div class="mr-6">ミーティング詳細情報</div>
        <HelpIcon
          message="話をしたいトピックを選択して、さらに実施したい項目を選択してください<br>メモ欄は事前に話したいことなどをメモするなどにお使いください<br>メモ欄に記載した内容は暗号化され保存されますが、それでも気になる方は詳細の記述はお控えください"
        />
      </div>
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
              variant="flat"
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
              variant="flat"
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
<style>
.dp__main input {
  background-color: rgb(var(--v-theme-input)) !important;
  color: rgb(var(--v-theme-contract)) !important;
}
</style>
