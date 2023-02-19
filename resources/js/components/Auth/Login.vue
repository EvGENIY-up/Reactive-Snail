<template>
   <div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginTitle">Авторизация</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email (почта)</label>
                        <input v-model="email" type="email" class="form-control" id="loginlEmail" aria-describedby="loginEmail">
                        <div class="form-text">Введите ваш email</div>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Пароль</label>
                        <input v-model="password" type="password" class="form-control" id="loginPassword">
                         <div class="form-text">Введите ваш пароль</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click.prevent="defineUser" type="submit" class="btn btn-primary">Отправить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: "Login",
    inject: ['$Auth'],
    data() {
        return {
            email: null,
            password: null,
        }
    },
    mounted() {
    },
    methods: {
        defineUser() {
            axios.post('/api/login', {
                email: this.email,
                password: this.password,
            }).then(({data}) => {
                this.$Auth.login(data.token, data.user);
                this.$router.push('/');
            }).catch((error) => {
                console.log(error.data.message)
            })
        },
    }
}
</script>
<style>
</style>
    