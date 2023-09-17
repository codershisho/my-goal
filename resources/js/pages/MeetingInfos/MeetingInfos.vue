<template>
  <div class="page meeting-setting d-flex">
    <div class="w-30 mr-2">
      <v-card class="pa-6">
        <MeetingInfosTable />
      </v-card>
    </div>
    <div class="w-70 mr-2">
      <v-card class="pa-6">
        <MeetingEdit />
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import MeetingInfosTable from './MeetingInfosTable.vue'
import MeetingEdit from './MeetingEdit.vue'
</script>
