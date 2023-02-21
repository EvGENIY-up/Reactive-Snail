<template>
    <div class="book-content d-flex mx-4 my-4">
     <img v-if="!person.img" src="/img/driver.png" width="370" height="600" alt="Обложка книги" class="book-content__img">
        <img v-else :src="person.img" width="370" height="600" alt="Фото работника" class="book-content__img">
        <div class="content-block d mx-5 my-5 ">
            <h3 class="title">Водитель</h3>
            <p class="author">Имя: {{person.name}}</p>
            <p class="genre">Фамилия: {{person.surname}}</p>
            <p class="genre">Отчество: {{person.patronym}}</p>
            <p>Номер телефона: {{person.phone}}</p>
            <p>Email адресс: {{person.email}}</p>
        </div>
    </div>
     <div class="change-book d-flex justify-content-end mx-3">
        <button type="button" @click="goBack" class="btn btn-secondary mx-5 solid cu-p">Вернуться назад</button>
        <button @click="goChange(person.id)" type="button" class="btn btn-primary">Редактировать</button>
        <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#deletePerson">Удалить</button>
    </div>
    <Delete :id="person.id"/>
</template>
<script>

import Delete from "./Delete.vue"
export default {
    name: "PersonRead",
    components: {
        Delete,
    },
    data() {
        return {
            person: {},
        }
    },
    mounted() {
       this.getPerson(this.$route.params.id)
    },
    methods: {
        getPerson(id) {
            axios.get(`/api/people/${id}`).then((response) => {
                this.person = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        },
        goChange(id) {
            this.$router.push(`/person/update/${id}`)
        },
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }   
    }
}
</script>

<style>
    
</style>