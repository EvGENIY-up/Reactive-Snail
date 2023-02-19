<template>
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="logoutTitle">Выход c аккаунта</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хоите выйти c аккаунта?
            </div>
            <div class="modal-footer">
                <button ref="closeButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
                <button @click="logOut()" type="submit" class="btn btn-danger">Да</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Logout",
    inject: ['$Auth'],
    methods: {
        logOut() {
            axios.get('/api/logout').then(({data}) => {
                    this.$Auth.logout(); //reset local storage
                    this.$router.push('/');
                    this.$emit('logout');       
                    this.$refs.closeButton.click();
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>
<style>
    
</style>