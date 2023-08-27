import { defineStore } from 'pinia'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

export const useAuthStore = defineStore('my-goal-auth', {
  state: () => ({
    _isAuth: false,
    _user: null,
  }),
  getters: {
    isAuth(state) {
      return state._isAuth
    },
    user(state) {
      return state._user
    },
  },
  actions: {
    async login(credentials) {
      if (this._isAuth) {
        router.replace({ name: 'Dashboard' })
        return
      }
      await axios.get('/sanctum/csrf-cookie')
      const res = await axios.post('/api/auth/login', credentials)
      if (res.status == 200) {
        const user = await axios.get('/api/user')
        if (user.status == 200) {
          this._isAuth = true
          this._user = user.data
        }
      }
    },
    async logout() {
        const res = await axios.post('/api/auth/logout')
        if (res.status == 200) {
            this._isAuth = false
            this._user = null
        }
    }
  },
  persist: true,
})
