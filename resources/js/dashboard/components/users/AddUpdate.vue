<template>
  <div>
    <v-btn
      @click.stop="(drawerRight = !drawerRight), updateUser(user)"
      text
      v-if="!isUpdate"
    >
      <v-icon class="ml-2 success--text">mdi-account-multiple-plus</v-icon>
    </v-btn>
    <v-btn
      @click.stop="(drawerRight = !drawerRight), updateUser(user)"
      icon
      class="success--text"
      v-if="isUpdate"
    >
      <v-icon class="ml-2">mdi-lead-pencil</v-icon>
    </v-btn>

    <v-navigation-drawer v-model="drawerRight" app temporary hide-overlay right>
      <v-btn
        @click="drawerRight = !drawerRight"
        icon
        class="red--text mr-5 mt-2"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title v-if="!isUpdate" class="title mt-3 text-center"
            >Ajouter l'utilisateur</v-list-item-title
          >
          <v-list-item-title v-if="isUpdate" class="title mt-3 text-center"
            >Modifier l'utilisateur</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
      <v-row class="mr-5 ml-5">
        <v-text-field
          v-model="name"
          label="Nom de l'utilisateur "
          required
        ></v-text-field>
      </v-row>
      <v-row class="mr-5 ml-5">
        <v-text-field
          v-model="email"
          label="Email de l'utilisateur "
          required
        ></v-text-field>
      </v-row>
      <template v-slot:append>
        <v-row>
          <v-col cols="12" md="6" sm="6">
            <v-btn class="success--text" text @click="addUpdateUser()">
              Valider
              <v-icon class="ml-3">mdi-check</v-icon>
            </v-btn>
          </v-col>
          <v-col cols="12" md="6" sm="6">
            <v-btn class="red--text" text @click="drawerRight = !drawerRight">
              Annuler
            </v-btn>
          </v-col>
        </v-row>
      </template>
    </v-navigation-drawer>
    <v-snackbar v-model="snackbar" :timeout="timeout">
      {{ text }}
      <v-btn color="blue" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>

<script src='./addUpdate.js' />