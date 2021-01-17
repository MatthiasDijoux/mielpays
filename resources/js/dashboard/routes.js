import Vue from 'vue';
import VueRouter from 'vue-router';
import Accueil from './views/Accueil.vue';
import Profil from './views/Profil.vue';
import Login from './login/Login.vue';
import Users from './views/Users.vue';
import { Role } from './_helpers/role.js';
import PasswordEmail from './components/auth/password/Email.vue';
import PasswordReset from './components/auth/password/Reset.vue';
import { authenticationService } from "./_services/authentication.service";
import Dashboard from './views/producteur/Dashboard.vue';
import ProducerProfile from './views/producteur/ProducerProfile.vue';
import Boutique from './views/Boutique.vue';
import Panier from './views/Panier.vue';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'accueil',
            component: Accueil,
        },
        {
            path: '/profil',
            name: 'profil',
            component: Profil,
            meta: { authorize: [Role.Admin] }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/boutique',
            name: 'boutique',
            component: Boutique,
        },
        {
            path: '/panier',
            name: 'panier',
            component: Panier,
        },
        {
            path: '/producteur/:id/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { authorize: [Role.Producteur] }
        },
        {
            path: '/producteur/:id/',
            name: 'producer-profile',
            component: ProducerProfile,
            meta: { authorize: [Role.Producteur] }
        },
        {
            path: '/password/reset/',
            name: 'password-email',
            component: PasswordEmail,
        },

        {
            path: '/password/reset/:token',
            name: 'password-reset',
            component: PasswordReset,
        },

        {
            path: '/users',
            name: 'users',
            component: Users,
            meta: { authorize: [Role.Admin] }
        },

    ]
})


router.beforeEach((to, from, next) => {

    // redirect to login page if not logged in and trying to access a restricted page
    const { authorize } = to.meta;

    if (authorize && !_.isEmpty(authorize)) {

        const currentUser = authenticationService.currentUserValue;

        if (!currentUser) {
            // not logged in so redirect to login page with the return url
            return next({ path: "/login", query: { returnUrl: to.path } });
        }

        // check if route is restricted by role
        if (authorize.length && !authorize.includes(currentUser.id_role.name)) {
            // role not authorised so redirect to home page
            return next({ path: "/" });
        }

    }

    return next();
});




export default router;