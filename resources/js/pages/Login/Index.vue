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
  <div class="login w-100 h-100">
    <div class="d-flex justify-center">
      <div class="w-50 mt-16">
        <s-text
          v-model="credentials.email"
          label="ユーザー名"
          placeholder="bbb"
        />
        <s-text
          v-model="credentials.password"
          label="パスワード"
          placeholder="password"
        />
        <v-btn
          class="mt-6"
          block
          size="x-large"
          variant="tonal"
          color="white"
          @click="login"
        >
          ログイン
        </v-btn>
      </div>
    </div>
  </div>
</template>

<style>
.login {
  background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.452),
      rgba(57, 54, 93, 0.692)
    ),
    url('https://source.unsplash.com/fzOITuS1DIQ') !important;
  background-size: cover !important;
}
</style>
