<template>
  <v-row>
    <v-col v-for="product in products" :key="product.id" col="5" sm="3" md="3">
      <v-card max-width="700">
        <template slot="progress">
          <v-progress-linear
            color="deep-purple"
            height="10"
            indeterminate
          ></v-progress-linear>
        </template>

        <v-img
          height="250"
          src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
        ></v-img>

        <v-card-title>{{ product.id_product.name }}</v-card-title>

        <v-card-text> Stock: {{ product.quantite_acheté }} </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
<script src="./popularProducts.js"/>