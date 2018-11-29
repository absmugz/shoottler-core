import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/sample/Dashboard'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import Register from '@/views/pages/Register'
import Logout from '@/components/logout.vue'
import ResetPassword from '@/views/pages/ForgotPassword.vue'

// Sample route
import sample from './sample'

Vue.use(Router)

export default new Router({
  mode           : 'history',
  linkActiveClass: 'open active',
  scrollBehavior : () => ({ y: 0 }),
  routes         : [
    {
      path     : '/app/',
      redirect : '/app/dashboard',
      name     : 'Home',
      component: Full,
      children : [
        {
          path     : 'dashboard',
          name     : 'Dashboard',
          component: Dashboard,
          meta     : { requiresAuth: true },
        },
        ...sample,
      ],
    },
    {
      path     : '/app/login',
      name     : 'Login',
      component: Login,
      props    : true,
      meta     : { requiresVisitor: true },
    },
    {
      path     : '/app/register',
      name     : 'Register',
      component: Register,
      meta     : { requiresVisitor: true },
    },
    {
      path     : '/app/reset-password',
      name     : 'ResetPassword',
      component: ResetPassword,
      meta     : { requiresVisitor: true },
    },
    {
      path     : '/app/logout',
      name     : 'Logout',
      component: Logout,
    },
    {
      path     : '/pages',
      redirect : '/pages/404',
      name     : 'Pages',
      component: { render (c) { return c('router-view') } },
      children : [
        {
          path     : '404',
          name     : 'Page404',
          component: Page404,
        },
        {
          path     : '500',
          name     : 'Page500',
          component: Page500,
        },
      ],
    },
    {
      path     : '*',
      name     : '404',
      component: Page404,
    },
  ],
})
