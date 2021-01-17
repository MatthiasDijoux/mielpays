import { apiService } from '../../_services/apiService.js';
import { EventBus } from '../../eventBus'
import { userService } from '../../_services/userService.js';

export default {
    props: {
        user: {
            default: function () {
                return {}
            },

        },
        users: {
            default: function () {
                return {}
            },

        },
    },

    data() {
        return {
            dialog: false,
            timeout: 3000,

        }
    },

    methods: {
        deleteUser(user) {
            const index = this.users.indexOf(user);
            userService.deleteUser(user).then(
                    this.users.splice(index, 1)
            )
            let contentSnackbar = {
                text: '',
                color: 'error',
                etat: false
            }
            contentSnackbar.text = user.name + " a été supprimé"
            contentSnackbar.etat = true
            EventBus.$emit('updateSnack', contentSnackbar);
            this.dialog = false

        }
    },

}