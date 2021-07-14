<style>
    
</style>
<template>
    <div class="container">
        <div class="row mb-1">
            <div class="col">
                On Sale
            </div>
            <div class="col text-right">
                <button type="button" class="btn btn-secondary">View All</button>
            </div>
        </div>
        <div class="row border mb-3">
            <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                <div class="MultiCarousel-inner">
                    <div v-for="slider in listSliders" :key="slider.id" class="item">
                        <div class="pad15">
                            <img :src="image" class="img-responsive" height="100" width="90">
                            <p class="lead">{{ slider.book_title }}</p>
                            <p>{{ slider.author_id }}</p>
                            <p>{{ slider.book_price }}</p>
                            <p>{{ slider.book_summary }}</p>
                        </div>
                    </div>

                </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
            </div>
        </div>
        <div>
            <div class="row"> 
                <div class="col text-center"><h3>Featured Books</h3> </div>
            </div>
            <div class="row mb-3">
                <div class="col text-right">
                    <button @click="swapComponent('RecommendBookComponent')" type="button" class="btn btn-secondary" v-bind:class="{disabled : disableRecommend}">Recommend</button>
                </div>
                <div class="col">
                    <button @click="swapComponent('PopularBookComponent')" type="button" class="btn btn-secondary" v-bind:class="{disabled : disablePopular}">Popular</button>
                </div>
            </div>
            <div class="row border" style="min-height:604px">
                <div :is="currentComponentBook"></div>
                <div v-show="!currentComponentBook">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RecommendBookComponent from './RecommendBookComponent.vue'
    import PopularBookComponent from './PopularBookComponent.vue'
     
      
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
                listRecomend: [],
                error: null,
                image : 'http://127.0.0.1:8000/image/book_1.png',
                currentComponentBook : RecommendBookComponent,
                disableRecommend : false,
                disablePopular : true
            }
        },
        created() {
            this.getListSlider();
            this.getListRecomend();
        },
        updated: function () {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');
            var itemWidth = "";

            $('.leftLst, .rightLst').click(function () {
                var condition = $(this).hasClass("leftLst");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });

            ResCarouselSize();

            $(window).resize(function () {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function () {
                    id = id + 1;
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    $(this).parent().attr("id", "MultiCarousel" + id);


                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    }
                    else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                    $(this).find(itemClass).each(function () {
                        $(this).outerWidth(itemWidth);
                    });

                    $(".leftLst").addClass("over");
                    $(".rightLst").removeClass("over");

                });
            }

            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftLst');
                var rightBtn = ('.rightLst');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");

                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                }
                else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");

                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }

            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }
        },
        methods: {
            async getListSlider() {
                try {
                    const response = await axios.get('/api/getBookSlider');
                    this.listSliders = response.data[0]
                } catch (error) {
                    this.error = error.response.data
                }
           },
            async getListRecomend() {
                try {
                    const response = await axios.get('/api/getListBookRecomend');
                    this.listRecomend = response.data[0]
                } catch (error) {
                    this.error = error.response.data
                }
           },
            swapComponent: function(component)
            {
                this.currentComponentBook = component;
                if (component == 'RecommendBookComponent') {
                    this.disableRecommend = false;
                    this.disablePopular = true;
                } else {
                    this.disableRecommend = true;
                    this.disablePopular = false;
                }
            }
        },
        components: {
            RecommendBookComponent,
            PopularBookComponent
        }
    }

</script>