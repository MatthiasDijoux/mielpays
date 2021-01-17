<template>
  <div>
    <v-btn fab dark small color="primary" @click.stop="drawer = !drawer">
      <v-icon v-if="modification"> mdi-pencil </v-icon>
      <v-icon v-if="!modification"> mdi-plus </v-icon>
    </v-btn>
    <v-navigation-drawer app v-model="drawer" temporary bottom right>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title></v-list-item-title>
            <v-row>
              <v-col>
                <v-text-field v-model="nom" label="Nom"></v-text-field>
                <v-text-field
                  type="number"
                  v-model="quantite"
                  label="Quantite"
                ></v-text-field>
                <v-text-field
                  type="number"
                  v-model="prix"
                  label="prix"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-btn v-if="modification" @click="modifyProduct">
              <v-icon> mdi-check </v-icon>
            </v-btn>
            <v-btn v-if="!modification" @click="addProduct">
              <v-icon> mdi-check </v-icon>
            </v-btn>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script src="./Drawer.js"/>