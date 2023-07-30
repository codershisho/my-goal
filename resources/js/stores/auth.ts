import { defineStore } from 'pinia'

export const authStore = defineStore('auth', {
  state: () => ({
    name: '原神',
    version: '2.6',
    gacha: 0,
  }),
  getters: {
    //filterとか
  },
  actions: {
    //値をsetするとか
  },
})
