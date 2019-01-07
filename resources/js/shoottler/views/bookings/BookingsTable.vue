<template>
  <b-card
    :header="caption">
    <b-table
      :hover="hover"
      :striped="striped"
      :bordered="bordered"
      :small="small"
      :fixed="fixed"
      responsive="sm"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage">
      <template
        slot="actions"
        slot-scope="row">
        <table-actions :id="row.item.id"/>
      </template>
    </b-table>
    <nav>
      <b-pagination
        :total-rows="getRowCount(items)"
        :per-page="perPage"
        v-model="currentPage"
        prev-text="Prev"
        next-text="Next"
        hide-goto-end-buttons/>
    </nav>
  </b-card>
</template>

<script>
import TableActions from './Actions'
import { createNamespacedHelpers } from 'vuex'
const { mapActions } = createNamespacedHelpers('booking')
export default {
  name      : 'BookingsTable',
  components: { TableActions },
  props     : {
    caption: {
      type   : String,
      default: 'Table',
    },
    hover: {
      type   : Boolean,
      default: false,
    },
    striped: {
      type   : Boolean,
      default: false,
    },
    bordered: {
      type   : Boolean,
      default: false,
    },
    small: {
      type   : Boolean,
      default: false,
    },
    fixed: {
      type   : Boolean,
      default: false,
    },
    company: '',
  },
  data: () => {
    return {
      items : [],
      fields: [
        { key: 'customer_id', label: 'Customer' },
        { key: 'bookable_id', label: 'Service' },
        { key: 'order_id', label: 'Order' },
        { key: 'starts_at', label: 'Starts At' },
        { key: 'ends_at', label: 'Ends At' },
        { key: 'actions', label: 'Actions' },
      ],
      currentPage : 1,
      perPage     : 5,
      totalRows   : 0,
      serverErrors: [],
    }
  },
  mounted () {
    if (this.company)
      this.fetchRows()
  },
  watch: {
    company () {
      this.fetchRows()
    },
  },
  methods: {
    ...mapActions({ index: 'index' }),
    fetchRows () {
      this.index().then((response) => {
        this.items.push(...response.data.data)
      })
    },
    getRowCount (items) {
      return items.length
    },
  },
}
</script>
