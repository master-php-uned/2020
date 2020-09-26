<template>
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="">

                    <div class="row m-1 border">

                        <div class="col-md-2 p-2">

                            <img class="w-100 border border-1" v-bind:src="getImgUrl(videos.url)" alt="">

                        </div>

                        <div class="col-md-5 p-2 border-left">

                            <div>

                                <span v-if="!this.updating" class="">{{ getTitle(videos) }}</span>

                                <div v-else class="">

                                    <div>

                                        Obteniendo datos

                                    </div>

                                    <div class="spinner-border mi-spinner text-primary" role="status">

                                        <span class="sr-only">Loading...</span>

                                    </div>

                                </div>

                            </div>

                            <div v-if="videos.data == '' && !this.updating" v-on:click="getData()" class="category cursor-pointer mr-0 mt-1 mb-0 my-badge my-data-add badge-primary">Get Data</div>

                        </div>

                        <div class="col-md-5 p-0 border-left">

                            <div class="mr-1">

                                <category-video-component
                                    v-for="category in videos.categories"
                                    :key="videos.categories.id"
                                    :category="category"
                                    @remove="removeCategory">
                                </category-video-component>

                                <span class="category cursor-pointer mr-0 ml-1 mt-1 mb-0 my-badge my-category-add badge-primary" v-on:click="add()">+</span>

                                <panel-category-component :myCategories="myCategories" :allCategories="allCategories" :video="videos" :visible="visible" @changeCategory="changeCategory" @close="close"></panel-category-component>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>


    let url_youtube = "https://img.youtube.com/vi/";

    export default {

        props: ['videos','allCategories'],

        data(){
            return {
                updating: false,
                myCategories: [],
                visible:false
            }
        },
        mounted() {
            console.log('VideosComponent mounted.');

            this.myCategories = this.videos.categories;

            console.log('video component: allCategories .');
            console.log(this.allCategories);

        },
        methods:{
            getImgUrl(hash)
            {
                return url_youtube + hash + '/mqdefault.jpg'
            },
            getTitle(video)
            {
                if(video.data != null && video.data != "")
                {
                    let dataParse = JSON.parse(video.data);
                    return dataParse.items[0].snippet.title;
                }
                else
                {
                    return 'No data';
                }
            },
            removeCategory(category)
            {
               this.videos.categories.splice(this.videos.categories.indexOf(category), 1);

               console.log('category.id:' + category.id);
               console.log('videos.id:' + this.videos.id);

               axios.delete('api/video-category/' + category.id, { data: { video_id: this.videos.id } }).then(function (response) {
                   // Do something
                   //console.log(response.data);
               });

            },
            changeCategory(category){
                console.log("changeCategory");
                console.log(this.videos.categories);

                this.videos.categories.push({ id: category.id, name:category.name, visible:category.visible });
            },
            getData(){

                this.updating = true;
                console.log('url:' + this.videos.url);

                let that = this;

                axios.put('api/pointer/' + this.videos.url , { localizador: this.videos.url } ).then(function (response) {

                    setTimeout(function() {

                        axios.get('api/video/' + that.videos.id ).then(function (response) {

                            that.videos.data = response.data.data;
                            that.updating = false;
                        });
                    }, 2000);
                });
            },
            add(){
                console.log("add parent");
                this.visible=true;
            },
            close(){
                console.log("close parent");
                this.visible=false;
            }
        }
    }
</script>
