<template>
<div>
    <div>
        <Header></Header>
    </div>
    <div>
        <Main></Main>
    </div>
    <div>
        <Footer></Footer>
    </div>
</div>
</template>

<script>
    import Header from './Header.vue'
    import Footer from './Footer.vue'
    import Main from './Main.vue'
    export default {
     
        components: {
            Header,
            Main,
            Footer
        }
    }
</script>

