<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 m-2">
                <div class="card" v-bind:class="{ 'category-hidden' : category.visible === 'false'}" >
                    <div class="card-header border-0" >
                        <img class="category-visibility mr-1 cursor-pointer" v-if="category.visible === 'true'" v-on:click="ocultar(category)" src="images/icons/show.png" alt="">
                        <img class="category-visibility mr-1 cursor-pointer" v-else v-on:click="mostrar(category)" src="images/icons/hidden.png" alt="">

                        <img class="category-delete float-right mt-1 cursor-pointer" v-bind:class="{ 'delete-visible' : category.visible === 'true'}" v-on:click="remove(category)" src="images/icons/delete.png" alt="">

                        {{ category.name }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {

        props: ['category'],

        data(){
            return {

            }
        },
        mounted() {
            console.log('Category mounted.')
        },
        destroyElement(){
            // Destroy method
            this.$destroy();
        },
        methods:{
            mostrar(category) {
                category.visible = 'true';
                this.update(category);
            },
            ocultar(category) {
                category.visible = 'false';
                this.update(category);
            },
            remove(category) {
                // emit to parent
                this.$emit('remove', category)
                axios.delete('api/categories/' + category.id);

            },
            update(category){
                axios.put(
                    'api/categories/' + category.id ,
                    {visible : category.visible}
                )
            }
        }
    }
</script>
