<template>
<div class="content mx-3">
<div class="first d-flex justify-content-between">
    <h2 class="content__title mt-2 mx-2">Машины:</h2>
    <router-link to="/car/create"><button type="button" class="btn btn-secondary my-2 mx-2">Добавить машину +</button></router-link>
</div>
<div class="d-flex flex-wrap mx-1 ">
    <Item @click="readCar(car.id)" v-for="car in cars" :name="car.name" :id="car.id" :type="car.type" :status="car.status.name" :img="car.img" class="cu-p" />
</div>
<button type="button" @click="goBack" class="btn btn-secondary mx-2 my-3 cu-p">Вернуться назад</button>
</div>
</template>

<script>
import Item from "./Item.vue"
export default {
    name: "IndexСar",
    inject: ['$Auth'],
    components: {
        Item,
    },
    data() {
        return {
           cars: [],
        } 
    },
    mounted() {
        this.getAllCars()
    },
    methods: {        
        getAllCars() {
            axios.get('/api/cars').then((response) => {
                this.cars = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        },
         isUser() {
            return this.$Auth.check()
        },
        readCar(id) {
            this.$router.push(`/car/${id}`)
        },
        goBack() {
            this.$router.push('/')
        },      
    },
   
}
</script>

<style scoped>
</style>