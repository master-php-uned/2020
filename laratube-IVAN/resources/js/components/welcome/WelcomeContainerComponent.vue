<template>

    <div >

        <horizontal-media-container-component
            v-for="horizontal in horizontals"
            :key="horizontal.id"
            :horizontal="horizontal">
        </horizontal-media-container-component>

    </div>
</template>


<script>

export default {

    data() {
        return {
            horizontals: [],
        }
    },
    mounted() {

        console.log('welcome-container mounted.')

        axios.get('api/categories-view')
            .then((response) => {
                this.horizontals = response.data;
            });


    },
    methods: {
        addHorizontal(horizontal) {
            this.videos.push(horizontal);
        },
    }
}
</script>
