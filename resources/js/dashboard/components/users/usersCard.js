import Delete from './Delete.vue'
import AddUpdate from './AddUpdate.vue'
export default {
    components: {
        Delete,
        AddUpdate,
    },
    props: {
        users: {
            default: function () {
                return {}
            },

        },
        user: {
            default: function () {
                return {}
            },

        },
    },
    data() {
        return {
            isLoading: false,
            items: [],
            model: null,
            search: null,
            tab: null,
        }
    },

    methods: {
        update(user) {

            const index = _.findIndex(this.users, { id: user.id });
            this.users.splice(index, 1, user);

        },

        add(user) {
            const index = _.findIndex(this.users, { id: user.id });
            this.users.push(user);
        }
    },
}