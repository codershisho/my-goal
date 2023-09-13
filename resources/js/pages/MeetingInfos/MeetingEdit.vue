<script setup lang="ts">
import { ref } from 'vue'
import { useMeetingStore } from '../../stores/meeting'
import RequestChoise from '../../components/RequestChoise.vue'

const meetingStore = useMeetingStore()

let _model = ref(meetingStore.editModel)

const input = () => {
  // store updte
  meetingStore.setMtgDate(_model.value.mtg_date)
  meetingStore.setToUserId(_model.value.to_user_id)
}
const save = () => {
  // create api call
  meetingStore.storeMeeting()
}

meetingStore.$subscribe((mutation, state) => {
  _model.value = state._editModel
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
          v-model="_model.mtg_date"
          @input="input"
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
          v-model="_model.to_user_id"
          @input="input"
        ></v-autocomplete>
      </div>
      <div>
        <!-- <template > -->
        <RequestChoise />
        <!-- </template> -->
      </div>
      <v-btn @click="save">保存</v-btn>
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
