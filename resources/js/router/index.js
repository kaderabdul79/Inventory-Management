import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: "/", 
      component: () => import("../views/HomePage.vue") 
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: () => import("../views/backend/Dashboard.vue"),
      children: [
        {
          path: '',
          name: 'dashboardOverview',
          component: () => import('../views/backend/Overview.vue'),
        },
      ]
    },
  ]
})

export default router
