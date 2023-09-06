<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useMeetingStore } from '@/stores/mtg'

// data
const meetingStore = useMeetingStore()

// const meetingInfo = meetingStore.getMtg
</script>
<template>
  <v-sheet class="px-4 info-sheet bg-backSub" style="height: 88vh" rounded="lg">
    <div class="header-sticky">
      <v-toolbar density="compact" class="bg-transparent" rounded>
        <v-toolbar-title class="a-card-title">
          <v-icon class="mr-2" size="x-small" color="icon">
            fa-solid fa-circle-info
          </v-icon>
          詳細情報
        </v-toolbar-title>
      </v-toolbar>
      <div class="border-section"></div>
    </div>
    <div v-for="info in meetingStore.meetingInfos" class="my-2">
      <div class="topic rounded-t-lg">
        <div class="name text-textlight">{{ info.topic_name }}</div>
        <div class="detail text-textlight">{{ info.topic_detail_name }}</div>
      </div>
      <div class="d-flex">
        <div
          class="from--memo w-50 rounded-bs-lg"
          v-html="info.from_memo"
        ></div>
        <div class="to--memo w-50 rounded-be-lg" v-html="info.to_memo"></div>
      </div>
    </div>
  </v-sheet>
</template>

<style>
.info-sheet {
  overflow-y: scroll;
  /*IE(Internet Explorer)・Microsoft Edgeへの対応*/
  -ms-overflow-style: none;
  /*Firefoxへの対応*/
  scrollbar-width: none;
}
.info-sheet::-webkit-scrollbar {
  display: none;
}
.header-sticky {
  position: sticky;
  top: 0;
  z-index: 1;
  background-color: rgb(var(--v-theme-backSub));
}
.topic {
  background-color: rgb(var(--v-theme-second));
  padding: 10px;
  /* margin: 4px 0px; */
}
.topic > .name {
  font-size: 1.25rem;
  letter-spacing: 0.125rem;
  font-weight: 600;
}
.from--memo {
  background-color: rgb(var(--v-theme-frommemo));
  min-height: 200px;
}
.to--memo {
  background-color: rgb(var(--v-theme-tomemo));
  min-height: 200px;
}
</style>
