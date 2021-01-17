<template>
  <v-container>
    <core-app-bar />
    <core-drawer />

  </v-container>
</template>

<script>
import CoreAppBar from '../components/core/AppBar'
import CoreDrawer from '../components/core/Drawer'
  export default {
    name: 'DashboardIndex',

    components: {
      CoreAppBar,
      CoreDrawer
    },

  }
</script>
