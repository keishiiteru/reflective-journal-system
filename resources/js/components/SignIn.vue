<template>
  <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow p-4" style="width: 350px;">
      <h3 class="text-center mb-3">Sign In</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" id="email" class="form-control" v-model="form.email" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" v-model="form.password" />
        </div>
        <button class="btn btn-primary w-100" type="submit">Sign In</button>
      </form>
      <!-- <div class="text-center mt-3">
        <small>Don't have an account? <router-link to="/register">Sign up</router-link></small>
      </div> -->
    </div>
  </div>
</template>

<script setup>
    import { ref } from "vue"
    import { useRouter } from "vue-router"

    const form = ref({
        email: '',
        password: ''
    })

    const submitForm = async() => {
        try {
            const res = await axios.post('/api/login',form.value)
            const token = res.data.token
            const user = res.data.user

            if(token){
                localStorage.setItem('token', token)
                localStorage.setItem('user', JSON.stringify(user))
                window.location.href = '/'
            }

        } catch (error) {
            console.error(error)
        }
    }

</script>
