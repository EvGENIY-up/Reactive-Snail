<template>
<div class="header d-flex justify-content-between m-4 border-bottom">
    <div class="left-content d-flex">
         <router-link to="/"><img src="img/car.svg" alt="Машинка" class="left-content__img my-3 cu-p" width="70" height="70" ></router-link>
        <div class="name-content ms-3 mt-3">
            <h2 class="site-title">Reactive Snail</h2>
            <p class="site-decription">Сервис по учёту транспорта</p>
        </div>
    </div>
    <div class="right-content d-flex mt-4">
        <p v-if="user" class="login-name">{{user}}</p>
        <template v-else>
            <button type="button" class="btn btn-primary mt-2 in-button" data-bs-toggle="modal" data-bs-target="#authModal">Вход</button>
            <button type="button" class="btn btn-secondary mt-2 reg-button" data-bs-toggle="modal" data-bs-target="#regisModal">Регистрация</button>
        </template>
        <button v-if="user" type="button" class="btn btn-warning mt-2 out-button" data-bs-toggle="modal" data-bs-target="#authOutModal">Выход</button>
    </div>
</div>
</template>

<script>

import axios from "axios"
export default {
    name: "HeaderComponent",
    props: [
        'user',
        'admin'
    ],
    components: {
    },
    methods: {
        
    },
    mounted() {
        console.log(this.user);
    },
}
</script>

<style scoped>
</style>
