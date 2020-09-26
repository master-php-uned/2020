<template>
    <span class="cursor-pointer category-add category mr-0 ml-1 mt-1 mb-0 my-badge " :class="this.category.selected ? 'badge-success' : 'badge-gray'" v-on:click="click()">
       {{category.name}}
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
            click(){
                this.category.selected = ! this.category.selected;
                this.$emit('change',this.category);

                this.category.selected = false;
            }
        }
    }

</script>
