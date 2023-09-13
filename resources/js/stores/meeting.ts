import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _topics: [],
    _users: [],
    _editModel: {
      mtg_date: '2023-10-22',
      to_user_id: 1,
      topics: [],
    },
  }),

  getters: {
    topics(state) {
      return state._topics
    },
    users(state) {
      return state._users
    },
    editModel(state) {
      return state._editModel
    },
  },

  actions: {
    async fetchTopics() {
      const result = await axios.get('/api/my-goal/v1/topics')
      this._topics = result.data.data
    },
    async fetchUsers() {
      const result = await axios.get('/api/my-goal/v1/users')
      this._users = result.data.data
    },
    async fetchMeeting(id: number) {
      const result = await axios.get('/api/my-goal/v1/mtgs/' + id)
      this._editModel = result.data.data[0]
    },
    setMtgDate(mtgDate: string) {
      this._editModel.mtg_date = mtgDate
    },
    setToUserId(id: number) {
      this._editModel.to_user_id = id
    },
    setTopics(topics: Array) {
      this._editModel.topics = topics
    },
    async storeMeeting() {
      await axios.post('/api/my-goal/v1/mtgs', this._editModel)
    },
  },
})
