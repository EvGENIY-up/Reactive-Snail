<template>
    <div class="modal fade" id="deletePerson" tabindex="-1" aria-labelledby="deletePerson" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteBookTitle">Удаление водителя</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хоите удалить этого водителя?
                <p class="fs-5 d-flex justify-content-center mt-2" :class="{'text-danger': hasError, 'text-success': noError}">{{message}}</p>
            </div>
            <div class="modal-footer">
                <button ref="closeButton" type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
                <button @click="deletePerson()" type="submit" class="btn btn-danger">Да</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "DeletePerson",
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
        deletePerson() {
           axios.delete(`/api/people/${this.id}`).then(res => {
                if (res.status === 200) {
                    this.message = "Вы успешно удалили водителя"
                    this.$emit('deletePerson');
                    this.$refs.closeButton.click();
                    this.$router.push('/person');
                }
                else {
                    this.message = "Произошла ошибка при удалении"
                }
           }).then(
                
            )
        }
    }
}
</script>
<style>
    
</style>