<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    :dark="barColor !== 'rgba(228, 226, 226, 1), rgba(255, 255, 255, 0.7)'"
    :expand-on-hover="expandOnHover"
    mobile-breakpoint="960"
    app
    width="260"
    v-bind="$attrs"
  >
    <v-toolbar-title class="hidden-sm-and-down font-weight-light text-center mt-5 white--text">
      <v-icon color="success">mdi-alpha-d-box</v-icon>MielPays
    </v-toolbar-title>
    <v-divider class="mb-1" />

    <v-list>
      <v-list-item>
        <v-btn v-if="isChecked" block to="/users" text class="text-decoration-none" color="success">
          <v-icon class="white--text mr-auto">mdi-view-dashboard</v-icon>Utilisateurs
        </v-btn>
      </v-list-item>
      <v-list-item>
        <v-btn v-if="isChecked" text block color="success">
          <v-icon class="white--text mr-auto">mdi-card-plus-outline</v-icon>Page 1
        </v-btn>
      </v-list-item>
      <v-list-item>
        <v-btn v-if="isChecked" text block color="success">
          <v-icon class="white--text mr-auto">mdi-card-plus-outline</v-icon>Page2
        </v-btn>
      </v-list-item>
      <v-list-item>
        <v-btn v-if="isChecked" text block color="success">
          <v-icon class="white--text mr-auto">mdi-card-plus-outline</v-icon>Page3
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
  },
};
</script>