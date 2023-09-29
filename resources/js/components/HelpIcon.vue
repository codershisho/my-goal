<template>
  <v-tooltip content-class="help-message" location="end">
    <template v-slot:activator="{ props }">
      <v-icon
        v-bind="props"
        icon="mdi:mdi-help-circle-outline"
        color="red"
      ></v-icon>
    </template>
    <span v-html="props.message"></span>
  </v-tooltip>
</template>

<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

const props = defineProps(['message'])
</script>

<style>
.help-message {
  background-color: red !important;
  color: white !important;
}
</style>
