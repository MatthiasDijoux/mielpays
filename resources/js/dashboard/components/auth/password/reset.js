import { authenticationService } from "../../../_services/authentication.service";
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
        password_confirmation: "",
        token: "",
      },
    };
  },
  methods: {
    resetPassword() {
      this.loading = true;
      authenticationService.passwordReset(this.user).then(
        (user) => {
            console.log(user);
        //   if (user == undefined) {
        //     this.erreur = "mot de passe ou email incorrect";
        //   } else {
        //     this.erreur = "";
        //     this.$router.push(this.returnUrl);
        //   }
        },
        (error) => {
          this.loading = false;
        }
      );
    },
  },
  mounted() {
    let token = this.$route.params.token;
    if (!token) {
      this.$router.push("/");
    }
    this.token = token;
  },
};