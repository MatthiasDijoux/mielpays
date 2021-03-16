import Axios from "axios";
import { basketService } from '../../_services/basketService.js'
export default {
    props: ['product'],
    data() {
        return {
            quantity: 0,
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        initialize() {
        },
        updateQuantity(product) {
            basketService.replaceQuantity(product)
        }
    }
}