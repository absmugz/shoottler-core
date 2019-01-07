<template>
  <li :class="classList">
    <template v-if="wrapper && wrapper.element">
      <component
        :is="wrapper.element"
        v-bind="wrapper.attributes">
        <i :class="icon"/> {{ name }}
      </component>
    </template>
    <template v-else>
      <i :class="icon"/> {{ name }}
    </template>
  </li>
</template>

<script>
export default {
  props: {
    name: {
      type   : String,
      default: '',
    },
    classes: {
      type   : String,
      default: '',
    },
    icon: {
      type   : String,
      default: '',
    },
    wrapper: {
      type   : Object,
      default: () => {},
    },
  },
  computed: {
    classList () {
      return ['nav-title', ...this.itemClasses]
    },
    itemClasses () {
      return this.classes ? this.classes.split(' ') : ''
    },
  },
}
</script>
