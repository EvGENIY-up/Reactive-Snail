<template>
    <div class="create-person">
        <div class="d-flex justify-content-center">
            <div class="content-cr">
            <div class="modal-header">
                <h1 class="modal-title fs-4">Редактирование водителя {{ name }}</h1>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input v-model="name" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label for="addBookYear" class="form-label">Фамилия</label>
                        <input v-model="surname" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Отчество</label>
                        <input  v-model="patronym" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email(Почта)</label>
                        <input  v-model="email" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Номер телефона</label>
                        <input  v-model="phone" class="form-control">
                        <div class="form-text" >На усмотрение, номер телефон должен начинаться с +7</div>
                    </div>
                    <div class="mb-3">
                        <p class="fs-5 d-flex justify-content-center mt-2" :class="{'text-danger': hasError, 'text-success': noError}">{{message}}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p @click="goBack" class="mt-2 cu-p fs-5">Вернуться назад</p>
                    <button @click.prevent="updatePerson" type="submit" class="btn btn-primary py-1">Редактировать</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "UpdatePerson",
    data() {
        return {
            person: {},
            name:'',
            surname:'',
            patronym:'',
            email:'',
            phone:'',
            message: '',
            noError: true,
            hasError: false,
        }
    },
    mounted() {
       this.getPerson(this.$route.params.id)
    },
    methods: {
         getPerson(id) {
            axios.get(`/api/people/${id}`).then((response) => {
                this.person = response.data.data
                this.name = this.person.name
                this.surname = this.person.surname
                this.patronym = this.person.patronym
                this.email = this.person.email
                this.phone =  this.person.phone
            }).catch((error) => {
                console.log(error)
            })
        },
        updatePerson() {
            this.message = ''
            axios.put(`/api/people/${this.$route.params.id}`, {
                name: this.name,
                surname: this.surname,
                patronym: this.patronym,
                email: this.email,
                phone: this.phone,
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