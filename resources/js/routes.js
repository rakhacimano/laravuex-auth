import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
 
export const routes = [
    {
        name : 'login',
        path : '/',
        component : Login
    },
    {
        name : 'register',
        path : '/register',
        component : Register
    },
    {
        name : 'dashboard',
        path : '/dashboard',
        component : Dashboard
    },
]
