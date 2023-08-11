import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import Dashboard from '@/pages/Dashboard.vue'
import Login from '@/pages/Login/Index.vue'
import MtgInfo from '@/pages/MtgInfo/MtgInfo.vue'
import MtgCreate from '@/pages/MtgCreate/MtgCreate.vue'

const routes = [
  { path: '/login', name: 'Login', component: Login },
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      isAuthenticated: true,
    },
  },
  {
    path: '/mtg/infos',
    name: 'MtgInfo',
    component: MtgInfo,
    meta: {
      isAuthenticated: true,
    },
  },
  {
    path: '/mtg/create',
    name: 'MtgCreate',
    component: MtgCreate,
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
    console.log('---auth check start ----')
    const authStore = useAuthStore()

    if (!authStore.isAuth) {
      console.log('---auth check false ----')
      next({ name: 'Login' })
    } else {
      console.log('---auth check true ----')
      next()
    }
    console.log('---auth check end ----')
  }
  next()
})
export default router
