<template>
  <v-container>
    <v-row align="center">
      <v-col cols="12" md="6" sm="6">
        <addUpdate @addUser="add($event)" />
      </v-col>
      <v-col cols="12" md="6" sm="6">
        <v-text-field
          v-model="search"
          placeholder="Rechercher un utilisateur.."
          append-icon="mdi-magnify"
          hide-details
        />
      </v-col>
    </v-row>
    <v-row align="center" justify="end">
      <v-btn
        text
        class="success--text"
        v-if="!activeTab"
        @click="(activeCard = !activeCard), (activeTab = true)"
        ><v-icon>mdi-card-bulleted</v-icon>
      </v-btn>
      <v-btn
        text
        class="success--text"
        v-if="!activeCard"
        @click="(activeTab = !activeTab), (activeCard = true)"
        ><v-icon>mdi-table-eye</v-icon>
      </v-btn>
    </v-row>
    <v-row v-if="search == '' && !activeCard">
      <v-col cols="12" md="4" v-for="(user, key) in users" :key="key">
        <usersCard :user="user" :users="users" />
      </v-col>
    </v-row>

    <v-row v-if="search != '' && !activeCard">
      <v-col cols="12" md="4" v-for="(user, key) in filteredList" :key="key">
        <usersCard :user="user" :users="users" />
      </v-col>
    </v-row>
    <v-row v-if="search == '' && !activeTab">
      <usersTab :users="users" :user="users" />
    </v-row>
    <v-row v-if="search != '' && !activeTab">
      <usersTab :users="filteredList" />
    </v-row>
    <div class="text-center pt-2 mb-10">
      <v-pagination
        :length="pagination.pageCount"
        color="success"
        v-model="pagination.page"
        @input="nextPageUsers"
        circle
      ></v-pagination>
    </div>
    <baseSnackbar/>
  </v-container>
</template>

<script src='./users.js' />