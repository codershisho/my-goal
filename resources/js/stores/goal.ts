import { _ITerm, _IGoal } from './../types/goal'
import { defineStore } from 'pinia'

export const useGoalStore = defineStore('my-goal-goal', {
  state: () => ({
    // 期選択のプルダウンの中身
    _terms: [] as _ITerm[],
    // 検索した目標データ
    _goal: {} as _IGoal,
    // 左メニューで表示指定されたアイテム名
    _dispGoalItemName: '',
  }),

  getters: {
    terms(state): _ITerm[] {
      return state._terms
    },
    goal(state): _IGoal {
      return state._goal
    },
    dispGoalItemName(state): string {
      return state._dispGoalItemName
    },
  },

  actions: {
    async searchTerms(): Promise<void> {
      const result = await axios.get('api/my-goal/v1/terms')
      this._terms = result.data.data
    },
    async searchGoal(term_id: number): Promise<void> {
      const result = await axios.get('api/my-goal/v1/goals/' + term_id)
      this._goal = result.data.data
    },
    setDispGoalItemName(itemName: string): void {
      this._dispGoalItemName = itemName
    },
    setDepartmentGoalText(text: string): void {
      this._goal.goal_department = text
    },
    setGoalFirstText(text: string): void {
      this._goal.goal_first = text
    },
    setGoalSecoundText(text: string): void {
      this._goal.goal_secound = text
    },
    async save(termId: number): Promise<void> {
      this.update(termId)
    },
    async create(termId: number): Promise<void> {
      await axios.post('api/my-goal/v1/goals/' + termId, this._goal)
    },
    async update(termId: number): Promise<void> {
      await axios.put('api/my-goal/v1/goals/' + termId, this._goal)
    },
  },
})
