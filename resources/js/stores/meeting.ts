import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _topics: [],
    _users: [],
    _editModel: {
      mtg_id: 0,
      mtg_date: '2023-10-22',
      to_user_id: 1,
      topics: [],
    },
    _mode: 1,
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
    editTopics(state) {
      return state._editModel.topics
    },
  },

  actions: {
    async fetchTopics() {
      const result = await axios.get('/api/my-goal/v1/topics')
      this._topics = result.data.data

      if (this._editModel.topics.length == 0) {
        this._topics.forEach((topic) => {
          this._editModel.topics.push({
            checked: false,
            selected: 0,
            topic_id: topic.topic_id,
          })
        })
      }
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
    setTopics(topic: Object, i: number) {
      this._editModel.topics.splice(i, 1, topic)
    },
    async storeMeeting() {
      if (this._mode == 1) {
        await axios.post('/api/my-goal/v1/mtgs', this._editModel)
        return
      }
      if (this._mode == 2) {
        await axios.put('/api/my-goal/v1/mtgs', this._editModel)
        return
      }
    },
    changeModeCreate() {
      this._mode = 1
    },
    changeModeUpdate() {
      this._mode = 2
    },
    clearModel() {
      this._editModel = {}
      this._editModel.mtg_id = 0
      this._editModel.mtg_date = ''
      this._editModel.to_user_id = 1
      this._editModel.topics = []

      this._topics.forEach((topic) => {
        this._editModel.topics.push({
          checked: false,
          selected: 0,
          topic_id: topic.topic_id,
        })
      })
    },
  },
})
