<template>
  <div id="switcherContainer">
    <b-button
      variant="primary"
      id="companySwitch"
      :disabled="popoverShow"
      ref="button">
      <b-container
        v-if="activeCompany && companiesList.data">
        <b-row>
          <b-col cols="4"><img
            src="~static/img/avatars/1.jpg"
            class="img-avatar"
            alt="admin@bootstrapmaster.com"></b-col>
          <b-col
            cols="8"
            class="nav-company-switcher">
            {{ activeCompany.name }}
          </b-col>
        </b-row>
      </b-container>
    </b-button>
    <b-popover
      target="companySwitch"
      triggers="click"
      ref="popover"
      :show.sync="popoverShow"
      placement="auto"
      container="switcherContainer">
      <template slot="title">
        <b-btn
          @click="onClose"
          class="close"
          aria-label="Close">
          <span
            class="d-inline-block"
            aria-hidden="true">&times;</span>
        </b-btn>
        <h4>Switch companies</h4>
      </template>
      <b-list-group>
        <b-list-group-item
          v-for="company in companiesList.data"
          :key="company.id"
          href="#"
          @click="switchActiveCompany(getCompany(company.id));popoverShow = false">
          {{ company.name }}
        </b-list-group-item>
      </b-list-group>
      <b-container>
        <b-row>
          <b-col>
            <b-button
              variant="link"
              :to="{ name: 'Create a company' }">Create a new company</b-button>
          </b-col>
        </b-row>
      </b-container>

    </b-popover>
  </div>
</template>
<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('company')
export default {
  name: 'CompanySwitcher',
  data () {
    return { popoverShow: false }
  },
  mounted () {
    this.getCompaniesList()
    this.getDefaultCompany()
    this.setActiveCompany()
  },
  computed: {
    ...mapState({
      defaultCompanyId: state => state.config.defaultCompanyId,
      activeCompany   : state => state.activeCompany,
      companiesList   : state => state.companiesList,
    }),
  },
  methods: {
    ...mapActions({
      getDefaultCompany  : 'getDefaultCompany',
      setActiveCompany   : 'setActiveCompany',
      getCompaniesList   : 'getCompaniesList',
      switchActiveCompany: 'switchActiveCompany',
    }),
    onClose () {
      this.popoverShow = false
    },
    onHidden () {
      this.focusRef(this.$refs.button)
    },
    getCompany: function (id) {
      return this.companiesList.data.find(function (company) {
        return company.id === id
      })
    },
    focusRef (ref) {
      this.$nextTick(() => {
        this.$nextTick(() => { (ref.$el || ref).focus() })
      })
    },
  },
}
</script>
