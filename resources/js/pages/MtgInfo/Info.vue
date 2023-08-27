<script setup lang="ts"></script>
<template>
  <v-sheet class="pa-4" style="height: 88vh" rounded="lg" :elevation="2">
    <v-toolbar density="compact" color="white" rounded>
      <v-toolbar-title>
        <v-icon
          class="mr-3 mb-1"
          size="x-small"
          icon="fa-solid fa-circle-info"
          color="yellow-darken-2"
        >
        </v-icon>
        詳細情報
      </v-toolbar-title>
    </v-toolbar>
    <div class="divider-border"></div>
    <div>
      ※一覧からクリックされたIDを元にAPIで取ってきて、ＭＴＧ内容を表示予定
    </div>
  </v-sheet>
</template>
<style>
.divider-border {
  border-top: 3px solid #2962ff;
  margin-bottom: 12px;
}
</style>
