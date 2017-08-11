
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//import VueRouter from 'vue-router'
//import router from './router'
import Vue from 'vue'

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
import templateamy from './components/Amy';

window.listId = 0;

window.main = new Vue({
    el: '#body',
    components: {
        templateamy
    },
    data: {
        lists: window.initList,
        tasks: [
        ],
        newTask: "",
        newList: ""
    },
    methods: {
        backToList: function() {
            $.ajax({
                type: 'get',
                url: '/api/categories',
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'USER-ID': window.amy.user_id,
                    'TOKEN': window.amy.token,
                    'TOKEN-ID': window.amy.token_id,
                }
            }).done(function() {
                console.log('success');
            }).fail(function() {
                console.log('error');
            });
        },
        addCategory: function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/api/categories/add',
                data: {
                    name: this.newList
                },
                headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        }
                    }).done(function(data) {
                          main.lists.push({
                              name: main.newList
                          });
                          main.newList = "";
                    }).fail(function() {
                          console.log('error');
                    });
                  },
                  importTasks: function(e) {
                      var fd = new FormData($("#import").get(0));
                      $.ajax({
                          url: '/api/uploads/import',
                          type: 'POST',
                          data: fd,
                          processData: false,
                          contentType: false,
                          dataType: 'json'
                      })
                      .done(function( data ) {  })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                          console.log('error(' + jqXHR.status + ')');
                      })
                      .always(function( data ) { // ...
                      }) ;
                  },
                  renameCategory: function(e) {
                      console.log('rename');
                  },
                  deleteCategory: function(e) {
                      console.log('delete');
                  }
              }

        });
