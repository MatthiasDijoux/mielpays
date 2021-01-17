<template>
  <div class="text-center">
    <v-bottom-sheet v-model="sheet" inset>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          class="text-decoration-none mr-4"
          min-width="0"
          text
          block
          v-bind="attrs"
          v-on="on"
        >
          <v-icon class="mr-auto">{{ contentsValidate.iconValidate }}</v-icon> {{ contentsValidate.titleValidate }}
        </v-btn>
      </template>
      <v-sheet class="text-center pt-5" height="200px">
        <div class="mt-6">{{ contentsValidate.textValidate }}</div>
        <v-btn class="my-3" text color="success" @click="isValidate">
          Oui
        </v-btn>
        <v-btn class="my-3" text color="error" @click="sheet = !sheet">
          Annuler
        </v-btn>
      </v-sheet>
    </v-bottom-sheet>
  </div>
</template>

<script src='./validateOption.js' />