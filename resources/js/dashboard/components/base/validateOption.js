export default {

    props: {
        contentsValidate: {
            default: function () {
                return {}
            }
        }
    },

    data() {
        return {
            sheet: false,
        }
    },

    methods: {
        isValidate() {
            // emit en isValidate
            this.$emit('isValidated');
        }
    },
}