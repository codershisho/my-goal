export interface _IMeetingDetail {
  topic_id: number
  topic_name: String
  details: Array<_ITopicDetail>
  checked?: Boolean
  selected?: number
  from_memo?: string
  to_memo?: string
  mtg_detail_id?: number
}

export interface _ITopicDetail {
  id: number
  name: String
}

export interface _IMeeting {
  mtg_id: number
  mtg_date: String
  status: number
  status_name?: string
  from_user_id?: number
  from_user_name?: String
  from_user_avatar?: String
  to_user_id?: number
  to_user_name?: String
  to_user_avatar?: String
  created_at?: String
  updated_at?: String
}
