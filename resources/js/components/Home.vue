<template>
    <div class="container">
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
        }     
    }
}
</script>
