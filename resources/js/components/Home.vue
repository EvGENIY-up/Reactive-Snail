<template>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2 class="content__title mt-3 my-4 px-3">Таблица учёта траспорта</h2>
            <div class="d-flex">
                <p v-if="isUser()" class="mt-2 cu-p fs-4">Водители</p>
                <p v-if="isUser()" class="mt-2 px-3 cu-p fs-4">Транспорт</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Машины</th>
                        <th scope="col">Название</th>
                        <th scope="col">Тип</th>
                        <th scope="col">ФИО водителя</th>
                        <th scope="col">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="car in cars">
                        <th scope="row">{{ car.id }}</th>
                        <td>{{ car.name }}</td>
                        <td>{{ car.type }}</td>
                        <td>{{ car.person.name + ' ' + car.person.surname + ' ' + car.person.patronym}}</td>
                        <td>{{ car.status.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    inject: ['$Auth'],
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
            axios.get('/api/states').then((response) => {
                this.cars = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        },
         isUser() {
            return this.$Auth.check()
        }     
    }
}
</script>
