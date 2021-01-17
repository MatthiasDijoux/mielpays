import { mapState } from "vuex";

import AddUpdate from '../components/users/AddUpdate'
import UsersCard from '../components/users/UsersCard'
import UsersTab from '../components/users/UsersTab'
import BaseSnackbar from '../components/base/BaseSnackbar'
import { EventBus } from '../eventBus'

export default {
    components: {
        AddUpdate,
        UsersCard,
        UsersTab,
        BaseSnackbar
    },
    data() {
        return {
            isLoading: false,
            items: [],
            model: null,
            search: '',
            tab: null,
            activeCard: true,
            activeTab: false,

        }
    },

    computed: {
        ...mapState(["page", "users", "pagination"]),

        filteredList() {
            return this.users.filter(user => {
                return user.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },

    created() {
        this.nextPageUsers(1);
    },

    methods: {
        nextPageUsers(page) {
            EventBus.$emit('updatePage', page);
            this.$store.dispatch('getPagesUsers');
        }
    },
}