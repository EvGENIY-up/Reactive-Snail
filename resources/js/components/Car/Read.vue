<template>
    <div class="book-content d-flex mx-4 my-4">
     <img v-if="!car.img" src="/img/car.jpg" width="370" height="600" alt="Обложка транспорта" class="book-content__img">
        <img v-else :src="car.img" width="370" height="600" alt="Фото транспорта" class="book-content__img">
        <div class="content-block d mx-5 my-5 ">
            <h3 class="my-4">{{car.name}}</h3>
            <p>Тип: {{car.type}}</p>
            <p>ФИО ответсвенного лица: {{name + ' ' + surname+ ' ' + patronym}}</p>
            <p>Номер телефона: {{phone}}</p>
            <p>Email адресс: {{email}}</p>
            <p>Статус машины: {{status}}</p>
        </div>
    </div>
     <div class="change-book d-flex justify-content-end mx-3">
        <button type="button" @click="goBack" class="btn btn-secondary mx-5 solid cu-p">Вернуться назад</button>
        <button @click="goChange(car.id)" type="button" class="btn btn-primary">Редактировать</button>
        <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#deleteCar">Удалить</button>
    </div>
    <Delete @deleteCar="$forceUpdate" :id="car.id"/>
</template>
<script>

import Delete from "./Delete.vue"
export default {
    name: "CarRead",
    components: {
        Delete,
    },
    data() {
        return {
            car: {},
            name:'',
            surname:'',
            patronym: '',
            phone: '',
            email: '',
            status: '',
            
        }
    },
    mounted() {
       this.getPerson(this.$route.params.id)
    },
    methods: {
        getPerson(id) {
            axios.get(`/api/cars/${id}`).then((response) => {
                this.car = response.data.data
                this.name = this.car.person.name
                this.surname = this.car.person.surname
                this.patronym = this.car.person.patronym
                this.email = this.car.person.email
                this.phone = this.car.person.phone
                this.status =  this.car.status.name
            }).catch((error) => {
                console.log(error)
            })
        },
        goChange(id) {
            this.$router.push(`/car/update/${id}`)
        },
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }   
    }

}
</script>

<style>
    
</style>