import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from './stores/auth'
import GoalSetting from './pages/GoalSetting/GoalSetting.vue'
import Login from './pages/Login/Index.vue'
import MeetingInfos from './pages/MeetingInfos/MeetingInfos.vue'

const routes = [
  { path: '/login', name: 'Login', component: Login },
  {
    path: '/',
    name: 'GoalSetting',
    component: GoalSetting,
    meta: {
      isAuthenticated: true,
    },
  },
  {
    path: '/meeting',
    name: 'MeetingInfos',
    component: MeetingInfos,
    meta: {
      isAuthenticated: true,
    },
  },
]
const router = createRouter({
  routes,
  history: createWebHistory(),
})

// login状態のチェック
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.isAuthenticated)) {
    const authStore = useAuthStore()
    if (!authStore.isAuth) {
      next({ name: 'Login' })
      return
    }
  }
  next()
  return
})
export default router
