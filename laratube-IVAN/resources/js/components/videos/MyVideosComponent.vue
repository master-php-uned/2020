<template>

    <div>

        <div class="card-header">Videos : {{videos.length}}</div>

        <div class="card-body pb-2">

            <form-videos-component
                @new="addVideo">
            </form-videos-component>

            <div v-if="downloaded">
                <videos-component
                    v-for="video in videos"
                    :key="video.id"
                    :videos="video"
                    :allCategories="allCategories"
                    >
                </videos-component>
            </div>

        </div>

        <ul class="pagination-block">
            <li v-for="pageNumber in last_page" v-if=" pageNumber == 1 || pageNumber == last_page || pageNumber == current_page - 2  || pageNumber == current_page - 1 || pageNumber == current_page || pageNumber == current_page + 1 || pageNumber == current_page + 2">
                <a href="#" class="cursor-pointer" @click="setPage(pageNumber)"  :class="{current: current_page === pageNumber, last: (pageNumber == totalPages - 1 && Math.abs(pageNumber - current_page) > 3), first:(pageNumber == 0 && Math.abs(pageNumber - current_page) > 3)}">{{ pageNumber }}</a>
            </li>
        </ul>


    </div>
</template>

<script>
    export default {

        data(){
            return {
                videos: [],
                current_page: 0,
                first_page_url: "",
                last_page: 0,
                last_page_url: "",
                next_page_url: "",
                path: "",
                per_page: 0,
                prev_page_url: "",
                to: 0,
                total: 0,
                allCategories: [],
                downloaded:false,
            }
        },
        mounted() {
            console.log('MyvideosComponent mounted.')
            this.getData();

            axios.get('api/categories').then((response) => {

                let allCats = response.data;
                console.log("**");
                console.log(allCats);
                allCats.forEach(item => {item.selected = false;});
                this.allCategories = allCats;
                console.log(allCats);
                console.log("-**-");
                this.downloaded = true;
            });


        },
        computed: {
            totalPages: function() {
                return Math.ceil(this.total / this.per_page);
            },
        },
        methods: {
            setPage(current){
                this.current_page = current;
                this.getData();
            },
            getData(){
                axios.get('api/list?page=' + this.current_page)
                    .then((response) => {
                        this.videos = response.data.data;
                        this.current_page = response.data.current_page;
                        this.first_page_url = response.data.first_page_url;
                        this.last_page = response.data.last_page;
                        this.last_page_url = response.data.last_page_url;
                        this.next_page_url = response.data.next_page_url;
                        this.path = response.data.path;
                        this.per_page = response.data.per_page;
                        this.prev_page_url = response.data.prev_page_url;
                        this.to = response.data.to;
                        this.total = response.data.total;
                    });
            },
            addVideo(video) {
                this.videos.push(video);
            }
        }
    }
</script>
