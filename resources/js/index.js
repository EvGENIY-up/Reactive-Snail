import {createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import IndexPerson from "./components/Person/IndexPerson.vue"
import IndexCar from './components/Car/IndexCar.vue'
import PersonCreate from "./components/Person/Сreate.vue"
import CarCreate from "./components/Car/Сreate.vue"
import PersonRead from "./components/Person/Read.vue"
import PersonUpdate from "./components/Person/Update.vue"
import CarRead from "./components/Car/Read.vue"
import CarUpdate from "./components/Car/Update.vue"

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/person",
        name: "person",
        component: IndexPerson,
    },
    {
        path: "/car",
        name: "car",
        component: IndexCar,
    },
    {
        path: "/car/create",
        name: "carCreate",
        component: CarCreate,
    },
    {
        path: "/car/:id",
        name: "carRead",
        component: CarRead,
    },
    {
        path: "/car/update/:id",
        name: "carUpdate",
        component: CarUpdate,
    },
    {
        path: "/person/create",
        name: "personCreate",
        component: PersonCreate,
    },
    {
        path: "/person/:id",
        name: "personRead",
        component: PersonRead,
    },
    {
        path: "/person/update/:id",
        name: "personUpdate",
        component: PersonUpdate,
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;