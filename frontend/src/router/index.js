import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import AdminDashboard from '../views/AdminDashboard.vue'
import Impot from '../components/Impot.vue'
import Nif from '../components/Nif.vue'
import Declaration from '../components/Declaration.vue'
import Utilisateur from '../components/Utilisateur.vue'
import Decl from '../components/Decl.vue'
import Accueil from '../components/Accueil.vue'

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login
  },
  {
    path: '/adminDashboard',
    name: 'adminDashboard',
    component: AdminDashboard,
    children: [
      {
        path: "",
        name: "accueil",
        component: Accueil
      },
      {
        path: "impot",
        name: "impot",
        component: Impot
      },
      {
        path: "nif",
        name: "nif",
        component: Nif
      },
      {
        path: "declaration",
        name: "declaration",
        component: Declaration
      },
      {
        path: 'decl/:id',
        name: 'decl',
        component: Decl
      },
      {
        path: "utilisateur",
        name: "utilisateur",
        component: Utilisateur
      },
    ]
    
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
