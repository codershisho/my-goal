<script setup lang="ts"></script>
<template>
  <v-sheet class="px-4 py-1 bg-backSub" style="height: 88vh" rounded="lg">
    <v-toolbar density="compact" class="bg-transparent" rounded>
      <v-toolbar-title class="a-card-title">
        <v-icon class="mr-2" size="x-small" color="icon">
          fa-solid fa-circle-info
        </v-icon>
        詳細情報
      </v-toolbar-title>
    </v-toolbar>
    <div class="border-section"></div>
    <div>
      ※一覧からクリックされたIDを元にAPIで取ってきて、ＭＴＧ内容を表示予定
    </div>
  </v-sheet>
</template>
