<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'
import RequestChoise from '@/components/RequestChoise.vue'
import TopComponent from './TopComponent.vue'
// data
const topics = ref([])
const header = reactive({
  mtg_date: null,
  from_user_id: null,
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
    status: 0,
    from_user_id: 1,
    to_user_id: 1,
    details: bodies,
  }
  const result = await axios.post('/api/my-goal/v1/mtgs', data)
  console.log(data)
}
</script>

<template>
  <v-sheet color="" class="pa-4" rounded="lg">
    <v-toolbar density="compact" color="white" class="" rounded>
      <v-toolbar-title>面談予定作成</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <div>
      <TopComponent v-model="header" />
    </div>
    <v-divider :thickness="5" class="my-5"></v-divider>
    <v-alert
      color="blue-accent-4"
      class="ml-4"
      border="start"
      title="トピック"
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
    <v-btn color="success" @click="save">保存</v-btn>
  </v-sheet>
</template>
