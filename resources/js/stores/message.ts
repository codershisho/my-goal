import { defineStore } from 'pinia'

export const useMessageStore = defineStore('my-goal-message', {
  state: () => ({
    _message: {
      title: null,
      text: null,
      level: 0,
    },
  }),

  getters: {
    message(state) {
      return state
    },
  },

  actions: {
    setMessage(title, message, level) {
      this._message.title = title
      this._message.text = message
      this._message.level = level
    },
  },
})
