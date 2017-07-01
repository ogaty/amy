
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

Vue.config.debug = true;
Vue.component('templatelists', require('./components/Lists.vue'));

Vue.component('templatetasks', require('./components/Tasks.vue'));

window.listId = 0;

console.log(this);
window.main = new Vue({
    el: '#body',
    data: {
        lists: window.initList,
        tasks: [
    ],
    listsActive: true,
    tasksActive: false,
    newTask: "",
    newList: ""
    },
                methods: {
                  backToList: function() {
                    main.tasksActive = false;
                    main.listsActive = true;
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
                  addList: function(e) {
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
                  addTask: function(e) {
                      e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: '/api/tasks/add',
                        data: {
                            task: {
                                name: main.newTask,
                                list_id: window.listId
                            }
                        },
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        }
                    }).done(function(data) {
                          main.tasks.push({
                            name: main.newTask
                          });
                          main.newTask = "";
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
