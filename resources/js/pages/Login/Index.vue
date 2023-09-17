<script setup lang="ts">
import { ref, reactive } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const credentials = reactive<{ email: string; password: string }>({
  email: 'aaa@example.com',
  password: 'hogehoge',
})

/**
 * ログイン処理
 * - 認証に通ったらダッシュボードに遷移
 */
async function login() {
  await authStore.login(credentials)
  router.push('/')
}
</script>
<template>
  <v-sheet
    class="pa-10 mx-auto background--img"
    :elevation="2"
    rounded="lg"
    :width="600"
    :height="500"
  >
    <s-text v-model="credentials.email" label="ユーザー名" placeholder="bbb" />
    <s-text
      v-model="credentials.password"
      label="パスワード"
      placeholder="password"
    />
    <s-btn label="ログイン" block @click="login" />
  </v-sheet>
</template>

<style>
.background--img {
  background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.452),
      rgba(116, 41, 104, 0.692)
    ),
    url('https://source.unsplash.com/Ml8WeLdCnRU');
}
</style>
