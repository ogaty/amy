<template>
    <div class="wrap">
        <div class="left-box">
            <ul class="category-list">
                <li class="category-list--each" draggable="true" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" v-on:click="taskList(list.id, list.name, $event)" v-for="list in categories" v-bind:data-id="list.id">
                    <span class="title">{{ list.name }}</span>
                    <span class="menu" v-on:click="categoryMenu"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                </li>
            </ul>
            <form v-on:submit.prevent="addCategory" autocomplete="off">
                <input type="text" class="add-category" name="add-category" v-model="newCategory" placeholder="add category">
            </form>
            <div id="categoryModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                       <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

               </div>
            </div>
        </div>
        <div class="task-wrap">
            <div class="task-wrap-left">
                <h2 class="task-wrap-left--head">{{ centerCategoryname }}</h2>
                <form v-on:submit.prevent="addTask" autocomplete="off">
                    <input type="text" class="task-wrap-left--add-task" name="add-task" v-model="newTask" placeholder="add task">
                    <input type="hidden" id="categoryid" value="1">
                </form>
                <div class="ui middle aligned divided list task-list">
                    <div class="task-list--each item">
                        <div class="content">
                            <div class="ui checkbox" v-for="task in tasks" v-bind:data-id="task.id" draggable="true">
                                <input type="checkbox" v-on:click="taskComplete(task.id, $event)">
                                <label>{{ task.name }}</label>
                                <i class="fa fa-pencil" aria-hidden="true" v-on:click="taskDetail(task, $event)"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="completed-tasks--head">完了タスク</h2>
                <div class="ui middle aligned divided list task-list">
                    <div class="completed-task-list--each" v-for="task in completedtasks" v-bind:data-id="task.id">
                        <div class="content">
                            <div class="ui checkbox">
                                <input type="checkbox" v-on:click="" checked>
                                <label>{{ task.name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="task-wrap-right" v-if="displayDetail">
                <input type="text" v-bind:value="detail.name" v-model="detailName">
                <h3>期限</h3>
                <input type="date" v-bind:value="detail.deadline" v-model="detailDeadLine">
                <div class="task-detail-memo">
                    <h3>memo</h3>
                    <textarea v-bind:value="detail.memo" v-model="detailMemo">
                    </textarea>
                </div>
                <button v-on:click="updateDetail(detail, $event)">保存</button>
            </div>
        </div>
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
            detail: window.initDetail,
            centerCategoryname: "INBOX",
            newCategory: "",
            newTask: "",
            detailName: "",
            detailMemo: "",
            detailDeadLine: "",
            listId: 1,
            displayDetail: false,
        }
    },
    methods: {
        taskDetail: function(task, e) {
            console.log('taskDetail');
            console.log(task.name);
            e.stopPropagation();
            this.detail.name = task.name;
            this.detail.memo = task.memo;
            this.detail.id = task.id;
            this.detail.deadline = task.deadline;
            this.detailName = task.name;
            this.detailMemo = task.memo;
            this.detailDeadLine = task.deadline;
            this.displayDetail = true;
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
                _.completedtasks.push({
                           name:_.tasks[index].name,
                           id:_.tasks[index].id
                          });
                _.tasks.splice(index, 1);
            }).fail(function () {
                console.log('error');
            });
        },
        taskList: function (id, name, event) {
            var _ = this;
            this.listId= id;
            this.centerCategoryname = name;
            $("#categoryid").val(id);
            axios.get('/api/tasklists/' + id)
                .then(function(response) {
                    _.tasks = response.data;
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
            let params = new URLSearchParams();
            params.append('name', this.newTask);
            params.append('list_id', this.listId);
            axios.post('/api/tasks/add', params, {
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}
            }).then(function(response) {
                _.tasks.push({
                    name: _.newTask,
                    id: response.id
               });
            });
        },
        updateDetail: function(detail, event) {
            let params = new URLSearchParams();
            params.append('id', detail.id);
            params.append('name', this.detailName);
            params.append('memo', this.detailMemo);
            params.append('deadline', this.detailDeadLine);
            console.log(params);
            let self = this;
            axios.post('/api/tasks/update', params, {
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}
            }).then(function(response) {
                console.log('ok');
                for (var i = 0; i < self.tasks.length; i++) {
                    if (self.tasks[i].id == self.detail.id) {
                        self.tasks[i].name = self.detailName;
                    }
                }
                self.detail.name = self.detailName;
                self.detail.memo = self.detailMemo;
                self.detail.deadline = self.detailDeadLine;
            });
        }

    }
}
</script>

