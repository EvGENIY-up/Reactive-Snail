<template>
<div class="item">
    <img  v-if="!img" src="img/car.jpg" width="165" height="96" alt="Обложка" class="mini-book" >
    <img  v-else :src="img" width="165" height="96" alt="Обложка" class="mini-book">
    <p class="my-2 fs-5">{{name}}</p>
        <div className="d-flex">
            <div className="d-flex flex-column">
                <span>Тип: {{type}}</span>
                <span>Статус: {{status}}</span>
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