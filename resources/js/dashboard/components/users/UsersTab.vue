<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="users"
      hide-default-footer
      class="elevation-1"
    >
      <template v-slot:item.name="{ item }">{{ item.name }}</template>
      <template v-slot:item.actions="{ item }">
        <v-row align="center">
          <addUpdate
            :user="item"
            :users="users"
            :isUpdate="true"
            @updateUser="update($event)"
          />
          <delete :user="item" :users="users" />
        </v-row>
      </template>
    </v-data-table>
  </v-container>
</template>

<script src='./usersTab.js' />