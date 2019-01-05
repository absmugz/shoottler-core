export default {
  items: [
    { divider: true },
    {
      name: 'Dashboard',
      url : '/app/dashboard',
      icon: 'icon-home',
    },
    {
      title  : true,
      name   : 'Sales',
      class  : 'nav-link',
      icon   : 'icon-layers',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name: 'Customers',
      url : '/app/customers',
      icon: '',
    },
    {
      name: 'Bookings',
      url : '/app/bookings',
      icon: '',
    },
    {
      title  : true,
      name   : 'Resources',
      class  : 'nav-link',
      icon   : 'icon-diamond',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name: 'Vehicles',
      url : '/app/vehicles',
      icon: '',
    },
    {
      name: 'Items',
      url : '/app/items',
      icon: '',
    },
    {
      name: 'Settings',
      url : '/app/settings',
      icon: 'icon-settings',
    },
  ],
}
