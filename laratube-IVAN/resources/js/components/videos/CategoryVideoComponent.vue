<template>
    <span class="category mr-0 ml-1 mt-1 mb-0 my-badge badge-gray">
       {{category.name}}
        <img class="ml-1 cursor-pointer" v-on:click="removeCategory(category)" src="images/icons/delete-category.png" alt="">
    </span>
</template>

<script>

    export default {
        props: ['category'],
        data(){
            return {

            }
        },
        mounted() {

        },
        methods:{
            removeCategory() {
                this.$emit('remove', this.category)
            }
        }
    }
    /* SELECT  videos.id, videos.url ,categories.id,categories.name  FROM videos,video_categories, categories where videos.id = video_categories.video_id and categories.id = video_categories.id order by video_categories.category_id */

</script>
