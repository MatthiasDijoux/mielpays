<template>
  <div>
    <v-container>
      <v-row>
        <v-col col="12" md="12">
          <productMap :producteurs="producteurs" />
        </v-col>
        <v-col col="12" md="12">
          <popularProducts :products="popularProducts" />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script src='./accueil.js' />