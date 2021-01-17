<template>
  <v-container>
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1"
          >Confirmation de la commande</v-stepper-step
        >

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2"
          >Adresse de livraison</v-stepper-step
        >

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 3" step="3">Paiement</v-stepper-step>
        <v-divider></v-divider>

        <v-stepper-step step="4">Confirmation</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <v-row class="d-flex align-center justify-center">
            <v-col
              v-for="(product, i) in order.orderList"
              :key="i"
              col="5"
              sm="5"
              md="5"
            >
              <v-card max-width="400" class="ma-5">
                <template slot="progress">
                  <v-progress-linear
                    color="deep-purple"
                    height="10"
                    indeterminate
                  ></v-progress-linear>
                </template>

                <v-img
                  height="250"
                  src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                ></v-img>

                <v-card-title>{{ product.name }}</v-card-title>

                <v-card-subtitle
                  v-text="'Prix:' + product.price"
                ></v-card-subtitle>
                <v-card-subtitle
                  v-text="'Nombre de produit:' + product.quantity"
                ></v-card-subtitle>
                <v-card-subtitle
                  v-text="'Total:' + product.price * product.quantity"
                ></v-card-subtitle>
              </v-card>
            </v-col>
          </v-row>
          <v-btn color="primary" @click="e1 = 2">Valider</v-btn>

          <v-btn to="/basket" text>Annuler</v-btn>
        </v-stepper-content>

        <v-stepper-content step="2" class="text-center">
          <span>Adresse de livraison</span>
          <v-row>
            <v-col col="2" md="4">
              <v-text-field
                label="Nom*"
                :rules="rules"
                v-model="order.adresseLivraison.nom"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Prenom*"
                :rules="rules"
                v-model="order.adresseLivraison.prenom"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Pays*"
                :rules="rules"
                v-model="order.adresseLivraison.pays"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Ville*"
                :rules="rules"
                v-model="order.adresseLivraison.ville"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Adresse*"
                :rules="rules"
                v-model="order.adresseLivraison.adresse"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Code Postal*"
                :rules="rules"
                v-model="order.adresseLivraison.codePostal"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-switch
            v-model="selectable"
            label="Changer adresse de facturation"
          ></v-switch>
          <div v-if="selectable">
            <v-divider></v-divider>

            <span>Adresse de facturation</span>
            <v-row>
              <v-col col="2" md="4">
                <v-text-field
                  label="Nom*"
                  :rules="rules"
                  v-model="order.adresseFacturation.nom"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Prenom*"
                  :rules="rules"
                  v-model="order.adresseFacturation.prenom"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Pays*"
                  :rules="rules"
                  v-model="order.adresseFacturation.pays"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Ville*"
                  :rules="rules"
                  v-model="order.adresseFacturation.ville"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Adresse*"
                  :rules="rules"
                  v-model="order.adresseFacturation.adresse"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Code Postal*"
                  :rules="rules"
                  v-model="order.adresseFacturation.codePostal"
                ></v-text-field>
              </v-col>
            </v-row>
          </div>
          <v-btn color="primary" :disabled="!valid" @click="e1 = 3"
            >Valider</v-btn
          >

          <v-btn text @click="e1 = 1">Retour</v-btn>
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-row justify="center">
            <v-expansion-panels v-model="panel" multiple hover>
              <v-expansion-panel>
                <v-expansion-panel-header>
                  <span>Récapitulatif de la commande :</span>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <v-row dense cols="12">
                    <v-col v-for="(product, i) in order.orderList" :key="i">
                      <v-card max-width="400" class="ma-5">
                        <template slot="progress">
                          <v-progress-linear
                            color="deep-purple"
                            height="10"
                            indeterminate
                          ></v-progress-linear>
                        </template>

                        <v-img
                          height="250"
                          src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                        ></v-img>

                        <v-card-title>{{ product.name }}</v-card-title>

                        <v-card-subtitle
                          v-text="'Prix:' + product.price"
                        ></v-card-subtitle>
                        <v-card-subtitle
                          v-text="'Nombre de produit:' + product.quantity"
                        ></v-card-subtitle>
                        <v-card-subtitle
                          v-text="'Total:' + product.price * product.quantity"
                        ></v-card-subtitle>
                      </v-card>
                    </v-col>
                  </v-row>
                </v-expansion-panel-content>
              </v-expansion-panel>
              <v-col>
                <v-expansion-panel>
                  <v-expansion-panel-header>
                    <span>Paiement:</span>
                  </v-expansion-panel-header>
                  <v-expansion-panel-content>
                    <v-stripe-card
                      v-model="source"
                      :api-key="apiKey"
                    ></v-stripe-card>
                  </v-expansion-panel-content>
                </v-expansion-panel>
              </v-col>
            </v-expansion-panels>
          </v-row>

          <v-btn
            color="success"
            @click="sendOrder(), (e1 = 4)"
            :disabled="!source"
            >Payer</v-btn
          >

          <v-btn text @click="e1 = 2">Retour</v-btn>
        </v-stepper-content>
        <v-stepper-content step="4">
          <v-card
            height="500px"
            width="500px"
            :loading="loading"
            id="card-paiement"
            class="mx-auto d-flex justify-center align-center"
          >
            <div v-if="status">
              <v-icon x-large dark color="green"
                >mdi-briefcase-check-outline</v-icon
              >
              Votre paiement pour MielPays.re à bien été confirmé !
              <br>
              Télécharger ma facture : 
              <v-btn @click="getFacture">
                <v-icon> mdi-download </v-icon>
              </v-btn>
            </div>
          </v-card>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-container>
</template>

    <script src="https://js.stripe.com/v3/"></script> 
<script src="./Panier.js"/>
<style lang="css">
#card-paiement {
  box-shadow: none;
}
</style>