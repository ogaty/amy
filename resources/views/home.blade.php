@extends('layouts.app')

@section('content')
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
                    <template-lists v-for="list in lists" v-bind:name="list.name" v-bind:key="list.name"></template-lists>
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
                         </li>`,
              props: ['name'],
              methods: {
                taskList: function() {
                    body.tasksActive = true;
                    body.listsActive = false;
                    $.ajax({
                        type: 'get',
                        url: '/api/tasklists',
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        success: function() {
                            console.log('success');
                        },
                        error: function() {
                            console.log('error');
                        }
                    });
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



            var body = new Vue({
                el: '#body',
                data: {
                    lists: [
                        { name: 'INBOX' },
                        { name: 'リスト1' },
                    ],
                    tasks: [
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
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
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
                      this.lists.push({
                          name: this.newList
                      });
                      this.newList = "";
                  },
                  addTask: function(e) {
                      e.preventDefault();
                      this.tasks.push({
                          name: this.newTask
                      });
                      this.newTask = "";
                  }
              }

            });
        </script>
@endsection
