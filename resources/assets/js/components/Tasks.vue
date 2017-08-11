<template>
    <ul>
    <li v-on:click="taskList" v-for="task in tasks">
        {{ name }}{{ task }}
    </li>
    </ul>
</template>

<script>
module.exports = {
    props: ['name', 'id'],
    data: function() {
        return {
            tasks: ["task1", "task2"]
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
                taskComplete: function(e) {
                    e.stopPropagation(); 
                    $.ajax({
                        type: 'post',
                        url: '/api/tasks/complete',
                        data: {
                            task: {
                                id: this.id,
                                completed: 1
                            }
                        },
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        }
                    }).done(function(ret) {
                        console.log('success');
                        console.log($(ret));
                        var index = 0;
                        for (var i = 0; i < main.tasks.length; i++) {
                            if (main.tasks[i].id == ret.id) {
                                console.log(i);
                            }
                        }
                        main.tasks.splice(index, 1);
                    }).fail(function() {
                        console.log('error');
                    });
                }
    }
}
</script>

