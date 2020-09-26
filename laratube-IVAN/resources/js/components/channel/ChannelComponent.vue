<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 m-2">
                <div class="card">
                    <div class="card-header">Add at: {{ channel.created_at }}</div>

                    <div class="card-body">
                        {{ channel.url }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['channel'],

        data(){
            return {

            }
        },
        mounted() {
            console.log('Channel mounted.')
        }
    }
</script>
