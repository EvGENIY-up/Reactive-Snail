import {createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import IndexPerson from "./components/Person/IndexPerson.vue"
//import IndexCar from './components/Car/IndexCar.vue'
import PersonCreate from "./components/Person/Сreate.vue"

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
      /*{
        path: "/car",
        name: "car",
        component: IndexCar,
    },*/
    {
        path: "/person/create",
        name: "personCreate",
        component: PersonCreate,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;