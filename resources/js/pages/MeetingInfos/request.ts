import { useMeetingStore } from '../../stores/meeting'

export const fetchTopics = async () => {
  const meetingStore = useMeetingStore()
  const result = await axios.get('/api/my-goal/v1/topics')
  meetingStore.setTopics(result.data.data)
}

export const fetchUsers = async () => {
  const meetingStore = useMeetingStore()
  const result = await axios.get('/api/my-goal/v1/users')
  meetingStore.setUsers(result.data.data)
}
