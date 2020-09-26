/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//import BootstrapVue from "bootstrap-vue" //Importing



const vue = require('vue');

window.Vue = vue;


//Vue.use(BootstrapVue)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ChannelComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Channel
Vue.component('form-channel-component', require('./components/channel/FormChannelComponent.vue').default);
Vue.component('my-channel-component', require('./components/channel/MyChannelComponent.vue').default);
Vue.component('channel-component', require('./components/channel/ChannelComponent.vue').default);

// Video
Vue.component('form-videos-component', require('./components/videos/FormVideosComponent.vue').default);
Vue.component('my-videos-component', require('./components/videos/MyVideosComponent.vue').default);
Vue.component('videos-component', require('./components/videos/VideosComponent.vue').default);
Vue.component('category-video-component', require('./components/videos/CategoryVideoComponent.vue').default);
Vue.component('panel-category-component', require('./components/videos/PanelCategoryComponent.vue').default);
Vue.component('category-in-panel-component', require('./components/videos/CategoryInPanelComponent.vue').default);

// Category
Vue.component('form-category-component', require('./components/category/FormCategoryComponent.vue').default);
Vue.component('my-category-component', require('./components/category/MyCategoryComponent.vue').default);
Vue.component('category-component', require('./components/category/CategoryComponent.vue').default);

// Welcome container
Vue.component('horizontal-media-container-component', require('./components/welcome/HorizontalMediaContainerComponent.vue').default);
Vue.component('media-component', require('./components/welcome/MediaComponent.vue').default);
Vue.component('welcome-cointainer-component', require('./components/welcome/WelcomeContainerComponent.vue').default);

// Arrow
Vue.component('arrow-component', require('./components/welcome/ArrowComponent.vue').default);

const app = new Vue({
    el: '#app',
});

window.app = app;
