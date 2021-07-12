<template>
    <div class="col">
        <div class="row">
            <div v-for="slider in listPopular" :key="slider.id" class="col-md-3">
                <div class="item">
                    <div class="pad15">
                        <img :src="image" class="img-responsive" height="100" width="90">
                        <p class="lead">{{ slider.book_title }}</p>
                        <p>{{ slider.author_id }}</p>
                        <p>{{ slider.book_price }}</p>
                        <p>{{ slider.book_summary }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
           
        },
        data() {
            return {
                slider: {
                    id:0,
                    image: '',
                    title: '',
                    author: '',
                    price: 0
                },
                listSliders: [],
                listPopular: [],
                error: null,
                image : 'http://127.0.0.1:8000/image/book_1.png'
            }
        },
        created() {
            this.getListPopular();
        },
        methods: {
            async getListPopular() {
                try {
                    const response = await axios.get('/api/getListBookPopular');
                    this.listPopular = response.data[0]
                } catch (error) {
                    this.error = error.response.data
                }
           },
        }
    }
</script>