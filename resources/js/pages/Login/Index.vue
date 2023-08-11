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
  <div>login</div>
  <v-text-field
    placeholder="e-mail"
    variant="outlined"
    v-model="credentials.email"
  ></v-text-field>
  <v-text-field
    placeholder="password"
    variant="outlined"
    v-model="credentials.password"
  ></v-text-field>
  <v-btn color="primary" @click="login">送信</v-btn>
</template>
