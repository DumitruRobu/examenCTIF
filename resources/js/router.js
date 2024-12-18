import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Main',
            component: () => import('../js/components/Main.vue')
        },
        {
            path: '/about',
            name: 'About',
            component: () => import('../js/components/About.vue')
        },
    ]
})
export default router
