<template>
  <v-btn v-bind="$attrs" rounded="xl" variant="outlined">
    {{ label }}
  </v-btn>
</template>

<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

defineProps(['label'])
</script>
