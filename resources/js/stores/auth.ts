import { defineStore } from 'pinia'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

export const useAuthStore = defineStore('auth', {
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
      console.log('---login start---')
      if (this._isAuth) {
        router.replace({ name: 'Dashboard' })
        return
      }
      await axios.get('/sanctum/csrf-cookie')
      const res = await axios.post('/api/auth/login', credentials)
      if (res.status == 200) {
        console.log('---login success---')
        console.log('---get login user ---')
        const user = await axios.get('/api/user')
        if (user.status == 200) {
          console.log('---get login user success ---')
          this._isAuth = true
          this._user = user.data
        }
      }
      console.log('---login end---')
    },
  },
})
