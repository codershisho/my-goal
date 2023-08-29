<script setup lang="ts"></script>
<template>
  <v-sheet
    class="pa-4 bg-backsub"
    style="height: 88vh"
    rounded="lg"
    :elevation="2"
  >
    <v-toolbar density="compact" class="mb-2 pl-3 bg-backtitle" rounded>
      <v-toolbar-title>
        <v-icon class="mr-3 mb-1" size="x-small" color="icon">
          fa-solid fa-circle-info
        </v-icon>
        詳細情報
      </v-toolbar-title>
    </v-toolbar>
    <div>
      ※一覧からクリックされたIDを元にAPIで取ってきて、ＭＴＧ内容を表示予定
    </div>
  </v-sheet>
</template>
