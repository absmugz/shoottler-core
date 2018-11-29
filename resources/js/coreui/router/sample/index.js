import Charts from '@/views/sample/Charts'
import Widgets from '@/views/sample/Widgets'
import Loading from '@/views/sample/Loading'
import base from './base'
import buttons from './buttons'
import icons from './icons'
import notifications from './notifications'
import theme from './theme'
import Settings from '@/views/settings/settings'
import UserProfile from '@/views/settings/user/profile'
import MyCompanies from '@/views/settings/user/companies/MyCompanies'
import CreateCompany from '@/views/settings/user/companies/CreateCompany'
import EditCompany from '@/views/settings/user/companies/EditCompany'
import MyCompaniesList from '@/views/settings/user/companies/List'
export default [
  base,
  buttons,
  icons,
  notifications,
  theme,
  {
    path     : 'charts',
    name     : 'Charts',
    component: Charts,
  },
  {
    path     : 'widgets',
    name     : 'Widgets',
    component: Widgets,
  },
  {
    path     : 'loading',
    name     : 'Loading',
    component: Loading,
  },
  {
    path     : 'settings',
    name     : 'Settings',
    redirect : '/app/settings/user-profile',
    component: Settings,
    children : [
      {
        path     : 'user-profile',
        name     : 'User Profile',
        component: UserProfile,
      },
      {
        path     : 'my-companies',
        name     : 'My Companies',
        redirect : '/app/settings/my-companies/list',
        component: MyCompanies,
        children : [
          {
            path     : 'list',
            name     : 'List',
            component: MyCompaniesList,
          },
          {
            path     : 'create-company',
            name     : 'Create a company',
            component: CreateCompany,
          },
          {
            path     : 'edit-company/:id',
            name     : 'Edit Company',
            component: EditCompany,
            props    : true,
          },
        ],
      },
    ],
  },
]
