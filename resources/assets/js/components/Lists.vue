<template>
    <li v-on:click="taskList">
        {{ name }}
        <span class="menu" v-on:click="categoriesMenu"><i class="fa fa-pencil" aria-hidden="true"></i></span>
    </li>
</template>

<script>
module.exports = {
    props: ['name', 'id'],
    methods: {
                taskList: function() {
                    main.tasksActive = true;
                    main.listsActive = false;
                    window.listId = this.id;
                    $.ajax({
                        type: 'get',
                        url: '/api/tasklists/' + this.id,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'USER-ID': window.amy.user_id,
                            'TOKEN': window.amy.token,
                            'TOKEN-ID': window.amy.token_id,
                        }
                    }).done(function(data) {
                        main.tasks = data;
                    }).fail(function() {
                        console.log('error');
                    });
                },
                categoriesMenu: function(e) {
                    e.stopPropagation();
                    console.log(this.id);
                    $("#modal-title").text(this.name);
                    $('#myModal').modal();
                    console.log('menu');
                }
              }
}
</script>

