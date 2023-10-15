import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from '../stores/auth.js'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes:[
        {
            path : '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/login',
            name: 'login',
            component : () => import('../views/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component : () => import('../views/Register.vue')
        },
        {
            path: '/programas-academicos',
            name: 'programas-academicos',
            meta: { requiresAuth: true },
            component : () => import('../views/ProgramasAcademicos/Index.vue')
        },
        {
            path: '/edit/:id',
            name: 'edit',
            meta: { requiresAuth: true },
            component : () => import('../views/ProgramasAcademicos/Edit.vue')
        },
        {
            path: '/asignaturasbyprograma/:id',
            name: 'asignaturasbyprograma',
            meta: { requiresAuth: true },
            component : () => import('../views/ProgramasAcademicos/AsignaturasPrograma.vue')
        },
        {
            path: '/asignaturas',
            name: 'asignaturas',
            meta: { requiresAuth: true },
            component : () => import('../views/Asignaturas/Index.vue')
        },
        {
            path: '/create',
            name: 'create',
            meta: { requiresAuth: true },
            component : () => import('../views/Asignaturas/Create.vue')
        },
        {
            path: '/asignatura-edit/:id',
            name: 'asignatura-edit',
            meta: { requiresAuth: true },
            component : () => import('../views/Asignaturas/Edit.vue')
        },/*,
        {
            path: '/publicaciones',
            name: 'publicaciones',
            meta: { requiresAuth: true },
            component : () => import('../views/Publicaciones/Index.vue')
        },
        {
            path: '/publicacion/:id',
            name: 'publicacion',
            meta: { requiresAuth: true },
            component : () => import('../views/Publicaciones/Publicacion.vue')
        }*/
    ]
})

router.beforeEach( async (to) =>{
    const publicPages = ['/login', '/register']
    const authRequired = !publicPages.includes(to.path)
    const auth = useAuthStore()
    if(authRequired && !auth.user){
        auth.returnUrl = to.fullPath
        return '/login'
    }
})




export default router