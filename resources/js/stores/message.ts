import { defineStore } from 'pinia'

export const useMessageStore = defineStore('my-goal-message', {
  state: () => ({
    _message: {
      title: '',
      text: '',
      level: 0,
    },
  }),

  getters: {
    message(state) {
      return state
    },
  },

  actions: {
    setMessage(title: string, message: string, level: number) {
      this._message.title = title
      this._message.text = message
      this._message.level = level
    },
  },
})
