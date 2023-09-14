import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _selectedMeetingId: 0,
  }),

  getters: {
    selectedMeetingId(state) {
      return state._selectedMeetingId
    },
  },

  actions: {
    setSelectedMeetingId(id: number): void {
      this._selectedMeetingId = id
    },
  },
})
