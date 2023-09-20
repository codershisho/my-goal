<template>
  <div id="meeting-edit">
    <div class="header pa-6">
      <div class="d-flex">
        <s-btn
          class="me-auto text-white"
          preicon="fa-solid fa-plus"
          label="新規"
          color="newbtn"
          width="150"
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
      <div class="d-flex align-center mt-5">
        <div class="input-label text-lg mr-3">日付</div>
        <VueDatePicker
          class="w-50"
          format="yyyy-MM-dd"
          week-start="0"
          locale="ja"
          :enable-time-picker="false"
          auto-apply
          model-type="yyyy-MM-dd"
          v-model="meetingBase.mtg_date"
        />
      </div>
      <div class="d-flex mt-5 align-center">
        <div class="input-label text-lg mr-3">面談者</div>
        <v-autocomplete
          class="w-25"
          :items="users"
          item-value="id"
          item-title="name"
          variant="outlined"
          bg-color="input"
          density="compact"
          hide-details
          v-model="meetingBase.to_user_id"
        ></v-autocomplete>
        <div class="input-label text-lg mx-3">ステータス</div>
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
      <div class="mt-4 stickey-border"></div>
    </div>
    <div class="body pa-6">
      <!-- {{ meetingDetails }} -->
      <div v-for="(detail, i) in meetingDetails" :key="i" class="mb-5">
        <v-checkbox
          class="topic--base mb-1 pl-4"
          :label="detail.topic_name"
          v-model="detail.checked"
          density="compact"
          hide-details
        ></v-checkbox>
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
          <div class="pl-4 mt-5">
            <div class="py-2 pl-2 mb-2 memo">自分用メモ</div>
            <TinyMCEMeeting v-model="detail.from_memo" />
          </div>
          <div class="pl-4 mt-5">
            <div class="py-2 pl-2 mb-2 memo">面談者メモ</div>
            <TinyMCEMeeting v-model="detail.to_memo" />
          </div>
        </template>
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
import TinyMCEMeeting from '../../components/TinyMCEMeeting.vue'

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

<style>
.topic--base {
  background-color: rgb(var(--v-theme-bInputLabel));
  color: rgb(var(--v-theme-fInputLabel));
  opacity: 1;
  font-weight: 500;
  border-radius: 4px;
}
.memo {
  background-color: rgba(var(--v-theme-bInputSubLabel), 1);
  color: rgba(var(--v-theme-fInputSubLabel), 0.85);
  border-radius: 5px;
}

.stickey-border {
  border-top: 1px solid rgb(216, 216, 216);
  background-color: rgb(var(--v-theme-input));
}
.header {
  position: sticky;
  top: 0;
  z-index: 10;
  height: 210px;
  background-color: rgb(var(--v-theme-input));
}
</style>
