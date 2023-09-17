<script setup lang="ts">
import { ref, computed } from 'vue'
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

const message = ref(
  computed(() => {
    return messageStore._message
  })
)

const snackbar = ref(
  computed({
    get() {
      return !!messageStore._message.text
    },
    set(val) {
      messageStore.resetMessage()
      return val
    },
  })
)

const attributes_snack = ref({
  'multi-line': true,
  color: 'info',
})

const logout = async () => {
  await authStore.logout()
  router.replace({ name: 'Login' })
}
const onChange = () => {
  darkTheme.value = !darkTheme.value
  theme.global.name.value = darkTheme.value ? 'customDark' : 'customLight'
}

const closeSnack = () => {
  messageStore.resetMessage()
}
</script>

<template>
  <v-app>
    <v-app-bar
      v-if="authStore._isAuth"
      :class="darkTheme ? `navi--dark` : 'navi--light'"
    >
      <v-app-bar-title class="text-textmain"> My Goal </v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn icon @click="onChange">
        <v-icon
          color="input"
          :icon="!darkTheme ? 'mdi:mdi-weather-night' : 'mdi:mdi-weather-sunny'"
        ></v-icon>
      </v-btn>
      <v-btn
        class="mr-2"
        color="input"
        variant="text"
        v-for="link in links"
        :key="link.id"
        :to="link.url"
      >
        {{ link.name }}
      </v-btn>
      <v-btn class="mr-2" color="input" variant="text" @click="logout">
        ログアウト
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view></router-view>
    </v-main>
    <v-snackbar
      v-model="snackbar"
      v-bind="attributes_snack"
      location="top right"
      :timeout="2000"
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
          @click="closeSnack"
        />
      </template>
    </v-snackbar>
  </v-app>
</template>
<style>
.navi--light {
  background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.452),
      rgba(107, 130, 227, 0.71)
    ),
    url('https://source.unsplash.com/v8QdhKbOoC0') !important;
  background-size: cover !important;
}

.navi--dark {
  background: linear-gradient(90deg, rgba(13, 13, 13, 0.44), rgba(0, 0, 0, 1)),
    url('https://source.unsplash.com/35EIRn2T6FQ') !important;
  background-size: cover !important;
  background-position: -500px -200px;
}
</style>
