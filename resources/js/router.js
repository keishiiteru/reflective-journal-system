import { createRouter, createWebHistory } from "vue-router"
import MyEntries from './components/MyEntries.vue'
import Compose from './components/Compose.vue'
import ViewEntry from './components/ViewEntry.vue'

const routes = [

    {
        path:'/my-entries',
        component: MyEntries
    },
    {
        path:'/compose',
        component: Compose
    },
    {
        path:'/view/:id',
        component: ViewEntry
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

export default router
