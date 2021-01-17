export default {
    props: {
        contentModal: {
            default: function () {
                return {}
            }
        }
    },

    data() {
        return {
            dialog: false,
        }
    },
}