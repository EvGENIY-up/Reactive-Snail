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
        <p v-if="isUser()" class="login-name">{{$Auth.user.name}}</p>
        <template v-else>
            <button type="button" class="btn btn-primary mt-2 in-button" data-bs-toggle="modal" data-bs-target="#login">Вход</button>
            <button type="button" class="btn btn-secondary mt-2 reg-button" data-bs-toggle="modal" data-bs-target="#register">Регистрация</button>
        </template>
        <button  v-if="isUser()" type="button" class="btn btn-warning mt-2 out-button" data-bs-toggle="modal" data-bs-target="#logout">Выход</button>
    </div>
    <Login @login="$forceUpdate"/>
    <Logout @logout="$forceUpdate"/>
    <Register @register="$forceUpdate"/>
</div>
</template>

<script>
import Login from './Auth/Login.vue'
import Logout from './Auth/Logout.vue'
import Register from './Auth/Register.vue'
export default {
    name: "Header",
    inject: ['$Auth'],
    components: {
        Login,
        Logout,
        Register,
    },
    methods: {  
          isUser() {
            return this.$Auth.check()
        }
    },
    mounted() {
    },
   
}
</script>

<style scoped>
</style>
