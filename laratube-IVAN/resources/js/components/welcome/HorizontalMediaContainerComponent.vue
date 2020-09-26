<template>

    <div class="horizontal-component">

         <div class="text-light titulo-horizontal m-0 p-2 pl-5 ">{{horizontal.name}} : {{this.countVideos}}</div>


        <arrow-component
            v-for="arrow in arrows"
            :key="arrow.id"
            :ref="'arrow-' + arrow.id"
            :event="arrow.event"
            :spansubclass="arrow.spansubclass"
            v-if="arrow.show"
            :arrow="arrow"
            @back="back"
            @next="next">
            {{ arrow.content }}
        </arrow-component>


        <div class="media-container contribution-layer overflow-hidden">
            <ul v-model="mediacontainer" class="w-100 d-flex horizontal-padding movement"
                v-bind:style="{ transform: 'translate3d('+ mediacontainer.x + 'px, 0px, 0px)' }">

                <media-component
                    v-for="video in videos"
                    :key="videos.id"
                    :videos="video">
                </media-component>

            </ul>
        </div>

    </div>

</template>


<script>

export default {

    props: ['horizontal'],

    data() {

        return {
            title:'',
            mediacontainer: {
                x: 0, page: 0
            },
            videos: [],
            arrows: [
                {
                    id: "left",
                    content: '<',
                    classname: 'left-arrow container-arrow',
                    spansubclass: 'arrow l-arrow text-white',
                    event: 'back',
                    show: false
                },
                {
                    id: "rigth",
                    content: '>',
                    classname: 'right-arrow container-arrow',
                    spansubclass: 'arrow r-arrow text-white',
                    event: 'next',
                    show: false
                }
            ],
            countVideos: 0
        }
    },
    mounted() {

        console.log(this);

        console.log('horizontal-media-container mounted.')

        axios.get('api/videos/' + this.horizontal.id)
            .then((response) => {
                this.videos = response.data;

                this.countVideos = Object.keys(this.videos).length;

                // this.countVideos = 13;
                this.showUIArrows();
            });
    },
    methods: {
        addVideo(video) {
            this.videos.push(video);
        },
        back: function () {

            console.log("back");

            this.mediacontainer.x += 1700;
            this.mediacontainer.page--;

            this.showUIArrows();
        },
        next: function () {

            console.log("next");

            this.mediacontainer.x -= 1700;
            this.mediacontainer.page++;

            this.showUIArrows();
        },
        showUIArrows: function () {

            console.log("videos:" + this.videos.length);

            // Flecha atras
            if (this.mediacontainer.page > 0) {
                this.arrows[0].show = true;
            } else {
                this.arrows[0].show = false;
            }

            // Flecha siguiente
            if (this.countVideos > 6 * (this.mediacontainer.page + 1)) {
                this.arrows[1].show = true;
            } else {
                this.arrows[1].show = false;
            }
        },

    }
}
</script>
