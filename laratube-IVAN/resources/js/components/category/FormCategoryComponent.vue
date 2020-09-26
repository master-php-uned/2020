<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 m-2">
                <form action="" v-on:submit.prevent="newCategory()">
                    <div class="form-group">
                        <label for="newcategory">Add new Category:</label>
                        <input type="text" autocomplete="off" class="form-control" name="new-category" id="newcategory" v-model="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name : ''
            }
        },
        mounted() {
            console.log('Form category mounted.')
        },
        methods:{

            newCategory() {

                if(this.name.trim() != '') {
                    const params = {
                        name: this.name
                    }

                    this.name = '';

                    axios.post('api/categories', params).then((response) => {
                        const category = response.data;
                        this.$emit('new', category)
                    });
                }
            }
        }
    }
</script>
