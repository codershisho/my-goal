<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useMeetingStore } from '../../stores/meeting'
import RequestChoise from '../../components/RequestChoise.vue'

const meetingStore = useMeetingStore()

// type
type _TMeetingInfo = {
  mtg_date: String
  to_user_id: Number
}

// data
const model = ref<_TMeetingInfo>({
  mtg_date: '',
  to_user_id: 0,
})
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
    <div>
      <div class="d-flex">
        <div class="label-base px-4 mr-5 text-textmain">
          <v-icon
            class="mr-3"
            color="icon"
            icon="mdi:mdi-archive-clock"
          ></v-icon>
          日付
        </div>
        <VueDatePicker
          format="yyyy-MM-dd"
          week-start="0"
          locale="ja"
          :enable-time-picker="false"
          auto-apply
          model-type="yyyy-MM-dd"
          v-model="model.mtg_date"
        />
      </div>
      <div class="d-flex">
        <div class="label-base px-4 mr-5 text-textmain">
          <v-icon
            class="mr-3"
            color="icon"
            icon="mdi:mdi-account-arrow-right"
          ></v-icon>
          面談する人
        </div>
        <v-autocomplete
          bg-color="backinput"
          placeholder="選択…"
          :items="meetingStore.users"
          item-title="name"
          item-value="id"
          flat
          hide-details
          density="compact"
          variant="outlined"
          v-model="model.to_user_id"
        ></v-autocomplete>
      </div>
      <div>
        <template v-for="(topic, index) in meetingStore.topics" :key="index">
          <div>ss</div>
        </template>
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
