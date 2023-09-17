<template>
  <div class="page meeting-setting d-flex">
    <div class="w-30 mr-2">
      <v-card class="pa-6 card-wrapper">
        <MeetingInfosTable />
      </v-card>
    </div>
    <div class="w-70 mr-2">
      <v-card class="card-wrapper">
        <MeetingEdit />
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import MeetingInfosTable from './MeetingInfosTable.vue'
import MeetingEdit from './MeetingEdit.vue'
</script>

<style>
.card-wrapper {
  height: 88vh;
  overflow-y: scroll !important;
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.card-wrapper::-webkit-scrollbar {
  display: none;
}
</style>
