<template>
    <b-nav-item-dropdown
            right
            no-caret>
        <template slot="button-content">
            <i class="icon-bell"/>
            <b-badge
                    pill
                    variant="danger">{{ itemsCount }}</b-badge>
        </template>
        <b-dropdown-header
                tag="div"
                class="text-center">
            <strong>Notifications</strong>
        </b-dropdown-header>
        <b-dropdown-item   v-for="(item,index) in items"
                           :item="item"
                           :key="index">
            <i class="fa fa-bell-o"/> {{ item.data.message }}
        </b-dropdown-item>
    </b-nav-item-dropdown>
</template>
<script>
    export default {
        name: 'NotificationsDropdown',
        data() {
            return {
                itemsCount: '',
                items: [],
            }
        },
        computed: {
            token() {
                return this.$store.state.token
            }
        },
        created() {
            this.getNotifications()
        },
        methods: {
            getNotifications(){
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`,
                axios.get('/settings/notifications')
                    .then(response => {
                        this.itemsCount = response.data.unreadCount
                        this.items.push(...response.data.data)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>
