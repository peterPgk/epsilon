import Vue from 'vue';
import VueRouter from "vue-router";
import ServicesListPage from "./components/pages/ServicesListPage";
import ServicePage from "./components/pages/ServicePage"
import HomePage from "./components/pages/HomePage";
import Login from "./components/pages/auth/Login";
import Logout from "./components/pages/auth/Logout";

import {store} from './store'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresVisitor: true
            }
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout
        },
        {
            path: '/services',
            name: 'services',
            component: ServicesListPage,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/service/:id',
            name: 'service',
            component: ServicePage,
            meta: {
                requiresAuth: true
            }
        }
    ],
    mode: 'history',
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in if not, redirect to login page.
        if (!store.getters.loggedIn) {
            next({
                name: 'login'
            })
        } else {
            next()
        }
    }
    else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'services'
            })
        } else {
            next()
        }
    }
    else {
        next() // make sure to always call next()!
    }
});

export default router;
