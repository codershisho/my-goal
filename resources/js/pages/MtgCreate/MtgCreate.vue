<script setup lang="ts">
import { ref, reactive } from 'vue'
import RequestChoise from '@/components/RequestChoise.vue'
import TopComponent from './TopComponent.vue'
</script>

<template>
  <v-sheet color="" class="pa-4" rounded="lg">
    <v-toolbar density="compact" color="white" class="" rounded>
      <v-toolbar-title>面談予定作成</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <div>
      <TopComponent />
    </div>
    <v-divider :thickness="5" class="my-5"></v-divider>
    <v-alert
      color="blue-accent-4"
      class="ml-4"
      border="start"
      title="トピック"
    />
    <div class="mt-5">
      <RequestChoise class="py-2" title="業務の進め方や進捗" />
      <RequestChoise class="py-2" title="人間関係" />
      <RequestChoise class="py-2" title="心身の状態" />
      <RequestChoise class="py-2" title="今後のキャリア" />
      <RequestChoise class="py-2" title="スキルや力の向上" />
      <RequestChoise class="py-2" title="プライベート" />
      <RequestChoise class="py-2" title="会社や部署の方針" />
    </div>
  </v-sheet>
</template>
