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
  topics.value.forEach((e) => {
    bodies.push({
      topic_detail_id: null,
      from_memo: '',
      to_memo: '',
    })
  })
})

// method
const save = async () => {
  const data = {
    mtg_date: header.mtg_date,
    to_user_id: header.to_user_id,
    details: bodies,
  }
  const result = await axios.post('/api/my-goal/v1/mtgs', data)
  console.log(data)
}
</script>

<template>
  <v-sheet class="pa-4 bg-backsub" rounded="lg">
    <v-toolbar density="compact" class="mb-2 pl-3 bg-backtitle" rounded>
      <v-toolbar-title>
        <v-icon class="mr-3 mb-1" size="x-small" color="icon">
          fa-solid fa-circle-info
        </v-icon>
        面談予定作成
      </v-toolbar-title>
      <v-spacer />
      <v-btn color="success" variant="flat" @click="save">
        <v-icon class="mr-3" color="white" icon="mdi:mdi-content-save">
        </v-icon>
        保存
      </v-btn>
    </v-toolbar>
    <div class="mb-6">
      <TopComponent v-model="header" />
    </div>
    <v-alert
      color="primary"
      border="start"
      title="トピック"
      density="compact"
      icon="mdi:mdi-account-voice"
    />
    <div class="mt-5">
      <RequestChoise
        v-for="(topic, index) in topics"
        :key="index"
        class="py-2"
        :title="topic.topic_name"
        :details="topic.details"
        v-model="bodies[index]"
      />
    </div>
  </v-sheet>
</template>
