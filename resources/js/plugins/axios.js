import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
const axiosPlugin = {
  install(app, options) {
    axios.defaults.baseURL = options.baseURL

    // store
    const authStore = useAuthStore()

    // request
    axios.interceptors.request.use((config) => {
      return config
    })

    // response
    axios.interceptors.response.use(
      (response) => response,
      (error) => {
        // 認証切れの場合
        if (error.response.status === 401) {
          if (authStore.isAuth) {
            // 認証が生きている場合はクリア（ログアウト）
            authStore.authClear()
            alert('認証切れ')
            window.location.href = '/login'
          }
        }
        return Promise.reject(error)
      }
    )

    app.provide('axios', axios)
  },
}
export default axiosPlugin
