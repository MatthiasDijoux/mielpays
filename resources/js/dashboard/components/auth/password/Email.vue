<template>
    <v-container class="auth-form text-center">

        <form method="POST" v-on:submit.prevent="sendPasswordResetEmail" v-if="seconds>4">

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus v-model="email">

            <button class="btn btn-lg btn-success btn-block mt-2 mb-2" type="submit" :disabled="disableSubmit">Send Email</button>
            Go back to <router-link :to="{ name: 'login' }">login</router-link> page.
        </form>


        <div class="container" v-else>
            <h2 class="text-success mt-5">Password recovery email sent!</h2>

            <div class="progress mt-3 mb-3 ml-5 mr-5">
                <div class="progress-bar bg-success" role="progressbar" :style="progress" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <h3>Redirecting in {{seconds}} seconds</h3>

        </div>

    </v-container>
</template>

<script src='./email.js' />