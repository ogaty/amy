<template>
    <div class="wrap">
        <div class="left">
            <ul class="category-list">
                <li class="category-list--each" v-on:click="taskList(list.id, $event)" v-for="list in categories" v-bind:data-id="list.id">
                    <span class="title">{{ list.name }}</span>
                    <span class="menu" v-on:click="categoryMenu"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                </li>
            </ul>
            <form v-on:submit.prevent="addCategory" autocomplete="off">
                <input type="text" class="add-category" name="add-category" v-model="newCategory" placeholder="add category">
            </form>
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h3 id="category-modal-title"></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="center">
            <h2 class="center--head">{{ centercategoryname }}</h2>
            <form v-on:submit.prevent="addTask" autocomplete="off">
                <input type="text" class="center--add-task" name="add-task" v-model="newTask" placeholder="add task">
                <input type="hidden" id="categoryid" value="1">
            </form>
            <ul class="task-list">
                <li class="task-list--each" v-for="task in tasks" v-bind:data-id="task.id">
                    <span class="task-list--check" v-on:click="taskComplete(task.id, $event)">
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    </span>
                    <span class="task-list--title" v-on:click="taskDetail(task.id, $event)">
                        {{ task.name }}
                    </span>
                </li>
            </ul>
            <h2 class="completed-tasks--head">完了タスク</h2>
            <ul class="completed-task-list">
                <li class="completed-task-list--each" v-for="task in completedtasks" v-bind:data-id="task.id">
                    <span class="completed-task-list--check">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                    <span class="completed-task-list--title" v-on:click="taskDetail(task.id, $event)">
                        {{ task.name }}
                    </span>
                </li>
            </ul>
        </div>
        <div class="right">
            detail
        </div>
    </div>
</template>

<script>
module.exports = {
    props: [
        'categoryname',
        'categoryid',
        'taskname',
        'taskid'
    ],
    data: function() {
        return {
            tasks: window.initTask,
            completedtasks: window.initCompletedTask,
            categories: window.initList,
            centercategoryname: "INBOX",
            newCategory: "",
            newTask: "",
            listId: 1
        }
    },
    methods: {
        taskDetail: function(e) {
            console.log('taskDetail');
            e.stopPropagation();
            console.log(this.id);
            $("#modal-task-title").text(this.name);
            $("#modal-task-rename").val(this.name);
            $('#taskModal').modal();
        },
        taskComplete: function(id, e) {
            var _ = this;
            $.ajax({
                type: 'post',
                url: '/api/tasks/complete',
                data: {
                    task: {
                        id: id,
                        completed: 1
                    }
                },
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'USER-ID': window.amy.user_id,
                    'TOKEN': window.amy.token,
                    'TOKEN-ID': window.amy.token_id,
                }
            }).done(function (ret) {
                console.log('success');
                console.log($(ret));
                var index = 0;
                for (var i = 0; i < _.tasks.length; i++) {
                    if (_.tasks[i].id == ret.id) {
                        console.log(i);
                        index = i;
                        break;
                    }
                }
console.log(_.tasks[index]);
                _.completedtasks.push({
                           name:_.tasks[index].name,
                           id:_.tasks[index].id
                          });
                _.tasks.splice(index, 1);
            }).fail(function () {
                console.log('error');
            });
        },
        taskList: function (id, event) {
            var _ = this;
            $("#categoryid").val(id);
            $.ajax({
                type: 'get',
                url: '/api/tasklists/' + id,
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'USER-ID': window.amy.user_id,
                    'TOKEN': window.amy.token,
                    'TOKEN-ID': window.amy.token_id,
                }
            }).done(function (data) {
                console.log(data);
                _.tasks = data;
            }).fail(function () {
                console.log('error');
            });
        },
        categoryMenu: function(e) {
                    $('#category-modal-title').text($(e.currentTarget).parent().find('.title').text());
                    $('#categoryModal').modal();
                },
        addCategory: function(e) {
            var _ = this;
            $.ajax({
                        type: 'post',
                        url: '/api/categories/add',
                        data: {
                            name: this.newCategory
                        },
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        }
                    }).done(function(data) {
                          _.categories.push({name:_.newCategory});
                          _.newCategory = "";
                    }).fail(function() {
                          console.log('error');
                    });
        },
        addTask: function(e) {
            var _ = this;
            $.ajax({
                type: 'post',
                url: '/api/tasks/add',
                data: {
                    task: {
                        name: _.newTask,
                        list_id: $("#categoryid").val()
                    }
                },
                headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                }
            }).done(function(data) {
                _.tasks.push({
                    name: _.newTask,
                    id: data.id
               });
               _.newTask = "";
            }).fail(function() {
               console.log('error');
            });
        },

    }
}
</script>

