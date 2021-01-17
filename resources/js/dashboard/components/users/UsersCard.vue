<template>
  <v-card class="mx-auto" max-width="344" outlined>
    <delete :user="user" :users="users" />
    <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-title class="headline text-center mb-5">{{
          user.name
        }}</v-list-item-title>
        <v-list-item-subtitle>email : {{ user.email }}</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-card-actions>
      <addUpdate :user="user" :isUpdate="true" @updateUser="update($event)" />
    </v-card-actions>
  </v-card>
</template>

<script src='./usersCard.js' />