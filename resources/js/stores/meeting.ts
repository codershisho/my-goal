import { _IUser } from './../types/user'
import { _IMeeting, _IMeetingDetail, _ITopicDetail } from './../types/meeting'
import { defineStore } from 'pinia'

export const useMeetingStore = defineStore('my-goal-meeting', {
  state: () => ({
    _selectedMeetingId: 0,
    _meetings: [] as _IMeeting[],
    _meetingBase: {} as _IMeeting,
    _meetingDetails: [] as _IMeetingDetail[],
    _users: [] as _IUser[],
    _insertMode: true,
    _meetingsFiltered: [] as _IMeeting[],
  }),

  getters: {
    selectedMeetingId(state) {
      return state._selectedMeetingId
    },
    mettings(state) {
      return state._meetings
    },
    meetingBase(state) {
      return state._meetingBase
    },
    meetingDetails(state) {
      return state._meetingDetails
    },
    meetingDetailsLength(state) {
      return state._meetingDetails.length
    },
    users(state) {
      return state._users
    },
    insertMode(state) {
      return state._insertMode
    },
    meetingsFiltered(state) {
      return state._meetingsFiltered
    },
  },

  actions: {
    setSelectedMeetingId(id: number): void {
      this._selectedMeetingId = id
    },
    async searchMeetings(): Promise<void> {
      const response = await axios.get('/api/my-goal/v1/meetings')
      this._meetings = response.data.data
      this._meetingsFiltered = response.data.data
    },
    async searchTopics(): Promise<void> {
      const response = await axios.get('api/my-goal/v1/topics')
      this._meetingDetails = response.data.data
    },
    async searchUsers(): Promise<void> {
      const response = await axios.get('api/my-goal/v1/users')
      this._users = response.data.data
    },
    async searchMeetingBase(): Promise<void> {
      const response = await axios.get(
        '/api/my-goal/v1/meetings/' + this._selectedMeetingId + '/base'
      )
      this._meetingBase = response.data.data
    },
    async searchMeetingDetails(): Promise<void> {
      const response = await axios.get(
        '/api/my-goal/v1/meetings/' + this._selectedMeetingId + '/detail'
      )
      this._meetingDetails = response.data.data
    },
    async createMeeting(data: any): Promise<void> {
      await axios.post('api/my-goal/v1/meetings', data)
    },
    async updateMeeting(data: any): Promise<void> {
      await axios.put('api/my-goal/v1/meetings', data)
    },

    setMeetingBase(payload: _IMeeting): void {
      this._meetingBase = payload
    },
    setMeetingDetails(payload: _IMeetingDetail[]): void {
      this._meetingDetails = payload
    },
    setInsertMode(flag: boolean): void {
      this._insertMode = flag
    },
    filterName(searchText: string): void {
      console.log(searchText)

      this._meetingsFiltered = this._meetings.filter((meeting: _IMeeting) => {
        return meeting.to_user_name?.includes(searchText)
      })
    },
    filterUnClose(): void {
      this._meetingsFiltered = this._meetingsFiltered.filter(
        (meeting: _IMeeting) => {
          return meeting.status == 0
        }
      )
    },
    filterClose(): void {
      this._meetingsFiltered = this._meetingsFiltered.filter(
        (meeting: _IMeeting) => {
          return meeting.status == 1
        }
      )
    },
    filterClear(): void {
      this._meetingsFiltered = this._meetings
    },
  },
})
