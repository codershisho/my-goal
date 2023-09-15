<template>
  <div id="meeting-edit">
    <div class="header">
      <div>日付</div>
      <VueDatePicker
        format="yyyy-MM-dd"
        week-start="0"
        locale="ja"
        :enable-time-picker="false"
        auto-apply
        model-type="yyyy-MM-dd"
        v-model="meetingBase.mtg_date"
      />
      <v-autocomplete
        label="面談者"
        :items="users"
        item-value="id"
        item-title="name"
        v-model="meetingBase.to_user_id"
      ></v-autocomplete>
      <v-autocomplete
        label="ステータス"
        :items="[
          { id: 0, name: '未実施' },
          { id: 1, name: '実施済み' },
        ]"
        item-value="id"
        item-title="name"
        v-model="meetingBase.status"
      ></v-autocomplete>
      <div>
        <v-btn @click="create">新規</v-btn>
        <v-btn @click="save">保存</v-btn>
      </div>
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
