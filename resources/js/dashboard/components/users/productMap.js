
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";

export default {
    props: ['producteurs'],
    name: "Example",
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
        LTooltip
    },
    data() {
        return {
            zoom: 13,
            center: latLng(47.41322, -1.219482),
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            withPopup: latLng(47.41322, -1.219482),
            withTooltip: latLng(47.41422, -1.250482),
            currentZoom: 11.5,
            currentCenter: latLng(47.41322, -1.219482),
            showParagraph: false,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true,
            listProducteurs: [],
            options: {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            }
        };
    },
    mounted() {
        setTimeout(() => { this.formatData(), this.initializeMap() }, 2000);
    },
    methods: {
        zoomUpdate(zoom) {
            this.currentZoom = zoom;
        },
        showLongText() {
            this.showParagraph = !this.showParagraph;
        },
        innerClick() {
            alert("Click!");
        },
        formatData() {
            this.producteurs.forEach(_producteur => {
                console.log(_producteur)
                let array = []
                array['adresse'] = _producteur.adresse
                array['nom'] = _producteur.name
                array['latLng'] = latLng(_producteur.lat, _producteur.lng)
                array['id'] = _producteur.id
                this.listProducteurs.push(array)
            })
        },
        initializeMap() {
            navigator.geolocation.getCurrentPosition(this.success, this.error, this.options);
        },
        success(pos) {
            var crd = pos.coords;
            this.center = latLng(crd.latitude, crd.longitude)
        },
        error(err) {
            console.warn(`ERREUR (${err.code}): ${err.message}`);
        }

    }
};