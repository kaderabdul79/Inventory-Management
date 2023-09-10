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
        {
          path: 'categories',
          name: 'categories',
          component: () => import('../views/backend/category/Categories.vue'),
        },
        {
          path: 'categories/create',
          name: 'createCategory',
          component: () => import('../views/backend/category/Create.vue'),
        },
        {
          path: 'categories/:id/edit',
          props: true,
          name: 'editcategory',
          component: () => import('../views/backend/category/Edit.vue'),
        },
      ]
    },
  ]
})

export default router
