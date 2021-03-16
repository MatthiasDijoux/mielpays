<template>
  <v-text-field
    type="number"
    v-model="quantity"
    min="0"
    :max="product.quantite"
    label="Quantité"
    filled
    dense
    required
    :hint="product.quantite < 5 ? 'Quantité restante: ' + product.quantite : ''"
    :persistent-hint="product.quantite < 5"
    :disabled="product.quantite == 0"
    :error-messages="product.quantite == 0 ? 'Stock épuisé' : ''"
  ></v-text-field>
</template>
<script src="./updateQuantity.js"/>