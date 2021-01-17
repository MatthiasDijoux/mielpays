import Vue from 'vue';
import Vuetify from 'vuetify';
import Routes from './routes.js';
import { store } from './store/index';
import Layout from './layouts/Layout.vue';
import 'vuetify/dist/vuetify.min.css';
import _ from 'lodash';
import vuetify from './vuetify.js'
import 'leaflet/dist/leaflet.css';
import LoadScript from "vue-plugin-load-script";
import VStripeElements from 'v-stripe-elements/lib';

Vue.use(LoadScript);
Vue.use(VStripeElements);

Vue.use(Vuetify);
import { Icon } from 'leaflet';

delete Icon.Default.prototype._getIconUrl;
Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

const app = new Vue({
    el: '#app',
    vuetify,
    router: Routes,
    store,
    components: { Layout },
})




export default new Vuetify(app);