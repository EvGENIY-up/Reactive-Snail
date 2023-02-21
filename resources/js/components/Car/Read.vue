<template>
    <div class="book-content d-flex mx-4 my-4">
     <img v-if="!car.img" src="/img/book-img.png" width="370" height="600" alt="Обложка транспорта" class="book-content__img">
        <img v-else :src="car.img" width="370" height="600" alt="Фото транспорта" class="book-content__img">
        <div class="content-block d mx-5 my-5 ">
            <h3 class="my-4">Транспорт</h3>
            <p>Название: {{car.name}}</p>
            <p>Тип: {{car.type}}</p>
            <p>ФИО ответсвенного лица: {{car.person.name + ' ' + car.person.surname + ' ' + car.person.patronym}}</p>
            <p>Номер телефона: {{car.person.phone}}</p>
            <p>Email адресс: {{car.person.email}}</p>
            <p>Статус машины: {{car.status.name}}</p>
        </div>
    </div>
     <div class="change-book d-flex justify-content-end mx-3">
        <button type="button" @click="goBack" class="btn btn-secondary mx-5 solid cu-p">Вернуться назад</button>
        <button @click="goChange(car.id)" type="button" class="btn btn-primary">Редактировать</button>
        <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#deleteCar">Удалить</button>
    </div>
    <Delete :id="car.id"/>
</template>
<script>

//import Delete from "./Car.vue"
export default {
    name: "CarRead",
    components: {
        //Delete,
    },
    data() {
        return {
            car: {},
        }
    },
    mounted() {
       this.getPerson(this.$route.params.id)
    },
    methods: {
        getPerson(id) {
            axios.get(`/api/cars/${id}`).then((response) => {
                this.car = response.data.data
                console.log(response.data.data)
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