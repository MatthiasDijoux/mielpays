<template>
  <v-container>
    <v-row>
      <v-col
        v-for="product in products"
        :key="product.id"
        col="3"
        sm="5"
        md="3"
      >
        <v-card class="mx-auto my-12" max-width="374">
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

          <v-card-title>{{ product.name }}</v-card-title>

          <v-card-text> Stock: {{ product.quantite }} </v-card-text>
          <updateQuantity :product="product" />
          <v-btn @click="addToBasket(product)">
            <v-icon>mdi-plus</v-icon></v-btn
          >
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script src="./Boutique.js"/>