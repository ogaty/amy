<template>
    <li v-on:click="taskDetail">
                             <input type="checkbox" v-on:click="taskComplete">
                             {{ name }}
        <span class="menu" v-on:click="taskDetail"><i class="fa fa-pencil" aria-hidden="true"></i></span>
    </li>
</template>

<script>
module.exports = {
    props: ['name', 'id'],
    methods: {
                taskDetail: function(e) {
                    console.log('taskDetail');
                    e.stopPropagation();
                    console.log(this.id);
                    $("#task-modal-title").text(this.name);
                    $('#taskModal').modal();
                },
                taskComplete: function() {
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
                        console.log(ret);
                    }).fail(function() {
                        console.log('error');
                    });
                }
    }
}
</script>

