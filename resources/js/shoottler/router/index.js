import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/dashboard/Dashboard'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import Register from '@/views/pages/Register'
import Logout from '@/components/Logout.vue'
import ResetPassword from '@/views/pages/ForgotPassword.vue'

import ItemsModule from '../../../../Modules/Item/Resources/assets/src/js/module'

function loadView (view, path) {
  return () => import(/* webpackChunkName: "view-[request]" */ `@/views/${path}/${view}.vue`)
}

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
        {
          path     : 'settings',
          name     : 'Settings',
          redirect : '/app/settings/user-profile',
          component: loadView('Settings', 'settings'),
          children : [
            {
              path     : 'user-profile',
              name     : 'User Profile',
              component: loadView('Profile', 'settings/user'),
            },
            {
              path     : 'my-companies',
              name     : 'My Companies',
              redirect : '/app/settings/my-companies/list',
              component: loadView('MyCompanies', 'settings/user/companies'),
              children : [
                {
                  path     : 'list',
                  name     : 'companies list',
                  component: loadView('MyCompaniesList', 'settings/user/companies'),
                },
                {
                  path     : 'create-company',
                  name     : 'Create a company',
                  component: loadView('CreateCompany', 'settings/user/companies'),
                },
                {
                  path     : 'edit-company/:id',
                  name     : 'Edit Company',
                  component: loadView('EditCompany', 'settings/user/companies'),
                  props    : true,
                },
              ],
            },
          ],
        },
        {
          path     : 'customers',
          name     : 'Customers',
          redirect : '/app/customers/list',
          component: loadView('Customers', 'customers'),
          children : [
            {
              path     : 'list',
              name     : 'customers list',
              component: loadView('CustomersList', 'customers'),
            },
            {
              path     : 'create',
              name     : 'Create a customer',
              component: loadView('CreateCustomer', 'customers'),
            },
            {
              path     : 'edit/:id',
              name     : 'Edit Customer',
              component: loadView('EditCustomer', 'customers'),
              props    : true,
            },
          ],
        },
        {
          path     : 'bookings',
          name     : 'Bookings',
          redirect : '/app/bookings/list',
          component: loadView('Bookings', 'bookings'),
          children : [
            {
              path     : 'list',
              name     : 'bookings list',
              component: loadView('BookingsList', 'bookings'),
            },
            {
              path     : 'create',
              name     : 'Create a booking',
              component: loadView('CreateBooking', 'bookings'),
            },
            {
              path     : 'edit/:id',
              name     : 'Edit Booking',
              component: loadView('EditBooking', 'bookings'),
              props    : true,
            },
          ],
        },
        ...ItemsModule.routes,
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
