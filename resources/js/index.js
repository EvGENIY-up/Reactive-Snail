import {createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import IndexPerson from "./components/Person/IndexPerson.vue"
import IndexCar from './components/Car/IndexCar.vue'
import PersonCreate from "./components/Person/Сreate.vue"
import CarCreate from "./components/Car/Сreate.vue"
import PersonShow from "./components/Person/Show.vue"
import PersonUpdate from "./components/Person/Update.vue"

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
        path: "/person/create",
        name: "personCreate",
        component: PersonCreate,
    },
    {
        path: "/car/create",
        name: "carCreate",
        component: CarCreate,
    },
    {
        path: "/person/:id",
        name: "personShow",
        component: PersonShow,
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