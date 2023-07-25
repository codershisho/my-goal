<script setup lang="ts">
import { ref, reactive } from 'vue'
import RequestChoise from '@/components/RequestChoise.vue'
</script>

<template>
  <v-sheet color="" class="pa-4" rounded="lg">
    <v-toolbar density="compact" color="white" class="" rounded>
      <v-toolbar-title>面談予定作成</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <div>
      <div class="d-flex">
        <div class="w-50 d-flex">
          <div class="label-base px-4 mr-5">日付</div>
          <v-text-field
            placeholder="日付を選択"
            variant="outlined"
            flat
            hide-details
            density="compact"
          ></v-text-field>
        </div>
        <div class="w-50 d-flex">
          <div class="label-base px-4 mr-5">面談する人</div>
          <v-autocomplete
            placeholder="選択…"
            :items="[
              'California',
              'Colorado',
              'Florida',
              'Georgia',
              'Texas',
              'Wyoming',
            ]"
            flat
            hide-details
            density="compact"
            variant="outlined"
          ></v-autocomplete>
        </div>
      </div>
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

<style scoped>
.label-base {
  flex-direction: column;
  justify-content: center;
  align-items: center;
  display: flex;
  width: 20%;
  background-color: #2962ff;
  color: white;
  border-radius: 4px;
  margin-left: 16px;
}
</style>
