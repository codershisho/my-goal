<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useTheme } from 'vuetify'
import { useMeetingStore } from '../stores/meeting'
import TinyMCE from '@/components/TinyMCE.vue'

// store
const meetingStore = useMeetingStore()

// data
let _model = ref(meetingStore.editTopics)
const isLoading = ref(true);

meetingStore.$subscribe((mutation, state) => {
  _model.value = state._editModel.topics
})

onMounted(async () => {
  await meetingStore.fetchTopics()
  await meetingStore.fetchUsers()
  isLoading.value = false;
})

const input = (i: number) => {
  // store updte
  meetingStore.setTopics(_model.value[i], i)
}
</script>

<template>
  <div v-if="!isLoading" class="request-form" v-for="(topic, i) in meetingStore.topics" :key="i">
    <v-checkbox
      class="ml-16 pl-5 checkbox bg-backinput"
      hide-details
      density="compact"
      v-model="_model[i].checked"
      @input="input(i)"
    >
      <template #label>
        <div class="pl-3 py-3 w-100">
          {{ topic.topic_name }}
        </div>
      </template>
    </v-checkbox>
    <v-radio-group
      hide-details
      inline
      v-model="_model[i].selected"
      @input="input(i)"
    >
      <v-radio
        style="width: 33%"
        class="text-textmain"
        v-for="(detail, i) in topic.details"
        :key="i"
        :label="detail.topic_detail_name"
        :value="detail.topic_detail_id"
      ></v-radio>
    </v-radio-group>
  </div>
</template>
