<script setup lang="ts">
import MeetingInfosTable from './MeetingInfosTable.vue'
import MeetingEdit from './MeetingEdit.vue'
</script>

<template>
  <div class="d-flex">
    <div class="w-25 mr-2">
      <MeetingInfosTable />
    </div>
    <div class="w-75 mr-2">
      <MeetingEdit />
    </div>
  </div>
</template>
