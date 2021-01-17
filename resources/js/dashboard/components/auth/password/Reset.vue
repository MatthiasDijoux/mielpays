<template>
  <div class="auth-form text-center">
    <form method="POST" v-on:submit.prevent="resetPassword">
      <label for="email" class="sr-only">Email address</label>
      <input
        type="email"
        id="email"
        class="form-control"
        placeholder="Email address"
        required
        autofocus
        v-model="user.email"
      />

      <input type="hidden" name="token" required v-model="token" />

      <label for="password" class="sr-only">Password</label>
      <input
        type="password"
        id="password"
        class="form-control"
        placeholder="Password"
        required
        v-model="user.password"
      />

      <label for="password_confirmation" class="sr-only"
        >Confirm Password</label
      >
      <input
        type="password"
        id="password_confirmation"
        class="form-control"
        placeholder="Password Confirmation"
        required
        v-model="user.password_confirmation"
      />

      <div class="alert alert-danger mt-3" role="alert" v-if="authErrors.any()">
        <div v-text="authErrors.get('email')"></div>
        <div v-text="authErrors.get('password')"></div>
      </div>

      <button class="btn btn-lg btn-primary btn-block mt-2 mb-2" type="submit">
        Reset Password
      </button>
    </form>
  </div>
</template>

<script src="./reset.js" />
