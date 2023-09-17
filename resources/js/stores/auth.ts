import { defineStore } from 'pinia'
import axios from 'axios'

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
        this.router.push('/')
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
    },
    /**
     * サーバーとの認証切れの際に認証情報をクリアする関数
     */
    authClear() {
      this._isAuth = false
      this._user = null
    },
  },
  persist: true,
})
