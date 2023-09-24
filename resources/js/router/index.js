import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: "/", 
      component: () => import("../views/HomePage.vue") 
    },
    // auth
    { 
      path: "/user/login", 
      name: 'login',
      component: () => import("../views/backend/auth/Login.vue"),
    },
    {
      path: "/user/register", 
      name: 'register',
      component: () => import("../views/backend/auth/Registration.vue"),
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
        // sizes
        {
          path: 'sizes',
          name: 'sizes',
          component: () => import('../views/backend/size/Sizes.vue'),
        },
        {
          path: 'sizes/create',
          name: 'createSize',
          component: () => import('../views/backend/size/Create.vue'),
        },
        {
          path: 'sizes/:id/edit',
          props: true,
          name: 'editSize',
          component: () => import('../views/backend/size/Edit.vue'),
        },
        // brands
        {
          path: 'brands',
          name: 'brands',
          component: () => import('../views/backend/brand/Brands.vue'),
        },
        {
          path: 'brands/create',
          name: 'createBrand',
          component: () => import('../views/backend/brand/Create.vue'),
        },
        {
          path: 'brands/:id/edit',
          props: true,
          name: 'editBrand',
          component: () => import('../views/backend/brand/Edit.vue'),
        },
        // products
        {
          path: 'products',
          name: 'products',
          component: () => import('../views/backend/product/Products.vue'),
        },
        {
          path: 'products/create',
          name: 'createProduct',
          component: () => import('../views/backend/product/Create.vue'),
        },
        {
          path: 'products/:id/edit',
          props: true,
          name: 'editProduct',
          component: () => import('../views/backend/product/Edit.vue'),
        },
        {
          path: 'products/:id/view',
          props: true,
          name: 'viewProduct',
          component: () => import('../views/backend/product/View.vue'),
        },
        // stocks
        {
          path: 'stocks',
          name: 'stocks',
          component: () => import('../views/backend/stock/Stocks.vue'),
        },
        {
          path: 'stocks/create',
          name: 'createStocks',
          component: () => import('../views/backend/stock/Create.vue'),
        },
        { 
          path: "/user/account", 
          name: 'user',
          component: () => import("../views/backend/auth/User.vue") ,
        },
      ]
    },
  ]
})

export default router
