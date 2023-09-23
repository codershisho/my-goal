<template>
  <div id="meeting-edit">
    <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
      <div class="d-flex">
        <s-btn
          class="me-auto text-white"
          preicon="fa-solid fa-plus"
          label="新規"
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
import { onMounted, ref } from 'vue'
import { _IMeeting, _IMeetingDetail } from '../../types/meeting'
import {
  createMeeting,
  fetchMeetingBase,
  fetchMeetingDetail,
  fetchTopics,
  fetchUsers,
  updateMeeting,
} from './ApiMeeting'
import { _IUser } from '../../types/user'
import RichTextEditor from '../../components/QuillEditor.vue'

const meetingStore = useMeetingStore()

const meetingDetails = ref<_IMeetingDetail[]>()
const createModel = ref<_IMeetingDetail[]>()
const meetingBase = ref<_IMeeting>({
  mtg_id: 0,
  mtg_date: '',
  status: 0,
})
const users = ref<_IUser[]>()
let insertMode = true

onMounted(async () => {
  // 新規作成時に使用するためトピック情報を取得
  createModel.value = await fetchTopics()
  meetingDetails.value = createModel.value
  // プルダウンのユーザー取得
  users.value = await fetchUsers()
})

/**
 * idの変更を監視し、データの更新を実施
 */
meetingStore.$subscribe(async (mutation, state) => {
  meetingBase.value = await fetchMeetingBase(state._selectedMeetingId)
  meetingDetails.value = await fetchMeetingDetail(state._selectedMeetingId)
  changeMode(false)
})

/**
 * 登録/更新のモード判定
 * @param insertFlag
 */
const changeMode = (insertFlag: boolean) => {
  insertMode = insertFlag
}

/**
 * 新規作成時イベント
 */
const create = () => {
  changeMode(true)
  meetingDetails.value = createModel.value
  meetingBase.value.mtg_date = ''
  meetingBase.value.status = 0
  meetingBase.value.to_user_id = undefined
}

/**
 * 保存時イベント
 */
const save = async () => {
  // 更新
  const data = {
    mtg_id: meetingBase.value.mtg_id,
    mtg_date: meetingBase.value.mtg_date,
    to_user_id: meetingBase.value.to_user_id,
    status: meetingBase.value.status,
    topics: meetingDetails.value,
  }
  if (insertMode) {
    await createMeeting(data)
    return
  }
  await updateMeeting(data)
}
</script>
