<template>
    <div  v-bind:class="arrow.classname" v-on:click="$emit(arrow.event)">
        <span v-bind:class="arrow.spansubclass"><slot></slot></span>
    </div>
</template>

<script>


export default {

    props: ['arrow'],

    data() {
        return {}
    },
    mounted() {
        console.log('arrow mounted.')
    },
    methods: {

    }
}
</script>
