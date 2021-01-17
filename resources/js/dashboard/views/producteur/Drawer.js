import Axios from "axios";
import { EventBus } from '../../eventBus';
import { clientService } from '../../_services/clientService';
export default {
    props: ['product'],
    data() {
        return {
            drawer: null,
            quantite: '',
            nom: '',
            prix: '',
            modification: true,
        }
    },
    created() {
        this.initializeInputs();
    },

    methods: {
        initializeInputs() {
            if (this.product) {

                this.quantite = this.product.quantite
                this.nom = this.product.name
                this.prix = this.product.prix
            } else {
                this.modification = false;
            }

        },

        modifyProduct() {
            clientService.post('/api/produit/' + this.product.id, {
                name: this.nom,
                quantite: this.quantite,
                prix: this.prix
            }).then(response => {
                EventBus.$emit('updateProduct', response.data.data)
            })
        },
        addProduct() {
            clientService.post('/api/' + this.$route.params.id + '/produit', {
                name: this.nom,
                quantite: this.quantite,
                prix: this.quantite
            }).then(response => {
                EventBus.$emit('addProduct', response.data.data)
            })
        }
    },
}