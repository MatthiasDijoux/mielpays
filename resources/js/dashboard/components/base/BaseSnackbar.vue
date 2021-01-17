<template>
  <v-snackbar v-model="contentSnackbar.etat" :timeout="timeout" :color="contentSnackbar.color">
    {{ contentSnackbar.text }}
    <template v-slot:action>
      <v-btn text @click="contentSnackbar.etat = false">Close</v-btn>
    </template>
  </v-snackbar>
</template>

<script src='./baseSnackbar.js' />