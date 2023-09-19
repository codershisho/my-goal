import { _IGoal, _ITerm } from './../../types/goal'

export async function fetchTerms(): Promise<_ITerm[]> {
  const result = await axios.get('api/my-goal/v1/terms')
  return result.data.data
}

export async function fetchGoal(term_id: number): Promise<_IGoal> {
  const result = await axios.get('api/my-goal/v1/goals/' + term_id)
  return result.data.data
}

export async function createGoal(term_id: number, data: any): Promise<void> {
  await axios.post('api/my-goal/v1/goals/' + term_id, data)
}

export async function updateGoal(term_id: number, data: any): Promise<void> {
  await axios.put('api/my-goal/v1/goals/' + term_id, data)
}
