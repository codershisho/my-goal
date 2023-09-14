export interface ITopic {
  topic_id: number
  topic_name: String
  details: Array<ITopicDetail>
  checked?: Boolean
  selected?: number
  from_memo?: string
  to_memo?: string
}

export interface ITopicDetail {
  id: number
  name: String
}

export interface IMeeting {
  mtg_id: number
  mtg_date: String
  status: String
  to_user_name: String
  created_at: String
  updated_at: String
}
