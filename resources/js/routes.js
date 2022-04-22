
import CategoryList from './components/category/List.vue';
import CategoryCreate from './components/category/Add.vue';
import CategoryEdit from './components/category/Edit.vue';
import CategoryView from './components/category/View.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Logout from './components/Logout.vue';

export const routes = [
    {
        name: 'Register',
        path: '/user_register',
        component: Register
    },
    {
        name: 'Login',
        path: '/user_login',
        component: Login
    },
    {
        name: 'Logout',
        path: '/logout',
        component: Logout
    },
    {
        name: 'categoryList',
        path: '/category',
        component: CategoryList
    },
    {
        name: 'categoryEdit',
        path: '/category/:id/edit',
        component: CategoryEdit
    },
    {
        name: 'categoryAdd',
        path: '/category/add',
        component: CategoryCreate
    },
    {
        name: 'categoryView',
        path: '/category/:id',
        component: CategoryView
    }
]