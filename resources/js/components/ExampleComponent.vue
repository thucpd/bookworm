<template>
<div>
    <div>
        <Header></Header>
    </div>
    <div>
        <Home></Home>
    </div>
    <div>
        <Footer></Footer>
    </div>
</div>
</template>

<script>
    import Header from './Header.vue'
    import Footer from './Footer.vue'
    import Home from './Home.vue'
    import Shop from './Shop.vue'
    export default {
        data : {
            currentPage: Home
        },
        components: {
            Header,
            Home,
            Footer,
            Shop,
        }
    }
</script>

