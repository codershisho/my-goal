<template>
  <div class="page d-flex">
    <div class="w-30 mr-5">
      <MeetingInfosTable />
    </div>
    <div class="w-70">
      <MeetingEdit />
    </div>
  </div>
</template>

<script setup lang="ts">
import MeetingInfosTable from './MeetingInfosTable.vue'
import MeetingEdit from './MeetingEdit.vue'
</script>
