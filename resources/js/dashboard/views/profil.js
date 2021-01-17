import { authenticationService } from "../_services/authentication.service";
import BaseSnackbar from '../components/base/BaseSnackbar'
import BaseModal from '../components/base/BaseModal'

export default {
    components: {
        BaseSnackbar,
        BaseModal
    },
    data() {
        return {
            currentUser: null,
            contentSnackbar: {
                text: '',
                color: 'success',
                etat: false,
            },
            contentModal: {
                titre: 'Information supplémentaire',
                text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam expedita temporibus sapiente, omnis eveniet impedit distinctio ea saepe voluptatem. Nobis qui at, sapiente ut molestias laboriosam id ab rem magni.'
            },

        }
    },

    computed: {
        isChecked() {
            return this.currentUser;
        },
    },
    created() {
        authenticationService.currentUser.subscribe((x) => (this.currentUser = x));
        this.snackCheck();

    },

    methods: {
        snackCheck() {
            if (!_.isEmpty(this.currentUser)) {
                this.contentSnackbar.text = 'vous êtes connecté'
                this.contentSnackbar.etat = true
            } else {
                this.contentSnackbar.text = 'vous n\'êtes pas connecté'
                this.contentSnackbar.etat = true
            }
        },

    },
}