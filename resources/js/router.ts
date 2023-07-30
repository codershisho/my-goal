import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '@/pages/Dashboard.vue'
// import Store from './pages/Store.vue'
// import MtgInfo from '@/pages/MtgInfo.vue'
import MtgCreate from '@/pages/MtgCreate/MtgCreate.vue'

const routes = [
  { path: '/', name: 'Dashboard', component: Dashboard },
  //   { path: '/mtg/infos', name: 'Store', component: Store },
  { path: '/mtg/create', name: 'MtgCreate', component: MtgCreate },
]
const router = createRouter({
  routes,
  history: createWebHistory(),
})
export default router
