<template>
     <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Reflective Journal System</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <button class="nav-link px-3" @click="logout">Sign out</button>
            </div>
        </div>
     </header>
</template>

<script setup>
    import { ref } from "vue"
    import { useRouter } from "vue-router"

    const logout = async() => {
        try
        {
            await axios.post('/api/logout')
        } catch (error) {
            console.error(error)
        }

         // Clear the token from storage
        localStorage.removeItem('token');

        // Redirect to sign-in page
        window.location.href = '/';
    }

</script>
