import Charts from '@/views/sample/Charts'
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
import BookingsList from '@/views/bookings/BookingsList'
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
            name     : 'companies list',
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
      {
        path     : 'service-areas',
        name     : 'Service areas',
        redirect : '/app/settings/service-areas/list',
        component: ServiceAreas,
        children : [
          {
            path     : 'list',
            name     : 'service areas list',
            component: ServiceAreasList,
          },
          {
            path     : 'create',
            name     : 'Create a service area',
            component: CreateServiceArea,
          },
          {
            path     : 'edit/:id',
            name     : 'Edit Service Area',
            component: EditServiceArea,
            props    : true,
          },
        ],
      },
      {
        path     : 'zones',
        name     : 'Zones',
        redirect : '/app/settings/zones/list',
        component: Zones,
        children : [
          {
            path     : 'list',
            name     : 'zones list',
            component: ZonesList,
          },
          {
            path     : 'create',
            name     : 'Create a zone',
            component: CreateZone,
          },
          {
            path     : 'edit/:id',
            name     : 'Edit Zone',
            component: EditZone,
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
    component: Vehicles,
    children : [
      {
        path     : 'list',
        name     : 'vehicles list',
        component: VehiclesList,
      },
      {
        path     : 'create',
        name     : 'Create a vehicle',
        component: CreateVehicle,
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Vehicle',
        component: EditVehicle,
        props    : true,
      },
    ],
  },
  {
    path     : 'services',
    name     : 'Services',
    redirect : '/app/services/list',
    component: Services,
    children : [
      {
        path     : 'list',
        name     : 'services list',
        component: ServicesList,
      },
      {
        path     : 'create',
        name     : 'Create a service',
        component: CreateService,
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Service',
        component: EditService,
        props    : true,
      },
    ],
  },
  {
    path     : 'customers',
    name     : 'Customers',
    redirect : '/app/customers/list',
    component: Customers,
    children : [
      {
        path     : 'list',
        name     : 'customers list',
        component: CustomersList,
      },
      {
        path     : 'create',
        name     : 'Create a customer',
        component: CreateCustomer,
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Customer',
        component: EditCustomer,
        props    : true,
      },
    ],
  },
  {
    path     : 'bookings',
    name     : 'Bookings',
    redirect : '/app/bookings/list',
    component: Bookings,
    children : [
      {
        path     : 'list',
        name     : 'bookings list',
        component: BookingsList,
      },
      {
        path     : 'create',
        name     : 'Create a booking',
        component: CreateBooking,
      },
      {
        path     : 'edit/:id',
        name     : 'Edit Booking',
        component: EditBooking,
        props    : true,
      },
    ],
  },
]
