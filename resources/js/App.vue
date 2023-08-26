<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

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

const authStore = useAuthStore()
const router = useRouter()

const logout = async () => {
  await authStore.logout()
  router.replace({ name: 'Login' })
}
</script>

<template>
  <v-app>
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
      <v-btn color="grey" class="mr-2" variant="flat" @click="logout">
        ログアウト
      </v-btn>
    </v-app-bar>

    <v-main class="main px-16 overflow-y-auto">
      <router-view style="height: 100%"></router-view>
    </v-main>
  </v-app>
</template>

<style>
.main {
  margin-top: 20px;
  padding-bottom: 20px !important;
  background-color: #ebebeb;
}
</style>
