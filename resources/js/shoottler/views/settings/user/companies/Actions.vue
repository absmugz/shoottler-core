<template>
  <b-row>
    <b-col>
      <set-default :id="id"/>
    </b-col>
    <b-col>
      <b-button
        :to="{ name:'Edit Company', params: { id: id } }"
        variant="link"><i class="icon-pencil icons font-xl"/></b-button>
    </b-col>
  </b-row>
</template>

<script>
import SetDefault from './SetDefault'
export default {
  name      : 'TableActions',
  components: { SetDefault },
  props     : { id: '' },
}
</script>
