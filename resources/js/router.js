import { createRouter, createWebHistory } from "vue-router"
import MyEntries from './components/MyEntries.vue'
import Compose from './components/Compose.vue'
import ViewEntry from './components/ViewEntry.vue'
import SignIn from './components/SignIn.vue'
import axios from 'axios';

const routes = [

    {
        path:'/my-entries',
        component: MyEntries,
        meta: { requiresAuth: true }
    },
    {
        path:'/compose',
        component: Compose,
        meta: { requiresAuth: true }
    },
    {
        path:'/view/:id',
        component: ViewEntry,
        meta: { requiresAuth: true }
    },
    {
        path:'/sign-in',
        component: SignIn
    },
    {
        path: '/',
        redirect: '/my-entries'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.path === '/') {
      next('/my-entries');
    } else {
      next();
    }
  });

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    const isAuthenticated = !!token;

    if(to.meta.requiresAuth && !isAuthenticated){
        next('/sign-in');
    }else if(to.path === '/sign-in' && isAuthenticated){
        next('/my-entries');
    }else{

        if (isAuthenticated) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
          }

        next();
    }

})

export default router
