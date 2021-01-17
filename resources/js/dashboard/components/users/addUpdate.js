import { apiService } from '../../_services/apiService.js';

export default {
    props: {
        user: {
            default: function () {
                return {}
            },

        },
        isUpdate: {
            default: false
        }
    },
    data() {
        return {
            drawerRight: null,
            email: '',
            name: '',
            id: '',
            snackbar: false,
            text: '',
            timeout: 3000,
        }
    },

    methods: {
        addUpdateUser() {
            apiService.post('/api/users', {
                name: this.name,
                email: this.email,
                id: this.id == '' ? '' : this.id
            }).then(({ data }) => {
                this.drawerRight = !this.drawerRight
                this.snackbar = true;
                if (this.isUpdate) {
                    this.$emit('updateUser', data.data)
                    this.text = 'L\'utilisateur a été modifié'
                } else if(!this.isUpdate) {
                    this.$emit('addUser', data.data)
                    this.text = 'L\'utilisateur a été ajouté'
                }

            })
        },

        updateUser(user) {
            this.id = user.id;
            this.name = user.name;
            this.email = user.email;
        }
    },

}