<template>
  <v-tooltip content-class="help-message" location="end">
    <template v-slot:activator="{ props }">
      <v-icon
        v-bind="props"
        icon="mdi:mdi-help-circle-outline"
        color="accent"
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
  background-color: rgb(var(--v-theme-accent)) !important;
  color: white !important;
}
</style>
