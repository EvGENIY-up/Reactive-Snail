<template>
<div class="content mx-3">
<div class="first d-flex justify-content-between">
    <h2 class="content__title mt-2 mx-2">Водители</h2>
    <router-link to="/person/create"><button type="button" class="btn btn-secondary my-2 mx-2">Добавить водителя +</button></router-link>
</div>
<div class="d-flex flex-wrap justify-content-center mx-3">
    <Item v-for="driver in drivers" :name="driver.name" :id="driver.id" :surname="driver.surname" :patronym="driver.patronym" :img="driver.img" class="cu-p" />
</div>
</div>
</template>

<script>
import Item from "./Item.vue"
export default {
    name: "IndexPerson",
    inject: ['$Auth'],
    components: {
        Item,
    },
    data() {
        return {
           drivers: [],
        } 
    },
    mounted() {
        this.getAllDrivers()
    },
    methods: {        
        getAllDrivers() {
            axios.get('/api/people').then((response) => {
                this.drivers = response.data.data
                console.log(response.data.data);
            }).catch((error) => {
                console.log(error)
            })
        },
         isUser() {
            return this.$Auth.check()
        }   
    },
   
}
</script>

<style scoped>
</style>