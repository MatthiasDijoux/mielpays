<template>
  <v-row justify="end">
    <v-dialog v-model="dialog" persistent max-width="290">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" icon class="red--text mr-5 mt-2">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline text-center"
          >Supprimer l'utilisateur {{ user.name }}?</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" text @click="dialog = false"
            >Annuler</v-btn
          >
          <v-btn
            color="green darken-1"
            text
            @click="
              deleteUser(user);
            "
            >Continuer</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    
  </v-row>
</template>

<script src='./delete.js' />
