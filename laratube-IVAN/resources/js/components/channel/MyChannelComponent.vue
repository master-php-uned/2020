<template>
    <div class="card-body">

        <form-channel-component
            @new="addChannel">
        </form-channel-component>

        <channel-component
            v-for="channel in channels"
            :key="channel.id"
            :channel="channel">
        </channel-component>

    </div>
</template>

<script>
    export default {

        data(){
            return {
                channels: []
            }
        },
        mounted() {
            console.log('My channel mounted.')

            axios.get('api/channels')
                .then((response) => {
                    this.channels = response.data;
                });
        },
        methods: {
            addChannel(channel) {
                this.channels.push(channel);
            }
        }
    }
</script>
