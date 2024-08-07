const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/DashboardPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "posts",
        component: () => import("pages/PostsPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "posts/:id",
        component: () => import("pages/PostPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "test",
        component: () => import("pages/TestPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "articles/:id",
        component: () => import("pages/ArticlePage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "categories/:id",
        component: () => import("pages/CategoryPage.vue"),
        meta: { requireAuth: true },
      },
    ],
  },
  {
    path: "/auth",
    component: () => import("layouts/AuthLayout.vue"),
    children: [
      {
        path: "login",
        component: () => import("pages/auth/LoginPage.vue"),
        meta: { requireAuth: false, login: true },
      },
      {
        path: "register",
        component: () => import("pages/auth/RegisterPage.vue"),
        meta: { requireAuth: false, register: true },
      },
    ],
  },

  {
    path: "/admin",
    component: () => import("layouts/AuthLayout.vue"),
    children: [
      {
        path: "login",
        component: () => import("pages/admin/LoginAdminPage.vue"),
        meta: { requireAuth: false },
      },
    ],
  },
  {
    path: "/admin/dashboard",
    component: () => import("layouts/DashboardLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/admin/DashboardAdminPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "categories",
        component: () => import("pages/admin/CategoryPage.vue"),
        meta: { requireAuth: true },
      },
    
      {
        path: "articles",
        component: () => import("pages/admin/ArticlePage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "posts",
        component: () => import("pages/admin/PostPage.vue"),
        meta: { requireAuth: true },
      },
      {
        path: "users",
        component: () => import("pages/admin/UserPage.vue"),
        meta: { requireAuth: true },
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
