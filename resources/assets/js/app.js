
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
import ElementUi from 'element-ui'; //引入element ui
import 'element-ui/lib/theme-chalk/index.css'; //引入element-ui 所需的css样式资源 文件

Vue.use(ElementUi); //把引入的elementui装入我们的vue
const app = new Vue({
    el: '#app'
});
