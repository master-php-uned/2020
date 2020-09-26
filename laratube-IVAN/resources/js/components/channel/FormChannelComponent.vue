<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 m-2">
                <form action="" v-on:submit.prevent="newChannel()">
                    <div class="form-group">
                        <label for="newchannel">Add new youtube channel:</label>
                        <input type="text" autocomplete="off" class="form-control" name="new-channel" id="newchannel" v-model="title">
                    </div>
                    <button type="submit" class="btn btn-primary">Add channel</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                title : ''
            }
        },
        mounted() {
            console.log('Form channel mounted.')
        },
        methods:{

            newChannel() {
                const params = {
                    url: this.title ,
                    service: 'youtube' ,
                }

                this.title = '';

                axios.post('api/channels', params).
                    then((response) => {
                        const channel = response.data;
                        this.$emit('new', channel)
                    });

            }

        }
    }
</script>
