<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'

// props
defineProps({
  modelValue: {
    type: Object,
    default: () => {},
  },
})
// emit
defineEmits(['update:modelValue'])

// data
const users = ref([])

// mounted
onMounted(async () => {
  const result = await axios.get('/api/my-goal/v1/users')
  users.value = result.data.data
})
// method
</script>
<template>
  <div class="d-flex">
    <div class="w-50 d-flex">
      <div class="label-base px-4 mr-5 text-textmain">
        <v-icon class="mr-3" color="icon" icon="mdi:mdi-archive-clock"></v-icon>
        日付
      </div>
      <VueDatePicker
        format="yyyy-MM-dd"
        week-start="0"
        locale="ja"
        :enable-time-picker="false"
        auto-apply
        model-type="yyyy-MM-dd"
        :model-value="modelValue.mtg_date"
        @update:model-value="(v) => (modelValue.mtg_date = v)"
      />
    </div>
    <div class="w-50 d-flex">
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
        :items="users"
        item-title="name"
        item-value="id"
        flat
        hide-details
        density="compact"
        variant="outlined"
        :model-value="modelValue.to_user_id"
        @update:modelValue="(v) => (modelValue.to_user_id = v)"
      ></v-autocomplete>
    </div>
  </div>
</template>
<style>
.label-base {
  flex-direction: row;
  justify-content: center;
  align-items: center;
  display: flex;
  width: 18%;
  /* background-color: #2962ff;
  color: white; */
  border-radius: 4px;
  /* margin-left: 16px; */
}

.dp__input {
  background-color: rgb(var(--v-theme-backinput)) !important;
  color: rgb(var(--v-theme-textmain)) !important;
}
</style>
