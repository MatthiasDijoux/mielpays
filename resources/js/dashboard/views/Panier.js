import { basketService } from '../_services/basketService';
import { EventBus } from '../eventBus';
import { clientService } from '../_services/clientService';
import Axios from 'axios';
export default {
    data() {
        return {
            apiKey: 'pk_test_51IAEzpEnkCEipEKygu3Rr4aTRkq4lMaJCwxt9eB2S1diJPCp0efwfg4hm6V4yJJocEJhRMJwwH06t2buqEAbRP0I00KdhDXkjP',
            panel: [0],
            source: null,
            e1: 1,
            valid: true,
            priceTotal: 0,
            status: '',
            order: {
                orderList: {
                },
                adresseLivraison: {
                    nom: '',
                    prenom: '',
                    ville: '',
                    codePostal: '',
                    pays: '',
                    adresse: '',
                },
                adresseFacturation: {
                    nom: '',
                    prenom: '',
                    ville: '',
                    codePostal: '',
                    pays: '',
                    adresse: '',
                },
            },
            rules: [
                value => !!value || 'Required.',
            ],
            selectable: false,
            orderId: '',
            status: '',
            loading: true,
        }
    },

    created() {
        this.getOrder();
    },
    methods: {
        getOrder() {
            this.order.orderList = basketService.getBasket();
            Object.keys(this.order.orderList).forEach(product => {
                this.priceTotal = (this.order.orderList[product].price * this.order.orderList[product].quantity) + this.priceTotal
            })
        },
        sendOrder() {
            if (this.selectable === false) {
                _.assign(this.order.adresseFacturation, this.order.adresseLivraison)
            }
            basketService.sendOrder(this.order).then(response => {
                this.orderId = response.data.data.id
                this.process(this.priceTotal, this.order.orderList);
            })
        },
        process(priceTotal, orders) {
            clientService.post('/api/orders/' + this.orderId + '/paiement', {
                id: this.source.id,
                prix: priceTotal,
            }).then(response => {
                if (response.data.status.order_status.id == 2) {
                    this.status = true
                    this.loading = false
                }
            })
        },
        async getFacture() {
            try {
                const facture = await Axios.post(`/api/getPdf`, { id: 1 }, { responseType: 'arraybuffer' });

                const responseData = facture.data;
                this.downloadPDF(responseData);
            } catch (error) {
            }
        },

        downloadPDF(responseData) {
            var a = document.createElement('a');
            var url = window.URL.createObjectURL(new Blob([responseData], { type: 'application/pdf' }));
            a.href = url;
            a.download = 'test';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    }
}