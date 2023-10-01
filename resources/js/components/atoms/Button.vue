<template>
  <v-btn v-bind="$attrs">
    <template #prepend>
      <v-icon color="textmain" :icon="preicon"></v-icon>
    </template>
    <span class="text-textmain">{{ label }}</span>
  </v-btn>
</template>

<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})

defineProps(['label', 'preicon'])
</script>
