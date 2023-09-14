import { IMeeting, ITopic } from './../../types/meeting'

export async function fetchMeetings(): Promise<IMeeting[]> {
  const result = await axios.get('/api/my-goal/v1/meetings')
  return result.data.data
}

export async function fetchMeetingBase(id: number): Promise<IMeeting> {
  const result = await axios.get('/api/my-goal/v1/meetings/' + id + '/base')
  return result.data.data
}

export async function fetchMeetingDetail(id: number): Promise<ITopic[]> {
  const result = await axios.get('/api/my-goal/v1/meetings/' + id + '/detail')
  return result.data.data
}
