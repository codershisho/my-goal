<template>
  <v-btn v-bind="$attrs" :prepend-icon="preicon">
    {{ label }}
  </v-btn>
</template>

<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

defineProps(['label', 'preicon'])
</script>
