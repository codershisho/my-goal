<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from './stores/auth'
import { useMessageStore } from './stores/message'
import { useRouter } from 'vue-router'
import { useTheme } from 'vuetify'

type menu = {
  id: number
  name: string
  url: string
}

const links: Array<menu> = [
  { id: 1, name: 'ダッシュボード', url: '/' },
  { id: 2, name: '面談情報', url: '/meeting' },
]

const authStore = useAuthStore()
const messageStore = useMessageStore()
const router = useRouter()
const darkTheme = ref(true)
const theme = useTheme()
const message = ref({
  title: '',
  text: '',
})
const snackbar = ref(false)

const attributes_snack = ref({
  'multi-line': true,
})

const logout = async () => {
  await authStore.logout()
  router.replace({ name: 'Login' })
}
const onChange = () => {
  darkTheme.value = !darkTheme.value
  theme.global.name.value = darkTheme.value ? 'customDark' : 'customLight'
}

messageStore.$subscribe((mutation, state) => {
  message.value.title = state._message.title
  message.value.text = state._message.text
  if (state._message.level != 0) {
  }
  snackbar.value = true
})
</script>

<template>
  <v-app>
    <v-app-bar color="first">
      <v-app-bar-title class="text-textlight"
        >目標進捗管理ツール</v-app-bar-title
      >
      <v-spacer></v-spacer>
      <v-btn icon @click="onChange">
        <v-icon
          :icon="!darkTheme ? 'mdi:mdi-weather-night' : 'mdi:mdi-weather-sunny'"
        ></v-icon>
      </v-btn>
      <v-btn
        class="mr-2 bg-first text-textlight"
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

    <v-main class="main px-16 bg-back">
      <router-view></router-view>
    </v-main>
    <v-snackbar
      v-model="snackbar"
      v-bind="attributes_snack"
      location="top right"
      :timeout="1000"
    >
      <div>
        {{ message.title }}
      </div>
      <div>
        {{ message.text }}
      </div>
      <template v-slot:actions>
        <v-btn
          density="compact"
          icon="mdi:mdi-close"
          size="small"
          @click="snackbar = false"
        />
      </template>
    </v-snackbar>
  </v-app>
</template>
