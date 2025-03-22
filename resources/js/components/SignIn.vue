<template>
  <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow p-4" style="width: 350px;">
      <h3 class="text-center mb-3">Sign In</h3>
      <form @submit.prevent="handleSignIn">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" id="email" class="form-control" v-model="email" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" v-model="password" required />
        </div>
        <router-link class="btn btn-primary w-100" to="/my-entries">Sign In</router-link>
      </form>
      <div class="text-center mt-3">
        <small>Don't have an account? <router-link to="/register">Sign up</router-link></small>
      </div>
    </div>
  </div>
</template>
