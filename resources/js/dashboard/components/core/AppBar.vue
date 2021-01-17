<template>
  <v-app-bar id="app-bar" absolute app color="transparent" flat height="75">
    <v-btn
      class="mr-3 success--text"
      elevation="1"
      small
      @click="setDrawer(!drawer)"
    >
      <v-icon v-if="value">mdi-view-quilt</v-icon>

      <v-icon v-else>mdi-menu</v-icon>
    </v-btn>

    <v-spacer />
    <basket />
    <v-menu
      bottom
      offset-y
      origin="center center"
      transition="scale-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          icon
          color="success"
          dark
          v-bind="attrs"
          v-on="on"
          class="hidden-sm-and-down"
        >
          <v-icon color="success">mdi-account-cog</v-icon>
        </v-btn>
        <v-btn
          icon
          text
          color="success"
          dark
          v-bind="attrs"
          v-on="on"
          class="hidden-md-and-up"
        >
          <v-icon color="success">mdi-account-cog</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item v-if="isChecked">
          <v-list-item-content>
            <v-list-item-title class="white--text">
              <v-btn class="mr-4 text-decoration-none" to="/profil" text block>
                <v-icon class="mr-auto">mdi-account</v-icon>Profil
              </v-btn>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="isChecked">
          <v-list-item-content>
            <v-list-item-title class="white--text">
              <validateOption
                :contentsValidate="contentsValidate"
                @isValidated="logout"
              />
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="!isChecked">
          <v-list-item-title class="white--text">
            <v-btn
              class="text-decoration-none mr-4"
              min-width="0"
              text
              block
              to="/login"
            >
              <v-icon class="mr-auto">mdi-login</v-icon>Se connecter
            </v-btn>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
// Components
import { authenticationService } from "../../_services/authentication.service";
import router from "../../routes";
import { VHover, VListItem } from "vuetify/lib";
import ValidateOption from "../base/ValidateOption";
import Basket from "../users/Basket.vue";
// Utilities
import { mapState, mapMutations } from "vuex";

export default {
  name: "DashboardCoreAppBar",

  components: {
    ValidateOption,
    Basket,
    AppBarItem: {
      render(h) {
        return h(VHover, {
          scopedSlots: {
            default: ({ hover }) => {
              return h(
                VListItem,
                {
                  attrs: this.$attrs,
                  class: {
                    "black--text": !hover,
                    "white--text secondary elevation-12": hover,
                  },
                  props: {
                    activeClass: "",
                    dark: hover,
                    link: true,
                    ...this.$attrs,
                  },
                },
                this.$slots.default
              );
            },
          },
        });
      },
    },
  },

  props: {
    value: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    currentUser: null,
    contentsValidate: {
      iconValidate: "mdi-logout",
      titleValidate: "logout",
      textValidate: "Êtes-vous sûr de vouloir vous déconnecter ?",
    },
  }),

  created() {
    authenticationService.currentUser.subscribe((x) => (this.currentUser = x));
  },
  computed: {
    ...mapState(["drawer"]),
    isChecked() {
      return this.currentUser;
    },
  },

  methods: {
    ...mapMutations({
      setDrawer: "SET_DRAWER",
    }),

    logout() {
      authenticationService.logout();
      router.push("/login");
    },
    show: function () {
      this.isDisplay = true;
    },
    hide: function () {
      this.isDisplay = false;
    },
  },
};
</script>
