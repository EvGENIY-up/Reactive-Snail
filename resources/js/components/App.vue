<template>
   <Header/>
   <router-view></router-view>
   <Footer/>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
export default {
    name: "App",
    components: {
            Header,
            Footer,
        },
    mounted() {
        console.log('Component mounted.')
    },
    }
</script>
