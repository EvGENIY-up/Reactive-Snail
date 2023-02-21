<template>
<div class="item">
    <img  v-if="!img" src="img/md.png" width="170" height="96" alt="Обложка" class="mini-book" >
    <img  v-else :src="img" width="170" height="96" alt="Обложка" class="mini-book">
    <h5>Машина</h5>
        <div className="d-flex">
            <div className="d-flex flex-column">
                <span>Имя: {{name}}</span>
                <span>Фамилия: {{type}}</span>
                <span>Отчество: {{status}}</span>
            </div>
        </div>
</div>
</template>

<script>
export default {
    name: "Car",
    props: [
        'id',
        'name',
        'type',
        'status',
        'img',
   ]
}
</script>

<style scoped>
</style>