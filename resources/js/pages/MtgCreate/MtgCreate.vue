<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'
import RequestChoise from '@/components/RequestChoise.vue'
import TopComponent from './TopComponent.vue'
// data
const topics = ref([])
const header = reactive({
  mtg_date: null,
  to_user_id: null,
})
const bodies = reactive([])

// mounted
onMounted(async () => {
  const result = await axios.get('/api/my-goal/v1/topics')
  topics.value = result.data.data
})

// method
const save = async () => {
  const data = {
    mtg_date: header.mtg_date,
    to_user_id: header.to_user_id,
    topics: topics.value,
  }
  const result = await axios.post('/api/my-goal/v1/mtgs', data)
  console.log(data)
}
</script>

<template>
  <v-sheet class="px-4 py-1 bg-backSub" rounded="lg">
    <v-toolbar density="compact" class="bg-transparent" rounded>
      <v-toolbar-title class="a-card-title">
        <v-icon class="mr-2" size="x-small" color="icon">
          fa-solid fa-circle-info
        </v-icon>
        面談予定作成
      </v-toolbar-title>
      <v-spacer />
      <v-btn color="first" variant="flat" @click="save">
        <v-icon class="mr-3" color="back" icon="mdi:mdi-content-save"> </v-icon>
        保存
      </v-btn>
    </v-toolbar>
    <div class="border-section"></div>
    <div class="my-6">
      <TopComponent v-model="header" />
    </div>
    <v-alert
      color="second"
      border="start"
      title="トピック"
      density="compact"
      icon="mdi:mdi-account-voice"
    />
    <div class="mt-5">
      <template v-for="(topic, index) in topics" :key="index">
        <RequestChoise class="py-2" v-model="topics[index]" />
      </template>
    </div>
  </v-sheet>
</template>
