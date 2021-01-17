<template>
  <div>
    <v-row>
      <v-col cols="12" md="4" />
      <v-col cols="12" md="4">
        <v-card-text class="text-center">
          <h6 class="display-1 mb-1 grey--text">Profil</h6>

          <h4 class="display-2 font-weight-light mb-3 black--text">
            {{ currentUser.name }}
          </h4>

          <p class="font-weight-light grey--text">{{ currentUser.email }}</p>
        </v-card-text>
        <baseModal :contentModal="contentModal" />
      </v-col>
    </v-row>
    <baseSnackbar :contentSnackbar="contentSnackbar" v-if="isChecked" />
  </div>
</template>

<script src='./profil.js'>