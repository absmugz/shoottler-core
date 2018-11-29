export default {
  items: [
    { divider: true },
    {
      name: 'Dashboard',
      url : '/app/dashboard',
      icon: 'icon-speedometer',
    },
    {
      title  : true,
      name   : 'Theme',
      class  : '',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name: 'Colors',
      url : '/app/theme/colors',
      icon: 'icon-drop',
    },
    {
      name: 'Typography',
      url : '/app/theme/typography',
      icon: 'icon-pencil',
    },
    {
      title  : true,
      name   : 'Components',
      class  : '',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name    : 'Base',
      url     : '/app/base',
      icon    : 'icon-puzzle',
      children: [
        {
          name: 'Breadcrumbs',
          url : '/app/base/breadcrumbs',
          icon: 'icon-puzzle',
        },
        {
          name: 'Cards',
          url : '/app/base/cards',
          icon: 'icon-puzzle',
        },
        {
          name: 'Carousels',
          url : '/app/base/carousels',
          icon: 'icon-puzzle',
        },
        {
          name: 'Collapses',
          url : '/app/base/collapses',
          icon: 'icon-puzzle',
        },
        {
          name: 'Forms',
          url : '/app/base/forms',
          icon: 'icon-puzzle',
        },
        {
          name: 'Jumbotrons',
          url : '/app/base/jumbotrons',
          icon: 'icon-puzzle',
        },
        {
          name: 'List Groups',
          url : '/app/base/list-groups',
          icon: 'icon-puzzle',
        },
        {
          name: 'Navs',
          url : '/app/base/navs',
          icon: 'icon-puzzle',
        },
        {
          name: 'Paginations',
          url : '/app/base/paginations',
          icon: 'icon-puzzle',
        },
        {
          name: 'Popovers',
          url : '/app/base/popovers',
          icon: 'icon-puzzle',
        },
        {
          name: 'Progress Bars',
          url : '/app/base/progress-bars',
          icon: 'icon-puzzle',
        },
        {
          name: 'Switches',
          url : '/app/base/switches',
          icon: 'icon-puzzle',
        },
        {
          name: 'Tables',
          url : '/app/base/tables',
          icon: 'icon-puzzle',
        },
        {
          name: 'Tooltips',
          url : '/app/base/tooltips',
          icon: 'icon-puzzle',
        },
      ],
    },
    {
      name    : 'Buttons',
      url     : '/app/buttons',
      icon    : 'icon-cursor',
      children: [
        {
          name: 'Standard Buttons',
          url : '/app/buttons/standard-buttons',
          icon: 'icon-cursor',
        },
        {
          name: 'Button Groups',
          url : '/app/buttons/button-groups',
          icon: 'icon-cursor',
        },
        {
          name: 'Dropdowns',
          url : '/app/buttons/dropdowns',
          icon: 'icon-cursor',
        },
        {
          name: 'Social Buttons',
          url : '/app/buttons/social-buttons',
          icon: 'icon-cursor',
        },
      ],
    },
    {
      name    : 'Icons',
      url     : '/app/icons',
      icon    : 'icon-star',
      children: [
        {
          name : 'Flags',
          url  : '/app/icons/flags',
          icon : 'icon-star',
          badge: {
            variant: 'success',
            text   : 'NEW',
          },
        },
        {
          name : 'Font Awesome',
          url  : '/app/icons/font-awesome',
          icon : 'icon-star',
          badge: {
            variant: 'secondary',
            text   : '4.7',
          },
        },
        {
          name: 'Simple Line Icons',
          url : '/app/icons/simple-line-icons',
          icon: 'icon-star',
        },
      ],
    },
    {
      name: 'Charts',
      url : '/app/charts',
      icon: 'icon-pie-chart',
    },
    {
      name    : 'Notifications',
      url     : '/app/notifications',
      icon    : 'icon-bell',
      children: [
        {
          name: 'Alerts',
          url : '/app/notifications/alerts',
          icon: 'icon-bell',
        },
        {
          name: 'Badges',
          url : '/app/notifications/badges',
          icon: 'icon-bell',
        },
        {
          name: 'Modals',
          url : '/app/notifications/modals',
          icon: 'icon-bell',
        },
      ],
    },
    {
      name : 'Widgets',
      url  : '/app/widgets',
      icon : 'icon-calculator',
      badge: {
        variant: 'primary',
        text   : 'NEW',
      },
    },
    {
      name : 'Loading',
      url  : '/app/loading',
      icon : 'icon-reload',
      badge: {
        variant: 'danger',
        text   : 'HOT',
      },
    },
    { divider: true },
    {
      title: true,
      name : 'Extras',
    },
    {
      name    : 'Pages',
      url     : '/app/pages',
      icon    : 'icon-star',
      children: [
        {
          name: 'Login',
          url : '/app/pages/login',
          icon: 'icon-star',
        },
        {
          name: 'Register',
          url : '/app/pages/register',
          icon: 'icon-star',
        },
        {
          name: 'Error 404',
          url : '/app/pages/404',
          icon: 'icon-star',
        },
        {
          name: 'Error 500',
          url : '/app/pages/500',
          icon: 'icon-star',
        },
      ],
    },
    { divider: true },
    {
      name: 'Settings',
      url : '/app/settings',
      icon: 'icon-settings',
    },

  ],
}
