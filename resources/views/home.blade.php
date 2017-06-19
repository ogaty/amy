@extends('layouts.app')

@section('content')
<script>
        window.amy = {!! json_encode([
            'token' => $token['token'],
            'user_id' => $token['user_id'],
            'token_id' => $token['id'],
        ]) !!};
</script>
<style>
input[type=text] {
    width: 100%;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="top">
        </div>
        <div class="body" id="body">
            <div v-if="listsActive" v-bind:class="{'listsActive': listsActive}">
                <ul>
                    <template-lists v-for="list in lists" v-bind:name="list.name" v-bind:id="list.id" v-bind:key="list.name"></template-lists>
                </ul>
                <form v-on:submit="addList">
                <input type="text" placeholder="リストを追加する" v-model="newList">
                </form>

            </div>
            <div v-if="tasksActive" v-bind:class="{'tasksActive': tasksActive}">
                <div class="arrow" v-on:click="backToList">
                ←
                </div>
                <form v-on:submit="addTask">
                <input type="text" placeholder="new task" v-model="newTask">
                </form>
                <ul>
                    <template-tasks v-for="task in tasks" v-bind:name="task.name" v-bind:key="task.name"></template-lists>
                </ul>
                <form method="post" id="import" enctype="multipart/form-data">
                    <input type="file" name="import">
                    <button type="button" id="import" v-on:click="importTasks">インポート</button>
                </form>
            </div>

<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="detail-modal">
    </div>
  </div>
</div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('script')
        <script type="text/javascript">
            Vue.config.debug = true;
            Vue.component('template-lists', {
              template: `<li v-on:click="taskList">
                             @{{ name }}
                             <span class="menu" v-on:click="categoriesMenu"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                         </li>`,
              props: ['name', 'id'],
              methods: {
                taskList: function() {
                    body.tasksActive = true;
                    body.listsActive = false;
                    window.listId = this.id;
                    $.ajax({
                        type: 'get',
                        url: '/api/tasklists/' + this.id,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        },
                        success: function(data) {
                            body.tasks = data;
                            console.log(data);
                        },
                        error: function() {
                            console.log('error');
                        }
                    });
                },
                categoriesMenu: function(e) {
                    e.stopPropagation();
                    console.log(this.id);
                    $("#detail-modal").text('this is test.');
                    $('#myModal').modal();
                    console.log('menu');
                }
              }
            });

            Vue.component('template-tasks', {
              template: `<li v-on:click="taskDetail">
                             @{{ name }}
                         </li>`,
              props: ['name'],
              methods: {
                taskDetail: function() {
                }
              }
            });


            var listInit = function() {
                window.initList = {!! json_encode($categories); !!}
            }
            listInit();
            window.listId = 0;
                    
            var body = new Vue({
                el: '#body',
                data: {
                    lists: window.initList,
                    tasks: [
                        { name: 'タスク１' },
                        { name: 'タスク１' },
                        { name: 'タスク２' }
                    ],
                    listsActive: true,
                    tasksActive: false,
                    newTask: "",
                    newList: ""
                },
                methods: {
                  backToList: function() {
                    body.tasksActive = false;
                    body.listsActive = true;
                    $.ajax({
                        type: 'get',
                        url: '/api/categories',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        },
                        success: function() {
                            console.log('success');
                        },
                        error: function() {
                            console.log('error');
                        }
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
                        },
                        success: function(data) {
                          body.lists.push({
                              name: body.newList
                          });
                          body.newList = "";
                        },
                        error: function() {
                            console.log('error');
                        }
                    });
                  },
                  addTask: function(e) {
                      e.preventDefault();
                      e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: '/api/tasks/add',
                        data: {
                            task: {
                                name: body.newTask,
                                list_id: window.listId
                            }
                        },
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        },
                        success: function(data) {
                          body.tasks.push({
                            name: body.newTask
                          });
                          body.newTask = "";
                        },
                        error: function() {
                            console.log('error');
                        }
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
                  }
              }

            });
        </script>
@endsection
