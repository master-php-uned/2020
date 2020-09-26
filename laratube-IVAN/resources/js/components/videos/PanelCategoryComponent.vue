<template>
    <div class="d-inline">
        <div class='mibloque' v-show="visible" >
            <div class='back-mibloque' v-on:click="close()"></div>
            <div class='mibloque-contenido p-4'>
                <div>
                    <category-in-panel-component
                        v-for="category in myAllCategoriesPanel"
                        :key="myAllCategoriesPanel.id"
                        :category="category"
                        @change="change"
                        >
                    </category-in-panel-component>
<!--
                    <span class="category cursor-pointer mr-0 ml-1 mt-1 my-badge my-category-apply badge-secondary" v-on:click="close()">Aplicar</span>
-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props:['video','myCategories','visible','video','allCategories'],

        data(){
            return {
                myAllCategoriesPanel:[]
            }
        },
        mounted() {

            this.myAllCategoriesPanel = this.allCategories;
            this.myAllCategoriesPanel.forEach(item => {item.selected = this.isSelected(item)});
        },
        methods:{
            change(category){

                let params = {
                    category_id: category.id,
                    category_selected: category.selected,
                    video_id: this.video.id
                }
                this.$emit('close');

                axios.post('api/video-category', params).
                    then((response) => {
                        this.$emit('close');
                    });

                this.$emit('changeCategory',category);

            },
            close(){
                console.log("close hijo");
                this.$emit('close');
            },
            isSelected(category){
                if(this.myCategories.find(myCategory => myCategory.id === category.id)){
                    return true;

                }else{
                    return false;
                }

            }
        }
    }
</script>
