import Axios from "axios";
import updateQuantity from "../components/users/updateQuantity.vue"
import { basketService } from '../_services/basketService.js';
export default {
    components: {
        updateQuantity,
    },
    data() {
        return {
            products: [],
            quantity: 0,
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        initialize() {
            Axios.get('/api/produits').then(response => {
                response.data.data.forEach(product => {
                    this.products.push(product)
                })
            })
        },
        addToBasket(product) {
            basketService.add(product, this.quantity);
            this.quantity = 0;
        },
    }
}