<template>
  <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
    <div class="d-flex mb-5">
      <div class="mr-6">検索条件</div>
      <HelpIcon
        message="「氏名」と「ステータス」で検索することができます<br>条件をクリアしたい場合は「クリア」を押して下さい"
      />
    </div>
    <s-text
      placeholder="氏名"
      bg-color="input"
      hide-details
      density="compact"
      preicon="fa-solid fa-magnifying-glass"
      v-model="searchText"
      @update:modelValue="filterName"
    />
    <v-sheet class="d-flex" color="input">
      <v-chip class="mr-3 mt-3" color="accent" @click="filterUnClose"
        >未実施</v-chip
      >
      <v-chip class="mr-3 mt-3" color="#B0BEC5" @click="filterClose"
        >実施済み</v-chip
      >
      <v-btn class="mt-2" variant="text" color="primary" @click="filterClear"
        >クリア</v-btn
      >
      <div v-if="authStore.user.role == 'admin'">
        <v-switch
          class="ml-10"
          hide-details
          inset
          color="accent"
          v-model="allSearch"
        >
          <template v-slot:label>
            <span class="text-accent font-weight-bold"
              >全件表示(admin only)</span
            >
          </template>
        </v-switch>
      </div>
    </v-sheet>
  </v-sheet>
  <v-sheet class="pa-6 mb-5 rounded-lg" color="input" elevation="1">
    <div class="d-flex mb-5">
      <div class="mr-6">ミーティング一覧</div>
      <HelpIcon
        message="行を選択すると、選択したミーティングの情報が右側に表示されます"
      />
    </div>
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
          v-for="(meeting, i) in meetingsFiltered"
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
            <v-chip label color="primary"> {{ meeting.from_user_name }}</v-chip>
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
import { ref, onMounted, computed } from 'vue'
import { _IMeeting } from '../../types/meeting'
import { useMeetingStore } from '../../stores/meeting'
import { useAuthStore } from '../../stores/auth'

const meetingStore = useMeetingStore()
const authStore = useAuthStore()
const searchText = ref('')

const meetingsFiltered = computed(() => {
  return meetingStore.meetingsFiltered
})

const allSearch = computed({
  get() {
    return meetingStore.allSearch
  },
  set(v) {
    meetingStore.setAllSearch(v)
    meetingStore.searchMeetings()
  },
})

meetingStore.searchMeetings()

const onClickRow = async (meeting: _IMeeting): Promise<void> => {
  meetingStore.setInsertMode(false)
  meetingStore.setSelectedMeetingId(meeting.mtg_id)
  await meetingStore.searchMeetingBase()
  await meetingStore.searchMeetingDetails()
}

const filterName = (searchText: string): void => {
  if (searchText == null) {
    meetingStore.filterClear()
    return
  }
  meetingStore.filterName(searchText)
}

const filterUnClose = (): void => {
  meetingStore.filterUnClose()
}

const filterClose = (): void => {
  meetingStore.filterClose()
}

const filterClear = () => {
  searchText.value = ''
  meetingStore.filterClear()
}
</script>
<style>
.meeting-table {
  cursor: pointer;
}
</style>
