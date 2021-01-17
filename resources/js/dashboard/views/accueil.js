import Axios from "axios";
import { mapState, mapMutations, mapActions } from "vuex";
import productMap from '../components/users/productMap.vue';
import popularProducts from '../components/users/popularProducts.vue';
export default {
    data() {
        return {
            producteurs: [],
            popularProducts: []
        }
    },
    components: {
        productMap,
        popularProducts
    },
    computed: {
        ...mapState(["user"]),
    },

    mounted() {
        this.getProducers();
        this.getPopulars();

    },
    methods: {
        // ...mapMutations({
        //     setUser: "SET_USER",
        // }),
        getToto() {
            this.$store.dispatch('toto');
        },
        getProducers() {
            Axios.get('/api/producteurs').then(response => {
                response.data.data.forEach(producteur => {
                    this.producteurs.push(producteur)
                })
            })
        },
        getPopulars() {
            Axios.get('/api/popular').then(response => {
                response.data.data.forEach(product => {
                    this.popularProducts.push(product)
                })
                console.log(this.popularProducts)
            })
        }
    },
}