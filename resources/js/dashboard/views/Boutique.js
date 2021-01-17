import Axios from "axios";
import { basketService } from '../_services/basketService.js';
export default {
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
        updateQuantity(product) {
            basketService.replaceQuantity(product)
        }
    }
}