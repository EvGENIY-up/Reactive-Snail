<template>
    <div class="book-content d-flex mx-4 my-4">
     <img v-if="!person.img" src="/img/book-img.png" width="370" height="600" alt="Обложка книги" class="book-content__img">
        <img v-else :src="person.img" width="370" height="600" alt="Фото работника" class="book-content__img">
        <div class="content-block d mx-5 my-5 ">
            <h3 class="title">Водитель</h3>
            <p class="author">Имя: {{person.name}}</p>
            <p class="genre">Фамилия: {{person.surname}}</p>
            <p class="genre">Отчество: {{person.patronym}}</p>
            <p>Номер телефона: {{person.phone}}</p>
            <p>Email адресс: {{person.email}}</p>
        </div>
    </div>
</template>
<script>
export default {
    name: "PersonShow",
    data() {
        return {
            person: {},
        }
    },
    mounted() {
       this.getPerson(this.$route.params.id)
    },
    methods: {
        getPerson(id) {
            axios.get(`/api/people/${id}`).then((response) => {
                this.person = response.data.data
                console.log(response.data.data);
            }).catch((error) => {
                console.log(error)
            })
        },
    }
}
</script>

<style>
    
</style>