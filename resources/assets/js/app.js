
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//import VueRouter from 'vue-router'
//import router from './router'
var Vue = require('vue');
//import Vue from 'vue'

Vue.debug = true;
//Vue.use(VueRouter)
Vue.config.debug = true;
//Vue.component('templateCategories', require('./components/Categoriesa.vue'));
//Vue.component('templatetasks', require('./components/Tasks.vue'));

//from templateCategories import './components/Categoriesa.vue';
//import templatecategories from './components/Categoriesa';
//import templatecategories from './components/Categories';
//import templatetasks from './components/Tasks';
//import templatedetail from './components/Detail';
//import templateamy from './components/Amy';
var templateamy = require('./components/Amy.vue');

window.listId = 0;

window.main = new Vue({
    el: '#body',
    components: {
        templateamy
    },
    data: {
    }
});

function handleDragStart(e) {
}
window.handleDragOver = function(e) {
e.preventDefault();
}
function handleDragEnter(e) {
}
function handleDragLeave(e) {
}
window.handleDrop = function(e) {
console.log("dropped");
}
function handleDragEnd(e) {
}
function addDnDHandlers(elem) {
  elem.addEventListener('dragstart', handleDragStart, false);
  elem.addEventListener('dragenter', handleDragEnter, false)
  elem.addEventListener('dragover', handleDragOver, false);
  elem.addEventListener('dragleave', handleDragLeave, false);
  elem.addEventListener('drop', handleDrop, false);
  elem.addEventListener('dragend', handleDragEnd, false);
}
