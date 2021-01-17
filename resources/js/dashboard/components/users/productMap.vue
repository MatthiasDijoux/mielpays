<template>
  <div style="height: 500px; width: 100%">
    <l-map
      v-if="showMap"
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
      style="height: 80%"
    >
      <l-tile-layer :url="url" :attribution="attribution" />
      <l-marker
        v-for="producteur in listProducteurs"
        :key="producteur.id"
        :lat-lng="producteur.latLng"
      >
        <l-popup> </l-popup>
      </l-marker>
    </l-map>
  </div>
</template>
<script src="./productMap.js"/>