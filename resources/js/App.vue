<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import { useTheme } from 'vuetify'

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
const darkTheme = ref(false)
const theme = useTheme()

const logout = async () => {
  await authStore.logout()
  router.replace({ name: 'Login' })
}
const onChange = () => {
  darkTheme.value = !darkTheme.value
  theme.global.name.value = darkTheme.value ? 'customDark' : 'customLight'
}
</script>

<template>
  <v-app>
    <v-app-bar color="backsub">
      <v-app-bar-title class="text-textmain"
        >目標進捗管理ツール</v-app-bar-title
      >
      <v-spacer></v-spacer>
      <v-btn icon @click="onChange">
        <v-icon
          :icon="!darkTheme ? 'mdi:mdi-weather-night' : 'mdi:mdi-weather-sunny'"
        ></v-icon>
      </v-btn>
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

    <v-main class="main px-16 overflow-y-auto bg-backmain">
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<style>
.main {
  margin-top: 20px;
  padding-bottom: 20px !important;
}
</style>
