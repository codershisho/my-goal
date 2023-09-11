import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _mtg: {},
    _topics: [],
    _users: [],
  }),

  getters: {
    meetingInfos(state) {
      return state._mtg
    },
    topics(state) {
      return state._topics
    },
    users(state) {
      return state._users
    },
  },

  actions: {
    setMtg(val) {
      this._mtg = val
    },
    setTopics(topics: Array) {
      this._topics = topics
    },
    setUsers(users: Array) {
      this._users = users
    },
  },
})
