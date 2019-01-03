/* import Charts from '@/views/sample/Charts'
import Widgets from '@/views/sample/Widgets'
import Loading from '@/views/sample/Loading'
import base from './base'
import buttons from './buttons'
import icons from './icons'
import notifications from './notifications'
import theme from './theme'
import Settings from '@/views/settings/Settings'
import UserProfile from '@/views/settings/user/Profile'
import MyCompanies from '@/views/settings/user/companies/MyCompanies'
import CreateCompany from '@/views/settings/user/companies/CreateCompany'
import EditCompany from '@/views/settings/user/companies/EditCompany'
import MyCompaniesList from '@/views/settings/user/companies/MyCompaniesList'
import CreateServiceArea from '@/views/settings/user/service-areas/CreateServiceArea'
import EditServiceArea from '@/views/settings/user/service-areas/EditServiceArea'
import ServiceAreas from '@/views/settings/user/service-areas/ServiceAreas'
import ServiceAreasList from '@/views/settings/user/service-areas/ServiceAreasList'
import CreateZone from '@/views/settings/user/zones/CreateZone'
import EditZone from '@/views/settings/user/zones/EditZone'
import Zones from '@/views/settings/user/zones/Zones'
import ZonesList from '@/views/settings/user/zones/ZonesList'
import Vehicles from '@/views/vehicles/Vehicles'
import CreateVehicle from '@/views/vehicles/CreateVehicle'
import EditVehicle from '@/views/vehicles/EditVehicle'
import VehiclesList from '@/views/vehicles/VehiclesList'
import Services from '@/views/services/Services'
import CreateService from '@/views/services/CreateService'
import EditService from '@/views/services/EditService'
import ServicesList from '@/views/services/ServicesList'
import Customers from '@/views/customers/Customers'
import CreateCustomer from '@/views/customers/CreateCustomer'
import EditCustomer from '@/views/customers/EditCustomer'
import CustomersList from '@/views/customers/CustomersList'
import Bookings from '@/views/bookings/Bookings'
import CreateBooking from '@/views/bookings/CreateBooking'
import EditBooking from '@/views/bookings/EditBooking'
import BookingsList from '@/views/bookings/BookingsList' */
import HelloWorldModule from '../../../../../public/js/modules/HelloWorld/HelloWorldModule'
function loadView (view, path) {
  return () => import(/* webpackChunkName: "view-[request]" */ `@/views/${path}/${view}.vue`)
}
export default [
  /*  base,
  buttons,
  icons,
  notifications,
  theme, */
  /*  {
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
  }, */
  HelloWorldModule.routes,
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
      {
        path     : 'service-areas',
        name     : 'Service areas',
        redirect : '/app/settings/service-areas/list',
        component: loadView('ServiceAreas', 'settings/user/service-areas'),
        children : [
          {
            path     : 'list',
            name     : 'service areas list',
            component: loadView('ServiceAreasList', 'settings/user/service-areas'),
          },
          {
            path     : 'create',
            name     : 'Create a service area',
            component: loadView('CreateServiceArea', 'settings/user/service-areas'),
          },
          {
            path     : 'edit/:id',
            name     : 'Edit Service Area',
            component: loadView('EditServiceArea', 'settings/user/service-areas'),
            props    : true,
          },
        ],
      },
      {
        path     : 'zones',
        name     : 'Zones',
        redirect : '/app/settings/zones/list',
        component: loadView('Zones', 'settings/user/zones'),
        children : [
          {
            path     : 'list',
            name     : 'zones list',
            component: loadView('ZonesList', 'settings/user/zones'),
          },
          {
            path     : 'create',
            name     : 'Create a zone',
            component: loadView('CreateZone', 'settings/user/zones'),
          },
          {
            path     : 'edit/:id',
            name     : 'Edit Zone',
            component: loadView('EditZone', 'settings/user/zones'),
            props    : true,
          },
        ],
      },

    ],
  },
  {
    path     : 'vehicles',
    name     : 'Vehicles',
    redirect : '/app/vehicles/list',
    component: loadView('Vehicles', 'vehicles'),
    children : [
      {
        path     : 'list',
        name     : 'vehicles list',
        component: loadView('VehiclesList', 'vehicles'),
      },
      {
        path     : 'create',
        name     : 'Create a vehicle',
        component: loadView('CreateVehicle', 'vehicles'),
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Vehicle',
        component: loadView('EditVehicle', 'vehicles'),
        props    : true,
      },
    ],
  },
  {
    path     : 'services',
    name     : 'Services',
    redirect : '/app/services/list',
    component: loadView('Services', 'services'),
    children : [
      {
        path     : 'list',
        name     : 'services list',
        component: loadView('ServicesList', 'services'),
      },
      {
        path     : 'create',
        name     : 'Create a service',
        component: loadView('CreateService', 'services'),
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Service',
        component: loadView('EditService', 'services'),
        props    : true,
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
]
