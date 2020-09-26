<template>
    <div class="card-body">

        <form-category-component
            @new="addCategory">
        </form-category-component>


        <category-component
            v-for="category in categories"
            :key="category.id"
            :category="category"
            @remove="removeCategory">
        </category-component>

    </div>
</template>

<script>
    export default {

        data(){
            return {
                categories: []
            }
        },
        mounted() {
            console.log('My category mounted.')

            axios.get('api/categories')
                .then((response) => {
                    this.categories = response.data;
                });
        },
        methods: {
            removeCategory(category) {
                this.categories.splice(this.categories.indexOf(category), 1);
            },
            addCategory(category) {
                console.log(category);
                this.categories.push(category);
            }
        }
    }
</script>
