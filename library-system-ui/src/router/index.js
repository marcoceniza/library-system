import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';

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
      beforeEnter: (to, from, next) => {
        localStorage.getItem('librarian_info') ? next() : next('/');
      },
    },
    {
      path: '/student',
      name: 'StudentView',
      component: () => import('../views/admin/Student.vue'),
      beforeEnter: (to, from, next) => {
        localStorage.getItem('librarian_info') ? next() : next('/');
      },
    },
  ]
});

export default router
