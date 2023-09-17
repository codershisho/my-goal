export interface _ITerm {
  id: number
  name: string
}

export interface _IGoal {
  id?: number
  term_id: number
  user_id?: number
  goal_department: string
  goal_first: string
  goal_secound: string
}
