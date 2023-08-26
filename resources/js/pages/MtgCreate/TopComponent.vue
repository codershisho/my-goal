<script setup lang="ts">
import { ref, reactive } from 'vue'

// props
defineProps({
  modelValue: {
    type: Object,
    default: () => {},
  },
})
// emit
defineEmits(['update:modelValue'])
</script>
<template>
  <div class="d-flex">
    <div class="w-50 d-flex">
      <div class="label-base px-4 mr-5">日付</div>
      <v-text-field
        placeholder="日付を選択"
        variant="outlined"
        flat
        hide-details
        density="compact"
        :value="modelValue.mtg_date"
        @update:modelValue="(v) => (modelValue.mtg_date = v)"
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
