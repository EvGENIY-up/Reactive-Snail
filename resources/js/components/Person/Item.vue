<template :value="id">
<div class="item" :value="id">
    <img  v-if="!img" :value="id" src="img/driver.png" width="170" height="96" alt="Обложка" class="mini-book" >
    <img  v-else :src="img" :value="id" width="170" height="96" alt="Обложка" class="mini-book">
    <h5 :value="id">Водитель</h5>
        <div  className="d-flex" :value="id">
            <div :value="id" className="d-flex flex-column">
                <span :value="id">Имя: {{name}}</span>
                <span :value="id">Фамилия: {{surname}}</span>
                <span :value="id">Отчество: {{patronym}}</span>
            </div>
        </div>
</div>
</template>

<script>
export default {
    name: "Person",
    props: [
        'id',
        'name',
        'surname',
        'patronym',
        'img',
   ]
}
</script>

<style scoped>
</style>