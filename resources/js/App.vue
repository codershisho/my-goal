<script setup lang="ts">
type menu = {
  id: number
  name: string
  url: string
}

const links: Array<menu> = [
  { id: 1, name: 'ダッシュボード', url: '/' },
  { id: 2, name: '面談情報', url: '/mtg/infos' },
  { id: 3, name: '面談作成', url: '/mtg/create' },
]
</script>

<template>
  <v-app id="inspire">
    <v-app-bar color="blue-accent-4">
      <v-toolbar-title>目標進捗管理ツール</v-toolbar-title>
      <v-btn
        color="white"
        class="mr-2"
        variant="flat"
        v-for="link in links"
        :key="link.id"
        :to="link.url"
      >
        {{ link.name }}
      </v-btn>
    </v-app-bar>

    <v-main style="background-color: #ebebeb">
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>
