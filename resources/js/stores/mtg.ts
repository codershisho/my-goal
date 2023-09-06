import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _mtg: {},
  }),

  getters: {
    meetingInfos(state) {
      return state._mtg
    },
  },

  actions: {
    setMtg(val) {
      this._mtg = val
    },
  },
})
