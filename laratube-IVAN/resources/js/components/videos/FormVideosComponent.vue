<template>
    <!--
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 m-2">
                <form action="" v-on:submit.prevent="newVideo()">
                    <div class="form-group">
                        <label for="newvideo">Add new youtube video:</label>
                        <input type="text" autocomplete="off" class="form-control" name="new-video" id="newvideo" v-model="title">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Video</button>

                </form>
            </div>
        </div>
    </div>
    -->
</template>

<script>
    export default {
        data(){
            return {
                title : ''
            }
        },
        mounted() {

        },
        methods:{

            newVideo() {
                const params = {
                    url: this.title ,
                    service: 'youtube' ,
                }

                this.title = '';

                axios.post('api/videos', params).
                    then((response) => {
                        const video = response.data;
                        this.$emit('new', video)
                    });

            }

        }
    }
</script>
