export default {
    data(){
        return {
            'disableSubmit':false,
            'email':'',
            'seconds': 5
        }
    },
    computed:{
        progress:function(){
            return 'width: ' + ( 20*Math.abs(5-this.seconds) ) + '%';
        }
    },
    methods: {
        sendPasswordResetEmail: function () {
            self = this;
            self.disableSubmit=true;
            axios.post('/password/email', {'email':self.email} )
                .then((resp) => {
                    self.countdownRedirect();
                })
                .catch(()=>{
                    self.disableSubmit=false;
                    self.seconds=5;
                })
        },
        countdownRedirect: function () {
            self = this;
            setInterval(()=>{
                self.seconds=self.seconds-1;
                if (self.seconds === 0) {
                    self.$router.push('/login');
                }
            }, 1000);
        },
    }
}