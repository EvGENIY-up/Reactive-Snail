<template>
    <div class="modal fade" id="deleteCar" tabindex="-1" aria-labelledby="deleteCar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteBookTitle">Удаление трансопрта</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хоите удалить этот транспорт?
                <p class="fs-5 d-flex justify-content-center mt-2" :class="{'text-danger': hasError, 'text-success': noError}">{{message}}</p>
            </div>
            <div class="modal-footer">
                <button ref="closeButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
                <button @click="deleteCar()" type="submit" class="btn btn-danger">Да</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "DeleteCar",
    props: [
        'id',
    ],
    data() {
        return {
            message: '',
            noError: true,
            hasError: false,
        }
    },
    methods: {
        deleteCar() {
           axios.delete(`/api/cars/${this.id}`).then(res => {
                if (res.status === 200) {
                    this.message = "Вы успешно удалили транспорт"
                    this.$emit('deleteCar');
                    this.$refs.closeButton.click();
                    this.$router.push('/cars');
                }
                else {
                    this.message = "Произошла ошибка при удалении"
                }
            })
        }
    }
}
</script>
<style>
    
</style>