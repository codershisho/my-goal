<script setup lang="ts">
import { ref, reactive } from 'vue'
import { useAuthStore } from '@/stores/auth'
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
  router.replace({ name: 'Dashboard' })
}
</script>
<template>
  <v-sheet
    class="pa-10 mx-auto login-wrap"
    :elevation="2"
    rounded="lg"
    :width="600"
    :height="500"
  >
    <div class="label">ユーザー名</div>
    <v-text-field
      placeholder="e-mail"
      variant="outlined"
      v-model="credentials.email"
    ></v-text-field>
    <div class="label">パスワード</div>
    <v-text-field
      placeholder="password"
      variant="outlined"
      v-model="credentials.password"
    ></v-text-field>
    <v-btn class="w-100" style="height: 60px" color="primary" @click="login">
      <div class="label-btn">ログイン</div>
    </v-btn>
  </v-sheet>
</template>

<style>
.login-wrap .label {
  font-size: 1.25rem;
  margin-bottom: 0.85rem;
}
.login-wrap .label-btn {
  font-size: 1.25rem;
}
</style>
