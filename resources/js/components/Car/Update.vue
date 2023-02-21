<template>
    <div class="update-car">
        <div class="d-flex justify-content-center">
            <div class="content-cr">
            <div class="modal-header">
                <h1 class="modal-title fs-4">Редактирование транспорта {{ name }}</h1>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input v-model="name" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label for="addBookYear" class="form-label">Тип</label>
                        <input v-model="surname" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Водитель тарнспорта</label>
                        <select v-model="person_id" class="form-select" required>
                            <option v-for=" driver in drivers" :value ="driver.id">{{driver.name + " " + driver.surname}}</option>  
                        </select>
                        <div class="form-text">Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Статус транспорта</label>
                        <select v-model="status_id" class="form-select" required>
                            <option v-for=" status in statuses" :value ="status.id">{{status.name}}</option>  
                        </select>
                        <div class="form-text">Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <p class="fs-5 d-flex justify-content-center mt-2" :class="{'text-danger': hasError, 'text-success': noError}">{{message}}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" @click="goBack" class="btn btn-secondary solid cu-p">Вернуться назад</button>
                    <button @click.prevent="updateCars" type="submit" class="btn btn-primary py-1">Редактировать</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "UpdateCar",
    data() {
        return {
            name: '',
            type: '',
            person_id: null,
            status_id: null,
            drivers: [],
            statuses: [],
            message: '',
            noError: true,
            hasError: false,
            car: {}
        }
    },
    mounted() {
        this.getCar(this.$route.params.id);
        this.getAllDrivers();
        this.getAllStatuses();  
    },
    methods: {
        getCar(id) {
            axios.get(`/api/car/${id}`).then((response) => {
                this.car = response.data.data
                this.name = this.car.name
                this.type = this.car.type
            }).catch((error) => {
                console.log(error)
            })
        },
        getAllDrivers() {
            axios.get('/api/people').then((response) => {
                this.drivers = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        },
        getAllStatuses() {
            axios.get('/api/statuses').then((response) => {
                this.statuses = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        },
        updateCars() {
            this.message = ''
            axios.put(`/api/cars/${this.$route.params.id}`, {
                name: this.name,
                type: this.type,
                person_id: this.person_id,
                status_id: this.status_id,
            }).then(response => {
                if (response.status === 200) {
                    this.noError = true
                    this.hasError = false
                    this.message = 'Вы успешно отредактировали водителя';
                }
            }).catch(error => {
                if (error.response) {
                    this.noError = false
                    this.hasError = true
                    this.message = error.response.data.message;
                    console.log(error.response.data.message);
                }
                else {
                    this.noError = false
                    this.hasError = true
                    this.message = 'Ошибка на стороне сервера';
                }
            })
        },
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }
    }
}
</script>
<style>
    
</style>