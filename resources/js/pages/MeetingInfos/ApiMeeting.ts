import { _IUser } from '../../types/user'
import { _IMeeting, _IMeetingDetail } from './../../types/meeting'

/**
 * ユーザー一覧を取得
 */
export async function fetchUsers(): Promise<_IUser[]> {
  const result = await axios.get('api/my-goal/v1/users')
  return result.data.data
}

/**
 * トピック情報を取得
 */
export async function fetchTopics(): Promise<_IMeetingDetail[]> {
  const result = await axios.get('api/my-goal/v1/topics')
  return result.data.data
}

/**
 * ミーティング一覧を取得
 */
export async function fetchMeetings(): Promise<_IMeeting[]> {
  const result = await axios.get('/api/my-goal/v1/meetings')
  return result.data.data
}

/**
 * t_mtgsの情報を取得（id検索）
 * @param id
 */
export async function fetchMeetingBase(id: number): Promise<_IMeeting> {
  const result = await axios.get('/api/my-goal/v1/meetings/' + id + '/base')
  return result.data.data
}

/**
 * t_mtg_detailsの情報を取得（id検索）
 * @param id
 */
export async function fetchMeetingDetail(
  id: number
): Promise<_IMeetingDetail[]> {
  const result = await axios.get('/api/my-goal/v1/meetings/' + id + '/detail')
  return result.data.data
}

/**
 * ミーティング情報の登録
 * @param data
 */
export async function createMeeting(data: any): Promise<void> {
  await axios.post('api/my-goal/v1/meetings', data)
}

/**
 * ミーティング情報の更新（id指定）
 * @param data
 */
export async function updateMeeting(data: any): Promise<void> {
  await axios.put('api/my-goal/v1/meetings', data)
}
