<template>
   <div class="create-car">
        <div class="d-flex justify-content-center">
            <div class="content-cr">
            <div class="modal-header">
                <h1 class="modal-title fs-4">Добавление транспорта</h1>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название транспорта </label>
                        <input v-model="name" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="mb-3">
                        <label for="addBookYear" class="form-label">Тип транспорта</label>
                        <input v-model="surname" type="text" class="form-control" required>
                        <div class="form-text" >Обязательное поле</div>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label class="d-flex">
                            <input class="w-75" type="file" id="fileCar" name="fileCar" accept=".jpg, .jpeg, .png" ref="fulpoad" @change="onFileChange"/>
                            <input class="sizeImg w-25" v-model="formData.displayFileSize" type="text" readonly/>
                        </label>
                    </div>
                    <div class="mb-3">
                        <p class="fs-5 d-flex justify-content-center mt-2" :class="{'text-danger': hasError, 'text-success': noError}">{{message}}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <router-link to="/car"><p class="mt-2 cu-p fs-5">Вернуться назад</p></router-link>
                    <button @click.prevent="createPerson" type="submit" class="btn btn-primary py-1">Добавить</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "CreatePerson",
    data() {
        return {
            formData: {
                displayFileSize: null,
                linkFileBase64: null,
                file: null,
            },
            name: '',
            surname: '',
            patronym: '',
            email: '',
            phone: '',
            message: '',
            file: '',
            img: '',
            noError: true,
            hasError: false,
        }
    },
    methods: {
        convertFileToLink(file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.formData.linkFileBase64 = event.target.result
            };
            reader.readAsDataURL(file);
        },
        onFileChange(event) {
            if (event.target.files && event.target.files.length) {
                let file = event.target.files[0];
                this.formData.file = file;
                this.formData.displayFileSize = '(' + this.calcSize(file.size) + 'Kb)';
                this.convertFileToLink(this.formData.file);
            }
        },
        calcSize(size) {
            return Math.round(size / 1024);
        },
        createPerson() {
            axios.post('/api/cars', {
                name: this.name,
                surname: this.surname,
                patronym: this.patronym,
                img: this.formData.linkFileBase64,
                email: this.email,
                phone: this.phone,
            }).then(response => {
                if (response.status === 200) {
                    this.noError = true
                    this.hasError = false
                    this.message = 'Вы успешно добавили транспорт';
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
    }
}
</script>
<style>
    
</style>