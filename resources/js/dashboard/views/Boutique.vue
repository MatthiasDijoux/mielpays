<template>
  <v-container>
    <v-row>
      <v-col v-for="product in products" :key="product.id" md="2">
        <v-card>
          {{ product.name }}
          <v-text-field
            type="number"
            v-model="quantity"
            min="0"
            :max="product.quantite"
            label="Quantité"
            filled
            dense
            required
            :hint="
              product.quantite < 5
                ? 'Quantité restante: ' + product.quantite
                : ''
            "
            :persistent-hint="product.quantite < 5"
            :disabled="product.quantite == 0"
            :error-messages="product.quantite == 0 ? 'Stock épuisé' : ''"
          ></v-text-field>
          <v-btn @click="addToBasket(product)">
            <v-icon>mdi-plus</v-icon></v-btn
          >
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script src="./Boutique.js"/>