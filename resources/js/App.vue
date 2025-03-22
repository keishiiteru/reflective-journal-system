<style scoped>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
</style>

<template>
    <Header v-if="!isSignInPage" />
    <div class="container-fluid">
        <div class="row">
            <Sidebar v-if="!isSignInPage" />
            <main :class="isSignInPage ? 'w-100' : 'col-md-9 ms-sm-auto col-lg-10 px-md-4'">
            <!-- Router Link -->
                <router-view/>
            </main>
        </div>
    </div>
</template>

<script setup>
    import { computed } from "vue";
    import { useRoute } from 'vue-router';
    import Sidebar from './layout/Sidebar.vue';
    import Header from './layout/Header.vue';

    const route = useRoute();
    const isSignInPage = computed(() => route.path === "/sign-in");

</script>
