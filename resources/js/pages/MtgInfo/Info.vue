<script setup lang="ts"></script>
<template>
  <v-sheet class="pa-4" style="height: 88vh" rounded="lg" :elevation="2">
    <v-toolbar density="compact" color="white" rounded>
      <v-toolbar-title>
        <i class="title-icon fa-solid fa-circle-info mr-3"></i>
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
