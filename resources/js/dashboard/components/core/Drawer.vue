<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    :expand-on-hover="expandOnHover"
    mobile-breakpoint="960"
    app
    width="260"
    v-bind="$attrs"
  >
    <v-toolbar-title
      class="hidden-sm-and-down font-weight-light text-center mt-5"
    >
      MielPays
    </v-toolbar-title>
    <v-divider class="mb-1" />

    <v-list>
      <v-list-item>
        <v-btn
          v-if="isChecked"
          block
          to="/"
          text
          class="text-decoration-none"
          color="success"
        >
          <v-icon class="mr-auto">mdi-view-dashboard</v-icon>Accueil
        </v-btn>
      </v-list-item>
      <v-list-item>
        <v-btn v-if="isChecked" text block color="success" to="/boutique">
          <v-icon class="mr-auto">mdi-card-plus-outline</v-icon>Boutique
        </v-btn>
      </v-list-item>
      <v-list-item v-if="isChecked && isAdmin">
        <v-btn v-if="isChecked" text block color="success" to="/users">
          <v-icon class="mr-auto">mdi-card-plus-outline</v-icon>Utilisateurs
        </v-btn>
      </v-list-item>
      <v-list-item v-if="isChecked && isProducteur">
        <v-btn
          v-if="isChecked"
          text
          block
          color="success"
          :to="'/producteur/' + currentUser.id + '/dashboard'"
        >
          <v-icon class="mr-auto">mdi-card-plus-outline</v-icon>Dashboard
        </v-btn>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapState } from "vuex";
import { authenticationService } from "../../_services/authentication.service";

export default {
  data() {
    return {
      currentUser: null,
    };
  },

  name: "DashboardCoreDrawer",

  props: {
    expandOnHover: {
      type: Boolean,
      default: false,
    },
  },

  created() {
    authenticationService.currentUser.subscribe((x) => (this.currentUser = x));
  },

  computed: {
    ...mapState(["barColor"]),
    drawer: {
      get() {
        return this.$store.state.drawer;
      },
      set(val) {
        this.$store.commit("SET_DRAWER", val);
      },
    },
    isChecked() {
      return this.currentUser;
    },
    isProducteur() {
      return this.currentUser.id_role.id === 3;
    },
    isAdmin() {
      return this.currentUser.id_role.id === 1;
    },
  },
  methods: {
    dashboard() {
      window.CanvasRenderingContext2D;
    },
  },
};
</script>