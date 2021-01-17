import Axios from "axios";
import { EventBus } from "../../eventBus";
import Drawer from './Drawer.vue';
import { clientService } from '../../_services/clientService';
export default {
    components: {
        Drawer
    },
    data() {
        return {
            products: [],
            drawer: null,
            modification: null,
        }
    },
    created() {
        this.getProducts();
        EventBus.$on('updateProduct', response => {
            this.products.forEach(product => {
                if (product['id'] == response.id) {
                    product['name'] = response.name
                    product['prix'] = response.prix
                    product['quantite'] = response.quantite
                }
            })
        })
        EventBus.$on('addProduct', response => {
            this.products.push(response)
        })
    },

    methods: {
        getProducts() {
            console.log(this.id)
            clientService.get('/api/producteur/' + this.$route.params.id).then(response => {
                response.data.data.forEach(product => {
                    this.products.push(product);
                })
            })
        },
        deleteProduct(id) {
            if (confirm("Voulez-vous supprimer ce produit?")) {
                clientService.delete('/api/produit/' + id).then(response => {
                    var index = this.products.indexOf(id);
                    this.products.splice(index, 1)
                });
            }
        }
    },
}