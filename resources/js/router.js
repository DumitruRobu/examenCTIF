import { createRouter, createWebHistory } from 'vue-router'
import api from './api';

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
        {
            path: '/login',
            name: 'Login',
            component: () => import('../js/components/LoginComponent.vue')
        },
        {
            path: '/register',
            name: 'Register',
            component: () => import('../js/components/RegisterComponent.vue')
        },
        {
            path: '/searchIban',
            name: 'SearchIban',
            component: () => import('../js/components/searchComponent.vue')
        },
        {
            path: '/admin',
            name: 'AdminMenu',
            component: () => import('../js/components/AdminComponent.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/admin/add',
            name: 'AdaugaUtilizator',
            component: () => import('../js/components/AdaugaUtilizator.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/admin/genereazaIban',
            name: 'GenereazaIban',
            component: () => import('../js/components/GenereazaIban.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/admin/creazaCodIban',
            name: 'creazaCodIban',
            component: () => import('../js/components/CreazaCodIban.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/admin/vizualizeazaCoduriIban',
            name: 'VizualizeazaCoduriIban',
            component: () => import('../js/components/VizualizeazaCoduriIban.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/user/:id',
            name: 'EditUser',
            component: () => import('../js/components/EditUsersPage.vue'),
            meta: {requiresAdmin: true},
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: () => import('../js/components/404.vue')
        },


    ]
})

router.beforeEach(async(to, from, next) => {
    const access_token = localStorage.getItem('access_token');
    if (access_token) {
        if (to.name === 'Login' || to.name === 'Register') {
            return next({name: 'SearchIban'});
        }
    }
    if (!access_token) {
        if (to.name === 'SearchIban') {
            return next({name: 'Login'});
        }
        if (to.name === 'AdminMenu') {
            return next({name: 'Login'});
        }

    }

    if(to.meta.requiresAdmin){
        try {
            const response = await api.get('/api/auth/getUser');
            const userRole = response.data.role[0].title;
            //const e_admin = userRole.some(role => role.title === 'admin');

            if (userRole === 'admin') {
                return next();
            } else {
                alert('Access denied. Admins only.');
                return next({ name: 'Main' });
            }
        } catch (error) {
            console.error('Error fetching user data:', error);
            return next({ name: 'Login' });
        }
    }

    next();
})

export default router
