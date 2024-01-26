import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'LoginView',
      component: LoginView
    },
    {
      path: '/register',
      name: 'RegisterView',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/dashboard',
      name: 'DashboardView',
      component: () => import('../views/admin/Dashboard.vue'),
    }
  ]
})

export default router
